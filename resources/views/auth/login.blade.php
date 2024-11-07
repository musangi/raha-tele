@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-6 mt-4">

        <h4 class="text-center main-color">{{ __('Login to start your session') }}</h4>

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

        <form method="POST" action="{{ route('login') }}">
            @csrf

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

            {{-- Submit Button --}}
            <div class="d-flex justify-content-center mb-3">
                <button type="submit" class="btn btn-outline-main w-100 py-2">{{ __('Login') }}</button>
            </div>

            @if (Route::has('password.request'))
            <div class="d-flex justify-content-center">
                <a class="main-color" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            </div>
            @endif
            <p class="mt-3 text-center">
                Dont have an account?
                <a href="{{ route('register') }}" class="main-color">{{ __('Register') }}</a>
            </p>
        </form>

    </div>
</div>

@endsection