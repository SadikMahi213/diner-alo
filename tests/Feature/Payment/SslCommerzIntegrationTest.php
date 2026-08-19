<?php

namespace Tests\Feature\Payment;

use App\Models\Donation;
use App\Models\Donor;
use App\Models\Transaction;
use App\Models\User;
use App\Payments\Gateways\SslCommerzGateway;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SslCommerzIntegrationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        config()->set('sslcommerz.connect_from_localhost', true);
    }

    protected function createDonor(): Donor
    {
        $user = User::factory()->create(['role' => 'user']);
        return Donor::create([
            'user_id' => $user->id,
            'name' => 'Test Donor',
            'email' => 'test@test.com',
            'mobile_number' => '01712345678',
        ]);
    }

    /** @test */
    public function donation_form_page_loads(): void
    {
        $response = $this->get(route('donation.create'));
        $response->assertStatus(200);
    }

    /** @test */
    public function donation_initiate_requires_validation(): void
    {
        $response = $this->postJson(route('donation.sslcommerz.initiate'), []);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['name', 'mobile_number', 'email', 'amount', 'payment_method']);
    }

    /** @test */
    public function donation_initiate_rejects_minimum_amount(): void
    {
        $response = $this->postJson(route('donation.sslcommerz.initiate'), [
            'name' => 'Test Donor',
            'mobile_number' => '01712345678',
            'email' => 'test@example.com',
            'amount' => 50,
            'payment_method' => 'sslcommerz',
        ]);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['amount']);
    }

    /** @test */
    public function sslcommerz_success_callback_requires_valid_data(): void
    {
        $response = $this->getJson(route('sslcommerz.success'));
        $response->assertRedirect('/');
        $response->assertSessionHas('error', 'Invalid payment response.');
    }

    /** @test */
    public function sslcommerz_fail_callback_handles_missing_tran_id(): void
    {
        $response = $this->get(route('sslcommerz.fail'));
        $response->assertRedirect('/');
    }

    /** @test */
    public function sslcommerz_cancel_callback_handles_missing_tran_id(): void
    {
        $response = $this->get(route('sslcommerz.cancel'));
        $response->assertRedirect('/');
    }

    /** @test */
    public function sslcommerz_ipn_requires_tran_id_and_amount(): void
    {
        $response = $this->postJson(route('sslcommerz.ipn'), []);
        $response->assertStatus(200);
        $response->assertJson(['status' => 'error']);
    }

    /** @test */
    public function sslcommerz_ipn_handles_unknown_transaction(): void
    {
        $response = $this->postJson(route('sslcommerz.ipn'), [
            'tran_id' => 'UNKNOWN-TRAN-123',
            'amount' => 1000,
            'currency' => 'BDT',
        ]);
        $response->assertStatus(200);
        $response->assertJson(['status' => 'success']);
    }

    /** @test */
    public function sslcommerz_success_callback_does_not_duplicate_payment(): void
    {
        $donor = $this->createDonor();

        $donation = Donation::create([
            'donor_id' => $donor->id,
            'amount' => 1000,
            'payment_method' => 'sslcommerz',
            'transaction_id' => 'DA-2026-00001',
            'status' => 'successful',
        ]);

        Transaction::create([
            'donation_id' => $donation->id,
            'gateway' => 'sslcommerz',
            'gateway_name' => 'sslcommerz',
            'gateway_session_id' => 'DA-2026-00001',
            'gateway_transaction_id' => 'BANK-TRAN-123',
            'status' => 'successful',
            'transaction_id' => 'DA-2026-00001',
            'amount' => 1000,
            'currency' => 'BDT',
        ]);

        $response = $this->get(route('sslcommerz.success', [
            'val_id' => 'VAL123',
            'tran_id' => 'DA-2026-00001',
            'amount' => 1000,
            'currency' => 'BDT',
        ]));

        $response->assertRedirect('/');
        $donation->refresh();
        $this->assertEquals('successful', $donation->status);
    }

    /** @test */
    public function sslcommerz_ipn_does_not_duplicate_payment(): void
    {
        $donor = $this->createDonor();

        $donation = Donation::create([
            'donor_id' => $donor->id,
            'amount' => 500,
            'payment_method' => 'sslcommerz',
            'transaction_id' => 'DA-2026-00002',
            'status' => 'successful',
        ]);

        Transaction::create([
            'donation_id' => $donation->id,
            'gateway' => 'sslcommerz',
            'gateway_name' => 'sslcommerz',
            'gateway_session_id' => 'DA-2026-00002',
            'gateway_transaction_id' => 'BANK-TRAN-456',
            'status' => 'successful',
            'transaction_id' => 'DA-2026-00002',
            'amount' => 500,
            'currency' => 'BDT',
        ]);

        $response = $this->postJson(route('sslcommerz.ipn'), [
            'tran_id' => 'DA-2026-00002',
            'amount' => 500,
            'currency' => 'BDT',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['status' => 'success']);
        $donation->refresh();
        $this->assertEquals('successful', $donation->status);
    }

    /** @test */
    public function sslcommerz_fail_callback_updates_status(): void
    {
        $donor = $this->createDonor();

        $donation = Donation::create([
            'donor_id' => $donor->id,
            'amount' => 2000,
            'payment_method' => 'sslcommerz',
            'transaction_id' => 'DA-2026-00003',
            'status' => 'processing',
        ]);

        $transaction = Transaction::create([
            'donation_id' => $donation->id,
            'gateway' => 'sslcommerz',
            'gateway_name' => 'sslcommerz',
            'gateway_session_id' => 'DA-2026-00003',
            'status' => 'processing',
            'transaction_id' => 'DA-2026-00003',
            'amount' => 2000,
            'currency' => 'BDT',
        ]);

        $response = $this->get(route('sslcommerz.fail', [
            'tran_id' => 'DA-2026-00003',
            'amount' => 2000,
            'currency' => 'BDT',
        ]));

        $response->assertRedirect();
        $transaction->refresh();
        $this->assertEquals('failed', $transaction->status);
        $donation->refresh();
        $this->assertEquals('failed', $donation->status);
    }

    /** @test */
    public function sslcommerz_cancel_callback_updates_status(): void
    {
        $donor = $this->createDonor();

        $donation = Donation::create([
            'donor_id' => $donor->id,
            'amount' => 3000,
            'payment_method' => 'sslcommerz',
            'transaction_id' => 'DA-2026-00004',
            'status' => 'processing',
        ]);

        $transaction = Transaction::create([
            'donation_id' => $donation->id,
            'gateway' => 'sslcommerz',
            'gateway_name' => 'sslcommerz',
            'gateway_session_id' => 'DA-2026-00004',
            'status' => 'processing',
            'transaction_id' => 'DA-2026-00004',
            'amount' => 3000,
            'currency' => 'BDT',
        ]);

        $response = $this->get(route('sslcommerz.cancel', [
            'tran_id' => 'DA-2026-00004',
            'amount' => 3000,
            'currency' => 'BDT',
        ]));

        $response->assertRedirect();
        $transaction->refresh();
        $this->assertEquals('cancelled', $transaction->status);
        $donation->refresh();
        $this->assertEquals('cancelled', $donation->status);
    }

    /** @test */
    public function sslcommerz_routes_are_registered(): void
    {
        $routes = [
            'sslcommerz.success',
            'sslcommerz.fail',
            'sslcommerz.cancel',
            'sslcommerz.ipn',
            'donation.sslcommerz.initiate',
        ];

        foreach ($routes as $routeName) {
            $this->assertTrue(
                \Illuminate\Support\Facades\Route::has($routeName),
                "Route [{$routeName}] is not registered"
            );
        }
    }
}
