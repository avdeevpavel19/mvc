<?php

namespace App\Controllers;

use App\Core\Controller;

class MainController extends Controller
{
    public function index()
    {
        return $this->render('main');
    }
}