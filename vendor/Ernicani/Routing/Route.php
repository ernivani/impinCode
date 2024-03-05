<?php 
// ernicani/Routing/Route.php



namespace Ernicani\Routing;

class Route
{
    private $path;
    private $action;
    private $name;
    private $params = [];

    public function __construct($path, $action, $name)
    {
        $this->path = $path;
        $this->action = $action;
        $this->name = $name;
    }

    public function matches($pathInfo)
    {
        // Modifier la logique pour capturer les paramètres
        $pattern = preg_replace('#\{([a-z]+)\}#', '([^/]+)', $this->path);
        $pattern = "#^$pattern$#";

        if (preg_match($pattern, $pathInfo, $matches)) {
            array_shift($matches); // Enlever le match complet de l'array
            $this->params = $matches; // Stocker les paramètres capturés
            return true;
        }

        return false;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getParams()
    {
        return $this->params;
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
