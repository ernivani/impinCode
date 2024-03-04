<?php

// src/Controller/HomeController.php
namespace App\Controller;

use Ernicani\Controllers\AbstractController;
use Ernicani\Routing\Route;
use App\Entity\User;

class AppController extends AbstractController
{
    protected \Doctrine\ORM\EntityManager $entityManager;

    private function getUserOrRedirect(): ?User
    {
        if (!isset($_SESSION['user'])) {
            $this->redirectToRoute('login');
            return null; 
        }

        return $this->entityManager->getRepository(User::class)->find($_SESSION['user']);
    }

    private function renderPage(string $template, string $pageTitle, string $pageName): void
    {
        $user = $this->getUserOrRedirect();

        if ($user !== null) {
            $this->render('app/' . $template, [
                'title' => $pageTitle,
                'user' => $user,
                'page' => $pageName,
            ]);
        }
    }

    #[Route(path: '/learn', name: 'app')]
    public function appAction(): void
    {
        $this->renderPage('index', 'Application', 'learn');
    }

    #[Route(path: '/profile', name: 'profile')]
    public function profileAction(): void
    {
        $this->renderPage('profile', 'Profile', 'profile');
    }

    #[Route(path: '/settings', name: 'settings')]
    public function settingsAction(): void
    {
        $this->renderPage('settings', 'Settings', 'settings');
    }
}
