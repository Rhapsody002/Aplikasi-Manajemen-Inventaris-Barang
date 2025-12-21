<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{
    // ADMIN: daftar semua tugas
    public function index()
    {
        $tasks = Task::with('user')->latest()->paginate(10);
        return view('tasks.index', compact('tasks'));
    }

    // ADMIN: form tambah tugas
    public function create()
    {
        $karyawan = User::where('role', 'petugas')->get();
        return view('tasks.create', compact('karyawan'));
    }

    // ADMIN: simpan tugas
    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required',
            'deskripsi' => 'nullable',
            'user_id' => 'required|exists:users,id',
            'deadline' => 'nullable|date',
        ]);

        Task::create($data);

        return redirect()->route('tasks.index')
            ->with('success', 'Tugas berhasil diberikan');
    }

    // PETUGAS: tugas saya
    public function myTasks()
    {
        $tasks = Task::where('user_id', Auth::id())->latest()->get();
        return view('tasks.my-tasks', compact('tasks'));
    }

    // PETUGAS: update status
    public function updateStatus(Task $task, Request $request)
    {
        $request->validate([
            'status' => 'required|in:pending,proses,selesai',
        ]);

        $task->update(['status' => $request->status]);

        return back()->with('success', 'Status tugas diperbarui');
    }
}

