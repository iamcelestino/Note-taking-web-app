<?php

namespace App\Controllers;
use App\Core\Controller;

class SignupController extends Controller 
{
    public function index(): void
    {
        $this->view('signup', []);
    }
}