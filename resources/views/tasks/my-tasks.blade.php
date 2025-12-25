@if(session('error'))
<div class="alert alert-danger mb-4">
    <i class="feather icon-alert-circle"></i>
    {{ session('error') }}
</div>
@endif

@if(session('success'))
<div class="alert alert-success mb-4">
    <i class="feather icon-check-circle"></i>
    {{ session('success') }}
</div>
@endif


@extends('layouts.app')

@section('title', 'Tugas Saya')

@section('content')

{{-- HEADER --}}
<div class="page-header mb-4">
    <h4 class="page-title d-flex align-items-center gap-2">
        <i class="feather icon-check-square text-primary"></i>
        Tugas Saya
    </h4>
    <span class="text-muted">
        Daftar tugas yang harus Anda kerjakan
    </span>
</div>

{{-- GRID --}}
<div class="row">

    @forelse($tasks as $task)
    <div class="col-xl-4 col-lg-6 mb-4">
        <div class="card category-card h-100">
            <div class="card-body">

                {{-- HEADER CARD --}}
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <h5 class="fw-bold mb-0">
                        {{ $task->judul }}
                    </h5>

                    <span class="badge
                        {{ $task->tipe === 'masuk' ? 'bg-success' : 'bg-danger' }}">
                        {{ strtoupper($task->tipe) }}
                    </span>
                </div>

                {{-- BARANG --}}
                <div class="mb-2">
                    <small class="text-muted">Barang</small>
                    <div class="fw-semibold">
                        {{ $task->barang->nama_barang }}
                    </div>
                </div>

                {{-- JUMLAH --}}
                <div class="mb-3">
                    <small class="text-muted">Jumlah</small>
                    <div>
                        <span class="badge bg-info">
                            {{ $task->jumlah }}
                        </span>
                    </div>
                </div>

                {{-- STATUS --}}
                <div class="mb-3">
                    <span class="badge bg-warning text-dark">
                        Pending
                    </span>
                </div>

                {{-- ACTION --}}
                <form action="{{ route('tasks.complete', $task->id) }}"
                      method="POST"
                      onsubmit="return confirm('Selesaikan tugas ini?')">
                    @csrf

                    <button class="btn btn-success w-100">
                        <i class="feather icon-check"></i>
                        Selesaikan Tugas
                    </button>
                </form>

            </div>
        </div>
    </div>

    @empty
    <div class="col-12 text-center py-5">
        <i class="feather icon-inbox f-40 text-muted"></i>
        <p class="mt-2">
            Tidak ada tugas saat ini
        </p>
    </div>
    @endforelse

</div>

@endsection
