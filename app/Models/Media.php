<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
