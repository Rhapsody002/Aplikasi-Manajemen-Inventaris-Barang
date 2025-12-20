@extends('layouts.app')

@section('title', 'Tambah Barang')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('barang.store') }}"
            method="POST"
            enctype="multipart/form-data"> {{-- ⬅️ WAJIB --}}
            @csrf

            @include('barang.form')

            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('barang.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection