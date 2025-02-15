<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ExploreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        // Fetch users NOT interacted with yet (not liked/disliked)
        $potentialMatches = User::where('id', '!=', $user->id )//exclude self 
        ->whereNotIn('id', function($query) use ($user) {
            $query->select('matched_user_id')->from('matches')->where('usser_id', $user->id);
        })
        ->inRandomOrder()
        ->limit(10) //limit to 10 users at a time
        ->get();
        // return profile.explorer.index
        return view('portal.explore.index');
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
        //
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
}
