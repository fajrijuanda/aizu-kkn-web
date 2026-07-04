<div class="grid gap-5">
    @include('admin.partials.form-input', ['name' => 'label', 'label' => 'Label', 'value' => $item->label, 'required' => true])
    <div class="grid gap-5 sm:grid-cols-2">
        @include('admin.partials.form-input', ['name' => 'type', 'label' => 'Tipe', 'value' => $item->type, 'required' => true])
        @include('admin.partials.form-input', ['name' => 'sort_order', 'label' => 'Urutan', 'type' => 'number', 'value' => $item->sort_order ?? 0])
    </div>
    @include('admin.partials.form-textarea', ['name' => 'value', 'label' => 'Nilai', 'value' => $item->value, 'rows' => 3])
    @include('admin.partials.form-input', ['name' => 'url', 'label' => 'URL', 'value' => $item->url])
    @include('admin.partials.toggle', ['name' => 'is_published', 'label' => 'Published', 'checked' => $item->exists ? $item->is_published : true])
    <div class="flex gap-3">
        <button class="rounded-full bg-green-800 px-5 py-3 text-sm font-bold text-white">Simpan</button>
        <a href="{{ route('admin.kontak.index') }}" class="rounded-full border border-green-200 px-5 py-3 text-sm font-bold text-green-900">Batal</a>
    </div>
</div>
