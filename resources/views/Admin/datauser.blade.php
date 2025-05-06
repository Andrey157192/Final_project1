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
      <h2 class="card-title text-center mb-5">Tambah Data User</h2>

      <div class="text-center mb-4">
        <button class="btn btn-success btn-lg" id="showFormBtn">
          <i class="bi bi-person-plus-fill"></i> Tambah User
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

      <form id="userForm" action="{{ route('datauser.store') }}" method="POST" style="display: none;">
        @csrf
        <div class="row g-3">
          <div class="col-md-4">
            <div class="card form-card p-3">
              <label class="form-label">Full Name</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Full Name" required>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card form-card p-3">
              <label class="form-label">Identity Number(KTP)</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-card-text"></i></span>
                <input type="text" name="nik" value="{{ old('nik') }}" class="form-control" placeholder="Identity Number(KTP)" required>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card form-card p-3">
              <label class="form-label">Address</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-geo-alt-fill"></i></span>
                <input type="text" name="address" value="{{ old('address') }}" class="form-control" placeholder="Address" required>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card form-card p-3">
              <label class="form-label">Status</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-heart-fill"></i></span>
                <select name="status" class="form-select" required>
                  <option value="">Select Status</option>
                  <option value="Menikah" {{ old('status')=='Menikah' ? 'selected' : '' }}>Merried</option>
                  <option value="Belum Menikah" {{ old('status')=='Belum Menikah' ? 'selected' : '' }}>Not Married</option>
                </select> 
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card form-card p-3">
              <label class="form-label">Check-In</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-calendar-check-fill"></i></span>
                <input type="date" name="checkin" value="{{ old('checkin') }}" class="form-control" required>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card form-card p-3">
              <label class="form-label">Check-Out</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-calendar-x-fill"></i></span>
                <input type="date" name="checkout" value="{{ old('checkout') }}" class="form-control" required>
              </div>
            </div>
          </div>
        </div>

        <div class="text-center mt-5">
          <button id="submitBtn" type="submit" class="btn btn-primary btn-lg">Tambah User</button>
        </div>
      </form>
    </div>
  </div>

  {{-- Tabel Data --}}
  <div class="card shadow-lg mt-5">
    <div class="card-body">
      <h3 class="card-title mb-4">List Data User</h3>
      <div class="d-flex justify-content-end mb-3">
  
</div>

      <div class="table-responsive">
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
            @foreach ($users as $user)
              <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->nik }}</td>
                <td>{{ $user->address }}</td>
                <td>{{ $user->status }}</td>
                <td>{{ $user->checkin }}</td>
                <td>{{ $user->checkout }}</td>
                <td>
                  <a href="{{ route('datauser.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                  <form action="{{ route('datauser.destroy', $user->id) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus user ini?')">Hapus</button>
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

{{-- Script untuk loading dan toggle form --}}
<script>
  const form = document.getElementById('userForm');
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

@endsection
