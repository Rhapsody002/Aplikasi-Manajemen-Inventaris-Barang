<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    public function index()
    {
        return Lokasi::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lokasi' => 'required|string|max:100',
            'keterangan'  => 'nullable|string',
        ]);

        Lokasi::create($request->all());

        return response()->json(['message' => 'Lokasi berhasil ditambahkan']);
    }

    public function update(Request $request, Lokasi $lokasi)
    {
        $lokasi->update($request->all());

        return response()->json(['message' => 'Lokasi berhasil diupdate']);
    }

    public function destroy(Lokasi $lokasi)
    {
        $lokasi->delete();

        return response()->json(['message' => 'Lokasi berhasil dihapus']);
    }
}
