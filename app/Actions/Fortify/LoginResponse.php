<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use App\Providers\RouteServiceProvider;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $redirect = session()->pull('redirect_after_login', RouteServiceProvider::HOME);
        return redirect()->intended($redirect);
    }
}
