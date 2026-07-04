@extends('layouts.public', ['title' => $potential->title])

@section('content')
    <section class="mx-auto grid max-w-7xl gap-8 px-4 py-14 sm:px-6 lg:grid-cols-[.95fr_1.05fr] lg:px-8">
        <div>
            @if ($potential->image_base64)
                <img src="{{ $potential->image_base64 }}" alt="{{ $potential->image_alt ?? $potential->title }}" class="aspect-[4/3] w-full rounded-3xl object-cover shadow-sm">
            @endif
        </div>
        <article>
            <p class="text-sm font-bold uppercase text-amber-800">{{ $potential->category }}</p>
            <h1 class="mt-3 text-4xl font-black text-green-950">{{ $potential->title }}</h1>
            <p class="mt-3 text-sm font-semibold text-stone-600">{{ $potential->location }}</p>
            <p class="mt-6 text-lg leading-8 text-slate-700">{{ $potential->summary }}</p>
            <div class="mt-6 rounded-2xl border border-green-100 bg-white p-6 shadow-sm">
                <p class="leading-8 text-slate-700">{{ $potential->description }}</p>
            </div>
        </article>
    </section>
@endsection
