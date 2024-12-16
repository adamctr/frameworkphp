<?php

class Router
{
    protected $routes = [];

    /**
     * @param $method
     * @param $path
     * @param $target
     * @return void
     */
    public function addRoute($method, $path, $target, $middleware = null)
    {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'target' => $target,
            'middleware' => $middleware,
        ];

    }

    /**
     * @return void
     * @throws Exception
     */
    public function match()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUri = parse_url($uri, PHP_URL_PATH);
        $debug = false;

        if ($debug) {
            echo "Requête URI: " . $requestUri . "<br>";
            echo "Méthode: " . $requestMethod . "<br>";
        }

        foreach ($this->routes as $route) {
            $pathRegex = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([a-zA-Z0-9_]+)', $route['path']);
            $pathRegex = '#^' . $pathRegex . '$#';

            if ($debug) {
                echo "Comparaison avec: " . $pathRegex . "<br>";
            }

            if ($route['method'] === $requestMethod && preg_match($pathRegex, $requestUri, $matches)) {

                //MIDDLE WARE
                if ($route['middleware']) {
                    $middlewareInstance = new $route['middleware']();
                    $middlewareInstance->handle();
                }
                //

                $routeArray = explode('#', $route['target']);
                //var_dump($routeArray);
                if (count($routeArray) < 2) {
                    throw new Exception("Le 'target' doit être au format 'Controller#Method'");
                }

                $controller = $routeArray[0];
                $functionController = $routeArray[1];

                if (isset($matches[1])) {
                    $instance = new $controller($matches[1]);
                    call_user_func_array([$instance, $functionController], $matches);
                    return;
                } else {
                    $instance = new $controller();
                    $instance->$functionController();
                    return;
                }
            }
        }

        http_response_code(404);
        page404View::show();
    }

}


