<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Lot extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the user that owns the lot.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get lot images.
     */
    public function images()
    {
        return $this->hasMany(LotImage::class);
    }

    /**
     * Get lot bids.
     */
    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    /**
     * Get lot status
     *
     * @param string $value
     * @return string
     */
    public function getStatusAttribute($value)
    {
        if ($value === 'sale') return 'On sale';
        if ($value === 'sold') return 'Sold';
        return 'Draft';
    }

    /**
     * Deleting a folder with images after deleting a lot.
     */
    protected static function booted()
    {
        static::deleted(function ($lot) {
            $lot->images()->delete();
            Storage::disk('local')->deleteDirectory('public/lots/' . $lot->id);
        });
    }
}
