@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('kategori.store') }}"
            method="POST"
            enctype="multipart/form-data">
            @csrf

            @include('kategori.form')

            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection