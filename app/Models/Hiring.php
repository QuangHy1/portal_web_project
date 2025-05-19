<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hiring extends Model
{
    //
    use HasFactory;

    protected $table = 'hirings';
    protected $fillable = [
        'title',
        'description',
        'location_id',
        'employer_id',
        'salary_range_id',
        'company_id',
        'vacancy_id',
        'job_category_id',
        'job_type_id',
        'experience_id',
        'tags',
        'deadline',
        'education',
        'gender',
        'isfeatured',
        'isBoosted',
        'status',
        'token'
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    public function salaryRange()
    {
        return $this->belongsTo(SalaryRange::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function vacancy()
    {
        return $this->belongsTo(Vacancy::class);
    }

    public function jobCategory()
    {
        return $this->belongsTo(JobCategory::class);
    }

    public function jobType()
    {
        return $this->belongsTo(JobType::class);
    }


    public function experience()
    {
        return $this->belongsTo(Experience::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(EmployeeBookmark::class, 'hiring_id');
    }

    public function applications()
    {
        return $this->hasMany(EmployeeApplication::class, 'hiring_id');
    }
    public function boostedJob()
    {
        return $this->hasOne(BoostedJob::class)->latest();
    }
}
