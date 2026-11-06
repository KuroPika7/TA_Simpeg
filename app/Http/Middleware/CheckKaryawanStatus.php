<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckKaryawanStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            $karyawan = $user->karyawan;

            // Check if the karyawan is non-active
            if ($karyawan && $karyawan->status !== 'Aktif') {
                Auth::logout();
                return redirect()->route('login')->withErrors(['email' => 'Akun Anda tidak aktif. Silakan hubungi administrator.']);
            }
        }
        return $next($request);
    }
}
