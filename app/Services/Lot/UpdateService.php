<?php

namespace App\Services\Lot;

use App\Http\Requests\StoreLotRequest;
use App\Models\Lot;
use Illuminate\Support\Facades\Gate;

class UpdateService
{
    /**
     * Update a lot in storage.
     *
     * @param StoreLotRequest $request
     * @param int $id
     */
    public static function update(StoreLotRequest $request, int $id)
    {
        $lot = Lot::findOrFail($id);

        Gate::authorize('edit-lot', $lot);

        $lot->name = $request->title;
        $lot->description = $request->description;
        $lot->start_price = $request->price;
        $lot->save();
    }
}
