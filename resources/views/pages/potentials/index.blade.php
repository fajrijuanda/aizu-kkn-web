@extends('layouts.public', ['title' => 'Potensi Desa'])

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
        <p class="text-sm font-bold uppercase text-amber-800">Aset Lokal</p>
        <h1 class="mt-3 text-4xl font-black text-green-950">Potensi Desa</h1>
        <p class="mt-4 max-w-2xl text-slate-600">Potensi pertanian, wisata, budaya, lingkungan, dan industri kreatif desa.</p>
        <div class="mt-8 flex flex-wrap gap-2">
            @foreach ($categories as $category)
                <span class="rounded-full bg-green-100 px-4 py-2 text-xs font-bold text-green-900">{{ $category }}</span>
            @endforeach
        </div>
        <div class="mt-8 grid gap-6 md:grid-cols-3">
            @forelse ($potentials as $potential)
                @include('partials.public-card', ['title' => $potential->title, 'subtitle' => $potential->category, 'description' => $potential->summary, 'image' => $potential->image_base64, 'url' => route('potentials.show', $potential->slug)])
            @empty
                <div class="md:col-span-3"><x-empty-state title="Potensi belum tersedia" /></div>
            @endforelse
        </div>
        <div class="mt-8">{{ $potentials->links() }}</div>
    </section>
@endsection
