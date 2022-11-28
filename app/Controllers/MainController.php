<?php

namespace App\Controllers;

use App\Core\Controller;

class MainController extends Controller
{
    public function index()
    {
        $name = 'test';

        return $this->render('main', ['name' => $name]);
    }
}