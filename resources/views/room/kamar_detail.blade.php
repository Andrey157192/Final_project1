<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Kamar - {{ $detail->title }}</title>
  <link rel="stylesheet" href="{{ asset('css/room.css') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    .status {
      font-weight: 600;
      padding: 8px 12px;
      border-radius: 4px;
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }
    .status.text-success {
      background-color: rgba(25, 135, 84, 0.1);
      color: #198754;
    }
    .status.text-danger {
      background-color: rgba(220, 53, 69, 0.1);
      color: #dc3545;
    }
    .status i {
      font-size: 1.1em;
    }

    .room-type-container {
      display: flex;
      align-items: center;
      gap: 1rem;
    }
    .admin-controls {
      display: inline-flex;
      gap: 0.5rem;
    }
    .btn-edit, .btn-save, .btn-cancel {
      padding: 0.5rem 1rem;
      border-radius: 4px;
      border: none;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      font-size: 0.9rem;
    }
    .btn-edit {
      background-color: #007bff;
      color: white;
    }
    .btn-save {
      background-color: #28a745;
      color: white;
    }
    .btn-cancel {
      background-color: #dc3545;
      color: white;
    }
    .edit-input {
      padding: 0.5rem;
      border: 1px solid #ddd;
      border-radius: 4px;
    }
    .inline-form {
      display: inline-flex;
      gap: 0.5rem;
      align-items: center;
    }
    .room-status-container {
      display: flex;
      align-items: center;
      gap: 1rem;
    }
    .form-select {
      padding: 0.5rem;
      border: 1px solid #ddd;
      border-radius: 4px;
      min-width: 200px;
    }
  </style>
