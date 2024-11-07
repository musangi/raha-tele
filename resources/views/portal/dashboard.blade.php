@extends('layouts.app')

@section('content')

<div class="mt-4">
    <!-- Welcome Message -->
    @auth
    <h2 class="text-center main-color">Welcome Back, {{ explode(' ', $user->name)[0] }}!</h2>
    @else
    <h2 class="text-center main-color">Welcome to Our Platform</h2>
    @endauth

    <!-- Dashboard Content -->
    <div class="row mt-4">
        <!-- Profile Summary Card -->
        <div class="col-md-4 mb-4">
            <div class="card shadow border-0 h-100">
                <div class="card-body text-center">
                    <img src="{{ $user->profile_image ?? asset('assets/images/profiles/default-avatar.png') }}"
                        class="rounded-circle mb-3" width="100" alt="Profile Image">
                    <h5 class="card-title">{{ $user->name }}</h5>
                    <p class="text-muted">{{ $user->bio ?? 'Add a short bio to introduce yourself!' }}</p>
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-main btn-sm">Edit
                        Profile</a>
                </div>
            </div>
        </div>

        <!-- Subscription Plan Card -->
        <div class="col-md-4 mb-4">
            <div class="card shadow border-0 h-100">
                <div class="card-header border-0 main-bg text-white">
                    <h5>Subscription Plan</h5>
                </div>
                <div class="card-body text-center">
                    @if($subscription && $subscription->subscriptionPlan)
                    <p class="lead">
                        You are currently on the <strong>{{ $subscription->subscriptionPlan->name }}</strong> plan.
                    </p>
                    <p class="text-muted">
                        Valid until: {{ $subscription->end_date }}
                    </p>
                    @else
                    <p class="lead">You are currently not subscribed to any plan.</p>
                    @endif
                    <a href="" class="btn btn-outline-main btn-sm">
                        Manage Subscription
                    </a>
                </div>
            </div>
        </div>

        <!-- Match Suggestions & Connections -->
        <div class="col-md-4 mb-4">
            <div class="card shadow border-0 h-100">
                <div class="card-header border-0 main-bg text-white">
                    <h5>Suggested Matches</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Suggested Profiles Loop -->
                        @foreach($suggestedProfiles as $profile)
                        <div class="col-4 text-center mb-3">
                            <a href="{{ route('profile.show', $profile->id) }}">
                                <img src="{{ $profile->profile_image ?? asset('assets/images/profiles/default-avatar.png') }}"
                                    class="rounded-circle" width="60" alt="User Image">
                                <p class="small mt-2 mb-0 text-truncate"
                                    style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    {{ $profile->name }}
                                </p>
                                <p class="text-muted small text-truncate"
                                    style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    {{ $profile->age }} | {{ $profile->location }}
                                </p>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity & Actions -->
    <div class="row">
        <!-- Activity Feed -->
        <div class="col-md-12 mb-4">
            <div class="card shadow border-0">
                <div class="card-header border-0 main-bg text-white">
                    <h5>Recent Activity</h5>
                </div>
                <div class="card-body">
                    @if(is_array($recentActivities) && count($recentActivities) > 0)
                    <ul class="list-group list-group-flush">
                        @foreach($recentActivities as $activity)
                        <li class="list-group-item">
                            <small><strong>{{ $activity->user->name }}</strong> {{ $activity->description }}</small>
                            <span class="text-muted float-right">{{ $activity->created_at->diffForHumans() }}</span>
                        </li>
                        @endforeach
                    </ul>
                    @else
                    <p class="text-muted">No recent activity to show.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection