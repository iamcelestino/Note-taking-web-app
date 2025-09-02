<?php
declare(strict_types=1);

namespace App\Models;
use App\Core\Model;
use App\Contracts\NoteTagInterface;

class NoteTag extends Model implements NoteTagInterface
{
    public function deleteByNoteId(int $note_id): mixed
    {
        return $this->query(
            'DELETE FROM notetags
            WHERE note_id = :note_id', 
            ['note_id' => $note_id]
        );
    }
}
