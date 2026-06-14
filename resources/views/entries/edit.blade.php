<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jurnal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=EB+Garamond:ital@0;1&display=swap');
        body { font-family: 'EB Garamond', Georgia, serif; }
    </style>
</head>
<body class="bg-[#1a1a1a] min-h-screen">

<nav class="bg-[#111] px-6 py-4 flex justify-between items-center border-b border-[#2a2a2a]">
    <a href="{{ route('entries.index') }}" class="text-[#aaa] text-sm hover:text-white font-sans">← Kembali</a>
    <div class="text-white font-bold text-sm tracking-widest font-sans">EDIT JURNAL</div>
    <div class="w-16"></div>
</nav>

<div class="max-w-3xl mx-auto px-6 py-8">
    <form method="POST" action="{{ route('entries.update', $entry) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="bg-[#2a2a2a] rounded-2xl overflow-hidden shadow-2xl">
            <div class="h-3 w-full" style="background: linear-gradient(90deg, #f5c842, #e06090, #7eb8f7)"></div>

            <div class="p-6 space-y-4">
                {{-- Judul --}}
                <input type="text" name="title" placeholder="Judul jurnal..."
                    value="{{ old('title', $entry->title) }}" required
                    class="w-full bg-transparent text-white text-2xl outline-none border-b border-[#444] pb-2 placeholder-[#444] italic">

                {{-- Tanggal & Mood & Kategori --}}
                <div class="flex gap-4">
                    <div class="flex-1">
                        <label class="text-[#666] text-xs tracking-widest font-sans">TANGGAL</label>
                        <input type="date" name="entry_date"
                            value="{{ old('entry_date', $entry->entry_date) }}" required
                            class="w-full bg-[#222] text-white rounded-xl px-4 py-2 mt-1 outline-none border border-[#333] font-sans">
                    </div>
                    <div class="flex-1">
                        <label class="text-[#666] text-xs tracking-widest font-sans">MOOD</label>
                        <select name="mood" required
                            class="w-full bg-[#222] text-white rounded-xl px-4 py-2 mt-1 outline-none border border-[#333] font-sans">
                            <option value="happy" {{ $entry->mood == 'happy' ? 'selected' : '' }}>😊 Happy</option>
                            <option value="neutral" {{ $entry->mood == 'neutral' ? 'selected' : '' }}>😐 Neutral</option>
                            <option value="sad" {{ $entry->mood == 'sad' ? 'selected' : '' }}>😢 Sad</option>
                            <option value="angry" {{ $entry->mood == 'angry' ? 'selected' : '' }}>😡 Angry</option>
                            <option value="sleepy" {{ $entry->mood == 'sleepy' ? 'selected' : '' }}>😴 Sleepy</option>
                            <option value="frustrated" {{ $entry->mood == 'frustrated' ? 'selected' : '' }}>😤 Frustrated</option>
                        </select>
                    </div>
                    <div class="flex-1">
                        <label class="text-[#666] text-xs tracking-widest font-sans">KATEGORI</label>
                        <select name="category_id"
                            class="w-full bg-[#222] text-white rounded-xl px-4 py-2 mt-1 outline-none border border-[#333] font-sans">
                            <option value="">-- Tanpa Kategori --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $entry->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Isi Jurnal --}}
                <div>
                    <label class="text-[#666] text-xs tracking-widest font-sans">ISI JURNAL</label>
                    <textarea name="content" rows="12" required
                        placeholder="Tulis ceritamu hari ini..."
                        class="w-full bg-[#1a1a1a] text-white rounded-xl px-4 py-3 mt-1 outline-none border border-[#333] resize-none placeholder-[#444] leading-relaxed font-sans">{{ old('content', $entry->content) }}</textarea>
                </div>

                {{-- Foto --}}
                <div>
                    <label class="text-[#666] text-xs tracking-widest font-sans">FOTO (OPSIONAL)</label>
                    @if($entry->image_path)
                        <img src="{{ Storage::url($entry->image_path) }}"
                            class="rounded-xl mt-2 max-h-32 object-cover w-full mb-2">
                        <p class="text-[#555] text-xs font-sans mb-2">Foto saat ini. Upload baru untuk mengganti.</p>
                    @endif
                    <div class="mt-2 border-2 border-dashed border-[#444] rounded-xl p-6 text-center hover:border-[#4ade80] transition cursor-pointer"
                        onclick="document.getElementById('imageInput').click()">
                        <div class="text-3xl mb-2">📷</div>
                        <p class="text-[#555] text-sm font-sans">Klik untuk pilih foto</p>
                        <input type="file" name="image" id="imageInput" accept="image/*" class="hidden"
                            onchange="previewImage(this)">
                    </div>
                    <img id="imagePreview" src="" class="hidden mt-3 rounded-xl max-h-48 object-cover w-full">
                </div>

                {{-- Tombol --}}
                <div class="flex gap-3 pt-2">
                    <button type="submit"
                        class="flex-1 bg-[#4ade80] text-black font-medium rounded-full py-3 hover:bg-[#22c55e] transition font-sans">
                        Update Jurnal
                    </button>
                    <a href="{{ route('entries.index') }}"
                        class="flex-1 bg-[#333] text-[#aaa] rounded-full py-3 text-center hover:bg-[#444] transition font-sans">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

</body>
</html>