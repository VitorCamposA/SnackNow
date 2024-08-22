<?php

namespace App\Policies;

use App\Models\Coupon;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CouponPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Coupon $coupon)
    {
        return $user->id === $coupon->supplier_id;
    }
}
