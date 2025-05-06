<?php



namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HottelBookingIntent
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            session()->put('redirect_after_login', $request->fullUrl()); // simpan URL asli
            return redirect()->route('login');
        }

        return $next($request);
    }
}
