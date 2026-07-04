<div class="grid gap-5">
    @include('admin.partials.form-input', ['name' => 'title', 'label' => 'Judul', 'value' => $item->title, 'required' => true])
    <div class="grid gap-5 sm:grid-cols-2">
        @include('admin.partials.form-input', ['name' => 'category', 'label' => 'Kategori', 'value' => $item->category, 'required' => true])
        @include('admin.partials.form-input', ['name' => 'icon', 'label' => 'Ikon', 'value' => $item->icon])
    </div>
    <div class="grid gap-5 sm:grid-cols-3">
        @include('admin.partials.form-input', ['name' => 'value', 'label' => 'Nilai', 'value' => $item->value, 'required' => true])
        @include('admin.partials.form-input', ['name' => 'unit', 'label' => 'Satuan', 'value' => $item->unit])
        @include('admin.partials.form-input', ['name' => 'sort_order', 'label' => 'Urutan', 'type' => 'number', 'value' => $item->sort_order ?? 0])
    </div>
    @include('admin.partials.form-textarea', ['name' => 'description', 'label' => 'Deskripsi', 'value' => $item->description])
    <div class="grid gap-3 sm:grid-cols-2">
        @include('admin.partials.toggle', ['name' => 'is_featured', 'label' => 'Tampilkan di beranda', 'checked' => $item->is_featured ?? false])
        @include('admin.partials.toggle', ['name' => 'is_published', 'label' => 'Published', 'checked' => $item->exists ? $item->is_published : true])
    </div>
    <div class="flex gap-3">
        <button class="rounded-full bg-green-800 px-5 py-3 text-sm font-bold text-white">Simpan</button>
        <a href="{{ route('admin.infografis.index') }}" class="rounded-full border border-green-200 px-5 py-3 text-sm font-bold text-green-900">Batal</a>
    </div>
</div>
