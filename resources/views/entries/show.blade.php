<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📖 Detail Jurnal
        </h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto px-4">
        <div class="bg-white rounded shadow p-6">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold">{{ $entry->title }}</h1>
                <span class="text-4xl">
                    @if($entry->mood == 'happy') 😊
                    @elseif($entry->mood == 'neutral') 😐
                    @elseif($entry->mood == 'sad') 😢
                    @elseif($entry->mood == 'angry') 😡
                    @else 😴
                    @endif
                </span>
            </div>

            <p class="text-sm text-gray-500 mb-4">
                📅 {{ $entry->entry_date }}
                @if($entry->category)
                    • <span style="color: {{ $entry->category->color }}">{{ $entry->category->name }}</span>
                @endif
            </p>

            @if($entry->image_path)
                <img src="{{ Storage::url($entry->image_path) }}"
                    class="rounded mb-4 max-h-64 object-cover w-full">
            @endif

            <p class="text-gray-700 whitespace-pre-line">{{ $entry->content }}</p>

            <div class="flex gap-2 mt-6">
                <a href="{{ route('entries.edit', $entry) }}"
                    class="bg-yellow-400 text-white px-4 py-2 rounded hover:bg-yellow-500">
                    Edit
                </a>
                <form method="POST" action="{{ route('entries.destroy', $entry) }}">
                    @csrf @method('DELETE')
                    <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600"
                        onclick="return confirm('Hapus jurnal ini?')">
                        Hapus
                    </button>
                </form>
                <a href="{{ route('entries.index') }}"
                    class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">
                    Kembali
                </a>
            </div>
        </div>
    </div>
</x-app-layout>