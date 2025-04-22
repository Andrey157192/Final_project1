@extends('layouts.main')

@section('content')
<div class="content-wrapper bg-light py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Available Rooms</h2>
            <p class="text-muted">Nikmati kenyamanan terbaik dari kamar-kamar pilihan kami yang dirancang untuk memenuhi setiap kebutuhan Anda.</p>
        </div>

        <div class="row justify-content-center">
            {{-- Card Template --}}
            @php
                $rooms = [
                    ['image' => 'deluxe.jpg', 'title' => 'Deluxe Room', 'price' => 'Rp 850.000 / night'],
                    ['image' => 'standard.jpg', 'title' => 'Standard Room', 'price' => 'Rp 650.000 / night'],
                    ['image' => 'Executive Suite.jpg', 'title' => 'Executive Suite', 'price' => 'Rp 1.200.000 / night'],
                    ['image' => 'ocean.jpg', 'title' => 'Ocean View Room', 'price' => 'Rp 1.500.000 / night'],
                    ['image' => 'Presidential Suite.jpg', 'title' => 'Presidential Suite', 'price' => 'Rp 3.000.000 / night'],
                    ['image' => 'family.jpg', 'title' => 'Family Room', 'price' => 'Rp 950.000 / night'],
                ];
            @endphp

            @foreach ($rooms as $room)
            <div class="col-lg-4 col-md-6 mb-4 d-flex align-items-stretch">
                <div class="card shadow-lg border-0 rounded-4 w-100 transition-all" style="transition: 0.3s;">
                    <img src="{{ asset('assets/images/rooms/' . $room['image']) }}" class="card-img-top rounded-top-4" alt="{{ $room['title'] }}" style="height: 250px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-semibold">{{ $room['title'] }}</h5>
                        <p class="card-text text-muted mb-3">{{ $room['price'] }}</p>
                        <a href="#" class="btn btn-primary mt-auto rounded-pill">Book Now</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<style>
    .card:hover {
        transform: scale(1.02);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }
</style>
@endsection
