<?php 
// ernicani/Routing/Route.php

namespace Ernicani\Routing;

class Route
{
    private $path;
    private $action;
    private $name;

    public function __construct($path, $action, $name)
    {
        $this->path = $path;
        $this->action = $action;
        $this->name = $name;
    }

    public function matches($pathInfo)
    {
        return $this->path === $pathInfo;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getName()
    {
        return $this->name;
    }
}