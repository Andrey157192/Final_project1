<?php

namespace App\Http\Controllers;

use App\Models\CookieConsent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CookieConsentController extends Controller
{
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'User must be logged in'], 401);
        }

        if (Auth::user()->role === 'admin') {
            return response()->json(['message' => 'Admins do not need to set cookie preferences'], 403);
        }

        $value = $request->input('consent', 'accepted');
        $maxAge = 365 * 24 * 60; // 1 year in minutes
        
        // Store cookie consent status
        Cookie::queue('cookie_consent', $value, $maxAge);
        
        // Clear the session flag
        $request->session()->forget('show_cookie_consent');
        
        // If user accepted, set the session token
        if ($value === 'accepted') {
            $sessionToken = $request->session()->token();
            Cookie::queue('session_token', $sessionToken, 60 * 24); // 24 hours
        }
        
        // If user declined, show info message
        $message = $value === 'accepted' ? 
            'Cookie consent telah disimpan' : 
            'Cookie penggunaan ditolak. Beberapa fitur mungkin tidak berfungsi optimal.';
        
        // Save to database
        CookieConsent::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'status' => $value,
                'expires_at' => now()->addMinutes($maxAge)
            ]
        );
        
        return response()->json([
            'message' => $message,
            'status' => 'success'
        ]);
    }

    public function index()
    {
        if (!Auth::check() || Auth::user()->role === 'admin') {
            return response()->json(['show_consent' => false]);
        }

        $consent = Cookie::get('cookie_consent');
        $sessionToken = Cookie::get('session_token');
        
        return response()->json([
            'show_consent' => !$consent,
            'has_session' => !empty($sessionToken),
            'consent_value' => $consent
        ]);
    }
}