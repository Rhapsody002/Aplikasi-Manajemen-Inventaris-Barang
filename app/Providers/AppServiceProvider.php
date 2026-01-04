<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

// MODELS
use App\Models\Task;
use App\Models\Barang;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Pagination Bootstrap
        Paginator::useBootstrap();

        // GLOBAL NOTIFICATION COMPOSER
        View::composer('*', function ($view) {

            // Jika belum login
            if (!Auth::check()) {
                return;
            }

            $user = Auth::user();

            $notifTasks = 0;
            $stokKritis = 0;

            // ADMIN
            if ($user->role === 'admin') {
                $notifTasks = Task::where('status', 'pending')->count();
                $stokKritis = Barang::where('stok', '<=', 5)->count();
            }

            // PETUGAS
            if ($user->role === 'petugas') {
                $notifTasks = Task::where('user_id', $user->id)
                    ->where('status', 'pending')
                    ->count();
            }

            // MANAJER
            if ($user->role === 'manajer') {
                $stokKritis = Barang::where('stok', '<=', 5)->count();
            }

            // Share ke semua view
            $view->with(compact('notifTasks', 'stokKritis'));
        });
    }
}
