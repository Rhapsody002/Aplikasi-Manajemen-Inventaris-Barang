<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{

    public function index()
    {
        $lokasi = Lokasi::latest()->paginate(10);
        return view('lokasi.index', compact('lokasi'));
    }

    public function create()
    {
        return view('lokasi.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_lokasi' => 'required|string|max:100',
            'keterangan'  => 'nullable|string',
        ]);

        Lokasi::create($data);

        return redirect()->route('lokasi.index')
            ->with('success', 'Lokasi berhasil ditambahkan');
    }

    public function edit(Lokasi $lokasi)
    {
        return view('lokasi.edit', compact('lokasi'));
    }

    public function update(Request $request, Lokasi $lokasi)
    {
        $data = $request->validate([
            'nama_lokasi' => 'required|string|max:100',
            'keterangan'  => 'nullable|string',
        ]);

        $lokasi->update($data);

        return redirect()->route('lokasi.index')
            ->with('success', 'Lokasi berhasil diperbarui');
    }

    public function destroy(Lokasi $lokasi)
    {
        if ($lokasi->barang()->count() > 0) {
            return redirect()
                ->route('lokasi.index')
                ->with('lokasi_error');
        }

        $lokasi->delete();

        return redirect()
            ->route('lokasi.index')
            ->with('success');
    }
}
