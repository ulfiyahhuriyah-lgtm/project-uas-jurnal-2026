<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ✏️ Edit Jurnal
        </h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto px-4">
        <form method="POST" action="{{ route('entries.update', $entry) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="bg-white rounded shadow p-6 space-y-4">
                <!-- Judul -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Judul</label>
                    <input type="text" name="title" value="{{ old('title', $entry->title) }}"
                        class="mt-1 w-full border rounded px-3 py-2" required>
                </div>

                <!-- Tanggal -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                    <input type="date" name="entry_date" value="{{ old('entry_date', $entry->entry_date) }}"
                        class="mt-1 w-full border rounded px-3 py-2" required>
                </div>

                <!-- Kategori -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Kategori</label>
                    <select name="category_id" class="mt-1 w-full border rounded px-3 py-2">
                        <option value="">-- Tanpa Kategori --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $entry->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Mood -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Mood</label>
                    <select name="mood" class="mt-1 w-full border rounded px-3 py-2" required>
                        <option value="happy" {{ $entry->mood == 'happy' ? 'selected' : '' }}>😊 Happy</option>
                        <option value="neutral" {{ $entry->mood == 'neutral' ? 'selected' : '' }}>😐 Neutral</option>
                        <option value="sad" {{ $entry->mood == 'sad' ? 'selected' : '' }}>😢 Sad</option>
                        <option value="angry" {{ $entry->mood == 'angry' ? 'selected' : '' }}>😡 Angry</option>
                        <option value="sleepy" {{ $entry->mood == 'sleepy' ? 'selected' : '' }}>😴 Sleepy</option>
                    </select>
                </div>

                <!-- Isi Jurnal -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Isi Jurnal</label>
                    <textarea name="content" rows="6"
                        class="mt-1 w-full border rounded px-3 py-2" required>{{ old('content', $entry->content) }}</textarea>
                </div>

                <!-- Upload Foto -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Foto (opsional)</label>
                    @if($entry->image_path)
                        <img src="{{ Storage::url($entry->image_path) }}"
                            class="rounded mb-2 max-h-32 object-cover">
                        <p class="text-xs text-gray-500 mb-1">Foto saat ini. Upload baru untuk mengganti.</p>
                    @endif
                    <input type="file" name="image" accept="image/*"
                        class="mt-1 w-full border rounded px-3 py-2">
                </div>

                <div class="flex gap-2">
                    <button type="submit"
                        class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">
                        Update
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