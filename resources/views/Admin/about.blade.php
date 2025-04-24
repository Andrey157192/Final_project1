@extends('layouts.main')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<div class="content-wrapper bg-light py-5">
  <div class="container">

    {{-- Notifikasi --}}
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- 1) Form: Deskripsi & Sejarah & Kontak --}}
    <h4 class="mb-4 fw-bold">Edit About Us & Kontak</h4>
    <form action="{{ route('admin.about.update') }}" method="POST" class="mb-5">
      @csrf @method('PUT')
      <div class="mb-3">
        <label class="form-label">Deskripsi</label>
        <textarea name="description" class="form-control" rows="4">{{ old('description', $settings->description) }}</textarea>
      </div>
      <div class="mb-3">
        <label class="form-label">Sejarah Hotel</label>
        <textarea name="history" class="form-control" rows="4">{{ old('history', $settings->history) }}</textarea>
      </div>
      <div class="row">
        <div class="col-md-4 mb-3">
          <label class="form-label">Telepon</label>
          <input type="text" name="phone" value="{{ old('phone', $settings->phone) }}" class="form-control">
        </div>
        <div class="col-md-4 mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" value="{{ old('email', $settings->email) }}" class="form-control">
        </div>
        <div class="col-md-4 mb-3">
          <label class="form-label">Alamat</label>
          <input type="text" name="address" value="{{ old('address', $settings->address) }}" class="form-control">
        </div>
        <div class="col-md-12 mb-3">
          <label class="form-label">Link Google Maps</label>
          <input type="url" name="maps_link" value="{{ old('maps_link', $settings->maps_link) }}" class="form-control">
        </div>
      </div>
      <button class="btn btn-primary">Simpan About Us</button>
    </form>

    {{-- 2) Preview hasil tersimpan --}}
    <div class="card mb-5">
      <div class="card-body">
        <h5 class="card-title">Preview About Us</h5>
        <p><strong>Deskripsi:</strong><br>{{ $settings->description }}</p>
        <p><strong>Sejarah:</strong><br>{{ $settings->history }}</p>
        <p><strong>Telepon:</strong> {{ $settings->phone }}</p>
        <p><strong>Email:</strong> {{ $settings->email }}</p>
        <p><strong>Alamat:</strong> {{ $settings->address }}</p>
        <p><strong>Maps:</strong> <a href="{{ $settings->maps_link }}" target="_blank">Lihat di Google Maps</a></p>
      </div>
    </div>

    {{-- 3) Section Leadership --}}
    <h4 class="mb-3">Our Leadership</h4>
    <form action="{{ route('admin.leadership.store') }}" method="POST" enctype="multipart/form-data" class="row g-2 mb-4">
      @csrf
      <div class="col-md-4">
        <input name="name" class="form-control" placeholder="Nama Pemimpin" required>
      </div>
      <div class="col-md-4">
        <input name="photo" type="file" class="form-control" required>
      </div>
      <div class="col-auto">
        <button class="btn btn-success">Tambah Pemimpin</button>
      </div>
    </form>
    @foreach($leaderships as $leader)
      <div class="d-flex align-items-center mb-3">
        <img src="{{ asset('storage/'.$leader->photo_path) }}" width="60" class="rounded-circle me-3">
        <form action="{{ route('admin.leadership.update', $leader) }}" method="POST" enctype="multipart/form-data" class="d-flex w-100">
          @csrf @method('PUT')
          <input name="name" value="{{ $leader->name }}" class="form-control me-2" style="max-width:200px" required>
          <input name="photo" type="file" class="form-control me-2">
          <button class="btn btn-sm btn-primary me-1">Ubah</button>
        </form>
        <form action="{{ route('admin.leadership.destroy', $leader) }}" method="POST">
          @csrf @method('DELETE')
          <button class="btn btn-sm btn-danger">Hapus</button>
        </form>
      </div>
    @endforeach

    {{-- 4) Section Hotel Views --}}
    <h4 class="mt-5 mb-3">Hotel Views</h4>
    <form action="{{ route('admin.views.store') }}" method="POST" enctype="multipart/form-data" class="mb-4">
      @csrf
      <div class="input-group">
        <input name="photo" type="file" class="form-control" required>
        <button class="btn btn-success">Upload Foto</button>
      </div>
    </form>
    <div class="row g-3">
      @foreach($views as $view)
        <div class="col-md-3 position-relative">
          <img src="{{ asset('storage/'.$view->photo_path) }}" class="img-fluid rounded shadow-sm">
          <form action="{{ route('admin.views.destroy', $view) }}" method="POST" class="position-absolute top-0 end-0">
            @csrf @method('DELETE')
            <button class="btn btn-sm btn-danger m-1">&times;</button>
          </form>
        </div>
      @endforeach
    </div>

  </div>
</div>
@endsection
