<?php

namespace App\Providers;

use App\Models\SubscriptionPlan; // Import the model
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon; // Import Carbon for date manipulation
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Fetch subscription plans from the database
        $subscriptionPlans = SubscriptionPlan::all();

        // Retrieve 60 users from the database
        $users = User::select('profile_image', 'name', 'date_of_birth', 'location')
            ->limit(60)
            ->get()
            ->map(function ($user) {
                // Calculate the user's age
                if ($user->date_of_birth) {
                    $user->age = Carbon::parse($user->date_of_birth)->age;
                } else {
                    $user->age = null; // Handle the case where date_of_birth is null
                }
                return $user;
            });

        // Pass the menu array to all views
        $menuLinks = [];

        if (auth()->check()) {
            // If the user is logged in, display the full menu
            $menuLinks = [
                ['route' => 'dashboard', 'name' => 'Dashboard', 'icon' => 'fas fa-home'],
                ['route' => 'explore', 'name' => 'Explore', 'icon' => 'fas fa-search'],
                ['route' => 'matches', 'name' => 'Matches', 'icon' => 'fas fa-heart'],
                ['route' => 'messages', 'name' => 'Messages', 'icon' => 'fas fa-comments'],
                ['route' => 'profile.index', 'name' => 'Profile', 'icon' => 'fas fa-user'],
                ['route' => 'logout', 'name' => 'Logout', 'icon' => 'fas fa-sign-out-alt', 'onclick' => 'event.preventDefault(); document.getElementById(\'logout-form\').submit();'],
            ];
        } else {
            // If the user is not logged in, show only Register and Subscribe links
            $menuLinks = [
                ['route' => 'register', 'name' => 'Register', 'icon' => 'fas fa-user-plus'],
                ['route' => 'subscribe.index', 'name' => 'Subscribe', 'icon' => 'fas fa-credit-card'],
            ];
        }

        // Share the subscription plans and users data with all views
        view()->share([
            'subscriptionPlans' => $subscriptionPlans,
            'users' => $users,
            'menuLinks' => $menuLinks
        ]);
    }
}
