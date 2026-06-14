<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tulis Jurnal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#1a1a1a] min-h-screen" style="font-family: 'Georgia', serif;">

<nav class="bg-[#111] px-6 py-4 flex justify-between items-center border-b border-[#2a2a2a]">
    <a href="{{ route('entries.index') }}" class="text-[#aaa] text-sm hover:text-white">← Kembali</a>
    <div class="text-white font-bold text-lg tracking-widest">TULIS JURNAL</div>
    <div class="w-16"></div>
</nav>

<div class="max-w-3xl mx-auto px-6 py-8">
    <form method="POST" action="{{ route('entries.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="bg-[#2a2a2a] rounded-2xl overflow-hidden shadow-2xl">
            {{-- Cover buku --}}
            <div class="h-3 w-full" style="background: linear-gradient(90deg, #f5c842, #e06090, #7eb8f7)"></div>

            <div class="p-6 space-y-4">
                {{-- Judul --}}
                <input type="text" name="title" placeholder="Judul jurnal..."
                    value="{{ old('title') }}" required
                    class="w-full bg-transparent text-white text-2xl outline-none border-b border-[#444] pb-2 placeholder-[#444]">

                {{-- Tanggal & Mood --}}
                <div class="flex gap-4">
                    <div class="flex-1">
                        <label class="text-[#666] text-xs tracking-widest">TANGGAL</label>
                        <input type="date" name="entry_date"
                            value="{{ old('entry_date', date('Y-m-d')) }}" required
                            class="w-full bg-[#222] text-white rounded-xl px-4 py-2 mt-1 outline-none border border-[#333]">
                    </div>
                    <div class="flex-1">
                        <label class="text-[#666] text-xs tracking-widest">MOOD</label>
                        <select name="mood" required
                            class="w-full bg-[#222] text-white rounded-xl px-4 py-2 mt-1 outline-none border border-[#333]">
                            <option value="happy">😊 Happy</option>
                            <option value="neutral">😐 Neutral</option>
                            <option value="sad">😢 Sad</option>
                            <option value="angry">😡 Angry</option>
                            <option value="sleepy">😴 Sleepy</option>
                            <option value="frustrated">😤 Frustrated</option>
                        </select>
                    </div>
                    <div class="flex-1">
                        <label class="text-[#666] text-xs tracking-widest">KATEGORI</label>
                        <select name="category_id"
                            class="w-full bg-[#222] text-white rounded-xl px-4 py-2 mt-1 outline-none border border-[#333]">
                            <option value="">-- Tanpa Kategori --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Isi Jurnal --}}
                <div>
                    <label class="text-[#666] text-xs tracking-widest">ISI JURNAL</label>
                    <textarea name="content" rows="12" required
                        placeholder="Tulis ceritamu hari ini..."
                        class="w-full bg-[#1a1a1a] text-white rounded-xl px-4 py-3 mt-1 outline-none border border-[#333] resize-none placeholder-[#444] leading-relaxed">{{ old('content') }}</textarea>
                </div>

                {{-- Upload Foto --}}
                <div>
                    <label class="text-[#666] text-xs tracking-widest">FOTO (OPSIONAL)</label>
                    <div class="mt-2 border-2 border-dashed border-[#444] rounded-xl p-6 text-center hover:border-[#4ade80] transition cursor-pointer"
                        onclick="document.getElementById('imageInput').click()">
                        <div class="text-3xl mb-2">📷</div>
                        <p class="text-[#555] text-sm">Klik untuk pilih foto</p>
                        <input type="file" name="image" id="imageInput" accept="image/*" class="hidden"
                            onchange="previewImage(this)">
                    </div>
                    <img id="imagePreview" src="" class="hidden mt-3 rounded-xl max-h-48 object-cover w-full">
                </div>

                {{-- Tombol --}}
                <div class="flex gap-3 pt-2">
                    <button type="submit"
                        class="flex-1 bg-[#4ade80] text-black font-medium rounded-full py-3 hover:bg-[#22c55e] transition">
                        Simpan Jurnal
                    </button>
                    <a href="{{ route('entries.index') }}"
                        class="flex-1 bg-[#333] text-[#aaa] rounded-full py-3 text-center hover:bg-[#444] transition">
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