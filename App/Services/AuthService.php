<?php
declare(strict_types=1);

namespace App\Services;

use App\Contracts\AuthInterface;

class AuthService implements AuthInterface
{
    public function authenticate(array $user): void
    {
        $_SESSION['USER'] = $user;
    }

    public  function isLoggedIn(): bool
    {
        if(isset($_SESSION['USER'])) {
            return true;
        }
        return false;
    }

    public function isLoggedOut(): void
    {
        if(isset($_SESSION['USER'])) {
            unset($_SESSION);
        }
    }

    public function __call($method, $parameters)
    {
        $prop = strtolower(str_replace('get', '', $method));
        $prop = str_replace('_', '', $prop);

        foreach ($_SESSION['USER'] as $key => $value) {
            if (strtolower(str_replace('_', '', $key)) === $prop) {
                return $value;
            }
        }

        return 'unknown';
    }

}