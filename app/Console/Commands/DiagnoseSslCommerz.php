<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DiagnoseSslCommerz extends Command
{
    protected $signature = 'payment:diagnose-sslcommerz';
    protected $description = 'Diagnose SSLCommerz configuration without exposing secrets';

    public function handle(): int
    {
        $this->info('SSLCommerz Configuration');
        $this->line(str_repeat('-', 28));

        // Detect package - custom library vs composer package
        $composerLock = @json_decode(@file_get_contents(base_path('composer.lock')), true);
        $package = null;
        $packageVersion = 'custom library (app/Library/SslCommerz)';
        if ($composerLock) {
            foreach (($composerLock['packages'] ?? []) as $pkg) {
                if (stripos($pkg['name'] ?? '', 'sslcommerz') !== false) {
                    $package = $pkg['name'];
                    $packageVersion = $pkg['version'] ?? 'unknown';
                    break;
                }
            }
        }
        if ($package) {
            $this->line("Package: {$package}");
            $this->line("Package Version: {$packageVersion}");
        } else {
            $this->line("Package: custom library (app/Library/SslCommerz)");
            $this->line("Package Version: app/Library/SslCommerz (no composer package)");
        }
        $this->line("Laravel: " . app()->version());
        $this->line("PHP: " . PHP_VERSION);

        $storeId = config('sslcommerz.apiCredentials.store_id');
        $storePass = config('sslcommerz.apiCredentials.store_password');
        $apiDomain = config('sslcommerz.apiDomain');
        $isSandbox = $apiDomain === 'https://sandbox.sslcommerz.com';
        $appUrl = config('app.url');
        $successUrl = \Illuminate\Support\Facades\URL::to(config('sslcommerz.success_url', '/sslcommerz/success'));
        $failUrl = \Illuminate\Support\Facades\URL::to(config('sslcommerz.failed_url', '/sslcommerz/fail'));
        // Note: config key is failed_url vs fail_url (handle both)
        $failUrlReal = config('sslcommerz.failed_url') ?? config('sslcommerz.fail_url') ?? '/sslcommerz/fail';
        $failUrl = \Illuminate\Support\Facades\URL::to($failUrlReal);
        $cancelUrl = \Illuminate\Support\Facades\URL::to(config('sslcommerz.cancel_url', '/sslcommerz/cancel'));
        $ipnUrl = \Illuminate\Support\Facades\URL::to(config('sslcommerz.ipn_url', '/sslcommerz/ipn'));

        $this->line("Store ID: " . (!empty($storeId) ? 'CONFIGURED' : 'MISSING'));
        $this->line("Store Password: " . (!empty($storePass) ? 'CONFIGURED' : 'MISSING'));
        $this->line("Mode: " . ($isSandbox ? 'SANDBOX' : 'LIVE'));
        $this->line("Endpoint: " . ($isSandbox ? 'SANDBOX (https://sandbox.sslcommerz.com)' : 'LIVE (https://securepay.sslcommerz.com)'));
        $this->line("APP_URL: " . (!empty($appUrl) ? 'CONFIGURED (' . $appUrl . ')' : 'MISSING'));
        $this->line("Success URL: " . (!empty($successUrl) ? 'CONFIGURED (' . $successUrl . ')' : 'MISSING'));
        $this->line("Fail URL: " . (!empty($failUrl) ? 'CONFIGURED (' . $failUrl . ')' : 'MISSING'));
        $this->line("Cancel URL: " . (!empty($cancelUrl) ? 'CONFIGURED (' . $cancelUrl . ')' : 'MISSING'));
        $this->line("IPN URL: " . (!empty($ipnUrl) ? 'CONFIGURED (' . $ipnUrl . ')' : 'MISSING'));

        $hasError = false;
        if (empty($storeId)) {
            $this->error("Missing SSLCZ_STORE_ID");
            $hasError = true;
        }
        if (empty($storePass)) {
            $this->error("Missing SSLCZ_STORE_PASSWORD");
            $hasError = true;
        }
        if (empty($appUrl) || $appUrl === 'http://localhost') {
            $this->warn("APP_URL is default http://localhost - set to your actual domain for correct callback URLs (use https for ngrok)");
        }
        if (!$isSandbox && empty($storeId)) {
            $this->warn("Live mode requires valid live credentials");
        }

        if ($hasError) {
            $this->newLine();
            $this->error("Diagnosis: FAILED - required configuration missing");
            $this->line("Set SSLCZ_STORE_ID and SSLCZ_STORE_PASSWORD in .env, then run: php artisan config:clear && php artisan cache:clear");
            return 1;
        }

        $this->newLine();
        $this->info("Diagnosis: OK");
        return 0;
    }
}
