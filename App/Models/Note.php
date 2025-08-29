<?php
declare(strict_types=1);

namespace App\Models;

use App\Contracts\NoteInterface;
use App\Core\Model;

class Note extends Model implements NoteInterface
{
    public function all(): array|object|bool
    {
        return $this->query(
            "SELECT 
                n.note_id,
                n.content,
                n.status,
                n.created_at,
                u.user_id,
                u.full_name,
                u.email,
                GROUP_CONCAT(t.nome ORDER BY t.nome SEPARATOR ', ') AS tags
            FROM notes n
            JOIN users u ON n.user_id = u.user_id
            LEFT JOIN notetags nt ON n.note_id = nt.note_id
            LEFT JOIN tags t ON nt.tag_id = t.tag_id
            GROUP BY 
                n.note_id, n.content, n.status,
                u.user_id, u.full_name, u.email;
            ",
            [],
        );
    } 
    
    public function where(string $column, mixed $value): array|object|bool
    {
        return parent::where('note_id', $value);
    }

    public function delete(int|string $id)
    {
        return $this->query(
            "DELETE 
            FROM notes
            WHERE note_id = :note_id
            ",
            ['note_id' => $id]
        );
    }

    public function update(mixed $id, array $data): bool|array
    {
        return parent::update($id, $data);
    }
}

