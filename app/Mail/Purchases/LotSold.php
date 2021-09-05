<?php

namespace App\Mail\Purchases;

use App\Models\Lot;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LotSold extends Mailable
{
    use Queueable, SerializesModels;

    public Lot $lot;
    public User $buyer;
    public int $price;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Lot $lot, User $buyer, int $price)
    {
        $this->lot = $lot;
        $this->buyer = $buyer;
        $this->price = $price;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.purchases.lot-sold');
    }
}
