@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

{{-- HEADER --}}
<div class="page-header mb-5">
    <h4 class="fw-bold mb-1">Dashboard</h4>
    <span class="text-muted">Ringkasan data gudang hari ini</span>
</div>

<div class="row">

    {{-- TOTAL BARANG --}}
    <div class="col-md-4 mb-4">
        <div class="card dashboard-card">
            <div class="card-body d-flex align-items-center">
                <div class="dashboard-icon bg-primary">
                    <i class="feather icon-box"></i>
                </div>
                <div class="dashboard-info">
                    <span class="dashboard-title">Total Barang</span>
                    <h2 class="dashboard-value">{{ $totalBarang }}</h2>
                </div>
            </div>
        </div>
    </div>

    {{-- TOTAL STOK --}}
    <div class="col-md-4 mb-4">
        <div class="card dashboard-card">
            <div class="card-body d-flex align-items-center">
                <div class="dashboard-icon bg-info">
                    <i class="feather icon-package"></i>
                </div>


                <div class="dashboard-info">
                    <span class="dashboard-title">Total Stok</span>
                    <h2 class="dashboard-value">{{ $totalStok }}</h2>
                </div>
            </div>
        </div>
    </div>

    {{-- TOTAL KATEGORI --}}
    <div class="col-md-4 mb-4">
        <div class="card dashboard-card">
            <div class="card-body d-flex align-items-center">
                <div class="dashboard-icon bg-warning">
                    <i class="feather icon-layers"></i>
                </div>
                <div class="dashboard-info">
                    <span class="dashboard-title">Total Kategori</span>
                    <h2 class="dashboard-value">{{ $totalKategori }}</h2>
                </div>
            </div>
        </div>
    </div>

    {{-- TOTAL LOKASI --}}
    <div class="col-md-4 mb-4">
        <div class="card dashboard-card">
            <div class="card-body d-flex align-items-center">
                <div class="dashboard-icon bg-secondary">
                    <i class="feather icon-map-pin"></i>
                </div>
                <div class="dashboard-info">
                    <span class="dashboard-title">Total Lokasi</span>
                    <h2 class="dashboard-value">{{ $totalLokasi }}</h2>
                </div>
            </div>
        </div>
    </div>

    {{-- BARANG MASUK --}}
    <div class="col-md-4 mb-4">
        <div class="card dashboard-card">
            <div class="card-body d-flex align-items-center">
                <div class="dashboard-icon bg-success">
                    <i class="feather icon-log-in"></i>
                </div>
                <div class="dashboard-info">
                    <span class="dashboard-title">Total Barang Masuk</span>
                    <h2 class="dashboard-value">{{ $totalBarangMasuk }}</h2>
                </div>
            </div>
        </div>
    </div>

    {{-- BARANG KELUAR --}}
    <div class="col-md-4 mb-4">
        <div class="card dashboard-card">
            <div class="card-body d-flex align-items-center">
                <div class="dashboard-icon bg-danger">
                    <i class="feather icon-log-out"></i>
                </div>
                <div class="dashboard-info">
                    <span class="dashboard-title">Total Barang Keluar</span>
                    <h2 class="dashboard-value">{{ $totalBarangKeluar }}</h2>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection