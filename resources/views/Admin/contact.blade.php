@extends('layouts.main')

@section('content')
<div class="content-wrapper">
  <div class="container mt-4">
    <h2 class="mb-4 text-center">Contact Us</h2>
    <form action="#" method="POST" class="mx-auto" style="max-width:600px;">
      @csrf
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Your name">
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com">
      </div>
      <div class="form-group">
        <label for="message">Message</label>
        <textarea class="form-control" id="message" name="message" rows="4" placeholder="Your message…"></textarea>
      </div>
      <button type="submit" class="btn btn-primary btn-block">Send Message</button>
    </form>
  </div>
</div>
@endsection
