@extends('layouts.main')

@section('content')
<div class="content-wrapper py-5 bg-light">
  <div class="container">
    <h2 class="mb-4">Manajemen Ulasan</h2>

    {{-- Notifikasi --}}
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- List Ulasan --}}
    @forelse($ratings as $rating)
      <div class="border p-3 rounded mb-3 shadow-sm">
        <p><strong>Nama:</strong> {{ $rating->user->name ?? 'Anonim' }}</p>
        <p><strong>Rating:</strong> 
          @for($i = 1; $i <= 5; $i++)
            <i class="fas fa-star {{ $i <= $rating->rating ? 'text-warning' : 'text-muted' }}"></i>
          @endfor
        </p>
        <p><strong>Ulasan:</strong> {{ $rating->comment }}</p>
        <p><strong>Status:</strong>
          @if($rating->approved)
            <span class="text-success">Tampil</span>
          @else
            <span class="text-danger">Disembunyikan</span>
          @endif
        </p>
        <form action="{{ route('admin.ulasan.toggle', $rating->id) }}" method="POST" style="display:inline-block;">
          @csrf
          <button class="btn btn-sm {{ $rating->approved ? 'btn-warning' : 'btn-success' }}">
            {{ $rating->approved ? 'Sembunyikan' : 'Tampilkan' }}
          </button>
        </form>
      </div>
    @empty
      <div class="alert alert-info">Tidak ada ulasan yang masuk.</div>
    @endforelse
  </div>
</div>
@endsection
