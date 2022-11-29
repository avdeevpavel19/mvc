<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Middlewares\AuthMiddleware;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['index']));
    }

    public function index()
    {
        return $this->render('profile');
    }
}