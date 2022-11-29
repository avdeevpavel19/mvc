<?php

namespace App\Models;

use App\Core\DB\DbModel;

abstract class User extends DbModel
{
    abstract public function getLogin(): string;
}