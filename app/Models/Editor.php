<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Editor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'location_id',
        'full_name',
        'date_of_birth',
        'gender',
        'phone',
        'address',
        'bio',
        'avatar',
        'post_count',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
