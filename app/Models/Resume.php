<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    protected $table = 'resumes';
    protected $fillable = [
        'employee_id',
        'file_path',
        'file_name',
        'file_type',
        'title',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
