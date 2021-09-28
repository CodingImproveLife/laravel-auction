<?php

namespace App\Http\Controllers;

use App\Http\Resources\PurchaseResource;
use App\Models\Purchase;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PurchaseController extends Controller
{
    /**
     * Get user purchases with lot and seller name.
     *
     * @return AnonymousResourceCollection
     */
    public function getUserPurchases()
    {
        return PurchaseResource::collection(Purchase::with('lot:id,user_id,name', 'lot.user:id,name')
            ->where('user_id', auth('sanctum')->id())
            ->orderByDesc('created_at')
            ->paginate(5));
    }
}
