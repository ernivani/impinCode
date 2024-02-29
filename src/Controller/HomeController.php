<?php

// src/Controller/HomeController.php

namespace App\Controller;

use Ernicani\Controllers\AbstractController;
use Ernicani\Routing\Route;
use App\Form\LoginFormType;

class HomeController extends AbstractController
{
    #[Route(path: '/', name: 'home')]
    public function homeAction()
    {
        $form = $this->createForm(LoginFormType::class);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $form->dumpData();
        }

        $this->render('home/index', [
            'title' => 'Page d\'accueil',
            'form' => $form->render()
        ]);
    }
} 