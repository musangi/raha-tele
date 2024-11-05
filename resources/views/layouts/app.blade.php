<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Raha Tele</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include Owl Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- Vite -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>

    @php
    $portalTemplate = $portalTemplate ?? 'layouts.portal.default';
    $isAuthRoute = Request::is(['login', 'register', 'password','password/*', 'otp','otp/*', 'verify','verify/*']);
    $isPortal = Request::is(['portal', 'portal/*']);
    @endphp

    @if($isAuthRoute)

    <!-- Back Button -->
    <a href="#" class="text-light mb-3 d-inline-block">
        <i class="fas fa-arrow-left"></i> <!-- Add an icon here if using Bootstrap Icons -->
    </a>

    <!-- Heart Animation -->
    <div class="heart-orbit"></div>

    <!-- Premium Status Heading -->
    <h1 class="neon-text">Premium status</h1>
    <p>gives you advantages</p>

    <!-- Plans -->
    <div class="container">
        <div class="row justify-content-center g-0">
            <div class="col-4">
                <a href="">
                    <div class="plan-card">
                        <p class="mb-1">1 week</p>
                        <h5>Ksh 200.00</h5>
                    </div>
                </a>
            </div>
            <div class="col-4">
                <a href="">
                    <div class="plan-card popular">
                        <span class="badge bg-dark">POPULAR</span>
                        <p class="mb-1">1 month</p>
                        <h5>Ksh 600.00</h5>
                    </div>
                </a>
            </div>
            <div class="col-4">
                <a href="">
                    <div class="plan-card">
                        <p class="mb-1">6 months</p>
                        <h5>Ksh 2,400.00</h5>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Premium Button -->
    <button class="premium-btn">Become a Premium user<br><small>Ksh 600.00 / month</small></button>

    <!-- Subscription Info -->
    <p class="text-white mt-3" style="font-size: 0.8em;">
        For this subscription, Ksh 600.00 / month will be deducted. You can cancel the subscription or change its terms
        in your Google Play account.
    </p>

    @else

    <section class="header">
        <!-- Slide container with background images -->
        <div class="slides">
            <div class="slide" style="background-image: url('/assets/images/slides/3.jpg');"></div>
            <div class="slide" style="background-image: url('/assets/images/slides/7.jpg');"></div>
            <div class="slide" style="background-image: url('/assets/images/slides/4.jpg');"></div>
            <div class="slide" style="background-image: url('/assets/images/slides/5.jpg');"></div>
        </div>

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg sticky-top main-navbar {{ Request::is('/') ? '' : 'scrolled' }}">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('assets/images/logo-no-bg.png') }}" alt="Site Logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Tour</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Dating Advice</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Singles Near Me</a>
                        </li>
                    </ul>
                    <a href="{{ route('login') }}" class="btn btn-lg btn-outline-light">
                        <i class="fas fa-sign-in"></i> Login
                    </a>
                </div>
            </div>
        </nav>

        <!-- Welcome Content -->
        <div class="header-content d-flex align-items-center justify-content-center min-vh-100">
            <div class="row w-100">
                <!-- Text Content -->
                <div class="col-md-7 d-flex flex-column justify-content-center">
                    <h1 class="display-4 fw-bold mb-3">Meet <u>singles</u> near you</h1>
                    <h3>Start finding your match for <span class="text-warning">free</span> today!</h3>
                    <p class="lead mt-4">
                        Connect with like-minded individuals for dating, relationships, or more.
                        Discover the possibilities around you!
                    </p>
                </div>
                <!-- Form Content -->
                <div class="col-md-5 d-flex flex-column justify-content-center">
                    <h3>Find Your Perfect Match</h3>
                    <form>
                        <!-- Specify Gender -->
                        <div class="mb-3">
                            <label for="gender" class="form-label fw-semibold text-start w-100">I am</label>
                            <div class="input-group">
                                <select class="form-select form-select-lg" id="gender" name="gender">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                        <!-- Looking For -->
                        <div class="mb-3">
                            <label for="lookingFor" class="form-label fw-semibold text-start w-100">Looking for</label>
                            <div class="input-group">
                                <select class="form-select form-select-lg" id="lookingFor" name="lookingFor">
                                    <option value="male">A man</option>
                                    <option value="female">A woman</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                        <!-- Reason -->
                        <div class="mb-3">
                            <label for="reason" class="form-label fw-semibold text-start w-100">Reason</label>
                            <div class="input-group">
                                <select class="form-select form-select-lg" id="reason" name="reason">
                                    <option value="dating">Dating</option>
                                    <option value="marriage">Marriage</option>
                                    <option value="partners">Partners</option>
                                    <option value="fwb">FWBs</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>

    @yield('content')

    <!-- Footer -->
    <section class="footer main-bg text-white py-5">
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-6 col-md-3 mb-4">
                        <h3 class="text-uppercase font-weight-bold">About</h3>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('about.rahaTele') }}" class="text-white">About Raha Tele</a></li>
                            <li><a href="{{ route('about.tips') }}" class="text-white">Raha Tele Tips</a></li>
                            <li><a href="{{ route('about.faq') }}" class="text-white">Raha Tele FAQ</a></li>
                            <li><a href="{{ route('about.successStories') }}" class="text-white">Success Stories</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-6 col-md-3 mb-4">
                        <h3 class="text-uppercase font-weight-bold">Company Info</h3>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('company.aboutUs') }}" class="text-white">About Us</a></li>
                            <li><a href="{{ route('company.safetyTips') }}" class="text-white">Safety Tips</a></li>
                            <li><a href="{{ route('company.careers') }}" class="text-white">Raha Tele Careers</a></li>
                            <li><a href="{{ route('company.terms') }}" class="text-white">Terms & Conditions</a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-md-3 mb-4">
                        <h3 class="text-uppercase font-weight-bold">Policies</h3>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('policies.privacy') }}" class="text-white">Privacy Policy</a></li>
                            <li><a href="{{ route('policies.healthDataPrivacy') }}" class="text-white">Consumer Health
                                    Data Privacy Policy</a></li>
                            <li><a href="{{ route('policies.compliance') }}" class="text-white">Compliance</a></li>
                            <li><a href="{{ route('policies.accessibility') }}" class="text-white">Accessibility
                                    Statement</a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-md-3 mb-4">
                        <h3 class="text-uppercase font-weight-bold">Resources</h3>
                        <ul class="list-unstyled">
                            <li><a href="https://www.cupidmedia.com/affiliate/" class="text-white">Affiliates</a></li>
                            <li><a href="https://support.match.com/" class="text-white">Help</a></li>
                            <li><a href="https://www.eharmony.com/press-research/" class="text-white">Press and
                                    Research</a></li>
                            <li><a href="https://www.plentyoffish.com/" class="text-white">Free Dating Site</a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-md-3 mb-4">
                        <h3 class="text-uppercase font-weight-bold">Dating Options</h3>
                        <ul class="list-unstyled">
                            <li><a href="https://www.dating.com/dating-facets/" class="text-white">Dating Facets</a>
                            </li>
                            <li><a href="https://www.ourtime.com/" class="text-white">Senior Dating Site</a></li>
                            <li><a href="https://www.christianmingle.com/" class="text-white">Christian Dating</a></li>
                            <li><a href="https://www.blackpeoplemeet.com/" class="text-white">Black Dating Site</a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-md-3 mb-4">
                        <h3 class="text-uppercase font-weight-bold">International Dating</h3>
                        <ul class="list-unstyled">
                            <li><a href="https://www.asiandating.com/" class="text-white">Asian Dating</a></li>
                            <li><a href="https://www.internationalcupid.com/" class="text-white">International Dating
                                    Site</a></li>
                            <li><a href="https://www.latinamericancupid.com/" class="text-white">Latin Dating</a></li>
                            <li><a href="https://www.silversingles.com/" class="text-white">Over 50 Dating Site</a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-md-3 mb-4">
                        <h3 class="text-uppercase font-weight-bold">Other Options</h3>
                        <ul class="list-unstyled">
                            <li><a href="https://www.indiancupid.com/" class="text-white">Indian Dating</a></li>
                            <li><a href="https://www.menchats.com/" class="text-white">Gay Dating Site</a></li>
                            <li><a href="https://www.herapp.com/" class="text-white">Lesbian Dating Site</a></li>
                            <li><a href="https://www.dating.com/" class="text-white">Dating Hub</a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-md-3 mb-4">
                        <h3 class="text-uppercase font-weight-bold">Getting Started</h3>
                        <ul class="list-unstyled">
                            <li><a href="https://www.psychologytoday.com/us/blog/finding-yourself/"
                                    class="text-white">Finding Yourself</a></li>
                            <li><a href="https://www.eharmony.com/dating-advice/" class="text-white">Dating</a></li>
                            <li><a href="https://www.eharmony.com/getting-to-know-someone/" class="text-white">Getting
                                    to Know</a></li>
                            <li><a href="https://www.psychologytoday.com/us/basics/attraction"
                                    class="text-white">Attraction</a></li>
                        </ul>
                    </div>
                </div>
                <hr class="bg-white">
                <div class="text-center">
                    <p class="text-muted">&copy; 2024 Raha tele. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </section>

    @endif

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Include Owl Carousel JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <!-- Additional Scripts -->
    @yield('scripts')
    @stack('scripts')

</body>

</html>