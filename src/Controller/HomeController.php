<?php

// src/Controller/HomeController.php
namespace App\Controller;

use Ernicani\Controllers\AbstractController;
use Ernicani\Routing\Route;
use App\Entity\User;
use App\Form\LoginFormType;
use App\Form\RegisterFormType;

class HomeController extends AbstractController
{
    // Ensure the type matches with that in AbstractController
    protected \Doctrine\ORM\EntityManager $entityManager;

    #[Route(path: '/', name: 'home')]
    public function homeAction()
    {

        if (isset($_SESSION['user'])) {
            $this->redirectToRoute('app');
        }
        return $this->render('home/index', [
            'title' => 'Page d\'accueil',
        ]);
    }

}
