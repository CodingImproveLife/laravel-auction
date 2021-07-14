<?php

namespace App\Services\Lot;

use App\Models\Lot;
use Illuminate\Support\Facades\Gate;

class DeleteService
{
    /**
     * Delete a lot from storage.
     *
     * @param int $id
     */
    public static function delete(int $id): void
    {
        $lot = Lot::findOrFail($id);

        Gate::authorize('edit-lot', $lot);

        $lot->delete();
    }
}
