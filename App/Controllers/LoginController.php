<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Contracts\AuthInterface;
use App\Core\Controller;
use App\Services\UserService;

class LoginController extends Controller
{
    public function __construct(
        protected UserService $user,
        protected AuthInterface $auth
    ){}

    public function index(): void
    {
        $this->view('login', []);
    }

    public function submit(): void
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if($this->user->login($_POST)) {
                $this->auth->authenticate($_POST);
                $this->redirect('/home');
            }
        }
    }


}