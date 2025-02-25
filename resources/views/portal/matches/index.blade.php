@extends('layouts.app')

@section('content')
<div class="container">

    <h2>Your Matches</h2>
    <h3>Liked Matches ❤️</h3>
    <div class="row">
        @foreach ($likedMatches as $match)
            <div class="col-md-3 mb-4">
                <div class="card">
                    <img src="{{$match->matchedUser->image}}" alt="" class="card-img-top">
                    <div class="card-body text-center">
                        <h5 class="card-title">
                            {{$match->matchedUser->name}}
                        </h5>
                        <p class="card-text">
                            {{$match->matchedUser->bio}}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <h3>Disliked Matches ❌</h3>
    <div class="row">
        @foreach ($dislikedMatches as $match)
            <div class="col-md-3 mb-4">
                <div class="card">
                    <img src="{{$match->matchedUser->image}}" alt="" class="card-img-top">
                    <div class="card-body text-center">
                        <h5 class="card-title">
                            {{$match->matchedUser->name}}
                        </h5>
                        <p class="card-text">
                            {{$match->matchedUser->bio}}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div> 

@endsection