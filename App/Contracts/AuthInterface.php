<?php

declare(strict_types=1);

namespace App\Contracts;

interface AuthInterface
{
    public function authenticate(array $user): void;
    public function isLoggedIn(): bool;
    public function isLoggedOut(): void;
    public function __call($method, $parameters);

}