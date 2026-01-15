<?php

namespace App\Repositories;

use App\Database;
use PDO;
// require_once __DIR__ . '/../Database.php';


class UserRepository{
    private PDO $pdo ;

    public function __construct(){
        $this->pdo = Database::getconnection();
    }

    public function findByEmailWithRole(string $email):?array{
        $sql = "SELECT u.*, r.name AS role_name from users u Join roles r on u.role_id = r.id WHERE u.email = :email";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['email'=> $email]);
        $user = $stmt->fetch();
        return $user?:null;
        }

         public function emailExists(string $email): bool
    {
        $stmt = $this->pdo->prepare("SELECT id FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return (bool) $stmt->fetchColumn();
    }

    public function create(string $name, string $email, string $passwordHash, int $roleId): bool
    {
        $sql = "INSERT INTO users (name, email, password_hash, role_id)
                VALUES (:name, :email, :password_hash, :role_id)";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'name'          => $name,
            'email'         => $email,
            'password_hash' => $passwordHash,
            'role_id'       => $roleId,
        ]);
    }
}