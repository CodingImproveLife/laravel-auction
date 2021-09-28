<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'lot_id' => $this->lot_id,
            'lot_name' => $this->lot->name,
            'price' => $this->price,
            'seller' => $this->lot->user->name,
            'created_at' => $this->created_at->toDayDateTimeString(),
        ];
    }
}
