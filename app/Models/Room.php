<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'kapasitas',
        'price',
        'harga_per_malam',
        'picture',
        'rooms_type',
        'description',
        'created_by',
        'status'
    ];

    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'id_rooms');
    }
}
