@extends('layouts.app')

@section('title', 'Data Lokasi')

@section('content')

{{-- HEADER --}}
<div class="page-header mb-4">
    <h4 class="page-title d-flex align-items-center gap-2">
        <i class="feather icon-map-pin text-primary"></i>
        Data Lokasi
    </h4>
    <span class="text-muted">
        Manajemen lokasi penyimpanan barang
    </span>
</div>

{{-- INFO --}}
<div class="row mb-4">
    <div class="col-md-3">
        <div class="info-box">
            <i class="feather icon-map-pin"></i>
            <div>
                <h6>Total Lokasi</h6>
                <strong>{{ $lokasi->total() }}</strong>
            </div>
        </div>
    </div>
</div>

{{-- ACTION BAR --}}
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">

    @if(auth()->user()->role === 'admin')
    <a href="{{ route('lokasi.create') }}"
        class="btn btn-success btn-add-category d-inline-flex align-items-center gap-2 px-4 py-2 rounded-pill">
        <i class="feather icon-plus"></i>
        Tambah Lokasi
    </a>
    @endif

    <form method="GET" class="search-wrapper">
        <i class="feather icon-search"></i>
        <input type="text"
            name="search"
            class="form-control"
            placeholder="Cari lokasi..."
            value="{{ request('search') }}">
    </form>

</div>

{{-- GRID --}}
<div class="row">
    @forelse($lokasi as $item)
    <div class="col-md-4 col-lg-3 mb-4">
        <div class="card category-card h-100">
            <div class="card-body text-center">

                <div class="category-icon mb-3">
                    <i class="feather icon-map-pin"></i>
                </div>

                <h5 class="category-title">
                    {{ $item->nama_lokasi }}
                </h5>

                @if($item->keterangan)
                <small class="text-muted">
                    {{ $item->keterangan }}
                </small>
                @endif

                {{-- ACTION --}}
                @if(auth()->user()->role === 'admin')
                <div class="d-flex justify-content-center gap-2 mt-3">
                    <a href="{{ route('lokasi.edit', $item->id) }}"
                        class="btn btn-warning btn-sm">
                        <i class="feather icon-edit"></i>Edit
                    </a>

                    <form action="{{ route('lokasi.destroy', $item->id) }}"
                        method="POST"
                        id="delete-form-{{ $item->id }}"
                        class="d-inline">
                        @csrf
                        @method('DELETE')

                        <button type="button"
                            class="btn btn-danger btn-sm btn-delete"
                            data-id="{{ $item->id }}"
                            data-name="{{ $item->nama_lokasi }}">
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
        <p class="mt-2">Belum ada data lokasi</p>
    </div>
    @endforelse
</div>

<div class="mt-4">
    {{ $lokasi->links() }}
</div>

@if(session('error'))
<div class="alert alert-danger d-flex align-items-center gap-2">
    <i class="feather icon-alert-circle"></i>
    {{ session('error') }}
</div>
@endif

@endsection