<?php
declare(strict_types=1);

namespace App\Contracts;

interface UserValidateInterface
{
    public function validate(array $user): bool;
    public function login(array $user): bool;
}