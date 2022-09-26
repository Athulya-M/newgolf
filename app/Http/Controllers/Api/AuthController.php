<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Password; 
class AuthController extends Controller
{


  public function login(Request $request)
    {
        $credentials=[
            'email' => $request->email,
            'password' => $request->password,
        ];
        if(auth()->attempt($credentials)){
            //generate the token for the user
            $user_login_token = auth()->user()->createToken('PassportExample@Section.io')->accessToken;
            //now return this token on success login attempt
            return response()->json(['token' => $user_login_token], 200);
        }
        else{
            //wrong login credentials, return, user not authorised to our system, return error code 401
            return response()->json(['error' => 'UnAuthorised Access'], 401);
        }
    }
    
}
