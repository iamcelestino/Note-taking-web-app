<?php
declare(strict_types=1);

namespace App\Controllers;
use App\Core\Controller;
use App\Services\AuthService;

class LoginController extends Controller
{
    public function __construct(
        protected AuthService $auth
    )
    {
        $this->auth = $auth;
    }

    public function index(): void
    {
        $this->view('login', []);
    }

    public function submit(): void
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            if( $this->auth->login($_POST)) {
                echo " Successfully logged in";
            }
        }
    }
}