<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Lokasi;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'totalBarang'      => Barang::count(),
            'totalStok'        => Barang::sum('stok'),
            'totalKategori'    => Kategori::count(),
            'totalLokasi'      => Lokasi::count(),
            'totalBarangMasuk' => BarangMasuk::sum('jumlah'),
            'totalBarangKeluar'=> BarangKeluar::sum('jumlah'),
        ]);
    }
}


