<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SessionsController extends Controller
{
     public function create()
    {
        return view('session.login-session');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($attributes)) {
            $user = Auth::user();
            $karyawan = $user->karyawan;

            if ($karyawan && $karyawan->status !== 'Aktif') {
                Auth::logout();
                return back()->withErrors(['email' => 'Akun Anda tidak aktif. Silakan hubungi administrator.']);
            }

            session()->regenerate();
            return redirect()->intended('dashboard')->with(['message' => 'You are logged in.']);
        } else {
            return back()->withErrors(['email' => 'Email or password invalid.']);
        }
    }

    public function destroy()
    {
        Auth::logout();

        return redirect('/login')->with(['message' => 'You\'ve been logged out.']);
    }
}