<body>
  <div class="container">
    <!-- Header -->
    <header class="room-header">
      <a href="javascript:history.back()" class="back-button">&#8592; Kembali</a>
      <h1 class="room-heading">{{ $detail->title }}</h1>
    </header>

    <!-- Room Details -->
    <section class="room-container">
      <div class="room-card">
        <div class="image-wrapper">
          @if($detail->picture)
            <img src="{{ asset('storage/' . $detail->picture) }}" alt="{{ $detail->title }}" class="room-img" loading="lazy" onerror="this.src='{{ asset('images/room-default.jpg') }}'" />
          @else
            <img src="{{ asset('images/room-default.jpg') }}" alt="{{ $detail->title }}" class="room-img" />
          @endif
        </div>
        <h2 class="room-title">
          <i class="fas fa-hotel"></i>
          {{ $detail->title }}
        </h2>
      </div>

      <div class="room-info">
        <div class="info-group">
          <h3 class="info-title"><i class="fas fa-info-circle"></i> Deskripsi</h3>
          <p>{{ $detail->description ?? 'Deskripsi belum tersedia.' }}</p>
        </div>
        
        <div class="info-group">
          <h3 class="info-title"><i class="fas fa-bed"></i> Tipe Kamar</h3>
          <div class="room-type-container">
            <p id="room-type-display">{{ $detail->rooms_type ?? 'Tipe kamar belum tersedia.' }}</p>
            @if(Auth::check() && Auth::user()->hasRole('admin'))
              <div class="admin-controls">
                <button onclick="toggleEditMode()" class="btn-edit" id="edit-btn">
                  <i class="fas fa-edit"></i> Edit
                </button>
                <div id="edit-form" style="display: none;">
                  <form action="{{ route('admin.room.updateType', $detail->id) }}" method="POST" class="inline-form">
                    @csrf
                    @method('PUT')
                    <input type="text" name="rooms_type" value="{{ $detail->rooms_type }}" class="edit-input">
                    <button type="submit" class="btn-save">
                      <i class="fas fa-save"></i> Simpan
                    </button>
                    <button type="button" onclick="toggleEditMode()" class="btn-cancel">
                      <i class="fas fa-times"></i> Batal
                    </button>
                  </form>
                </div>
              </div>
            @endif
          </div>
        </div>
        
        <div class="info-group">
          <h3 class="info-title"><i class="fas fa-users"></i> Kapasitas</h3>
          <p>{{ $detail->kapasitas ?? 'Tidak diketahui' }} Orang</p>
        </div>
        
        <div class="info-group">
          <h3 class="info-title"><i class="fas fa-tag"></i> Harga</h3>
          <p class="price">Rp {{ number_format($detail->price, 0, ',', '.') }} <span class="per-night">/ malam</span></p>
        </div>

        <div class="info-group">
          <h3 class="info-title"><i class="fas fa-calendar-check"></i> Status Kamar</h3>
          @php
            $currentReservation = $detail->reservasi()
              ->where('checkIn_date', '<=', now())
              ->where('checkOut_date', '>=', now())
              ->where('status', '!=', 'cancelled')
              ->first();
          @endphp
          <div class="room-status-container">
            <p class="status {{ $currentReservation ? 'text-danger' : 'text-success' }}">
              <i class="fas fa-{{ $currentReservation ? 'times-circle' : 'check-circle' }}"></i>
              {{ $currentReservation ? 'Sedang Terisi' : 'Tersedia' }}
            </p>
            @if(Auth::check() && Auth::user()->hasRole('admin'))
              <div class="admin-controls">
                <button onclick="toggleStatusEdit()" class="btn-edit" id="status-edit-btn">
                  <i class="fas fa-edit"></i> Update Status
                </button>
                <div id="status-edit-form" style="display: none;">
                  <form action="{{ route('admin.room.updateStatus', $detail->id) }}" method="POST" class="inline-form">
                    @csrf
                    @method('PUT')
                    <select name="room_status" class="form-select edit-input">
                      <option value="available" {{ !$currentReservation ? 'selected' : '' }}>Tersedia</option>
                      <option value="occupied" {{ $currentReservation ? 'selected' : '' }}>Sedang Terisi</option>
                      <option value="maintenance">Dalam Perbaikan</option>
                    </select>
                    <button type="submit" class="btn-save">
                      <i class="fas fa-save"></i> Simpan
                    </button>
                    <button type="button" onclick="toggleStatusEdit()" class="btn-cancel">
                      <i class="fas fa-times"></i> Batal
                    </button>
                  </form>
                </div>
              </div>
            @endif
          </div>
        </div>

          {{-- Data for Wa --}}
    @if(Auth::check())
        <form action="{{ route('book.now') }}" method="POST">
        @csrf
        <input type="hidden" name="name" value="{{ Auth::user()->name }}">
        <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
        <input type="hidden" name="kamar" value="{{ $detail->title }}">
        <input type="hidden" name="id_kamar" value="{{ $detail->id }}">
        <input type="hidden" name="checkin" value="{{ now()->toDateString() }}">
        <input type="hidden" name="checkout" value="{{ now()->addDay()->toDateString() }}">

        <button type="submit" class="btn-book">
            <img src="{{ asset('images/whatsapp icon.png') }}" alt="WhatsApp Icon" />
            Book Now
        </button>
        </form>
        @else
        <a href="{{ route('login') }}" class="btn-book">
        <img src="{{ asset('images/whatsapp icon.png') }}" alt="WhatsApp Icon" />
        Silakan Login untuk Booking
        </a>
    @endif
      </div>
    </section>

  


    <!-- JavaScript -->
    <script>
      const isUserLoggedIn = {!! json_encode(Auth::check()) !!};

      function toggleEditMode() {
        const editForm = document.getElementById('edit-form');
        const editBtn = document.getElementById('edit-btn');
        const display = document.getElementById('room-type-display');
        
        if (editForm.style.display === 'none') {
          editForm.style.display = 'block';
          editBtn.style.display = 'none';
          display.style.display = 'none';
        } else {
          editForm.style.display = 'none';
          editBtn.style.display = 'block';
          display.style.display = 'block';
        }
      }

      function toggleStatusEdit() {
        const editForm = document.getElementById('status-edit-form');
        const editBtn = document.getElementById('status-edit-btn');
        const display = document.querySelector('.room-status-container .status');
        
        if (editForm.style.display === 'none') {
          editForm.style.display = 'block';
          editBtn.style.display = 'none';
          display.style.display = 'none';
        } else {
          editForm.style.display = 'none';
          editBtn.style.display = 'block';
          display.style.display = 'block';
        }
      }
    </script>
  </div>

</body>
</html>
