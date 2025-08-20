<?php
declare(strict_types=1);

namespace App\Validators;
use App\Contracts\NoteValidateInterface;
use Exception;

class NoteValidator implements NoteValidateInterface
{
    public function validate(array $data): bool
    {
        if(empty($data['content'])){
            throw new Exception("Note content is missing");
        }; 
        return false;
    } 
}