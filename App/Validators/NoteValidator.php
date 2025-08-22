<?php
declare(strict_types=1);

namespace App\Validators;
use App\Contracts\NoteValidateInterface;
use App\Exceptions\ValidateException;

class NoteValidator implements NoteValidateInterface
{
    public function validate(array $data): bool
    {
        $errors = [];
        
        if(empty($data['content'])){
            $errors['content'] = "Note content is missing";
        }; 

        if(!empty($errors)) {
            throw new ValidateException('Validation failed');
        }
        return false;
    } 
}