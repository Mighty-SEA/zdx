<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah pengguna sudah login dan memiliki role admin
        if (!Auth::check() || !Auth::user()->hasRole('admin')) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized. Anda tidak memiliki akses ke fitur ini.'
                ], 403);
            }
            
            return redirect()->route('login')->with('error', 'Anda harus login sebagai admin untuk mengakses halaman ini.');
        }
        
        return $next($request);
    }
}
