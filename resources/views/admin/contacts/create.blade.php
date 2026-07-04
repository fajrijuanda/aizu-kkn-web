@extends('layouts.admin', ['title' => 'Tambah Kontak'])

@section('content')
    <form method="POST" action="{{ route('admin.kontak.store') }}" class="max-w-3xl rounded-2xl border border-green-100 bg-white p-6 shadow-sm">
        @csrf
        @include('admin.contacts.form')
    </form>
@endsection
