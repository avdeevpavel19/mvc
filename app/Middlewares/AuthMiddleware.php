<?php

namespace App\Middlewares;

use App\Core\App;
use App\Core\Middleware;
use App\Exceptions\ForbiddenException;

class AuthMiddleware extends Middleware
{
    public array $actions = [];

    public function __construct(array $actions = [])
    {
        $this->actions = $actions;
    }

    public function execute()
    {
        if (App::$app->isGuest()) {
            if (empty($this->actions) || in_array(App::$app->controller->action, $this->actions)) {
                throw new ForbiddenException;
            }
        }
    }
}