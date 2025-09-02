<?php
declare(strict_types=1);

namespace App\Contracts;

interface NoteTagInterface extends BaseInterface
{
    public function deleteByNoteId(int $id): mixed;
}