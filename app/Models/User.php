<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use MongoDB\Driver\Session;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type_of',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public static function getCurrentUser()
    {
        $myId = self::getCurrentUserClientId();

        return User::find($myId);
    }

    public static function getCurrentUserClientId()
    {
        $clientId = User::getCurrentUserData('client_id');

        return $clientId;
    }

    public static function getCurrentUserData($item)
    {
        if (!Session::has('user.' . $item)) {
            User::getCurrentUserInstance()->setCurrentUserSessionData();
        }

        $userItem = Session::has('user.' . $item) ? Session::get('user.' . $item) : 'Error fetching this.';

        return $userItem;
    }

    public static function getCurrentUserInstance()
    {
        return Auth::user();
    }

    public function setCurrentUserSessionData()
    {
        Session::remove('user');

        Session::put('user.email', $this->email);
        Session::put('user.name', $this->name);
        Session::put('user.id', $this->id);
        Session::put('user.type_of', $this->type_of);
    }

    public function getUserType()
    {
        return static::getCurrentUserData('type_of');
    }

    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites', 'user_id', 'favorite_user_id')->withTimestamps();
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites', 'favorite_user_id', 'user_id')->withTimestamps();
    }
}
