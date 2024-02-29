<?php

// ernicani/Kernel/MicroKernelTrait.php

namespace Ernicani\Kernel;

use Ernicani\Routing\Router;
use Ernicani\Routing\Route;
use PDO;

trait MicroKernelTrait
{
    private $router;
    private PDO $pdo;
    private $debug;

    public function boot()
    {
        $this->loadEnvironment();
        $this->debug = $_ENV['APP_DEBUG'] ?? false;
        try {
            $dns = $_ENV['DB_DRIVER'] . ':host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'];
            $this->pdo = new PDO(
                $dns,
                $_ENV['DB_USER'],
                $_ENV['DB_PASS'] ?? ''
            );
        } catch (\PDOException $e) {
            echo "Database connection failed: " . $e->getMessage() . "\n";
        }
        $this->router = new Router();
        $this->loadRoutes();
        $this->handleRequest($_SERVER['REQUEST_URI']);
    }

    public function loadEnvironment()
    {
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../../../');
        $dotenv->load();
    }

    public function handleRequest($uri)
    {
        $action = $this->router->match($uri);

        if ($action) {
            $this->executeAction($action);
        } else {
            echo "404 Not Found\n";
        }
    }

    private function loadRoutes()
    {
        $controllerFiles = glob(__DIR__ . '/../../../src/Controller/*.php');

        foreach ($controllerFiles as $file) {
            $controllerClass = 'App\\Controller\\' . basename($file, '.php');
            $this->addRoutesFromClass($controllerClass);
        }
    }

    private function addRoutesFromClass($class)
    {
        $reflectionClass = new \ReflectionClass($class);

        if ($reflectionClass->isSubclassOf('Ernicani\Controllers\AbstractController')) {
            $methods = $reflectionClass->getMethods(\ReflectionMethod::IS_PUBLIC);

            foreach ($methods as $method) {
                $attributes = $method->getAttributes(Route::class);

                foreach ($attributes as $attribute) {
                    $args = $attribute->getArguments();
                    $routePath = $args['path'] ?? null;
                    $routeName = $args['name'] ?? null;

                    if ($routePath && $routeName) {
                        $action = [$class, $method->getName()];
                        $this->router->addRoute($routePath, $action, $routeName);
                    }
                }
            }
        }
    }

    private function executeAction($action)
    {
        if (is_array($action) && count($action) === 2 && is_string($action[0])) {
            $controller = new $action[0]($this->router);
            $method = $action[1];

            $controller->$method();
        } else {
            echo "Invalid action format\n";
        }
    }
}
