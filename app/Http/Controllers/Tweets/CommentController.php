<?php

namespace App\Http\Controllers\Tweets;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Tweet\TweetResource;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|max:25',
            'tweetid' => 'required|numeric'
        ]);

        Comment::create([
            'user_id' => Auth::id(),
            'message' => $request->message,
            'tweets_id' => $request->tweetid
        ]);


    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
    }
}

