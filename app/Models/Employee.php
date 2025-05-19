<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Employee extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'user_id',
        'location_id',
        'firstname',
        'lastname',
        'designation',
        'photo',
        'website',
        'token',
        'phone',
        'address',
        'gender',
        'date_of_birth',
        'bio',
        'facebook',
        'instagram',
        'github',
        'isDeleted',
        'isverified',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
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
