<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponClient extends Model
{
    use HasFactory;

    protected $table = 'clients_coupons';
}
