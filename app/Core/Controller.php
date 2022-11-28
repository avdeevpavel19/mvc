<?php

namespace App\Core;

class Controller
{
    public string $layout;

    public function render($view, $params = [])
    {
        return App::$app->view->renderView($view, $params);
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }
}