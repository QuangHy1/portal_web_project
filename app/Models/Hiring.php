<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hiring extends Model
{
    //
    use HasFactory;
    public function bookmarks()
    {
        return $this->hasMany(EmployeeBookmark::class, 'hiring_id');
    }

    public function applications()
    {
        return $this->hasMany(EmployeeApplication::class, 'hiring_id');
    }
}
