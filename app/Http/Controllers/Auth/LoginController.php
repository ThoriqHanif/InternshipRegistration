<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ],[
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Email harus valid.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal harus 6 karakter.'
        ]);
        
    
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            // Login berhasil, cek peran (role) pengguna
            $user = Auth::user();
            if ($user->role === 'admin') {
                // Jika peran adalah 'admin', redirect ke dashboard admin
                return redirect('/admin/dashboard');
            } elseif ($user->role === 'user') {
                // Jika peran adalah 'user', redirect ke dashboard user
                return redirect('/reports');
            }
        }

        // Jika login gagal
        return back()->withErrors(['email','password' => 'Email atau password salah.'])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        

        Auth::logout(); // Logout pengguna
        $request->session()->invalidate(); // Memadamkan sesi
        $request->session()->regenerateToken(); // Menghasilkan token sesi yang baru

        return redirect('/login'); // Redirect ke halaman login setelah logout
    }
}
