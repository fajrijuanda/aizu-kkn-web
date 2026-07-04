<div class="grid gap-5">
    @include('admin.partials.form-input', ['name' => 'title', 'label' => 'Judul Foto', 'value' => $item->title, 'required' => true])
    <div class="grid gap-5 sm:grid-cols-3">
        @include('admin.partials.form-input', ['name' => 'category', 'label' => 'Kategori', 'value' => $item->category])
        @include('admin.partials.form-input', ['name' => 'taken_at', 'label' => 'Tanggal Foto', 'type' => 'date', 'value' => optional($item->taken_at)->format('Y-m-d')])
        @include('admin.partials.form-input', ['name' => 'sort_order', 'label' => 'Urutan', 'type' => 'number', 'value' => $item->sort_order ?? 0])
    </div>
    @include('admin.partials.form-textarea', ['name' => 'description', 'label' => 'Deskripsi', 'value' => $item->description])
    <div class="rounded-2xl border border-green-100 bg-green-50 p-5">
        <label class="block text-sm font-bold text-slate-700" for="image_upload">Gambar Galeri</label>
        <input id="image_upload" name="image_upload" type="file" accept="image/png,image/jpeg,image/webp" class="mt-2 block w-full rounded-xl border border-green-100 bg-white px-4 py-3 text-sm">
        <p class="mt-2 text-xs text-green-800">Wajib saat tambah foto. JPG, PNG, atau WEBP maksimal 2 MB.</p>
        @if ($item->image_base64)
            <img src="{{ $item->image_base64 }}" alt="{{ $item->title }}" class="mt-4 h-32 w-48 rounded-xl object-cover">
        @endif
    </div>
    @include('admin.partials.toggle', ['name' => 'is_published', 'label' => 'Published', 'checked' => $item->exists ? $item->is_published : true])
    <div class="flex gap-3">
        <button class="rounded-full bg-green-800 px-5 py-3 text-sm font-bold text-white">Simpan</button>
        <a href="{{ route('admin.galeri.index') }}" class="rounded-full border border-green-200 px-5 py-3 text-sm font-bold text-green-900">Batal</a>
    </div>
</div>
