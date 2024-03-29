<?php

// src/Controller/HomeController.php
namespace App\Controller;

use Ernicani\Controllers\AbstractController;
use Ernicani\Routing\Route;

class ErrorController extends AbstractController 
{
    #[Route(path: '/404', name: '404')]
    public function error404Action()
    {
        return $this->render('error/404', [
            'title' => 'Page non trouvée',
        ]);
    }
}