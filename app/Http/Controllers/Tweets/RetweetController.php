<?php

namespace App\Http\Controllers\Tweets;

use App\Models\Tweet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Tweet\TweetResource;

class RetweetController extends Controller
{
    public function store(Request $request, Tweet $tweet)
    {

        $tweet = $request->user()->tweets()->create([
         
            'orignalTweet' => $tweet->id,
        ]);
        return new TweetResource($tweet);
    }



    public function destroy( Tweet $tweet,Request $request,)
    {
        $tweet = Tweet::where('id', $tweet->id)->delete();

        return response()->json();

    }
}
