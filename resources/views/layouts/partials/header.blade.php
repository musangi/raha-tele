<section class="header">
    <!-- Slide container with background images -->
    <div class="slides">
        <div class="slide" style="background-image: url('/assets/images/slides/3.jpg');"></div>
        <div class="slide" style="background-image: url('/assets/images/slides/7.jpg');"></div>
        <div class="slide" style="background-image: url('/assets/images/slides/4.jpg');"></div>
        <div class="slide" style="background-image: url('/assets/images/slides/5.jpg');"></div>
    </div>

    <div class="darken-bg">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg sticky-top main-navbar {{ Request::is('/') ? '' : 'scrolled' }}">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('assets/images/logo-no-bg.png') }}" alt="Site Logo">
                </a>
                <span class="navbar-toggler border-0 text-white" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </span>
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
                    <a href="{{ route('login') }}" class="btn-outline-main rounded-4">
                        <i class="fas fa-sign-in"></i> Login
                    </a>
                </div>
            </div>
        </nav>

        <!-- Welcome Content -->
        <div class="header-content d-flex align-items-center justify-content-center min-vh-100 mt-5">
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
    </div>
</section>

<!-- Optional: Add JavaScript for background image transitions -->
@push('scripts')
<script>
// JavaScript to handle the background image slider
const slides = document.querySelectorAll('.slide');
let currentIndex = 0;

function changeBackground() {
    slides.forEach((slide, index) => {
        slide.style.opacity = '0'; // Hide all slides
    });
    currentIndex = (currentIndex + 1) % slides.length; // Move to the next slide
    slides[currentIndex].style.opacity = '1'; // Show the next slide
}

// Initial background change setup
setInterval(changeBackground, 5000); // Change the background every 5 seconds

// Set up the first slide to be visible
slides[currentIndex].style.opacity = '1';
</script>
@endpush