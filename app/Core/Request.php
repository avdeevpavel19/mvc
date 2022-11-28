<?php

namespace App\Core;

class Request
{
    public function path()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';

        $position = strpos($path, '?');

        if ($position === false) {
            return $path;
        }
    }

    public function method()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}