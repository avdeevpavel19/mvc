<?php

namespace App\Core;

use App\Core\DB\Database;
use App\Models\User;

class App
{
    public static App $app;
    public Route      $route;
    public View       $view;
    public Controller $controller;
    public Response   $response;
    public Database   $db;
    public Session    $session;
    public string     $userClass;
    public ?User      $user;

    public function __construct(array $config)
    {
        self::$app        = $this;
        $this->route      = new Route;
        $this->view       = new View;
        $this->controller = new Controller;
        $this->response   = new Response;
        $this->session    = new Session;

        $this->db        = new Database($config['db']);
        $this->userClass = $config['userClass'];
        $this->user      = NULL;

        $primaryValue = $this->session->get('user');
        if ($primaryValue) {
            $primaryKey = $this->userClass::primaryKey();
            $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
        }
    }

    public function login(User $user)
    {
        $this->user   = $user;
        $primaryKey   = $user::primaryKey();
        $primaryValue = $user->{$primaryKey};

        $this->session->set('user', $primaryValue);

        return true;
    }

    public function logout()
    {
        $this->user = NULL;
        $this->session->remove('user');
    }

    public static function isGuest()
    {
        return !self::$app->user;
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