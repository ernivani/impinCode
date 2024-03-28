<?php

// src/Controller/HomeController.php
namespace App\Controller;

use Ernicani\Controllers\AbstractController;
use Ernicani\Routing\Route;
use App\Entity\User;

class ApiController extends AbstractController
{
    // Ensure the type matches with that in AbstractController
    protected \Doctrine\ORM\EntityManager $entityManager;

    
    #[Route(path: '/api/login', name: 'api_login', methods: ['POST'])]
    public function apiLoginAction()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['username']) || !isset($data['password'])) {
            return $this->jsonResponse(['error' => 'Identifiant et mot de passe requis'], 400);
        }

        $username = $data['username'];
        $user = $this->entityManager->getRepository(User::class)->findOneByEmailOrUsername($username);

        if (!$user) {
            return $this->jsonResponse(['error' => 'Utilisateur non trouvé'], 404);
        }

        if (password_verify($data['password'], $user->getPassword())) {
            $user->setLastLogin(new \DateTime()); 
            $this->entityManager->flush();

            // Consider using a more secure method to generate and send a token
            $_SESSION['user'] = $user->getId();
            return $this->jsonResponse(['success' => 'Vous êtes connecté', 'token' => $user->generateAuthToken()]);
        } else {
            return $this->jsonResponse(['error' => 'Identifiant ou mot de passe incorrect'], 401);
        }
    }

}