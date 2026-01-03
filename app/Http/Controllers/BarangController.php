<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class BarangController extends Controller
{
    public function index(Request $request)
    {
        $query = Barang::with(['kategori', 'lokasi']);

        if ($request->filled('search')) {
            $query->where('nama_barang', 'like', '%' . $request->search . '%');
        }

        $barang = $query->latest()->paginate(8);
        $barang->appends($request->only('search'));

        return view()->file(
            resource_path('views/barang/index.blade.php'),
            compact('barang')
        );
    }

    public function create()
    {
        return view('barang.create', [
            'barang'   => null,
            'kategori' => Kategori::all(),
            'lokasi'   => Lokasi::all(),
        ]);
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'kode_barang' => 'required|unique:barang,kode_barang',
            'nama_barang' => 'required',
            'kategori_id' => 'required|exists:kategori,id',
            'lokasi_id'   => 'nullable|exists:lokasi,id',
            'foto_barang' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'keterangan'  => 'nullable',
        ]);

        $data['stok'] = 0;

        if ($request->hasFile('foto_barang')) {
            $data['foto_barang'] = $request
                ->file('foto_barang')
                ->store('barang', 'public');
        }

        Barang::create($data);

        return redirect()->route('barang.index')
            ->with('success', 'Barang berhasil ditambahkan');
    }

    public function show(Barang $barang)
    {
        return view('barang.show', [
            'barang' => $barang->load(['kategori', 'lokasi'])
        ]);
    }

    public function edit(Barang $barang)
    {
        return view('barang.edit', [
            'barang'   => $barang,
            'kategori' => Kategori::all(),
            'lokasi'   => Lokasi::all(),
        ]);
    }


    public function update(Request $request, Barang $barang)
    {
        $data = $request->validate([
            'nama_barang' => 'required',
            'kategori_id' => 'required|exists:kategori,id',
            'lokasi_id'   => 'nullable|exists:lokasi,id',
            'foto_barang' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'keterangan'  => 'nullable'
        ]);

        if ($request->hasFile('foto_barang')) {
            if ($barang->foto_barang) {
                Storage::disk('public')->delete($barang->foto_barang);
            }

            $data['foto_barang'] = $request->file('foto_barang')
                ->store('barang', 'public');
        }

        $barang->update($data);

        return redirect()->route('barang.index')
            ->with('success', 'Barang berhasil diperbarui');
    }

    public function destroy(Barang $barang)
    {
        if ($barang->foto_barang) {
            Storage::disk('public')->delete($barang->foto_barang);
        }

        $barang->delete();

        return redirect()->route('barang.index')
            ->with('success', 'Barang berhasil dihapus');
    }
}
