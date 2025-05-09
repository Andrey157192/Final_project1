<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family Room</title>
    <link rel="stylesheet" href="{{ asset('css/room.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <!-- Room Header dengan tombol kembali dan judul -->
        <div class="room-header">
            <a href="javascript:history.back()" class="back-button">← Kembali</a>
            <h1 class="room-heading">Family Room</h1>
        </div>

        <!-- Kontainer Utama -->
        <div class="room-container">
            <!-- Gambar -->
            <div class="room-card">
                <img src="{{ asset('images/family-room.jpg') }}" alt="Family Room" class="room-img" />
            </div>

            <!-- Informasi Kamar -->
            <div class="room-info">
                <h2 class="room-title">Family Room</h2>
                <p><strong>Deskripsi:</strong> Kamar luas yang ideal untuk keluarga dengan anak-anak, dilengkapi dengan fasilitas lengkap untuk kenyamanan bersama.</p>
                <p><strong>Fasilitas:</strong> 2 Tempat tidur queen, AC, Wi-Fi, TV, Kamar mandi dalam, Lemari, Meja makan kecil</p>
                <p><strong>Kapasitas:</strong> Hingga 4 orang</p>
                <p><strong>Harga:</strong> Rp 450.000 / malam</p>

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