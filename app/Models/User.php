<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
 
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',

    ];
 

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isAgent()
    {
        return $this->role === 'agent';
    }

    public function isResepsionis()
    {
        return $this->role === 'resepsionis';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }
}
