<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function media()
    {
        return $this->hasMany(Media::class,'gallery_id','id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
