<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Raha Tele</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/logo-no-bg.png') }}" type="image/x-icon">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>

    @php
    $isSpecialRoute = Request::is(['subscribe', 'login', 'register', 'password','password/*','portal', 'portal/*']);
    $portalRoute = Request::is(['portal', 'portal/*']);
    @endphp

    @if($isSpecialRoute)

    <section class="subscription-section py-2">
        <div class="container" style="min-height: 100vh; padding-bottom: 80px;">
            <!-- Fixed Top Navbar -->
            <div class="mb-2 fixed-top bg-light" style="z-index: 1000;">
                <div class="container d-flex justify-content-between align-items-center py-2">
                    <a href="/" class="back-button d-inline-flex align-items-center text-decoration-none text-dark">
                        <i class="fas fa-arrow-left me-2"></i> Website
                    </a>
                    <span>
                        <img src="{{ asset('assets/images/logo-no-bg.png') }}" alt="Company Logo"
                            class="company-logo img-fluid" style="max-width: 60px;">
                    </span>
                    <!-- Hamburger Icon (Bars) -->
                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>

            <!-- Offcanvas Side Navigation -->
            <div class="offcanvas offcanvas-start main-bg" tabindex="-1" id="offcanvasMenu"
                aria-labelledby="offcanvasMenuLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasMenuLabel">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="nav flex-column">
                        @foreach ($menuLinks as $menuLink)
                        <li class="nav-item">
                            <a href="{{ route($menuLink['route']) }}" class="nav-link text-dark"
                                onclick="{{ $menuLink['onclick'] ?? '' }}">
                                <i class="{{ $menuLink['icon'] }} me-2"></i> {{ $menuLink['name'] }}
                            </a>
                            {!! $menuLink['form'] ?? '' !!}
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Main Content Section -->
            <main class="main-content" style="margin-top: 100px;">
                @yield('content')
            </main>
        </div>

        <!-- Fixed Bottom Navigation -->
        <div class="text-center fixed-bottom bg-light py-2" style="z-index: 1000;">
            <div class="container">
                @if ($portalRoute)
                <div class="d-flex justify-content-between align-items-center">
                    @foreach ($menuLinks as $menuLink)
                    @if ($menuLink['route'] !== 'logout')
                    <!-- Corrected comparison -->
                    <a href="{{ route($menuLink['route']) }}" class="text-decoration-none text-dark">
                        <div class="nav-item text-center">
                            <i class="{{ $menuLink['icon'] }} fa-lg"></i>
                            <p class="small m-0">{{ $menuLink['name'] }}</p>
                        </div>
                    </a>
                    @endif
                    @endforeach
                </div>
                @else
                <p class="small text-muted m-0">&copy; 2024 Raha Tele. All rights reserved.</p>
                @endif
            </div>
        </div>
    </section>

    @else
    <!-- ================ Header ================ -->
    @include('layouts.partials.header')
    <!-- ================ Header end ================ -->
    @yield('content')
    <!-- ================ Footer area ================ -->
    @include('layouts.partials.footer')
    <!-- ================ Footer area end ================ -->
    @endif

    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
        <!-- CSRF Token -->
    </form>

    <!-- jQuery -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    @yield('scripts')
    @stack('scripts')

</body>

</html>