<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangKeluarController extends Controller
{
    // READ
    public function index()
    {
        return BarangKeluar::with('barang')->get();
    }

    // CREATE
    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'jumlah' => 'required|integer|min:1',
            'tujuan' => 'required',
            'tanggal_keluar' => 'required|date'
        ]);

        $barang = Barang::find($request->barang_id);

        if ($barang->stok < $request->jumlah) {
            return response()->json([
                'error' => 'Stok tidak mencukupi'
            ], 400);
        }

        DB::transaction(function () use ($request, $barang) {
            BarangKeluar::create([
                'barang_id' => $request->barang_id,
                'jumlah' => $request->jumlah,
                'tujuan' => $request->tujuan,
                'tanggal_keluar' => $request->tanggal_keluar,
                'user_id' => 1
            ]);

            $barang->decrement('stok', $request->jumlah);
        });

        return response()->json(['message' => 'Barang keluar berhasil'], 201);
    }

    // UPDATE
    public function update(Request $request, BarangKeluar $barangKeluar)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1'
        ]);

        DB::transaction(function () use ($request, $barangKeluar) {
            $barang = Barang::find($barangKeluar->barang_id);
            $selisih = $request->jumlah - $barangKeluar->jumlah;

            if ($barang->stok < $selisih) {
                abort(400, 'Stok tidak mencukupi');
            }

            $barangKeluar->update($request->all());
            $barang->decrement('stok', $selisih);
        });

        return response()->json(['message' => 'Barang keluar diupdate']);
    }

    // DELETE
    public function destroy(BarangKeluar $barangKeluar)
    {
        DB::transaction(function () use ($barangKeluar) {
            Barang::find($barangKeluar->barang_id)
                  ->increment('stok', $barangKeluar->jumlah);

            $barangKeluar->delete();
        });

        return response()->json(['message' => 'Barang keluar dihapus']);
    }
}

