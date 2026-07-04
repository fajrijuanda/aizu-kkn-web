@extends('layouts.admin', ['title' => 'Profil Desa'])

@section('content')
    <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data" class="grid max-w-5xl gap-6">
        @csrf @method('PUT')
        <section class="rounded-2xl border border-green-100 bg-white p-6 shadow-sm">
            <h2 class="text-xl font-black text-green-950">Identitas Desa</h2>
            <div class="mt-5 grid gap-5">
                @include('admin.partials.form-input', ['name' => 'name', 'label' => 'Nama Desa', 'value' => $profile->name, 'required' => true])
                @include('admin.partials.form-input', ['name' => 'tagline', 'label' => 'Tagline', 'value' => $profile->tagline])
                <div class="grid gap-5 sm:grid-cols-3">
                    @include('admin.partials.form-input', ['name' => 'district', 'label' => 'Kecamatan', 'value' => $profile->district])
                    @include('admin.partials.form-input', ['name' => 'regency', 'label' => 'Kabupaten', 'value' => $profile->regency])
                    @include('admin.partials.form-input', ['name' => 'province', 'label' => 'Provinsi', 'value' => $profile->province])
                </div>
                <div class="grid gap-5 sm:grid-cols-3">
                    @include('admin.partials.form-input', ['name' => 'postal_code', 'label' => 'Kode Pos', 'value' => $profile->postal_code])
                    @include('admin.partials.form-input', ['name' => 'area', 'label' => 'Luas Wilayah', 'value' => $profile->area])
                    @include('admin.partials.form-input', ['name' => 'head_name', 'label' => 'Kepala Desa', 'value' => $profile->head_name])
                </div>
            </div>
        </section>

        <section class="rounded-2xl border border-green-100 bg-white p-6 shadow-sm">
            <h2 class="text-xl font-black text-green-950">Narasi Desa</h2>
            <div class="mt-5 grid gap-5">
                @include('admin.partials.form-textarea', ['name' => 'head_greeting', 'label' => 'Sambutan Kepala Desa', 'value' => $profile->head_greeting, 'rows' => 4])
                @include('admin.partials.form-textarea', ['name' => 'history', 'label' => 'Sejarah', 'value' => $profile->history, 'rows' => 5])
                @include('admin.partials.form-textarea', ['name' => 'vision', 'label' => 'Visi', 'value' => $profile->vision, 'rows' => 3])
                @include('admin.partials.form-textarea', ['name' => 'missions_text', 'label' => 'Misi (satu baris per item)', 'value' => implode(PHP_EOL, $profile->missions ?? []), 'rows' => 5])
            </div>
        </section>

        <section class="rounded-2xl border border-green-100 bg-white p-6 shadow-sm">
            <h2 class="text-xl font-black text-green-950">Kontak dan Peta</h2>
            <div class="mt-5 grid gap-5">
                @include('admin.partials.form-textarea', ['name' => 'address', 'label' => 'Alamat', 'value' => $profile->address, 'rows' => 3])
                <div class="grid gap-5 sm:grid-cols-2">
                    @include('admin.partials.form-input', ['name' => 'phone', 'label' => 'Telepon', 'value' => $profile->phone])
                    @include('admin.partials.form-input', ['name' => 'email', 'label' => 'Email', 'type' => 'email', 'value' => $profile->email])
                </div>
                @include('admin.partials.form-textarea', ['name' => 'map_embed_url', 'label' => 'URL Embed Google My Maps', 'value' => $profile->map_embed_url, 'rows' => 3])
            </div>
        </section>

        <section class="rounded-2xl border border-green-100 bg-white p-6 shadow-sm">
            <h2 class="text-xl font-black text-green-950">Gambar</h2>
            <div class="mt-5 grid gap-6 md:grid-cols-2">
                <div class="rounded-2xl bg-green-50 p-5">
                    <label class="text-sm font-bold text-slate-700" for="hero_image_upload">Hero Image</label>
                    <input id="hero_image_upload" name="hero_image_upload" type="file" accept="image/png,image/jpeg,image/webp" class="mt-2 block w-full rounded-xl border border-green-100 bg-white px-4 py-3 text-sm">
                    @if ($profile->hero_image_base64)
                        <img src="{{ $profile->hero_image_base64 }}" alt="{{ $profile->hero_image_alt }}" class="mt-4 aspect-video w-full rounded-xl object-cover">
                    @endif
                </div>
                <div class="rounded-2xl bg-green-50 p-5">
                    <label class="text-sm font-bold text-slate-700" for="logo_upload">Logo</label>
                    <input id="logo_upload" name="logo_upload" type="file" accept="image/png,image/jpeg,image/webp" class="mt-2 block w-full rounded-xl border border-green-100 bg-white px-4 py-3 text-sm">
                    @if ($profile->logo_base64)
                        <img src="{{ $profile->logo_base64 }}" alt="Logo {{ $profile->name }}" class="mt-4 h-28 w-28 rounded-xl object-cover">
                    @endif
                </div>
            </div>
        </section>

        <div class="flex gap-3">
            <button class="rounded-full bg-green-800 px-5 py-3 text-sm font-bold text-white">Simpan Profil</button>
            <a href="{{ route('home') }}" class="rounded-full border border-green-200 px-5 py-3 text-sm font-bold text-green-900">Lihat Website</a>
        </div>
    </form>
@endsection
