@extends('layouts.app')

@section('title', 'Data Barang')

@section('content')

{{-- HEADER --}}
<div class="page-header mb-4">
    <h4 class="fw-bold">Data Barang</h4>
    <span class="text-muted">Manajemen barang gudang</span>
</div>

{{-- INFO --}}
<div class="row mb-4">
    <div class="col-md-3">
        <div class="info-box">
            <i class="feather icon-box"></i>
            <div>
                <small>Total Barang</small>
                <h5 class="mb-0">{{ $barang->total() }}</h5>
            </div>
        </div>
    </div>
</div>

{{-- ACTION BAR --}}
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">

    {{-- Tambah --}}
    @if(auth()->user()->role === 'admin')
    <a href="{{ route('barang.create') }}"
        class="btn btn-success btn-add-category d-inline-flex align-items-center gap-2 px-4 py-2 rounded-pill">
        <i class="feather icon-plus"></i>
        Tambah Barang
    </a>
    @endif

    <form method="GET" class="search-group">
        <i class="feather icon-search search-icon"></i>
        <input type="text"
            name="search"
            class="form-control search-input"
            placeholder="Cari barang..."
            value="{{ request('search') }}">
    </form>
</div>

{{-- GRID --}}
<div class="row">
    @forelse($barang as $item)
    <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
        <div class="card category-card h-100">
            <div class="card-body text-center">

                <div class="category-image-wrapper mb-3">
                    <img src="{{ $item->foto_barang
                        ? asset('storage/'.$item->foto_barang)
                        : asset('assets/images/default-product.png') }}"
                        class="category-image-rect">
                </div>

                <h5 class="category-title">
                    {{ $item->nama_barang }}
                </h5>

                <small class="text-muted">
                    {{ $item->kategori->nama_kategori }}
                </small>

                <div class="mt-2">
                    <span class="badge bg-info text-white">
                        Stok: {{ $item->stok }}
                    </span>
                </div>

                @if(auth()->user()->role === 'admin')
                <div class="d-flex justify-content-center gap-2 mt-3">

                    <a href="{{ route('barang.edit', $item->id) }}"
                        class="btn btn-outline-warning btn-sm px-3">
                        <i class="feather icon-edit"></i> Edit
                    </a>

                    <form action="{{ route('barang.destroy', $item->id) }}"
                        method="POST"
                        id="delete-form-{{ $item->id }}"
                        class="d-inline">
                        @csrf
                        @method('DELETE')

                        <button type="button"
                            class="btn btn-outline-danger btn-sm px-3 btn-delete"
                            data-id="{{ $item->id }}"
                            data-name="{{ $item->nama_barang }}">
                            <i class="feather icon-trash"></i> Delete
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
        <p class="mt-2">Belum ada data barang</p>
    </div>
    @endforelse
</div>

{{ $barang->links() }}

@endsection