@extends('layouts.admin', ['title' => 'Tambah Potensi'])

@section('content')
    <form method="POST" action="{{ route('admin.potensi-desa.store') }}" enctype="multipart/form-data" class="max-w-4xl rounded-2xl border border-green-100 bg-white p-6 shadow-sm">
        @csrf
        @include('admin.potentials.form')
    </form>
@endsection
