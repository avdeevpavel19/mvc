<?php

require_once __DIR__ . "/../vendor/autoload.php";

use App\Controllers\ProfileController;
use App\Core\App;
use App\Controllers\MainController;
use App\Controllers\AuthController;
use App\Models\Register;

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [
    'userClass' => Register::class,

    'db' => [
        'dsn'      => $_ENV['DB_DSN'],
        'user'     => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD']
    ]
];

$app = new App($config);

$app->route->get('/', [MainController::class, 'index']);

$app->route->get('/register', [AuthController::class, 'register']);
$app->route->post('/register', [AuthController::class, 'register']);
$app->route->get('/login', [AuthController::class, 'login']);
$app->route->post('/login', [AuthController::class, 'login']);
$app->route->get('/logout', [AuthController::class, 'logout']);

$app->route->get('/profile', [ProfileController::class, 'index']);

$app->run();