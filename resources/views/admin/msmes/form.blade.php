<div class="grid gap-5">
    <div class="grid gap-5 sm:grid-cols-2">
        @include('admin.partials.form-input', ['name' => 'name', 'label' => 'Nama UMKM', 'value' => $item->name, 'required' => true])
        @include('admin.partials.form-input', ['name' => 'slug', 'label' => 'Slug', 'value' => $item->slug])
    </div>
    <div class="grid gap-5 sm:grid-cols-2">
        @include('admin.partials.form-input', ['name' => 'owner_name', 'label' => 'Pemilik', 'value' => $item->owner_name])
        @include('admin.partials.form-input', ['name' => 'category', 'label' => 'Kategori', 'value' => $item->category])
    </div>
    @include('admin.partials.form-textarea', ['name' => 'description', 'label' => 'Deskripsi', 'value' => $item->description])
    @include('admin.partials.form-textarea', ['name' => 'products', 'label' => 'Produk', 'value' => $item->products, 'rows' => 3])
    @include('admin.partials.form-textarea', ['name' => 'address', 'label' => 'Alamat', 'value' => $item->address, 'rows' => 3])
    <div class="grid gap-5 sm:grid-cols-3">
        @include('admin.partials.form-input', ['name' => 'phone', 'label' => 'Telepon', 'value' => $item->phone])
        @include('admin.partials.form-input', ['name' => 'whatsapp', 'label' => 'WhatsApp', 'value' => $item->whatsapp])
        @include('admin.partials.form-input', ['name' => 'map_url', 'label' => 'URL Maps', 'value' => $item->map_url])
    </div>
    <div class="rounded-2xl border border-green-100 bg-green-50 p-5">
        <label class="block text-sm font-bold text-slate-700" for="image_upload">Gambar UMKM</label>
        <input id="image_upload" name="image_upload" type="file" accept="image/png,image/jpeg,image/webp" class="mt-2 block w-full rounded-xl border border-green-100 bg-white px-4 py-3 text-sm">
        <p class="mt-2 text-xs text-green-800">JPG, PNG, atau WEBP maksimal 2 MB. File akan dikonversi ke base64 dan disimpan di database.</p>
        @if ($item->image_base64)
            <img src="{{ $item->image_base64 }}" alt="{{ $item->name }}" class="mt-4 h-32 w-48 rounded-xl object-cover">
        @endif
    </div>
    <div class="grid gap-3 sm:grid-cols-2">
        @include('admin.partials.toggle', ['name' => 'is_featured', 'label' => 'Tampilkan di beranda', 'checked' => $item->is_featured ?? false])
        @include('admin.partials.toggle', ['name' => 'is_published', 'label' => 'Published', 'checked' => $item->exists ? $item->is_published : true])
    </div>
    <div class="flex gap-3">
        <button class="rounded-full bg-green-800 px-5 py-3 text-sm font-bold text-white">Simpan</button>
        <a href="{{ route('admin.umkm.index') }}" class="rounded-full border border-green-200 px-5 py-3 text-sm font-bold text-green-900">Batal</a>
    </div>
</div>
