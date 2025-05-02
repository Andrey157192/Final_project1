<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard');
    }
    public function events(){
        return view('admin.events');
    }
    public function home(){
        return view('admin.home');
    }
    public function rooms(){
        return view('admin.rooms');
    }
    public function contacts(){
        return view ('admin.contacts');
    }
    public function reservation(){
        return view ('admin.reservation');
    }
    public function reports(){
        return view ('admin.reports');
    }

    public function about(){
        return view ('admin.about');
    }


}

