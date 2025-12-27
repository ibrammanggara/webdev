<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>

<body class="min-h-screen bg-slate-100 flex items-center justify-center px-4">

    <!-- CARD -->
    <div class="w-full max-w-md bg-white rounded-2xl p-8 shadow-[0_20px_60px_rgba(0,0,0,0.12)]">

        <!-- LOGO -->
        <div class="flex justify-center mb-6">
            <div class="w-14 h-14 rounded-xl bg-indigo-600 text-white flex items-center justify-center text-2xl font-bold shadow-md">
                A
            </div>
        </div>

        <!-- HEADER -->
        <div class="text-center mb-8">
            <h1 class="text-2xl font-semibold text-slate-800">
                Admin Panel
            </h1>
            <p class="text-sm text-slate-500 mt-1">
                Masuk untuk melanjutkan ke dashboard
            </p>
        </div>

        <!-- FORM -->
        <form action="{{ route('login-post') }}" method="POST" class="space-y-5">
            @csrf

            <!-- Username -->
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1">
                    Username
                </label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan username" class="w-full px-4 py-3 rounded-xl border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition @error('name') border-rose-500 @enderror" required>
                @error('name')
                    <p class="text-xs text-rose-600 mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1">
                    Password
                </label>
                <input type="password" name="password" placeholder="Masukkan password" class="w-full px-4 py-3 rounded-xl border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition @error('password') border-rose-500 @enderror" required>
                @error('password')
                    <p class="text-xs text-rose-600 mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- BUTTON -->
            <button
                type="submit"
                class="w-full py-3 rounded-xl bg-indigo-600 text-white font-medium hover:bg-indigo-700 active:scale-[0.98] transition-all shadow-md">
                Login
            </button>
        </form>

        <!-- FOOTER -->
        <div class="text-center mt-8">
            <p class="text-xs text-slate-400">
                © {{ date('Y') }} Admin System
            </p>
        </div>
    </div>

</body>
</html>
