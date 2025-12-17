<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleCheck
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Pastikan sudah login
        if (!Auth::check()) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        // Cek role user
        if (!in_array(Auth::user()->role, $roles)) {
            return response()->json([
                'message' => 'Forbidden: akses ditolak'
            ], 403);
        }

        return $next($request);
    }
}
