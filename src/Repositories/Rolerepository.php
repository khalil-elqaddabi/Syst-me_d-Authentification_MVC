<?php

namespace App\Repositories;

use App\Database;
use PDO;

class RoleRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function findByName(string $name): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM roles WHERE name = :name");
        $stmt->execute(['name' => $name]);
        $role = $stmt->fetch();

        return $role ?: null;
    }
}
