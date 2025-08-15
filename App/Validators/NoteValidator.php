<?php
declare(strict_types=1);

namespace App\Validators;
use App\Contracts\NoteValidateInterface;

class NoteValidator implements NoteValidateInterface
{
    public function validate(array $data): bool
    {
        if(empty($data['content'])); 
        return false;
    } 
}