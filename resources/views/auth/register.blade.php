<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Jurnal 2026</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#1a1a1a] min-h-screen flex items-center justify-center font-serif">
    <div class="w-full max-w-md px-6">
        <h1 class="text-white text-4xl font-normal text-center mb-8">Register</h1>
        <div class="bg-[#d4d0cb] rounded-2xl p-8">
            <div class="text-center text-5xl mb-6">📓</div>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-300 text-red-600 rounded-xl px-4 py-3 text-sm mb-4">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-3">
                    <input type="text" name="name" placeholder="Nama"
                        value="{{ old('name') }}" required autofocus
                        class="w-full bg-[#555] border-none rounded-full px-5 py-3 text-white text-sm placeholder-gray-300 outline-none">
                </div>
                <div class="mb-3">
                    <input type="email" name="email" placeholder="Email"
                        value="{{ old('email') }}" required
                        class="w-full bg-[#555] border-none rounded-full px-5 py-3 text-white text-sm placeholder-gray-300 outline-none">
                </div>
                <div class="mb-3">
                    <input type="password" name="password" placeholder="Password" required
                        class="w-full bg-[#555] border-none rounded-full px-5 py-3 text-white text-sm placeholder-gray-300 outline-none">
                </div>
                <div class="mb-6">
                    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required
                        class="w-full bg-[#555] border-none rounded-full px-5 py-3 text-white text-sm placeholder-gray-300 outline-none">
                </div>
                <button type="submit"
                    class="w-full bg-[#555] text-white rounded-full py-3 text-sm tracking-widest hover:bg-[#444] mb-4">
                    LANJUT
                </button>
                <div class="text-center text-[#666] text-sm">
                    Sudah punya akun? <a href="{{ route('login') }}" class="text-[#333] font-bold">Login</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>