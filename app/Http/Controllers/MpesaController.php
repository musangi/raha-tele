<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Subscription;
use Carbon\Carbon;
use Mpesa;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class MpesaController extends Controller
{
    public function stk(Request $request)
    {
        $mpesaEnv = env('MPESA_ENV'); // Get environment from .env
        $shortcode = env('MPESA_SHORTCODE'); // Your paybill or till number
        $passkey = env('MPESA_PASSKEY'); // Your M-Pesa passkey
        $consumerKey = env('MPESA_CONSUMER_KEY');
        $consumerSecret = env('MPESA_CONSUMER_SECRET');

        // Base URL for API
        $baseUrl = $mpesaEnv == 'sandbox' 
                    ? 'https://sandbox.safaricom.co.ke' 
                    : 'https://api.safaricom.co.ke';

        // STK Push URL
        $stkPushUrl = $baseUrl . '/mpesa/stkpush/v1/processrequest';

        // Get M-Pesa access token
        $accessToken = $this->getMpesaAccessToken($consumerKey, $consumerSecret);
        if (!$accessToken) {
            \Log::error('Failed to get M-Pesa access token.');
            return response()->json(['error' => 'Failed to get access token'], 500);
        }

        // Generate timestamp and password
        $timestamp = date('YmdHis');
        $password = base64_encode($shortcode . $passkey . $timestamp);

        $phone = $request->input('phone'); // User's phone number
        $amount = (int) $request->input('amount'); // Ensure it's a valid number

        // Prepare request payload
        $payload = [
            "BusinessShortCode" => $shortcode,
            "Password" => $password,
            "Timestamp" => $timestamp,
            "TransactionType" => "CustomerPayBillOnline",
            "Amount" => $amount,
            "PartyA" => $phone,
            "PartyB" => $shortcode,
            "PhoneNumber" => $phone,
            "CallBackURL" => env('MPESA_CALLBACK_URL'),
            "AccountReference" => "Subscription",
            "TransactionDesc" => "Payment for Subscription"
        ];

        // Create Guzzle client with SSL verification disabled
        $client = new Client([
            'verify' => false, // Disable SSL certificate verification
        ]);

        try {
            // Send request using Guzzle
            $response = $client->post($stkPushUrl, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                    'Content-Type'  => 'application/json'
                ],
                'json' => $payload
            ]);

            // Decode response
            $responseData = json_decode($response->getBody(), true);

            \Log::info('STK Push Response:', $responseData);

            return response()->json([
                'message' => 'STK push initiated',
                'response' => $responseData
            ]);

        } catch (RequestException $e) {
            \Log::error('STK Push Error: ' . $e->getMessage());
            if ($e->hasResponse()) {
                \Log::error('STK Push Response: ' . $e->getResponse()->getBody()->getContents());
                \Log::info('STK Push Payload:', $payload);

            }
            return response()->json(['error' => 'STK push request failed'], 500);
        }
        
    }

    private function getMpesaAccessToken($consumerKey, $consumerSecret)
    {
        $baseUrl = env('MPESA_ENV') == 'sandbox' 
                    ? 'https://sandbox.safaricom.co.ke' 
                    : 'https://api.safaricom.co.ke';

        $url = $baseUrl . "/oauth/v1/generate?grant_type=client_credentials";

        // Disable SSL verification (only for testing in sandbox)
        $response = Http::withBasicAuth($consumerKey, $consumerSecret)
                        ->withOptions(['verify' => false]) // <-- Disable SSL verification
                        ->get($url);

        if ($response->successful()) {
            return $response->json()['access_token'];
        }

        \Log::error('Failed to fetch M-Pesa access token: ' . $response->body());
        return null;
    }


    
}
