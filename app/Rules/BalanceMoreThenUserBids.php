<?php

namespace App\Rules;

use App\Models\Bid;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class BalanceMoreThenUserBids implements Rule
{
    /**
     * The sum of all the user's bids must be less than the current balance.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $sumAllUserActiveBids = Bid::where('user_id', Auth::id())->where('is_active', true)->sum('price');
        return Auth::user()->balance >= (int)$value + $sumAllUserActiveBids;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "You don't have enough money to make this bid";
    }
}
