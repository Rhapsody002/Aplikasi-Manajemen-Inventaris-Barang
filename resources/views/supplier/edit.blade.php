@extends('layouts.app')

@section('title', 'Edit Supplier')

@section('content')

<div class="page-header mb-4">
    <h4 class="page-title">
        <i class="feather icon-edit text-warning"></i>
        Edit Supplier
    </h4>
</div>

<div class="card category-card">
    <div class="card-body">

        <form action="{{ route('supplier.update', $supplier->id) }}"
            method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @include('supplier.form')

            <div class="d-flex gap-2 mt-3">
                <button class="btn btn-warning">
                    <i class="feather icon-save"></i> Update
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