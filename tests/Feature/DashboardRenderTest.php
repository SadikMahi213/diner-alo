<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardRenderTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function dashboard_renders_without_raw_blade(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $content = $response->getContent();
        $this->assertStringNotContainsString('@extends', $content, 'Should not contain raw @extends');
        $this->assertStringNotContainsString('@section', $content, 'Should not contain raw @section');
        $this->assertStringNotContainsString('{{ Auth::user()->name }}', $content, 'Should not contain unrendered Blade');
        $this->assertStringContainsString('Welcome,', $content);
        $this->assertStringContainsString($user->name, $content);
        $this->assertStringNotContainsString('%7B%7B', $content);
        $this->assertStringNotContainsString('\\->', $content);
        $this->assertStringNotContainsString('@foreach(Auth::user()->courses as \\)', $content);
    }

    /** @test */
    public function dashboard_shows_courses_and_packages(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertStatus(200);
        $content = $response->getContent();
        $this->assertStringContainsString('My Courses', $content);
        $this->assertStringContainsString('My Packages', $content);
        $this->assertStringContainsString('Wallet Balance', $content);
    }

    /** @test */
    public function admin_dashboard_renders(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $response = $this->actingAs($admin)->get('/admin/dashboard');
        $response->assertStatus(200);
        $this->assertStringNotContainsString('@extends', $response->getContent());
    }
}
