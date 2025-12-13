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
            'kode_barang' => 'required|unique:barang',
            'nama_barang' => 'required',
            'kategori_id' => 'required',
            'satuan' => 'required'
        ]);

        return Barang::create($request->all());
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
