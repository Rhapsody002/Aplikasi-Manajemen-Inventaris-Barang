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

{{-- FLASH MESSAGE --}}
@if(session('success'))
<div class="alert alert-success mb-4">
    <i class="feather icon-check-circle"></i>
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger mb-4">
    <i class="feather icon-alert-circle"></i>
    {{ session('error') }}
</div>
@endif

{{-- GRID --}}
<div class="row">

    @forelse($tasks as $task)
    <div class="col-xl-4 col-lg-6 mb-4">
        <div class="card category-card h-100">
            <div class="card-body">

                {{-- JUDUL & TIPE --}}
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <h5 class="fw-bold mb-0">
                        {{ $task->judul }}
                    </h5>
                    <span class="badge {{ $task->tipe === 'masuk' ? 'bg-success' : 'bg-danger' }}">
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
                <div class="mb-2">
                    <small class="text-muted">Jumlah</small><br>
                    <span class="badge bg-info">{{ $task->jumlah }}</span>
                </div>

                {{-- LOKASI --}}
                @if($task->lokasi)
                <div class="mb-2">
                    <small class="text-muted">Lokasi</small>
                    <div class="fw-semibold">
                        <i class="feather icon-map-pin text-primary me-1"></i>
                        {{ $task->lokasi->nama_lokasi }}
                    </div>
                </div>
                @endif

                {{-- STATUS --}}
                <div class="mb-3">
                    @if($task->status === 'pending')
                    <span class="badge bg-secondary">Pending</span>
                    @elseif($task->status === 'menunggu_acc')
                    <span class="badge bg-warning text-dark">Menunggu ACC</span>
                    @elseif($task->status === 'ditolak')
                    <span class="badge bg-danger">Ditolak</span>
                    @endif
                </div>

                {{-- ALERT STATUS --}}
                @if($task->status === 'menunggu_acc')
                <div class="alert alert-warning mt-2 mb-0">
                    <i class="feather icon-clock"></i>
                    Bukti telah dikirim, menunggu persetujuan admin
                </div>
                @elseif($task->status === 'ditolak')
                <div class="alert alert-danger mt-2 mb-0">
                    <i class="feather icon-x-circle"></i>
                    Tugas ditolak oleh admin
                </div>
                @endif

                {{-- FORM UPLOAD --}}
                @if($task->status === 'pending')
                <form action="{{ route('tasks.complete', $task->id) }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="mt-3">
                    @csrf

                    <div class="mb-2">
                        <label class="form-label">
                            Bukti Pengerjaan <span class="text-danger">*</span>
                        </label>
                        <input type="file"
                            name="bukti_foto"
                            class="form-control"
                            accept="image/*"
                            required>
                    </div>

                    <button class="btn btn-success w-100">
                        <i class="feather icon-upload"></i>
                        Kirim Bukti
                    </button>
                </form>
                @endif

            </div>
        </div>
    </div>

    @empty
    <div class="col-12 text-center py-5">
        <i class="feather icon-inbox f-40 text-muted"></i>
        <p class="mt-2">Tidak ada tugas saat ini</p>
    </div>
    @endforelse

</div>

@endsection