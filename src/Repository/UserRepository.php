<?php 
// src/Repository/UserRepository.php

namespace App\Repository;

use PDO;

class UserRepository
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        $user = new \App\Entity\User();
        $user->setId($data['id']);
        $user->setUsername($data['username']);
        $user->setEmail($data['email']);

        return $user;
    }

    public function findByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        $user = new \App\Entity\User();
        $user->setId($data['id']);
        $user->setUsername($data['username']);
        $user->setEmail($data['email']);

        return $user;
    }
}
