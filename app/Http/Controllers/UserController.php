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
        $events = Event::latest()->get();               // data event terbaru
        $ratings = \App\Models\Rating::where('approved', true)
            ->with('user')
            ->latest()
            ->take(6)
            ->get();
        return view('user.pages.index', compact('dataRooms', 'events', 'ratings'));
}

public function events(){
    $events = Event::latest()->get();                // hanya data events
    return view('user.pages.events', compact('events'));
}


    public function roomsDetail($id)
    {
        $detail = Room::findOrFail($id);
        if (!$detail) {
            abort(404);
        }
        
        // For debugging
        \Log::info('Room Detail:', [
            'id' => $detail->id,
            'title' => $detail->title,
            'picture' => $detail->picture
        ]);
        
        return view('room.kamar_detail', compact('detail'));
    }

    public function about()
    {
        // Get or create default settings
        $settings = \App\Models\AboutSetting::firstOrCreate(
            [],  // empty condition = find first or create new
            [
                'description' => 'Welcome to Hotel Balige Beach, your perfect getaway destination by the shores of Lake Toba.',
                'history' => 'Our hotel has been serving guests since its establishment, providing comfortable accommodations and memorable experiences.',
                'phone' => '+62 123 4567 890',
                'email' => 'contact@hotelbalige.com',
                'address' => 'Jl. Tengku Rizal Nurdin, Parsaoran I, Balige, Toba, Sumatera Utara',
                'maps_link' => 'https://maps.google.com'
            ]
        );

        $leaderships = \App\Models\Leadership::all();
        $views = \App\Models\HotelView::all();

        return view('user.pages.about', compact('settings', 'leaderships', 'views'));
    }

public function rooms(){
   $dataRooms= DB:: table ('rooms')->get();

    return view('user.pages.rooms',compact('dataRooms'));
}


}


