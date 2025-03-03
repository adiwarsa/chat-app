<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center h-screen bg-gray-100">
    <div class="w-full max-w-sm p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center">Login</h2>
        <form action="{{ route('login') }}" method="POST" class="mt-4">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium">Email</label>
                <input type="email" name="email" class="w-full p-2 border rounded-md @error('email') border-red-500 @enderror" required value="{{ old('email') }}">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium">Password</label>
                <input type="password" name="password" class="w-full p-2 border rounded-md" required>
            </div>
            <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700">Login</button>
        </form>
    </div>
</body>
</html>
