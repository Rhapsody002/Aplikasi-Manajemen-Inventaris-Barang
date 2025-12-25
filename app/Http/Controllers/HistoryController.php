<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::with(['barang', 'user'])->latest();

        // PETUGAS hanya lihat tugas sendiri
        if (Auth::user()->role === 'petugas') {
            $query->where('user_id', Auth::id());
        }

        // FILTER: TIPE
        if ($request->filled('tipe')) {
            $query->where('tipe', $request->tipe);
        }

        // FILTER: PETUGAS (ADMIN & MANAJER SAJA)
        if (
            $request->filled('user_id') &&
            in_array(Auth::user()->role, ['admin', 'manajer'])
        ) {
            $query->where('user_id', $request->user_id);
        }

        // FILTER: TANGGAL
        if ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->from);
        }

        if ($request->filled('to')) {
            $query->whereDate('created_at', '<=', $request->to);
        }

        $tasks = $query->paginate(10)->withQueryString();

        // data petugas untuk dropdown
        $petugas = User::where('role', 'petugas')->get();

        return view('history.index', compact('tasks', 'petugas'));
    }
}
