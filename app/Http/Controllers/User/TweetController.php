<?php

namespace App\Http\Controllers\User;

use App\Models\Tweet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TweetController extends Controller
{

    public function index(Tweet $tweet)
    {

        $tweets = Tweet::all()->join('users','users.id','=','tweets.user.id');

        return $tweets;
    }


public function store(Request $request)
{
    $request->validate([
        'message' => ['required', 'max:280']

    ]);
  $tweet = $request->user()->tweets()->create([
    'message' => $request->message
  ]);

  return ['status' => 'Tweet Sent!'];
}



//     public function show(Tweet $tweet)
//     {
//         return new($tweet);
//     }

//     public function update(Request $request, Tweet $tweet)
//     {
//         $request->validate([
//             'message' => ['required', 'max:280']
//         ]);

//         $tweet->update([
//             'message' => $request->body
//         ]);
//         return new $tweet ;
//     }

//     public function destroy(Tweet $tweet)
//     {
//         Tweet::where('id', $tweet->id)->delete();
//     }
// }

}
