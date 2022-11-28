<?php

namespace App\Core;

class App
{
    public Route $route;

    public function __construct()
    {
        $this->route = new Route;
    }

    public function run()
    {
        $this->route->resolve();
    }
}