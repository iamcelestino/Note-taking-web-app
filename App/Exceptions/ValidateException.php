<?php
declare(strict_types=1);

namespace App\Exceptions;
use Exception;

class ValidateException extends Exception
{
    public function __construct(string $message, protected array $errors= [], int $code = 422)
    {
        parent::__construct($message, $code);
        $this->errors = $errors;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}




