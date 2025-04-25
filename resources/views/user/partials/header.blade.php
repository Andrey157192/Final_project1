<ul class="list-unstyled menu">
    <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="{{ url('/') }}">Home</a></li>
    <li class="{{ request()->is('rooms') ? 'active' : '' }}"><a href="{{ url('/rooms') }}">Rooms</a></li>
    <li class="{{ request()->is('about') ? 'active' : '' }}"><a href="{{ url('/about') }}">About</a></li>
    <li class="{{ request()->is('events') ? 'active' : '' }}"><a href="{{ url('/events') }}">Events</a></li>
    <li class="{{ request()->is('contact') ? 'active' : '' }}"><a href="{{ url('/contact') }}">Contact</a></li>
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
