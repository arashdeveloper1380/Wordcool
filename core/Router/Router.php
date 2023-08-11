<?php

namespace Core\Router;

class Router {

    private $routes = array();
    private $basePath = '';

    public function __construct($basePath = '') {
        $this->basePath = $basePath;
    }

    // public function get($url, $handler, $method = 'GET') {
    //     $url = preg_replace('/:([a-z]+)/', '(\w+)', $url);
    //     $this->routes[] = array(
    //         'url' => $url,
    //         'handler' => $handler,
    //         'method' => $method
    //     );
    // }

    public function get($url, $handler, $method = 'GET') {
        $this->addRoute($url, $handler, $method, 'GET');
    }
    
    public function post($url, $handler, $method = 'POST') {
        $this->addRoute($url, $handler, $method, 'POST');
    }
    
    private function addRoute($url, $handler, $method, $requestMethod) {
        $url = preg_replace('/:([a-z]+)/', '(\w+)', $url);
        $this->routes[] = array(
            'url' => $url,
            'handler' => $handler,
            'method' => $method,
            'request_method' => $requestMethod
        );
    }
    
    public function dispatch() {
        $uri = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {
            if ($route['method'] != $method) {
                continue;
            }

            $pattern = '#^' . $this->basePath . $route['url'] . '$#';
            if (preg_match($pattern, $uri, $matches)) {
                array_shift($matches);
                call_user_func_array($route['handler'], $matches);
                return true;
            }
        }

        return false;
    }

}