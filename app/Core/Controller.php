<?php

namespace App\Core;

class Controller
{
    public string $layout;

    public string $action;

    /**
     * @var Middleware[]
     */

    protected array $middlewares = [];

    public function render($view, $params = [])
    {
        return App::$app->view->renderView($view, $params);
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    public function registerMiddleware(Middleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }
}