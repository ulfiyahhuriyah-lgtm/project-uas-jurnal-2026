<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $category->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=EB+Garamond:ital@0;1&display=swap');
        body { font-family: 'EB Garamond', Georgia, serif; }
    </style>
</head>
<body class="bg-[#1a1a1a] min-h-screen">

<nav class="bg-[#111] px-6 py-4 flex justify-between items-center border-b border-[#2a2a2a]">
    <a href="{{ route('entries.index') }}" class="text-[#aaa] text-sm hover:text-white font-sans">← Kembali</a>
    <div class="text-white font-bold text-sm tracking-widest font-sans">{{ strtoupper($category->name) }}</div>
    <a href="{{ route('entries.create') }}"
        class="bg-[#4ade80] text-black text-xs font-medium rounded-full px-4 py-2 font-sans">
        + Tulis
    </a>
</nav>

<div class="max-w-4xl mx-auto px-6 py-8">

    {{-- Cover Buku --}}
    <div class="rounded-2xl overflow-hidden mb-8 shadow-2xl"
        style="background: {{ $color }}">
        <div class="p-8 text-center">
            <p class="text-xs tracking-widest opacity-50 mb-2 font-sans">NOTES</p>
            <h1 class="text-4xl font-normal italic opacity-80">{{ $category->name }}</h1>
            <p class="text-sm opacity-50 mt-2 font-sans">{{ $entries->count() }} jurnal</p>
        </div>
    </div>

    {{-- List Jurnal --}}
    @if($entries->isEmpty())
        <div class="text-center text-[#555] py-12">
            <div class="text-5xl mb-4">📭</div>
            <p>Belum ada jurnal di kategori ini.</p>
            <a href="{{ route('entries.create') }}" class="text-[#4ade80] text-sm mt-2 inline-block font-sans">Tulis sekarang →</a>
        </div>
    @else
        <div class="space-y-4">
            @foreach($entries as $entry)
            <div class="bg-[#2a2a2a] rounded-2xl p-5 hover:bg-[#333] transition">
                <div class="flex justify-between items-start mb-2">
                    <a href="{{ route('entries.show', $entry) }}"
                        class="text-white text-lg italic hover:underline">
                        {{ $entry->title }}
                    </a>
                    <span class="text-xl ml-2">
                        @if($entry->mood == 'happy') 😊
                        @elseif($entry->mood == 'neutral') 😐
                        @elseif($entry->mood == 'sad') 😢
                        @elseif($entry->mood == 'angry') 😡
                        @elseif($entry->mood == 'sleepy') 😴
                        @elseif($entry->mood == 'frustrated') 😤
                        @endif
                    </span>
                </div>
                <p class="text-[#555] text-xs mb-2 font-sans">
                    📅 {{ \Carbon\Carbon::parse($entry->entry_date)->format('d F Y') }}
                </p>
                <p class="text-[#777] text-sm">{{ Str::limit($entry->content, 100) }}</p>
                <div class="mt-3">
                <a href="{{ route('entries.show', $entry) }}" class="text-[#4ade80] text-xs font-sans">Baca selengkapnya →</a>
            </div>
            </div>
            @endforeach
        </div>
    @endif
</div>

</body>
</html>