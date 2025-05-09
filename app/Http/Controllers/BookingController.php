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
        $kamar = $request->input('kamar');
        $checkin = $request->input('checkin');
        $checkout = $request->input('checkout');

        // Simpan data ke DB
        $reservasi = Reservasi::create([
            'name' => $name,
            'nik' => Auth::user()->nik ?? null,
            'address' => Auth::user()->address ?? null,
            'status' => null,
            'checkin' => $checkin,
            'checkout' => $checkout,
        ]);

        if ($reservasi) {
            // Format pesan WA
            $pesan = "Halo Admin, saya ingin memesan kamar *$kamar* atas nama *$name*.\nTanggal check-in: *$checkin*\nTanggal check-out: *$checkout*.";

            // Format ke link WhatsApp
            $waNumber = '6285275303150';
            $waUrl = 'https://wa.me/' . $waNumber . '?text=' . urlencode($pesan);

            return redirect()->away($waUrl);
        }

        return back()->with('error', 'Gagal booking kamar.');
    }
}
