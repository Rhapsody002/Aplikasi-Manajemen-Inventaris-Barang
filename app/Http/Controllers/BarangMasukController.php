<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangMasukController extends Controller
{

    public function index()
    {
        return BarangMasuk::with(['barang', 'supplier'])->get();
    }


    public function store(Request $request)
    {
        $request->validate([
            'barang_id'   => 'required|exists:barang,id',
            'supplier_id' => 'required|exists:supplier,id',
            'jumlah'      => 'required|integer|min:1',
            'tanggal_masuk' => 'required|date'
        ]);

        DB::transaction(function () use ($request) {
            BarangMasuk::create([
                'barang_id'     => $request->barang_id,
                'supplier_id'   => $request->supplier_id,
                'jumlah'        => $request->jumlah,
                'tanggal_masuk' => $request->tanggal_masuk,
                'user_id'       => 1
            ]);

            Barang::findOrFail($request->barang_id)
                ->increment('stok', $request->jumlah);
        });

        return response()->json(['message' => 'Barang masuk berhasil'], 201);
    }

    public function update(Request $request, BarangMasuk $barangMasuk)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1'
        ]);

        DB::transaction(function () use ($request, $barangMasuk) {
            $selisih = $request->jumlah - $barangMasuk->jumlah;

            $barangMasuk->update([
                'jumlah' => $request->jumlah
            ]);

            Barang::findOrFail($barangMasuk->barang_id)
                ->increment('stok', $selisih);
        });

        return response()->json(['message' => 'Barang masuk diupdate']);
    }

    public function destroy(BarangMasuk $barangMasuk)
    {
        DB::transaction(function () use ($barangMasuk) {
            Barang::findOrFail($barangMasuk->barang_id)
                ->decrement('stok', $barangMasuk->jumlah);

            $barangMasuk->delete();
        });

        return response()->json(['message' => 'Barang masuk dihapus']);
    }
}
