<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Exception;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    /**
     * Display the profile overview.
     */
    public function index()
    {
        // Get the authenticated user
        $user = Auth::user();
        return view('portal.profile.index', compact('user'));
    }

    /**
     * Display the specified user's profile.
     */
    public function show(string $id)
    {
        try {
            // Find the user by ID
            $user = User::findOrFail($id);
            return view('portal.profile.show', compact('user'));
        } catch (Exception $e) {
            return redirect()->route('profile.index')->with('error', 'User not found.');
        }
    }

    /**
     * Show the form for editing the authenticated user's profile.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('portal.profile.edit', compact('user'));
    }

    /**
     * Update the user's profile.
     */
    public function update(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'bio' => 'nullable|string|max:500',
            'phone_number' => 'nullable|string|max:15',
            'date_of_birth' => 'required|date',  // Validation for date_of_birth
            'gender' => 'required|in:male,female,other',
            'location' => 'nullable|string|max:255',
            'availability' => 'required|in:available,unavailable',
            'hourly_rate' => 'nullable|numeric|min:0',
            'is_escort' => 'required|boolean',
            // 'is_verified' => 'required|boolean',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Max size 2MB
        ]);

        try {
            // Find the authenticated user
            $user = Auth::user();

            // Update user profile information
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->bio = $request->input('bio');
            $user->phone_number = $request->input('phone_number');
            $user->date_of_birth = $request->input('date_of_birth');
            $user->gender = $request->input('gender');
            $user->location = $request->input('location');
            $user->availability = $request->input('availability');
            $user->hourly_rate = $request->input('hourly_rate');
            $user->is_escort = $request->input('is_escort');
            // $user->is_verified = $request->input('is_verified');

            // Handle the profile image upload
            if ($request->hasFile('profile_image')) {
                // Delete the old image if it exists
                if ($user->profile_image && Storage::exists($user->profile_image)) {
                    Storage::delete($user->profile_image);
                }

                // Store the new image
                $imagePath = $request->file('profile_image')->store('profile_images', 'public');
                $user->profile_image = $imagePath;
            }

            // Save the updated user data
            $user->save();

            // Redirect back with a success message
            return redirect()->route('profile.index')->with('success', 'Profile updated successfully.');
        } catch (Exception $e) {
            Log::error('Error updating profile: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error updating profile: ' . $e->getMessage());
        }
    }
}