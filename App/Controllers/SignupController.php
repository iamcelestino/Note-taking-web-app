<?php
declare(strict_types=1);

namespace App\Controllers;
use App\Core\Controller;
use App\Services\AuthService;

class SignupController extends Controller 
{
    public function __construct(
        protected AuthService $auth
    ){}

    public function index(): void
    {
        $this->view('signup', []);
    }

    public function submit(): void
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->auth->signup($_POST);
        }
    }

}