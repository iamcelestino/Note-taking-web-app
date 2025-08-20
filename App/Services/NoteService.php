<?php
declare(strict_types=1);

namespace App\Services;
use App\Contracts\{
    NoteInterface, 
    NoteValidateInterface
};

class NoteService
{
    public function __construct(
        protected NoteInterface $noteModel,
        protected NoteValidateInterface $noteValidator
    ){}

    public function createNote(array $note): void
    {
        $this->noteValidator->validate($note);
        $this->noteModel->insert($note);

    }
}