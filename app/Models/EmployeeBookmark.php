<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeBookmark extends Model
{
    //
    use HasFactory;
    protected $fillable = ['employee_id', 'hiring_id'];
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function hiring()
    {
        return $this->belongsTo(Hiring::class);
    }
    public function jobType()
    {
        return $this->belongsTo(JobType::class, 'job_type_id');
    }

}
