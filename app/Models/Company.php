<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'address_data' => 'array'
    ];
    // field is json in db

    public function scopeActive($query)
    {
        return $query->where('companies.status', 'active');
    }
    public function scopeDraft($query)
    {
        return $query->where('companies.status', 'draft');
    }
    public function scopePending($query)
    {
        return $query->where('companies.status', 'pending');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the services for this company
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function services()
    {
        return $this->belongsToMany(Service::class)->withPivot('code','description','approved','approved_at','image','radius_covered');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function stats()
    {
        return $this->hasMany(CompanyStat::class);
    }

    public function references()
    {
        return $this->hasMany(Reference::class);
    }

    public function gallery()
    {
        return $this->hasMany(Gallery::class);
    }

    public function media()
    {
        return $this->hasMany(Media::class);
    }


}
