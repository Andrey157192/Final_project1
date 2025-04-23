<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ulasan;
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
    public function indexUlasan()
    {
        $ulasans = Ulasan::latest()->get();
        return view('admin.ulasan', compact('ulasans'));
    }

    public function toggleUlasan($id)
    {
        $ulasan = Ulasan::findOrFail($id);
        $ulasan->is_approved = !$ulasan->is_approved;
        $ulasan->save();

        return back()->with('success', 'Status ulasan diperbarui.');
    }

    // Halaman datauser
    
    public function users() {
        $users = User::all();
        return view('Admin.datauser', compact('users'));
    }
    

    /** Simpan user baru */
    public function storeUser(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'nik'      => 'required|string|max:20',
            'address'  => 'required|string',
            'status'   => 'required|in:Menikah,Belum Menikah',
            'checkin'  => 'required|date',
            'checkout' => 'required|date|after_or_equal:checkin',
        ]);

        User::create([
            'name'     => $request->name,
            'nik'      => $request->nik,
            'address'  => $request->address,
            'status'   => $request->status,
            'checkin'  => $request->checkin,
            'checkout' => $request->checkout,
        ]);
        

        return redirect()->route('datauser.index')
                         ->with('success', 'Data pelanggan berhasil ditambahkan.');
    }

    /** Tampilkan form edit user */
    public function editUser(User $user)
    {
        return view('Admin.editdatauser', compact('user'));
    }

    /** Proses update user */
    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'nik'      => 'required|string|max:20',
            'address'  => 'required|string',
            'status'   => 'required|in:Menikah,Belum Menikah',
            'checkin'  => 'required|date',
            'checkout' => 'required|date|after_or_equal:checkin',
        ]);

        $user->update($request->only(['name','nik','address','status','checkin','checkout']));

        return redirect()->route('datauser.index')
                         ->with('success', 'Data pelanggan berhasil diperbarui.');
    }

    /** Hapus user */
    public function destroyUser(User $user)
    {
        $user->delete();
        return redirect()->route('datauser.index')
                         ->with('success', 'Data pelanggan berhasil dihapus.');
    }
}
