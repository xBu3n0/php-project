<?php

namespace App\Http;

$_PATH = $_GET['path'];

final class Route {
    static public array $routes = [];

    static public function get(string $route, array $controller = []) {
        $route = '/'.trim($route, '/');

        preg_match_all('/{([^}]*)}/', $route, $matches);

        $route = preg_replace('/\/{([^}]*)}/', '/(.+)', $route);
        $route = preg_replace('/\//', '\/', $route);        
        $route = '/^'.$route.'$/';

        self::$routes[] = [
            'method' => 'get',
            'path' => $route,
            'params' => $matches[1],
            'controller' => $controller,
            'middleware' => [],
        ];

        return self::class;
    }
}