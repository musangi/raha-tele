<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Subscription;
use Carbon\Carbon;
use Safaricom\Mpesa\Mpesa;

class MpesaController extends Controller
{
    private $consumerKey;
    private $consumerSecret;
    private $shortCode;
    private $passkey;
    private $callbackUrl;

    public function __construct()
    {
        $this->consumerKey = env('MPESA_CONSUMER_KEY');
        $this->consumerSecret = env('MPESA_CONSUMER_SECRET');
        $this->shortCode = env('MPESA_SHORTCODE');
        $this->passkey = env('MPESA_PASSKEY');
        $this->callbackUrl = route('mpesa.callback');
    }

    public function stkPush(Request $request)
    {
        dd($request->all());
        $phone = $request->phone;
        $amount = $request->amount;
        $planId = $request->plan_id;

        // Ensure phone number format is correct
        if (!preg_match('/^(2547|07|7)\d{8}$/', $phone)) {
            return back()->withErrors(['phone' => 'Invalid phone number format']);
        }
        
        // Convert phone to international format
        if (substr($phone, 0, 1) == "0") {
            $phone = "254" . substr($phone, 1);
        } elseif (substr($phone, 0, 2) == "7") {
            $phone = "254" . $phone;
        }

        // Get Access Token
        $accessToken = $this->getAccessToken();
        if (!$accessToken) {
            return back()->withErrors(['mpesa' => 'Failed to generate M-Pesa Access Token']);
        }

        // Generate Timestamp and Password
        $timestamp = date('YmdHis');
        $password = base64_encode($this->shortCode . $this->passkey . $timestamp);

        // STK Push Request
        $response = Http::withToken($accessToken)->post('https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest', [
            "BusinessShortCode" => $this->shortCode,
            "Password" => $password,
            "Timestamp" => $timestamp,
            "TransactionType" => "CustomerPayBillOnline",
            "Amount" => $amount,
            "PartyA" => $phone,
            "PartyB" => $this->shortCode,
            "PhoneNumber" => $phone,
            "CallBackURL" => $this->callbackUrl,
            "AccountReference" => "RahaTele Subscription",
            "TransactionDesc" => "Payment for Subscription Plan"
        ]);

        // Check response
        $result = $response->json();

        if (isset($result['ResponseCode']) && $result['ResponseCode'] == "0") {
            return back()->with('success', 'STK Push sent. Check your phone to complete the transaction.');
        } else {
            return back()->withErrors(['mpesa' => 'Failed to initiate STK Push: ' . json_encode($result)]);
        }
    }

    private function getAccessToken()
    {
        $response = Http::withBasicAuth($this->consumerKey, $this->consumerSecret)
            ->get('https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials');

        if ($response->successful()) {
            return $response->json()['access_token'];
        }

        return null;
    }

    public function mpesaCallback(Request $request)
{
    $response = $request->all();

    if (isset($response['Body']['stkCallback']['ResultCode']) && $response['Body']['stkCallback']['ResultCode'] == 0) {
        $callbackMetadata = $response['Body']['stkCallback']['CallbackMetadata']['Item'];

        $mpesaReceipt = collect($callbackMetadata)->where('Name', 'MpesaReceiptNumber')->first()['Value'];
        $amount = collect($callbackMetadata)->where('Name', 'Amount')->first()['Value'];
        $phone = collect($callbackMetadata)->where('Name', 'PhoneNumber')->first()['Value'];

        // Find user by phone number
        $user = \App\Models\User::where('phone', $phone)->first();
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Find corresponding plan (ensure it exists)
        $plan = \App\Models\SubscriptionPlan::where('amount', $amount)->first();
        if (!$plan) {
            return response()->json(['error' => 'Subscription plan not found'], 404);
        }

        // Store subscription in the database
        Subscription::create([
            'user_id' => $user->id,
            'subscription_plan_id' => $plan->id,
            'start_date' => now(),
            'end_date' => Carbon::now()->addDays(30), // Adjust for different plans if needed
            'amount' => $amount,
        ]);

        return response()->json(['success' => 'Subscription activated successfully']);
    }

    return response()->json(['error' => 'Payment failed'], 400);
}

}
