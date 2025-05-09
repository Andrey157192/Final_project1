@extends('user.layouts.main')

@section('content')
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

    <section class="section">
      <div class="container">
        <div class="row justify-content-center text-center mb-5">
          <div class="col-md-7">
            <h2 class="heading" data-aos="fade-up">Rooms &amp; Suites</h2>
            <p data-aos="fade-up" data-aos-delay="100">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
          </div>
        </div>
        <div class="row">
<<<<<<< HEAD
            @foreach ($rooms as $data )
            <div class="col-md-6 col-lg-4" data-aos="fade-up">
            <a href="room/single" class="room">
=======
          <div class="col-md-6 col-lg-4 mb-5" data-aos="fade-up">
            <a href="room/kamar1" class="room">
>>>>>>> 848fa5c0e136939ea5a04a32a74c65d608118c6a
              <figure class="img-wrap">
                <img src="{{ asset('storage/' . $data->photo_path) }}" alt="Free website template" class="img-fluid mb-3">
              </figure>
              <div class="p-3 text-center room-info">
<<<<<<< HEAD
                <h2>{{ $data->title }}</h2>
                <span class="text-uppercase letter-spacing-1">Rp {{ $data->price }} / per night</span>
=======
                <h2>kamar 1</h2>
                <span class="text-uppercase letter-spacing-1">90$ / per night</span>
>>>>>>> 848fa5c0e136939ea5a04a32a74c65d608118c6a
              </div>
            </a>
          </div>
            @endforeach
         

<<<<<<< HEAD
          <div class="col-md-6 col-lg-4" data-aos="fade-up">
            <a href="room/family" class="room">
=======
          <div class="col-md-6 col-lg-4 mb-5" data-aos="fade-up">
            <a href="room/kamar2" class="room">
>>>>>>> 848fa5c0e136939ea5a04a32a74c65d608118c6a
              <figure class="img-wrap">
                <img src="images/img_2.jpg" alt="Free website template" class="img-fluid mb-3">
              </figure>
              <div class="p-3 text-center room-info">
                <h2>kamar 2</h2>
                <span class="text-uppercase letter-spacing-1">120$ / per night</span>
              </div>
            </a>
          </div>

<<<<<<< HEAD
          <div class="col-md-6 col-lg-4" data-aos="fade-up">
            <a href="room/presidential" class="room">
=======
          <div class="col-md-6 col-lg-4 mb-5" data-aos="fade-up">
            <a href="room/kamar3" class="room">
>>>>>>> 848fa5c0e136939ea5a04a32a74c65d608118c6a
              <figure class="img-wrap">
                <img src="images/img_3.jpg" alt="Free website template" class="img-fluid mb-3">
              </figure>
              <div class="p-3 text-center room-info">
                <h2>kamar 3</h2>
                <span class="text-uppercase letter-spacing-1">250$ / per night</span>
              </div>
            </a>
          </div>


        </div>
      </div>
    </section>
@endsection


