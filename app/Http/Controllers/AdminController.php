<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Reservasi;
use Carbon\Carbon;

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

    public function updateRoomType(Request $request, $id)
    {
        $request->validate([
            'rooms_type' => 'required|string|max:255'
        ]);

        $room = Room::findOrFail($id);
        $room->rooms_type = $request->rooms_type;
        $room->save();

        return back()->with('success', 'Tipe kamar berhasil diperbarui');
    }

    public function updateRoomStatus(Request $request, $id)
    {
        $request->validate([
            'room_status' => 'required|in:available,occupied,maintenance'
        ]);

        $room = Room::findOrFail($id);
        $status = $request->room_status;

        switch ($status) {
            case 'available':
                // Cancel any current reservations
                Reservasi::where('id_rooms', $room->id)
                    ->where('checkIn_date', '<=', now())
                    ->where('checkOut_date', '>=', now())
                    ->where('status', '!=', 'cancelled')
                    ->update(['status' => 'cancelled']);
                break;

            case 'occupied':
                // Create a new reservation if none exists
                $existingReservation = $room->reservasi()
                    ->where('checkIn_date', '<=', now())
                    ->where('checkOut_date', '>=', now())
                    ->where('status', '!=', 'cancelled')
                    ->first();

                if (!$existingReservation) {
                    Reservasi::create([
                        'created_by' => auth()->id(),
                        'id_customer' => auth()->id(),
                        'id_rooms' => $room->id,
                        'checkIn_date' => now(),
                        'checkOut_date' => now()->addDay(),
                        'status' => 'confirmed',
                        'nama_customer' => 'Admin Manual Update'
                    ]);
                }
                break;

            case 'maintenance':
                // Cancel current reservations and mark as under maintenance
                Reservasi::where('id_rooms', $room->id)
                    ->where('checkIn_date', '<=', now())
                    ->where('checkOut_date', '>=', now())
                    ->where('status', '!=', 'cancelled')
                    ->update(['status' => 'cancelled']);
                    
                // Create a maintenance reservation
                Reservasi::create([
                    'created_by' => auth()->id(),
                    'id_customer' => auth()->id(),
                    'id_rooms' => $room->id,
                    'checkIn_date' => now(),
                    'checkOut_date' => now()->addDays(7), // Default 7 days maintenance
                    'status' => 'maintenance',
                    'nama_customer' => 'Maintenance'
                ]);
                break;
        }

        return back()->with('success', 'Status kamar berhasil diperbarui');
    }
}

