<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display all projects in admin panel.
     */
    public function index()
    {
        $projects = Project::latest()->paginate(10);

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show project creation form.
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created project.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:5000',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'github_url' => 'nullable|url|max:255',
            'live_url' => 'nullable|url|max:255',
            'technologies' => 'nullable|string|max:1000',
        ]);

        // Generate unique slug
        $baseSlug = Str::slug($validated['title']) ?: 'project';
        $slug = $baseSlug;
        $counter = 2;

        while (Project::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter++;
        }

        $validated['slug'] = $slug;

        // Convert technologies into an array
        $validated['technologies'] = collect(
            explode(',', $validated['technologies'] ?? '')
        )
            ->map(fn($technology) => trim($technology))
            ->filter()
            ->unique()
            ->values()
            ->all();

        // Handle checkboxes
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_published'] = $request->boolean('is_published');

        // Store project image
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('projects', 'public');
        }

        Project::create($validated);

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project created successfully!');
    }

    /**
     * Show project editing form.
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update an existing project.
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:5000',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'github_url' => 'nullable|url|max:255',
            'live_url' => 'nullable|url|max:255',
            'technologies' => 'nullable|string|max:1000',
        ]);

        // Generate unique slug, excluding current project
        $baseSlug = Str::slug($validated['title']) ?: 'project';
        $slug = $baseSlug;
        $counter = 2;

        while (
            Project::where('slug', $slug)
                ->where('id', '!=', $project->id)
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter++;
        }

        $validated['slug'] = $slug;

        // Convert technologies into an array
        $validated['technologies'] = collect(
            explode(',', $validated['technologies'] ?? '')
        )
            ->map(fn($technology) => trim($technology))
            ->filter()
            ->unique()
            ->values()
            ->all();

        // Handle checkboxes
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_published'] = $request->boolean('is_published');

        // Preserve existing image
        $oldImage = $project->image;
        $newImage = null;

        // Store replacement image first
        if ($request->hasFile('image')) {
            $newImage = $request->file('image')
                ->store('projects', 'public');

            $validated['image'] = $newImage;
        } else {
            unset($validated['image']);
        }

        try {
            // Update project details
            $project->update($validated);
        } catch (\Throwable $exception) {
            // Remove newly uploaded image if update fails
            if ($newImage) {
                Storage::disk('public')->delete($newImage);
            }

            throw $exception;
        }

        // Delete old image only after successful update
        if (
            $newImage &&
            $oldImage &&
            $oldImage !== $newImage
        ) {
            Storage::disk('public')->delete($oldImage);
        }

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project updated successfully!');
    }

    /**
     * Delete a project.
     */
    public function destroy(Project $project)
    {
        $image = $project->image;

        $project->delete();

        // Delete image after successful database deletion
        if ($image) {
            Storage::disk('public')->delete($image);
        }

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project deleted successfully!');
    }
}

