<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Barang;
use App\Models\User;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

    //Admin
    public function index()
    {
        $tasks = Task::with(['barang', 'user'])
            ->latest()
            ->paginate(10);

        return view('tasks.index', compact('tasks'));
    }

    // ADMIN: form tambah tugas
    public function create()
    {
        return view('tasks.create', [
            'barang'  => Barang::all(),
            'petugas' => User::where('role', 'petugas')->get(),
            'supplier' => Supplier::all(),
        ]);
    }

    // ADMIN: simpan tugas
    public function store(Request $request)
    {
        $data = $request->validate([
            'judul'     => 'required|string|max:150',
            'tipe'      => 'required|in:masuk,keluar',
            'barang_id' => 'required|exists:barang,id',
            'jumlah'    => 'required|integer|min:1',
            'user_id'   => 'required|exists:users,id',
            'supplier_id' => 'nullable|exists:supplier,id',
        ]);

        // validasi khusus barang masuk
        if ($data['tipe'] === 'masuk' && empty($data['supplier_id'])) {
            return back()->withErrors([
                'supplier_id' => 'Supplier wajib diisi untuk barang masuk'
            ])->withInput();
        }

        // validasi stok jika tugas barang keluar
        if ($data['tipe'] === 'keluar') {
            $barang = Barang::findOrFail($data['barang_id']);

            if ($barang->stok < $data['jumlah']) {
                return back()->withErrors([
                    'jumlah' => 'Stok barang tidak mencukupi',
                ])->withInput();
            }
        }

        Task::create($data);

        return redirect()->route('tasks.index')
            ->with('success', 'Tugas berhasil dibuat');
    }

    // PETUGAS: tugas saya
    public function myTasks()
    {
        $tasks = Task::with('barang')
            ->where('user_id', Auth::id())
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view('tasks.my-tasks', compact('tasks'));
    }

    // PETUGAS: Selesai Tugas
    public function complete(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        if ($task->status === 'selesai') {
            return back();
        }

        $barang = $task->barang;

        // === BARANG MASUK ===
        if ($task->tipe === 'masuk') {

            if (!$task->supplier_id) {
                return back()->with('error', 'Supplier belum ditentukan oleh admin');
            }

            BarangMasuk::create([
                'barang_id'     => $task->barang_id,
                'supplier_id'   => $task->supplier_id,
                'jumlah'        => $task->jumlah,
                'user_id'       => Auth::id(),
                'tanggal_masuk' => now(),
            ]);


            $barang->increment('stok', $task->jumlah);
        }

        // === BARANG KELUAR ===
        if ($task->tipe === 'keluar') {

            if ($barang->stok < $task->jumlah) {
                return back()->with('error', 'Stok barang tidak mencukupi');
            }

            BarangKeluar::create([
                'barang_id'      => $task->barang_id,
                'jumlah'         => $task->jumlah,
                'user_id'        => Auth::id(),
                'tanggal_keluar' => now(),
            ]);
            $barang->decrement('stok', $task->jumlah);
        }

        $task->update(['status' => 'selesai']);

        return back()->with('success', 'Tugas berhasil diselesaikan');
    }
}
