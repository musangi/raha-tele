<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Matches;
use Illuminate\Support\Facades\Auth;

class MatchController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // fetch liked matches
        $likedMatches = Matches::where('user_id', $user->id)
        ->where('liked', true)
        ->with('matchedUser') // Assuming relationship
        ->get();

        // fetch disliked matches
        $dislikedMatches = Matches::where('user_id', $user->id)
        ->where('liked', false)
        ->with('matchedUser')
        ->get();

        return view('portal.matches.index', compact('likedMatches', 'dislikedMatches'));
    }
    /**
     * Display a listing of the likes.
     */
    public function like($id)
    {
        $user = auth()->user();
        // store in the db
        Matches::updateOrCreate(
            ['user_id'=> $user->id, 'matched_user_id' => $id],
            ['liked' => true] //save liked
        );
        return back()->with('success', 'You Liked this match!'); //refresh page
    }

    /**
     * Show dislikes.
     */
    public function dislike($id)
    {
        $user = auth()->user();
        //store dislike in DB
        Matches::updateOrCreate(
            ['user_id' => $user->id, 'matched_user_id' => $id],
            ['liked'=> false] // save disliked
        );
        return back()->with('success', 'you disliked this match'); //refresh page
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
