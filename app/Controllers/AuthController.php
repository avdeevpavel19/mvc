<?php

namespace App\Controllers;

use App\Core\App;
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
            if ($user->validate() && $user->save()) {
                App::$app->session->setFlash('success', "Спасибо за регистрацию <br> Войдите в аккаунт");
                App::$app->response->redirect('/login');
                exit();
            }
        }

        return $this->render('register', ['user' => $user]);
    }

    public function login()
    {
        return $this->render('login');
    }
}