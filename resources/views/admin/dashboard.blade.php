<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Sunil Ratoki</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-950 text-white min-h-screen">

    <!-- Navigation -->
    <nav class="bg-gray-900 border-b border-gray-800 px-6 md:px-8 py-5 flex justify-between items-center">

        <h1 class="text-xl font-bold">
            Sunil Ratoki <span class="text-cyan-400">| Admin</span>
        </h1>

        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button class="bg-red-600 hover:bg-red-700 px-5 py-2 rounded-lg transition">
                Logout
            </button>
        </form>

    </nav>

    <main class="max-w-7xl mx-auto px-6 py-12">

        <!-- Welcome -->
        <h2 class="text-3xl font-bold mb-2">
            Welcome, Sunil!
        </h2>

        <p class="text-gray-400 mb-10">
            Manage your personal portfolio website.
        </p>

        <!-- Statistics -->
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- Total Messages -->
            <div class="bg-gray-900 border border-gray-800 p-6 rounded-xl">
                <p class="text-gray-400">Total Messages</p>

                <h3 class="text-4xl font-bold mt-3">
                    {{ $totalMessages }}
                </h3>
            </div>

            <!-- Unread Messages -->
            <div class="bg-gray-900 border border-gray-800 p-6 rounded-xl">
                <p class="text-gray-400">Unread Messages</p>

                <h3 class="text-4xl font-bold text-yellow-400 mt-3">
                    {{ $unreadMessages }}
                </h3>
            </div>

            <!-- Total Projects -->
            <div class="bg-gray-900 border border-gray-800 p-6 rounded-xl">
                <p class="text-gray-400">Total Projects</p>

                <h3 class="text-4xl font-bold text-cyan-400 mt-3">
                    {{ $totalProjects }}
                </h3>
            </div>

            <!-- Published Projects -->
            <div class="bg-gray-900 border border-gray-800 p-6 rounded-xl">
                <p class="text-gray-400">Published Projects</p>

                <h3 class="text-4xl font-bold text-green-400 mt-3">
                    {{ $publishedProjects }}
                </h3>
            </div>

            <!-- Draft Projects -->
            <div class="bg-gray-900 border border-gray-800 p-6 rounded-xl">
                <p class="text-gray-400">Draft Projects</p>

                <h3 class="text-4xl font-bold text-purple-400 mt-3">
                    {{ $draftProjects }}
                </h3>
            </div>

            <!-- Website Status -->
            <div class="bg-gray-900 border border-gray-800 p-6 rounded-xl">
                <p class="text-gray-400">Website Status</p>

                <h3 class="text-2xl font-bold text-green-400 mt-3">
                    Online
                </h3>
            </div>

        </div>

        <!-- Quick Actions -->
        <div class="mt-10 bg-gray-900 border border-gray-800 rounded-xl p-8">

            <h3 class="text-xl font-bold mb-3">
                Admin Panel
            </h3>

            <p class="text-gray-400 mb-6">
                Manage your portfolio projects and contact messages from here.
            </p>

            <div class="flex flex-wrap gap-4">

                <a href="{{ route('admin.messages') }}"
                    class="bg-cyan-500 hover:bg-cyan-400 text-gray-950 px-6 py-3 rounded-lg font-semibold transition">
                    Manage Messages →
                </a>

                <a href="{{ route('admin.projects.index') }}"
                    class="bg-gray-800 hover:bg-gray-700 border border-gray-700 px-6 py-3 rounded-lg font-semibold transition">
                    Manage Projects →
                </a>

            </div>

        </div>
        <!-- Recent Messages -->
        <div class="mt-10 bg-gray-900 border border-gray-800 rounded-xl p-8">

            <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                <div>
                    <h3 class="text-xl font-bold">Recent Messages</h3>
                    <p class="text-gray-400 text-sm mt-1">
                        Your latest 5 contact messages.
                    </p>
                </div>

                <a href="{{ route('admin.messages') }}" class="text-cyan-400 hover:text-cyan-300 text-sm font-semibold">
                    View All Messages →
                </a>
            </div>

            @forelse ($recentMessages as $message)
                <div
                    class="flex flex-col sm:flex-row sm:items-center justify-between gap-4
                    border-b border-gray-800 py-4 last:border-0">

                    <div class="min-w-0">

                        <div class="flex flex-wrap items-center gap-2">

                            <p class="font-semibold">
                                {{ $message->name }}
                            </p>

                            @if (!$message->is_read)
                                <span
                                    class="text-xs bg-yellow-500/10 text-yellow-400
                                     border border-yellow-500/20 px-2 py-1 rounded-full">
                                    Unread
                                </span>
                            @else
                                <span
                                    class="text-xs bg-green-500/10 text-green-400
                                     border border-green-500/20 px-2 py-1 rounded-full">
                                    Read
                                </span>
                            @endif

                        </div>

                        <p class="text-gray-400 text-sm mt-1 truncate">
                            {{ $message->subject }}
                        </p>

                        <p class="text-gray-500 text-xs mt-2">
                            {{ $message->created_at->format('M d, Y • h:i A') }}
                        </p>

                    </div>

                    <a href="{{ route('admin.messages.show', $message) }}"
                        class="shrink-0 text-cyan-400 hover:text-cyan-300 text-sm font-medium">
                        View Message →
                    </a>

                </div>

            @empty

                <div class="text-center py-8">
                    <p class="text-gray-400">
                        No messages received yet.
                    </p>
                </div>
            @endforelse

        </div>


        <!-- Footer -->
        <footer class="text-center text-gray-500 mt-16 text-sm">
            © {{ date('Y') }} Sunil Ratoki. All rights reserved.
        </footer>

    </main>

</body>

</html>
