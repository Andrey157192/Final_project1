<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="/home">
        <i class="bi bi-house-door-fill menu-icon"></i>
        <span class="menu-title">Home</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="/dashboard/admin/rooms">
        <i class="bi bi-building menu-icon"></i>
        <span class="menu-title">Rooms</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="/about">
        <i class="bi bi-info-circle-fill menu-icon"></i>
        <span class="menu-title">About</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="/events">
        <i class="bi bi-calendar-event-fill menu-icon"></i>
        <span class="menu-title">Events</span>
      </a>
    </li>

    {{-- Rating Menu --}}
    <li class="nav-item">
      <a class="nav-link" href="/rating">
        <i class="bi bi-star-fill menu-icon"></i>
        <span class="menu-title">Rating</span>
      </a>
    </li>

    {{-- Data User Menu --}}
    <li class="nav-item">
      <a class="nav-link" href="{{ route('datauser.index') }}">
        <i class="bi bi-people-fill menu-icon"></i>
        <span class="menu-title">Data User</span>
      </a>
    </li>

  </ul>
</nav>
