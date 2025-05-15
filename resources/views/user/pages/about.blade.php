@extends('user.layouts.main')

@section('content')

<!-- Hero Section -->
<section class="site-hero inner-page overlay" style="background-image: url('{{ asset('images/hero_4.jpg') }}')" data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row site-hero-inner justify-content-center align-items-center">
      <div class="col-md-10 text-center" data-aos="fade">
        <h1 class="heading mb-3">About Us</h1>
        <ul class="custom-breadcrumbs mb-4">
          <li><a href="{{ url('/') }}">Home</a></li>
          <li>&bullet;</li>
          <li>About</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- About Description & History -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="row mb-4">
      <div class="col-md-8 mx-auto text-center">
        <h2 class="heading">Welcome!</h2>
        <p>{{ $settings->description }}</p> 
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <h3 class="mb-3">Our History</h3>
        <p>{{ $settings->history }}</p> 
      </div>
    </div>
  </div>
</section>

<!-- Leadership Section -->
<section class="section bg-light" id="leadership">
  <div class="container">
    <div class="row justify-content-center text-center mb-5">
      <div class="col-md-8">
        <h2 class="heading" data-aos="fade-up">Pimpinan Kami</h2>
        <p class="lead text-muted" data-aos="fade-up" data-aos-delay="100">
          Di balik kenyamanan dan pelayanan terbaik kami, hadir sosok-sosok inspiratif yang memimpin dengan visi, semangat, dan dedikasi. Inilah mereka — wajah di balik pelayanan terbaik kami.
        </p>
      </div>
    </div>

    <div class="row">
      @foreach($leaderships as $leader)
        <div class="col-sm-6 col-md-4 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 + 100 }}">
          <div class="card border-0 shadow-sm h-100">
            <img src="{{ asset('storage/' . $leader->photo_path) }}"
                 class="card-img-top"
                 alt="{{ $leader->name }}"
                 style="height: 280px; object-fit: cover;">
            <div class="card-body text-center bg-white">
              <h5 class="card-title mb-1">{{ $leader->name }}</h5>
              <small class="text-muted">Founder & Owner</small>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>


<style>
  #leadership .card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  #leadership .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
  }
</style>


<!-- Photo Gallery Section -->
<section class="section slider-section bg-light" id="gallery">
  <style>
    .slider-item img {
      width: 100%;
      aspect-ratio: 16 / 9;
      object-fit: cover;
      object-position: center;
      border-radius: 10px;
      transition: transform 0.3s ease;
    }
    .slider-item img:hover {
      transform: scale(1.05);
    }
  </style>
  <div class="container">
    <div class="row justify-content-center text-center mb-5">
      <div class="col-md-7">
        <h2 class="heading" data-aos="fade-up">Gallery</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="home-slider major-caousel owl-carousel mb-5" data-aos="fade-up" data-aos-delay="200">
          @foreach($views as $view)
          <div class="slider-item">
            <a href="{{ asset('storage/' . $view->photo_path) }}" data-fancybox="images" data-caption="">
              <img src="{{ asset('storage/' . $view->photo_path) }}" alt="Hotel view" class="img-fluid">
            </a>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Extra History Section (Optional) -->
<div class="container my-5">
  <div class="row mb-4">
    <div class="col-md-8 mx-auto text-center">
      <h2 class="heading">History</h2>
      <p>{{ $settings->history }}</p> 
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script>
  $(document).ready(function(){
    $('.home-slider').owlCarousel({
      loop:true,
      margin:10,
      nav:true,
      responsive:{
        0:{ items:1 },
        600:{ items:2 },
        1000:{ items:3 }
      }
    });
  });
</script>
@endpush