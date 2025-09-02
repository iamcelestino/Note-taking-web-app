<?php
declare(strict_types=1);

namespace App\Models;
use App\Core\Model;
use App\Contracts\TagInterface;

class Tag extends Model implements TagInterface
{
    public function findOrCreateByName($tagName): int
    {
        $tag = $this->query(
            "SELECT tag_id FROM tags WHERE nome = :nome",
            ['nome' => $tagName],
            'array'
        );

        if ($tag && isset($tag[0]['tag_id'])) {
            return (int)$tag[0]['tag_id'];
        }

        $this->insert(['nome' => $tagName]);

        return (int)$this->lastInsertId();
    }

}