<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    //
    use HasFactory;
    public function hirings()
    {
        return $this->hasMany(Hiring::class);
    }
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
