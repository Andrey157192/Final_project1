@extends('user.layouts.main')

@section('content')
<section class="section">
    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-md-7">
                <h2 class="heading" data-aos="fade-up">Guest Reviews</h2>
                <p data-aos="fade-up" data-aos-delay="100">See what our guests have to say about their stay</p>
            </div>
        </div>

        @auth
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Share Your Experience</h3>
                        <form action="{{ route('ratings.store') }}" method="POST">
                            @csrf
                            <div class="form-group mb-4">
                                <label class="d-block text-center mb-3">Your Rating</label>
                                <div class="rating-stars text-center">
                                    @for($i = 5; $i >= 1; $i--)
                                        <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" class="d-none" required/>
                                        <label for="star{{ $i }}" class="star"><i class="fas fa-star fa-2x"></i></label>
                                    @endfor
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="comment">Your Review</label>
                                <textarea name="comment" id="comment" class="form-control" rows="4" required></textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary px-5">Submit Review</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h3 class="mb-3">Want to Share Your Experience?</h3>
                        <p class="mb-4">Please login to submit your review and rating.</p>
                        <a href="{{ route('login') }}" class="btn btn-primary px-5">Login Now</a>
                    </div>
                </div>
            </div>
        </div>
        @endauth

        <div class="row">
            @foreach($ratings as $rating)
            <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="rating-stars">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $rating->rating ? 'text-warning' : 'text-muted' }}"></i>
                                @endfor
                            </div>
                            <small class="text-muted">{{ $rating->created_at->diffForHumans() }}</small>
                        </div>
                        <p class="card-text font-italic">"{{ $rating->comment }}"</p>
                        <div class="d-flex align-items-center mt-3">
                            <img src="{{ asset('images/person_' . ($rating->user_id % 3 + 1) . '.jpg') }}" alt="User" class="rounded-circle mr-2" style="width: 40px; height: 40px; object-fit: cover;">
                            <strong>{{ $rating->user->name }}</strong>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @if($ratings->isEmpty())
        <div class="text-center">
            <p>No reviews yet. Be the first to share your experience!</p>
        </div>
        @endif
    </div>
</section>

<style>
.rating-stars {
    color: #ffc107;
}
.rating-stars label.star {
    cursor: pointer;
    padding: 0 2px;
}
.rating-stars input:checked ~ label.star,
.rating-stars label.star:hover,
.rating-stars label.star:hover ~ label.star {
    color: #ffc107;
}
.rating-stars label.star {
    color: #ddd;
}
</style>
@endsection
