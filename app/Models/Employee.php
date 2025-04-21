<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    use HasFactory;

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
    public function bookmarks()
    {
        return $this->hasMany(EmployeeBookmark::class, 'employee_id');
    }

    public function applications()
    {
        return $this->hasMany(EmployeeApplication::class, 'employee_id');
    }
}
