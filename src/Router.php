<?php
namespace App;
class Router
{
    protected array $routers = [];
    private string $basePath;

    public function __construct(string $basePath = '')
    {
        $this->basePath = rtrim($basePath, '/');
    }

    private function addRoute(string $route, string $controller, string $action, string $mithod): void
    {
        $this->routers[$mithod][$route] = [
            'controller' => $controller,
            'action' => $action,
        ];
    }

    public function get(string $route, string $controller, string $action): void
    {
        $this->addRoute($route, $controller, $action, 'GET');
    }
    public function post(string $route, string $controller, string $action): void
    {
        $this->addRoute($route, $controller, $action, 'POST');
    }
    public function put(string $route, string $controller, string $action): void
    {
        $this->addRoute($route, $controller, $action, 'PUT');
    }


    public function dispatch(): void
    {
        $path = strtok($_SERVER['REQUEST_URI'], '?');
        $method = $_SERVER['REQUEST_METHOD'];

        if ($this->basePath !== '' && str_starts_with($path, $this->basePath)) {
            $path = substr($path, strlen($this->basePath));
        }

        if ($path === '' || $path === false) {
            $path = "/";
        }

        if (isset($this->routes[$method][$path])) {
            $controllerClass = $this->routes[$method][$path]['controller'];
            $action = $this->routes[$method][$path]['action'];

            $controller = new $controllerClass();
            $controller->$action();
        } else {
            http_response_code(404);
            echo '404 Not Found';
        }
    }





}