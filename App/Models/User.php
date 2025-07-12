<?php 
declare(strict_types=1);

namespace App\Models;
use App\Contracts\UserInterface;
use App\Core\Model;

class User extends Model implements userInterface
{
    public function findByEmail(string $email): array|bool|object
    {
        return $this->where('email', $email);
    }
}