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

          {{-- Data for WhatsApp Booking --}}
    @if(Auth::check())
        <button onclick="openBookingModal()" class="btn-book">
            <img src="{{ asset('images/whatsapp icon.png') }}" alt="WhatsApp Icon" />
            Book via WhatsApp
        </button>

        <!-- Modal -->
        <div id="bookingModal" class="modal">
            <div class="modal-content">
                <span class="close-modal" onclick="closeBookingModal()">&times;</span>
                <h2>Form Pemesanan Kamar</h2>
                
                <form action="{{ route('book.now') }}" method="POST" id="bookingForm">
                    @csrf
                    <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="kamar" value="{{ $detail->title }}">
                    <input type="hidden" name="id_kamar" value="{{ $detail->id }}">
                    
                    <div class="form-group">
                        <label for="name">Nama Lengkap:</label>
                        <input type="text" name="name" id="name" value="{{ Auth::user()->name }}" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="nik">NIK KTP:</label>
                        <input type="text" name="nik" id="nik" class="form-control" required pattern="[0-9]{16}" title="NIK harus 16 digit angka">
                    </div>

                    <div class="form-group">
                        <label for="address">Alamat:</label>
                        <textarea name="address" id="address" class="form-control" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="">Pilih Status</option>
                            <option value="Menikah">Menikah</option>
                            <option value="Belum Menikah">Belum Menikah</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="adult_guests">Jumlah Tamu Dewasa:</label>
                        <input type="number" name="adult_guests" id="adult_guests" class="form-control" required min="1" max="{{ $detail->kapasitas }}" value="1">
                        <small class="form-text text-muted">Minimal 1 orang dewasa</small>
                    </div>

                    <div class="form-group">
                        <label for="child_guests">Jumlah Tamu Anak-anak:</label>
                        <input type="number" name="child_guests" id="child_guests" class="form-control" required min="0" max="{{ $detail->kapasitas - 1 }}" value="0">
                        <small class="form-text text-muted">Anak-anak usia dibawah 12 tahun</small>
                    </div>

                    <div class="form-group">
                        <label for="checkin">Tanggal Check-in:</label>
                        <input type="date" name="checkin" id="checkin" class="form-control" required min="{{ date('Y-m-d') }}">
                    </div>

                    <div class="form-group">
                        <label for="checkout">Tanggal Check-out:</label>
                        <input type="date" name="checkout" id="checkout" class="form-control" required>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-book">
                            <img src="{{ asset('images/whatsapp icon.png') }}" alt="WhatsApp Icon" />
                            Lanjutkan ke WhatsApp
                        </button>
                        <button type="button" class="btn-cancel" onclick="closeBookingModal()">Batal</button>
                    </div>
                </form>
            </div>
        </div>

        <style>
            .modal {
                display: none;
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.75);
                z-index: 1000;
                pointer-events: all;
            }

            .modal-content {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background-color: #fff;
                width: 90%;
                max-width: 450px;
                padding: 1.5rem;
                border-radius: 8px;
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3),
                          0 10px 10px -5px rgba(0, 0, 0, 0.2);
                animation: modalFadeIn 0.3s ease-out;
                max-height: 85vh;
                overflow-y: auto;
            }

            @media (max-width: 640px) {
                .modal-content {
                    width: 95%;
                    padding: 1.25rem;
                    margin: 0;
                    border-radius: 8px;
                    max-height: 90vh;
                }
                
                .modal {
                    background-color: rgba(0, 0, 0, 0.85);
                }
            }

            @media (min-width: 641px) {
                .modal-content {
                    width: 90%;
                    max-width: 450px;
                }
            }

            @keyframes modalFadeIn {
                0% {
                    opacity: 0;
                    transform: translate(-50%, -60%) scale(0.95);
                }
                100% {
                    opacity: 1;
                    transform: translate(-50%, -50%) scale(1);
                }
            }

            .close-modal {
                position: absolute;
                right: 20px;
                top: 15px;
                font-size: 24px;
                cursor: pointer;
                color: #666;
            }

            .close-modal:hover {
                color: #000;
            }

            .form-group {
                margin-bottom: 1.25rem;
            }

            .form-group label {
                display: block;
                margin-bottom: 0.5rem;
                font-weight: 600;
                color: #374151;
                font-size: 0.95rem;
            }

            .form-control {
                width: 100%;
                padding: 0.75rem;
                border: 1px solid #e5e7eb;
                border-radius: 8px;
                font-size: 1rem;
                transition: all 0.2s ease;
                background-color: #fff;
            }

            .form-control:focus {
                outline: none;
                border-color: #3b82f6;
                box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            }

            .form-control:hover {
                border-color: #3b82f6;
            }

            textarea.form-control {
                height: 120px;
                resize: vertical;
            }

            .form-text {
                font-size: 0.875rem;
                color: #6b7280;
                margin-top: 0.25rem;
            }

            .form-actions {
                display: flex;
                gap: 1rem;
                justify-content: flex-end;
                margin-top: 2rem;
                flex-wrap: wrap;
            }

            @media (max-width: 640px) {
                .form-actions {
                    flex-direction: column;
                    gap: 0.75rem;
                }
                
                .form-actions button {
                    width: 100%;
                }

                .form-control {
                    font-size: 16px; /* Prevents zoom on mobile */
                    padding: 0.625rem;
                }
            }

            .btn-cancel {
                padding: 8px 16px;
                border: none;
                border-radius: 4px;
                background-color: #dc3545;
                color: white;
                cursor: pointer;
            }

            .btn-cancel:hover {
                background-color: #c82333;
            }
        </style>

        <script>
            document.getElementById('checkin').addEventListener('change', function() {
                const checkinDate = new Date(this.value);
                const checkoutInput = document.getElementById('checkout');
                checkoutInput.min = this.value;
                
                // If checkout date is before check-in date, reset it
                if (new Date(checkoutInput.value) <= checkinDate) {
                    const nextDay = new Date(checkinDate);
                    nextDay.setDate(checkinDate.getDate() + 1);
                    checkoutInput.value = nextDay.toISOString().split('T')[0];
                }
            });

            document.getElementById('bookingForm').addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Collect form data
                const formData = new FormData(this);
                const bookingDetails = Object.fromEntries(formData.entries());
                
                // Validate total number of guests
                const totalGuests = parseInt(bookingDetails.adult_guests) + parseInt(bookingDetails.child_guests);
                if (totalGuests > {{ $detail->kapasitas }}) {
                    alert(`Total tamu tidak boleh melebihi kapasitas kamar (${{{ $detail->kapasitas }}} orang)`);
                    return;
                }
                
                // Create WhatsApp message
                const message = `*Pemesanan Kamar Hotel*\n\n` +
                    `Nama: ${bookingDetails.name}\n` +
                    `Alamat: ${bookingDetails.address}\n\n` +
                    `Detail Tamu:\n` +
                    `- Dewasa: ${bookingDetails.adult_guests} orang\n` +
                    `- Anak-anak: ${bookingDetails.child_guests} orang\n\n` +
                    `Tanggal Menginap:\n` +
                    `Check-in: ${bookingDetails.checkin}\n` +
                    `Check-out: ${bookingDetails.checkout}`;
                
                // Redirect to WhatsApp
                const whatsappURL = `https://wa.me/+6283147850079?text=${encodeURIComponent(message)}`;
                window.location.href = whatsappURL;
            });
        </script>
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

      function openBookingModal() {
          document.getElementById('bookingModal').style.display = 'block';
          document.body.style.overflow = 'hidden'; // Prevent scrolling when modal is open
      }

      function closeBookingModal() {
          document.getElementById('bookingModal').style.display = 'none';
          document.body.style.overflow = 'auto'; // Restore scrolling
      }

      // Close modal when clicking outside of it
      window.onclick = function(event) {
          const modal = document.getElementById('bookingModal');
          if (event.target === modal) {
              closeBookingModal();
          }
      }

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
