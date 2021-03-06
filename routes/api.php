<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Users\UserController;
use App\Http\Controllers\Auth\SignupController;
use App\Http\Controllers\Tweets\TweetController;
use App\Http\Controllers\Tweets\CommentController;
use App\Http\Controllers\Tweets\RetweetController;
use App\Http\Controllers\Users\FollowingController;
use App\Http\Controllers\Tweets\TweetLikesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
// |
// */

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [LoginController::class, 'login']);

Route::prefix('users')->group(function () {
    Route::post('signup', [SignupController::class, 'signup']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('{user_id}/tweets', [TweetController::class, 'index']);
        Route::post('tweets', [TweetController::class, 'store']);
        Route::get('tweets/{tweet}', [TweetController::class, 'show']);
        Route::put('tweets/{tweet}', [TweetController::class, 'update']);
        Route::delete('tweets/{tweet}', [TweetController::class, 'destroy']);
        // likes
        Route::post('tweets/{tweet}/like', [TweetLikesController::class, 'store']);
        Route::delete('tweets/{tweet}/unlike', [TweetLikesController::class, 'destroy']);
        // retweet
        Route::post('tweets/{tweet}/retweet', [RetweetController::class, 'store']);
        Route::delete('tweets/{tweet}/unretweet', [RetweetController::class, 'destroy']);
        // comment
        Route::post('tweets/{tweet}/comment', [CommentController::class, 'store']);






        ///////////////////////////////////////////////////////////////////////////////////////////////

        Route::get('people/follow', [FollowingController::class, 'index']);
        Route::get('people', [FollowingController::class, 'show']);
        Route::post('people/{user}/follow', [FollowingController::class, 'store']);
        Route::delete('people/{user}/unfollow', [FollowingController::class, 'destroy']);

        //
        Route::get('people', [UserController::class, 'index']);
    });
});
