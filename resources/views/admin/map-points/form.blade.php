<div class="grid gap-5">
    @include('admin.partials.form-input', ['name' => 'name', 'label' => 'Nama Titik', 'value' => $item->name, 'required' => true])
    <div class="grid gap-5 sm:grid-cols-2">
        @include('admin.partials.form-input', ['name' => 'category', 'label' => 'Kategori', 'value' => $item->category, 'required' => true])
        @include('admin.partials.form-input', ['name' => 'sort_order', 'label' => 'Urutan', 'type' => 'number', 'value' => $item->sort_order ?? 0])
    </div>
    <div class="grid gap-5 sm:grid-cols-2">
        @include('admin.partials.form-input', ['name' => 'latitude', 'label' => 'Latitude', 'value' => $item->latitude])
        @include('admin.partials.form-input', ['name' => 'longitude', 'label' => 'Longitude', 'value' => $item->longitude])
    </div>
    @include('admin.partials.form-textarea', ['name' => 'address', 'label' => 'Alamat', 'value' => $item->address, 'rows' => 3])
    @include('admin.partials.form-textarea', ['name' => 'description', 'label' => 'Deskripsi', 'value' => $item->description])
    @include('admin.partials.form-input', ['name' => 'external_url', 'label' => 'Link Google Maps', 'value' => $item->external_url])
    <div class="grid gap-3 sm:grid-cols-2">
        @include('admin.partials.toggle', ['name' => 'is_featured', 'label' => 'Titik unggulan', 'checked' => $item->is_featured ?? false])
        @include('admin.partials.toggle', ['name' => 'is_published', 'label' => 'Published', 'checked' => $item->exists ? $item->is_published : true])
    </div>
    <div class="flex gap-3">
        <button class="rounded-full bg-green-800 px-5 py-3 text-sm font-bold text-white">Simpan</button>
        <a href="{{ route('admin.peta-desa.index') }}" class="rounded-full border border-green-200 px-5 py-3 text-sm font-bold text-green-900">Batal</a>
    </div>
</div>
