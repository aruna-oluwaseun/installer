<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeActive($query)
    {
        return $query->where('status','active');
    }

    public function scopeDraft($query)
    {
        return $query->where('status','draft');
    }

    public function scopeSoon($query)
    {
        return $query->where('status','soon');
    }

    /**
     * Show both active and coming soon prices
     */
    public function scopeAvailable($query)
    {
        return $query->whereIn('status',['active','soon']);
    }

    /**
     * Get the pricing options for a product
     */
    public function prices()
    {
        return $this->hasMany(Price::class);
    }

    /**
     * Get the listed features for product
     */
    public function features()
    {
        return $this->belongsToMany(Feature::class);
    }
}
