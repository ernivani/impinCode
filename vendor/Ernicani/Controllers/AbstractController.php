<?php

// ernicani/controllers/AbstractController.php

namespace Ernicani\Controllers;

use Ernicani\Form\Form;
use Ernicani\Form\FormBuilder;
use Ernicani\Routing\Router;

abstract class AbstractController
{

   protected $router;

   public function __construct(Router $router)
   {
       $this->router = $router;
   }
   

    public function render($view, $params = [])
    {
        $viewPath = __DIR__ . '/../../../views/' . $view . '.php';
        
        if (file_exists($viewPath)) {
            $params['path'] = function($routeName) {
                return $this->generateUrl($routeName);
            };

            extract($params);

            include $viewPath;
        } else {
            echo "Error: View file not found - $viewPath";
        }
    }

    public function generateUrl($routeName)
    {
        return $this->router->getPathByName($routeName);
    }



    protected function createForm(string $type, array $options = []) : Form
    {
        $formBuilder = new FormBuilder();
        $formType = new $type();
        $formType->buildForm($formBuilder, $options);

        $form = $formBuilder->buildForm();


        return $form;
    }

    protected function redirectToRoute(string $routeName)
    {
        $url = $this->generateUrl($routeName);

        header("Location: $url");
        exit;
    }
}
