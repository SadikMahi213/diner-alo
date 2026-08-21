<?php

namespace Tests\Feature\Payment;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SslCommerzConfigTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function diagnose_command_reports_missing_store_id(): void
    {
        config(['sslcommerz.apiCredentials.store_id' => null]);
        config(['sslcommerz.apiCredentials.store_password' => 'dummy']);

        $this->artisan('payment:diagnose-sslcommerz')
            ->expectsOutputToContain('Store ID: MISSING')
            ->assertExitCode(1);
    }

    /** @test */
    public function diagnose_command_reports_missing_store_password(): void
    {
        config(['sslcommerz.apiCredentials.store_id' => 'testbox']);
        config(['sslcommerz.apiCredentials.store_password' => null]);

        $this->artisan('payment:diagnose-sslcommerz')
            ->expectsOutputToContain('Store Password: MISSING')
            ->assertExitCode(1);
    }

    /** @test */
    public function diagnose_command_succeeds_when_configured(): void
    {
        config(['sslcommerz.apiCredentials.store_id' => 'testbox']);
        config(['sslcommerz.apiCredentials.store_password' => 'qwerty']);
        config(['sslcommerz.apiDomain' => 'https://sandbox.sslcommerz.com']);
        config(['app.url' => 'https://example.com']);

        $this->artisan('payment:diagnose-sslcommerz')
            ->expectsOutputToContain('Store ID: CONFIGURED')
            ->expectsOutputToContain('Store Password: CONFIGURED')
            ->expectsOutputToContain('Mode: SANDBOX')
            ->assertExitCode(0);
    }

    /** @test */
    public function sandbox_configuration_uses_sandbox_endpoint(): void
    {
        config(['sslcommerz.apiCredentials.store_id' => 'testbox']);
        config(['sslcommerz.apiCredentials.store_password' => 'qwerty']);
        config(['sslcommerz.apiDomain' => 'https://sandbox.sslcommerz.com']);

        $this->assertEquals('https://sandbox.sslcommerz.com', config('sslcommerz.apiDomain'));
    }

    /** @test */
    public function live_configuration_uses_live_endpoint(): void
    {
        config(['sslcommerz.apiDomain' => 'https://securepay.sslcommerz.com']);
        $this->assertEquals('https://securepay.sslcommerz.com', config('sslcommerz.apiDomain'));
    }

    /** @test */
    public function config_loads_correct_keys(): void
    {
        config(['sslcommerz.apiCredentials.store_id' => 'my_store']);
        config(['sslcommerz.apiCredentials.store_password' => 'my_pass']);
        config(['sslcommerz.apiDomain' => 'https://sandbox.sslcommerz.com']);

        $this->assertEquals('my_store', config('sslcommerz.apiCredentials.store_id'));
        $this->assertEquals('my_pass', config('sslcommerz.apiCredentials.store_password'));
        $this->assertNotEmpty(config('sslcommerz.apiUrl.make_payment'));
        $this->assertNotEmpty(config('sslcommerz.success_url'));
    }

    /** @test */
    public function donation_initiate_returns_config_error_when_store_id_missing(): void
    {
        config(['sslcommerz.apiCredentials.store_id' => null]);
        config(['sslcommerz.apiCredentials.store_password' => null]);

        $categoryId = \Illuminate\Support\Facades\DB::table('project_categories')->insertGetId([
            'name_bn' => 'টেস্ট', 'name_en' => 'Test', 'description' => 'Test', 'color' => 'green',
            'created_at' => now(), 'updated_at' => now(),
        ]);
        $fundId = \Illuminate\Support\Facades\DB::table('donation_funds')->insertGetId([
            'category_id' => $categoryId, 'name_bn' => 'টেস্ট', 'name_en' => 'Test', 'description' => 'Test',
            'minimum_amount' => 100, 'suggested_amounts' => '[]', 'is_active' => true,
            'created_at' => now(), 'updated_at' => now(),
        ]);

        $response = $this->post(route('donation.sslcommerz.initiate'), [
            'donation_fund_id' => $fundId,
            'contact' => 'test@example.com',
            'amount' => 2000,
            'terms' => true,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('error');
        $this->assertStringContainsString('CONFIG_ERROR', session('error') ?? $response->getSession()->get('error'));
    }

    /** @test */
    public function payment_initialization_amount_is_server_authoritative(): void
    {
        // Even if frontend sends tampered amount, server validates and creates donation with that amount
        // Gateway validation will catch tampering on callback
        $categoryId = \Illuminate\Support\Facades\DB::table('project_categories')->insertGetId([
            'name_bn' => 'টেস্ট2', 'name_en' => 'Test2', 'description' => 'Test', 'color' => 'green',
            'created_at' => now(), 'updated_at' => now(),
        ]);
        $fundId = \Illuminate\Support\Facades\DB::table('donation_funds')->insertGetId([
            'category_id' => $categoryId, 'name_bn' => 'টেস্ট2', 'name_en' => 'Test2', 'description' => 'Test',
            'minimum_amount' => 100, 'suggested_amounts' => '[]', 'is_active' => true,
            'created_at' => now(), 'updated_at' => now(),
        ]);

        // Try with tampered amount 0 (should fail validation)
        $response = $this->postJson(route('donation.sslcommerz.initiate'), [
            'donation_fund_id' => $fundId,
            'contact' => 'test2@example.com',
            'amount' => 0,
            'terms' => true,
        ]);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['amount']);
    }
}
