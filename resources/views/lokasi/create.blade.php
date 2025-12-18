@extends('layouts.app')

@section('title', 'Tambah Lokasi')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('lokasi.store') }}" method="POST">
            @csrf

            @include('lokasi.form')

            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('lokasi.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection