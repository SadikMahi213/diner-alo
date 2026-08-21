<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminDonationPagesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_donations_returns_html_not_json(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $response = $this->actingAs($admin)->get('/admin/donations');
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $this->assertStringNotContainsString('"data":', $response->getContent());
        $this->assertStringContainsString('Donations', $response->getContent());
    }

    /** @test */
    public function admin_donors_returns_html(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $response = $this->actingAs($admin)->get('/admin/donors');
        $response->assertStatus(200);
        $this->assertStringContainsString('Donors', $response->getContent());
    }

    /** @test */
    public function admin_members_returns_html(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $response = $this->actingAs($admin)->get('/admin/members');
        $response->assertStatus(200);
        $this->assertStringContainsString('Members', $response->getContent());
    }

    /** @test */
    public function admin_volunteers_returns_html(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $response = $this->actingAs($admin)->get('/admin/volunteers');
        $response->assertStatus(200);
        $this->assertStringContainsString('Volunteers', $response->getContent());
    }

    /** @test */
    public function admin_transactions_returns_html_with_proper_contrast(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $response = $this->actingAs($admin)->get('/admin/transactions');
        $response->assertStatus(200);
        $content = $response->getContent();
        $this->assertStringContainsString('Transactions', $content);
        // Check for proper contrast classes (not white on white)
        $this->assertStringContainsString('bg-white', $content);
        $this->assertStringContainsString('text-gray-800', $content);
        $this->assertStringNotContainsString('View [admin.partials', $content);
    }

    /** @test */
    public function non_admin_cannot_access_admin_pages(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->actingAs($user)->get('/admin/donations')->assertRedirect('/');
        $this->actingAs($user)->get('/admin/transactions')->assertRedirect('/');
    }
}
