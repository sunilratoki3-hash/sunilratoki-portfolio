<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminProjectAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_admin_can_access_project_management(): void
    {
        $admin = Admin::create([
            'name' => 'Test Admin',
            'email' => 'admin@example.com',
            'password' => 'test-password',
        ]);

        $response = $this->actingAs($admin, 'admin')
            ->get(route('admin.projects.index'));

        $response->assertOk();
    }
}
