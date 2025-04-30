<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employer extends Model
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
    public function getEmployerNameAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }
    // get + TênThuộcTính + Attribute
    // cơ chế "magic method" (phương thức kỳ diệu) của Laravel
    // ko cân $employer_name vẫn tự động nhận biết đc nên có thể dùng "$employer->employer_name" bất đâu.
}
