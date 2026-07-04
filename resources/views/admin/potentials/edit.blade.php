@extends('layouts.admin', ['title' => 'Edit Potensi'])

@section('content')
    <form method="POST" action="{{ route('admin.potensi-desa.update', $item) }}" enctype="multipart/form-data" class="max-w-4xl rounded-2xl border border-green-100 bg-white p-6 shadow-sm">
        @csrf @method('PUT')
        @include('admin.potentials.form')
    </form>
@endsection
