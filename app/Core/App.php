<?php

namespace App\Core;

use App\Core\DB\Database;

class App
{
    public static App $app;
    public Route      $route;
    public View       $view;
    public Controller $controller;
    public Response   $response;
    public Database   $db;
    public Session    $session;

    public function __construct(array $config)
    {
        self::$app        = $this;
        $this->route      = new Route;
        $this->view       = new View;
        $this->controller = new Controller;
        $this->response   = new Response;
        $this->session    = new Session;

        $this->db = new Database($config['db']);
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