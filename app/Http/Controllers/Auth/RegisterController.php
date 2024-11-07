<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Subscription; // Ensure the Subscription model is imported
use App\Mail\RegistrationConfirmation; // The email class for registration confirmation
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log; // Import Log facade for error logging
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/success'; // Change this to the success page URL

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        try {
            // Validate the incoming request data
            $this->validator($request->all())->validate();

            // Create the user
            $user = $this->create($request->all());

            // Redirect to the success page after successful registration
            return redirect('login')->with('success',  'Account created successfully, check your email for the account activation');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Registration failed: ' . $e->getMessage());

            // Optionally, you can flash a message to inform the user
            return redirect()->back()->with('error',  $e->getMessage());
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        try {
            // Create the user
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            // Check if there is a subscription in the session and assign it to the user
            if (session('subscription')) {
                $subscription = session('subscription');

                // Ensure the subscription is valid (optional)
                if (isset($subscription['id'], $subscription['price'], $subscription['duration'])) {
                    try {
                        // Calculate start and end dates
                        $startDate = now(); // You can change this if you have a specific start date
                        $endDate = now()->addMonths($subscription['duration']); // Assuming duration is in months

                        // Create the subscription
                        $subscriptionSuccess = Subscription::create([
                            'user_id' => $user->id,
                            'subscription_plan_id' => $subscription['id'], // Assuming you have this field in your Subscription model
                            'amount' => $subscription['price'],
                            'start_date' => $startDate,
                            'end_date' => $endDate,
                        ]);

                        // Check if subscription was created successfully
                        if ($subscriptionSuccess) {
                            // Clear the session subscription data
                            session()->forget('subscription');
                        }
                    } catch (\Exception $e) {
                        // Log any errors during subscription creation
                        Log::error('Error creating subscription for user ID ' . $user->id, [
                            'exception' => $e,
                            'subscription_data' => $subscription,
                        ]);
                        // Optionally, handle the error further (e.g., throw or return an error response)
                    }
                }
            }

            // Send the registration confirmation email
            Mail::to($user->email)->send(new RegistrationConfirmation($user));

            return $user;
        } catch (\Exception $e) {
            // Log the error during user creation
            Log::error('Registration failed: ' . $e->getMessage());

            throw $e; // Re-throw the exception to be handled in the register method
        }
    }
}
