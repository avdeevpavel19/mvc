<?php

namespace App\Core\DB;

use App\Core\App;
use App\Core\Model;
use App\Exceptions\ServerException;

abstract class DbModel extends Model
{
    abstract public function attributes(): array;

    abstract public static function tableName(): string;

    public static function primaryKey(): string
    {
        return 'id';
    }

    public function save()
    {
        try {
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
        } catch (\PDOException) {
            throw new ServerException;
        }
    }

    public static function prepare($sql)
    {
        return App::$app->db->prepare($sql);
    }

    public static function findOne($where)
    {
        $tableName  = static::tableName();
        $attributes = array_keys($where);

        $sql       = implode("AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");

        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }

        $statement->execute();

        return $statement->fetchObject(static::class);
    }
}