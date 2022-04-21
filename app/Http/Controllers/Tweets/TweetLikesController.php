<?php

namespace App\Http\Controllers\Tweets;

use App\Models\User;
use App\Models\Tweet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Tweet\TweetResource;

class TweetLikesController extends Controller
{
    public function store( Tweet $tweet,Request $request)
    {
        $Liked = $tweet->likes()->where('user_id', Auth::id())->exists();
        if (!$Liked) {
            $tweet->likes()->create([
                'user_id' => $request->user()->id,
            ]);
        }

        return  new TweetResource($tweet);
    }


    public function destroy( Tweet $tweet,Request $request,)
    {
        $tweet->likes()->where('user_id', $request->user()->id)->delete();

        return response()->json();
    }

}




        // public function dislike($user=null){

        //   return $this->like($user,false);

        //     }


    // public function isLikedBy(User $user){

    //  $this->likes()->where('user_id',$user->id)->exit();

    // }



    // public function tweetList()
    // {
    //     $tweets = Tweet::all();


    // }

    // public function store($id,Request $request )
    // {





    //         $tweet = Tweet::find($id);
    //         $tweet->like();
    //         $tweet->save();

    //         return redirect()->route('tweet.list')->with('message','tweet Like successfully!');







        //   $tweet->like(current_user());
        // $user = User::get();

        // request()->user()(new LikedTweet( $user ));

        // return back();

// $request->user()->likes()->create([


//   'tweet_id',$tweet->id;


// ]);

// $request->user()->likes()->attach($user->id);
// return response()->json();


//     $request->user()->likes()->attach($tweetId);
//     return response()->json();
//     }
// }

//     public function unlike(Request $request, User $user)
//     {
// $request->user()->likes->where('tweet_id',$tweet->id)->first()->delete();
//     }


//     }

// }

// }

// if (!$like) {
//     $tweet->likes()->create([
//         'user_id' => $request->user()->id,
//     ]);



