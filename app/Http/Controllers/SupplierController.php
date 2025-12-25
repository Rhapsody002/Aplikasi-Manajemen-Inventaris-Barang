<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $query = Supplier::query();

        if ($request->filled('search')) {
            $query->where('nama_supplier', 'like', '%' . $request->search . '%');
        }

        $suppliers = $query->latest()->paginate(8);
        $suppliers->appends($request->only('search'));

        return view('supplier.index', compact('suppliers'));
    }



    public function create()
    {
        return view('supplier.create', ['supplier' => null]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_supplier' => 'required|string|max:150',
            'telepon'       => 'nullable|string|max:20',
            'alamat'        => 'nullable|string',
            'logo_supplier' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('logo_supplier')) {
            $data['logo_supplier'] = $request
                ->file('logo_supplier')
                ->store('supplier', 'public');
        }

        Supplier::create($data);

        return redirect()->route('supplier.index')
            ->with('success', 'Supplier berhasil ditambahkan');
    }

    public function edit(Supplier $supplier)
    {
        return view('supplier.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $data = $request->validate([
            'nama_supplier' => 'required|string|max:150',
            'telepon'       => 'nullable|string|max:20',
            'alamat'        => 'nullable|string',
            'logo_supplier' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('logo_supplier')) {
            if ($supplier->logo_supplier) {
                Storage::disk('public')->delete($supplier->logo_supplier);
            }

            $data['logo_supplier'] = $request
                ->file('logo_supplier')
                ->store('supplier', 'public');
        }

        $supplier->update($data);

        return redirect()->route('supplier.index')
            ->with('success', 'Supplier berhasil diperbarui');
    }

    public function destroy(Supplier $supplier)
    {
        if ($supplier->logo_supplier) {
            Storage::disk('public')->delete($supplier->logo_supplier);
        }

        $supplier->delete();

        return back()->with('success', 'Supplier berhasil dihapus');
    }
}
