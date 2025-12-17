@extends('layouts.app')

@section('title', 'Data Kategori')

@section('content')

{{-- PAGE HEADER --}}
<div class="page-header mb-4">
    <h5 class="mb-1">Data Kategori</h5>
    <p class="text-muted mb-0">Kelola kategori barang gudang</p>
</div>

{{-- ACTION BAR --}}
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">

    <a href="{{ route('kategori.create') }}" class="btn btn-success">
        <i class="feather icon-plus"></i> Tambah Kategori
    </a>

    <form method="GET" class="d-flex gap-2">
        <input type="text"
            name="search"
            class="form-control"
            placeholder="Cari kategori..."
            value="{{ request('search') }}">
        <button class="btn btn-secondary">
            <i class="feather icon-search"></i>
        </button>
    </form>

</div>

{{-- GRID --}}
<div class="row">
    @forelse($kategori as $item)
    <div class="col-xl-3 col-lg-4 col-md-6 mb-4">

        <div class="card category-card h-100">
            <div class="card-body text-center">

                {{-- IMAGE --}}
                <div class="category-image-wrapper mb-3">
                    <img src="{{ $item->image
                        ? asset('storage/'.$item->image)
                        : asset('assets/images/default-category.png') }}"
                        alt="{{ $item->name_kategori }}"
                        class="category-image">
                </div>

                {{-- NAME --}}
                <h6 class="fw-bold mb-1">
                    {{ $item->name_kategori }}
                </h6>

                <small class="text-muted">Kategori Barang</small>

                {{-- ACTION --}}
                <div class="d-flex justify-content-center gap-2 mt-3">

                    <a href="{{ route('kategori.edit', $item->id) }}"
                        class="btn btn-warning btn-sm">
                        <i class="feather icon-edit"></i>Edit
                    </a>

                    <button type="button"
                        class="btn btn-danger btn-sm btn-delete"
                        data-id="{{ $item->id }}"
                        data-name="{{ $item->name_kategori }}">
                        <i class="feather icon-trash"></i>Delete
                    </button>

                    <form id="delete-{{ $item->id }}"
                        action="{{ route('kategori.destroy', $item->id) }}"
                        method="POST" class="d-none">
                        @csrf
                        @method('DELETE')
                    </form>

                </div>

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

{{-- PAGINATION --}}
<div class="mt-4">
    {{ $kategori->links() }}
</div>

@endsection



