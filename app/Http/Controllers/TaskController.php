<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Barang;
use App\Models\User;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Models\Supplier;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

    //Admin
    public function index()
    {
        $tasks = Task::with(['barang', 'user', 'lokasi'])
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
            'lokasi'    => Lokasi::all(),
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
            'supplier_id' => 'required|exists:supplier,id',
            'lokasi_id'  => 'required|exists:lokasi,id',
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
        $tasks = Task::with('barang', 'lokasi')
            ->where('user_id', Auth::id())
            ->whereIn('status', ['pending', 'menunggu_acc', 'ditolak'])
            ->latest()
            ->get();

        return view('tasks.my-tasks', compact('tasks'));
    }

    // PETUGAS: Selesai Tugas
    public function complete(Request $request, Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'bukti_foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Upload bukti
        $path = $request->file('bukti_foto')
            ->store('bukti-tugas', 'public');

        $task->update([
            'bukti_foto' => $path,
            'status'     => 'menunggu_acc',
        ]);

        return back()->with('success', 'Tugas dikirim, menunggu ACC admin');
    }

    public function approve(Task $task)
    {
        if ($task->status !== 'menunggu_acc') {
            return back();
        }

        $barang = $task->barang;

        if ($task->tipe === 'masuk') {
            BarangMasuk::create([
                'barang_id'   => $task->barang_id,
                'supplier_id' => $task->supplier_id,
                'jumlah'      => $task->jumlah,
                'user_id'     => $task->user_id,
                'tanggal_masuk' => now(),
            ]);
            $barang->increment('stok', $task->jumlah);
        }

        if ($task->tipe === 'keluar') {
            if ($barang->stok < $task->jumlah) {
                return back()->with('error', 'Stok tidak mencukupi');
            }

            BarangKeluar::create([
                'barang_id'   => $task->barang_id,
                'jumlah'      => $task->jumlah,
                'user_id'     => $task->user_id,
                'tanggal_keluar' => now(),
            ]);
            $barang->decrement('stok', $task->jumlah);
        }

        $task->update([
            'status' => 'selesai',
            'acc_at' => now(),
            'acc_by' => Auth::id(),
        ]);

        return back()->with('success', 'Tugas berhasil di-ACC');
    }

    public function reject(Task $task)
    {
        $task->update([
            'status' => 'ditolak',
            'acc_by' => Auth::id(),
        ]);

        return back()->with('error', 'Tugas ditolak');
    }
}
