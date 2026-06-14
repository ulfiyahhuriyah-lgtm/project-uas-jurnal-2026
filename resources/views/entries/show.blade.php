<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $entry->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=EB+Garamond:ital@0;1&display=swap');
        body { font-family: 'EB Garamond', Georgia, serif; }
    </style>
</head>
<body class="bg-[#1a1a1a] min-h-screen">

<nav class="bg-[#111] px-6 py-4 flex justify-between items-center border-b border-[#2a2a2a]">
    <a href="{{ route('entries.index') }}" class="text-[#aaa] text-sm hover:text-white font-sans">← Kembali</a>
    <div class="text-white font-bold text-sm tracking-widest font-sans">JURNAL</div>
    <div class="flex gap-3">
        <a href="{{ route('entries.edit', $entry) }}"
            class="bg-[#333] text-[#aaa] text-xs px-4 py-2 rounded-full hover:bg-[#444] font-sans">Edit</a>
        <form method="POST" action="{{ route('entries.destroy', $entry) }}">
            @csrf @method('DELETE')
            <button class="bg-red-900 text-red-300 text-xs px-4 py-2 rounded-full hover:bg-red-800 font-sans"
                onclick="return confirm('Hapus jurnal ini?')">Hapus</button>
        </form>
    </div>
</nav>

<div class="max-w-2xl mx-auto px-6 py-8">
    {{-- Buku --}}
    <div class="bg-[#2a2a2a] rounded-2xl overflow-hidden shadow-2xl">
        <div class="h-3 w-full" style="background: linear-gradient(90deg, #f5c842, #e06090, #7eb8f7)"></div>

        <div class="p-8">
            {{-- Header --}}
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h1 class="text-white text-3xl font-normal italic mb-2">{{ $entry->title }}</h1>
                    <p class="text-[#555] text-sm font-sans">
                        📅 {{ \Carbon\Carbon::parse($entry->entry_date)->format('d F Y') }}
                        @if($entry->category)
                            • <span style="color: {{ $entry->category->color }}">{{ $entry->category->name }}</span>
                        @endif
                    </p>
                </div>
                <span class="text-4xl">
                    @if($entry->mood == 'happy') 😊
                    @elseif($entry->mood == 'neutral') 😐
                    @elseif($entry->mood == 'sad') 😢
                    @elseif($entry->mood == 'angry') 😡
                    @elseif($entry->mood == 'sleepy') 😴
                    @elseif($entry->mood == 'frustrated') 😤
                    @endif
                </span>
            </div>

            {{-- Foto --}}
            @if($entry->image_path)
               <img src="{{ asset('storage/' . $entry->image_path) }}"
                    class="rounded-xl mb-6 w-full max-h-64 object-cover">
            @endif

            {{-- Divider --}}
            <div class="border-t border-[#333] mb-6"></div>

            {{-- Isi --}}
            <div class="text-[#ccc] text-lg leading-relaxed whitespace-pre-line">
                {{ $entry->content }}
            </div>
        </div>
    </div>
</div>

</body>
</html>