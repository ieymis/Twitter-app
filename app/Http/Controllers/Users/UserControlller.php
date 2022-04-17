<?php

namespace App\Http\Controllers\Users;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\User\UserResource;

class UserControlller extends Controller
{
    public function index(User $user, Request $request)
    {
        $users = User::withIsFollowed()
            ->where('id', '!=', Auth::id());
        return UserResource::collection($users);
    }

}
