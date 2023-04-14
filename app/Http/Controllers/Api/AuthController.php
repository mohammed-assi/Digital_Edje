<?php

namespace App\Http\Controllers\Api;

use App\Events\SendCodeVerification;
use App\Http\Controllers\Controller;
use App\Http\Requests\auth\loginRequest;
use App\Http\Requests\auth\RegisterRequest;
use App\Mail\sendEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'FirstName' => $request->FirstName,
            'LastName' => $request->LastName,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password)
        ]); 
        $token = $user->createToken('auth_token')->plainTextToken;
        if(isset($request['email'])){
            event(new SendCodeVerification($request['email'] , $user->id));
        }        
        return success_response(['access_token' => $token, 'token_type' => 'Bearer',]);  
    }

    public function login(loginRequest $request)
    {        
        $user = User::where('email', $request['email'])->orWhere('phone', $request['phone'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;
        return success_response(['access_token' => $token,'token_type' => 'Bearer',]);
    }

    public function logout(Request $request)
    { 
        $request->user()->currentAccessToken()->delete();
        return success_response( ['message' => 'user logged out']);
    }
}
