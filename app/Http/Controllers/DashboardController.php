<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subscription;
use App\Models\Activity;

class DashboardController extends Controller
{
    public function index()
    {
        // Get the authenticated user
        $user = auth()->user();

        // Fetch the latest subscription for the user
        $subscription = $user->subscriptions()->latest()->first();

        // Fetch suggested profiles (example logic, adjust as needed)
        $suggestedProfiles = User::where('id', '!=', $user->id)
            ->where('location', $user->location)
            ->take(6)
            ->get();

        // Fetch recent activities (example logic, adjust as needed)
        $recentActivities = [];

        // Pass data to the view
        return view('portal.dashboard', compact('user', 'subscription', 'suggestedProfiles', 'recentActivities'));
    }
}
