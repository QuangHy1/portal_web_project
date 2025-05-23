<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryRange extends Model
{
    use HasFactory;
    protected $table = 'salary_ranges';
    protected $fillable = ['name'];
}
