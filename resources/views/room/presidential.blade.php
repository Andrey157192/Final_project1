<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Presidential Room</title>
  <link rel="stylesheet" href="{{ asset('css/room.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>

  <div class="container">
    <!-- Room Header dengan tombol kembali dan judul -->
    <div class="room-header">
      <a href="javascript:history.back()" class="back-button">← Kembali</a>
      <h1 class="room-heading">Presidential Room</h1>
    </div>

    <!-- Kontainer Utama -->
    <div class="room-container">
      <!-- Gambar -->
      <div class="room-card">
        <img src="{{ asset('images/presidential-room.jpg') }}" alt="Presidential Room" class="room-img" />
      </div>

      <!-- Informasi Kamar -->
      <div class="room-info">
        <h2 class="room-title">Presidential Room</h2>
        <p><strong>Deskripsi:</strong> Kamar eksklusif dengan kemewahan maksimal, cocok untuk tamu VIP yang menginginkan privasi dan kenyamanan premium.</p>
        <p><strong>Fasilitas:</strong> Tempat tidur king size, Jacuzzi, AC, Wi-Fi, Smart TV, Mini Bar, Ruang tamu pribadi, Balkon</p>
        <p><strong>Kapasitas:</strong> Hingga 2 orang</p>
        <p><strong>Harga:</strong> Rp 1.500.000 / malam</p>

        <!-- Tombol Booking -->
        <a href="https://wa.me/6281234567890" class="btn-book" target="_blank">
          <img src="{{ asset('images/whatsapp-icon.svg') }}" alt="WhatsApp" class="wa-icon">
          Book Now
        </a>
      </div>
    </div>
  </div>

  <script src="{{ asset('js/room.js') }}"></script>
</body>
</html>