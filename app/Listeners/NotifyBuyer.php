<?php

namespace App\Listeners;

use App\Events\LotPurchasedEvent;

class NotifyBuyer
{
    /**
     * Handle the event.
     *
     * @param  LotPurchasedEvent  $event
     * @return void
     */
    public function handle(LotPurchasedEvent $event)
    {
        //
    }
}
