<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Project | Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gray-950 text-white">

    <div class="max-w-4xl mx-auto px-6 py-10">

        <!-- Header -->
        <div class="mb-8">
            <a href="{{ route('admin.projects.index') }}" class="text-gray-400 hover:text-cyan-400 text-sm">
                ← Back to Projects
            </a>

            <p class="text-sm text-cyan-400 font-medium mt-6 mb-2">
                ADMIN PANEL
            </p>

            <h1 class="text-3xl font-bold">Add New Project</h1>

            <p class="text-gray-400 mt-2">
                Add a new project to your portfolio.
            </p>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data"
            class="space-y-6 rounded-2xl border border-white/10 bg-gray-900 p-6 sm:p-8">

            @csrf

            <!-- Title -->
            <div>
                <label class="block text-sm font-medium mb-2">
                    Project Title *
                </label>

                <input type="text" name="title" value="{{ old('title') }}"
                    placeholder="e.g. Personal Portfolio Website" required
                    class="w-full rounded-xl border border-white/10 bg-gray-950 px-4 py-3 text-white outline-none focus:border-cyan-400">

                @error('title')
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-medium mb-2">
                    Project Description *
                </label>

                <textarea name="description" rows="5" required placeholder="Describe your project..."
                    class="w-full rounded-xl border border-white/10 bg-gray-950 px-4 py-3 text-white outline-none focus:border-cyan-400">{{ old('description') }}</textarea>

                @error('description')
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Image -->
            <div>
                <label class="block text-sm font-medium mb-2">
                    Project Image
                </label>

                <input type="file" name="image" accept=".jpg,.jpeg,.png,.webp"
                    class="w-full rounded-xl border border-white/10 bg-gray-950 px-4 py-3 text-gray-300">

                <p class="text-gray-500 text-xs mt-2">
                    JPG, JPEG, PNG or WEBP. Maximum size: 2MB.
                </p>

                @error('image')
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- GitHub URL -->
            <div>
                <label class="block text-sm font-medium mb-2">
                    GitHub Repository URL
                </label>

                <input type="url" name="github_url" value="{{ old('github_url') }}"
                    placeholder="https://github.com/username/project"
                    class="w-full rounded-xl border border-white/10 bg-gray-950 px-4 py-3 text-white outline-none focus:border-cyan-400">

                @error('github_url')
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Live URL -->
            <div>
                <label class="block text-sm font-medium mb-2">
                    Live Demo URL
                </label>

                <input type="url" name="live_url" value="{{ old('live_url') }}" placeholder="https://example.com"
                    class="w-full rounded-xl border border-white/10 bg-gray-950 px-4 py-3 text-white outline-none focus:border-cyan-400">

                @error('live_url')
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Technologies -->
            <div>
                <label class="block text-sm font-medium mb-2">
                    Technologies
                </label>

                <input type="text" name="technologies" value="{{ old('technologies') }}"
                    placeholder="Laravel, PHP, MySQL, Tailwind CSS"
                    class="w-full rounded-xl border border-white/10 bg-gray-950 px-4 py-3 text-white outline-none focus:border-cyan-400">

                <p class="text-gray-500 text-xs mt-2">
                    Separate technologies using commas.
                </p>

                @error('technologies')
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Options -->
            <div class="grid sm:grid-cols-2 gap-4">

                <label class="flex items-center gap-3 rounded-xl border border-white/10 bg-gray-950 p-4 cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured'))
                        class="w-4 h-4 accent-cyan-400">

                    <span>
                        <span class="block font-medium">Featured Project</span>
                        <span class="text-xs text-gray-500">Highlight this project</span>
                    </span>
                </label>

                <label class="flex items-center gap-3 rounded-xl border border-white/10 bg-gray-950 p-4 cursor-pointer">
                    <input type="checkbox" name="is_published" value="1" @checked(old('is_published', true))
                        class="w-4 h-4 accent-cyan-400">

                    <span>
                        <span class="block font-medium">Publish Project</span>
                        <span class="text-xs text-gray-500">Make it available publicly</span>
                    </span>
                </label>

            </div>

            <!-- Submit -->
            <div class="flex flex-col sm:flex-row gap-3 pt-4">

                <button type="submit"
                    class="px-6 py-3 rounded-xl bg-cyan-500 hover:bg-cyan-400 text-gray-950 font-semibold transition">
                    Save Project
                </button>

                <a href="{{ route('admin.projects.index') }}"
                    class="px-6 py-3 rounded-xl border border-white/10 hover:bg-white/5 text-center transition">
                    Cancel
                </a>

            </div>

        </form>

    </div>

</body>

</html>
