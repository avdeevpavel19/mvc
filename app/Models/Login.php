<?php

namespace App\Models;

use App\Core\App;
use App\Core\Model;

class Login extends Model
{
    public string $login    = '';
    public string $password = '';

    public function rules(): array
    {
        return [
            'login'    => [self::REQUIRED_RULE],
            'password' => [self::REQUIRED_RULE]
        ];
    }

    public function login()
    {
        $user = Register::findOne(['login' => $this->login]);

        if (!$user) {
            $this->addError('login', 'Пользователь не найден');

            return false;
        }

        if (!password_verify($this->password, $user->password)) {
            $this->addError('password', 'Пароль неверный');

            return false;
        }

        return App::$app->login($user);
    }

    public function labels(): array
    {
        return [
            'login'    => 'Логин',
            'password' => 'Пароль'
        ];
    }
}