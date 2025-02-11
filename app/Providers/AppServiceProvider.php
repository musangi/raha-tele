<?php

namespace App\Providers;

use App\Models\SubscriptionPlan;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
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
    // public function boot(): void
    // {
    //     // Cache subscription plans to optimize repeated access
    //     $subscriptionPlans = cache()->remember('subscription_plans', 60, function () {
    //         return SubscriptionPlan::all();
    //     });

    //     // Retrieve users with selected attributes
    //     $users = User::select('profile_image', 'name', 'date_of_birth', 'location')
    //         ->limit(60)
    //         ->get();

    //     // Share subscription plans and users with all views
    //     view()->share(compact('subscriptionPlans', 'users'));

    //     // Use a view composer to set menu links based on authentication status
    //     View::composer('*', function ($view) {
    //         $menuLinks = Auth::check()
    //             ? [
    //                 ['route' => 'dashboard', 'name' => 'Dashboard', 'icon' => 'fas fa-home'],
    //                 ['route' => 'explore', 'name' => 'Explore', 'icon' => 'fas fa-search'],
    //                 ['route' => 'matches', 'name' => 'Matches', 'icon' => 'fas fa-heart'],
    //                 ['route' => 'messages', 'name' => 'Messages', 'icon' => 'fas fa-comments'],
    //                 ['route' => 'profile.index', 'name' => 'Profile', 'icon' => 'fas fa-user'],
    //                 [
    //                     'route' => 'logout',
    //                     'name' => 'Logout',
    //                     'icon' => 'fas fa-sign-out-alt',
    //                     'onclick' => 'event.preventDefault(); document.getElementById(\'logout-form\').submit();',
    //                 ],
    //             ]
    //             : [
    //                 ['route' => 'register', 'name' => 'Register', 'icon' => 'fas fa-user-plus'],
    //                 ['route' => 'subscribe.index', 'name' => 'Subscribe', 'icon' => 'fas fa-credit-card'],
    //             ];

    //         // Share the menu links with all views
    //         $view->with('menuLinks', $menuLinks);
    //     });
    // }
}
