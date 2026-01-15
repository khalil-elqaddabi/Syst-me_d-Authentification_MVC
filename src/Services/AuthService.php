<?php

namespace App\Services;

use App\Repositories\UserRepository; 
use App\Repositories\RoleRepository;

class AurthService {
    private UserRepository $userRepo; 
    private RoleRepository $roleRepo; 


    public function __construct(){
        $this->userRepo = new UserRepository();
        $this->roleRepo = new RoleRepository();
    }

    public function login(string $email, string $password): ?array {
        $user= $this->userRepo->findByEmailWithRole($email);

        if(!$user){
            return null;
        }

        return $user;
    }

    public function register(string $name, string $email, string $password, string $roleName ='condidate'):bool{
        if ($this->userRepo->emailExists($email)){
            return false;
        }
        $role = $this->roleRepo->findByName($roleName);
        if (!$role) {
            return false;
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);

        return $this->userRepo->create($name, $email, $hash, (int) $role['id']);
    

    }

}
