<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use App\Exports\ReservasiExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function exportReservasi(Request $request)
    {
        // Validasi input tanggal
        $request->validate([
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
        ]);

        $startDate = Carbon::parse($request->startDate)->startOfDay();
        $endDate = Carbon::parse($request->endDate)->endOfDay();

        // Ambil data reservasi dalam rentang tanggal yang dipilih
        $reservasi = Reservasi::whereBetween('checkIn_date', [$startDate, $endDate])
            ->orWhereBetween('checkOut_date', [$startDate, $endDate])
            ->get();

        return Excel::download(new ReservasiExport($reservasi), 'reservasi.xlsx');
    }
}
