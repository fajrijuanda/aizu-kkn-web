@extends('layouts.public', ['title' => 'Infografis'])

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
        <p class="text-sm font-bold uppercase text-amber-800">Data Desa</p>
        <h1 class="mt-3 text-4xl font-black text-green-950">Infografis</h1>
        <p class="mt-4 max-w-2xl text-slate-600">Ringkasan data penting desa dalam format yang mudah dipindai.</p>

        <div class="mt-10 grid gap-8">
            @forelse ($groups as $category => $items)
                <div>
                    <h2 class="text-xl font-black text-green-950">{{ $category }}</h2>
                    <div class="mt-4 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ($items as $item)
                            <div class="rounded-2xl border border-green-100 bg-white p-6 shadow-sm">
                                <p class="text-sm font-semibold text-stone-600">{{ $item->title }}</p>
                                <p class="mt-3 text-4xl font-black text-green-900">{{ $item->value }} <span class="text-base text-stone-500">{{ $item->unit }}</span></p>
                                <p class="mt-3 text-sm leading-6 text-slate-600">{{ $item->description }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <x-empty-state title="Infografis belum tersedia" />
            @endforelse
        </div>
    </section>
@endsection
