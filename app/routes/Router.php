<?php

namespace App\Routes;

use App\Controller\BlogController;

class Router
{

    public $url;
    public $routes = [];

    public function __construct($url)
    {
        $this->url = trim($url, '/');
    }

    // push key get in array
    public function get(string $path, string $action)
    {
        $this->routes['GET'][] = new Route($path, $action);
    }

    //search request method for routes
    public function run()
    {
        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if ($route->matches($this->url)) {
                $route->execute();
            }
        }
        return header('HTTP/1.0 404 Not Found');
    }
}
