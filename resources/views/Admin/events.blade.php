@extends('layouts.main')

@section('content')
<div class="content-wrapper">
  <div class="container mt-4">
    <h2 class="mb-4 text-center">Upcoming Events</h2>
    <div class="row">
      {{-- Event 1 --}}
      <div class="col-md-4 mb-4">
        <div class="card">
          <img src="https://source.unsplash.com/600x400/?beach-party" class="card-img-top" alt="Beach Party">
          <div class="card-body">
            <h5 class="card-title">Beach Party</h5>
            <p class="card-text">Join us every Friday evening for live music and bonfire.</p>
          </div>
        </div>
      </div>
      {{-- Event 2 --}}
      <div class="col-md-4 mb-4">
        <div class="card">
          <img src="https://source.unsplash.com/601x400/?yoga" class="card-img-top" alt="Sunrise Yoga">
          <div class="card-body">
            <h5 class="card-title">Sunrise Yoga</h5>
            <p class="card-text">Every morning at 6 AM on the beach deck. Free for guests.</p>
          </div>
        </div>
      </div>
      {{-- Event 3 --}}
      <div class="col-md-4 mb-4">
        <div class="card">
          <img src="https://source.unsplash.com/602x400/?seafood-dinner" class="card-img-top" alt="Seafood Dinner">
          <div class="card-body">
            <h5 class="card-title">Seafood Dinner</h5>
            <p class="card-text">Saturday gala dinner featuring the freshest catch of the day.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
