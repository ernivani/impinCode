<?php

// src/Controller/HomeController.php
namespace App\Controller;

use Ernicani\Controllers\AbstractController;
use Ernicani\Routing\Route;
use App\Entity\User;
use App\Form\LoginFormType;
use App\Form\RegisterFormType;

class AppController extends AbstractController
{
    protected \Doctrine\ORM\EntityManager $entityManager;

    #[Route(path: '/learn', name: 'app')]
    public function appAction()
    {
        if (!isset($_SESSION['user'])) {
            $this->redirectToRoute('login');
        }

        $user = $this->entityManager->getRepository(User::class)->find($_SESSION['user']);

        $this->render('app/index', [
            'title' => 'Application',
            'user' => $user,
        ]);
    }

}