<?php

namespace App\Http\Controllers;

use App\Http\Resources\PurchaseResource;
use App\Models\Purchase;

class PurchaseController extends Controller
{
    public function getUserPurchases()
    {
        return PurchaseResource::collection(Purchase::with('lot:id,user_id,name', 'lot.user:id,name')
            ->where('user_id', auth('sanctum')->id())
            ->paginate(5));
    }
}
