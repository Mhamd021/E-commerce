<?php

namespace App\Listeners;

use App\Event\UserOrdered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNotification
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
     * @param  \App\Event\UserOrdered  $event
     * @return void
     */
    public function handle(UserOrdered $event)
    {
        //
    }
}
