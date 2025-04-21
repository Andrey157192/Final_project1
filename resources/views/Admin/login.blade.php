@extends('layouts.main')

@section('content')
<div class="content-wrapper">
  <div class="container mt-4">
    <h2 class="mb-4 text-center">Login</h2>
    <form action="#" method="POST" class="mx-auto" style="max-width:400px;">
      @csrf
      <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
      </div>
      <div class="form-check mb-3">
        <input type="checkbox" class="form-check-input" id="remember" name="remember">
        <label class="form-check-label" for="remember">Remember me</label>
      </div>
      <button type="submit" class="btn btn-primary btn-block">Login</button>
    </form>
  </div>
</div>
@endsection
