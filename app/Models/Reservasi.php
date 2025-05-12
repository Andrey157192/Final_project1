<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $table = 'reservasi';

    protected $fillable = [
        'created_by',
        'id_customer',
        'id_rooms',
        'checkIn_date',
        'checkOut_date',
    ];

    /** Relasi ke User yang membuat reservasi */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /** Relasi ke Customer */
    public function customer()
    {
        return $this->belongsTo(User::class, 'id_customer');
    }
    
    /** Relasi ke Room */
    public function room()
    {
        return $this->belongsTo(Room::class, 'id_rooms');
    }
}
