<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Matches;

class MatchController extends Controller
{
    public function index()
    {
        //
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
            ['liked' => true]
        );
        return back(); //refresh page
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
            ['liked'=> false]
        );
        return back(); //refresh page
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
