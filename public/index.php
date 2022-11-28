<?php

require_once __DIR__ . "/../vendor/autoload.php";

use App\Core\App;

$app = new App;

$app->route->get('/', function () {
    echo 'main page';
});

$app->route->get('/register', function () {
    echo 'register page';
});

$app->route->get('/login', function () {
    echo 'login page';
});

$app->run();