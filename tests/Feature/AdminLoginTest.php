<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_log_in_with_valid_credentials(): void
    {
        $admin = Admin::create([
            'name' => 'Test Admin',
            'email' => 'admin@example.com',
            'password' => 'test-password',
        ]);

        $response = $this->post(route('admin.login.submit'), [
            'email' => 'admin@example.com',
            'password' => 'test-password',
        ]);

        $response->assertRedirect(route('admin.dashboard'));

        $this->assertAuthenticatedAs($admin, 'admin');
    }

    public function test_admin_cannot_log_in_with_invalid_password(): void
    {
        Admin::create([
            'name' => 'Test Admin',
            'email' => 'admin@example.com',
            'password' => 'test-password',
        ]);

        $response = $this->from(route('admin.login'))
            ->post(route('admin.login.submit'), [
                'email' => 'admin@example.com',
                'password' => 'wrong-password',
            ]);

        $response->assertRedirect(route('admin.login'));
        $response->assertSessionHas('error', 'Invalid email or password.');

        $this->assertGuest('admin');
    }
public function test_admin_login_is_rate_limited_after_five_failed_attempts(): void
{
    for ($attempt = 1; $attempt <= 5; $attempt++) {
        $this->post(route('admin.login.submit'), [
            'email' => 'admin@example.com',
            'password' => 'wrong-password',
        ]);
    }

    $response = $this->post(route('admin.login.submit'), [
        'email' => 'admin@example.com',
        'password' => 'wrong-password',
    ]);

    $response->assertSessionHas('error', function ($message) {
        return str_starts_with($message, 'Too many login attempts.');
    });
}
}