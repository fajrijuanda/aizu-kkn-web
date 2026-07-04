@extends('layouts.admin', ['title' => 'Edit Galeri'])

@section('content')
    <form method="POST" action="{{ route('admin.galeri.update', $item) }}" enctype="multipart/form-data" class="max-w-3xl rounded-2xl border border-green-100 bg-white p-6 shadow-sm">
        @csrf @method('PUT')
        @include('admin.galleries.form')
    </form>
@endsection
