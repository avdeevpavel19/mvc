<?php

namespace App\Core;

class Route
{
    protected Request $request;

    protected array $routes = [];

    public function __construct()
    {
        $this->request = new Request;
    }

    public function get($path, $callback)
    {
        $this->routes["get"][$path] = $callback;
    }

    public function resolve()
    {
        $path   = $this->request->path();
        $method = $this->request->method();

        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            echo 'not found';
        }

        if (is_array($callback)) {
            $callback[0] = new $callback[0]();
        }

        return call_user_func($callback);
    }
}