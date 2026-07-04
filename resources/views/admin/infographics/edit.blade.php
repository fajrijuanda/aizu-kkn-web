@extends('layouts.admin', ['title' => 'Edit Infografis'])

@section('content')
    <form method="POST" action="{{ route('admin.infografis.update', $item) }}" class="max-w-3xl rounded-2xl border border-green-100 bg-white p-6 shadow-sm">
        @csrf @method('PUT')
        @include('admin.infographics.form')
    </form>
@endsection
