<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubscriptionPlan;

class SubscriptionPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subscriptionPlans = [
            [
                'id' => 1,
                'name' => 'Basic Plan',
                'period' => '1 week',
                'amount' => 200.00
            ],
            [
                'id' => 2,
                'name' => 'Premium Plan',
                'period' => '1 month',
                'amount' => 600.00
            ],
            [
                'id' => 3,
                'name' => 'Pro Plan',
                'period' => '6 months',
                'amount' => 2400.00
            ]
        ];

        foreach ($subscriptionPlans as $plan) {
            SubscriptionPlan::create($plan);
        }
    }
}
