<?php

namespace App\Actions;

use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Contracts\ResetsUserPasswords;
use Illuminate\Contracts\Auth\CanResetPassword;

class ResetUserPassword implements ResetsUserPasswords
{
    public function reset(CanResetPassword $user, array $input): void
    {
        $user->password = Hash::make($input['password']);
        $user->save();

        // Jika ingin trigger event setelah reset password:
        // event(new PasswordReset($user));
    }
}
