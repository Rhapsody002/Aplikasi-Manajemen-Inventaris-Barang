@extends('layouts.app')

@section('title', 'Data Supplier')

@section('content')

{{-- HEADER --}}
<div class="page-header mb-4">
    <h4 class="page-title d-flex align-items-center gap-2">
        <i class="feather icon-truck text-primary"></i>
        Data Supplier
    </h4>
    <span class="page-subtitle">
        Manajemen supplier barang
    </span>
</div>

{{-- TOP SECTION (SAMA SEPERTI LOKASI) --}}
<div class="row mb-4">

    {{-- INFO BOX --}}
    <div class="col-md-4 mb-3">
        <div class="info-box">
            <i class="feather icon-truck"></i>
            <div>
                <h6>Total Supplier</h6>
                <strong>{{ $suppliers->total() }}</strong>
            </div>
        </div>

        {{-- TOMBOL TAMBAH (ADMIN ONLY) --}}
        @if(auth()->user()->role === 'admin')
        <a href="{{ route('supplier.create') }}"
            class="btn btn-success btn-add-category mt-3 px-4 rounded-pill">
            <i class="feather icon-plus"></i>
            Tambah Supplier
        </a>
        @endif
    </div>

    {{-- SEARCH --}}
    <div class="col-md-8 d-flex align-items-end justify-content-end">
        <form method="GET" action="{{ route('supplier.index') }}">
            <div class="search-group">
                <i class="feather icon-search search-icon"></i>
                <input type="text"
                    name="search"
                    value="{{ request('search') }}"
                    class="form-control search-input"
                    placeholder="Cari supplier...">
            </div>
        </form>
    </div>

</div>

{{-- GRID SUPPLIER --}}
<div class="row">
    @forelse($suppliers as $supplier)
    <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
        <div class="card category-card h-100">
            <div class="card-body text-center">

                {{-- LOGO --}}
                <div class="user-avatar-container mb-3">
                    <div class="user-avatar-bg">
                        <img src="{{ $supplier->logo_supplier
                            ? asset('storage/'.$supplier->logo_supplier)
                            : asset('assets/images/upload-placeholder.png') }}"
                            class="user-avatar-img">
                    </div>
                </div>

                {{-- NAMA --}}
                <h5 class="fw-bold mb-1">
                    {{ $supplier->nama_supplier }}
                </h5>

                {{-- TELEPON --}}
                <small class="text-muted d-block mb-2">
                    {{ $supplier->telepon ?? '-' }}
                </small>

                {{-- ALAMAT --}}
                <small class="text-muted d-block">
                    {{ Str::limit($supplier->alamat, 40) }}
                </small>

                {{-- ACTION (ADMIN ONLY) --}}
                @if(auth()->user()->role === 'admin')
                <div class="d-flex justify-content-center gap-2 mt-3">
                    <a href="{{ route('supplier.edit', $supplier->id) }}"
                        class="btn btn-outline-warning btn-sm px-3">
                        <i class="feather icon-edit"></i>
                        Edit
                    </a>

                    <form action="{{ route('supplier.destroy', $supplier->id) }}"
                        method="POST"
                        onsubmit="return confirm('Hapus supplier ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger btn-sm px-3">
                            <i class="feather icon-trash"></i>
                            Hapus
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
        <p class="mt-2">Belum ada data supplier</p>
    </div>
    @endforelse
</div>

{{-- PAGINATION --}}
<div class="mt-4">
    {{ $suppliers->links() }}
</div>

@endsection