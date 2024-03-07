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
                $this->addFlash('success', 'Vous êtes connecté');
                $this->redirectToRoute('home');
            } else {
                $this->addFlash('error', 'Identifiant ou mot de passe incorrect');
            }
        }

        return $this->render('home/login', [
            'title' => 'Connexion',
            'form' => $form->render(),
        ]);
    }

    #[Route(path: '/register', name: 'register')]
    public function registerAction()
    {
        if (isset($_SESSION['user'])) {
            $this->redirectToRoute('home');
        }

        
        $form = $this->createForm(RegisterFormType::class);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            if ($this->entityManager->getRepository(User::class)->findOneByEmail($data['email'])) {
                $this->addFlash('error', 'Cet email est déjà utilisé');
                return $this->redirectToRoute('register');
            }
            
            if ($this->entityManager->getRepository(User::class)->findOneByUsername($data['username'])) {
                $this->addFlash('error', 'Ce nom d\'utilisateur est déjà utilisé');
                return $this->redirectToRoute('register');
            }


            $user = new User();
            $user->setEmail($data['email'])
                ->setUsername($data['username'])
                ->setPassword(password_hash($data['password'], PASSWORD_DEFAULT))
                ->setCreatedAt(new \DateTime())
                ->setUpdatedAt(new \DateTime())
                ->setRoles(['ROLE_ADMIN'])
                ->setLastLogin(new \DateTime());

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            $_SESSION['user'] = $user->getId();

            $this->addFlash('success', 'Inscription réussie');
            $this->redirectToRoute('home');
        }

        return $this->render('home/register', [
            'title' => 'Inscription',
            'form' => $form->render(),
        ]);
    }

    #[Route(path: '/logout', name: 'logout')]
    public function logoutAction()
    {
        if (!isset($_SESSION['user'])) {
            $this->redirectToRoute('login');
        }
        $this->addFlash('success', 'Vous avez été déconnecté');
        unset($_SESSION['user']);
        return $this->redirectToRoute('login');

    }

}
