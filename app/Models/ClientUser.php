<?php

namespace App\Models;

use App\Models\User;

/**
 * @property string name
 * @property string email
 * @property string password
 * @property int type_of (1=supplier, 2=client)
 */
class ClientUser extends User
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'type_of',
    ];
    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites', 'user_id', 'favorite_user_id')->withTimestamps();
    }

}
