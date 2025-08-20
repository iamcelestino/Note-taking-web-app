<?php
declare(strict_types=1);

namespace App\Enums;

enum NoteStatus: string
{
    case active = 'active';
    case archived = 'archived';
}