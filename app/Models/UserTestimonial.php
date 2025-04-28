<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserTestimonial extends Model
{
    protected $table = 'user_testimonials';
    protected $fillable = [
        'employee_id',
        'designation',
        'company',
        'image',
        'testimonial',
        'isFeatured',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
