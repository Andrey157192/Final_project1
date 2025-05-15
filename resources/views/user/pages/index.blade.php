@extends('user.layouts.main')

@section('content')

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        .room img {
            width: 100%;
            height: 250px; /* Sesuaikan ukuran yang diinginkan */
            object-fit: cover; /* Menjaga gambar agar tetap terjaga proporsinya */
        }

         .post img {
            width: 100%;
            height: 250px; /* Sesuaikan dengan ukuran yang diinginkan */
            object-fit: cover;
        }

        .rating-slider {
            padding: 40px 0;
            background: #f8f9fa;
        }

        .rating-card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin: 10px;
        }

        .rating-stars {
            color: #ffc107;
            margin-bottom: 10px;
        }

        .rating-comment {
            font-style: italic;
            margin-bottom: 10px;
        }

        .rating-user {
            font-weight: bold;
            color: #666;
        }

        .swiper-container {
            padding: 20px 0;
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
</head>

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
    <!-- END section -->



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

    <section class="section">
      <div class="container">
        <div class="row justify-content-center text-center mb-5">
          <div class="col-md-7">
            <h2 class="heading" data-aos="fade-up">Rooms &amp; Suites</h2>
            <p data-aos="fade-up" data-aos-delay="100">Di balik batas kesibukan dunia, kami hadir sebagai tempat beristirahat yang nyaman, tenang, dan penuh cerita. Setiap sudut kami rancang untuk menghadirkan kehangatan, kenyamanan, dan layanan yang berkesan..</p>
          </div>
        </div>
        <div class="row">
            @foreach ($dataRooms as $data )
            <div class="col-md-6 col-lg-4" data-aos="fade-up">
            <a href="{{ route('room.detail', $data->id) }}" class="room">
  <figure class="img-wrap">
    <img src="{{ asset('storage/' . $data->picture) }}" alt="Room Image" class="img-fluid mb-3">
  </figure>
  <div class="p-3 text-center room-info">
    <h2>{{ $data->title }}</h2>
    <span class="text-uppercase letter-spacing-1">Rp {{ $data->price }} / per night</span>
  </div>
</a>

          </div>
            @endforeach



        </div>
      </div>
    </section>


    <section class="section slider-section bg-light">
      <div class="container">
        <div class="row justify-content-center text-center mb-5">
          <div class="col-md-7">
            <h2 class="heading" data-aos="fade-up">Photos</h2>
            <p data-aos="fade-up" data-aos-delay="100">"Jauh dari hiruk pikuk kota, di tepi tenangnya Danau Toba, berdiri Hotel Balige Beach yang menawarkan ketenangan dan keindahan alam. Di antara gemericik ombak dan semilir angin sore, setiap tamu diajak merasakan kenyamanan dan pesona panorama yang tak terlupakan."</p>
          </div>
        </div>
        <style>
  .slider-item {
    border-radius: 10px;
    overflow: hidden;
  }

  .slider-item img {
    width: 100%;
    aspect-ratio: 16 / 9;        /* Rasio 16:9 */
    object-fit: cover;           /* Potong gambar agar proporsional */
    object-position: center;
    display: block;
  }

  /* Responsive image wrap */
.img-wrap {
  overflow: hidden;
  border-radius: 10px;
  position: relative;
}
.img-wrap img {
  transition: transform 0.3s ease;
}
.img-wrap:hover img {
  transform: scale(1.05);
}

/* Room info hover */
.room-info:hover {
  background: #f8f9fa;
  transition: all 0.3s ease;
}

/* Fancybox image hover */
.slider-item img {
  width: 100%;
  aspect-ratio: 16 / 9;
  object-fit: cover;
  object-position: center;
  display: block;
  border-radius: 8px;
  transition: 0.3s ease;
}
.slider-item img:hover {
  transform: scale(1.03);
  box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}

/* Section headings */
.heading {
  font-weight: 700;
  font-size: 2.2rem;
}

</style>

<div class="row">
  <div class="col-md-12">
    <div class="home-slider major-caousel owl-carousel mb-5" data-aos="fade-up" data-aos-delay="200">

      <div class="slider-item">
        <a href="images/slider-1.png" data-fancybox="images" data-caption="Caption for this image">
          <img src="images/slider-1.png" alt="Image 1" class="img-fluid">
        </a>
      </div>

      <div class="slider-item">
        <a href="images/slider-2.png" data-fancybox="images" data-caption="Caption for this image">
          <img src="images/slider-2.png" alt="Image 2" class="img-fluid">
        </a>
      </div>

      <div class="slider-item">
        <a href="images/slider-3.png" data-fancybox="images" data-caption="Caption for this image">
          <img src="images/slider-3.png" alt="Image 3" class="img-fluid">
        </a>
      </div>

      <div class="slider-item">
        <a href="images/slider-4.png" data-fancybox="images" data-caption="Caption for this image">
          <img src="images/slider-4.png" alt="Image 4" class="img-fluid">
        </a>
      </div>

      <div class="slider-item">
        <a href="images/slider-5.png" data-fancybox="images" data-caption="Caption for this image">
          <img src="images/slider-5.png" alt="Image 5" class="img-fluid">
        </a>
      </div>

    </div> <!-- END owl-carousel -->
  </div>
</div>

    </section>
    <!-- END section -->

    <section class="section bg-image overlay" style="background-image: url('images/hero_3.jpg');">
      <div class="container">
        <div class="row justify-content-center text-center mb-5">
          <div class="col-md-7">
            <h2 class="heading text-white" data-aos="fade">Our Restaurant Menu</h2>
            <p class="text-white" data-aos="fade" data-aos-delay="100">Lebih dari sekadar tempat makan—kami adalah ruang untuk menikmati rasa, berbagi cerita, dan menciptakan momen. Selamat datang di tempat di mana setiap hidangan disajikan dengan hati.</p>
          </div>
        </div>
        <div class="food-menu-tabs" data-aos="fade">
          <ul class="nav nav-tabs mb-5" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active letter-spacing-2" id="mains-tab" data-toggle="tab" href="#mains" role="tab" aria-controls="mains" aria-selected="true">Mains</a>
            </li>
            <li class="nav-item">
              <a class="nav-link letter-spacing-2" id="desserts-tab" data-toggle="tab" href="#desserts" role="tab" aria-controls="desserts" aria-selected="false">Desserts</a>
            </li>
            <li class="nav-item">
              <a class="nav-link letter-spacing-2" id="drinks-tab" data-toggle="tab" href="#drinks" role="tab" aria-controls="drinks" aria-selected="false">Drinks</a>
            </li>
          </ul>
          <div class="tab-content py-5" id="myTabContent">


            <!-- MAINS -->
<div class="tab-pane fade show active text-left" id="mains" role="tabpanel" aria-labelledby="mains-tab">
  <div class="row">
    <div class="col-md-6">
      <div class="food-menu mb-5">
        <span class="d-block text-primary h4 mb-3">Rp 35.000</span>
        <h3 class="text-white"><a href="#" class="text-white">Ayam Geprek</a></h3>
        <p class="text-white text-opacity-7">Spicy smashed fried chicken served with rice and sambal.</p>
      </div>
      <div class="food-menu mb-5">
        <span class="d-block text-primary h4 mb-3">Rp 38.000</span>
        <h3 class="text-white"><a href="#" class="text-white">Ayam Penyet</a></h3>
        <p class="text-white text-opacity-7">Traditional smashed fried chicken with sambal and rice.</p>
      </div>
      <div class="food-menu mb-5">
        <span class="d-block text-primary h4 mb-3">Rp 20.000</span>
        <h3 class="text-white"><a href="#" class="text-white">Telur Geprek</a></h3>
        <p class="text-white text-opacity-7">Egg-based alternative of geprek with sambal and rice.</p>
      </div>
    </div>
    <div class="col-md-6">
      <div class="food-menu mb-5">
        <span class="d-block text-primary h4 mb-3">Rp 5.000</span>
        <h3 class="text-white"><a href="#" class="text-white">Nasi Putih</a></h3>
        <p class="text-white text-opacity-7">Steamed white rice.</p>
      </div>
      <div class="food-menu mb-5">
        <span class="d-block text-primary h4 mb-3">Rp 10.000</span>
        <h3 class="text-white"><a href="#" class="text-white">Tahu / Tempe</a></h3>
        <p class="text-white text-opacity-7">Fried tofu or tempeh side dish.</p>
      </div>
    </div>
  </div>
</div>


            <!-- DESSERTS -->
<div class="tab-pane fade text-left" id="desserts" role="tabpanel" aria-labelledby="desserts-tab">
  <div class="row">
    <div class="col-md-6">
      <div class="food-menu mb-5">
        <span class="d-block text-primary h4 mb-3">Rp 5.000</span>
        <h3 class="text-white"><a href="#" class="text-white">Puding Coklat</a></h3>
        <p class="text-white text-opacity-7">Chocolate pudding dessert.</p>
      </div>
    </div>
  </div>
</div>

           <!-- DRINKS -->
<div class="tab-pane fade text-left" id="drinks" role="tabpanel" aria-labelledby="drinks-tab">
  <div class="row">
    <div class="col-md-6">
      <div class="food-menu mb-5">
        <span class="d-block text-primary h4 mb-3">Rp 3.000</span>
        <h3 class="text-white"><a href="#" class="text-white">Air Mineral</a></h3>
        <p class="text-white text-opacity-7">Bottled mineral water.</p>
      </div>
      <div class="food-menu mb-5">
        <span class="d-block text-primary h4 mb-3">Rp 4.000</span>
        <h3 class="text-white"><a href="#" class="text-white">Teh Tawar Panas / Es</a></h3>
        <p class="text-white text-opacity-7">Hot or iced unsweetened tea.</p>
      </div>
      <div class="food-menu mb-5">
        <span class="d-block text-primary h4 mb-3">Rp 5.000</span>
        <h3 class="text-white"><a href="#" class="text-white">Teh Manis Panas / Es</a></h3>
        <p class="text-white text-opacity-7">Hot or iced sweet tea.</p>
      </div>
    </div>
    <div class="col-md-6">
      <div class="food-menu mb-5">
        <span class="d-block text-primary h4 mb-3">Rp 5.000</span>
        <h3 class="text-white"><a href="#" class="text-white">Jeruk Panas / Es</a></h3>
        <p class="text-white text-opacity-7">Hot or iced orange juice.</p>
      </div>
      <div class="food-menu mb-5">
        <span class="d-block text-primary h4 mb-3">Rp 5.000</span>
        <h3 class="text-white"><a href="#" class="text-white">Nutrisari</a></h3>
        <p class="text-white text-opacity-7">Instant fruit-flavored drink.</p>
      </div>
    </div>
  </div>
</div>

          </div>
        </div>
      </div>
    </section>

    <!-- END section -->
    <!-- Reviews Section -->
<section class="section testimonial-section">
  <div class="container">
    <div class="row justify-content-center text-center mb-5">
      <div class="col-md-7">
        <h2 class="heading" data-aos="fade-up">What Our Guests Say</h2>
        <p class="text-muted" data-aos="fade-up" data-aos-delay="100">Read reviews from guests who have experienced our hospitality</p>
      </div>
    </div>

    <!-- Reviews Slideshow -->
    <div class="row">
      <div class="col-md-12">
        <div class="js-carousel-2 owl-carousel mb-5" data-aos="fade-up" data-aos-delay="200">
          @foreach($ratings as $rating)
          <div class="testimonial text-center slider-item">
            <div class="rating-display mb-4">
              @for($i = 1; $i <= 5; $i++)
                <i class="fas fa-star {{ $i <= $rating->rating ? 'text-warning' : 'text-muted' }}"></i>
              @endfor
            </div>
            <blockquote class="mb-4">
              <p class="review-text">&ldquo;{{ $rating->comment }}&rdquo;</p>
            </blockquote>
            <div class="reviewer-info">
              <h5 class="reviewer-name mb-2">{{ $rating->user->name }}</h5>
              <small class="text-muted">{{ $rating->created_at->format('M d, Y') }}</small>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>

    <!-- Review Form or Login Prompt -->
    <div class="row justify-content-center">
      <div class="col-lg-6">
        @auth
          <div class="review-form-container bg-white p-4 rounded-lg shadow" data-aos="fade-up">
            <h3 class="text-center mb-4">Share Your Experience</h3>
            <form action="{{ route('ratings.store') }}" method="POST">
              @csrf
              <div class="form-group mb-4">
                <label class="d-block text-center mb-3">Your Rating</label>
                <div class="rating-input text-center">
                  @for($i = 5; $i >= 1; $i--)
                    <input type="radio" name="rating" id="star{{ $i }}" value="{{ $i }}" class="d-none" required>
                    <label for="star{{ $i }}" class="star-label mx-1">
                      <i class="fas fa-star fa-lg"></i>
                    </label>
                  @endfor
                </div>
              </div>
              <div class="form-group mb-4">
                <textarea name="comment" 
                          class="form-control" 
                          rows="4" 
                          placeholder="Tell us about your stay..."
                          required></textarea>
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-warning px-5 py-2">
                  Submit Review
                </button>
              </div>
            </form>
          </div>
        @else
          <div class="login-prompt text-center bg-white p-4 rounded-lg shadow" data-aos="fade-up">
            <i class="fas fa-comment-dots fa-3x text-warning mb-3"></i>
            <h3 class="mb-3">Want to Share Your Experience?</h3>
            <p class="text-muted mb-4">Sign in to share your review and help other travelers</p>
            <a href="{{ route('login') }}" class="btn btn-warning px-5 py-2">
              Sign In to Review
            </a>
          </div>
        @endauth
      </div>
    </div>
  </div>

  <style>
    .testimonial-section {
    background-color: #F8F4E1;
    padding: 80px 0;
  }
  .slider-item {
    background: #F8F4E1;
    padding: 40px 30px;
    border-radius: 10px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.05);
    margin: 10px;
    min-height: 300px;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }
    .rating-display {
      font-size: 24px;
    }
    .review-text {
      font-size: 16px;
      line-height: 1.8;
      color: #555;
      margin-bottom: 20px;
    }
    .reviewer-name {
      color: #333;
      font-weight: 600;
      font-size: 18px;
    }
    .btn-warning {
      background-color: #ffc107;
      border: none;
      border-radius: 30px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 1px;
      transition: all 0.3s ease;
      color: #000;
    }
    .btn-warning:hover {
      background-color: #ffb300;
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(255,193,7,0.3);
      color: #000;
    }
    .js-carousel-2 .owl-nav {
      text-align: center;
      margin-top: 20px;
    }
    .js-carousel-2 .owl-nav button {
      background: #ffc107 !important;
      color: white !important;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      margin: 0 5px;
      transition: all 0.3s ease;
    }
    .js-carousel-2 .owl-nav button:hover {
      background: #ffb300 !important;
      transform: translateY(-2px);
    }
    .js-carousel-2 .owl-dots {
      text-align: center;
      margin-top: 20px;
    }
    .js-carousel-2 .owl-dot {
      width: 10px;
      height: 10px;
      margin: 0 5px;
      background: #ddd !important;
      border-radius: 50%;
      transition: all 0.3s ease;
    }
    .js-carousel-2 .owl-dot.active {
      background: #ffc107 !important;
      transform: scale(1.2);
    }
    .rating-input label {
      cursor: pointer;
      color: #dee2e6;
      transition: color 0.2s ease;
      font-size: 24px;
    }
    .rating-input input:checked ~ label,
    .rating-input label:hover,
    .rating-input label:hover ~ label {
      color: #ffc107;
    }
  </style>

  <!-- Initialize Owl Carousel -->
  <script>
    $(document).ready(function(){
      $(".js-carousel-2").owlCarousel({
        center: true,
        items: 1,
        loop: true,
        margin: 30,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        nav: true,
        dots: true,
        navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
        responsive: {
          768: {
            items: 2
          },
          992: {
            items: 3
          }
        }
      });
    });

      document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();
      document.querySelector(this.getAttribute('href')).scrollIntoView({ behavior: 'smooth' });
    });
  });
  </script>
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

    <section class="section bg-image overlay" style="background-image: url('images/hero_4.jpg');">
        <div class="container" >
          <div class="row align-items-center">
            <div class="col-12 col-md-6 text-center mb-4 mb-md-0 text-md-left" data-aos="fade-up">
              <h2 class="text-white font-weight-bold">A Best Place To Stay. Reserve Now!</h2>
            </div>
            <div class="col-12 col-md-6 text-center text-md-right" data-aos="fade-up" data-aos-delay="200">
              <a href="rooms" class="btn btn-outline-white-primary py-3 text-white px-5">Reserve Now</a>
            </div>
          </div>
        </div>
      </section>
@endsection

@push('scripts')
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    new Swiper('.swiper-container', {
        slidesPerView: 1,
        spaceBetween: 20,
        pagination: {
            el: '.swiper-pagination',
            clickable: true
        },
        breakpoints: {
            640: {
                slidesPerView: 2,
            },
            768: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 3,
            },
        },
        autoplay: {
            delay: 5000,
        },
    });
</script>
@endpush


