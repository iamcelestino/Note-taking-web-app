<?php
declare(strict_types=1);

namespace App\Services;
use App\Enums\NoteStatus;
use App\Contracts\{NoteInterface, NoteValidateInterface};

class NoteService
{
    public function __construct(
        protected NoteInterface $noteModel,
        protected NoteValidateInterface $noteValidator
    ){}

    public function createNote(array $data): array
    {
        if(!$data['status']) {
            $data['status'] = NoteStatus::active->value;
        }

        if($this->noteValidator->validate($data))
        {
            return $this->noteModel->insert($data);
        }
        return [];
    }
}