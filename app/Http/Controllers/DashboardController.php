<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataFeed;

class DashboardController extends Controller
{
    // Dashboard utama
    public function index()
    {
        return view('Admin.dashboard');
    }

    // Halaman Rooms
    public function rooms()
    {
        return view('Admin.rooms');
    }

    // Halaman About
    public function about()
    {
        return view('Admin.about');
    }

    // Halaman Events
    public function events()
    {
        return view('Admin.events');
    }

    // Halaman Contact
    public function contact()
    {
        return view('Admin.contact');
    }

    // Halaman Reservations
    public function reservations()
    {
        return view('Admin.reservations');
    }

    // Halaman Login
    public function login()
    {
        return view('Admin.login');
    }
}
