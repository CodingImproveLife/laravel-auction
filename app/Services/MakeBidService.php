<?php

namespace App\Services;

use App\Http\Requests\StoreBidRequest;
use App\Models\Bid;
use App\Models\Lot;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class MakeBidService
{
    public Bid $bid;
    private StoreBidRequest $request;
    private Lot $lot;

    public function __construct(StoreBidRequest $request)
    {
        $this->request = $request;
        $this->lot = Lot::findOrFail($request->lot);
        $this->storeBid();
    }

    /**
     * Save the bid to the storage
     */
    private function storeBid()
    {
        Gate::authorize('store-bid', $this->lot);

        DB::transaction(function () {
            Bid::where('user_id', Auth::id())
                ->where('lot_id', $this->request->lot)
                ->update(['is_active' => false]);
            $this->bid = new Bid;
            $this->bid->price = $this->request->bid;
            $this->bid->lot_id = $this->request->lot;
            $this->bid->user_id = Auth::id();
            $this->bid->save();
        });
    }
}
