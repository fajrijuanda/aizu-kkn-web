@extends('layouts.public', ['title' => $msme->name])

@section('content')
    <section class="mx-auto grid max-w-7xl gap-8 px-4 py-14 sm:px-6 lg:grid-cols-[.95fr_1.05fr] lg:px-8">
        <div>
            @if ($msme->image_base64)
                <img src="{{ $msme->image_base64 }}" alt="{{ $msme->image_alt ?? $msme->name }}" class="aspect-[4/3] w-full rounded-3xl object-cover shadow-sm">
            @endif
        </div>
        <article>
            <p class="text-sm font-bold uppercase text-amber-800">{{ $msme->category }}</p>
            <h1 class="mt-3 text-4xl font-black text-green-950">{{ $msme->name }}</h1>
            <p class="mt-3 text-sm font-semibold text-stone-600">Pemilik: {{ $msme->owner_name ?? '-' }}</p>
            <p class="mt-6 leading-8 text-slate-700">{{ $msme->description }}</p>
            <div class="mt-6 rounded-2xl border border-green-100 bg-green-50 p-5">
                <p class="font-bold text-green-950">Produk</p>
                <p class="mt-2 text-sm leading-6 text-slate-700">{{ $msme->products }}</p>
            </div>
            <div class="mt-6 grid gap-3 text-sm text-slate-700">
                <p><span class="font-bold text-green-950">Alamat:</span> {{ $msme->address }}</p>
                <p><span class="font-bold text-green-950">Telepon:</span> {{ $msme->phone }}</p>
            </div>
            @if ($msme->whatsapp)
                <a href="https://wa.me/{{ $msme->whatsapp }}" class="mt-8 inline-flex rounded-full bg-green-800 px-5 py-3 text-sm font-bold text-white hover:bg-green-900">Hubungi via WhatsApp</a>
            @endif
        </article>
    </section>
@endsection
