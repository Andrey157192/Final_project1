<?php

namespace App\Http\Controllers;

use App\Models\Event; // Import model Event
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Menampilkan semua event
    public function index()
    {
        $events = Event::all(); // Mengambil semua data event
        return view('events', compact('events')); // Kirim data event ke halaman events.blade.php
    }
}
