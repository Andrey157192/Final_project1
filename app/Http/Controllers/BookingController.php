<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservasi;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function booking(Request $request)
    {
        $name = $request->input('name');
        $idUser = $request->input('id_user');
        $kamar = $request->input('kamar');
        $idKamar = $request->input('id_kamar');
        $checkin = $request->input('checkin');
        $checkout = $request->input('checkout');

        // Simpan data ke DB
        $reservasi = Reservasi::create([
            'id_customer' => $idUser,// harus nya save id
            'id_rooms' => $idKamar,// harus nya save id
            'created_by' => $idUser,// harus nya save id
            'checkIn_date' => $checkin,
            'checkOut_date' => $checkout,
        ]);

        if ($reservasi) {
            // Format pesan WA
            $pesan = "Halo Admin, saya ingin memesan kamar *$kamar* atas nama *$name*.\nTanggal check-in: *$checkin*\nTanggal check-out: *$checkout*.";

            // Format ke link WhatsApp
            $waNumber = '6283147850079';
            $waUrl = 'https://wa.me/' . $waNumber . '?text=' . urlencode($pesan);

            return redirect()->away($waUrl);
        }

        return back()->with('error', 'Gagal booking kamar.');
    }
}
