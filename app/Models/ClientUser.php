<?php

namespace App\Models;

use App\Models\User;

class ClientUser extends User
{
    protected $table = 'users';
    public $name;
    public $email;
    public $password;
    public $type_of = 2;
    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites', 'user_id', 'favorite_user_id')->withTimestamps();
    }

}
