@extends('layouts.app')

@section('content')

<div class="mt-4">
    <h2 class="text-center main-color">Your Profile</h2>

    <div class="row mt-4">
        <!-- Profile Summary Card -->
        <div class="col-md-4 mb-4">
            <div class="card shadow border-0 h-100">
                <div class="card-body text-center">
                    <img src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('assets/images/profiles/default-avatar.png') }}"
                        class="rounded-circle mb-3" width="100" alt="Profile Image">
                    <h5 class="card-title">{{ Auth::user()->name }}</h5>
                    <p class="text-muted">{{ Auth::user()->bio ?? 'Add a short bio to introduce yourself!' }}</p>
                    <p class="text-muted">{{ Auth::user()->email }}</p>
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-main btn-sm"><i class="fas fa-edit"></i> Edit Profile</a>
                </div>
            </div>
        </div>

        <!-- Profile Information Section -->
        <div class="col-md-8 mb-4">
            <div class="card shadow border-0">
                <div class="card-header border-0 main-bg text-white">
                    <h5 class="mb-0">Profile Information</h5>
                </div>
                <div class="card-body">
                    <!-- Full Name -->
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Full Name:</strong></div>
                        <div class="col-md-8">{{ Auth::user()->name }}</div>
                    </div>

                    <!-- Email Address -->
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Email Address:</strong></div>
                        <div class="col-md-8">{{ Auth::user()->email }}</div>
                    </div>

                    <!-- Phone Number -->
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Phone Number:</strong></div>
                        <div class="col-md-8">{{ Auth::user()->phone_number ?? 'Not Provided' }}</div>
                    </div>

                    <!-- Date of Birth -->
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Date of Birth:</strong></div>
                        <div class="col-md-8">{{ Auth::user()->date_of_birth ?? 'Not Provided' }}</div>
                    </div>

                    <!-- Gender -->
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Gender:</strong></div>
                        <div class="col-md-8">{{ ucfirst(Auth::user()->gender ?? 'Not Provided') }}</div>
                    </div>

                    <!-- Location -->
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Location:</strong></div>
                        <div class="col-md-8">{{ Auth::user()->location ?? 'Not Provided' }}</div>
                    </div>

                    <!-- Availability -->
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Availability:</strong></div>
                        <div class="col-md-8">{{ ucfirst(Auth::user()->availability ?? 'Not Provided') }}</div>
                    </div>

                    <!-- Hourly Rate -->
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Hourly Rate:</strong></div>
                        <div class="col-md-8">{{ Auth::user()->hourly_rate ?? 'Not Provided' }}</div>
                    </div>

                    <!-- Escort Status -->
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Escort Status:</strong></div>
                        <div class="col-md-8">{{ Auth::user()->is_escort == 1 ? 'Yes' : 'No' }}</div>
                    </div>

                    <!-- Verification Status -->
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Verification Status:</strong></div>
                        <div class="col-md-8">{{ Auth::user()->is_verified == 1 ? 'Verified' : 'Not Verified' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection