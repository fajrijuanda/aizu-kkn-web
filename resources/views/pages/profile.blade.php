@extends('layouts.public', ['title' => 'Profil Desa'])

@section('content')
    <section class="bg-green-950 px-4 py-16 text-white sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <p class="text-sm font-bold uppercase text-amber-300">Profil Desa</p>
            <h1 class="mt-3 text-4xl font-black">{{ $profile?->name ?? 'Desa KKN AIZU' }}</h1>
            <p class="mt-4 max-w-3xl text-lg leading-8 text-green-50">{{ $profile?->tagline }}</p>
        </div>
    </section>
    <section class="mx-auto grid max-w-7xl gap-8 px-4 py-12 sm:px-6 lg:grid-cols-[1.1fr_.9fr] lg:px-8">
        <article class="rounded-3xl border border-green-100 bg-white p-6 shadow-sm">
            <h2 class="text-2xl font-black text-green-950">Sejarah Singkat</h2>
            <p class="mt-4 leading-8 text-slate-700">{{ $profile?->history }}</p>
            <h2 class="mt-8 text-2xl font-black text-green-950">Visi</h2>
            <p class="mt-4 leading-8 text-slate-700">{{ $profile?->vision }}</p>
            <h2 class="mt-8 text-2xl font-black text-green-950">Misi</h2>
            <ul class="mt-4 grid gap-3">
                @foreach (($profile?->missions ?? []) as $mission)
                    <li class="rounded-2xl bg-green-50 p-4 text-sm font-semibold text-green-950">{{ $mission }}</li>
                @endforeach
            </ul>
        </article>
        <aside class="grid gap-5">
            <div class="rounded-3xl border border-green-100 bg-green-50 p-6">
                <p class="text-sm font-bold uppercase text-amber-800">Identitas</p>
                <div class="mt-4 grid gap-3 text-sm">
                    <p><span class="font-bold text-green-950">Kecamatan:</span> {{ $profile?->district }}</p>
                    <p><span class="font-bold text-green-950">Kabupaten:</span> {{ $profile?->regency }}</p>
                    <p><span class="font-bold text-green-950">Provinsi:</span> {{ $profile?->province }}</p>
                    <p><span class="font-bold text-green-950">Luas:</span> {{ $profile?->area }}</p>
                </div>
            </div>
            <div class="rounded-3xl border border-green-100 bg-white p-6 shadow-sm">
                <p class="text-sm font-bold uppercase text-amber-800">Kontak Publik</p>
                <div class="mt-4 grid gap-3 text-sm text-slate-700">
                    @forelse ($contacts as $contact)
                        <p><span class="font-bold text-green-950">{{ $contact->label }}:</span> {{ $contact->value }}</p>
                    @empty
                        <x-empty-state title="Kontak belum tersedia" />
                    @endforelse
                </div>
            </div>
        </aside>
    </section>
@endsection
