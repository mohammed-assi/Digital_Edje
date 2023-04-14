<?php

namespace App\Http\Controllers\Api;

use App\Events\GenerateResetCodeEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordReset\CheckRequest;
use App\Http\Requests\PasswordReset\ResetRequest;
use App\Http\Requests\PasswordReset\SendResetRequest;
use App\Mail\ResetPassword;
use App\Mail\sendEmail;
use App\Models\Customer;
use App\Models\PasswordResetCode;
use App\Models\Teacher;
use App\Models\User;
use App\Trait\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PasswordResetController extends Controller
{

    public function send_reset(SendResetRequest $request)
    {
        event(new GenerateResetCodeEvent($request['email']));
        $code = PasswordResetCode::with(['user'])->orderBy('created_at', 'desc')->first();
        $name = $code->user->email;
        Mail::to($request['email'])->send(new ResetPassword($code->code, $name));

        return success_response();
    }

    public function check(CheckRequest $request)
    {
        if ($this->checkCode($request['code'], $request['email'])) {
            return success_response();
        }
        return error_response('Invalid');
    }

    public function reset(ResetRequest $request)
    {
        if ($this->checkCode($request['code'], $request['email'])) {
          User::where('email', $request['email'])->first()->update([
                'password' => Hash::make($request['password']),
            ]);
            return success_response();
        }
        return error_response('Invalid');
    }

    public function checkCode($code, $email)
    {
        $user = User::where('email', $email)->first();
        $code = PasswordResetCode::where('user_id', $user->id)
              ->where('code', $code)->first();
        if ($code) { return true;}
        return false;
    }
}
