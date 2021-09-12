<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function getUserPurchases()
    {
        return Purchase::with('lot:id,user_id,name', 'lot.user:id,name')
            ->where('user_id', Auth::id())
            ->paginate(5);
    }
}
