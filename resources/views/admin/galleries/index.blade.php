@extends('layouts.admin', ['title' => 'Galeri'])

@section('content')
    <div class="mb-6 flex items-center justify-between gap-4">
        <p class="text-sm text-slate-600">Kelola foto dokumentasi desa dan kegiatan KKN.</p>
        <a href="{{ route('admin.galeri.create') }}" class="rounded-full bg-green-800 px-4 py-2 text-sm font-bold text-white">Tambah</a>
    </div>
    <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-4">
        @forelse ($items as $item)
            <article class="overflow-hidden rounded-2xl border border-green-100 bg-white shadow-sm">
                @if ($item->image_base64)
                    <img src="{{ $item->image_base64 }}" alt="{{ $item->title }}" class="aspect-[4/3] w-full object-cover">
                @endif
                <div class="p-4">
                    <p class="text-xs font-bold uppercase text-amber-800">{{ $item->category }}</p>
                    <h2 class="mt-1 font-black text-green-950">{{ $item->title }}</h2>
                    <p class="mt-1 text-xs text-slate-500">{{ $item->is_published ? 'Published' : 'Draft' }}</p>
                    <div class="mt-4 flex gap-2">
                        <a href="{{ route('admin.galeri.edit', $item) }}" class="rounded-full border border-green-200 px-3 py-1 text-xs font-bold text-green-900">Edit</a>
                        <form method="POST" action="{{ route('admin.galeri.destroy', $item) }}" onsubmit="return confirm('Hapus foto ini?')">
                            @csrf @method('DELETE')
                            <button class="rounded-full border border-red-200 px-3 py-1 text-xs font-bold text-red-700">Hapus</button>
                        </form>
                    </div>
                </div>
            </article>
        @empty
            <div class="sm:col-span-2 xl:col-span-4 rounded-2xl border border-green-100 bg-white p-8 text-center text-slate-500">Belum ada data.</div>
        @endforelse
    </div>
    <div class="mt-6">{{ $items->links() }}</div>
@endsection
