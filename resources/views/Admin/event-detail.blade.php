@extends('layouts.main')

@section('content')
<div class="content-wrapper py-5">
  <div class="container">
    <a href="{{ route('events.index') }}" class="btn btn-secondary mb-3">← Kembali</a>
    <div class="card">
      <img src="{{ asset('storage/'.$event->image_path) }}" class="card-img-top" style="height:300px; object-fit:cover;">
      <div class="card-body">
        <h3>{{ $event->title }}</h3>
        <p class="text-muted">
          {{ $event->start_date->format('d M Y') }}
          @if($event->start_date != $event->end_date)
            – {{ $event->end_date->format('d M Y') }}
          @endif
        </p>
        <hr>
        <p>{{ $event->description }}</p>
      </div>
    </div>
  </div>
</div>
@endsection
