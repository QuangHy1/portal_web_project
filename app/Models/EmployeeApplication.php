<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeApplication extends Model
{
    protected $table = 'employee_applications';
    protected $fillable = [
        'employee_id',
        'hiring_id',
        'resume_id',
        'cover_letter',
        'status',
        'similarityScore'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function hiring() // Thay job() bằng hiring()
    {
        return $this->belongsTo(Hiring::class);
    }

    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }
}
