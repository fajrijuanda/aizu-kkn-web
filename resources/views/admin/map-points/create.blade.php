@extends('layouts.admin', ['title' => 'Tambah Titik Peta'])

@section('content')
    <form method="POST" action="{{ route('admin.peta-desa.store') }}" class="max-w-3xl rounded-2xl border border-green-100 bg-white p-6 shadow-sm">
        @csrf
        @include('admin.map-points.form')
    </form>
@endsection
