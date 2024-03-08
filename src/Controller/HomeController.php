<?php

// src/Controller/HomeController.php
namespace App\Controller;

use Ernicani\Controllers\AbstractController;
use Ernicani\Routing\Route;
use App\Entity\User;
use App\Entity\Course;

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

    #[Route(path: '/courses', name: 'course_select')]
    public function courseSelectAction()
    {
        $user = $this->entityManager->getRepository(User::class)->find($_SESSION['user']);
        $courses = $this->entityManager->getRepository(Course::class)->findAll();
        return $this->render('home/course_select', [
            'title' => 'Sélection de cours',
            'courses' => $courses,
        ]);
    }

    #[Route(path: '/select_course/{id}', name: 'select_course')]
    public function selectCourseAction(int $id)
    {
        $course = $this->entityManager->getRepository(Course::class)->find($id);
        $user = $this->entityManager->getRepository(User::class)->find($_SESSION['user']);
        $firstLesson = $course->getSections()[0]->getUnits()[0]->getLessons()[0];
        $user->setLastLesson($firstLesson);
        $this->entityManager->flush();
        return $this->redirectToRoute('app');
    }

}
