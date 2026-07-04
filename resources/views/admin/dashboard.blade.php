@extends('layouts.admin', ['title' => 'Dashboard'])

@section('content')
    <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-5">
        @foreach ($stats as $label => $value)
            <div class="rounded-2xl border border-green-100 bg-white p-5 shadow-sm">
                <p class="text-sm font-semibold text-stone-600">{{ $label }}</p>
                <p class="mt-3 text-4xl font-black text-green-900">{{ $value }}</p>
            </div>
        @endforeach
    </div>

    <div class="mt-8 grid gap-6 lg:grid-cols-[1fr_.8fr]">
        <section class="rounded-2xl border border-green-100 bg-white p-6 shadow-sm">
            <h2 class="text-xl font-black text-green-950">Mulai Kelola Konten</h2>
            <p class="mt-2 text-sm leading-6 text-slate-600">Gunakan menu admin untuk memperbarui konten publik. Gambar akan disimpan sebagai base64 di database agar cocok untuk Vercel dan Neon.</p>
            <div class="mt-5 flex flex-wrap gap-3">
                <a href="{{ route('admin.profile.edit') }}" class="rounded-full bg-green-800 px-4 py-2 text-sm font-bold text-white">Edit Profil</a>
                <a href="{{ route('admin.umkm.create') }}" class="rounded-full border border-green-200 px-4 py-2 text-sm font-bold text-green-900">Tambah UMKM</a>
                <a href="{{ route('admin.galeri.create') }}" class="rounded-full border border-green-200 px-4 py-2 text-sm font-bold text-green-900">Tambah Galeri</a>
            </div>
        </section>
        <section class="rounded-2xl border border-amber-200 bg-amber-50 p-6">
            <h2 class="text-xl font-black text-amber-950">Draft Konten</h2>
            <div class="mt-4 grid gap-3">
                @foreach ($drafts as $label => $value)
                    <div class="flex items-center justify-between rounded-xl bg-white px-4 py-3 text-sm">
                        <span class="font-semibold text-slate-700">{{ $label }}</span>
                        <span class="font-black text-amber-900">{{ $value }}</span>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection
