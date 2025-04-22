@extends('layouts.main')

@section('content')
<div class="content-wrapper py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-4">Berikan Penilaian Anda</h2>
        <p class="text-center text-muted mb-5">Kami menghargai ulasan Anda untuk meningkatkan pelayanan kami.</p>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{ route('rating.store') }}" method="POST" class="bg-white p-4 rounded shadow-sm">
                    @csrf

                    {{-- Rating Bintang --}}
                    <div class="form-group mb-4">
                        <label class="form-label fw-semibold">Rating:</label>
                        <div class="d-flex gap-2">
                            @for ($i = 1; $i <= 5; $i++)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="rating" id="rating{{ $i }}" value="{{ $i }}">
                                    <label class="form-check-label" for="rating{{ $i }}">
                                        <i class="bi bi-star-fill text-warning"></i> {{ $i }}
                                    </label>
                                </div>
                            @endfor
                        </div>
                    </div>

                    {{-- Ulasan --}}
                    <div class="form-group mb-4">
                        <label for="review" class="form-label fw-semibold">Deskripsi Ulasan:</label>
                        <textarea class="form-control" name="review" id="review" rows="4" placeholder="Tulis ulasan Anda di sini..."></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Kirim Ulasan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
