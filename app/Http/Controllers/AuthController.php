<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            // ✅ Redirect jika sebelumnya ada permintaan akses sebelum login (dari middleware)
            $redirect = session()->pull('redirect_after_login');
            if ($redirect) {
                return redirect($redirect);
            }

            // ✅ Redirect berdasarkan role
            return match ($user->role) {
                'admin' => redirect('/admin/dashboard'),
                'user' => redirect('/pages/index'),
                'resepsionis' => redirect('/resepsionis/dashboard'),
                default => redirect('/index'),
            };
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:admin,user,resepsionis',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        // Otomatis login setelah register (opsional)
        Auth::login($user);
        return redirect('/login'); // Atau redirect langsung sesuai role jika mau
    }

    public function registerPage()
    {
        return view('auth.register');
    }
}
