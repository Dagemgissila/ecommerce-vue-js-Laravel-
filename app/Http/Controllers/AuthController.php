<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request){
       $credentials=$request->validate([
              "email"=>["required","email"],
              "password"=>["required"],
              "remember"=>"boolean"
       ]);

       $remember=$credentials["remember"] ?? false;
       if(!Auth::attempt($credentials,$remember)){
        return response([
            "message"=>"Email or Pasword is incorrect"
        ],422);
       }

       $user=Auth::user();

       if(!$user->is_admin){
        return response([
            "message"=>"you dont have permission to authenticate as admnin"
        ],403);
       }
       $token=$user->createToken("main")->plainTextToken;

       return response([
        "user"=>new UserResource($user),
        "token"=>$token
       ]);
    }

    public function logout(){
        /** @var User */
        $user=Auth::user();
        $user->currentAccessToken()->delete();
        return response("",203);
    }

    public function getUser(Request $request)
    {
        return new UserResource($request->user());
    }
}
