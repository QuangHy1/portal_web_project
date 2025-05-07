<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
//    public string $password;
    protected $fillable = [
        'username',
        'email',
        'password',
        'role_id',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'active' => 'Hoạt động',
            'inactive' => 'Không hoạt động',
            'banned' => 'Bị chặn',
            default => 'Không rõ',
        };
    }

    public function getRoleBadgeHtml(): string
    {
        $role = \App\Models\Role::find($this->role_id);
        if (!$role) {
            return '<span class="badge bg-secondary">Không xác định</span>';
        }

        // Gán màu theo id, hoặc tạo bảng màu cố định
        $colors = [
            'bg-danger',
            'bg-warning',
            'bg-primary',
            'bg-success',
            'bg-info',
            'bg-dark',
            'bg-secondary',
        ];

        // Dùng role_id để "random nhẹ" nhưng ổn định
        $colorClass = $colors[$this->role_id % count($colors)];

        return '<span class="badge ' . $colorClass . '">' . e($role->name) . '</span>';
    }


    public function isAdmin(): bool
    {
        return $this->role_id === 1;
    } // gán role_id === 1 cho phương thức isAdmin()

//    public function employer()
//    {
//        return $this->hasOne(Employer::class);
//    }
    public function employer()
    {
        return $this->hasOne(Employer::class, 'user_id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function employee()
    {
        return $this->hasOne(Employee::class);
    }

}
