<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        if ($request->post()) {
            print_r($request->body());
        }

        return $this->render('register');
    }

    public function login()
    {
        return $this->render('login');
    }
}