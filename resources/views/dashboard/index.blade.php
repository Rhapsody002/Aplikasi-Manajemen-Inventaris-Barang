@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

{{-- HEADER --}}
<div class="page-header mb-4">
    <h4 class="fw-bold mb-1">Dashboard</h4>
    <span class="text-muted">Ringkasan data gudang hari ini</span>
</div>

{{-- KPI UTAMA --}}
<div class="row">

    <div class="col-md-4 mb-4">
        @include('partials.card', [
        'icon' => 'box',
        'color' => 'primary',
        'title' => 'Total Barang',
        'value' => $totalBarang
        ])
    </div>

    <div class="col-md-4 mb-4">
        @include('partials.card', [
        'icon' => 'package',
        'color' => 'info',
        'title' => 'Total Stok',
        'value' => $totalStok
        ])
    </div>

    <div class="col-md-4 mb-4">
        @include('partials.card', [
        'icon' => 'log-in',
        'color' => 'success',
        'title' => 'Barang Masuk',
        'value' => $totalBarangMasuk
        ])
    </div>

    <div class="col-md-4 mb-4">
        @include('partials.card', [
        'icon' => 'log-out',
        'color' => 'danger',
        'title' => 'Barang Keluar',
        'value' => $totalBarangKeluar
        ])
    </div>

    <div class="col-md-4 mb-4">
        @include('partials.card', [
        'icon' => 'clipboard',
        'color' => 'warning',
        'title' => 'Tugas Pending',
        'value' => $tugasPending
        ])
    </div>

    <div class="col-md-4 mb-4">
        @include('partials.card', [
        'icon' => 'alert-circle',
        'color' => 'danger',
        'title' => 'Stok Kritis',
        'value' => $stokKritis
        ])
    </div>

</div>

{{-- AKTIVITAS TERAKHIR --}}
<div class="card mt-4">
    <div class="card-header fw-semibold">
        Aktivitas Terakhir
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Tugas</th>
                        <th>Barang</th>
                        <th>Tipe</th>
                        <th>Petugas</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($recentTasks as $task)
                    <tr>
                        {{-- TUGAS --}}
                        <td class="fw-semibold">
                            {{ $task->judul }}
                        </td>

                        {{-- BARANG --}}
                        <td>
                            {{ $task->barang->nama_barang }}
                        </td>

                        {{-- TIPE --}}
                        <td>
                            <span class="badge
                                {{ $task->tipe === 'masuk' ? 'bg-success' : 'bg-danger' }}">
                                {{ strtoupper($task->tipe) }}
                            </span>
                        </td>

                        {{-- PETUGAS --}}
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="avatar-sm bg-primary text-white rounded-circle text-center">
                                    {{ strtoupper(substr($task->user->name, 0, 1)) }}
                                </div>
                                {{ $task->user->name }}
                            </div>
                        </td>

                        {{-- JUMLAH --}}
                        <td>
                            <span class="badge bg-info">
                                {{ $task->jumlah }}
                            </span>
                        </td>

                        {{-- STATUS --}}
                        <td>
                            <span class="badge bg-success">
                                Selesai
                            </span>
                        </td>

                        {{-- TANGGAL --}}
                        <td class="text-muted">
                            {{ $task->created_at->format('d M Y') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">
                            Belum ada aktivitas
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection