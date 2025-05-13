@extends('layouts.main')

@section('content')
<div class="container py-5">
  <div class="card shadow-lg">
    <div class="card-body">
      <h2 class="card-title text-center mb-5">Edit Data Reservasi</h2>

      <form action="{{ route('reservasi.update', $reservasi->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="row g-3">          <!-- INPUT NAMA CUSTOMER -->
          <div class="col-md-6">
            <div class="card form-card p-3">              <label class="form-label">Nama Customer</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                <input type="text" name="nama_customer" class="form-control" value="{{ $reservasi->nama_customer }}" required>
              </div>
            </div>
          </div>

          <!-- INPUT NIK -->
          <div class="col-md-6">
            <div class="card form-card p-3">              <label class="form-label">Identity Number (KTP)</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-card-text"></i></span>
                <input type="text" name="nik" class="form-control" value="{{ $reservasi->nik }}" placeholder="Masukkan NIK (opsional)">
              </div>
            </div>
          </div>

          <!-- INPUT ADDRESS -->
          <div class="col-md-6">
            <div class="card form-card p-3">
              <label class="form-label">Address</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-house-door"></i></span>
                <input type="text" name="address" class="form-control" value="{{ $reservasi->address }}" placeholder="Masukkan alamat (opsional)">
              </div>
            </div>
          </div>

          <!-- INPUT STATUS -->
          <div class="col-md-6">
            <div class="card form-card p-3">
              <label class="form-label">Status</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                <select name="status" class="form-select">
                  <option value="Single" {{ $reservasi->status == 'Single' ? 'selected' : '' }}>Single</option>
                  <option value="Married" {{ $reservasi->status == 'Married' ? 'selected' : '' }}>Married</option>
                </select>
              </div>
            </div>
          </div>

          <!-- PILIH KAMAR -->
          <div class="col-md-6">
            <div class="card form-card p-3">
              <label class="form-label">Kamar</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-door-open-fill"></i></span>
                <select name="id_rooms" class="form-select" required>
                  <option value="">-- Pilih Kamar --</option>
                  @foreach($rooms as $room)
                    <option value="{{ $room->id }}" {{ $reservasi->id_rooms == $room->id ? 'selected' : '' }}>
                      {{ $room->title }} - Rp{{ number_format($room->price) }}/malam
                    </option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>

          <!-- TANGGAL CHECK-IN -->
          <div class="col-md-6">
            <div class="card form-card p-3">
              <label class="form-label">Tanggal Check-In</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-calendar-check-fill"></i></span>
                <input type="date" name="checkIn_date" value="{{ $reservasi->checkIn_date }}" class="form-control" required>
              </div>
            </div>
          </div>

          <!-- TANGGAL CHECK-OUT -->
          <div class="col-md-6">
            <div class="card form-card p-3">
              <label class="form-label">Tanggal Check-Out</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-calendar-x-fill"></i></span>
                <input type="date" name="checkOut_date" value="{{ $reservasi->checkOut_date }}" class="form-control" required>
              </div>
            </div>
          </div>
        </div>

        <div class="text-center mt-5">
          <button type="submit" class="btn btn-primary">Update Reservasi</button>
          <a href="{{ route('reservasi.index') }}" class="btn btn-secondary ms-2">Kembali</a>
        </div>
      </form>

    </div>
  </div>
</div>

{{-- Bootstrap Icons --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
@endsection
