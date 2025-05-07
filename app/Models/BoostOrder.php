<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoostOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'employer_id',
        'package_id',
        'package_price',
        'tnxID',
        'payment_method',
        'isActive',
        'date_purchased',
        'date_expired',
    ];

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function getIsActiveLabelAttribute(): string
    {
        return $this->isActive ? 'Đang hoạt động' : 'Không hoạt động';
    }
}
