<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
     * Get the category the lot belongs to.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get lot status.
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
     * Get lot sale timestamp.
     *
     * @return int
     */
    public function getSaleTimestampAttribute()
    {
        return Carbon::create($this->end_time)->timestamp;
    }

    /**
     * Get the starting price of the lot or the maximum bid value.
     *
     * @param int $value
     * @return mixed
     */
    public function getStartPriceAttribute($value)
    {
        return $this->bids->isNotEmpty() ? $this->bids->max('price') : $value;
    }

    /**
     * Get short lot name.
     *
     * @return string
     */
    public function getShortNameAttribute()
    {
        return Str::limit($this->name, 20);
    }

    /**
     * Get short lot description without HTML tags.
     *
     * @return string
     */
    public function getShortDescriptionAttribute()
    {
        return strip_tags(Str::limit($this->description, 40));
    }

    /**
     * Get the number of unique bids for the lot.
     *
     * @return int
     */
    public function getNumberOfUniqueBidsAttribute()
    {
        return $this->bids->groupBy('user_id')->count();
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
