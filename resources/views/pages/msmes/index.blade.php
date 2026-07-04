@extends('layouts.public', ['title' => 'UMKM'])

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
        <p class="text-sm font-bold uppercase text-amber-800">Ekonomi Lokal</p>
        <h1 class="mt-3 text-4xl font-black text-green-950">UMKM Desa</h1>
        <p class="mt-4 max-w-2xl text-slate-600">Daftar pelaku usaha lokal dan produk unggulan warga desa.</p>
        <div class="mt-8 flex flex-wrap gap-2">
            @foreach ($categories as $category)
                <span class="rounded-full bg-green-100 px-4 py-2 text-xs font-bold text-green-900">{{ $category }}</span>
            @endforeach
        </div>
        <div class="mt-8 grid gap-6 md:grid-cols-3">
            @forelse ($msmes as $msme)
                @include('partials.public-card', ['title' => $msme->name, 'subtitle' => $msme->category, 'description' => $msme->description, 'image' => $msme->image_base64, 'url' => route('msmes.show', $msme->slug)])
            @empty
                <div class="md:col-span-3"><x-empty-state title="UMKM belum tersedia" /></div>
            @endforelse
        </div>
        <div class="mt-8">{{ $msmes->links() }}</div>
    </section>
@endsection
