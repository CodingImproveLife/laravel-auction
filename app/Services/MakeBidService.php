<?php

namespace App\Services;

use App\Http\Requests\StoreBidRequest;
use App\Models\Bid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MakeBidService
{
    public Bid $bid;
    private StoreBidRequest $request;

    public function __construct(StoreBidRequest $request)
    {
        $this->request = $request;
        $this->storeBid();
    }

    /**
     * Save the bid to the storage
     */
    private function storeBid()
    {
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
