<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Kamar - Standard Room</title>
  <link rel="stylesheet" href="{{ asset('css/room.css') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>

  <div class="container">
    
    <!-- Header -->
    <header class="room-header">
      <a href="javascript:history.back()" class="back-button">&#8592; Kembali</a>
      <h1 class="room-heading">Standard Room</h1>
    </header>

    <!-- Room Details -->
    <section class="room-container">
      <div class="room-card">
        <img src="{{ asset('images/standard-room.jpg') }}" alt="Standard Room" class="room-img" />
        <h2 class="room-title">Standard Room</h2>
      </div>
      
      <div class="room-info">
        <p><strong>Deskripsi:</strong> Kamar nyaman untuk istirahat setelah perjalanan jauh.</p>
        <p><strong>Fasilitas:</strong> AC, TV, Wi-Fi, Kamar Mandi Dalam, Air Panas</p>
        <p><strong>Kapasitas:</strong> 2 Orang</p>
        <p><strong>Harga:</strong> Rp 250.000 / malam</p>

        @if(Auth::check())
        <a href="{{ route('book.now') }}" class="btn-book">
            <img src="{{ asset('images/whatsapp-icon.png') }}" alt="WhatsApp Icon" />
            Book Now
        </a>
    @else
        <a href="{{ route('login') }}" class="btn-book">
            <img src="{{ asset('images/whatsapp-icon.png') }}" alt="WhatsApp Icon" />
            Silakan Login untuk Booking
        </a>
    @endif
      </div>
    </section>

    <!-- JavaScript -->
    <script src="{{ asset('js/room.js') }}"></script>
  </div>

</body>
</html>
