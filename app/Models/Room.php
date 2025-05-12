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
        'harga_per_malam',
        'picture',
        'rooms_type',
        'description',
        'price',
        'created_by'
    ];

    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'id_rooms');
    }
}
