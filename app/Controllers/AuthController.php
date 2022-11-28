<?php

namespace App\Controllers;

use App\Core\Controller;

class AuthController extends Controller
{
    public function register()
    {
        return $this->render('register');
    }

    public function login()
    {
        return $this->render('login');
    }
}