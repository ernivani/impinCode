<?php

// src/Controller/HomeController.php
namespace App\Controller;

use App\Entity\Course;
use App\Entity\Lesson;
use App\Entity\Leçon;
use Ernicani\Controllers\AbstractController;
use Ernicani\Routing\Route;
use App\Entity\User;
use App\Entity\Question;
use App\Entity\Unit;

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

        
        $userLastLesson = $this->entityManager->getRepository(User::class)->find($_SESSION['user'])->getLastLesson();

        if ($userLastLesson === null) {
            return $this->redirectToRoute('course_select');
        }


        $userLastSection = $userLastLesson->getUnit()->getSection();
        
        
        $this->renderPage('index', 'Application', 'learn', [
            'section' => $userLastSection,
        ]);
    }

    #[Route(path: '/section', name: 'choose_section')]
    public function lastSectionAction()
    {
        $user = $this->getUserOrRedirect();
        if ($user === null) {
            return;
        }

        $userLastLesson = $this->entityManager->getRepository(User::class)->find($_SESSION['user'])->getLastLesson();
        if ($userLastLesson === null) {
            return $this->redirectToRoute('course_select');
        }

        $Sections = $userLastLesson->getUnit()->getSection()->getCourse()->getSections();


        foreach ($Sections as $section) {
            dump($section);
        }



        $this->renderPage('section/index', 'Section', 'section', [
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
    public function lessonPlay()
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
    public function lessonPlayId(int $id)
    {
        $lesson = $this->entityManager->getRepository(Lesson::class)->find($id);
        if ($lesson === null) {
            echo "La leçon n'existe pas";
            exit;
        }

        $this->renderPage('lesson/index', 'Leçon', 'lesson', [
            'lesson' => $lesson,
        ]);
    }


}
