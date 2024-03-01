<?php

// src/Controller/HomeController.php
namespace App\Controller;

use Ernicani\Controllers\AbstractController;
use Ernicani\Routing\Route;
use App\Entity\User;
use App\Form\LoginFormType;

class HomeController extends AbstractController
{
    // Ensure the type matches with that in AbstractController
    protected \Doctrine\ORM\EntityManager $entityManager;

    #[Route(path: '/', name: 'home')]
    public function homeAction()
    {
        $this->render('home/index', [
            'title' => 'Page d\'accueil',
        ]);
    }

    #[Route(path: '/login', name: 'login')]
    public function loginAction()
    {
        $form = $this->createForm(LoginFormType::class);

        $this->render('home/login', [
            'title' => 'Connexion',
            'form' => $form->render(),
        ]);
    }

        #[Route(path: '/register', name: 'register')]
    public function registerAction()
    {
        $form = $this->createForm(LoginFormType::class);

        $this->render('home/login', [
            'title' => 'Connexion',
            'form' => $form->render(),
        ]);
    }
}
