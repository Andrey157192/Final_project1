<?php
namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataUserExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return User::select('name', 'nik', 'address', 'status', 'checkin', 'checkout')->get();
    }

    public function headings(): array
    {
        return ['Nama', 'NIK', 'Alamat', 'Status', 'Check-in', 'Check-out'];
    }
}
