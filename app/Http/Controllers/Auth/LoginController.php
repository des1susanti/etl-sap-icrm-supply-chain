<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) return redirect()->route('dashboard');
        return view('auth.login');
    }

    public function login(Request $request)
{
    $request->validate([
        'email'    => 'required|email',
        'password' => 'required|min:6',
    ], [
        'email.required'    => 'Email wajib diisi',
        'email.email'       => 'Format email tidak valid',
        'password.required' => 'Password wajib diisi',
    ]);

    $credentials = $request->only('email', 'password');
    $remember    = $request->boolean('remember');

    if (Auth::attempt($credentials, $remember)) {
        $user = Auth::user();

        // Cek role — hanya manager & admin_gudang
        if (!in_array($user->role, ['manager', 'admin_gudang'])) {
            Auth::logout();
            return back()->withErrors([
                'email' => 'Akun Anda tidak memiliki akses ke sistem ini.'
            ]);
        }

        if (!$user->is_active) {
            Auth::logout();
            return back()->withErrors([
                'email' => 'Akun Anda telah dinonaktifkan.'
            ]);
        }

        $user->update(['last_login' => now()]);
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'));
    }

    return back()->withErrors([
        'email' => 'Email atau password salah.'
    ])->withInput($request->only('email'));
}

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Anda telah berhasil logout.');
    }
}