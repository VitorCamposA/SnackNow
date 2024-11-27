<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierUser extends User
{
    protected $table = 'users';
    public $name;
    public $email;
    public $password;
    public $type_of = 1;



    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites', 'favorite_user_id', 'user_id')->withTimestamps();
    }
}
