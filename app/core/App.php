<?php

class App
{
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseURL();

        // Controller
        $controllerName = !empty($url[0]) ? $url[0] : 'Home';
        if (file_exists('../app/controllers/' . $controllerName . '.php')) {
            $this->controller = $controllerName;
            unset($url[0]);
        }

        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // Method
        $methodName = !empty($url[1]) ? $url[1] : 'index';
        if (method_exists($this->controller, $methodName)) {
            $this->method = $methodName;
            unset($url[1]);
        }

        // Parameters
        $this->params = !empty($url) ? array_values($url) : [];

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseURL()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return explode('/', $url);
        }
        return [];
    }
}