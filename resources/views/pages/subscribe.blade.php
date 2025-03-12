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
        <a href="#" class="plan-option @if($key == 1) active @endif" 
           data-price="{{ $plan['amount'] }}"
           data-id="{{ $plan['id'] }}" 
           data-duration="{{ $plan['period'] }}">
            <div class="plan-card @if($key == 1) popular @endif p-3 border rounded shadow-sm position-relative">
                @if($key == 1)
                <span class="badge bg-warning text-dark popular-badge position-absolute top-0 start-50 translate-middle">POPULAR</span>
                @endif

                <!-- Plan Name -->
                <h4 class="plan-name mb-1">{{ $plan['name'] }}</h4>
                <!-- Plan Period -->
                <p class="mb-1">{{ $plan['period'] }}</p>
                <!-- Plan Amount -->
                <h5 class="fw-bold">Ksh {{ $plan['amount'] }}</h5>
            </div>
        </a>
    </div>
    @endforeach
</div>

<!-- Subscription Form -->
<form action="{{ route('pay') }}" method="POST" id="subscription-form">
    @csrf

    <!-- Hidden fields to store selected plan details -->
    <input type="hidden" name="plan_id" id="plan-id">
    <input type="hidden" name="amount" id="plan-price">
    <input type="hidden" name="plan_duration" id="plan-duration">
    <input type="hidden" name="phone" id="mpesa-phone-hidden">

    <!-- Premium Button -->
    <button type="button" class="premium-btn btn mt-4 w-100 py-2" id="open-modal-btn">
        Become a Premium user<br><small class="selected-plan-price">Ksh 600.00 / month</small>
    </button>
    
</form>

<!-- Subscription Info -->
<p class="subscription-info text-center mt-3 small text-muted">
    For this subscription, <span class="selected-plan-price">Ksh 600.00</span> will be deducted after every
    <span class="selected-period">1 month</span>. You can cancel or modify terms in your account settings.
</p>

<!-- Already a Member Prompt -->
<div class="text-center mt-2">
    <p class="small text-muted">Already a member?</p>
    <a href="{{ route('login') }}" class="btn btn-outline-main w-100 py-2"><i class="fas fa-sign-in"></i> Log In</a>
</div>

<!-- M-Pesa Phone Number Modal -->
<div class="modal fade" id="mpesaModal" tabindex="-1" aria-labelledby="mpesaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mpesaModalLabel">Confirm Subscription</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Plan Selection -->
                <label for="plan-select">Choose Subscription Plan</label>
                <select id="plan-select" class="form-control">
                    <option value="">Select a plan</option>
                    @foreach ($subscriptionPlans as $plan)
                        <option value="{{ $plan->id }}" data-price="{{ $plan->amount }}" data-duration="{{ $plan->period }}">
                            {{ $plan->name }} - Ksh {{ $plan->amount }} / {{ $plan->period }}
                        </option>
                    @endforeach
                </select>                
                <!-- M-Pesa Phone Number -->
                <label for="mpesa-phone" class="mt-3">M-Pesa Phone Number</label>
                <input type="text" id="mpesa-phone" class="form-control" placeholder="07XXXXXXXX" required>
                <input type="hidden" id="mpesa-phone-hidden" name="phone">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" id="confirm-payment-btn" class="btn btn-primary">Confirm & Pay</button>
            </div>
        </div>
    </div>
</div>

@endsection

{{-- Scripts --}}
@push('scripts')
<script>
$(document).ready(function() {
    // Show the modal when "Become a Premium User" is clicked
    $('.premium-btn').on('click', function(event) {
        event.preventDefault();
        $('#mpesaModal').modal('show'); // Show modal
    });

    // When the user selects a plan, update hidden inputs
    $('#plan-select').on('change', function() {
        let selectedPlan = $(this).find(':selected');
        let planId = selectedPlan.val();
        let price = selectedPlan.data('price');
        let duration = selectedPlan.data('duration');

        // Update hidden input fields
        $('#plan-id').val(planId);
        $('#plan-price').val(price);
        $('#plan-duration').val(duration);
    });

    // Confirm & Submit Payment
    $('#confirm-payment-btn').on('click', function() {
        let phone = $('#mpesa-phone').val().trim();
        let planId = $('#plan-id').val();
        let amount = $('#plan-price').val();
        let duration = $('#plan-duration').val();

        // Validate plan selection
        if (!planId) {
            alert("Please select a subscription plan.");
            return;
        }

        // Validate phone number format
        if (!phone.match(/^(2547|07|7)\d{8}$/)) {
            alert('Invalid phone number. Use 07XXXXXXXX or 2547XXXXXXXX.');
            return;
        }

        // Convert phone to international format
        if (phone.startsWith("07")) {
            phone = "254" + phone.substring(1);
        } else if (phone.startsWith("7")) {
            phone = "254" + phone;
        }

        $('#mpesa-phone-hidden').val(phone);

        // Close modal and submit the form
        $('#mpesaModal').modal('hide');
        $('#subscription-form').submit();
    });
});
</script>
@endpush
