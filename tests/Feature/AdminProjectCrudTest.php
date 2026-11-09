<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminProjectCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_admin_can_create_a_project(): void
    {
        $admin = Admin::create([
            'name' => 'Test Admin',
            'email' => 'admin@example.com',
            'password' => 'test-password',
        ]);

        $this->actingAs($admin, 'admin')
            ->post(route('admin.projects.store'), [
                'title' => 'Test Portfolio Project',
                'description' => 'A project created during automated testing.',
                'github_url' => 'https://github.com/example/project',
                'live_url' => 'https://example.com',
                'technologies' => 'Laravel, PHP, MySQL',
                'is_featured' => true,
                'is_published' => true,
            ]);

        $this->assertDatabaseHas('projects', [
            'title' => 'Test Portfolio Project',
            'is_published' => true,
        ]);
    }

    public function test_authenticated_admin_can_update_a_project(): void
    {
        $admin = Admin::create([
            'name' => 'Test Admin',
            'email' => 'admin@example.com',
            'password' => 'test-password',
        ]);

        $project = Project::create([
            'title' => 'Original Project',
            'slug' => 'original-project',
            'description' => 'Original description.',
            'technologies' => ['PHP'],
            'is_featured' => false,
            'is_published' => true,
        ]);

        $this->actingAs($admin, 'admin')
            ->put(route('admin.projects.update', $project), [
                'title' => 'Updated Project',
                'description' => 'Updated description.',
                'technologies' => 'Laravel, Tailwind CSS',
                'is_featured' => true,
                'is_published' => true,
            ]);

        $this->assertDatabaseHas('projects', [
            'id' => $project->id,
            'title' => 'Updated Project',
            'slug' => 'updated-project',
            'is_featured' => true,
        ]);
    }

    public function test_authenticated_admin_can_delete_a_project(): void
    {
        $admin = Admin::create([
            'name' => 'Test Admin',
            'email' => 'admin@example.com',
            'password' => 'test-password',
        ]);

        $project = Project::create([
            'title' => 'Project To Delete',
            'slug' => 'project-to-delete',
            'description' => 'This project will be deleted.',
            'technologies' => ['PHP'],
            'is_featured' => false,
            'is_published' => true,
        ]);

        $this->actingAs($admin, 'admin')
            ->delete(route('admin.projects.destroy', $project));

        $this->assertDatabaseMissing('projects', [
            'id' => $project->id,
        ]);
    }

    public function test_authenticated_admin_can_upload_a_project_image(): void
    {
        $admin = Admin::create([
            'name' => 'Test Admin',
            'email' => 'admin@example.com',
            'password' => 'test-password',
        ]);

        Storage::fake('public');

        $this->actingAs($admin, 'admin')
            ->post(route('admin.projects.store'), [
                'title' => 'Image Upload Test',
                'description' => 'Testing project image storage.',
                'image' => UploadedFile::fake()->image('portfolio-project.jpg'),
                'github_url' => 'https://github.com/example/project',
                'live_url' => 'https://example.com',
                'technologies' => 'Laravel, PHP',
                'is_featured' => false,
                'is_published' => true,
            ])
            ->assertSessionHasNoErrors();

        $project = Project::where('title', 'Image Upload Test')->firstOrFail();

        $this->assertNotNull($project->image);

        Storage::disk('public')->assertExists($project->image);
    }

    public function test_admin_can_replace_an_existing_project_image(): void
    {
        $admin = Admin::create([
            'name' => 'Test Admin',
            'email' => 'admin@example.com',
            'password' => 'test-password',
        ]);

        Storage::fake('public');

        Storage::disk('public')->put('projects/old-image.jpg', 'old image');

        $project = Project::create([
            'title' => 'Image Replacement Test',
            'slug' => 'image-replacement-test',
            'description' => 'Testing image replacement.',
            'image' => 'projects/old-image.jpg',
            'technologies' => ['Laravel'],
            'is_featured' => false,
            'is_published' => true,
        ]);

        $this->actingAs($admin, 'admin')
            ->put(route('admin.projects.update', $project), [
                'title' => 'Image Replacement Test',
                'description' => 'Testing image replacement.',
                'image' => UploadedFile::fake()->image('new-image.jpg'),
                'technologies' => 'Laravel, PHP',
                'is_featured' => false,
                'is_published' => true,
            ])
            ->assertSessionHasNoErrors();

        $project->refresh();

        $this->assertNotEquals('projects/old-image.jpg', $project->image);

        Storage::disk('public')->assertMissing('projects/old-image.jpg');
        Storage::disk('public')->assertExists($project->image);
    }

    public function test_deleting_a_project_also_deletes_its_image(): void
    {
        $admin = Admin::create([
            'name' => 'Test Admin',
            'email' => 'admin@example.com',
            'password' => 'test-password',
        ]);

        Storage::fake('public');

        Storage::disk('public')->put('projects/delete-test.jpg', 'test image');

        $project = Project::create([
            'title' => 'Project Image Deletion Test',
            'slug' => 'project-image-deletion-test',
            'description' => 'Testing project and image deletion.',
            'image' => 'projects/delete-test.jpg',
            'technologies' => ['Laravel'],
            'is_featured' => false,
            'is_published' => true,
        ]);

        $this->actingAs($admin, 'admin')
            ->delete(route('admin.projects.destroy', $project));

        $this->assertDatabaseMissing('projects', [
            'id' => $project->id,
        ]);

        Storage::disk('public')->assertMissing('projects/delete-test.jpg');
    }

    public function test_admin_cannot_upload_a_non_image_as_project_image(): void
    {
        $admin = Admin::create([
            'name' => 'Test Admin',
            'email' => 'admin@example.com',
            'password' => 'test-password',
        ]);

        $response = $this->actingAs($admin, 'admin')
            ->from(route('admin.projects.create'))
            ->post(route('admin.projects.store'), [
                'title' => 'Invalid Image Test',
                'description' => 'Testing invalid image upload.',
                'image' => UploadedFile::fake()->create(
                    'not-an-image.txt',
                    10,
                    'text/plain'
                ),
                'technologies' => 'Laravel, PHP',
                'is_featured' => false,
                'is_published' => true,
            ]);

        $response->assertSessionHasErrors('image');

        $this->assertDatabaseMissing('projects', [
            'title' => 'Invalid Image Test',
        ]);
    }
}
