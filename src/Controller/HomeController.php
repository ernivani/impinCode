<?php

// src/Controller/HomeController.php
namespace App\Controller;

use Ernicani\Controllers\AbstractController;
use Ernicani\Routing\Route;
use App\Entity\User;

class HomeController extends AbstractController
{
    // Ensure the type matches with that in AbstractController
    protected \Doctrine\ORM\EntityManager $entityManager;

    #[Route(path: '/', name: 'home')]
    public function homeAction()
    {
        // Retrieve all User entities from the database
        $userRepository = $this->entityManager->getRepository(User::class);
        $users = $userRepository->findAll();

        // Pass the users to the view
        $this->render('home/index', [
            'title' => 'Page d\'accueil',
            'users' => $users, // Pass the list of users to the view
        ]);
    }
}
