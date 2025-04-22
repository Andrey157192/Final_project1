@extends('layouts.main')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


<div class="content-wrapper bg-light py-5">
    <div class="container">

        {{-- Deskripsi --}}
        <div class="text-center mb-5">
            <h2 class="fw-bold">About Us</h2>
            <p class="lead text-muted">
                Welcome to <strong>Hotel Balige Beach</strong>, where luxury meets the tranquil beauty of Lake Toba.
                With breathtaking views, warm hospitality, and world-class service, we aim to make your stay unforgettable.
                Whether you're here for relaxation, adventure, or business — our team is dedicated to providing an exceptional experience.
            </p>
        </div>

        {{-- Foto Leadership --}}
        <div class="text-center mb-5">
            <h4 class="fw-bold mb-4">Our Leadership</h4>
            <div class="row justify-content-center">
                <div class="col-md-4 mb-3">
                    <div class="card border-0 shadow rounded-4">
                        <img src="{{ asset('assets/images/about/cowo owner.jpg') }}" 
                             class="mx-auto d-block mt-4"
                             alt="General Manager"
                             style="height: 250px; width: 200px; object-fit: cover; border-radius: 50% / 60%;">
                        <div class="card-body text-center">
                            <h5 class="card-title mb-0">John Sinaga</h5>
                            <p class="text-muted">General Manager</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card border-0 shadow rounded-4">
                        <img src="{{ asset('assets/images/about/cewe owner.jpg') }}" 
                             class="mx-auto d-block mt-4"
                             alt="Operations Manager"
                             style="height: 250px; width: 200px; object-fit: cover; border-radius: 50% / 60%;">
                        <div class="card-body text-center">
                            <h5 class="card-title mb-0">Maria Silalahi</h5>
                            <p class="text-muted">Operations Manager</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Carousel Foto View Hotel --}}
        <div class="mb-5">
            <h4 class="fw-bold text-center mb-4">Hotel Views</h4>
            <div id="hotelCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner rounded-4 shadow">
                    <div class="carousel-item active">
                        <img src="{{ asset('assets/images/about/view1.jpg') }}" class="d-block w-100" alt="View 1" style="height: 400px; object-fit: cover;">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('assets/images/about/view2.jpg') }}" class="d-block w-100" alt="View 2" style="height: 400px; object-fit: cover;">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('assets/images/about/view3.jpg') }}" class="d-block w-100" alt="View 3" style="height: 400px; object-fit: cover;">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('assets/images/about/view4.jpg') }}" class="d-block w-100" alt="View 4" style="height: 400px; object-fit: cover;">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('assets/images/about/view5.jpg') }}" class="d-block w-100" alt="View 5" style="height: 400px; object-fit: cover;">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#hotelCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#hotelCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>

        {{-- Sejarah Hotel --}}
        <div class="mb-5">
            <h4 class="fw-bold text-center mb-3">History of Hotel Balige Beach</h4>
            <p class="text-muted text-center">
                Didirikan pada tahun 1998, Hotel Balige Beach awalnya hanya memiliki 10 kamar kecil di tepi Danau Toba. 
                Seiring waktu, hotel ini berkembang menjadi salah satu penginapan paling ikonik di Balige dengan fasilitas modern, 
                restoran berkelas, dan pelayanan yang ramah. Kami tetap mempertahankan nilai-nilai lokal sambil menghadirkan standar internasional dalam layanan kami.
            </p>
        </div>

        {{-- Kontak --}}
        <div class="text-center">
            <h4 class="fw-bold mb-3">Contact Us</h4>
            <p class="mb-1"><i class="bi bi-telephone-fill me-2"></i><strong>Phone:</strong> +62 812 3456 7890</p>
            <p class="mb-1"><i class="bi bi-envelope-fill me-2"></i><strong>Email:</strong> info@baligebeachhotel.com</p>
            <p><i class="bi bi-geo-alt-fill me-2"></i><strong>Address:</strong> <a href="https://maps.app.goo.gl/fG6SPSC9dYwhMoYZ9" target="_blank" id="gmap-link">View on Google Maps</a></p>
        </div>

    </div>
</div>
@endsection
