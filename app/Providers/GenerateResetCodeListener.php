<?php

namespace App\Providers;

use App\Providers\GenerateResetCodeEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GenerateResetCodeListener
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
    public function handle(GenerateResetCodeEvent $event): void
    {
        //
    }
}
