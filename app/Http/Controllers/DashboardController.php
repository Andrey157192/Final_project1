<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\User;
use App\Models\Ulasan;
use App\Models\AboutSetting;
use App\Models\Leadership;
use App\Models\HotelView;
use App\Models\Room;
use App\Models\Event;
use App\Models\Reservasi;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DataUserExport;

class DashboardController extends Controller
{
    /**
     * Tampilkan dashboard utama
     */
    public function index()
    {
        return view('Admin.dashboard');
    }

    /**
     * CRUD Rooms
     */
    public function rooms(Request $request)
{
    $query = Room::query();

    if ($request->has('search') && $request->search !== null) {
        $query->where('title', 'like', '%' . $request->search . '%');
    }

    $rooms = $query->latest()->get();

    return view('Admin.rooms', compact('rooms'));
}


    public function storeRoom(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'price'       => 'required|numeric',
            'description' => 'nullable|string',
            'photo'       => 'required|image',
        ]);
        $path = $request->file('photo')->store('rooms', 'public');
        Room::create([
            'title'      => $data['title'],
            'price'      => $data['price'],
            'description'=> $data['description'],
            'photo_path' => $path,
        ]);
        return back()->with('success', 'Room berhasil ditambahkan.');
    }

    public function updateRoom(Request $request, Room $room)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'price'       => 'required|numeric',
            'description' => 'nullable|string',
            'photo'       => 'nullable|image',
        ]);
        if ($request->hasFile('photo')) {
            $room->photo_path = $request->file('photo')->store('rooms', 'public');
        }
        $room->update($data);
        return back()->with('success', 'Room berhasil diperbarui.');
    }

    public function destroyRoom(Room $room)
    {
        $room->delete();
        return back()->with('success', 'Room berhasil dihapus.');
    }

    /**
     * CRUD About & Settings
     */
    public function about()
    {
        $settings    = AboutSetting::first() ?: new AboutSetting();
        $leaderships = Leadership::all();
        $views       = HotelView::all();
        return view('Admin.about', compact('settings', 'leaderships', 'views'));
    }

    public function updateAbout(Request $request)
    {
        $data = $request->validate([
            'description' => 'nullable|string',
            'history'     => 'nullable|string',
            'phone'       => 'nullable|string',
            'email'       => 'nullable|email',
            'address'     => 'nullable|string',
            'maps_link'   => 'nullable|url',
        ]);
        $settings = AboutSetting::first() ?: new AboutSetting();
        $settings->fill($data)->save();
        return back()->with('success', 'About Us berhasil diperbarui.');
    }

    /**
     * CRUD Leadership
     */
    public function storeLeadership(Request $request)
    {
        $data = $request->validate([
            'name'  => 'required|string',
            'photo' => 'required|image',
        ]);
        $path = $request->file('photo')->store('leadership', 'public');
        Leadership::create(['name' => $data['name'], 'photo_path' => $path]);
        return back()->with('success', 'Leadership ditambahkan.');
    }

    public function updateLeadership(Request $request, Leadership $leadership)
    {
        $data = $request->validate([
            'name'  => 'required|string',
            'photo' => 'nullable|image',
        ]);
        if ($request->hasFile('photo')) {
            $leadership->photo_path = $request->file('photo')->store('leadership', 'public');
        }
        $leadership->name = $data['name'];
        $leadership->save();
        return back()->with('success', 'Leadership diperbarui.');
    }

    public function destroyLeadership(Leadership $leadership)
    {
        $leadership->delete();
        return back()->with('success', 'Leadership dihapus.');
    }

    /**
     * CRUD Hotel Views
     */
    public function storeView(Request $request)
    {
        $request->validate(['photo' => 'required|image']);
        $path = $request->file('photo')->store('hotel_views', 'public');
        HotelView::create(['photo_path' => $path]);
        return back()->with('success', 'Foto hotel view ditambahkan.');
    }

    public function destroyView(HotelView $view)
    {
        $view->delete();
        return back()->with('success', 'Foto hotel view dihapus.');
    }

    /**
     * Halaman Events & Contact
     */
    // Menampilkan daftar event + form tambah
public function listEvents()
{
    $events = Event::latest()->get();
    return view('Admin.events', compact('events'));
}

