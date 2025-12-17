@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
<div class="page-header">
    <div class="page-block">
        <h5 class="mb-0">Tambah Kategori</h5>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('kategori.store') }}" method="POST">
            @csrf

            @include('kategori.form')

            <div class="mt-3">
                <button class="btn btn-primary">
                    <i class="feather icon-save"></i> Simpan
                </button>

                <a href="{{ route('kategori.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
