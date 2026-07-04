@extends('layouts.public', ['title' => 'Galeri'])

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
        <p class="text-sm font-bold uppercase text-amber-800">Dokumentasi</p>
        <h1 class="mt-3 text-4xl font-black text-green-950">Galeri Desa</h1>
        <p class="mt-4 max-w-2xl text-slate-600">Dokumentasi kegiatan, suasana, fasilitas, UMKM, dan potensi desa.</p>
        <div class="mt-8 flex flex-wrap gap-2">
            @foreach ($categories as $category)
                <span class="rounded-full bg-green-100 px-4 py-2 text-xs font-bold text-green-900">{{ $category }}</span>
            @endforeach
        </div>
        <div class="mt-8 grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
            @forelse ($galleries as $photo)
                <figure class="overflow-hidden rounded-2xl border border-green-100 bg-white shadow-sm">
                    @if ($photo->image_base64)
                        <img src="{{ $photo->image_base64 }}" alt="{{ $photo->image_alt ?? $photo->title }}" class="aspect-[4/3] w-full object-cover">
                    @endif
                    <figcaption class="p-4">
                        <p class="text-sm font-bold text-green-950">{{ $photo->title }}</p>
                        <p class="mt-1 text-xs text-stone-600">{{ $photo->category }}</p>
                    </figcaption>
                </figure>
            @empty
                <div class="col-span-full"><x-empty-state title="Galeri belum tersedia" /></div>
            @endforelse
        </div>
        <div class="mt-8">{{ $galleries->links() }}</div>
    </section>
@endsection
