@extends('layouts.app')

@section('content')

<div class="container py-5">
    <div class="row">
        <div class="col-md-3">
            @include('portal.partials.sidenav')
        </div>
        <div class="col-md-9">
            <!-- welcome -->
            @auth
            <h1>Welcome Back, {{ explode(' ', Auth::user()->name)[0] }}</h1>
            @else
            <h1>Welcome to our platform</h1>
            @endauth

            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>

            <!-- content -->
             
        </div>
    </div>
</div>

@endsection