@extends('layouts.main')

@section('content')
{{-- CSS Styles --}}
<style>
.event-card {
    position: relative;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    overflow: hidden;
    background: white;
    cursor: pointer;
}

.event-card:hover, .event-card.active {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 
                0 10px 10px -5px rgba(0, 0, 0, 0.04) !important;
    z-index: 1;
}

.event-card .image-container {
    overflow: hidden;
    border-top-left-radius: 0.5rem;
    border-top-right-radius: 0.5rem;
    position: relative;
}

.event-card .image-container::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0);
    transition: background 0.3s ease;
}

.event-card:hover .image-container::after {
    background: rgba(0, 0, 0, 0.1);
}

.event-card .card-img-top {
    transition: transform 0.5s ease;
    width: 100%;
    height: 180px;
    object-fit: cover;
}

.event-card:hover .card-img-top {
    transform: scale(1.1);
}

.event-card .btn-container {
    opacity: 0;
    transform: translateY(10px);
    transition: all 0.3s ease;
}

.event-card:hover .btn-container {
    opacity: 1;
    transform: translateY(0);
}
</style>

<div class="content-wrapper bg-light py-5">
  <div class="container">

    {{-- Notifikasi --}}
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2>Kelola Events</h2>
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addEventModal">
        + Add event
      </button>
    </div>

    {{-- Modal Tambah Event --}}
<div class="modal fade" id="addEventModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog">
    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data" class="modal-content">
      @csrf
      <div class="modal-header">
  <h5 class="modal-title">Tambah Event</h5>
  <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close" style="font-size: 1.5rem;">×</button>
</div>

      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Judul Event</label>
          <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Deskripsi</label>
          <textarea name="description" class="form-control" rows="3" required></textarea>
        </div>
        <div class="row g-3 mb-3">
          <div class="col">
            <label class="form-label">Mulai</label>
            <input type="date" name="start_date" class="form-control" required>
          </div>
          <div class="col">
            <label class="form-label">Selesai</label>
            <input type="date" name="end_date" class="form-control" required>
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label">Gambar</label>
          <input type="file" name="image" class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>


    {{-- Daftar Events --}}
    <div class="row g-4">
      @foreach($events as $event)
        <div class="col-md-3">
          <div class="card event-card border-0 shadow-sm rounded-4" onclick="toggleEventCard(this)">
            <div class="image-container">
              <img src="{{ asset('storage/'.$event->image_path) }}"
                   class="card-img-top"
                   alt="{{ $event->title }}">
            </div>
            <div class="card-body">
              <p class="text-muted mb-1">
                {{ $event->start_date->format('d M, Y') }}
                @if($event->start_date != $event->end_date)
                  – {{ $event->end_date->format('d M, Y') }}
                @endif
              </p>
              <h5 class="card-title">{{ $event->title }}</h5>
              <div class="btn-container d-flex gap-2 mt-3">
                <a href="{{ route('events.show', $event) }}" class="btn btn-sm btn-info" onclick="event.stopPropagation()">Detail</a>
                <button data-bs-toggle="modal"
                        data-bs-target="#editEventModal{{ $event->id }}"
                        class="btn btn-sm btn-warning"
                        onclick="event.stopPropagation()">Edit</button>
                <form action="{{ route('events.destroy', $event) }}" method="POST" class="d-inline">
                  @csrf @method('DELETE')
                  <button class="btn btn-sm btn-danger"
                          onclick="event.stopPropagation(); return confirm('Hapus event ini?')">
                    Delete
                  </button>
                </form>
              </div>
            </div>
          </div>

          {{-- Modal Edit Event --}}
          <div class="modal fade" id="editEventModal{{ $event->id }}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog">
    <form action="{{ route('events.update', $event) }}" method="POST" enctype="multipart/form-data" class="modal-content">
      @csrf @method('PUT')
      <div class="modal-header">
        <h5 class="modal-title">Edit Event</h5>
        <button type="button" class="btn border-0 bg-transparent fs-3 fw-bold" data-bs-dismiss="modal" aria-label="Close">
          ×
        </button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Judul Event</label>
          <input type="text" name="title" value="{{ $event->title }}" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Deskripsi</label>
          <textarea name="description" class="form-control" rows="3" required>{{ $event->description }}</textarea>
        </div>
        <div class="row g-3 mb-3">
          <div class="col">
            <label class="form-label">Mulai</label>
            <input type="date" name="start_date" value="{{ $event->start_date->toDateString() }}" class="form-control" required>
          </div>
          <div class="col">
            <label class="form-label">Selesai</label>
            <input type="date" name="end_date" value="{{ $event->end_date->toDateString() }}" class="form-control" required>
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label">Ganti Gambar</label>
          <input type="file" name="image" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-primary">Perbarui</button>
      </div>
    </form>
  </div>
</div>

        </div>
      @endforeach
    </div>

  </div>
</div>

{{-- Script untuk event card --}}
<script>
function toggleEventCard(card) {
    // Hapus class active dari semua card
    document.querySelectorAll('.event-card').forEach(c => {
        c.classList.remove('active');
    });
    
    // Toggle class active pada card yang diklik
    card.classList.add('active');
    
    // Animasi smooth scroll ke card yang diklik
    card.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

// Prevent click on buttons from triggering card click
document.querySelectorAll('.event-card .btn-container button, .event-card .btn-container a').forEach(button => {
    button.addEventListener('click', e => e.stopPropagation());
});
</script>
@endsection
