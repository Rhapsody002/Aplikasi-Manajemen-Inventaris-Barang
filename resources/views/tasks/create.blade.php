@extends('layouts.app')

@section('title', 'Tambah Tugas')

@section('content')

{{-- HEADER --}}
<div class="page-header mb-4">
    <h4 class="page-title d-flex align-items-center gap-2">
        <i class="feather icon-clipboard text-primary"></i>
        Tambah Tugas
    </h4>
    <span class="text-muted">
        Assign tugas barang masuk / keluar ke petugas
    </span>
</div>

<div class="card category-card">
    <div class="card-body">

        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf

            @include('tasks.form')

            <div class="d-flex gap-2 mt-3">
                <button class="btn btn-success px-4">
                    <i class="feather icon-save"></i>
                    Simpan
                </button>

                <a href="{{ route('tasks.index') }}"
                   class="btn btn-secondary px-4">
                    Kembali
                </a>
            </div>

        </form>

    </div>
</div>

@endsection
