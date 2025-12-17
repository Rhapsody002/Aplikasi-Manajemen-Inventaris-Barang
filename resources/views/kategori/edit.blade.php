@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('kategori.update', $kategori->id) }}"
            method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @include('kategori.form')

            <button class="btn btn-primary">Update</button>
            <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection