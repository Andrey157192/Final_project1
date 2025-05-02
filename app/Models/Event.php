<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'image_path',
    ];

    /**
     * Biarkan Eloquent mengonversi string date ke Carbon instance,
     * sehingga kita bisa pakai ->format(...)
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
    ];
}
