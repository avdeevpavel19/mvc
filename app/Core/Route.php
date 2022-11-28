<?php

namespace App\Core;

use App\Exceptions\NotFoundException;

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

    public function post($path, $callback)
    {
        $this->routes["post"][$path] = $callback;
    }

    public function resolve()
    {
        $path   = $this->request->path();
        $method = $this->request->method();

        $callback = $this->routes[$method][$path] ?? false;

        if (!$callback) {
            throw new NotFoundException();
        }

        if (is_array($callback)) {
            $controller           = new $callback[0];
            App::$app->controller = $controller;
            $controller->action   = $callback[1];
            $callback[0]          = $controller;
        }

        return call_user_func($callback, $this->request);
    }
}