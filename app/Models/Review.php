<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Approved reviews
     */
    public function scopeActive($query)
    {
        return $query->where('status','approved');
    }

    /**
     * Pending reviews
     */
    public function scopePending($query)
    {
        return $query->where('status','pending');
    }

    /**
     * Contested reviews
     */
    public function scopeContested($query)
    {
        return $query->where('status','contested');
    }

    /**
     * Company
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
