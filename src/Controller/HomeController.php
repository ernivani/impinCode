<?php

// src/Controller/HomeController.php
namespace App\Controller;

use Ernicani\Controllers\AbstractController;
use Ernicani\Routing\Route;
use App\Entity\User;
use App\Entity\Lesson;

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

    #[Route(path: '/lesson_select', name: 'lesson_select')]
    public function lessonSelectAction()
    {
        $user = $this->entityManager->getRepository(User::class)->find($_SESSION['user']);
        $lessons = $this->entityManager->getRepository(Lesson::class)->findAll();
        return $this->render('home/lesson_select', [
            'title' => 'Sélection de leçon',
            'lessons' => $lessons,
        ]);
    }

    #[Route(path: '/select_lesson/{id}', name: 'select_lesson')]
    public function selectLessonAction(int $id)
    {
        $lesson = $this->entityManager->getRepository(Lesson::class)->find($id);
        $user = $this->entityManager->getRepository(User::class)->find($_SESSION['user']);
        $user->setLastLesson($lesson);
        $this->entityManager->flush();
        return $this->redirectToRoute('app');
    }

}
