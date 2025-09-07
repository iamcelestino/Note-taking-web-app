<?php
declare(strict_types=1);

namespace App\Contracts;

Interface NoteInterface extends BaseInterface {  
    public function getArchivedNotes(): array;
    public function searchNote(string $text): array;
}