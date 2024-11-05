@if (Request::is('/'))
<nav class="navbar navbar-expand-lg sticky-top main-navbar">
    @else
    <nav class="navbar navbar-expand-lg sticky-top main-navbar scrolled">
        @endif

        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('assets/images/logo-no-bg.png') }}" alt="" srcset="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
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
                <!-- Modal Btn -->
                <button type="button" class="btn btn-lg btn-outline-light" data-bs-toggle="modal"
                    data-bs-target="#loginModal">
                    <i class="fas fa-sign-in"></i>
                    Login
                </button>
            </div>
        </div>
    </nav>