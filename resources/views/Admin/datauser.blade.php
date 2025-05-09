@extends('layouts.main')

@section('content')
<style>
  body {
    background: linear-gradient(to right, #e0eafc, #cfdef3);
    min-height: 100vh;
  }
  .form-card {
    border-radius: 15px;
    background: #fff;
  }
  .input-group-text {
    background-color: #0d6efd;
    color: white;
    border: none;
  }
  .btn-primary {
    background: linear-gradient(45deg, #007bff, #00c6ff);
    border: none;
    transition: background 0.3s ease;
  }
  .btn-primary:hover {
    background: linear-gradient(45deg, #0056b3, #00a6dd);
  }

  /* Overlay Loading */
  .loading-overlay {
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(255, 255, 255, 0.9);
    z-index: 9999;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    display: none;
  }
  .spinner {
    width: 3rem;
    height: 3rem;
    border: 5px solid #0d6efd;
    border-top-color: transparent;
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
    margin-bottom: 15px;
  }
  @keyframes spin {
    to { transform: rotate(360deg); }
  }
  .loading-text {
    font-size: 1.2rem;
    color: #0d6efd;
    font-weight: bold;
    letter-spacing: 1px;
  }
</style>

{{-- Fullscreen Loading --}}
<div class="loading-overlay" id="loadingOverlay">
  <div class="spinner"></div>
  <div class="loading-text">Loading...</div>
</div>

<div class="container py-5">
  <div class="card shadow-lg">
    <div class="card-body">
      <h2 class="card-title text-center mb-5">Tambah Data Reservasi</h2>

      <div class="text-center mb-4">
        <button class="btn btn-success btn-lg" id="showFormBtn">
          <i class="bi bi-person-plus-fill"></i> Tambah Reservasi
        </button>
      </div>

      {{-- Notifikasi --}}
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif
      @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
      @endif
      @if($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach($errors->all() as $err)
              <li>{{ $err }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form id="reservasiForm" action="{{ route('reservasi.store') }}" method="POST" style="display: none;">
        @csrf
        <div class="row g-3">
          <!-- Form Input Reservasi -->
          @foreach ([
            ['name', 'Full Name', 'person-fill'],
            ['nik', 'Identity Number(KTP)', 'card-text'],
            ['address', 'Address', 'geo-alt-fill'],
          ] as [$name, $label, $icon])
          <div class="col-md-4">
            <div class="card form-card p-3">
              <label class="form-label">{{ $label }}</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-{{ $icon }}"></i></span>
                <input type="text" name="{{ $name }}" value="{{ old($name) }}" class="form-control" placeholder="{{ $label }}" required>
              </div>
            </div>
          </div>
          @endforeach

          <div class="col-md-4">
            <div class="card form-card p-3">
              <label class="form-label">Status</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-heart-fill"></i></span>
                <select name="status" class="form-select" required>
                  <option value="">Select Status</option>
                  <option value="Menikah" {{ old('status')=='Menikah' ? 'selected' : '' }}>Married</option>
                  <option value="Belum Menikah" {{ old('status')=='Belum Menikah' ? 'selected' : '' }}>Not Married</option>
                </select>
              </div>
            </div>
          </div>

          @foreach ([
            ['checkin', 'Check-In', 'calendar-check-fill'],
            ['checkout', 'Check-Out', 'calendar-x-fill']
          ] as [$name, $label, $icon])
          <div class="col-md-4">
            <div class="card form-card p-3">
              <label class="form-label">{{ $label }}</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-{{ $icon }}"></i></span>
                <input type="date" name="{{ $name }}" value="{{ old($name) }}" class="form-control" required>
              </div>
            </div>
          </div>
          @endforeach
        </div>

        <div class="text-center mt-5">
          <button class="btn btn-primary">Simpan Reservasi</button>
        </div>
      </form>
    </div>
  </div>

  {{-- Tabel Data --}}
  <div class="card shadow-lg mt-5">
    <div class="card-body">
      <div style="display: flex; justify-content: space-between; align-items: center">
        <h3 class="card-title mb-4">List Data Reservasi</h3>
        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exportModal">Export</button>
      </div>

      <div class="table-responsive mt-3">
        <table class="table table-hover table-bordered">
          <thead class="table-primary">
            <tr>
              <th>Full Name</th>
              <th>Identity Number(KTP)</th>
              <th>Address</th>
              <th>Status</th>
              <th>Check-in</th>
              <th>Check-out</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($reservasis as $reservasi)
              <tr>
                <td>{{ $reservasi->name }}</td>
                <td>{{ $reservasi->nik ? null : 'Belum di set' }}</td>
                <td>{{ $reservasi->address ? null : 'Belum di set' }}</td>
                <td>{{ $reservasi->status ? null : 'Belum di set' }}</td>
                <td>{{ $reservasi->checkin }}</td>
                <td>{{ $reservasi->checkout }}</td>
                <td>
                  <a href="{{ route('reservasi.edit', $reservasi->id) }}" class="btn btn-sm btn-warning">Edit</a>
                  <form action="{{ route('reservasi.destroy', $reservasi->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

{{-- Bootstrap Icons --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

{{-- Script --}}
<script>
  const form = document.getElementById('reservasiForm');
  const loadingOverlay = document.getElementById('loadingOverlay');
  const showFormBtn = document.getElementById('showFormBtn');

  form.addEventListener('submit', function () {
    loadingOverlay.style.display = 'flex';
  });

  showFormBtn.addEventListener('click', function () {
    form.style.display = 'block';
    showFormBtn.style.display = 'none';
  });
</script>

{{-- Modal Export --}}
<div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exportModalLabel">Export Berdasarkan Rentang Tanggal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Tanggal Mulai</label>
          <input type="date" id="startDate" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Tanggal Akhir</label>
          <input type="date" id="endDate" class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" onclick="handleExport()">Export</button>
      </div>
    </div>
  </div>
</div>
@endsection
