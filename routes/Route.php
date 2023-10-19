<?php

namespace Router;

class Route
{
    private $path;
    private $action;
    private $matches;

    public function __construct($path, $action)
    {
        $this->path = trim($path, '/');
        $this->action = $action;
    }

    public function matches(string $url)
    {
        $url = trim($url, '/');
        $path = preg_replace('#:([\w]+)#', '([^/]+)', $this->path);
        $regexPath = "#^$path$#i";
        if (preg_match($regexPath, $url, $matches)) {
            $this->matches = $matches;
            return true;
        }else {
            return false;
        }
    }

    public function execute()
    {
        $params = explode('@', $this->action);
        $controller = new $params[0]();
        $method = $params[1];

        isset($this->matches[1]) ? $controller->$method($this->matches[1]) : $controller->$method();
    }
}