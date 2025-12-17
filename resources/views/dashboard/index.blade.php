@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col">
                <h5 class="m-b-10">Dashboard</h5>
                <p class="text-muted m-b-0">
                    Ringkasan data gudang hari ini
                </p>
            </div>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-md-4">
        <div class="card bg-light-primary">
            <div class="card-body">
                <h6>Total Barang</h6>
                <h3>0</h3>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-light-success">
            <div class="card-body">
                <h6>Barang Masuk Hari Ini</h6>
                <h3>0</h3>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-light-danger">
            <div class="card-body">
                <h6>Barang Keluar Hari Ini</h6>
                <h3>0</h3>
            </div>
        </div>
    </div>

</div>
@endsection
