<?php

// src/Controller/HomeController.php
namespace App\Controller;

use App\Entity\Course;
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
        
        $user = $this->getUserOrRedirect();
        if ($user === null) {
            return;
        }

        $userLastCourse = $this->entityManager->getRepository(User::class)->find($_SESSION['user'])->getLastLesson();
        
        if ($userLastCourse === null) {
            return $this->redirectToRoute('course_select');
        }
        
        $this->renderPage('index', 'Application', 'learn', [
            'course' => $userLastCourse,
        ]);
    }

    #[Route(path: '/section', name: 'last_section')]
    public function lastSectionAction(): void
    {
        $user = $this->getUserOrRedirect();
        if ($user === null) {
            return;
        }

        $userLastCourse = $user->getLastCourse();
        if ($userLastCourse === null) {
            $this->addFlash('error', 'Aucune leçon n’a été commencée');
            $this->redirectToRoute('course_select');
            return;
        }

        // Assuming 'section/index' is the template path and 'section' is the page name you want to use
        $this->renderPage('section/index', 'Section', 'section', [
            'course' => $userLastCourse,
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

    #[Route(path: '/course', name: 'course')]
    public function courseListAction(): void
    {
        $userLastCourse = $this->entityManager->getRepository(User::class)->find($_SESSION['user'])->getLastCourse();

        if ($userLastCourse === null) {

            echo "Aucune leçon n'a été commencée";
            exit;
        }
        
        $this->renderPage('course/index', 'Leçon', 'course', [
            'course' => $userLastCourse,
        ]);
    }

    #[Route(path: '/course/{id}', name: 'course_id')]
    public function courseAction(int $id): void
    {
        $course = $this->entityManager->getRepository(Course::class)->find($id);

        if ($course === null) {
            

            $this->addFlash('error', 'La leçon demandée n\'existe pas');
            $this->redirectToRoute('app');
        }

        $this->renderPage('course/index', $course->getTitle(), 'course', [
            'course' => $course,
        ]);

       
    }
    

}
