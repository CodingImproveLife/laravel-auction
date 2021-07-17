<?php

namespace App\Http\Controllers;

use App\Models\LotImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class LotImageController extends Controller
{
    /**
     * Remove lot image from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id)
    {
        $lotImage = LotImage::findOrFail($id);
        Gate::authorize('edit-lot', $lotImage->lot);
        Storage::disk('local')->delete('public/' . $lotImage->path);
        $lotImage->delete();
        return back()->with('success', 'Image delete successfully.');
    }
}
