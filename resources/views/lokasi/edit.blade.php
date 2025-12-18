@extends('layouts.app')

@section('title', 'Edit Lokasi')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('lokasi.update', $lokasi->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('lokasi.form')
            <button class="btn btn-warning">Update</button>
            <a href="{{ route('lokasi.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection