<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    //
    use HasFactory;
    protected $table = 'packages';
    protected $fillable = [
        'name',
        'price',
        'duration',
        'duration_type',
        'jobs_count',
        'featured_count',
        'photos_count',
        'videos_count',
        'button',
    ];
}
