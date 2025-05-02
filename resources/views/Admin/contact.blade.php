@extends('layouts.main')

@section('content')
<div class="content-wrapper">
  <div class="container mt-4">
    <h2 class="mb-4 text-center">Contact Us</h2>
    <form action="#" method="POST" class="mx-auto" style="max-width:600px;">
      @csrf
      
      {{-- Name --}}
      <div class="form-group mb-3">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Your name">
      </div>

      {{-- Phone --}}
      <div class="form-group mb-3">
        <label for="phone">Phone</label>
        <input type="text" class="form-control" id="phone" name="phone" placeholder="Your phone number">
      </div>

      {{-- Email --}}
      <div class="form-group mb-3">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com">
      </div>

      {{-- Message --}}
      <div class="form-group mb-4">
        <label for="message">Message</label>
        <textarea class="form-control" id="message" name="message" rows="4" placeholder="Your message…"></textarea>
      </div>

      {{-- Submit Button --}}
      <button type="submit" class="btn btn-primary w-100">Send Message</button>
    </form>
  </div>
</div>
@endsection
