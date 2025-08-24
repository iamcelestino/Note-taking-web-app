<?php
declare(strict_types=1);

namespace App\Contracts;

interface TagInterface extends BaseInterface
{
    public function findOrCreateByName($tagName): int;
}

