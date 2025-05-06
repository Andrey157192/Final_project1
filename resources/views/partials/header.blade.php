<ul class="list-unstyled menu">
    <!-- Navigasi Menu -->
    <nav class="main-navbar">
                <div class="container-navbar">
                  <div class="nav-links">
                    <a href="/" class="nav-item"><i class="fas fa-home"></i> Home</a>
                    <a href="/rooms" class="nav-item"><i class="fas fa-bed"></i> Rooms</a>
                    <a href="/about" class="nav-item"><i class="fas fa-info-circle"></i> About</a>
                    <a href="/events" class="nav-item"><i class="fas fa-calendar-alt"></i> Events</a>
                    <a href="/login" class="nav-item"><i class="fas fa-user"></i> Login</a>
                  </div>
                </div>
              </nav>
      
            </div>
            <!-- End Navbar -->

    {{-- <li class="{{ request()->is('reservation') ? 'active' : '' }}"><a href="{{ url('/reservation') }}">Reservation</a></li> --}}

    @auth
        @if(auth()->user()->role == 'manager' || auth()->user()->role == 'resepsionis')
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        @endif
        <li>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </li>
    @else
        <li><a href="{{ route('login') }}">Login</a></li>
        <li><a href="{{ route('register') }}">Register</a></li>
    @endauth
</ul>
