<?php

namespace App\Http\Controllers\Tweets;

use App\Models\Tweet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Tweet\TweetResource;

class TweetController extends Controller
{

    public function index($user_id)
    {
        // $tweets = Tweet::join('users', 'users.id', '=', 'tweets.user_id')->get();
        $tweets = Tweet::where('user_id', $user_id)->get();

        // $tweets = Tweet::select('tweets.*', 'users.email', 'users.username')->join('users', 'users.id', '=', 'tweets.user_id')->where('tweet', 'user_id')->get();
        return $tweets;
        // return new TweetResource($tweet);
    }


    public function store(Request $request)
    {
        $request->validate([
            'message' => ['required', 'string', 'max:280']

        ]);
        $tweet = $request->user()->tweets()->create([
            'message' => $request->message
        ]);

        // return ['status' => 'Tweet Sent!'];
        return new TweetResource($tweet);
    }



    public function show(Tweet $tweet)
    {
        // return $tweet;
        return new TweetResource($tweet);
    }

    public function update(Request $request, Tweet $tweet)
    {
        $request->validate([
            'message' => ['required','string']
        ]);
        $tweet->update([
            'message' => $request->message
        ]);
        // return $tweet;
        return new TweetResource($tweet);
    }

    public function destroy(Tweet $tweet)
    {
        $tweet->delete();
    }
}
