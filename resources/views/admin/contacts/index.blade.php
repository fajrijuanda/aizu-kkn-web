@extends('layouts.admin', ['title' => 'Kontak'])

@section('content')
    <div class="mb-6 flex items-center justify-between gap-4">
        <p class="text-sm text-slate-600">Kelola kontak, media sosial, dan nomor penting.</p>
        <a href="{{ route('admin.kontak.create') }}" class="rounded-full bg-green-800 px-4 py-2 text-sm font-bold text-white">Tambah</a>
    </div>
    <div class="overflow-hidden rounded-2xl border border-green-100 bg-white shadow-sm">
        <table class="w-full min-w-[720px] text-left text-sm">
            <thead class="bg-green-50 text-xs uppercase text-green-900">
                <tr>
                    <th class="px-4 py-3">Label</th>
                    <th class="px-4 py-3">Tipe</th>
                    <th class="px-4 py-3">Nilai</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($items as $item)
                    <tr>
                        <td class="px-4 py-3 font-semibold text-green-950">{{ $item->label }}</td>
                        <td class="px-4 py-3">{{ $item->type }}</td>
                        <td class="px-4 py-3">{{ $item->value }}</td>
                        <td class="px-4 py-3">{{ $item->is_published ? 'Published' : 'Draft' }}</td>
                        <td class="px-4 py-3">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.kontak.edit', $item) }}" class="rounded-full border border-green-200 px-3 py-1 font-bold text-green-900">Edit</a>
                                <form method="POST" action="{{ route('admin.kontak.destroy', $item) }}" onsubmit="return confirm('Hapus kontak ini?')">
                                    @csrf @method('DELETE')
                                    <button class="rounded-full border border-red-200 px-3 py-1 font-bold text-red-700">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-4 py-8 text-center text-slate-500">Belum ada data.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $items->links() }}</div>
@endsection
