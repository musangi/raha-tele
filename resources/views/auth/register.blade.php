@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-6 mt-4">

        <h4 class="text-center main-color">{{ __('Join the team') }}</h4>

        {{-- Display subscription info if available --}}
        @if(session('subscription'))
        <div class="alert alert-info">
            <p class="m-0">{{ __('You are about to register for the following subscription:') }}</p>
            <ul class="list-group">
                <li class="list-group-item p-0 border-0 bg-transparent">
                    <strong>{{ __('Price:') }}</strong>
                    Ksh {{ number_format(session('subscription.price'), 2) }}
                    <strong>{{ __('For a duration of:') }}</strong>
                    {{ session('subscription.duration') }}
                </li>
            </ul>
        </div>

        {{-- Display session messages --}}
        @if(session('status'))
        <div class="alert alert-success">
            <p class="m-0">{{ session('status') }}</p>
        </div>
        @endif

        @if(session('success'))
        <div class="alert alert-success">
            <p class="m-0">{{ session('success') }}</p>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger">
            <p class="m-0">{{ session('error') }}</p>
        </div>
        @endif

        {{-- Registration Form --}}
        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Name Field --}}
            <div class="mb-3">
                <label for="name" class="form-label">{{ __('Name') }}</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name') }}" required autocomplete="name" autofocus
                    placeholder="{{ __('Enter your full name') }}">

                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Email Field --}}
            <div class="mb-3">
                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email"
                    placeholder="{{ __('Enter your email address') }}">

                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Password Field --}}
            <div class="mb-3">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="new-password"
                    placeholder="{{ __('Enter a strong password') }}">

                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Confirm Password Field --}}
            <div class="mb-3">
                <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                    autocomplete="new-password" placeholder="{{ __('Confirm your password') }}">
            </div>

            {{-- Submit Button --}}
            <div class="d-flex justify-content-center mb-3">
                <button type="submit" class="btn btn-outline-main w-100 py-2">{{ __('Register') }}</button>
            </div>

        </form>

        @else

        <div class="alert alert-info">
            <h5>You have not chosen any subscription package!</h5>
            <p>Kindly chose subscription package to be able to continue with account registration</p>
        </div>
        <div class="d-flex justify-content-center">
            <a href="{{ route('subscribe.index') }}"
                class="btn btn-outline-main w-100 py-2">{{ __('View subscription packages') }}</a>
        </div>

        @endif

        <p class="text-center my-2">Or</p>
        <div class="d-flex justify-content-center">
            <a href="{{ route('login') }}" class="btn btn-outline-main w-100 py-2">{{ __('Login') }}</a>
        </div>

    </div>
</div>

@endsection