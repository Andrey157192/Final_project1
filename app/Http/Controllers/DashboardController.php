<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use App\Models\User;
use App\Models\Customer;
use App\Models\Ulasan;
use App\Models\AboutSetting;
use App\Models\Leadership;
use App\Models\HotelView;
use App\Models\Room;
use App\Models\Event;
use App\Models\Reservasi;
use Illuminate\Support\Facades\DB;

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
        try {
            Log::info('Mencoba menambah kamar baru');
            
            $data = $request->validate([
                'title'          => 'required|string|max:255',
                'rooms_type'     => 'required|string|max:255',
                'price'          => 'required|numeric|min:0',
                'kapasitas'      => 'required|integer|min:1',
                'description'    => 'required|string',
                'picture'        => 'required|image|mimes:jpg,jpeg,png|max:2048',
                'status'         => 'required|in:available,occupied,maintenance',
            ]);

            Log::info('Data tervalidasi', $data);

            if (!$request->hasFile('picture')) {
                Log::error('Foto kamar tidak ditemukan');
                return back()->with('error', 'Foto kamar wajib diunggah')->withInput();
            }

            // Store the image in public storage
            $path = $request->file('picture')->store('rooms', 'public');
            Log::info('Foto tersimpan di: ' . $path);

            // Buat record baru
            $room = Room::create([
                'title'          => $data['title'],
                'rooms_type'     => $data['rooms_type'],
                'price'          => $data['price'],
                'harga_per_malam'=> $data['price'],
                'kapasitas'      => $data['kapasitas'],
                'description'    => $data['description'],
                'picture'        => $path,
                'status'         => $data['status'],
                'created_by'     => Auth::id(),
            ]);

            // If status is occupied or maintenance, create a reservation
            if ($data['status'] === 'occupied' || $data['status'] === 'maintenance') {
                Reservasi::create([
                    'created_by' => Auth::id(),
                    'id_customer' => Auth::id(),
                    'id_rooms' => $room->id,
                    'checkIn_date' => now(),
                    'checkOut_date' => $data['status'] === 'maintenance' ? now()->addDays(7) : now()->addDay(),
                    'status' => $data['status'],
                    'nama_customer' => $data['status'] === 'maintenance' ? 'Maintenance' : 'Admin Manual Update'
                ]);
            }

            Log::info('Kamar berhasil ditambahkan');
            return back()->with('success', 'Kamar berhasil ditambahkan.');

        } catch (QueryException $e) {
            Log::error('Error saat menambah kamar: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            return back()->with('error', 'Gagal menambahkan kamar: ' . $e->getMessage())->withInput();
        }
    }

    public function updateRoom(Request $request, Room $room)
    {
        try {
            $data = $request->validate([
                'title'       => 'required|string|max:255',
                'rooms_type'  => 'required|string|max:255', 
                'price'       => 'required|numeric|min:0',
                'kapasitas'   => 'required|integer|min:1',
                'description' => 'nullable|string',
                'photo'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'status'      => 'required|in:available,occupied,maintenance',
            ]);

            // Process uploaded photo if exists
            if ($request->hasFile('photo')) {
                $path = $request->file('photo')->store('rooms', 'public');
                $data['picture'] = $path;
            }

            // Update harga_per_malam along with price
            $data['harga_per_malam'] = $data['price'];

            // Handle status change
            if ($room->status !== $data['status']) {
                // Cancel existing reservations if changing to available
                if ($data['status'] === 'available') {
                    Reservasi::where('id_rooms', $room->id)
                        ->where('checkIn_date', '<=', now())
                        ->where('checkOut_date', '>=', now())
                        ->where('status', '!=', 'cancelled')
                        ->update(['status' => 'cancelled']);
                }
                // Create new reservation if changing to occupied or maintenance
                elseif (in_array($data['status'], ['occupied', 'maintenance'])) {
                    $existingReservation = $room->reservasi()
                        ->where('checkIn_date', '<=', now())
                        ->where('checkOut_date', '>=', now())
                        ->where('status', '!=', 'cancelled')
                        ->first();

                    if (!$existingReservation) {
                        Reservasi::create([
                            'created_by' => Auth::id(),
                            'id_customer' => Auth::id(),
                            'id_rooms' => $room->id,
                            'checkIn_date' => now(),
                            'checkOut_date' => $data['status'] === 'maintenance' ? now()->addDays(7) : now()->addDay(),
                            'status' => $data['status'],
                            'nama_customer' => $data['status'] === 'maintenance' ? 'Maintenance' : 'Admin Manual Update'
                        ]);
                    }
                }
            }

            $room->update($data);
            
            return back()->with('success', 'Kamar berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Error saat mengupdate kamar: ' . $e->getMessage());
            return back()->with('error', 'Gagal mengupdate kamar: ' . $e->getMessage())->withInput();
        }
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
        $ratings = \App\Models\Rating::with('user')
                    ->latest()
                    ->get();
        return view('admin.ulasan', compact('ratings'));
    }

    public function toggleUlasan($id)
    {
        $rating = \App\Models\Rating::findOrFail($id);
        $rating->approved = !$rating->approved;
        $rating->save();
        return back()->with('success', 'Status ulasan diperbarui.');
    }

    /**
     * CRUD Data User
     */

     
    public function indexReservasi()
    {
        $reservations = Reservasi::with(['customer', 'room'])->latest()->get();
        $rooms = Room::all();
        return view('Admin.datauser', compact('reservations', 'rooms'));
    }


    /** Form tambah reservasi */
    public function createReservasi()
    {
        $customers = Reservasi::all();
        
        return view('Admin.createreservasi', compact('customers', 'rooms'));
    }

    

    /** Simpan reservasi baru */
    public function storeReservasi(Request $request)
    {
        $validated = $request->validate([
            'nama_customer' => 'required|string|max:255',
            'nik'          => 'nullable|string|max:16',
            'address'      => 'nullable|string',
            'status'       => 'nullable|in:Single,Married',
            'id_rooms'     => 'required|exists:rooms,id',
            'checkIn_date' => 'required|date',
            'checkOut_date'=> 'required|date|after_or_equal:checkIn_date',
        ]);

        try {
            DB::beginTransaction();

            // Create new user as customer with all details
            $customer = User::create([
                'name'     => $validated['nama_customer'],
                'email'    => strtolower(str_replace(' ', '', $validated['nama_customer'])) . '@guest.com',
                'password' => bcrypt('guest123'),
                'role'     => 'customer',
                'nik'      => $request->input('nik'),
                'address'  => $request->input('address'),
                'status'   => $request->input('status'),
            ]);

            // Create reservation with customer details
            Reservasi::create([
                'created_by'    => Auth::id() ?? 1,
                'id_customer'   => $customer->id,
                'id_rooms'      => $validated['id_rooms'],
                'checkIn_date'  => $validated['checkIn_date'],
                'checkOut_date' => $validated['checkOut_date'],
                'nik'          => $request->input('nik'),
                'address'      => $request->input('address'),
                'status'       => $request->input('status'),
                'nama_customer'=> $validated['nama_customer']
            ]);

            DB::commit();
            return redirect()->route('reservasi.index')
                             ->with('success', 'Reservasi berhasil ditambahkan.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menambahkan reservasi: ' . $e->getMessage());
        }
    }

    /** Form edit reservasi */
    public function editReservasi($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $rooms = Room::all();
        $customers = User::where('role', 'customer')->get();
        return view('Admin.editreservasi', compact('reservasi', 'customers', 'rooms'));
    }

    /** Update data reservasi */
    public function updateReservasi(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_customer' => 'required|string|max:255',
            'nik'          => 'nullable|string|max:16',
            'address'      => 'nullable|string',
            'status'       => 'nullable|in:Single,Married',
            'id_rooms'     => 'required|exists:rooms,id',
            'checkIn_date' => 'required|date',
            'checkOut_date'=> 'required|date|after_or_equal:checkIn_date',
        ]);

        $reservasi = Reservasi::findOrFail($id);
        
        // Update only basic info in users table
        $customer = User::findOrFail($reservasi->id_customer);
        $customer->name = $validated['nama_customer'];
        $customer->save();

        // Update reservation with all customer details
        $reservasi->update([
            'id_rooms'      => $validated['id_rooms'],
            'checkIn_date'  => $validated['checkIn_date'],
            'checkOut_date' => $validated['checkOut_date'],
            'nik'          => $request->input('nik'),
            'address'      => $request->input('address'),
            'status'       => $request->input('status'),
            'nama_customer'=> $validated['nama_customer']
        ]);

        return redirect()->route('reservasi.index')
                         ->with('success', 'Reservasi berhasil diperbarui.');
    }

    /** Hapus reservasi */
    public function destroyReservasi($id)
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

    public function exportReservasi(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date'
        ]);

        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $reservations = Reservasi::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->get();

        $filename = 'reservasi_' . date('Y-m-d_His') . '.csv';
        
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $handle = fopen('php://temp', 'r+');
        
        // Add headers
        fputcsv($handle, [
            'Nama Customer',
            'NIK',
            'Alamat',
            'Status',
            'Check-in',
            'Check-out',
            'Tanggal Dibuat'
        ]);

        // Add data rows
        foreach ($reservations as $reservasi) {
            fputcsv($handle, [
                $reservasi->nama_customer,
                $reservasi->nik ?? '-',
                $reservasi->address ?? '-',
                $reservasi->status ?? '-',
                date('d/m/Y', strtotime($reservasi->checkIn_date)),
                date('d/m/Y', strtotime($reservasi->checkOut_date)),
                date('d/m/Y H:i:s', strtotime($reservasi->created_at))
            ]);
        }

        rewind($handle);
        $content = stream_get_contents($handle);
        fclose($handle);

        return response($content, 200, $headers);
    }
}

