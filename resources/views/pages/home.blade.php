@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<section class="hero-section text-center py-5">
    <div class="container">
        <h1 class="display-4 main-color font-weight-bold">Find Your Match on Raha Tele</h1>
        <p class="lead mb-4">The trusted platform for connecting singles in Kenya. Discover the possibilities today!</p>
        <a href="{{ route('subscribe.index') }}" class="btn-solid-main text-white mt-4 px-4 rounded-pill shadow">
            Join Now forFree
        </a>
    </div>
</section>

<!-- Key Features Section -->
<section class="features-section py-5 bg-light">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="feature-card p-4 shadow-lg rounded h-100">
                    <i class="fas fa-heart fa-3x main-color mb-3"></i>
                    <h3 class="font-weight-bold">Trusted & Reliable</h3>
                    <p>Voted #1 dating app in Kenya in 2023.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-card p-4 shadow-lg rounded h-100">
                    <i class="fas fa-clock fa-3x main-color mb-3"></i>
                    <h3 class="font-weight-bold">Find Love Quickly</h3>
                    <p>Every 14 minutes, someone finds love on Raha Tele.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-card p-4 shadow-lg rounded h-100">
                    <i class="fas fa-gem fa-3x main-color mb-3"></i>
                    <h3 class="font-weight-bold">Quality Matches</h3>
                    <p>Meet singles who are serious about dating and relationships.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Success Stories Section -->
<section class="success-stories py-5">
    <div class="container text-center">
        <h2 class="mb-4 font-weight-bold">Real Success Stories</h2>
        <p class="text-muted mb-5">Join millions who have found love on Raha Tele.</p>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card story-card border-0 shadow-lg rounded-lg">
                    <div class="story-image-container">
                        <img src="{{ asset('assets/images/others/10.jpg') }}" class="story-image" alt="Love Story 1">
                    </div>
                    <div class="card-body">
                        <h5 class="font-weight-bold">Over 2 million found love</h5>
                        <p>... could you be next?</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card story-card border-0 shadow-lg rounded-lg">
                    <div class="story-image-container">
                        <img src="{{ asset('assets/images/others/1.jpg') }}" class="story-image" alt="Love Story 2">
                    </div>
                    <div class="card-body">
                        <h5 class="font-weight-bold">Meet your perfect match</h5>
                        <p>... find yours today!</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card story-card border-0 shadow-lg rounded-lg">
                    <div class="story-image-container">
                        <img src="{{ asset('assets/images/others/6.jpg') }}" class="story-image" alt="Love Story 3">
                    </div>
                    <div class="card-body">
                        <h5 class="font-weight-bold">Find real love</h5>
                        <p>... your journey starts here!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Escorts Section -->
<section class="escorts-section bg-light py-5">
    <div class="container">
        <h2 class="text-center mb-5 main-color font-weight-bold">Featured Escorts</h2>

        @foreach ($users as $index => $user)
        @if ($index % 12 == 0)
        <div class="row profile-group" data-group="{{ intval($index / 12) }}"
            style="{{ $index == 0 ? '' : 'display: none;' }}">
            @endif

            <div class="col-6 col-md-3 mb-4">
                <div class="escort-card p-3 shadow-lg text-center rounded-4 bg-white">
                    <img src="{{ $user->profile_image ?? asset('assets/images/profiles/default-avatar.png') }}"
                        alt="Escort Profile" class="rounded-circle mb-3" style="max-height: 100px; max-width: 100px;">
                    <h5 class="font-weight-bold"><a href="">{{ ucwords($user->name) }}</a></h5>
                    <p class="text-muted m-0">Age: {{ $user->age ?? 'N/A' }} Years</p>
                    <p class="text-muted">
                        <i class="fas fa-map-marker-alt main-color"></i> {{ $user->location }}
                    </p>
                    <a href="{{ route('subscribe.index') }}"
                        class="btn btn-sm btn-outline-main w-100 rounded-4 shadow-sm">
                        <i class="fas fa-phone"></i> WhatsApp/Call
                    </a>
                </div>
            </div>

            @if (($index + 1) % 12 == 0 || $index == count($users) - 1)
        </div> <!-- Close profile-group -->
        @endif
        @endforeach

        <!-- Pagination Controls -->
        <div class="pagination-controls text-center">
            <div id="page-numbers" class="mt-4">
                @for ($i = 0; $i < ceil(count($users) / 12); $i++) <button
                    class="btn btn-outline-main page-btn shadow-sm" data-group="{{ $i }}">
                    {{ $i + 1 }}
                    </button>
                    @endfor
            </div>
        </div>
    </div>
</section>

<!-- Support Section -->
<section class="support-section main-bg text-white py-5 text-center">
    <div class="container">
        <h2 class="font-weight-bold">We’re Here For You</h2>
        <p class="lead mb-4">From profile tips to sharing your success story, we're here to support you 24/7, 365 days a
            year.</p>
        <a href="#" class="btn btn-light btn-lg px-5 py-2 rounded-pill shadow">Contact Us</a>
    </div>
</section>

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('.page-btn').on('click', function() {
        const group = $(this).data('group');

        // Hide all profile groups
        $('.profile-group').hide();

        // Show the selected profile group
        $('.profile-group[data-group="' + group + '"]').show();
    });
});
</script>
@endpush