<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jurnal Saya</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#1a1a1a] min-h-screen" style="font-family: 'Georgia', serif;">

<nav class="bg-[#111] px-6 py-4 flex justify-between items-center border-b border-[#2a2a2a]">
    <div class="text-white font-bold text-lg tracking-widest">DASHBOARD</div>
    <div class="flex items-center gap-4">
        <a href="{{ route('categories.index') }}" class="text-[#aaa] text-sm hover:text-white">Kategori</a>
        <div class="relative group">
            <div class="w-9 h-9 rounded-full bg-[#4ade80] flex items-center justify-center text-black font-bold text-sm cursor-pointer">
                {{ substr(auth()->user()->name, 0, 1) }}
            </div>
            <div class="absolute right-0 top-10 bg-[#222] rounded-xl shadow-lg p-4 w-44 hidden group-hover:block z-10">
                <p class="text-white text-sm font-medium">{{ auth()->user()->name }}</p>
                <p class="text-[#666] text-xs mb-3">{{ auth()->user()->email }}</p>
                <a href="{{ route('profile.edit') }}" class="block text-[#aaa] text-sm hover:text-white mb-2">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-[#aaa] text-sm hover:text-red-400">Log Out</button>
                </form>
            </div>
        </div>
    </div>
</nav>

<div class="max-w-5xl mx-auto px-6 py-8">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-white text-2xl">my jurnal</h1>
        <div class="flex gap-3 items-center">
            <form method="GET" action="{{ route('entries.index') }}">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="cari jurnal....."
                    class="bg-[#2a2a2a] text-[#aaa] text-sm rounded-full px-4 py-2 outline-none border border-[#333]">
            </form>
            <a href="{{ route('entries.create') }}"
                class="bg-[#4ade80] text-black text-sm font-medium rounded-full px-5 py-2">
                + Tulis
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-900 text-green-300 rounded-xl px-4 py-3 text-sm mb-6">
            {{ session('success') }}
        </div>
    @endif

    {{-- Kategori/Folder --}}
    <div class="mb-8">
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
                $categories = \App\Models\Category::where('user_id', auth()->id())->get();
                $i = 0;
            @endphp

            @foreach($categories as $cat)
            <a href="{{ route('entries.index', ['category' => $cat->id]) }}"
                class="bg-[#2a2a2a] rounded-2xl p-4 cursor-pointer hover:bg-[#333] transition">
                <div class="w-full rounded-xl mb-3 flex items-center justify-center text-xs font-bold tracking-widest"
                    style="background: {{ $colors[$i % count($colors)] }}; aspect-ratio: 3/4; color: rgba(0,0,0,0.5);">
                    NOTES
                </div>
                <div class="text-[#ccc] text-sm font-medium">{{ $cat->name }}</div>
                <div class="text-[#555] text-xs">{{ $cat->entries()->count() }} jurnal</div>
            </a>
            @php $i++; @endphp
            @endforeach

            {{-- Tombol folder baru --}}
            <a href="{{ route('categories.create') }}"
                class="bg-[#222] rounded-2xl p-4 cursor-pointer border-2 border-dashed border-[#444] hover:border-[#4ade80] transition flex flex-col items-center justify-center min-h-[160px]">
                <div class="text-[#444] text-4xl mb-2">+</div>
                <div class="text-[#555] text-xs">Folder Baru</div>
            </a>
        </div>
    </div>

    {{-- Jurnal Terbaru --}}
    <div>
        <p class="text-[#555] text-xs tracking-widest mb-4">JURNAL TERBARU</p>
        <div class="grid grid-cols-2 gap-4">
            @forelse($entries as $entry)
            <div class="bg-[#2a2a2a] rounded-2xl p-5 hover:bg-[#333] transition">
                <div class="flex justify-between items-start mb-2">
                    <a href="{{ route('entries.show', $entry) }}"
                        class="text-white text-base font-medium hover:underline">
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
                <p class="text-[#555] text-xs mb-2">{{ $entry->entry_date }}</p>
                <p class="text-[#777] text-sm line-clamp-2">{{ Str::limit($entry->content, 80) }}</p>
                @if($entry->category)
                <span class="inline-block bg-[#333] text-[#888] text-xs px-3 py-1 rounded-full mt-3">
                    {{ $entry->category->name }}
                </span>
                @endif
                <div class="flex gap-3 mt-3">
                    <a href="{{ route('entries.edit', $entry) }}" class="text-yellow-500 text-xs">Edit</a>
                    <form method="POST" action="{{ route('entries.destroy', $entry) }}">
                        @csrf @method('DELETE')
                        <button class="text-red-500 text-xs"
                            onclick="return confirm('Hapus jurnal ini?')">Hapus</button>
                    </form>
                </div>
            </div>
            @empty
            <div class="col-span-2 text-center text-[#555] py-12">
                Belum ada jurnal. Yuk tulis sekarang! 📓
            </div>
            @endforelse
        </div>
    </div>
</div>

</body>
</html>