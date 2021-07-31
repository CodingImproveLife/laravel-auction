<?php

namespace App\Services;

use App\Models\Bid;
use App\Models\Lot;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PurchaseService
{
    private Purchase $purchase;

    public function __construct(Purchase $purchase)
    {
        $this->purchase = $purchase;
    }

    public function store(Lot $lot)
    {
        $bid = $this->auctionWinner($lot->id);
        if(isset($bid)) {
            $this->sellLot($lot, $bid);
        } else {
            $lot->update(['status' => 'draft']);
        }
    }

    private function sellLot(Lot $lot, Bid $bid)
    {
        DB::transaction(function () use ($lot, $bid) {
            $this->purchase->lot_id = $lot->id;
            $this->purchase->user_id = $bid->user_id;
            $this->purchase->price = $bid->price;
            $this->purchase->save();

            $lot->update(['status' => 'sold']);

            Bid::where('lot_id', $lot->id)->update(['is_active' => false]);

            User::find($bid->user_id)->decrement('balance', $bid->price);

            User::find($lot->user_id)->increment('balance', $bid->price);
        });
    }

    private function auctionWinner(int $lotId): ?Bid
    {
        return Bid::where('lot_id', $lotId)->orderBy('price', 'desc')->first();
    }
}
