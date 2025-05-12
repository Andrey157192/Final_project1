@extends('user.layouts.main')

@section('content')

<section class="site-hero overlay" style="background-image: url(images/hero_4.jpg)" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row site-hero-inner justify-content-center align-items-center">
          <div class="col-md-10 text-center" data-aos="fade-up">
            <span class="custom-caption text-uppercase text-white d-block  mb-3">Welcome To 5 <span class="fa fa-star text-primary"></span>   Hotel</span>
            <h1 class="heading">A Best Place To Stay</h1>
          </div>
        </div>
      </div>


    </section>
 <section class="section blog-post-entry bg-light">
  <div class="container">
    <div class="row justify-content-center text-center mb-5">
      <div class="col-md-7">
        <h2 class="heading" data-aos="fade-up">Events</h2>
        <p data-aos="fade-up">…deskripsi…</p>
      </div>
    </div>
    <div class="row">
      @foreach($events as $event)
        <div class="col-lg-4 col-md-6 col-sm-6 col-12 post" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
          <div class="media media-custom d-block mb-4 h-100">
            <a href="#" class="mb-4 d-block">
              <img src="{{ asset('storage/'.$event->image_path) }}"
                   alt="{{ $event->title }}"
                   class="img-fluid">
            </a>
            <div class="media-body">
              <span class="meta-post">
                {{ $event->start_date->format('d M, Y') }}
                @if($event->start_date != $event->end_date)
                  – {{ $event->end_date->format('d M, Y') }}
                @endif
              </span>
              <h2 class="mt-0 mb-3">
                <a href="#">{{ $event->title }}</a>
              </h2>
              <p>{{ Str::limit($event->description, 100) }}</p>
            </div>
          </div>
        </div>
      @endforeach

      @if($events->isEmpty())
        <p class="text-center">Belum ada event terbaru.</p>
      @endif
    </div>
  </div>
</section>
@endsection
