<?php

namespace App\Core;

abstract class Model
{
    public const REQUIRED_RULE = 'required';
    public const MIN_RULE      = 'min';
    public const MAX_RULE      = 'max';
    public const CONFIRM_RULE  = 'confirm';
    public const UNIQUE_RULE   = 'unique';

    public function loadData($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    public function rules()
    {
        return [];
    }

    public array $errors = [];

    public function validate()
    {
        foreach ($this->rules() as $attribute => $rules) {

            $value = $this->{$attribute};

            foreach ($rules as $rule) {
                $ruleName = $rule;

                if (!is_string($ruleName)) {
                    $ruleName = $rule[0];
                }

                if ($ruleName === self::REQUIRED_RULE && !$value) {
                    $this->addErrorForRule($attribute, self::REQUIRED_RULE);
                }

                if ($ruleName === self::MIN_RULE && strlen($value) < $rule['min']) {
                    $this->addErrorForRule($attribute, self::MIN_RULE, $rule);
                }

                if ($ruleName === self::MAX_RULE && strlen($value) > $rule['max']) {
                    $this->addErrorForRule($attribute, self::MAX_RULE, $rule);
                }

                if ($ruleName === self::CONFIRM_RULE && $value !== $this->{$rule['confirm']}) {
                    $this->addErrorForRule($attribute, self::CONFIRM_RULE);
                }

                if ($ruleName === self::UNIQUE_RULE) {
                    $className  = $rule['class'];
                    $uniqueAttr = $rule['attribute'] ?? $attribute;

                    $tableName = $className::tableName();
                    $db        = App::$app->db;

                    $statement = $db->prepare("SELECT * FROM $tableName WHERE $uniqueAttr = :$uniqueAttr");
                    $statement->bindValue(":$uniqueAttr", $value);
                    $statement->execute();
                    $record = $statement->fetchObject();

                    if ($record) {
                        $this->addErrorForRule($attribute, self::UNIQUE_RULE, ['field' => $this->getLabel($attribute)]);
                    }
                }
            }
        }

        return empty($this->errors);
    }

    public function addErrorForRule(string $attribute, string $rule, $params = [])
    {
        $message = $this->errorMesages()[$rule] ?? '';

        foreach ($params as $key => $value) {
            $message = str_replace("{{$key}}", $value, $message);
        }

        $this->errors[$attribute][] = $message;
    }

    public function addError(string $attribute, string $message)
    {
        $this->errors[$attribute][] = $message;
    }

    public function errorMesages()
    {
        return [
            self::REQUIRED_RULE => 'Это поле обязательное',
            self::MIN_RULE      => 'Поле должно быть не меньше чем {min}',
            self::MAX_RULE      => 'Поле должно быть не больше чем {max}',
            self::CONFIRM_RULE  => 'Повторный пароль не совпадает',
            self::UNIQUE_RULE   => 'Пользователь с этим {field} уже существует'
        ];
    }

    public function labels(): array
    {
        return [];
    }

    public function getLabel($attribute)
    {
        return $this->labels()[$attribute] ?? $attribute;
    }

    public function hasError($attribute)
    {
        return $this->errors[$attribute] ?? false;
    }

    public function getFirstError($attribute)
    {
        return $this->errors[$attribute][0] ?? false;
    }
}