@extends('layouts.app')

@section('title', 'Data Tugas')

@section('content')

{{-- HEADER --}}
<div class="page-header mb-4">
    <h4 class="page-title d-flex align-items-center gap-2">
        <i class="feather icon-clipboard text-primary"></i>
        Data Tugas
    </h4>
    <span class="text-muted">
        Manajemen tugas barang masuk & keluar
    </span>
</div>

{{-- ACTION BAR --}}
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
    <div></div>

    @if(auth()->user()->role === 'admin')
    <a href="{{ route('tasks.create') }}"
        class="btn btn-success d-inline-flex align-items-center gap-2 px-4 py-2 rounded-pill">
        <i class="feather icon-plus"></i>
        Tambah Tugas
    </a>
    @endif

</div>

{{-- TABLE --}}
<div class="card category-card">
    <div class="card-body p-0">

        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Tipe</th>
                    <th>Barang</th>
                    <th>Jumlah</th>
                    <th>Lokasi</th>
                    <th>Petugas</th>
                    <th>Status</th>
                    <th>Bukti</th>
                    <th>Aksi</th>
                    <th>Tanggal</th>
                </tr>
            </thead>

            <tbody>
                @forelse($tasks as $task)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td class="fw-semibold">{{ $task->judul }}</td>

                    <td>
                        <span class="badge {{ $task->tipe === 'masuk' ? 'bg-success' : 'bg-danger' }}">
                            {{ strtoupper($task->tipe) }}
                        </span>
                    </td>

                    <td>{{ $task->barang->nama_barang }}</td>

                    <td>
                        <span class="badge bg-info">{{ $task->jumlah }}</span>
                    </td>

                    <td>{{ $task->lokasi ? $task->lokasi->nama_lokasi : '-' }}</td>

                    <td>{{ $task->user->name }}</td>

                    {{-- STATUS --}}
                    <td>
                        @if($task->status === 'pending')
                        <span class="badge bg-secondary">Pending</span>
                        @elseif($task->status === 'menunggu_acc')
                        <span class="badge bg-warning text-dark">Menunggu ACC</span>
                        @elseif($task->status === 'selesai')
                        <span class="badge bg-success">Disetujui</span>
                        @elseif($task->status === 'ditolak')
                        <span class="badge bg-danger">Ditolak</span>
                        @endif
                    </td>

                    {{-- BUKTI --}}
                    <td>
                        @if($task->bukti_foto)
                        <button type="button"
                            class="btn btn-sm btn-outline-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#buktiModal{{ $task->id }}">
                            <i class="feather icon-image"></i>
                            Lihat
                        </button>
                        @else
                        <span class="text-muted">Belum ada</span>
                        @endif
                    </td>

                    {{-- AKSI --}}
                    <td>
                        @if($task->status === 'menunggu_acc')

                        {{-- ACC --}}
                        <form action="{{ route('tasks.approve', $task->id) }}"
                            method="POST"
                            class="d-inline approve-form">
                            @csrf
                            <button type="button"
                                class="btn btn-success btn-sm btn-approve"
                                data-judul="{{ $task->judul }}">
                                <i class="feather icon-check"></i>
                            </button>
                        </form>

                        {{-- TOLAK --}}
                        <form action="{{ route('tasks.reject', $task->id) }}"
                            method="POST"
                            class="d-inline reject-form">
                            @csrf
                            <button type="button"
                                class="btn btn-danger btn-sm btn-reject"
                                data-judul="{{ $task->judul }}">
                                <i class="feather icon-x"></i>
                            </button>
                        </form>

                        @else
                        <span class="text-muted">-</span>
                        @endif
                    </td>

                    <td>
                        <small class="text-muted">
                            {{ $task->created_at->format('d M Y') }}
                        </small>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="11" class="text-center py-5">
                        <i class="feather icon-inbox f-40 text-muted"></i>
                        <p class="mt-2 mb-0">Belum ada tugas</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>

{{-- MODAL BUKTI FOTO  --}}
@foreach($tasks as $task)
@if($task->bukti_foto)
<div class="modal fade" id="buktiModal{{ $task->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Bukti Pengerjaan - {{ $task->judul }}
                </h5>
                <button type="button"
                    class="btn btn-light"
                    data-bs-dismiss="modal">
                    <i class="feather icon-x"></i>
                </button>

            </div>
            <div class="modal-body text-center">
                <img src="{{ asset('storage/'.$task->bukti_foto) }}"
                    class="img-fluid rounded">
            </div>
        </div>
    </div>
</div>
@endif
@endforeach

{{-- PAGINATION --}}
<div class="mt-4">
    {{ $tasks->links() }}
</div>

@endsection