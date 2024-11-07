@extends('layouts.app')

@section('content')

<!-- Premium Status Heading -->
<div class="text-center">
    <h1 class="neon-text mb-2">Unlock Premium</h1>
    <p class="subtitle mb-3">Enjoy exclusive benefits and features</p>
</div>

<!-- Subscription Plans -->
<div class="row text-center g-2">
    @foreach ($subscriptionPlans as $key => $plan)
    <div class="col-4">
        <a href="#" class="plan-option @if($key == 1) active @endif" data-price="{{ $plan['amount'] }}"
            data-id="{{ $plan['id'] }}" data-duration="{{ $plan['period'] }}">
            <div class="plan-card @if($key == 1) popular @endif p-3 border rounded shadow-sm position-relative">
                @if($key == 1)
                <span
                    class="badge bg-warning text-dark popular-badge position-absolute top-0 start-50 translate-middle">POPULAR</span>
                @endif

                <!-- Plan Name -->
                <h4 class="plan-name mb-1">{{ $plan['name'] }}</h4>
                <!-- Plan Period -->
                <p class="mb-1">{{ $plan['period'] }}</p>
                <!-- Plan Amount -->
                <h5 class="fw-bold">{{ $plan['amount'] }}</h5>
            </div>
        </a>
    </div>
    @endforeach
</div>

<!-- Subscription Form -->
<form action="{{ route('subscribe.store') }}" method="POST" id="subscription-form">
    @csrf

    <!-- Hidden fields to store selected plan details -->
    <input type="hidden" name="plan_id" id="plan-id" value="2">
    <input type="hidden" name="plan_price" id="plan-price" value="600.00">
    <input type="hidden" name="plan_duration" id="plan-duration" value="1 month">

    <!-- Premium Button with Dynamic Content -->
    <button type="submit" class="premium-btn btn mt-4 w-100 py-2">
        Become a Premium user<br><small class="selected-plan-price">Ksh 600.00 / month</small>
    </button>
</form>

<!-- Subscription Info -->
<p class="subscription-info text-center mt-3 small text-muted">
    For this subscription, <span class="selected-plan-price">Ksh 600.00</span> will be deducted after every
    <span class="selected-period">1 month</span>. You can
    cancel or modify terms in your account settings.
</p>

<!-- Already a Member Prompt and Login Button -->
<div class="text-center mt-2">
    <p class="small text-muted">Already a member?</p>
    <a href="{{ route('login') }}" class="btn btn-outline-main w-100 py-2"><i class="fas fa-sign-in"></i> Log
        In</a>
</div>

@endsection

<!-- jQuery Script -->
@push('scripts')
<script>
$(document).ready(function() {
    // Update the hidden fields and UI when a plan is selected
    $('.plan-option').on('click', function(event) {
        event.preventDefault();

        // Remove 'active' class from all options and add it to the clicked option
        $('.plan-option').removeClass('active');
        $(this).addClass('active');

        // Get the selected plan details
        let id = $(this).data('id');
        let price = $(this).data('price');
        let duration = $(this).data('duration');

        // Update the button and subscription info with the selected plan details
        $('.premium-btn .selected-plan-price').text(`${price} / ${duration}`);
        $('.subscription-info .selected-plan-price').text(price);

        // Update the period text for selected duration
        $('.selected-period').text(duration);

        // Update hidden input fields in the form
        $('#plan-id').val(id);
        $('#plan-price').val(price.replace('Ksh ', '').replace(',', ''));
        $('#plan-duration').val(duration);
    });
});
</script>
@endpush