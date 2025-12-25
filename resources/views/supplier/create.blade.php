@extends('layouts.app')

@section('title', 'Tambah Supplier')

@section('content')

<div class="page-header mb-4">
    <h4 class="page-title">
        <i class="feather icon-plus text-success"></i>
        Tambah Supplier
    </h4>
</div>

<div class="card category-card">
    <div class="card-body">

        <form action="{{ route('supplier.store') }}"
            method="POST"
            enctype="multipart/form-data">
            @csrf

            @include('supplier.form')

            <div class="d-flex gap-2 mt-3">
                <button class="btn btn-success">
                    <i class="feather icon-save"></i> Simpan
                </button>
                <a href="{{ route('supplier.index') }}"
                    class="btn btn-secondary">
                    Kembali
                </a>
            </div>

        </form>

    </div>
</div>

@endsection