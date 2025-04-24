@extends('layouts.main')

@section('content')
<div class="content-wrapper bg-light py-5">
  <div class="container">
    <h2 class="fw-bold mb-4">Kelola Kamar</h2>

    {{-- Notifikasi --}}
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Form tambah Room --}}
    <form action="{{ route('admin.rooms.store') }}" method="POST" enctype="multipart/form-data" class="row g-3 mb-5">
      @csrf
      <div class="col-md-3">
        <input type="text" name="title" class="form-control" placeholder="Nama Kamar" required>
      </div>
      <div class="col-md-2">
        <input type="number" name="price" class="form-control" placeholder="Harga/night" required>
      </div>
      <div class="col-md-3">
        <input type="file" name="photo" class="form-control" required>
      </div>
      <div class="col-md-4">
        <textarea name="description" class="form-control" placeholder="Deskripsi Kamar"></textarea>
      </div>
      <div class="col-12">
        <button class="btn btn-primary">Tambah Kamar</button>
      </div>
    </form>

    {{-- List Rooms --}}
    <div class="row g-4">
      @foreach($rooms as $room)
        <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
          <div class="card shadow-sm w-100">
            <img src="{{ asset('storage/'.$room->photo_path) }}" class="card-img-top" alt="{{ $room->title }}" style="height:200px;object-fit:cover;">
            <div class="card-body d-flex flex-column">
              <h5 class="card-title">{{ $room->title }}</h5>
              <p class="card-text text-muted">Rp {{ number_format($room->price,0,',','.') }} / night</p>
              <p class="card-text">{{ $room->description }}</p>
              <div class="mt-auto d-flex gap-2">
                {{-- Edit trigger modal --}}
                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editRoomModal{{ $room->id }}">Edit</button>
                <form action="{{ route('admin.rooms.destroy', $room) }}" method="POST">
                  @csrf @method('DELETE')
                  <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus kamar ini?')">Hapus</button>
                </form>
              </div>
            </div>
          </div>

          {{-- Modal Edit Room --}}
          <div class="modal fade" id="editRoomModal{{ $room->id }}" tabindex="-1">
            <div class="modal-dialog">
              <form action="{{ route('admin.rooms.update', $room) }}" method="POST" enctype="multipart/form-data" class="modal-content">
                @csrf @method('PUT')
                <div class="modal-header">
                  <h5 class="modal-title">Edit Kamar</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row g-3">
                  <div class="col-12">
                    <input name="title" value="{{ $room->title }}" class="form-control" required>
                  </div>
                  <div class="col-6">
                    <input name="price" type="number" value="{{ $room->price }}" class="form-control" required>
                  </div>
                  <div class="col-6">
                    <input name="photo" type="file" class="form-control">
                  </div>
                  <div class="col-12">
                    <textarea name="description" class="form-control" rows="3">{{ $room->description }}</textarea>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary">Simpan</button>
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
