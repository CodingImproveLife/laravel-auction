<?php

namespace App\Services\Lot;

use App\Http\Requests\StoreLotRequest;
use App\Models\Lot;
use Illuminate\Support\Facades\Auth;

class StoreService
{
    public function __construct(StoreLotRequest $request)
    {
        $this->request = $request;
        $this->lot = new Lot;
    }

    /**
     * Save a new lot.
     */
    public function saveLot()
    {
        $this->lot->name = $this->request->title;
        $this->lot->description = $this->request->description;
        $this->lot->start_price = $this->request->price;
        $this->lot->user_id = Auth::id();
        $this->lot->save();
    }
}
