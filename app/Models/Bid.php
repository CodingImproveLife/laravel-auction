<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;

    /**
     * Get the lot that the bid belongs to.
     */
    public function lot()
    {
        return $this->belongsTo(Lot::class);
    }
}
