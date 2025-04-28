<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageHomeItem extends Model
{
    use HasFactory;
    protected $table = 'page_home_items';
    protected $fillable = [
        'heading',
        'description',
        'image',
        'job_placeholder',
        'job_button',
        'location_placeholder',
        'category_placeholder',
        'job_category_heading',
        'job_category_description',
        'job_category_status'
    ];
}
