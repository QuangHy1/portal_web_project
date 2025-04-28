<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopBar extends Model
{
    use HasFactory;
    protected $table = 'top_bars';
    protected $fillable = ['topbar_contact', 'topbar_center_text', 'isHidden'];
    protected $casts = [
        'isHidden' => 'boolean',
    ];
}
