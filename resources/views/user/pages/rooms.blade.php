@extends('user.layouts.main')

@section('content')

<!-- Hero Section -->
<section class="site-hero inner-page overlay" style="background-image: url(images/hero_4.jpg)" data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row site-hero-inner justify-content-center align-items-center">
      <div class="col-md-10 text-center" data-aos="fade">
        <h1 class="heading mb-3">Rooms</h1>
        <ul class="custom-breadcrumbs mb-4">
          <li><a href="/">Home</a></li>
          <li>&bullet;</li>
          <li>Rooms</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- Welcome Section -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-12 col-lg-7 ml-auto order-lg-2 position-relative mb-5" data-aos="fade-up">
        <figure class="img-absolute">
          <img src="images/food-1.jpg" alt="Image" class="img-fluid">
        </figure>
        <img src="images/img_1.jpg" alt="Image" class="img-fluid rounded">
      </div>
       <div class="col-md-12 col-lg-4 order-lg-1" data-aos="fade-up">
            <h2 class="heading">Welcome!</h2>
            <p class="mb-4">Bukan sekadar tempat menginap, tapi tempat di mana setiap perjalanan berubah menjadi kenangan. Temukan keindahan, kenyamanan, dan keramahan yang menyatu dalam setiap sudut kami.</p>
            <p><a href="events" class="btn btn-primary text-white py-2 mr-3"></a> <span class="mr-3 font-family-serif"><em>or</em></span> <a href="https://youtu.be/FZ6hNPt72mE?si=T7K3-aW6iLDQ-ZUi"  data-fancybox class="text-uppercase letter-spacing-1">See video</a></p>
          </div>
    </div>
  </div>
</section>

<!-- Rooms Section -->
<section class="section">
  <div class="container">
    <div class="row justify-content-center text-center mb-5">
      <div class="col-md-7">
        <h2 class="heading" data-aos="fade-up">Rooms &amp; Suites</h2>
        <p data-aos="fade-up" data-aos-delay="100">Far far away, behind the word mountains...</p>
      </div>
    </div>
    <div class="row">
      @foreach ($dataRooms as $data)
      <div class="col-md-6 col-lg-4" data-aos="fade-up">
        <a href="{{ route('room.detail', $data->id) }}" class="room">
          <figure class="img-wrap">
            <div class="img-16by9">
              <img src="{{ asset('storage/' . $data->picture) }}" alt="Room Image" class="img-fluid room-image">
            </div>
          </figure>
          <div class="p-3 text-center room-info">
            <h2>{{ $data->title }}</h2>
            <span class="text-uppercase letter-spacing-1">Rp {{ $data->price }} / per night</span>
          </div>
        </a>
      </div>
      @endforeach

      <!-- Room Statis -->
      

    </div>
  </div>
</section>

<!-- Tambahkan CSS untuk rasio 16:9 -->
<style>
.img-16by9 {
  position: relative;
  width: 100%;
  padding-top: 56.25%; /* 16:9 Aspect Ratio */
  overflow: hidden;
  border-radius: 10px;
}

.room-image {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
}
</style>

@endsection
