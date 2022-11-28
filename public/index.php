<?php

require_once __DIR__ . "/../vendor/autoload.php";

use App\Controllers\MainController;
use App\Controllers\AuthController;

use App\Core\App;

$app = new App;

$app->route->get('/', [MainController::class, 'index']);

$app->route->get('/register', [AuthController::class, 'register']);
$app->route->get('/login', [AuthController::class, 'login']);

$app->run();