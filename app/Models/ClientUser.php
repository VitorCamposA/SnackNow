<?php

namespace App\Models;

use App\Models\User;

class ClientUser extends User
{

    public $name;
    public $email;
    public $password;
    public $typeOf;
    public function __construct($name, $email, $password)
    {
        parent::__construct($name, $email, $password, 2);
    }
}
