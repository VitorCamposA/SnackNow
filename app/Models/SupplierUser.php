<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierUser extends User
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'type_of',
        'address',
        'phone',
        'specialty',
    ];

    protected $table = 'users';

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites', 'favorite_user_id', 'user_id')->withTimestamps();
    }
}
