<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        return Barang::with('kategori')->get();
    }

    public function store(Request $request)
{
    $request->validate([
        'kode_barang' => 'required|unique:barang,kode_barang',
        'nama_barang' => 'required',
        'kategori_id' => 'required|exists:kategori,id',
        'lokasi_id'   => 'required|exists:lokasi,id',
        'stok'        => 'required|integer|min:0',
        'satuan'      => 'required',
    ]);

    Barang::create([
        'kode_barang' => $request->kode_barang,
        'nama_barang' => $request->nama_barang,
        'kategori_id' => $request->kategori_id,
        'lokasi_id'   => $request->lokasi_id, 
        'stok'        => $request->stok,
        'satuan'      => $request->satuan,
    ]);

    return response()->json([
        'message' => 'Barang berhasil ditambahkan'
    ]);

    //Filter Berdasarkan lokasi
    if ($request->filled('lokasi_id')) {
        $query->where('lokasi_id', $request->lokasi_id);
    }

    return $query->get();
}

    public function show(Barang $barang)
    {
        return $barang->load('kategori');
    }

    public function update(Request $request, Barang $barang)
    {
        $barang->update($request->all());
        return $barang;
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();
        return response()->json(['Message' => 'Deleted']);
    }
}
