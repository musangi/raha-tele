@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @foreach($matches as $match)
            <div class="col-md-3 mb-4">
                <div class="card">
                    <img src="{{ $match->image }}" class="card-img-top" alt="{{ $match->name }}">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $match->name }}</h5>
                        <p class="card-text">{{ $match->bio }}</p>
                        <div class="d-flex justify-content-around">
                            <form action="{{ route('match.like', $match->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">👍</button>
                            </form>
                            <form action="{{ route('match.dislike', $match->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">❌</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
