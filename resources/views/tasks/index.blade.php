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

    <a href="{{ route('tasks.create') }}"
       class="btn btn-success btn-add-category d-inline-flex align-items-center gap-2 px-4 py-2 rounded-pill">
        <i class="feather icon-plus"></i>
        Tambah Tugas
    </a>
</div>

{{-- TABLE --}}
<div class="card category-card">
    <div class="card-body p-0">

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Tipe</th>
                    <th>Barang</th>
                    <th>Jumlah</th>
                    <th>Petugas</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>

            <tbody>
                @forelse($tasks as $task)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td class="fw-semibold">{{ $task->judul }}</td>

                    <td>
                        <span class="badge
                            {{ $task->tipe === 'masuk' ? 'bg-success' : 'bg-danger' }}">
                            {{ strtoupper($task->tipe) }}
                        </span>
                    </td>

                    <td>{{ $task->barang->nama_barang }}</td>

                    <td>
                        <span class="badge bg-info">
                            {{ $task->jumlah }}
                        </span>
                    </td>

                    <td>{{ $task->user->name }}</td>

                    <td>
                        <span class="badge
                            {{ $task->status === 'pending'
                                ? 'bg-warning text-dark'
                                : 'bg-primary' }}">
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
                        <p class="mb-0">Belum ada tugas</p>
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
