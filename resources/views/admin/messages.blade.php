<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Inbox | Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-950 text-white min-h-screen">

    <div class="max-w-7xl mx-auto px-5 py-10">

        <!-- Header -->
        <div class="flex flex-wrap justify-between items-center gap-4 mb-10">
            <div>
                <p class="text-blue-400 text-sm font-semibold tracking-widest uppercase">
                    Administration
                </p>
                <h1 class="text-3xl md:text-4xl font-bold mt-2">
                    Message Inbox
                </h1>
                <p class="text-slate-400 mt-2">
                    Manage messages received through your portfolio website.
                </p>
            </div>

            <a href="{{ route('admin.dashboard') }}"
                class="px-5 py-3 rounded-xl bg-slate-800 hover:bg-slate-700 transition">
                ← Dashboard
            </a>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="mb-6 p-4 rounded-xl bg-green-500/10 border border-green-500/30 text-green-400">
                {{ session('success') }}
            </div>
        @endif

        <!-- Message Count -->
        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 mb-6">
            <p class="text-slate-400 text-sm">Total Messages</p>
            <h2 class="text-3xl font-bold mt-2">
                {{ $messages->total() }}
            </h2>
        </div>

        <!-- Search and Filter -->
        <form action="{{ route('admin.messages') }}" method="GET"
            class="bg-slate-900 border border-slate-800 rounded-2xl p-5 mb-6">

            <div class="grid md:grid-cols-3 gap-4">

                <div class="md:col-span-2">
                    <label for="search" class="block text-sm text-slate-400 mb-2">
                        Search messages
                    </label>

                    <input type="text" name="search" id="search" value="{{ $search }}"
                        placeholder="Search name, email or subject..."
                        class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-blue-500">
                </div>

                <div>
                    <label for="status" class="block text-sm text-slate-400 mb-2">
                        Filter by status
                    </label>

                    <select name="status" id="status"
                        class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-blue-500">
                        <option value="all" {{ $status === 'all' ? 'selected' : '' }}>
                            All Messages
                        </option>

                        <option value="unread" {{ $status === 'unread' ? 'selected' : '' }}>
                            Unread Only
                        </option>

                        <option value="read" {{ $status === 'read' ? 'selected' : '' }}>
                            Read Only
                        </option>
                    </select>
                </div>

            </div>

            <div class="flex gap-3 mt-4">
                <button type="submit" class="px-5 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 transition">
                    Search
                </button>

                <a href="{{ route('admin.messages') }}"
                    class="px-5 py-2 rounded-lg bg-slate-700 hover:bg-slate-600 transition">
                    Clear
                </a>
            </div>

        </form>

        <!-- Inbox -->
        <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden">

            <div class="p-6 border-b border-slate-800">
                <h2 class="text-xl font-semibold">All Messages</h2>
            </div>

            @forelse($messages as $message)
                <div class="p-6 border-b border-slate-800 hover:bg-slate-800/40 transition">

                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-5">

                        <!-- Sender Information -->
                        <div class="flex-1 min-w-0">

                            <div class="flex flex-wrap items-center gap-3 mb-2">

                                <h3 class="font-semibold text-lg">
                                    {{ $message->name }}
                                </h3>

                                @if ($message->is_read)
                                    <span class="text-xs px-3 py-1 rounded-full bg-slate-700 text-slate-300">
                                        Read
                                    </span>
                                @else
                                    <span class="text-xs px-3 py-1 rounded-full bg-blue-500/20 text-blue-400">
                                        Unread
                                    </span>
                                @endif

                            </div>

                            <p class="text-slate-400 text-sm">
                                {{ $message->email }}
                            </p>

                            <p class="text-white font-medium mt-3">
                                {{ $message->subject }}
                            </p>

                            <p class="text-slate-400 text-sm mt-2">
                                {{ \Illuminate\Support\Str::limit($message->message, 120) }}
                            </p>

                            <p class="text-slate-500 text-xs mt-3">
                                {{ $message->created_at->format('M d, Y · h:i A') }}
                            </p>

                        </div>

                        <!-- Actions -->
                        <div class="flex flex-wrap items-center gap-2">

                            <a href="{{ route('admin.messages.show', $message) }}"
                                class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-sm transition">
                                View
                            </a>

                            @unless ($message->is_read)
                                <form action="{{ route('admin.messages.read', $message) }}" method="POST">
                                    @csrf
                                    @method('PATCH')

                                    <button type="submit"
                                        class="px-4 py-2 rounded-lg bg-slate-700 hover:bg-slate-600 text-sm transition">
                                        Mark Read
                                    </button>
                                </form>
                            @endunless

                            <form action="{{ route('admin.messages.destroy', $message) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this message?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="px-4 py-2 rounded-lg bg-red-500/10 text-red-400 hover:bg-red-500/20 text-sm transition">
                                    Delete
                                </button>
                            </form>

                        </div>

                    </div>

                </div>

            @empty

                <div class="p-12 text-center">
                    <div class="text-5xl mb-4">📭</div>
                    <h3 class="text-xl font-semibold">No messages yet</h3>
                    <p class="text-slate-400 mt-2">
                        Messages submitted through your contact form will appear here.
                    </p>
                </div>
            @endforelse

        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $messages->links() }}
        </div>

    </div>

</body>

</html>
