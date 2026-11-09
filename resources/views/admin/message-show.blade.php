<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Details | Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-950 text-white min-h-screen">

    <div class="max-w-4xl mx-auto px-5 py-10">

        <a href="{{ route('admin.messages') }}" class="text-blue-400 hover:text-blue-300">
            ← Back to Inbox
        </a>

        <div class="mt-8 bg-slate-900 border border-slate-800 rounded-2xl p-6 md:p-10">

            <div class="flex justify-between items-start gap-4 flex-wrap">
                <div>
                    <p class="text-blue-400 text-sm uppercase tracking-widest">
                        Message Details
                    </p>

                    <h1 class="text-3xl font-bold mt-2">
                        {{ $message->subject }}
                    </h1>
                </div>

                @if ($message->is_read)
    <span class="px-3 py-1 rounded-full bg-green-500/10 text-green-400 text-sm">
        Read
    </span>
@else
    <span class="px-3 py-1 rounded-full bg-yellow-500/10 text-yellow-400 text-sm">
        Unread
    </span>
@endif
            </div>

            <div class="border-t border-slate-800 my-8"></div>

            <div class="grid md:grid-cols-2 gap-6">

                <div>
                    <p class="text-slate-500 text-sm">Sender Name</p>
                    <p class="font-medium mt-1">{{ $message->name }}</p>
                </div>

                <div>
                    <p class="text-slate-500 text-sm">Email Address</p>
                    <a href="mailto:{{ $message->email }}" class="text-blue-400 hover:underline mt-1 inline-block">
                        {{ $message->email }}
                    </a>
                </div>

                <div>
                    <p class="text-slate-500 text-sm">Phone</p>
                    <p class="mt-1">{{ $message->phone ?: 'Not provided' }}</p>
                </div>

                <div>
                    <p class="text-slate-500 text-sm">Address</p>
                    <p class="mt-1">{{ $message->address ?: 'Not provided' }}</p>
                </div>

                <div>
                    <p class="text-slate-500 text-sm">Received On</p>
                    <p class="mt-1">
                        {{ $message->created_at->format('M d, Y · h:i A') }}
                    </p>
                </div>

            </div>

            <div class="border-t border-slate-800 my-8"></div>

            <div>
                <h2 class="text-lg font-semibold mb-4">Full Message</h2>

                <div
                    class="bg-slate-950 border border-slate-800 rounded-xl p-6 text-slate-300 leading-7 whitespace-pre-wrap wrap-break-word">
                    {{ $message->message }}</div>
            </div>

            <div class="mt-8 flex flex-wrap gap-3">

                <a href="mailto:{{ $message->email }}?subject={{ rawurlencode('Re: ' . $message->subject) }}"
                    class="px-5 py-3 bg-blue-600 hover:bg-blue-700 rounded-xl transition">
@if (!$message->is_read)
    <form action="{{ route('admin.messages.read', $message) }}" method="POST">
        @csrf
        @method('PATCH')

        <button type="submit"
            class="px-5 py-3 bg-green-500/10 text-green-400 hover:bg-green-500/20 rounded-xl transition">
            Mark as Read
        </button>
    </form>
@endif
                    Reply via Email
                </a>

                <form action="{{ route('admin.messages.destroy', $message) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this message?')">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                        class="px-5 py-3 bg-red-500/10 text-red-400 hover:bg-red-500/20 rounded-xl transition">
                        Delete Message
                    </button>
                </form>

            </div>

        </div>

    </div>

</body>

</html>
