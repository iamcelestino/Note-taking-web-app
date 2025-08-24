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
            "SELECT tag_id
            FROM tags
            WHERE name = :name
            ",
            ['name' => $tagName]
        );

        if($tag) {
            return (int) $tag['tag_id'];
        }
        
        $this->insert(['name' => $tagName]);

        return $this->lastInsertId();
    }

}