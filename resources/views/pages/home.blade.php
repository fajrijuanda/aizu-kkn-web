@extends('layouts.public', ['title' => 'Beranda'])

@section('content')
    <section class="relative overflow-hidden bg-green-950">
        @if ($profile?->hero_image_base64)
            <img src="{{ $profile->hero_image_base64 }}" alt="{{ $profile->hero_image_alt ?? $profile->name }}" class="absolute inset-0 h-full w-full object-cover opacity-45">
        @endif
        <div class="absolute inset-0 bg-gradient-to-r from-green-950 via-green-950/85 to-green-900/30"></div>
        <div class="relative mx-auto grid min-h-[560px] max-w-7xl items-center gap-8 px-4 py-16 sm:px-6 lg:grid-cols-[1.1fr_.9fr] lg:px-8">
            <div class="max-w-3xl">
                <p class="inline-flex rounded-full border border-green-200/30 bg-white/10 px-4 py-2 text-sm font-semibold text-green-50 backdrop-blur">{{ $profile?->district }} · {{ $profile?->regency }}</p>
                <h1 class="mt-6 text-4xl font-black leading-tight text-white sm:text-5xl lg:text-6xl">{{ $profile?->name ?? 'Desa KKN AIZU' }}</h1>
                <p class="mt-5 max-w-2xl text-lg leading-8 text-green-50">{{ $profile?->tagline ?? 'Portal desa modern untuk profil, peta, UMKM, potensi, dan galeri kegiatan.' }}</p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('profile') }}" class="rounded-full bg-amber-800 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-black/20 hover:bg-amber-900">Lihat Profil Desa</a>
                    <a href="{{ route('map') }}" class="rounded-full border border-white/40 px-5 py-3 text-sm font-bold text-white hover:bg-white/10">Buka Peta Desa</a>
                </div>
            </div>
            <div class="grid gap-3 rounded-3xl border border-white/10 bg-white/10 p-4 backdrop-blur">
                @forelse ($infographics->take(4) as $stat)
                    <div class="rounded-2xl bg-white p-5 shadow-sm">
                        <p class="text-sm font-semibold text-stone-600">{{ $stat->title }}</p>
                        <p class="mt-2 text-3xl font-black text-green-900">{{ $stat->value }} <span class="text-base font-semibold text-stone-500">{{ $stat->unit }}</span></p>
                    </div>
                @empty
                    <x-empty-state title="Infografis belum tersedia" />
                @endforelse
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
        <div class="grid gap-5 md:grid-cols-3">
            <a href="{{ route('infographics') }}" class="rounded-2xl border border-green-100 bg-white p-6 shadow-sm hover:border-green-300">
                <p class="text-sm font-semibold text-amber-800">Data Ringkas</p>
                <h2 class="mt-2 text-xl font-bold text-green-950">Infografis Desa</h2>
                <p class="mt-3 text-sm leading-6 text-slate-600">Lihat angka penting tentang penduduk, ekonomi, wilayah, dan fasilitas desa.</p>
            </a>
            <a href="{{ route('msmes.index') }}" class="rounded-2xl border border-green-100 bg-white p-6 shadow-sm hover:border-green-300">
                <p class="text-sm font-semibold text-amber-800">Ekonomi Lokal</p>
                <h2 class="mt-2 text-xl font-bold text-green-950">UMKM Desa</h2>
                <p class="mt-3 text-sm leading-6 text-slate-600">Kenali produk warga dan pelaku usaha yang menggerakkan ekonomi desa.</p>
            </a>
            <a href="{{ route('potentials.index') }}" class="rounded-2xl border border-green-100 bg-white p-6 shadow-sm hover:border-green-300">
                <p class="text-sm font-semibold text-amber-800">Aset Desa</p>
                <h2 class="mt-2 text-xl font-bold text-green-950">Potensi Desa</h2>
                <p class="mt-3 text-sm leading-6 text-slate-600">Temukan potensi pertanian, wisata, budaya, dan industri kreatif desa.</p>
            </a>
        </div>
    </section>

    <section class="bg-white py-14">
        <div class="mx-auto grid max-w-7xl gap-10 px-4 sm:px-6 lg:grid-cols-[.85fr_1.15fr] lg:px-8">
            <div>
                <p class="text-sm font-bold uppercase text-amber-800">Sambutan</p>
                <h2 class="mt-3 text-3xl font-black text-green-950">Kepala Desa</h2>
                <p class="mt-5 leading-8 text-slate-700">{{ $profile?->head_greeting }}</p>
                <p class="mt-4 text-sm font-semibold text-green-900">{{ $profile?->head_name }}</p>
            </div>
            <div class="rounded-3xl border border-green-100 bg-green-50 p-6">
                <p class="text-sm font-bold uppercase text-amber-800">Peta Desa</p>
                <h2 class="mt-2 text-2xl font-black text-green-950">Titik penting dan area layanan</h2>
                <div class="mt-5 grid gap-3 sm:grid-cols-2">
                    @forelse ($mapPoints as $point)
                        <div class="rounded-2xl bg-white p-4 shadow-sm">
                            <p class="font-bold text-green-950">{{ $point->name }}</p>
                            <p class="mt-1 text-xs font-semibold text-amber-800">{{ $point->category }}</p>
                            <p class="mt-2 text-sm text-slate-600">{{ $point->description }}</p>
                        </div>
                    @empty
                        <x-empty-state title="Titik peta belum tersedia" />
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
        <div class="mb-8 flex items-end justify-between gap-4">
            <div>
                <p class="text-sm font-bold uppercase text-amber-800">Produk Warga</p>
                <h2 class="mt-2 text-3xl font-black text-green-950">UMKM Unggulan</h2>
            </div>
            <a href="{{ route('msmes.index') }}" class="hidden rounded-full border border-green-200 px-4 py-2 text-sm font-bold text-green-900 hover:bg-green-50 sm:inline-flex">Lihat semua</a>
        </div>
        <div class="grid gap-6 md:grid-cols-3">
            @forelse ($msmes as $msme)
                @include('partials.public-card', ['title' => $msme->name, 'subtitle' => $msme->category, 'description' => $msme->description, 'image' => $msme->image_base64, 'url' => route('msmes.show', $msme->slug)])
            @empty
                <div class="md:col-span-3"><x-empty-state title="UMKM belum tersedia" /></div>
            @endforelse
        </div>
    </section>

    <section class="bg-green-950 py-14 text-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-8 flex items-end justify-between gap-4">
                <div>
                    <p class="text-sm font-bold uppercase text-amber-300">Aset Lokal</p>
                    <h2 class="mt-2 text-3xl font-black">Potensi Desa</h2>
                </div>
                <a href="{{ route('potentials.index') }}" class="hidden rounded-full border border-white/25 px-4 py-2 text-sm font-bold text-white hover:bg-white/10 sm:inline-flex">Lihat semua</a>
            </div>
            <div class="grid gap-6 md:grid-cols-3">
                @forelse ($potentials as $potential)
                    <a href="{{ route('potentials.show', $potential->slug) }}" class="overflow-hidden rounded-2xl border border-white/10 bg-white/10 shadow-sm backdrop-blur hover:bg-white/15">
                        @if ($potential->image_base64)
                            <img src="{{ $potential->image_base64 }}" alt="{{ $potential->image_alt ?? $potential->title }}" class="aspect-[4/3] w-full object-cover">
                        @endif
                        <div class="p-5">
                            <p class="text-xs font-bold uppercase text-amber-200">{{ $potential->category }}</p>
                            <h3 class="mt-2 text-xl font-bold">{{ $potential->title }}</h3>
                            <p class="mt-3 text-sm leading-6 text-green-50">{{ $potential->summary }}</p>
                        </div>
                    </a>
                @empty
                    <div class="md:col-span-3"><x-empty-state title="Potensi belum tersedia" /></div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
        <div class="mb-8 flex items-end justify-between gap-4">
            <div>
                <p class="text-sm font-bold uppercase text-amber-800">Dokumentasi</p>
                <h2 class="mt-2 text-3xl font-black text-green-950">Galeri Desa</h2>
            </div>
            <a href="{{ route('gallery') }}" class="hidden rounded-full border border-green-200 px-4 py-2 text-sm font-bold text-green-900 hover:bg-green-50 sm:inline-flex">Lihat foto</a>
        </div>
        <div class="grid grid-cols-2 gap-3 md:grid-cols-3">
            @forelse ($galleries as $photo)
                <img src="{{ $photo->image_base64 }}" alt="{{ $photo->image_alt ?? $photo->title }}" class="aspect-[4/3] w-full rounded-2xl object-cover shadow-sm">
            @empty
                <div class="col-span-full"><x-empty-state title="Galeri belum tersedia" /></div>
            @endforelse
        </div>
    </section>
@endsection
