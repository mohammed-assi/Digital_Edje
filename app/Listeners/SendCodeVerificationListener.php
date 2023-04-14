<?php

namespace App\Listeners;

use App\Events\SendCodeVerification;
use App\Mail\sendEmail;
use App\Models\Verification_code;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendCodeVerificationListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SendCodeVerification $event)
    {
        Verification_code::where('user_id',$event->user)->delete();

        $code  = mt_rand(1000,9999);
        Verification_code::create([
            'code' => $code,
            'user_id' => $event->user,
        ]);

        Mail::to($event->email)->send(new sendEmail($code));
    }
}
