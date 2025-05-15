@extends('user.layouts.main')

@section('content')
<style>
.media-custom {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 
                0 2px 4px -1px rgba(0, 0, 0, 0.06);
}

.media-custom:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 
                0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

.media-custom .img-container {
    overflow: hidden;
    border-radius: 10px 10px 0 0;
    position: relative;
}

.media-custom .img-container img {
    transition: transform 0.5s ease;
    width: 100%;
    height: 250px;
    object-fit: cover;
}

.media-custom:hover .img-container img {
    transform: scale(1.1);
}

.media-custom .img-container::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0);
    transition: background 0.3s ease;
}

.media-custom:hover .img-container::after {
    background: rgba(0, 0, 0, 0.2);
}

.media-custom .media-body {
    padding: 1.5rem;
}

.media-custom h2 a {
    color: #333;
    text-decoration: none;
    transition: color 0.3s ease;
}

.media-custom:hover h2 a {
    color: #007bff;
}

.media-custom .meta-post {
    color: #666;
    font-size: 0.9rem;
}
</style>

<section class="site-hero overlay" style="background-image: url(images/hero_4.jpg)" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row site-hero-inner justify-content-center align-items-center">
          <div class="col-md-10 text-center" data-aos="fade-up">
            <span class="custom-caption text-uppercase text-white d-block  mb-3">Welcome To 5 <span class="fa fa-star text-primary"></span>   Hotel</span>
            <h1 class="heading">Events</h1>
          </div>
        </div>
      </div>


    </section>
 <section class="section blog-post-entry bg-light">
  <div class="container">
    <div class="row justify-content-center text-center mb-5">
      <div class="col-md-7">
        <h2 class="heading" data-aos="fade-up">Events</h2>

      </div>
    </div>
    <div class="row">
      @foreach($events as $event)
        <div class="col-lg-4 col-md-6 col-sm-6 col-12 post" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
          <div class="media media-custom d-block mb-4 h-100">
            <div class="img-container mb-4">
              <img src="{{ asset('storage/'.$event->image_path) }}"
                   alt="{{ $event->title }}">
            </div>
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
