<?php

namespace App\Exceptions;

class ServerException extends \Exception
{
    protected $message = 'Внутренняя ошибка сервера';
    protected $code    = 500;
}