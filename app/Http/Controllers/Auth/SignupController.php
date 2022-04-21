<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Support\Facades\Validator;

class SignupController extends Controller
{
    public function Signup(Request $request, User $user)
    {


        $random = Str::random(10);

        // $phoneFo = '966'. ltrim($request->phone, '0');

        $reqData = $request->all();



        // $x = 'ali';

        $reqData['username'] = $reqData['username'] . $request->name . $random;
        $reqData['phone'] = '00966'.substr($reqData['phone'], -9);




        Validator::make($reqData, [
            'name' => ['required', 'alpha'],
            'username'  => ['string', 'unique:users'],
            'email' => ['required', 'email', 'unique:users,email'],
            // 'phone' => ['required','phone:mobile,SA'],
            'phone' => ['required','string','max:14'],
            'password' => ['required', 'integer', 'min:6'],
        ])->validate();


        $user = User::create([
            'name' => $reqData['name'],
            'username' => $reqData['username'],
            'email' => $reqData['email'],
            'phone' => $reqData['phone'],
            // 'phone' => '966'. ltrim($request->phone, '0'),
            // 'phone' => '966'. ltrim($request->phone, '0'),
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('key')->plainTextToken;
        return response()->json(['access_token' => $token]);
    }
}

