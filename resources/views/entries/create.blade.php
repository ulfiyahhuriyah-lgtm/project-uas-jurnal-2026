<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ✏️ Tulis Jurnal Baru
        </h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto px-4">
        <form method="POST" action="{{ route('entries.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="bg-white rounded shadow p-6 space-y-4">
                <!-- Judul -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Judul</label>
                    <input type="text" name="title" value="{{ old('title') }}"
                        class="mt-1 w-full border rounded px-3 py-2" required>
                </div>

                <!-- Tanggal -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                    <input type="date" name="entry_date" value="{{ old('entry_date', date('Y-m-d')) }}"
                        class="mt-1 w-full border rounded px-3 py-2" required>
                </div>

                <!-- Kategori -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Kategori</label>
                    <select name="category_id" class="mt-1 w-full border rounded px-3 py-2">
                        <option value="">-- Tanpa Kategori --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Mood -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Mood</label>
                    <select name="mood" class="mt-1 w-full border rounded px-3 py-2" required>
                        <option value="happy">😊 Happy</option>
                        <option value="neutral">😐 Neutral</option>
                        <option value="sad">😢 Sad</option>
                        <option value="angry">😡 Angry</option>
                        <option value="sleepy">😴 Sleepy</option>
                    </select>
                </div>

                <!-- Isi Jurnal -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Isi Jurnal</label>
                    <textarea name="content" rows="6"
                        class="mt-1 w-full border rounded px-3 py-2" required>{{ old('content') }}</textarea>
                </div>

                <!-- Upload Foto -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Foto (opsional)</label>
                    <input type="file" name="image" accept="image/*"
                        class="mt-1 w-full border rounded px-3 py-2">
                </div>

                <div class="flex gap-2">
                    <button type="submit"
                        class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">
                        Simpan
                    </button>
                    <a href="{{ route('entries.index') }}"
                        class="bg-gray-300 text-gray-700 px-6 py-2 rounded hover:bg-gray-400">
                        Batal
                    </a>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>