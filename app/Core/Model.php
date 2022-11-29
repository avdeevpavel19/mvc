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
                    $this->addError($attribute, self::REQUIRED_RULE);
                }

                if ($ruleName === self::MIN_RULE && strlen($value) < $rule['min']) {
                    $this->addError($attribute, self::MIN_RULE, $rule);
                }

                if ($ruleName === self::MAX_RULE && strlen($value) > $rule['max']) {
                    $this->addError($attribute, self::MAX_RULE, $rule);
                }

                if ($ruleName === self::CONFIRM_RULE && $value !== $this->{$rule['confirm']}) {
                    $this->addError($attribute, self::CONFIRM_RULE);
                }
            }
        }

        return empty($this->errors);
    }

    public function addError(string $attribute, string $rule, $params = [])
    {
        $message = $this->errorMesages()[$rule] ?? '';

        foreach ($params as $key => $value) {
            $message = str_replace("{{$key}}", $value, $message);
        }

        $this->errors[$attribute][] = $message;
    }

    public function errorMesages()
    {
        return [
            self::REQUIRED_RULE => 'Это поле обязательное',
            self::MIN_RULE      => 'Поле должно быть не меньше чем {min}',
            self::MAX_RULE      => 'Поле должно быть не больше чем {max}',
            self::CONFIRM_RULE  => 'Повторный пароль не совпадает'
        ];
    }
}