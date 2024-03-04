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

        if (isset($_SESSION['user'])) {
            $this->redirectToRoute('home');
        }

        $form = $this->createForm(LoginFormType::class);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $user = $this->entityManager->getRepository(User::class)->findOneByEmailOrUsername($data['identifiant']);

            if ($user && password_verify($data['password'], $user->getPassword())) {
                $user->setLastLogin(new \DateTime()); 
                $this->entityManager->flush(); 

                $_SESSION['user'] = $user->getId();
                $this->redirectToRoute('home');
            } else {
                $this->addFlash('error', 'Identifiant ou mot de passe incorrect');
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
            $user->setEmail($data['email'])
                ->setUsername($data['username'])
                ->setPassword(password_hash($data['password'], PASSWORD_DEFAULT))
                ->setCreatedAt(new \DateTime())
                ->setUpdatedAt(new \DateTime())
                ->setLastLogin(new \DateTime()); 

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
        unset($_SESSION['user']);
        $this->redirectToRoute('home');
    }

}
