<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelView extends Model
{
    use HasFactory;
    protected $fillable = ['photo_path'];
}
