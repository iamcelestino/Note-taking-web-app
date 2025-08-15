<?php

declare(strict_types=1);

namespace App\Contracts;

interface NoteValidateInterface
{
    public function validate(array $data): bool;
}