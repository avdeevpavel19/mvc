<?php

namespace App\Core;

class App
{
    public static App $app;
    public Route      $route;
    public View       $view;
    public Controller $controller;
    public Response   $response;

    public function __construct()
    {
        self::$app        = $this;
        $this->route      = new Route;
        $this->view       = new View;
        $this->controller = new Controller;
        $this->response   = new Response;
    }

    public function run()
    {
        try {
            echo $this->route->resolve();
        } catch (\Exception $e) {
            $this->response->setStatusCode($e->getCode());

            echo App::$app->view->renderView('_error', [
                'exception' => $e
            ]);
        }
    }
}