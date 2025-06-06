<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobCategory extends Model
{
    use HasFactory;
    protected $table = 'job_categories';
    protected $fillable = ['name', 'icon'];

    public function jobcatcount()
    {
        return $this->hasMany(Hiring::class, 'job_category_id', 'id')->where('status', '=', 'active');
    }

}
