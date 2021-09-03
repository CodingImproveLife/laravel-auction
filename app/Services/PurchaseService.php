<?php

namespace App\Services;

use App\Events\LotPurchasedEvent;
use App\Models\Bid;
use App\Models\Lot;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PurchaseService
{
    private Purchase $purchase;
    private Lot $lot;
    private ?Bid $bid = null;

    public function __construct(Purchase $purchase)
    {
        $this->purchase = $purchase;
    }

    /**
     * Save the purchase to the storage. If there are no bids, return the lot to draft.
     *
     * @param Lot $lot
     */
    public function save(Lot $lot)
    {
        $this->lot = $lot;

        $this->bid = $this->auctionWinnerBid();

        if (isset($this->bid)) {
            $this->confirmLotPurchase();
            event(new LotPurchasedEvent($this->purchase));
        } else {
            $this->setLotStatus('draft');
        }
    }

    /**
     * Make a purchase.
     */
    private function confirmLotPurchase()
    {
        DB::transaction(function () {
            $this->storePurchase();

            $this->setLotStatus('sold');

            $this->setAllBidsInactive();

            $this->paymentProcess();
        });
    }

    /**
     * Get the maximum lot bid.
     *
     * @return Bid|null
     */
    private function auctionWinnerBid(): ?Bid
    {
        return Bid::where('lot_id', $this->lot->id)->orderBy('price', 'desc')->first();
    }

    /**
     * Set a new lot status.
     *
     * @param string $status
     */
    private function setLotStatus(string $status)
    {
        $this->lot->update(['status' => $status]);
    }

    /**
     * Store lot purchase.
     */
    private function storePurchase()
    {
        $this->purchase->lot_id = $this->lot->id;
        $this->purchase->user_id = $this->bid->user_id;
        $this->purchase->price = $this->bid->price;
        $this->purchase->save();
    }

    /**
     * Set all bids for this lot inactive.
     */
    private function setAllBidsInactive()
    {
        Bid::where('lot_id', $this->lot->id)->update(['is_active' => false]);
    }

    /**
     * Increase the seller's balance and decrease the buyer's balance.
     */
    private function paymentProcess()
    {
        User::find($this->bid->user_id)->decrement('balance', $this->bid->price);

        User::find($this->lot->user_id)->increment('balance', $this->bid->price);
    }
}
