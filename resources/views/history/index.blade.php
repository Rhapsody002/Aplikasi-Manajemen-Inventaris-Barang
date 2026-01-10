@extends('layouts.app')

@section('title', 'History Tugas')

@section('content')

{{-- HEADER --}}
<div class="page-header mb-4">
    <h4 class="page-title d-flex align-items-center gap-2">
        <i class="feather icon-archive text-primary"></i>
        History Tugas
    </h4>
    <span class="text-muted">
        Riwayat tugas barang masuk & keluar yang telah diproses
    </span>
</div>

{{-- FILTER --}}
@include('history.filter')

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

                    @if(auth()->user()->role !== 'petugas')
                    <th>Petugas</th>
                    @endif

                    <th>Status</th>
                    <th>Bukti</th>
                    <th>ACC Oleh</th>
                    <th>Tanggal ACC</th>
                </tr>
            </thead>

            <tbody>
                @forelse($tasks as $task)
                <tr>
                    <td>
                        {{ $loop->iteration + ($tasks->currentPage() - 1) * $tasks->perPage() }}
                    </td>

                    <td class="fw-semibold">
                        {{ $task->judul }}
                    </td>

                    <td>
                        <span class="badge {{ $task->tipe === 'masuk' ? 'bg-success' : 'bg-danger' }}">
                            {{ strtoupper($task->tipe) }}
                        </span>
                    </td>

                    <td>{{ $task->barang->nama_barang }}</td>

                    <td>
                        <span class="badge bg-info text-white">
                            {{ $task->jumlah }}
                        </span>
                    </td>

                    <td>{{ $task->lokasi?->nama_lokasi ?? '-' }}</td>

                    @if(auth()->user()->role !== 'petugas')
                    <td>{{ $task->user->name }}</td>
                    @endif

                    {{-- STATUS --}}
                    <td>
                        @if($task->status === 'selesai')
                        <span class="badge bg-success">
                            Disetujui
                        </span>
                        @elseif($task->status === 'ditolak')
                        <span class="badge bg-danger">
                            Ditolak
                        </span>
                        @endif
                    </td>

                    {{-- BUKTI --}}
                    <td>
                        @if($task->bukti_foto)
                        <a href="{{ asset('storage/'.$task->bukti_foto) }}"
                            target="_blank"
                            class="btn btn-sm btn-outline-primary">
                            <i class="feather icon-image"></i> Lihat
                        </a>
                        @else
                        <span class="text-muted">-</span>
                        @endif
                    </td>

                    {{-- ACC OLEH --}}
                    <td>
                        {{ optional($task->accBy)->name ?? '-' }}
                    </td>

                    {{-- TANGGAL ACC --}}
                    <td>
                        <small class="text-muted">
                            {{ $task->acc_at ? $task->acc_at->format('d M Y H:i') : '-' }}
                        </small>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="11" class="text-center py-5">
                        <i class="feather icon-inbox f-40 text-muted"></i>
                        <p class="mt-2 mb-0">Belum ada data history</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>

{{-- PAGINATION --}}
<div class="mt-4">
    {{ $tasks->links() }}
</div>

@endsection