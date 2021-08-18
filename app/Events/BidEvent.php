<?php

namespace App\Events;

use App\Models\Bid;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BidEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public int $lot_id;
    public int $bid_price;
    public int $unique_bids;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Bid $bid)
    {
        $this->lot_id = $bid->lot_id;
        $this->bid_price = $bid->price;
        $this->unique_bids = $bid->lot->number_of_unique_bids;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel
     */
    public function broadcastOn()
    {
        return new Channel('Bid');
    }

    /**
     * Event name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'NewBid';
    }
}
