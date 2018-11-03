<?php

namespace App\Listeners;

use App\Events\=ViewPostHander;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNotificationAfterViewPost
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  =ViewPostHander  $event
     * @return void
     */
    public function handle(=ViewPostHander $event)
    {
        //
    }
}
