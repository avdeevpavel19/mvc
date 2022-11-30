<?php

namespace App\Core;

class View
{
    public string $title = '';

    public function renderView($view, $params = [])
    {
        $viewContent = $this->viewContent($view, $params);
        $layout      = $this->layout();

        return str_replace('{{content}}', $viewContent, $layout);
    }

    public function layout()
    {
        $layout = App::$app->controller->layout ?? 'app';

        ob_start();
        require_once __DIR__ . "/../../views/layouts/$layout.php";

        return ob_get_clean();
    }

    private function viewContent($view, $params)
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }

        ob_start();
        require_once __DIR__ . "/../../views/$view.php";

        return ob_get_clean();
    }
}