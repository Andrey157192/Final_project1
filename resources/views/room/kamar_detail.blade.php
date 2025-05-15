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
          <p>{{ $detail->rooms_type ?? 'Tipe kamar belum tersedia.' }}</p>
        </div>
        
        <div class="info-group">
          <h3 class="info-title"><i class="fas fa-users"></i> Kapasitas</h3>
          <p>{{ $detail->kapasitas ?? 'Tidak diketahui' }} Orang</p>
        </div>
        
        <div class="info-group">
          <h3 class="info-title"><i class="fas fa-tag"></i> Harga</h3>
          <p class="price">Rp {{ number_format($detail->price, 0, ',', '.') }} <span class="per-night">/ malam</span></p>
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
    </script>
  </div>

</body>
</html>
