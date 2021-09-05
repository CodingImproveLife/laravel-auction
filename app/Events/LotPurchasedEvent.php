<?php

namespace App\Events;

use App\Models\Lot;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LotPurchasedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Purchase $purchase;
    public User $buyer;
    public Lot $lot;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Purchase $purchase)
    {
        $this->purchase = $purchase;
        $this->buyer = $purchase->user;
        $this->lot = $purchase->lot;
    }
}
