<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeBookmark extends Model
{
    //
    use HasFactory;
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function hiring()
    {
        return $this->belongsTo(Hiring::class);
    }
}
