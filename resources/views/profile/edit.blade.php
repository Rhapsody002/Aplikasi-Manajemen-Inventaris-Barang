@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')

<div class="page-header mb-4">
    <h4 class="fw-bold">Edit Profil</h4>
    <span class="text-muted">Perbarui data akun Anda</span>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('profile.update') }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- NAMA --}}
            <div class="form-group mb-3">
                <label>Nama</label>
                <input type="text"
                       name="name"
                       class="form-control"
                       value="{{ old('name', $user->name) }}"
                       required>
            </div>

            {{-- PASSWORD --}}
            <div class="form-group mb-3">
                <label>Password Baru (opsional)</label>
                <input type="password"
                       name="password"
                       class="form-control">
            </div>

            <div class="form-group mb-3">
                <label>Konfirmasi Password</label>
                <input type="password"
                       name="password_confirmation"
                       class="form-control">
            </div>

            {{-- FOTO --}}
            <div class="form-group mb-4">
                <label>Foto Profil</label>
                <input type="file"
                       name="foto_profil"
                       class="form-control">
            </div>

            <button class="btn btn-success">
                <i class="feather icon-save"></i>
                Simpan Perubahan
            </button>

            <a href="{{ route('profile.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>

        </form>
    </div>
</div>

@endsection
