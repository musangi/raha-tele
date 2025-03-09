<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.subscribe');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Retrieve the subscription details from the request
        $id = $request->input('plan_id');
        $price = $request->input('plan_price');
        $duration = $request->input('plan_duration');

        // Add the subscription details to the session (acting as a cart)
        session([
            'subscription' => [
                'id' => $id,
                'price' => $price,
                'duration' => $duration
            ]
        ]);

        // Redirect to the registration page
        return redirect()->route('register')->with('message', 'Subscription added to cart. Please create an account.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function showSubscriptionPage()
    {
        $subscriptionPlans = SubscriptionPlan::all(); // Fetch all plans from the DB
        return view('subscription', compact('subscriptionPlans'));
    }

}
