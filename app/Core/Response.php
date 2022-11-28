<?php

namespace App\Core;

class Response
{
    public function setStatusCode($code)
    {
        return http_response_code($code);
    }
}