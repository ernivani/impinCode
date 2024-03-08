<?php 

// ernicani/Routing/Router.php

namespace Ernicani\Routing;

class Router
{
    private $routes = [];

    public function addRoute(string $path, $action, string $name, array $methods = ['GET']) {
        $this->routes[$name] = new Route($path, $action, $name, $methods);
    }

    public function match(string $uri, string $requestMethod): array {
        foreach ($this->routes as $route) {
            if ($route->matches($uri, $requestMethod)) { // Pass the request method
                return [$route->getAction(), $route->getParams()];
            }
        }

        return [null, null];
    }

    public function getPathByName($name)
    {

        if (!isset($this->routes[$name])) {
            throw new \Exception("No route with the name $name");
        }
        return $this->routes[$name]->getPath();
    }
}
