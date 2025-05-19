<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoostedJob extends Model
{
    use HasFactory;
    protected $table = 'boosted_jobs';
    protected $fillable = [
        'hiring_id',
        'employer_id',
        'boost_order_id',
        'boosted_at',
        'expires_at',
    ];
    //
}
