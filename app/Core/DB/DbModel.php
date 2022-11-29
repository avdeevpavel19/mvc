<?php

namespace App\Core\DB;

use App\Core\Model;

abstract class DbModel extends Model
{
    abstract public function attributes(): array;
}