@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')
<div class="page-header">
    <div class="page-block">
        <h5 class="mb-0">Edit Kategori</h5>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
            @csrf
            @method('PUT')

            @include('kategori.form')

            <div class="mt-3">
                <button class="btn btn-primary">
                    <i class="feather icon-refresh-cw"></i> Update
                </button>

                <a href="{{ route('kategori.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
