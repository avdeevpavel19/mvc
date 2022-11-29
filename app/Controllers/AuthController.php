<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Models\Register;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $user = new Register;

        if ($request->post()) {
            $user->loadData($request->body());
            if ($user->validate()) {
                echo 'success';
            }
        }

        echo '<pre>';
        print_r($user->errors);
        echo '</pre>';

        return $this->render('register');
    }

    public function login()
    {
        return $this->render('login');
    }
}