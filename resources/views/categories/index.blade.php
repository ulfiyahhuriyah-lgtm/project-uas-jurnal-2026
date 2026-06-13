<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🏷️ Kategori
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto px-4">
        <a href="{{ route('categories.create') }}"
            class="bg-indigo-600 text-white px-4 py-2 rounded mb-4 inline-block">
            + Tambah Kategori
        </a>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded shadow mt-4">
            @forelse($categories as $category)
            <div class="flex items-center justify-between p-4 border-b">
                <div class="flex items-center gap-3">
                    <span class="w-4 h-4 rounded-full inline-block"
                        style="background-color: {{ $category->color }}"></span>
                    <span class="font-medium">{{ $category->name }}</span>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('categories.edit', $category) }}"
                        class="text-yellow-500 text-sm">Edit</a>
                    <form method="POST" action="{{ route('categories.destroy', $category) }}">
                        @csrf @method('DELETE')
                        <button class="text-red-500 text-sm"
                            onclick="return confirm('Hapus kategori ini?')">Hapus</button>
                    </form>
                </div>
            </div>
            @empty
            <p class="text-gray-500 p-4">Belum ada kategori.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>