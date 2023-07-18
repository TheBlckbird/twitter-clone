<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    /**
     * Create the controller instance.
     */
    public function __construct()
    {
        $this->authorizeResource(Tweet::class, 'tweet');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tweets = Tweet::with('user')
            ->latest()
            ->select(['id', 'user_id', 'body', 'likes_count', 'retweets_count', 'comments_count', 'created_at'])
            ->get();

        // $tweets->each(function (Tweet $item) {
        //     $item->load('user:email');
        // }); //->load('user:email');

        return inertia('Tweet/Index', [
            'tweets' => $tweets,
            'currentUserId' => auth()->user()->id,
            'currentUserEmail' => auth()->user()->email,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $tweet = new Tweet([
            'body' => $request->body,
        ]);

        $request->user()->tweets()->save($tweet);

        return redirect()->route('tweets.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tweet $tweet)
    {
        // FIXME: I won’t fix this, but it’s bad...
        // Future me here: what is bad about this code?
        $tweet->load('user:id,name,email');

        return inertia('Tweet/Show', [
            'tweet' => $tweet,
            'comments' => $tweet->comments()->latest()->with('user:id,name')->select(['id', 'body', 'user_id', 'created_at'])->get(),
            'currentUserId' => auth()->user()->id,
            'currentUserEmail' => auth()->user()->email,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tweet $tweet)
    {
        return inertia('Tweet/Edit', [
            'tweet' => $tweet,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tweet $tweet)
    {
        $request->validate([
            'body' => 'required|string|max:255',
        ]);

        $tweet->update([
            'body' => $request->body,
        ]);

        return redirect()->route('tweets.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tweet $tweet)
    {
        $tweet->delete();

        return redirect()->route('tweets.index');
    }
}
