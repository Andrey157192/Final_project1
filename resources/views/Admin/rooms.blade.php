@extends('layouts.main')

@section('content')
<div class="content-wrapper">
    <div class="container mt-4">
        <h2 class="mb-4 text-center">Available Rooms</h2>
        <div class="row">

            {{-- Room 1 --}}
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <img src="{{ asset('assets/images/rooms/deluxe.jpg') }}"
                         class="card-img-top"
                         alt="Deluxe Room">
                    <div class="card-body">
                        <h5 class="card-title">Deluxe Room</h5>
                        <p class="card-text">Price: Rp 850.000 / night</p>
                    </div>
                </div>
            </div>

            {{-- Room 2 --}}
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <img src="{{ asset('assets/images/rooms/standard.jpg') }}"
                         class="card-img-top"
                         alt="Standard Room">
                    <div class="card-body">
                        <h5 class="card-title">Standard Room</h5>
                        <p class="card-text">Price: Rp 650.000 / night</p>
                    </div>
                </div>
            </div>

            {{-- Room 3 --}}
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <img src="{{ asset('assets/images/rooms/Executive Suite.jpg') }}"
                         class="card-img-top"
                         alt="Executive Suite">
                    <div class="card-body">
                        <h5 class="card-title">Executive Suite</h5>
                        <p class="card-text">Price: Rp 1.200.000 / night</p>
                    </div>
                </div>
            </div>

            {{-- Room 4 --}}
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <img src="{{ asset('assets/images/rooms/ocean.jpg') }}"
                         class="card-img-top"
                         alt="Ocean View Room">
                    <div class="card-body">
                        <h5 class="card-title">Ocean View Room</h5>
                        <p class="card-text">Price: Rp 1.50.000 / night</p>
                    </div>
                </div>
            </div>

            {{-- Room 5 --}}
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <img src="{{ asset('assets/images/rooms/Presidential Suite.jpg') }}"
                         class="card-img-top"
                         alt="Presidential Suite">
                    <div class="card-body">
                        <h5 class="card-title">Presidential Suite</h5>
                        <p class="card-text">Price: Rp 3.000.000 / night</p>
                    </div>
                </div>
            </div>

            {{-- Room 6 --}}
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <img src="{{ asset('assets/images/rooms/family.jpg') }}"
                         class="card-img-top"
                         alt="Family Room">
                    <div class="card-body">
                        <h5 class="card-title">Family Room</h5>
                        <p class="card-text">Price: Rp 950.000 / night</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
