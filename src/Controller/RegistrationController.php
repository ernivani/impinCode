<?php

// src/Controller/HomeController.php
namespace App\Controller;

use Ernicani\Controllers\AbstractController;
use Ernicani\Routing\Route;
use App\Entity\User;
use App\Form\LoginFormType;
use App\Form\RegisterFormType;

class RegistrationController extends AbstractController
{
    // Ensure the type matches with that in AbstractController
    protected \Doctrine\ORM\EntityManager $entityManager;

    #[Route(path: '/login', name: 'login')]
    public function loginAction()
    {
        $form = $this->createForm(LoginFormType::class);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $user = $this->entityManager->getRepository(User::class)->findOneByEmailOrUsername($data['identifiant']);
            echo '<pre>';
            var_dump($user);
            echo '</pre>';

            if ($user && password_verify($data['password'], $user->getPassword())) {
                $_SESSION['user'] = $user->getId();
                $this->redirectToRoute('home');
            }
        }

        $this->render('home/login', [
            'title' => 'Connexion',
            'form' => $form->render(),
        ]);
    }

    #[Route(path: '/register', name: 'register')]
    public function registerAction()
    {
        $form = $this->createForm(RegisterFormType::class);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $user = new User();
            $user->setEmail($data['email']);
            $user->setUsername($data['username']);
            $user->setPassword(password_hash($data['password'], PASSWORD_DEFAULT));

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            $_SESSION['user'] = $user->getId();
            $this->redirectToRoute('home');
        }

        $this->render('home/register', [
            'title' => 'Inscription',
            'form' => $form->render(),
        ]);
    }

    #[Route(path: '/logout', name: 'logout')]
    public function logoutAction()
    {
        session_destroy();
        $this->redirectToRoute('home');
    }

}
