<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'discount_amount',
        'discount_percentage',
        'valid_from',
        'valid_until',
        'minimum_visits',
        'used',
        'supplier_id',
    ];

    public function supplier()
    {
        return $this->belongsTo(User::class, 'supplier_id');
    }

    public function clients()
    {
        return $this->belongsToMany(User::class, 'coupons_clients');
    }
}
