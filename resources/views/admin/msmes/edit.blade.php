@extends('layouts.admin', ['title' => 'Edit UMKM'])

@section('content')
    <form method="POST" action="{{ route('admin.umkm.update', $item) }}" enctype="multipart/form-data" class="max-w-4xl rounded-2xl border border-green-100 bg-white p-6 shadow-sm">
        @csrf @method('PUT')
        @include('admin.msmes.form')
    </form>
@endsection
