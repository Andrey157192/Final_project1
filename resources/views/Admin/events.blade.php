@extends('layouts.main')

@section('content')
<div class="content-wrapper bg-light py-5">
  <div class="container">
    <h2 class="text-center fw-bold mb-3">Upcoming Events</h2>
    <p class="text-center text-muted mb-5">
      Hotel Balige Beach menghadirkan berbagai acara spesial untuk menyempurnakan pengalaman menginap Anda. 
      Nikmati momen penuh keceriaan, relaksasi, dan kelezatan kuliner yang dirancang untuk semua tamu kami.
    </p>

    <div class="row g-4">

      {{-- Event 1 --}}
      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-lg rounded-4 hover-shadow">
          <div class="overflow-hidden rounded-top-4">
            <img src="{{ asset('assets/images/events/Beach Party.jpg') }}" 
                 class="card-img-top" 
                 alt="Beach Party" 
                 style="height: 250px; object-fit: cover; transition: transform 0.4s ease;">
          </div>
          <div class="card-body text-center">
            <h5 class="fw-bold">Beach Party</h5>
            <p class="text-muted">
              Meriahkan malam Jumat Anda dengan pesta pantai eksklusif, live music, dan api unggun yang hangat. 
              Rasakan suasana tropis yang penuh semangat!
            </p>
          </div>
        </div>
      </div>

      {{-- Event 2 --}}
      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-lg rounded-4 hover-shadow">
          <div class="overflow-hidden rounded-top-4">
            <img src="{{ asset('assets/images/events/Sunrise Yoga.jpg') }}" 
                 class="card-img-top" 
                 alt="Sunrise Yoga" 
                 style="height: 250px; object-fit: cover; transition: transform 0.4s ease;">
          </div>
          <div class="card-body text-center">
            <h5 class="fw-bold">Sunrise Yoga</h5>
            <p class="text-muted">
              Awali hari Anda dengan ketenangan dan energi positif di sesi yoga pagi bersama instruktur profesional di tepi pantai.
              Tersedia setiap hari pukul 06.00, gratis untuk tamu hotel.
            </p>
          </div>
        </div>
      </div>

      {{-- Event 3 --}}
      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-lg rounded-4 hover-shadow">
          <div class="overflow-hidden rounded-top-4">
            <img src="{{ asset('assets/images/events/Seafood Dinner.jpg') }}" 
                 class="card-img-top" 
                 alt="Seafood Dinner" 
                 style="height: 250px; object-fit: cover; transition: transform 0.4s ease;">
          </div>
          <div class="card-body text-center">
            <h5 class="fw-bold">Seafood Dinner</h5>
            <p class="text-muted">
              Nikmati gala dinner spesial setiap Sabtu malam dengan sajian seafood segar pilihan dan suasana romantis di tepi laut.
            </p>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

{{-- Optional Custom Style --}}
<style>
  .card:hover img {
    transform: scale(1.05);
  }
</style>
@endsection
