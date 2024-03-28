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
use App\Entity\Section;
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
            'entityManager' => $this->entityManager,
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

        $this->renderPage('section/index', 'Section', 'section', [
            'sections' => $Sections,
        ]);
    }

    #[Route(path: '/section/{id}', name: 'section_id')]
    public function sectionAction(int $id)
    {
        $user = $this->getUserOrRedirect();
        if ($user === null) {
            return;
        }

        $section = $this->entityManager->getRepository(Section::class)->find($id);
        if ($section === null) {
            echo "La section n'existe pas";
            exit;
        }

        $user = $this->entityManager->getRepository(User::class)->find($_SESSION['user']);

        $firstLesson = $section->getUnits()[0]->getLessons()[0];
        foreach ($section->getUnits() as $unit) {
            foreach ($unit->getLessons() as $lesson) {
                if ($lesson->getOrdre() < $firstLesson->getOrdre()) {
                    $firstLesson = $lesson;
                }
            }
        }
        $user->setLastLesson($firstLesson);
        $this->entityManager->flush();


        $this->redirectToRoute('app');
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


    #[Route(path: '/change_password', name: 'change_password', methods: ['GET', 'POST'])]
    public function changePasswordAction(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = $this->getUserOrRedirect();
            if ($user === null) {
                return;
            }

            $isTemporary = $user->getIsTemporary();
            $currentPassword = $_POST['current_password'];
            $newPassword = $_POST['new_password'];
            $newPasswordConfirm = $_POST['new_password_confirm'];

            if ($newPassword !== $newPasswordConfirm) {
                $this->addFlash('error', 'Les mots de passe ne correspondent pas');
                $this->redirectToRoute('change_password');
                exit;
            }

            if (!password_verify($currentPassword, $user->getPassword()) && !$isTemporary) {
                $this->addFlash('error', 'Le mot de passe actuel est incorrect');
                $this->redirectToRoute('change_password');
                exit;
            }

            $user->setPassword(password_hash($newPassword, PASSWORD_DEFAULT));

            if ($isTemporary) {
                $this->addFlash('success', 'Vous pouvez maintenant vous connecter avec votre nouveau mot de passe');
                $user->setIsTemporary(false);
            } else {
                $this->addFlash('success', 'Le mot de passe a été changé avec succès');
            }
            $this->entityManager->flush();
            $this->redirectToRoute('profile');
        }
        
        $this->renderPage('change_password', 'Changer le mot de passe', 'change_password', [
            'isTemporary' => $this->getUserOrRedirect()->getIsTemporary(),
        ]);
    }

    // edit_profile
    #[Route(path: '/edit_profile', name: 'edit_profile', methods: ['GET', 'POST'])]
    public function editProfileAction(): void
    {
        $user = $this->getUserOrRedirect();
        if ($user === null) {
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user->setUsername($_POST['username']);
            $user->setEmail($_POST['email']);
            $avatar = $_FILES['avatar'];
            if ($avatar['size'] > 0) {
                $target_dir = __DIR__ . '/../../public/uploads/';
                $fileName = uniqid() . basename($avatar['name']);
                $target_file = $target_dir . $fileName;
                if (!move_uploaded_file($avatar['tmp_name'], $target_file)) {
                    $this->addFlash('error', 'Erreur lors de l\'upload de l\'image');
                    exit;
                }

                $user->setUrlimage('/uploads/' . $fileName);
            }

            
            $this->entityManager->flush();
            $this->addFlash('success', 'Profil mis à jour');
            $this->redirectToRoute('profile');
        }

        $this->renderPage('edit_profile', 'Editer le profil', 'edit_profile');
    }

}
