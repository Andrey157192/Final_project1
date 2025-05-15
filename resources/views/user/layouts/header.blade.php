<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Hotel Balige Beach.com</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="//fonts.googleapis.com/css?family=|Roboto+Sans:400,700|Playfair+Display:400,700">
  <link rel="stylesheet" href="/css/bootstrap.min.css">
  <link rel="stylesheet" href="/css/animate.css">
  <link rel="stylesheet" href="/css/owl.carousel.min.css">
  <link rel="stylesheet" href="/css/aos.css">
  <link rel="stylesheet" href="/css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="/css/jquery.timepicker.css">
  <link rel="stylesheet" href="/css/fancybox.min.css">
  <link rel="stylesheet" href="/fonts/ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="/fonts/fontawesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="/css/style.css">
</head>
<body class="{{ Auth::check() ? 'user-logged-in' : '' }}">

<header class="site-header js-site-header">
  <div class="container-fluid">
    <div class="row align-items-center">
      <div class="col-6 col-lg-4 site-logo" data-aos="fade">
        <a href="/"><img src="/images/Logo.png" alt="Hotel Balige Beach" class="logo-img"></a>
      </div>
      <div class="col-6 col-lg-8">
        <nav class="main-navbar">
          <div class="container-navbar">
            <div class="nav-links">
              <a href="/" class="nav-item"><i class="fas fa-home"></i> Home</a>
              <a href="/rooms" class="nav-item"><i class="fas fa-bed"></i> Rooms</a>
              <a href="/about-user" class="nav-item"><i class="fas fa-info-circle"></i> About</a>
              <a href="/events" class="nav-item"><i class="fas fa-calendar-alt"></i> Events</a>
              @if(Auth::check())
              <a href="/login" class="nav-item"><i class="fas fa-user"></i> {{Auth::user()->name}}</a>
              <a href="/logout" class="nav-item"
                 onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                 <i class="fas fa-sign-out-alt"></i> Logout
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                  <input type="hidden" name="redirect_to" value="/"> <!-- Redirect to home page -->
              </form>
              @else
              <a href="/login" class="nav-item"><i class="fas fa-user"></i> Login</a>
              @endif
            </div>
          </div>
        </nav>
      </div>
    </div>
  </div>
</header>
