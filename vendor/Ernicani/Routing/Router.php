<?php 

// ernicani/Routing/Router.php

namespace Ernicani\Routing;

class Router
{
    private $routes = [];

    public function addRoute($path, $action, $name)
    {
        $this->routes[$name] = new Route($path, $action, $name);
    }

    public function match($uri)
    {
        foreach ($this->routes as $route) {
            if ($route->matches($uri)) {
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
