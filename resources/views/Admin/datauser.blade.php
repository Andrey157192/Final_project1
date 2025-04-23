@extends('layouts.main')

@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Data User</h4>

        <form action="{{ route('datauser.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-4 mb-2">
                    <input type="text" name="name" class="form-control" placeholder="Nama" required>
                </div>
                <div class="col-md-4 mb-2">
                    <input type="text" name="nik" class="form-control" placeholder="NIK" required>
                </div>
                <div class="col-md-4 mb-2">
                    <input type="text" name="address" class="form-control" placeholder="Alamat" required>
                </div>
                <div class="col-md-4 mb-2">
                    <select name="status" class="form-control" required>
                        <option value="">Status</option>
                        <option value="Menikah">Menikah</option>
                        <option value="Belum Menikah">Belum Menikah</option>
                    </select>
                </div>
                <div class="col-md-4 mb-2">
    <label for="checkin" class="form-label">Check-in</label>
    <input type="date" name="checkin" id="checkin" class="form-control" required>
</div>
<div class="col-md-4 mb-2">
    <label for="checkout" class="form-label">Check-out</label>
    <input type="date" name="checkout" id="checkout" class="form-control" required>
</div>

                <div class="col-md-12 mb-2">
                    <button class="btn btn-primary btn-sm" type="submit">Tambah</button>
                </div>
            </div>
        </form>

        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>NIK</th>
                    <th>Alamat</th>
                    <th>Status</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Aksi</th>
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
                        <form action="{{ route('datauser.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('Hapus user ini?')" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
