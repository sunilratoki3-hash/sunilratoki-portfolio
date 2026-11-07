<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Projects | Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gray-950 text-white">

    <div class="max-w-7xl mx-auto px-6 py-10">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-10">
            <div>
                <p class="text-sm text-cyan-400 font-medium mb-2">ADMIN PANEL</p>
                <h1 class="text-3xl font-bold">Manage Projects</h1>
                <p class="text-gray-400 mt-2">Create, update and manage your portfolio projects.</p>
            </div>

            <a href="{{ route('admin.projects.create') }}"
                class="inline-flex items-center justify-center px-5 py-3 rounded-xl bg-cyan-500 hover:bg-cyan-400 text-gray-950 font-semibold transition">
                + Add New Project
            </a>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="mb-6 rounded-xl border border-green-500/30 bg-green-500/10 px-5 py-4 text-green-400">
                {{ session('success') }}
            </div>
        @endif

        <!-- Project Count -->
        <div class="mb-6 rounded-2xl border border-white/10 bg-white/5 p-5">
            <p class="text-sm text-gray-400">Total Projects</p>
            <h2 class="text-3xl font-bold mt-1">{{ $projects->total() }}</h2>
        </div>

        <!-- Projects Table -->
        <div class="overflow-x-auto rounded-2xl border border-white/10 bg-gray-900">

            <table class="w-full text-left">

                <thead class="bg-white/5 text-gray-400 text-sm uppercase">
                    <tr>
                        <th class="px-6 py-4">Project</th>
                        <th class="px-6 py-4">Technologies</th>
                        <th class="px-6 py-4">Featured</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-white/10">

                    @forelse($projects as $project)

                        <tr class="hover:bg-white/3 transition">

                            <!-- Project Details -->
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-4 min-w-64">

                                    @if ($project->image)
                                        <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}"
                                            class="w-16 h-12 rounded-lg object-cover">
                                    @else
                                        <div
                                            class="w-16 h-12 rounded-lg bg-gray-800 flex items-center justify-center text-gray-500">
                                            No Image
                                        </div>
                                    @endif

                                    <div>
                                        <h3 class="font-semibold">{{ $project->title }}</h3>
                                        <p class="text-xs text-gray-500 mt-1">
                                            {{ $project->slug }}
                                        </p>
                                    </div>

                                </div>
                            </td>

                            <!-- Technologies -->
                            <td class="px-6 py-5">
                                <div class="flex flex-wrap gap-2 max-w-xs">
                                    @forelse($project->technologies ?? [] as $technology)
                                        <span class="px-2 py-1 rounded-md bg-cyan-500/10 text-cyan-400 text-xs">
                                            {{ $technology }}
                                        </span>
                                    @empty
                                        <span class="text-gray-500 text-sm">Not specified</span>
                                    @endforelse
                                </div>
                            </td>

                            <!-- Featured -->
                            <td class="px-6 py-5">
                                @if ($project->is_featured)
                                    <span class="text-yellow-400 text-sm">★ Featured</span>
                                @else
                                    <span class="text-gray-500 text-sm">No</span>
                                @endif
                            </td>

                            <!-- Published Status -->
                            <td class="px-6 py-5">
                                @if ($project->is_published)
                                    <span class="px-3 py-1 rounded-full bg-green-500/10 text-green-400 text-xs">
                                        Published
                                    </span>
                                @else
                                    <span class="px-3 py-1 rounded-full bg-gray-700 text-gray-300 text-xs">
                                        Draft
                                    </span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-5">
                                <div class="flex items-center justify-end gap-3">

                                    <a href="{{ route('admin.projects.edit', $project) }}"
                                        class="text-cyan-400 hover:text-cyan-300 text-sm font-medium">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.projects.destroy', $project) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this project?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="text-red-400 hover:text-red-300 text-sm font-medium">
                                            Delete
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center">
                                <h3 class="text-xl font-semibold text-gray-300">
                                    No projects yet
                                </h3>
                                <p class="text-gray-500 mt-2">
                                    Start building your portfolio by adding your first project.
                                </p>
                                <a href="{{ route('admin.projects.create') }}"
                                    class="inline-block mt-5 px-5 py-3 rounded-xl bg-cyan-500 text-gray-950 font-semibold hover:bg-cyan-400 transition">
                                    Add Your First Project
                                </a>
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $projects->links() }}
        </div>

        <!-- Back to Dashboard -->
        <div class="mt-8">
            <a href="{{ route('admin.dashboard') }}" class="text-gray-400 hover:text-white transition text-sm">
                ← Back to Dashboard
            </a>
        </div>

    </div>

</body>

</html>
