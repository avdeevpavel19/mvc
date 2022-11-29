<?php

require_once __DIR__ . "/vendor/autoload.php";

use App\Core\App;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = [
    'db' => [
        'dsn'      => $_ENV['DB_DSN'],
        'user'     => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD']
    ]
];

$app = new App($config);

$pathToMigrations = __DIR__ . '/app/Migrations';

$app->db->applyMigrations();