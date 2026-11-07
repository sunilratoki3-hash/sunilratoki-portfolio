<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Sunil Ratoki</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gray-950 flex items-center justify-center px-4">

    <div class="w-full max-w-md bg-gray-900 border border-gray-800 rounded-2xl p-8 shadow-2xl">

        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-white">Welcome Back!</h1>
            <p class="text-gray-400 mt-2">Sign in to your admin dashboard</p>
        </div>

        @if (session('error'))
            <div class="bg-red-500/10 border border-red-500 text-red-400 p-3 rounded-lg mb-5">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-500/10 border border-red-500 text-red-400 p-3 rounded-lg mb-5">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST">

            @csrf

            <div class="mb-5">
                <label class="block text-gray-300 mb-2">Email Address</label>

                <input type="email" name="email" value="{{ old('email') }}" placeholder="admin@example.com"
                    required
                    class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-white focus:outline-none focus:border-blue-500">
            </div>

            <div class="mb-6">
                <label class="block text-gray-300 mb-2">Password</label>

                <input type="password" name="password" placeholder="Enter your password" required
                    class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-white focus:outline-none focus:border-blue-500">
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition duration-300">
                Login to Dashboard
            </button>

        </form>

        <p class="text-center text-gray-500 text-sm mt-8">
            &copy; {{ date('Y') }} Sunil Ratoki. All rights reserved.
        </p>

        <div class="text-center mt-4">
            <a href="{{ route('home') }}" class="text-blue-400 hover:text-blue-300 text-sm">
                ← Back to Website
            </a>
        </div>

    </div>

</body>

</html>
