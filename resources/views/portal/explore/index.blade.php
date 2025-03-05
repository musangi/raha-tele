@extends('layouts.app')

@section('content')
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="container mt-4">
    <h2 class="text-center main-color mb-4">💘 Potential Matches for You!</h2>

    <div class="row justify-content-center">
        @foreach($potentialMatches as $match)
            <div class="col-md-4 mb-4">
                <div class="card shadow-lg border-0 rounded-lg text-center">
                    <!-- Profile Image -->
                    <img src="{{ $match->profile_image ?? asset('assets/images/profiles/default-avatar.png') }}" 
                         class="card-img-top rounded-circle mx-auto mt-3"
                         style="width: 120px; height: 120px; object-fit: cover; border: 5px solid #f8f9fa;" 
                         alt="Profile Image">

                    <div class="card-body">
                        <!-- Name -->
                        <h5 class="card-title font-weight-bold">{{ $match->name }}</h5>
                        <!-- Age -->
                        <p class="card-text text-muted">{{ $match->age ?? 'Age not set.' }}</p>

                        <!-- Bio -->
                        <p class="card-text text-muted">{{ $match->bio ?? 'No bio available.' }}</p>

                        <!-- Like & Dislike Buttons -->
                        <div class="d-flex justify-content-center gap-3">
                            <form action="{{ route('match.like', $match->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-success rounded-circle p-3 shadow-sm" title="Like">
                                    👍
                                </button>
                            </form>
                            <form action="{{ route('match.dislike', $match->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger rounded-circle p-3 shadow-sm" title="Dislike">
                                    ❌
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
 {{-- alternative UI Look
 
 @extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="text-center main-color">Potential Matches for You! 💘</h2>

    <div class="row justify-content-center">
        @foreach($potentialMatches as $match)
            <div class="col-md-4 mb-4">
                <div class="card shadow-lg border-0 text-center p-3">
                    
                    <!-- Profile Image -->
                    <img src="{{ $match->profile_image ?? asset('assets/images/profiles/default-avatar.png') }}" 
                        class="rounded-circle mx-auto d-block mt-3" 
                        width="120" height="120" 
                        alt="{{ $match->name }}'s Profile Picture">

                    <!-- Card Body -->
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">{{ $match->name }}</h5>
                        <p class="card-text text-muted">{{ $match->bio }}</p>

                        <!-- Like & Dislike Buttons -->
                        <div class="d-flex justify-content-around mt-3">
                            <form action="{{ route('match.like', $match->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success btn-lg px-4">
                                    👍 Like
                                </button>
                            </form>
                            
                            <form action="{{ route('match.dislike', $match->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-lg px-4">
                                    ❌ Dislike
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

--}}