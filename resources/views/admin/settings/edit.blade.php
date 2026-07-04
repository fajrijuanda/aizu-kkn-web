@extends('layouts.admin', ['title' => 'Pengaturan Website'])

@section('content')
    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="max-w-4xl rounded-2xl border border-green-100 bg-white p-6 shadow-sm">
        @csrf @method('PUT')
        <div class="grid gap-5">
            @include('admin.partials.form-input', ['name' => 'site_name', 'label' => 'Nama Website', 'value' => $settings['site_name'] ?? 'Web Desa KKN AIZU', 'required' => true])
            @include('admin.partials.form-textarea', ['name' => 'site_description', 'label' => 'Meta Description', 'value' => $settings['site_description'] ?? '', 'rows' => 3])
            @include('admin.partials.form-textarea', ['name' => 'meta_keywords', 'label' => 'Meta Keywords', 'value' => $settings['meta_keywords'] ?? '', 'rows' => 2])
            @include('admin.partials.form-input', ['name' => 'footer_text', 'label' => 'Teks Footer', 'value' => $settings['footer_text'] ?? 'Dikelola oleh Tim KKN AIZU'])
            <div class="grid gap-5 sm:grid-cols-2">
                @include('admin.partials.form-input', ['name' => 'primary_color', 'label' => 'Warna Utama', 'value' => $settings['primary_color'] ?? '#166534'])
                @include('admin.partials.form-input', ['name' => 'accent_color', 'label' => 'Warna Aksen', 'value' => $settings['accent_color'] ?? '#7A4E2D'])
            </div>

            <div class="grid gap-5 md:grid-cols-2">
                <div class="rounded-2xl border border-green-100 bg-green-50 p-5">
                    <label class="text-sm font-bold text-slate-700" for="logo_upload">Logo Website</label>
                    <input id="logo_upload" name="logo_upload" type="file" accept="image/png,image/jpeg,image/webp" class="mt-2 block w-full rounded-xl border border-green-100 bg-white px-4 py-3 text-sm">
                    @if ($settings['logo_base64'] ?? null)
                        <img src="{{ $settings['logo_base64'] }}" alt="Logo website" class="mt-4 h-24 w-24 rounded-xl object-cover">
                    @endif
                </div>
                <div class="rounded-2xl border border-green-100 bg-green-50 p-5">
                    <label class="text-sm font-bold text-slate-700" for="favicon_upload">Favicon</label>
                    <input id="favicon_upload" name="favicon_upload" type="file" accept="image/png,image/jpeg,image/webp" class="mt-2 block w-full rounded-xl border border-green-100 bg-white px-4 py-3 text-sm">
                    @if ($settings['favicon_base64'] ?? null)
                        <img src="{{ $settings['favicon_base64'] }}" alt="Favicon website" class="mt-4 h-16 w-16 rounded-xl object-cover">
                    @endif
                </div>
            </div>

            <div class="flex gap-3">
                <button class="rounded-full bg-green-800 px-5 py-3 text-sm font-bold text-white">Simpan Pengaturan</button>
                <a href="{{ route('admin.dashboard') }}" class="rounded-full border border-green-200 px-5 py-3 text-sm font-bold text-green-900">Batal</a>
            </div>
        </div>
    </form>
@endsection
