<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Jurnal 2026</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=EB+Garamond:ital@0;1&display=swap');
        body { font-family: 'EB Garamond', Georgia, serif; }
    </style>
</head>
<body class="bg-[#2d2d2d] min-h-screen flex flex-col items-center justify-center">
    <h1 class="text-white text-5xl mb-8 font-normal italic">Register</h1>
    
    <div class="bg-[#c8c8c8] rounded-2xl px-10 py-10 w-full max-w-lg">
        @if ($errors->any())
            <div class="bg-red-100 border border-red-300 text-red-600 rounded-xl px-4 py-3 text-sm mb-4 font-sans">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-3">
                <input type="text" name="name" placeholder="Nama"
                    value="{{ old('name') }}" required autofocus
                    class="w-full bg-[#555] border-l-4 border-[#888] rounded-full px-5 py-3 text-white text-sm placeholder-[#bbb] outline-none font-sans">
            </div>
            <div class="mb-3">
                <input type="email" name="email" placeholder="Email"
                    value="{{ old('email') }}" required
                    class="w-full bg-[#555] border-l-4 border-[#888] rounded-full px-5 py-3 text-white text-sm placeholder-[#bbb] outline-none font-sans">
            </div>
            <div class="mb-3">
                <input type="password" name="password" placeholder="Password" required
                    class="w-full bg-[#555] border-l-4 border-[#888] rounded-full px-5 py-3 text-white text-sm placeholder-[#bbb] outline-none font-sans">
            </div>
            <div class="mb-8">
                <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required
                    class="w-full bg-[#555] border-l-4 border-[#888] rounded-full px-5 py-3 text-white text-sm placeholder-[#bbb] outline-none font-sans">
            </div>
            <div class="flex justify-center mb-4">
                <button type="submit"
                    class="bg-[#555] text-white rounded-full px-16 py-3 text-sm tracking-widest hover:bg-[#444] font-sans">
                    LANJUT
                </button>
            </div>
            <div class="text-center text-[#555] text-sm font-sans">
                Sudah punya akun? <a href="{{ route('login') }}" class="text-[#333] font-bold">Login</a>
            </div>
        </form>
    </div>
</body>
</html>