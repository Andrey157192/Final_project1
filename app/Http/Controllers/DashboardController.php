<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ulasan;
use App\Models\AboutSetting;
use App\Models\Leadership;
use App\Models\HotelView;
use App\Models\Room;

class DashboardController extends Controller
{
    // Dashboard utama
    public function index()
    {
        return view('Admin.dashboard');
    }

    // Halaman Rooms
   // Tampilkan form & list rooms
   public function rooms()
   {
       $rooms = Room::latest()->get();
       return view('Admin.rooms', compact('rooms'));
   }

   // Simpan room baru
   public function storeRoom(Request $request)
   {
       $data = $request->validate([
           'title' => 'required|string|max:255',
           'price' => 'required|numeric',
           'description' => 'nullable|string',
           'photo' => 'required|image',
       ]);
       $path = $request->file('photo')->store('rooms','public');
       Room::create([
           'title' => $data['title'],
           'price' => $data['price'],
           'description' => $data['description'],
           'photo_path' => $path,
       ]);
       return back()->with('success','Room berhasil ditambahkan.');
   }

   // Update room
   public function updateRoom(Request $request, Room $room)
   {
       $data = $request->validate([
           'title' => 'required|string|max:255',
           'price' => 'required|numeric',
           'description' => 'nullable|string',
           'photo' => 'nullable|image',
       ]);
       if($request->hasFile('photo')){
           $room->photo_path = $request->file('photo')->store('rooms','public');
       }
       $room->update($data);
       return back()->with('success','Room berhasil diperbarui.');
   }

   // Hapus room
   public function destroyRoom(Room $room)
   {
       $room->delete();
       return back()->with('success','Room berhasil dihapus.');
   }

    // Halaman About
    // Tampilkan halaman About + data
            public function about()
            {
                // ambil row pertama atau buat baru kalau belum ada
                $settings = AboutSetting::first() ?: new AboutSetting();
                $leaderships = Leadership::all();
                $views = HotelView::all();
                return view('Admin.about', compact('settings','leaderships','views'));
            }

            // Simpan / update Deskripsi, History, Contact
            public function updateAbout(Request $r)
            {
                $data = $r->validate([
                'description'=>'nullable|string',
                'history'=>'nullable|string',
                'phone'=>'nullable|string',
                'email'=>'nullable|email',
                'address'=>'nullable|string',
                'maps_link'=>'nullable|url',
                ]);

                $settings = AboutSetting::first() ?: new AboutSetting();
                $settings->fill($data)->save();

                return back()->with('success','About Us berhasil diperbarui.');
            }

            // Tambah Leadership
            public function storeLeadership(Request $r)
            {
                $data = $r->validate([
                'name'=>'required|string',
                'photo'=>'required|image',
                ]);
                $path = $r->file('photo')->store('leadership','public');
                Leadership::create(['name'=>$data['name'],'photo_path'=>$path]);

                return back()->with('success','Leadership ditambahkan.');
            }

            // Edit Leadership
            public function updateLeadership(Request $r, Leadership $leadership)
            {
                $data = $r->validate([
                'name'=>'required|string',
                'photo'=>'nullable|image',
                ]);
                if($r->hasFile('photo')){
                // hapus foto lama jika mau
                $leadership->photo_path = $r->file('photo')->store('leadership','public');
                }
                $leadership->name = $data['name'];
                $leadership->save();

                return back()->with('success','Leadership diperbarui.');
            }

            // Hapus Leadership
            public function destroyLeadership(Leadership $leadership)
            {
                $leadership->delete();
                return back()->with('success','Leadership dihapus.');
            }

// Tambah Hotel View
public function storeView(Request $r)
{
    $r->validate(['photo'=>'required|image']);
    $path = $r->file('photo')->store('hotel_views','public');
    HotelView::create(['photo_path'=>$path]);
    return back()->with('success','Foto hotel view ditambahkan.');
}

// Hapus Hotel View
public function destroyView(HotelView $view)
{
    $view->delete();
    return back()->with('success','Foto hotel view dihapus.');
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
