@extends('layouts.main')

@section('content')
<div class="content-wrapper">
  <div class="container mt-4">
    <h2 class="mb-4 text-center">Make a Reservation</h2>
    <form action="#" method="POST" class="mx-auto" style="max-width:600px;">
      @csrf
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="checkin">Check‑in</label>
          <input type="date" class="form-control" id="checkin" name="checkin">
        </div>
        <div class="form-group col-md-6">
          <label for="checkout">Check‑out</label>
          <input type="date" class="form-control" id="checkout" name="checkout">
        </div>
      </div>
      <div class="form-group">
        <label for="room_type">Room Type</label>
        <select class="form-control" id="room_type" name="room_type">
          <option>Standard Room</option>
          <option>Deluxe Room</option>
          <option>Executive Suite</option>
          <option>Family Room</option>
        </select>
      </div>
      <div class="form-group">
        <label for="guests">Number of Guests</label>
        <input type="number" class="form-control" id="guests" name="guests" min="1" max="10">
      </div>
      <button type="submit" class="btn btn-success btn-block">Book Now</button>
    </form>
  </div>
</div>
@endsection
