<?php
declare(strict_types=1);

namespace App\Contracts;

Interface NoteInterface extends BaseInterface { 
    public function getSingleNote(int $note_id): array|object;
    public function getNotesByTags(string $tag): array|object;
    public function getArchivedNotes(): array;
    public function searchNote(string $text): array;
}