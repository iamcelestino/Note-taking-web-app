<?php

namespace App\Controllers;
use App\Core\Controller;

class LoginController extends Controller
{
    public function index(): void
    {
        $this->view('login', []);
    }
}