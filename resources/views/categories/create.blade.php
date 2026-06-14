<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=EB+Garamond:ital@0;1&display=swap');
        body { font-family: 'EB Garamond', Georgia, serif; }
        .color-option { cursor: pointer; border: 3px solid transparent; border-radius: 50%; }
        .color-option.selected { border-color: white; }
    </style>
</head>
<body class="bg-[#1a1a1a] min-h-screen">

<nav class="bg-[#111] px-6 py-4 flex justify-between items-center border-b border-[#2a2a2a]">
    <a href="{{ route('categories.index') }}" class="text-[#aaa] text-sm hover:text-white font-sans">← Kembali</a>
    <div class="text-white font-bold text-sm tracking-widest font-sans">FOLDER BARU</div>
    <div class="w-16"></div>
</nav>

<div class="max-w-md mx-auto px-6 py-8">
    <form method="POST" action="{{ route('categories.store') }}">
        @csrf

        <div class="bg-[#2a2a2a] rounded-2xl p-6 space-y-5">
            {{-- Preview Buku --}}
            <div id="bookPreview" class="w-32 mx-auto rounded-xl flex items-center justify-center text-xs font-bold tracking-widest"
                style="background: linear-gradient(135deg, #f5c842, #e8a800); aspect-ratio: 3/4; color: rgba(0,0,0,0.4);">
                NOTES
            </div>

            {{-- Pilih Warna --}}
            <div>
                <label class="text-[#666] text-xs tracking-widest font-sans block mb-3">PILIH WARNA SAMPUL</label>
                <div class="flex gap-3 flex-wrap justify-center">
                    @php
                        $presets = [
                            'linear-gradient(135deg, #f5c842, #e8a800)',
                            'linear-gradient(135deg, #f87171, #dc2626)',
                            'linear-gradient(135deg, #fb923c, #ea580c)',
                            'linear-gradient(135deg, #7eb8f7, #4a90d9)',
                            'linear-gradient(135deg, #7ed99a, #3ab865)',
                            'linear-gradient(135deg, #b8a0f0, #8060d0)',
                            'linear-gradient(135deg, #f7a8c4, #e06090)',
                            'linear-gradient(135deg, #6ee7b7, #059669)',
                            'linear-gradient(135deg, #fda4af, #e11d48)',
                        ];
                    @endphp
                    @foreach($presets as $index => $preset)
                    <div class="color-option w-10 h-10 {{ $index == 0 ? 'selected' : '' }}"
                        style="background: {{ $preset }}"
                        onclick="selectColor('{{ $preset }}', this)">
                    </div>
                    @endforeach
                </div>
                <input type="hidden" name="color" id="colorInput" value="linear-gradient(135deg, #f5c842, #e8a800)">
            </div>

            {{-- Nama --}}
            <div>
                <label class="text-[#666] text-xs tracking-widest font-sans">NAMA KATEGORI</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    placeholder="Nama folder..."
                    class="w-full bg-[#222] text-white rounded-xl px-4 py-3 mt-1 outline-none border border-[#333] font-sans placeholder-[#444]">
            </div>

            {{-- Tombol --}}
            <div class="flex gap-3 pt-2">
                <button type="submit"
                    class="flex-1 bg-[#4ade80] text-black font-medium rounded-full py-3 hover:bg-[#22c55e] transition font-sans">
                    Simpan
                </button>
                <a href="{{ route('categories.index') }}"
                    class="flex-1 bg-[#333] text-[#aaa] rounded-full py-3 text-center hover:bg-[#444] transition font-sans">
                    Batal
                </a>
            </div>
        </div>
    </form>
</div>

<script>
function selectColor(gradient, el) {
    document.getElementById('bookPreview').style.background = gradient;
    document.getElementById('colorInput').value = gradient;
    document.querySelectorAll('.color-option').forEach(d => d.classList.remove('selected'));
    el.classList.add('selected');
}
</script>

</body>
</html>