<?php

namespace Tests\Feature\Payment;

use App\Models\Donation;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NgrokSandboxTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        config(['app.url' => 'https://polyhydroxy-oversystematically-lawrence.ngrok-free.dev']);
        config(['sslcommerz.apiCredentials.store_id' => 'testbox']);
        config(['sslcommerz.apiCredentials.store_password' => 'qwerty']);
        config(['sslcommerz.apiDomain' => 'https://sandbox.sslcommerz.com']);
    }

    /** @test */
    public function callback_urls_are_https_ngrok_when_configured(): void
    {
        $this->assertEquals('https://polyhydroxy-oversystematically-lawrence.ngrok-free.dev', config('app.url'));
        $this->assertStringStartsWith('https://polyhydroxy-oversystematically-lawrence.ngrok-free.dev', url('/sslcommerz/success'));
        $this->assertStringStartsWith('https://polyhydroxy-oversystematically-lawrence.ngrok-free.dev', url('/sslcommerz/fail'));
        $this->assertStringStartsWith('https://polyhydroxy-oversystematically-lawrence.ngrok-free.dev', url('/sslcommerz/cancel'));
        $this->assertStringStartsWith('https://polyhydroxy-oversystematically-lawrence.ngrok-free.dev', url('/sslcommerz/ipn'));
        $this->assertEquals('https://sandbox.sslcommerz.com', config('sslcommerz.apiDomain'));
    }

    /** @test */
    public function donation_initiation_via_ngrok_creates_pending_and_redirects_to_sandbox(): void
    {
        $categoryId = \Illuminate\Support\Facades\DB::table('project_categories')->insertGetId([
            'name_bn' => 'টেস্ট NGROK', 'name_en' => 'Test NGROK', 'description' => 'Test', 'color' => 'green',
            'created_at' => now(), 'updated_at' => now(),
        ]);
        $fundId = \Illuminate\Support\Facades\DB::table('donation_funds')->insertGetId([
            'category_id' => $categoryId, 'name_bn' => 'টেস্ট NGROK', 'name_en' => 'Test NGROK', 'description' => 'Test',
            'minimum_amount' => 100, 'suggested_amounts' => '[]', 'is_active' => true,
            'created_at' => now(), 'updated_at' => now(),
        ]);

        // Simulate ngrok HTTPS request
        $response = $this->withHeaders([
            'Host' => 'polyhydroxy-oversystematically-lawrence.ngrok-free.dev',
            'X-Forwarded-Proto' => 'https',
        ])->post(route('donation.sslcommerz.initiate'), [
            'donation_fund_id' => $fundId,
            'contact' => 'ngrok_test@example.com',
            'amount' => 2000,
            'terms' => true,
        ]);

        // Should redirect to sandbox
        $response->assertStatus(302);
        $location = $response->headers->get('Location');
        $this->assertStringStartsWith('https://sandbox.sslcommerz.com', $location, 'Should redirect to sandbox, got: '.$location);

        // Verify DB: pending -> processing
        $donation = Donation::where('transaction_id', 'like', 'DA-%')->latest()->first();
        $this->assertNotNull($donation);
        $this->assertEquals(2000, (float)$donation->amount);
        $this->assertEquals('BDT', $donation->currency ?? 'BDT');
        $this->assertEquals('processing', $donation->status);
        $this->assertEquals($fundId, $donation->donation_fund_id);

        $tx = Transaction::where('donation_id', $donation->id)->first();
        $this->assertNotNull($tx);
        $this->assertEquals(2000, (float)$tx->amount);
        $this->assertEquals('BDT', $tx->currency);
        $this->assertEquals('processing', $tx->status);
        $this->assertEquals('sslcommerz', $tx->gateway);
        $this->assertNotEmpty($tx->gateway_session_id);
    }

    /** @test */
    public function server_is_authoritative_for_amount(): void
    {
        $categoryId = \Illuminate\Support\Facades\DB::table('project_categories')->insertGetId([
            'name_bn' => 'টেস্ট Amt', 'name_en' => 'Test Amt', 'description' => 'Test', 'color' => 'green',
            'created_at' => now(), 'updated_at' => now(),
        ]);
        $fundId = \Illuminate\Support\Facades\DB::table('donation_funds')->insertGetId([
            'category_id' => $categoryId, 'name_bn' => 'টেস্ট Amt', 'name_en' => 'Test Amt', 'description' => 'Test',
            'minimum_amount' => 100, 'suggested_amounts' => '[]', 'is_active' => true,
            'created_at' => now(), 'updated_at' => now(),
        ]);

        // Try 0 amount should fail validation, not create pending
        $response = $this->postJson(route('donation.sslcommerz.initiate'), [
            'donation_fund_id' => $fundId,
            'contact' => 'amt@example.com',
            'amount' => 0,
            'terms' => true,
        ]);
        $response->assertStatus(422);
        $this->assertEquals(0, Donation::count());
    }
}
