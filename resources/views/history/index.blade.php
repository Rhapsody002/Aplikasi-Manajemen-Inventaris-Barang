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
        Riwayat tugas barang masuk & keluar
    </span>
</div>

{{-- FILTER --}}
@include('history.filter')

{{-- CARD TABLE --}}
<div class="card category-card">
    <div class="card-body p-0">

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Judul</th>
                    <th>Tipe</th>
                    <th>Barang</th>
                    <th>Jumlah</th>

                    @if(auth()->user()->role !== 'petugas')
                    <th>Petugas</th>
                    @endif

                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>

            <tbody>
                @forelse($tasks as $task)
                <tr>
                    <td>
                        {{ $loop->iteration + ($tasks->currentPage()-1)*$tasks->perPage() }}
                    </td>

                    <td class="fw-semibold">
                        {{ $task->judul }}
                    </td>

                    <td>
                        <span class="badge {{ $task->tipe === 'masuk' ? 'bg-success' : 'bg-danger' }}">
                            {{ strtoupper($task->tipe) }}
                        </span>
                    </td>

                    <td>
                        {{ $task->barang->nama_barang }}
                    </td>

                    <td>
                        <span class="badge bg-info text-white">
                            {{ $task->jumlah }}
                        </span>
                    </td>

                    @if(auth()->user()->role !== 'petugas')
                    <td>{{ $task->user->name }}</td>
                    @endif

                    <td>
                        <span class="badge {{ $task->status === 'pending' ? 'bg-warning text-dark' : 'bg-primary' }}">
                            {{ ucfirst($task->status) }}
                        </span>
                    </td>

                    <td>
                        <small class="text-muted">
                            {{ $task->created_at->format('d M Y') }}
                        </small>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-4">
                        <i class="feather icon-inbox text-muted"></i>
                        <p class="mb-0">Belum ada data history</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>

<div class="mt-4">
    {{ $tasks->links() }}
</div>

@endsection