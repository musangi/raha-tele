<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Faker\Factory as Faker;

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
        // Generate 60 user records
        $faker = Faker::create();
        $users = [];

        for ($i = 0; $i < 60; $i++) {
            $users[] = [
                'profile_image' => $faker->imageUrl(80, 80, 'people', true),
                'name' => $faker->name,
                'age' => $faker->numberBetween(18, 60),
                'location' => $faker->city . ', ' . $faker->state,
            ];
        }

        // Share the users data with all views
        view()->share('users', $users);
    }
}