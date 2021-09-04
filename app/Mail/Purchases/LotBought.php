<?php

namespace App\Mail\Purchases;

use App\Models\Lot;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LotBought extends Mailable
{
    use Queueable, SerializesModels;

    public Lot $lot;
    public int $price;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Lot $lot, int $price)
    {
        $this->lot = $lot;
        $this->price = $price;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.purchases.lot-bought');
    }
}
