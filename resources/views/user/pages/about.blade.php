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
    <section class="section" id="leadership">
      <div class="container">
        <div class="row justify-content-center text-center mb-5">
          <div class="col-md-7">
            <h2 class="heading" data-aos="fade-up">Leadership</h2>
          </div>
        </div>
        <div class="row">
          @foreach($leaderships as $leader)
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 + 100 }}">
              <div class="block-2">
                <div class="flipper">
                  <div class="front" style="background-image: url('{{ asset('storage/' . $leader->photo_path) }}');">
                    <div class="box">
                      <h2>{{ $leader->name }}</h2>
                    </div>
                  </div>
                  <div class="back">
                    <div class="author d-flex">
                      <div class="image mr-3 align-self-center">
                        <img src="{{ asset('storage/' . $leader->photo_path) }}" alt="{{ $leader->name }}" class="img-fluid rounded-circle">
                      </div>
                      <div class="name align-self-center">{{ $leader->name }}</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>

    <!-- Photo Gallery Section -->
    <section class="section slider-section bg-light" id="gallery">
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
@endsection
