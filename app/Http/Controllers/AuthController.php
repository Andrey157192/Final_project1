<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use App\Providers\RouteServiceProvider;

class AuthController extends Controller
{
    public function loginPage(){
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
            
            // Set session_token cookie after successful login
            $sessionToken = $request->session()->token();
            
            // Show cookie consent if not previously set and user is not admin
            if (!$request->cookie('cookie_consent') && Auth::user()->role !== 'admin') {
                $request->session()->put('show_cookie_consent', true);
                // Don't set session token until cookie consent is given
                $response = redirect(RouteServiceProvider::redirectTo());
            } else {
                // Set session token cookie
                Cookie::queue('session_token', $sessionToken, 60 * 24); // 24 hours
                $response = redirect(RouteServiceProvider::redirectTo());
            }
            
            return $response;
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

        return redirect('/');
    }

    public function registerPage(){
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Buat user baru dengan data yang sudah divalidasi
        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->role = 'user';
        $user->save();

        // Login user
        Auth::login($user);

        return redirect('/login');
    }
}
