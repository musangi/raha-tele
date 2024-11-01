@extends('layouts.app')

@section('content')

<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 home-card-1 px-4 py-5 text-center">
                <div class="icon">
                    <i class="fas fa-heart"></i>
                </div>
                <h2>The #1 trusted dating app</h2>
                <p>2022 survey of 1,300 respondents from Kenya</p>
            </div>
            <div class="col-md-4 home-card-2 px-4 py-5 text-center">
                <div class="icon">
                    <i class="fas fa-heart"></i>
                </div>
                <h2>Every 14 minutes, someone finds love on Raha Tele</h2>
                <p>Raha Tele user data</p>
            </div>
            <div class="col-md-4 home-card-1 px-4 py-5 text-center">
                <div class="icon">
                    <i class="fas fa-heart"></i>
                </div>
                <h2>Highest quality dating pool</h2>
                <p>2023 survey of 2,807 dating app users in Kenya</p>
            </div>
        </div>
    </div>
</section>

<section class="data-section">
    <div class="container py-5">
        <div class="col-md-8 mx-auto">
            <h1 class="text-center mb-3 heading-title">Our dating site helps millions find real love</h1>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card border-0 shadow-none">
                    <div class="card-body p-0 text-center">
                        <img src="{{ asset('assets/images/slides/2.jpg') }}" class="rounded-5 img-border mb-2" alt="Dating Image 1">
                        <h5>Over 2 million have found love</h5>
                        <p>… could you be next?</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-none">
                    <div class="card-body p-0 text-center">
                        <img src="{{ asset('assets/images/slides/5.jpg') }}" class="rounded-5 img-border mb-2" alt="Dating Image 2">
                        <h5>Over 2 million have found love</h5>
                        <p>… could you be next?</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-none">
                    <div class="card-body p-0 text-center">
                        <img src="{{ asset('assets/images/slides/4.jpg') }}" class="rounded-5 img-border mb-2" alt="Dating Image 3">
                        <h5>Over 2 million have found love</h5>
                        <p>… could you be next?</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="escorts-section">
    <div class="container py-5">
        <div class="col-md-8 mx-auto">
            <h1 class="text-center mb-3 heading-title">Featured Escorts</h1>
        </div>

        @for ($i = 0; $i < 36; $i++)
            @if ($i % 12==0)
            <div class="profile-group row" data-group="{{ intval($i / 12) }}" style="{{ $i == 0 ? '' : 'display: none;' }}">
            @endif

            <div class="col-md-3">
                <div class="escort-card">
                    <img src="https://via.placeholder.com/80" alt="Escort Profile" class="profile-img">
                    <h4 class="m-0">Jane Smith</h4>
                    <p class="m-0">Age: 27 Years</p>
                    <p class="m-0">Location: Westlands, Nairobi</p>
                    <p class="m-0">
                        <a href="#" class="btn btn-sm btn-outline-custom rounded-pill w-100">
                            <i class="fas fa-phone"></i> Whatsapp/Call Jane
                        </a>
                    </p>
                </div>
            </div>

            @if (($i + 1) % 12 == 0 || $i == 35)
    </div>
    @endif
    @endfor

    <div class="col-12 text-center pagination-controls">
        <!-- Page Numbers -->
        <div id="page-numbers">
            @for ($i = 0; $i < ceil(36 / 12); $i++)
                <button class="btn btn-secondary page-btn" data-group="{{ $i }}">{{ $i + 1 }}</button>
                @endfor
        </div>
    </div>
    </div>
</section>

<section class="availability-section">
    <div class="container py-5 text-center text-white">
        <div class="col-8 mx-auto">
            <h1>We’re Here For You</h1>
            <p>Signing up for Raha Tele is the first step in finding your next great relationship. From profile tips to sharing your success story, we are here to support you in your journey for love.</p>
            <h5>WE’RE AVAILABLE 24/7, 365 DAYS A YEAR</h5>
            <a href="" class="btn btn-lg btn-outline-light">Contact Us</a>
        </div>
    </div>
</section>

<section>
    <div class="container py-5">
        <div class="col-md-8 mx-auto">
            <h1 class="text-center mb-3 heading-title">Dating Advice</h1>
            <p class="text-center">Your guide to dating and relationships all in one place. The latest articles, blogs, and videos created by relationship experts, journalists, and our in-house advice team, exclusively on Raha Tele.</p>
        </div>

        <div class="owl-carousel owl-theme">
            <div class="item">
                <img src="{{ asset('assets/images/slides/10.jpg') }}" class="rounded-5 img-border mb-2" alt="Dating Image 2">
                <h3>15 Date Ideas That Aren’t Dinner and a Movie</h3>
                <p>When you think of date ideas, there are a few things that come to mind immediately – drinks, dinner, a movie, maybe a hike if you’re the outdoorsy kind. While those are all classics for a reason, it can be fun to think outside the box sometimes, whether you’re looking to make a good impression on a new flame or want to add some spice to a long-standing relationship.</p>
                <a href="#">Read More</a>
            </div>
            <div class="item">
                <img src="{{ asset('assets/images/slides/2.jpg') }}" class="rounded-5 img-border mb-2" alt="Dating Image 2">
                <h3>Curiosity Didn’t Kill This Cat: 140 Questions To Ask Someone</h3>
                <p>Getting to know each other is an integral part of the dating process, but it can be very hard to know what kind of questions to ask. In this article, we’ve covered a range of topics, each with plenty of example questions to ask to get to know someone. </p>
                <a href="#">Read More</a>
            </div>
            <div class="item">
                <img src="{{ asset('assets/images/slides/4.jpg') }}" class="rounded-5 img-border mb-2" alt="Dating Image 2">
                <h3>Make Your Dating Profile Work for You</h3>
                <p>A good dating profile is the cornerstone of your online dating efforts. It’s that first impression that gets people interested. But it can be difficult sometimes to figure out what photos express who you are and what essential aspects of your life to include in your dating profile bio.</p>
                <a href="#">Read More</a>
            </div>
        </div>

    </div>
</section>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Initially set the first page as active
        let currentGroup = 0;
        const totalGroups = $('.profile-group').length;
        $(`.page-btn[data-group="${currentGroup}"]`).addClass('active');

        // Handle Page Number Clicks
        $('.page-btn').on('click', function() {
            const group = $(this).data('group');
            $(`.profile-group[data-group="${currentGroup}"]`).hide();
            $(`.profile-group[data-group="${group}"]`).show();
            currentGroup = group;
            $('.page-btn').removeClass('active');
            $(this).addClass('active');
        });

        $(".owl-carousel").owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            dots: true,
            items: 2,
            autoplay: true,
            autoplayTimeout: 3000,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                }
            }
        });
    });
</script>
@endpush