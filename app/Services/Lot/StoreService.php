<?php

namespace App\Services\Lot;

use App\Http\Requests\StoreLotRequest;
use App\Models\Lot;
use App\Models\LotImage;
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

        if (!empty($this->request->image)) {
            $this->saveImage($this->request->image, $this->lot->id);
        }
    }

    /**
     * Save images for the lot.
     */
    private function saveImage(array $images, int $lotId)
    {
        foreach ($images as $image) {
            $lotImage = new LotImage;
            $lotImage->path = $image->store('lots', 'public');
            $lotImage->lot_id = $lotId;
            $lotImage->save();
        }
    }
}
