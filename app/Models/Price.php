<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
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
     * Get the package that the price belongs too
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
