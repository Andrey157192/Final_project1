<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Kamar - {{ $detail->title }}</title>
  <link rel="stylesheet" href="{{ asset('css/room.css') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
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
        <img src="{{ asset('storage/' . $detail->photo_path) }}" alt="{{ $detail->title }}" class="room-img" />
        <h2 class="room-title">{{ $detail->title }}</h2>
      </div>

      <div class="room-info">
        <p><strong>Deskripsi:</strong> {{ $detail->description ?? 'Deskripsi belum tersedia.' }}</p>
        <p><strong>Fasilitas:</strong> {{ $detail->facilities ?? 'Informasi fasilitas belum tersedia.' }}</p>
        <p><strong>Kapasitas:</strong> {{ $detail->capacity ?? 'Tidak diketahui' }} Orang</p>
        <p><strong>Harga:</strong> Rp {{ number_format($detail->price, 0, ',', '.') }} / malam</p>

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
            <img src="{{ asset('images/whatsapp-icon.png') }}" alt="WhatsApp Icon" />
            Book Now
        </button>
        </form>
        @else
        <a href="{{ route('login') }}" class="btn-book">
        <img src="{{ asset('images/whatsapp-icon.png') }}" alt="WhatsApp Icon" />
        Silakan Login untuk Booking
        </a>
    @endif


    <!-- JavaScript -->
    <script src="{{ asset('js/room.js') }}"></script>
  </div>

</body>
</html>
