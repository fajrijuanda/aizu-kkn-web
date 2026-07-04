@extends('layouts.public', ['title' => 'Peta Desa'])

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
        <p class="text-sm font-bold uppercase text-amber-800">Lokasi</p>
        <h1 class="mt-3 text-4xl font-black text-green-950">Peta Desa</h1>
        <p class="mt-4 max-w-2xl text-slate-600">Peta desa dapat memuat batas wilayah, titik fasilitas umum, UMKM, dan potensi desa melalui Google My Maps.</p>

        <div class="mt-8 overflow-hidden rounded-3xl border border-green-100 bg-green-50 shadow-sm">
            @if ($profile?->map_embed_url && $profile->map_embed_url !== 'https://www.google.com/maps/embed?pb=')
                <iframe src="{{ $profile->map_embed_url }}" class="h-[480px] w-full" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
            @else
                <div class="grid min-h-[420px] place-items-center p-8 text-center">
                    <div>
                        <p class="text-xl font-black text-green-950">Embed Google My Maps belum diatur</p>
                        <p class="mt-3 max-w-xl text-sm leading-6 text-green-800">Masuk ke admin panel, buka Profil Desa, lalu isi URL embed Google My Maps agar peta tampil di sini.</p>
                    </div>
                </div>
            @endif
        </div>

        <div class="mt-10 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            @forelse ($mapPoints as $point)
                <div class="rounded-2xl border border-green-100 bg-white p-5 shadow-sm">
                    <p class="text-xs font-bold uppercase text-amber-800">{{ $point->category }}</p>
                    <h2 class="mt-2 text-xl font-black text-green-950">{{ $point->name }}</h2>
                    <p class="mt-3 text-sm leading-6 text-slate-600">{{ $point->description }}</p>
                    <p class="mt-3 text-sm text-slate-500">{{ $point->address }}</p>
                </div>
            @empty
                <div class="md:col-span-2 lg:col-span-3"><x-empty-state title="Titik peta belum tersedia" /></div>
            @endforelse
        </div>
    </section>
@endsection
