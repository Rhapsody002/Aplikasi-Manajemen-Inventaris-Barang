@extends('layouts.app')

@section('title', 'Data Kategori')

@section('content')

{{-- HEADER --}}
<div class="page-header mb-4">
    <h4 class="fw-bold">Data Kategori</h4>
    <span class="text-muted">Manajemen kategori barang gudang</span>
</div>

{{-- INFO --}}
<div class="row mb-4">
    <div class="col-md-3">
        <div class="info-box">
            <i class="feather icon-layers"></i>
            <div>
                <small>Total Kategori</small>
                <h5 class="mb-0">{{ $kategori->total() }}</h5>
            </div>
        </div>
    </div>
</div>

{{-- ACTION BAR --}}
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">

    {{-- Tambah --}}
    @if(auth()->user()->role === 'admin')
    <a href="{{ route('kategori.create') }}"
        class="btn btn-success btn-add-category d-inline-flex align-items-center gap-2 px-4 py-2 rounded-pill">
        <i class="feather icon-plus"></i>
        Tambah Kategori
    </a>
    @endif
    {{-- Search --}}
    <form method="GET" class="search-group">

        <i class="feather icon-search search-icon"></i>

        <input type="text"
            name="search"
            class="form-control search-input"
            placeholder="Cari kategori..."
            value="{{ request('search') }}">

        @if(request('search'))
        <a href="{{ route('kategori.index') }}"
            class="search-clear"
            title="Reset pencarian">
            <i class="feather icon-x"></i>
        </a>
        @endif

    </form>

</div>

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

{{-- GRID --}}
<div class="row">
    @forelse($kategori as $item)
    <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
        <div class="card category-card h-100">
            <div class="card-body text-center">

                <div class="category-image-wrapper mb-3">
                    <img src="{{ $item->gambar_kategori
                        ? asset('storage/'.$item->gambar_kategori)
                        : asset('assets/images/default-category.png') }}"
                        class="category-image-rect">
                </div>

                <h5 class="category-title">
                    {{ $item->nama_kategori }}
                </h5>

                @if(auth()->user()->role === 'admin')
                <div class="d-flex justify-content-center gap-2 mt-3">
                    <a href="{{ route('kategori.edit', $item->id) }}"
                        class="btn btn-outline-warning btn-sm px-3">
                        <i class="feather icon-edit"></i>Edit
                    </a>

                    <form id="delete-form-{{ $item->id }}"
                        action="{{ route('kategori.destroy', $item->id) }}"
                        method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="button"
                            class="btn btn-outline-danger btn-sm px-3 btn-delete"
                            data-id="{{ $item->id }}"
                            data-name="{{ $item->nama_kategori }}">
                            <i class="feather icon-trash"></i>Delete
                        </button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center py-5">
        <i class="feather icon-inbox f-40 text-muted"></i>
        <p class="mt-2">Belum ada data kategori</p>
    </div>
    @endforelse
</div>

{{ $kategori->links() }}



@endsection