<?php

namespace App\Http\Controllers\Users;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\User\UserResource;

class FollowingController extends Controller
{
    public function index(Request $request)
    {
        $followings = $request->user()->followings()->get();
        return UserResource::collection($followings);
    }

    public function store(Request $request, User $user)
    {
        $request->user()->followings()->attach($user->id);
        return response()->json();
    }



    public function destroy(Request $request, User $user)
    {
        $request->user()->followings()
            ->detach($user->id);
        return response()->json();
    }
}
