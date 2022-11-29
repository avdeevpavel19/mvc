<?php

namespace App\Models;

class Register extends User
{
    public string $login           = '';
    public string $password        = '';
    public string $passwordConfirm = '';

    public function rules(): array
    {
        return [
            'login'           => [self::REQUIRED_RULE, [self::MIN_RULE, 'min' => 2], [self::MAX_RULE, 'max' => 20]],
            'password'        => [self::REQUIRED_RULE, [self::MIN_RULE, 'min' => 3], [self::MAX_RULE, 'max' => 30]],
            'passwordConfirm' => [self::REQUIRED_RULE, [self::CONFIRM_RULE, 'confirm' => 'password']]
        ];
    }

    public function attributes(): array
    {
        return ['login', 'password'];
    }

    public static function tableName(): string
    {
        return 'users';
    }

    public function labels(): array
    {
        return [
            'login'           => 'Логин',
            'password'        => 'Пароль',
            'passwordConfirm' => 'Повторный пароль',
        ];
    }

    public function save()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        return parent::save();
    }

    public function getLogin(): string
    {
        return $this->login;
    }
}