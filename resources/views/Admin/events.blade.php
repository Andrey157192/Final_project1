@extends('layouts.main')

@section('content')
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
    <div class="modal fade" id="addEventModal" tabindex="-1">
      <div class="modal-dialog">
        <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data" class="modal-content">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title">Tambah Event</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
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
          <div class="card shadow-sm rounded-4">
            <img src="{{ asset('storage/'.$event->image_path) }}"
                 class="card-img-top rounded-top-4"
                 style="height:180px; object-fit:cover;">
            <div class="card-body">
              <p class="text-muted mb-1">
                {{ $event->start_date->format('d M, Y') }}
                @if($event->start_date != $event->end_date)
                  – {{ $event->end_date->format('d M, Y') }}
                @endif
              </p>
              <h5 class="card-title">{{ $event->title }}</h5>
              <div class="d-flex gap-2 mt-3">
                <a href="{{ route('events.show', $event) }}" class="btn btn-sm btn-info">Detail</a>
                <button data-bs-toggle="modal"
                        data-bs-target="#editEventModal{{ $event->id }}"
                        class="btn btn-sm btn-warning">Edit</button>
                <form action="{{ route('events.destroy', $event) }}" method="POST" class="d-inline">
                  @csrf @method('DELETE')
                  <button class="btn btn-sm btn-danger"
                          onclick="return confirm('Hapus event ini?')">
                    Delete
                  </button>
                </form>
              </div>
            </div>
          </div>

          {{-- Modal Edit Event --}}
          <div class="modal fade" id="editEventModal{{ $event->id }}" tabindex="-1">
            <div class="modal-dialog">
              <form action="{{ route('events.update', $event) }}" method="POST" enctype="multipart/form-data" class="modal-content">
                @csrf @method('PUT')
                <div class="modal-header">
                  <h5 class="modal-title">Edit Event</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
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
@endsection
