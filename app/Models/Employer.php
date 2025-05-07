<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Models\User; // Thêm dòng này để sử dụng model User

class Employer extends Model implements Authenticatable
{
    protected $table = 'employers';
    protected $fillable = [
        'user_id',
        'company_id',
        'location_id',
        'industry_id',
        'firstname',
        'lastname',
        'phone',
        'address',
        'gender',
        'date_of_birth',
        'about',
        'hours_monday',
        'hours_tuesday',
        'hours_wednesday',
        'hours_thursday',
        'hours_friday',
        'hours_saturday',
        'hours_sunday',
        'facebook',
        'instagram',
        'github',
        'token',
        'isverified',
        'isSuspended'
    ];

    // Các quan hệ
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function industry()
    {
        return $this->belongsTo(Industry::class);
    }

    public function countEmployer()
    {
        return $this->hasMany(Hiring::class, 'employer_id', 'id');
    }

    // Thuộc tính "employer_name"
    public function getEmployerNameAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    // Các phương thức của Authenticatable
    public function getAuthIdentifier()
    {
        return $this->getKey(); // Trả về ID của Employer (thường là cột 'id')
    }

    public function getAuthIdentifierName()
    {
        return 'id'; // Tên của trường ID
    }

    // Lấy mật khẩu từ bảng users
    public function getAuthPassword()
    {
        return $this->user->password; // Lấy mật khẩu từ bảng users (mối quan hệ user)
    }

    public function getAuthPasswordName()
    {
        return 'password'; // Trả về tên trường mật khẩu trong bảng users
    }

    // Phương thức nhớ token (remember me)
    public function getRememberToken()
    {
        return $this->remember_token; // Nếu bạn sử dụng "remember me"
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token'; // Tên trường token nhớ
    }
}
