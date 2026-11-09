<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_admin_projects(): void
    {
        $response = $this->get(route('admin.projects.index'));

        $response->assertRedirect(route('admin.login'));
    }
}