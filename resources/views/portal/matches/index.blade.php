@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center main-color mb-4">💖 Your Matches</h2>

    <!-- Liked Matches Section -->
    <h3 class="text-success font-weight-bold mb-3">
        ❤️ Liked Matches 
    </h3>

    @if ($likedMatches->isEmpty())
        <p class="text-muted text-center">You haven’t liked anyone yet. Start exploring! 🧐</p>
    @else
        <div class="row">
            @foreach ($likedMatches as $match)
                <div class="col-md-3 mb-4">
                    <div class="card shadow-lg border-0 rounded-lg text-center">
                        <!-- Profile Image -->
                        <img src="{{ $match->matchedUser->image ?? asset('assets/images/profiles/default-avatar.png') }}" 
                             class="card-img-top rounded-circle mx-auto mt-3"
                             style="width: 100px; height: 100px; object-fit: cover; border: 3px solid #28a745;" 
                             alt="Profile Image">

                        <div class="card-body">
                            <!-- Name -->
                            <h5 class="card-title font-weight-bold">{{ $match->matchedUser->name }}</h5>
                            <!-- Age -->
                            <i class="card-text text-muted">{{ $match->matchedUser->age ?? 'Age not set.' }}</i>
                            <!-- Bio -->
                            <p class="card-text text-muted">{{ $match->matchedUser->bio ?? 'No bio available.' }}</p>
                            <!-- Message Button -->
                            <a href="{{ route('messages.show', $match->matchedUser->id) }}" 
                                class="btn btn-lg d-flex align-items-center justify-content-center gap-2 py-2 px-4 text-white" 
                                style="
                                background: linear-gradient(135deg, #4A90E2, #007AFF); 
                                border-radius: 50px; 
                                box-shadow: 0 5px 15px rgba(0, 122, 255, 0.3);
                                transition: all 0.3s ease-in-out;
                                "
                                onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 8px 20px rgba(0, 122, 255, 0.4)';" 
                                onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 5px 15px rgba(0, 122, 255, 0.3)';">
                                💬 Message
                            </a>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Disliked Matches Section -->
    <h3 class="text-danger font-weight-bold mt-5 mb-3">
        ❌ Disliked Matches
    </h3>

    @if ($dislikedMatches->isEmpty())
        <p class="text-muted text-center">You haven’t disliked anyone yet. Give people a chance! 😊</p>
    @else
        <div class="row">
            @foreach ($dislikedMatches as $match)
                <div class="col-md-3 mb-4">
                    <div class="card shadow-lg border-0 rounded-lg text-center">
                        <!-- Profile Image -->
                        <img src="{{ $match->matchedUser->image ?? asset('assets/images/profiles/default-avatar.png') }}" 
                             class="card-img-top rounded-circle mx-auto mt-3"
                             style="width: 100px; height: 100px; object-fit: cover; border: 3px solid #dc3545;" 
                             alt="Profile Image">

                        <div class="card-body">
                            <!-- Name -->
                            <h5 class="card-title font-weight-bold">{{ $match->matchedUser->name }}</h5>
                            <!-- Bio -->
                            <p class="card-text text-muted">{{ $match->matchedUser->bio ?? 'No bio available.' }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div> 
@endsection
