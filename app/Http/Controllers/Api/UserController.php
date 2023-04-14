<?php

namespace App\Http\Controllers\Api;

use App\Events\SendCodeVerification;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Requests\User\UpdateProfileRequest;
use App\Http\Requests\User\VerifiyRequest;
use App\Models\product;
use App\Models\User;
use App\Models\Verification_code;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function verifiy(VerifiyRequest $request){
        $code  = Verification_code::where('user_id',auth()->user()->id)->first();
        if( ($request['code'] == $code->code) && (auth()->user()->id == $code->user_id) ){
            User::find(auth()->user()->id)->first()->update( ['email_verified_at' => now()]);
            $code->delete();
            return success_response();
        }
        return error_response("invalid code");
    }

    public function resend_verification_code(){
        $code  = Verification_code::where('user_id',auth()->user()->id)->delete();
        event(new SendCodeVerification(auth()->user()->email , auth()->user()->id));
        return success_response();
    }

    public function profile(Request $request){
        return $request->user();
    }

    public function update_profile(UpdateProfileRequest $request){        
        $auth_id = auth()->id();
        $user = User::query()->where('id',$auth_id)->first();
        $user->update([
            'FirstName' => $request->FirstName,
            'LastName' => $request->LastName,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);
    }

    public function changePassword(ChangePasswordRequest $request){
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return error_response("error Old Password Doesn't match!");
        }
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        return success_response("status Password changed successfully!");
    }

    public function my_Product(){
        return success_response(product::where('user_id',auth()->user()->id)->simplePaginate(5));
    }
}
