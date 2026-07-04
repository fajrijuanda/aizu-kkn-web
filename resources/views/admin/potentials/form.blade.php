<div class="grid gap-5">
    <div class="grid gap-5 sm:grid-cols-2">
        @include('admin.partials.form-input', ['name' => 'title', 'label' => 'Judul Potensi', 'value' => $item->title, 'required' => true])
        @include('admin.partials.form-input', ['name' => 'slug', 'label' => 'Slug', 'value' => $item->slug])
    </div>
    <div class="grid gap-5 sm:grid-cols-2">
        @include('admin.partials.form-input', ['name' => 'category', 'label' => 'Kategori', 'value' => $item->category])
        @include('admin.partials.form-input', ['name' => 'location', 'label' => 'Lokasi', 'value' => $item->location])
    </div>
    @include('admin.partials.form-textarea', ['name' => 'summary', 'label' => 'Ringkasan', 'value' => $item->summary])
    @include('admin.partials.form-textarea', ['name' => 'description', 'label' => 'Deskripsi Lengkap', 'value' => $item->description, 'rows' => 6])
    <div class="rounded-2xl border border-green-100 bg-green-50 p-5">
        <label class="block text-sm font-bold text-slate-700" for="image_upload">Gambar Potensi</label>
        <input id="image_upload" name="image_upload" type="file" accept="image/png,image/jpeg,image/webp" class="mt-2 block w-full rounded-xl border border-green-100 bg-white px-4 py-3 text-sm">
        <p class="mt-2 text-xs text-green-800">JPG, PNG, atau WEBP maksimal 2 MB. File akan dikonversi ke base64.</p>
        @if ($item->image_base64)
            <img src="{{ $item->image_base64 }}" alt="{{ $item->title }}" class="mt-4 h-32 w-48 rounded-xl object-cover">
        @endif
    </div>
    <div class="grid gap-3 sm:grid-cols-2">
        @include('admin.partials.toggle', ['name' => 'is_featured', 'label' => 'Tampilkan di beranda', 'checked' => $item->is_featured ?? false])
        @include('admin.partials.toggle', ['name' => 'is_published', 'label' => 'Published', 'checked' => $item->exists ? $item->is_published : true])
    </div>
    <div class="flex gap-3">
        <button class="rounded-full bg-green-800 px-5 py-3 text-sm font-bold text-white">Simpan</button>
        <a href="{{ route('admin.potensi-desa.index') }}" class="rounded-full border border-green-200 px-5 py-3 text-sm font-bold text-green-900">Batal</a>
    </div>
</div>
