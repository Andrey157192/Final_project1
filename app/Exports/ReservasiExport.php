<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Reservasi;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReservasiExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $reservasi;

    // Konstruktor untuk menerima data reservasi yang difilter
    public function __construct($reservasi)
    {
        $this->reservasi = $reservasi;
    }

    // Menentukan data yang akan diexport
   public function collection()
{
    return $this->reservasi->map(function($reservasi) {
        return [
            $reservasi->id,  // ID Reservasi
            $reservasi->customer ? $reservasi->customer->name : 'Tidak Ditemukan',  // Nama Customer
            Carbon::parse($reservasi->checkIn_date)->format('d-m-Y'),  // Tanggal Check-in
            Carbon::parse($reservasi->checkOut_date)->format('d-m-Y'), // Tanggal Check-out
            $reservasi->status,  // Status
            $reservasi->address, // Alamat
        ];
    });
}


    // Menentukan header kolom pada file Excel
    public function headings(): array
    {
        return [
            'ID Reservasi',
            'Nama Customer',
            'Tanggal Check-in',
            'Tanggal Check-out',
            'Status',
            'Alamat',
        ];
    }
}
