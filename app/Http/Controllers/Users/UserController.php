<?php

namespace App\Http\Controllers\Users;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\User\UserResource;

class UserController extends Controller
{
    public function index(User $user, Request $request)
    {
        $users = User::where('id', '!=', Auth::id())->with('followers')->get();

        // $users = User::all();

        // $isfollowed = Auth::user()->followers()->where('user_id', '!=', Auth::id())->paginate(5);
        // return $isfollowed;
        // if (!$isfollowed) {

        //     $isfollowed->following()->get();


        // }

        // return $users;



        return UserResource::collection($users);
    }
}

