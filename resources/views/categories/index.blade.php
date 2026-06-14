<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=EB+Garamond:ital@0;1&display=swap');
        body { font-family: 'EB Garamond', Georgia, serif; }
    </style>
</head>
<body class="bg-[#1a1a1a] min-h-screen">

<nav class="bg-[#111] px-6 py-4 flex justify-between items-center border-b border-[#2a2a2a]">
    <a href="{{ route('entries.index') }}" class="text-[#aaa] text-sm hover:text-white font-sans">← Kembali</a>
    <div class="text-white font-bold text-sm tracking-widest font-sans">BUKU</div>
    <a href="{{ route('categories.create') }}">
        
    </a>
</nav>

<div class="max-w-4xl mx-auto px-6 py-8">

    @if(session('success'))
        <div class="bg-green-900 text-green-300 rounded-xl px-4 py-3 text-sm mb-6 font-sans">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-4 gap-4">
        @php
            $colors = [
                'linear-gradient(135deg, #f5c842, #e8a800)',
                'linear-gradient(135deg, #f87171, #dc2626)',
                'linear-gradient(135deg, #fb923c, #ea580c)',
                'linear-gradient(135deg, #7eb8f7, #4a90d9)',
                'linear-gradient(135deg, #7ed99a, #3ab865)',
                'linear-gradient(135deg, #b8a0f0, #8060d0)',
                'linear-gradient(135deg, #f7a8c4, #e06090)',
            ];
            $i = 0;
        @endphp

        @forelse($categories as $category)
        <div class="bg-[#2a2a2a] rounded-2xl p-4">
            <a href="{{ route('categories.show', $category) }}">
                <div class="w-full rounded-xl mb-3 flex items-center justify-center text-xs font-bold tracking-widest"
                    style="background: {{ $colors[$i % count($colors)] }}; aspect-ratio: 3/4; color: rgba(0,0,0,0.5);">
                    NOTES
                </div>
            </a>
            <div class="text-[#ccc] text-sm font-medium mb-1">{{ $category->name }}</div>
            <div class="text-[#555] text-xs mb-3 font-sans">{{ $category->entries()->count() }} jurnal</div>
            <div class="flex gap-2">
                <a href="{{ route('categories.edit', $category) }}"
                    class="flex-1 text-center bg-[#333] text-[#aaa] text-xs py-1 rounded-full hover:bg-[#444] font-sans">
                    Edit
                </a>
                <form method="POST" action="{{ route('categories.destroy', $category) }}" class="flex-1">
                    @csrf @method('DELETE')
                    <button class="w-full bg-[#2a1a1a] text-red-500 text-xs py-1 rounded-full hover:bg-red-900 font-sans"
                        onclick="return confirm('Hapus kategori ini?')">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
        @php $i++; @endphp
        @empty
        <div class="col-span-4 text-center text-[#555] py-12">
            <div class="text-5xl mb-4">📁</div>
            <p>Belum ada kategori.</p>
        </div>
        @endforelse

        {{-- Tambah Folder Baru --}}
        <a href="{{ route('categories.create') }}"
            class="bg-[#222] rounded-2xl p-4 border-2 border-dashed border-[#444] hover:border-[#4ade80] transition flex flex-col items-center justify-center min-h-[160px]">
            <div class="text-[#444] text-4xl mb-2">+</div>
            <div class="text-[#555] text-xs font-sans">Folder Baru</div>
        </a>
    </div>
</div>

</body>
</html>