// Simpan event baru
public function storeEvent(Request $request)
{
    $data = $request->validate([
        'title'       => 'required|string|max:255',
        'description' => 'required|string',
        'start_date'  => 'required|date',
        'end_date'    => 'required|date|after_or_equal:start_date',
        'image'       => 'required|image',
    ]);

    $path = $request->file('image')->store('events','public');
    $data['image_path'] = $path;

    Event::create($data);
    return back()->with('success', 'Event berhasil ditambahkan.');
}

// Tampilkan halaman detail event
public function showEvent(Event $event)
{
    return view('Admin.event-detail', compact('event'));
}

// Update event
public function updateEvent(Request $request, Event $event)
{
    $data = $request->validate([
        'title'       => 'required|string|max:255',
        'description' => 'required|string',
        'start_date'  => 'required|date',
        'end_date'    => 'required|date|after_or_equal:start_date',
        'image'       => 'nullable|image',
    ]);

    if($request->hasFile('image')){
        $event->image_path = $request->file('image')->store('events','public');
    }

    $event->update($data);
    return back()->with('success', 'Event berhasil diperbarui.');
}

// Hapus event
public function destroyEvent(Event $event)
{
    $event->delete();
    return back()->with('success', 'Event berhasil dihapus.');
}


    public function contact()
    {
        return view('Admin.contact');
    }

    /**
     * CRUD Ulasan
     */
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

    /**
     * CRUD Data User
     */
    public function users()
{
    // ambil dari tabel reservasi
    $reservasis = Reservasi::all();
    return view('Admin.datauser', compact('reservasis'));
}

public function storeUser(Request $request)
{
    $validated = $request->validate([
        'name'     => ['required', 'regex:/^[\pL\s]+$/u', 'max:255'],
        'nik'      => ['required', 'digits:16'],
        'address'  => ['required', 'regex:/^[\pL\s]+$/u'],
        'status'   => ['required', 'in:Menikah,Belum Menikah'],
        'checkin'  => ['required', 'date'],
        'checkout' => ['required', 'date', 'after_or_equal:checkin'],
    ], [
        'name.regex'    => 'Nama hanya boleh berisi huruf dan spasi.',
        'nik.digits'    => 'NIK harus terdiri dari tepat 16 digit angka.',
        'address.regex' => 'Alamat hanya boleh berisi huruf dan spasi.',
    ]);

    try {
        Reservasi::create($validated);
        return back()->with('success', 'Reservasi berhasil ditambahkan.');
    } catch (QueryException $e) {
        return back()->with('error', 'Gagal menambahkan reservasi: ' . $e->getMessage());
    }
}

public function editUser($id)
{
    $reservasi = Reservasi::findOrFail($id);
    return view('Admin.editdatauser', compact('reservasi'));
}

public function updateUser(Request $request, $id)
{
    $validated = $request->validate([
        'name'     => ['required', 'regex:/^[\pL\s]+$/u', 'max:255'],
        'nik'      => ['required', 'digits:16'],
        'address'  => ['required', 'regex:/^[\pL\s]+$/u'],
        'status'   => ['required', 'in:Menikah,Belum Menikah'],
        'checkin'  => ['required', 'date'],
        'checkout' => ['required', 'date', 'after_or_equal:checkin'],
    ], [
        'name.regex'    => 'Nama hanya boleh berisi huruf dan spasi.',
        'nik.digits'    => 'NIK harus terdiri dari tepat 16 digit angka.',
        'address.regex' => 'Alamat hanya boleh berisi huruf dan spasi.',
    ]);

    $reservasi = Reservasi::findOrFail($id);
    $reservasi->update($validated);

    return redirect()->route('reservasi.index')
                     ->with('success', 'Reservasi berhasil diperbarui.');
}

public function destroyUser($id)
{
    $reservasi = Reservasi::findOrFail($id);
    $reservasi->delete();

    return redirect()->route('reservasi.index')
                     ->with('success', 'Reservasi berhasil dihapus.');
}

public function export()
{
    // return Excel::download(new DataUserExport, 'data_user.xlsx');
}
public function home(){
    return view('user.pages.index');
  }

}

