<?php

// src/Controller/HomeController.php
namespace App\Controller;

use Ernicani\Controllers\AbstractController;
use Ernicani\Routing\Route;
use App\Entity\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

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
            return $this->jsonResponse(['success' => 'Vous êtes connecté', 'token' => $user->generateAuthToken()]);
        } else {
            return $this->jsonResponse(['error' => 'Identifiant ou mot de passe incorrect'], 401);
        }
    }

    #[Route(path: '/api/check-token', name: 'api_check_token', methods: ['POST'])]
    public function apiCheckTokenAction()
    {
        // Récupère le token de l'en-tête d'autorisation
        $data = json_decode(file_get_contents('php://input'), true);
        $token = $data['token'] ?? '';

        if (empty($token)) {
            return $this->jsonResponse(['error' => 'Token non fourni'], 401);
        }

        try {
            // Décoder le token
            $key = $_ENV['JWT_SECRET_KEY'];
            $decoded = JWT::decode($token, new Key($key, 'HS256'));

            
            // Récupérer l'utilisateur à partir de l'ID contenu dans le token
            $userId = $decoded->sub;
            $user = $this->entityManager->getRepository(User::class)->find($userId);

            if (!$user) {
                return $this->jsonResponse(['error' => 'Utilisateur non trouvé'], 404);
            }

            // Retourner les informations de l'utilisateur (ajustez selon vos besoins)
            return $this->jsonResponse([
                'success' => true,
                'user' => [
                    'id' => $user->getId(),
                    'username' => $user->getUsername(),
                ]
            ]);

        } catch (\Exception $e) {
            // Gestion des erreurs liées au token invalide ou expiré
            return $this->jsonResponse(['error' => 'Token invalide ou expiré'], 401);
        }
    }

}