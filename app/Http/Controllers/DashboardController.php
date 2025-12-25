<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Lokasi;
use App\Models\Task;
use App\Models\Supplier;
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
            'totalBarangKeluar' => BarangKeluar::sum('jumlah'),

            'tugasPending' => Task::where('status', 'pending')->count(),
            'totalSupplier' => Supplier::count(),
            'stokKritis' => Barang::where('stok', '<=', 5)->count(),

            // Aktivitas
            'recentTasks' => Task::with(['barang', 'user'])
                ->where('status', 'selesai')
                ->latest()
                ->take(5)
                ->get(),
        ]);
    }
}
