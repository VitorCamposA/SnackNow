<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string name
 * @property string email
 * @property string password
 * @property int type_of (1=supplier, 2=client)
 * @property string address
 * @property string cep
 * @property string address_complement
 * @property string address_number
 * @property string phone
 * @property string specialty
 */
class SupplierUser extends User
{
    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'type_of',
        'address',
        'phone',
        'specialty',
        'cep',
        'address_complement',
        'address_number',
    ];

    function getSpecialtyForHumansAttribute() {

        $array = [
            "Fast Food" => "Fast Food",
            "Desserts" => "Sobremesa",
            "Pasta" => "Massa",
            "Seafood" => "Comida Marítima",
            "Barbecue" => "Barbecue",
            "Brazilian" => "Comida Brasileira",
            "Korean" => "Comida Coreana",
            "Mexican" => "Comida Mexicana",
            "Italian" => "Comida Italiana",
            "Chinese" => "Comida Chinesa",
            "Japanese" => "Comida Japonesa"
        ];

        return $array[$this->specialty] ?? "Opção desconhecida";
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites', 'favorite_user_id', 'user_id')->withTimestamps();
    }
}
