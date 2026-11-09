<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminLogoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_log_out_successfully(): void
    {
        $admin = Admin::create([
            'name' => 'Test Admin',
            'email' => 'admin@example.com',
            'password' => 'test-password',
        ]);

        $response = $this->actingAs($admin, 'admin')
            ->post(route('admin.logout'));

        $response->assertRedirect(route('admin.login'));

        $this->assertGuest('admin');
    }
}