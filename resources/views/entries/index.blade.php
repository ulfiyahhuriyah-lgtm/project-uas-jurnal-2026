<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📓 Jurnal Saya
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto px-4">
        <!-- Search -->
        <form method="GET" action="{{ route('entries.index') }}" class="mb-4 flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Cari jurnal..."
                class="border rounded px-3 py-2 w-full">
            <button class="bg-indigo-500 text-white px-4 py-2 rounded">Cari</button>
        </form>

        <a href="{{ route('entries.create') }}"
            class="bg-indigo-600 text-white px-4 py-2 rounded mb-4 inline-block">
            + Tulis Jurnal
        </a>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            @forelse($entries as $entry)
            <div class="bg-white rounded shadow p-4">
                <div class="flex justify-between items-center">
                    <h3 class="font-bold text-lg">{{ $entry->title }}</h3>
                    <span class="text-2xl">
                        @if($entry->mood == 'happy') 😊
                        @elseif($entry->mood == 'neutral') 😐
                        @elseif($entry->mood == 'sad') 😢
                        @elseif($entry->mood == 'angry') 😡
                        @else 😴
                        @endif
                    </span>
                </div>
                <p class="text-sm text-gray-500">{{ $entry->entry_date }} 
                    @if($entry->category)
                        • <span style="color: {{ $entry->category->color }}">{{ $entry->category->name }}</span>
                    @endif
                </p>
                <p class="text-gray-700 mt-2 line-clamp-2">{{ Str::limit($entry->content, 100) }}</p>
                <div class="flex gap-2 mt-3">
                    <a href="{{ route('entries.show', $entry) }}" class="text-blue-500 text-sm">Lihat</a>
                    <a href="{{ route('entries.edit', $entry) }}" class="text-yellow-500 text-sm">Edit</a>
                    <form method="POST" action="{{ route('entries.destroy', $entry) }}">
                        @csrf @method('DELETE')
                        <button class="text-red-500 text-sm" onclick="return confirm('Hapus jurnal ini?')">Hapus</button>
                    </form>
                </div>
            </div>
            @empty
            <p class="text-gray-500">Belum ada jurnal. Yuk tulis sekarang!</p>
            @endforelse
        </div>
    </div>
</x-app-layout>