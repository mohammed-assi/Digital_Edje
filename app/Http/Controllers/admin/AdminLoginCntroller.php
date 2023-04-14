<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\Login\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminLoginCntroller extends Controller
{
    
    public function index()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request){
        if ( !Auth::attempt($request->only('email', 'password'))  ) {
            return view('auth.login');// Invalid_Login();
        }
        return view('home.index');
    }
    
}
