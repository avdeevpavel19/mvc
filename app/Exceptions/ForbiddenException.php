<?php

namespace App\Exceptions;

class ForbiddenException extends \Exception
{
    protected $message = 'У вас нет доступа';
    protected $code    = 403;
}