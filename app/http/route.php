<?php

namespace App\Http;

enum HttpMethods: string {
    case GET = 'GET';
    case POST = 'POST';
    case PUT = 'PUT';
    case DELETE = 'DELETE';
}

final class Route {
    static public array $routes = [];
    static private array $wildCards = [];

    private static function createRoute(HttpMethods $method, string $uri, array $controller = []) {
        if(self::$wildCards == []) {
            self::$wildCards = require(dirname(__DIR__).'/../config/wildcards.php');
        }

        $uri = '/'.trim($uri, '/');

        preg_match_all('/{([^}]*)}/', $uri, $matches);

        $regexList = [];

        if($matches[1]) {
            foreach($matches[1] as $name) {
                $regexList[] = self::$wildCards['regex'][$name] ?? self::$wildCards['default'];
            }
        }

        foreach($matches[0] as $key => $match) {
            $uri = preg_replace('/'.$match.'/', '('.$regexList[$key].')', $uri);
        }

        $uri = preg_replace('/\//', '\/', $uri);  
        $uri = '/^'.$uri.'$/';


        self::$routes[] = [
            'method' => $method,
            'uri' => $uri,
            'params' => $matches[1],
            'controller' => $controller,
            'middleware' => [],
        ];

        return self::class;
    }

    static public function get(string $uri, array $controller = []) {
        return self::createRoute(HttpMethods::GET, $uri, $controller);
    }

    static public function post(string $uri, array $controller = []) {
        return self::createRoute(HttpMethods::POST, $uri, $controller);
    }

    static public function put(string $uri, array $controller = []) {
        return self::createRoute(HttpMethods::PUT, $uri, $controller);
    }

    static public function delete(string $uri, array $controller = []) {
        return self::createRoute(HttpMethods::DELETE, $uri, $controller);
    }
}