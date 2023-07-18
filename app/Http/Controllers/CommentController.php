<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Tweet;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Create the controller instance.
     */
    public function __construct()
    {
        $this->authorizeResource(Comment::class, 'comment');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Tweet $tweet, Request $request)
    {
        $request->validate([
            'body' => 'required|string|max:255',
        ]);

        $comment = Comment::create([
            'user_id' => auth()->user()->id,
            'tweet_id' => $tweet->id,
            'body' => $request->body,
        ]);

        return redirect()->route('tweets.show', $comment->tweet_id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'body' => 'required|string|max:255',
        ]);

        $comment->update([
            'body' => $request->body,
        ]);

        return redirect()->route('tweets.show', $comment->tweet_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tweet $tweet, Comment $comment)
    {
        $comment->delete();

        return redirect()->route('tweets.show', $comment->tweet_id);
    }
}
