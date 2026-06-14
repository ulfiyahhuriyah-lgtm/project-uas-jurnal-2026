<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Jurnal 2026</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#1a1a1a] min-h-screen flex items-center justify-center font-serif">
    <div class="w-full max-w-md px-6">
        <h1 class="text-white text-4xl font-normal text-center mb-8">Login</h1>
        <div class="bg-[#d4d0cb] rounded-2xl p-8">
            <div class="text-center text-5xl mb-6">📓</div>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-300 text-red-600 rounded-xl px-4 py-3 text-sm mb-4">
                    {{ $errors->first() }}
                </div>
            @endif

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <input type="email" name="email" placeholder="Email"
                        value="{{ old('email') }}" required autofocus
                        class="w-full bg-[#555] border-none rounded-full px-5 py-3 text-white text-sm placeholder-gray-300 outline-none">
                </div>
                <div class="mb-3">
                    <input type="password" name="password" placeholder="Password" required
                        class="w-full bg-[#555] border-none rounded-full px-5 py-3 text-white text-sm placeholder-gray-300 outline-none">
                </div>
                <div class="flex items-center gap-2 mb-4">
                    <input type="checkbox" name="remember" id="remember" class="w-auto">
                    <label for="remember" class="text-[#555] text-sm">Ingat saya</label>
                </div>
                <div class="text-right mb-4">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-[#666] text-xs">Lupa password?</a>
                    @endif
                </div>
                <button type="submit"
                    class="w-full bg-[#555] text-white rounded-full py-3 text-sm tracking-widest hover:bg-[#444] mb-4">
                    LANJUT
                </button>
                <div class="text-center text-[#666] text-sm">
                    Belum punya akun? <a href="{{ route('register') }}" class="text-[#333] font-bold">Daftar</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>