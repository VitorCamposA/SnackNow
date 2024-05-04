<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierUser extends User
{
    public $name;
    public $email;
    public $password;
    public $typeOf;
    public function __construct($name, $email, $password)
    {
        parent::__construct($name, $email, $password, 1);
    }
}
