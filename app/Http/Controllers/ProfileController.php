<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    // =========================
    // TAMPILKAN PROFIL
    // =========================
    public function index()
    {
        return view('profile.index', [
            'user' => Auth::user(),
        ]);
    }

    // =========================
    // FORM EDIT PROFIL
    // =========================
    public function edit()
    {
        return view('profile.edit', [
            'user' => Auth::user(),
        ]);
    }

    // =========================
    // UPDATE PROFIL
    // =========================
    public function update(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $request->validate([
            'name'         => 'required|string|max:100',
            'password'     => 'nullable|min:6|confirmed',
            'foto_profil'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Update nama
        $user->name = $request->name;

        // Update password jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Upload foto profil
        if ($request->hasFile('foto_profil')) {

            // Hapus foto lama jika ada
            if ($user->foto_profil && Storage::disk('public')->exists($user->foto_profil)) {
                Storage::disk('public')->delete($user->foto_profil);
            }

            $user->foto_profil = $request
                ->file('foto_profil')
                ->store('user', 'public');
        }

        // Simpan perubahan
        $user->save();

        return redirect()
            ->route('profile.index')
            ->with('success', 'Profil berhasil diperbarui');
    }
}
