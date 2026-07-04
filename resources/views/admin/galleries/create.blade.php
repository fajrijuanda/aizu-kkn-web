@extends('layouts.admin', ['title' => 'Tambah Galeri'])

@section('content')
    <form method="POST" action="{{ route('admin.galeri.store') }}" enctype="multipart/form-data" class="max-w-3xl rounded-2xl border border-green-100 bg-white p-6 shadow-sm">
        @csrf
        @include('admin.galleries.form')
    </form>
@endsection
