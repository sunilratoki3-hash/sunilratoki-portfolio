<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicProjectsTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_projects_page_only_displays_published_projects(): void
    {
        Project::create([
            'title' => 'Published Test Project',
            'slug' => 'published-test-project',
            'description' => 'This project should be visible.',
            'technologies' => ['Laravel', 'PHP'],
            'is_featured' => false,
            'is_published' => true,
        ]);

        Project::create([
            'title' => 'Draft Secret Project',
            'slug' => 'draft-secret-project',
            'description' => 'This project should remain hidden.',
            'technologies' => ['PHP'],
            'is_featured' => false,
            'is_published' => false,
        ]);

        $response = $this->get('/projects');

        $response->assertOk();
        $response->assertSee('Published Test Project');
        $response->assertDontSee('Draft Secret Project');
    }
}