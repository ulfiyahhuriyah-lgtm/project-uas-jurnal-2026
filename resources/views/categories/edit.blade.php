<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🏷️ Edit Kategori
        </h2>
    </x-slot>

    <div class="py-6 max-w-xl mx-auto px-4">
        <form method="POST" action="{{ route('categories.update', $category) }}">
            @csrf
            @method('PUT')

            <div class="bg-white rounded shadow p-6 space-y-4">
                <!-- Nama Kategori -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Kategori</label>
                    <input type="text" name="name" value="{{ old('name', $category->name) }}"
                        class="mt-1 w-full border rounded px-3 py-2" required>
                </div>

                <!-- Warna -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Warna</label>
                    <input type="color" name="color" value="{{ old('color', $category->color) }}"
                        class="mt-1 h-10 w-20 border rounded px-1 py-1">
                </div>

                <div class="flex gap-2">
                    <button type="submit"
                        class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">
                        Update
                    </button>
                    <a href="{{ route('categories.index') }}"
                        class="bg-gray-300 text-gray-700 px-6 py-2 rounded hover:bg-gray-400">
                        Batal
                    </a>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>