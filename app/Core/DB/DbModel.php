<?php

namespace App\Core\DB;

use App\Core\App;
use App\Core\Model;

abstract class DbModel extends Model
{
    abstract public function attributes(): array;

    abstract public function tableName(): string;

    public function save()
    {
        $tableName  = $this->tableName();
        $attributes = $this->attributes();

        $params    = array_map(fn($attr) => ":$attr", $attributes);
        $statement = $this->prepare("INSERT INTO $tableName (" . implode(',', $attributes) . ")
        VALUES(" . implode(',', $params) . ")");

        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }

        $statement->execute();

        return true;
    }

    public function prepare($sql)
    {
        return App::$app->db->prepare($sql);
    }
}