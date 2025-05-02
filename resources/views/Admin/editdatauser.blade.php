@extends('layouts.main')

@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Edit Data User</h4>

        <form action="{{ route('datauser.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
            </div>

            <div class="form-group">
                <label>NIK</label>
                <input type="text" name="nik" class="form-control" value="{{ $user->nik }}" required>
            </div>

            <div class="form-group">
                <label>Alamat</label>
                <input type="text" name="address" class="form-control" value="{{ $user->address }}" required>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control" required>
                    <option value="Menikah" {{ $user->status == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                    <option value="Belum Menikah" {{ $user->status == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                </select>
            </div>

            <div class="form-group">
                <label>Check-in</label>
                <input type="date" name="checkin" class="form-control" value="{{ $user->checkin }}" required>
            </div>

            <div class="form-group">
                <label>Check-out</label>
                <input type="date" name="checkout" class="form-control" value="{{ $user->checkout }}" required>
            </div>

            <button class="btn btn-success mt-2" type="submit">Simpan Perubahan</button>
            <a href="{{ route('datauser.index') }}" class="btn btn-secondary mt-2">Kembali</a>
        </form>
    </div>
</div>
@endsection
