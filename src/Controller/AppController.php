<?php

// src/Controller/HomeController.php
namespace App\Controller;

use App\Entity\Lesson;
use App\Entity\Leçon;
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

    private function renderPage(string $template, string $pageTitle, string $pageName, array $data = []) 
    {
        $user = $this->getUserOrRedirect();

        if ($user !== null) {

            $sendedData = [
                'title' => $pageTitle,
                'user' => $user,
                'page' => $pageName,
                'data' => $data,
            ];
            return $this->render('app/' . $template, $sendedData);
        } else {
            unset($_SESSION['user']);
            return $this->redirectToRoute('login');
        }
    }

    #[Route(path: '/learn', name: 'app')]
    public function appAction()
    {

        $userLastLesson = $this->entityManager->getRepository(User::class)->find($_SESSION['user'])->getLastLesson();
        
        if ($userLastLesson === null) {
            return $this->redirectToRoute('lesson_select');
        }
        
        $this->renderPage('index', 'Application', 'learn', [
            'lesson' => $userLastLesson,
        ]);
    }

    #[Route(path: '/section', name: 'last_section')]
    public function lastSectionAction(): void
    {
        $user = $this->getUserOrRedirect();
        if ($user === null) {
            return;
        }

        $userLastLesson = $user->getLastLesson();
        if ($userLastLesson === null) {
            $this->addFlash('error', 'Aucune leçon n’a été commencée');
            $this->redirectToRoute('lesson_select');
            return;
        }

        // Assuming 'section/index' is the template path and 'section' is the page name you want to use
        $this->renderPage('section/index', 'Section', 'section', [
            'lesson' => $userLastLesson,
        ]);
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

    #[Route(path: '/lesson', name: 'lesson')]
    public function lessonListAction(): void
    {
        $userLastLesson = $this->entityManager->getRepository(User::class)->find($_SESSION['user'])->getLastLesson();

        if ($userLastLesson === null) {

            echo "Aucune leçon n'a été commencée";
            exit;
        }
        
        $this->renderPage('lesson/index', 'Leçon', 'lesson', [
            'lesson' => $userLastLesson,
        ]);
    }

    #[Route(path: '/lesson/{id}', name: 'lesson_id')]
    public function lessonAction(int $id): void
    {
        $lesson = $this->entityManager->getRepository(Lesson::class)->find($id);

        if ($lesson === null) {
            

            $this->addFlash('error', 'La leçon demandée n\'existe pas');
            $this->redirectToRoute('app');
        }

        $this->renderPage('lesson/index', $lesson->getTitle(), 'lesson', [
            'lesson' => $lesson,
        ]);

       
    }
    
}
