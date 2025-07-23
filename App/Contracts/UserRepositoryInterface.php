<?php

namespace App\Contracts;

interface UserRepositoryInterface 
{
    public function findOrCreateUser(array $googleUser): array;
}