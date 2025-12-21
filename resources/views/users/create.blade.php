@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')

<div class="page-header mb-4">
    <h4 class="page-title d-flex align-items-center gap-2">
        <i class="feather icon-user-plus text-primary"></i>
        Tambah User
    </h4>
    <span class="text-muted">
        Tambahkan akun pengguna baru
    </span>
</div>

<div class="card category-card">
    <div class="card-body">

        <form action="{{ route('users.store') }}"
            method="POST"
            enctype="multipart/form-data">
            @csrf

            @include('users.form')

            <div class="d-flex gap-2">
                <button class="btn btn-success px-4">
                    <i class="feather icon-save"></i>
                    Simpan
                </button>
                <a href="{{ route('users.index') }}"
                    class="btn btn-secondary px-4">
                    Kembali
                </a>
            </div>

        </form>

    </div>
</div>

@endsection