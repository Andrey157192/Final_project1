<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Event;

class UserController extends Controller
{
    public function index(){
        $dataRooms = DB::table('rooms')->get();          // data kamar
        $events    = Event::latest()->get();            // data event terbaru
        return view('user.pages.index', compact('dataRooms','events'));
    }

    public function roomsDetail($id)
    {
        $detail = Room::findOrFail($id);
        return view('room.kamar_detail', compact('detail'));
    }

    public function about()
{
    $settings = \App\Models\AboutSetting::first();
    $leaderships = \App\Models\Leadership::all();
    $views = \App\Models\HotelView::all(); // atau sesuai nama model kamu
    return view('user.pages.about', compact('settings', 'leaderships', 'views'));
}

public function rooms(){
   $rooms= DB:: table ('rooms')->get();

    return view('user.pages.rooms',compact('rooms'));
}


}


