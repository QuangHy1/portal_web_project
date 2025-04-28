<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'editor_id',
        'title',
        'slug',
        'content',
        'status',
        'image',
        'view_count',
        'category',
        'tags',
        'published_at',
    ];

    public function editor(): BelongsTo
    {
        return $this->belongsTo(Editor::class);
    }

    protected $casts = [
        'view_count' => 'integer',
    ];
}
