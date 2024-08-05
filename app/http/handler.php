<?php

namespace App\Http;

class Handler {
    public function __construct(
        private Request $request = new Request(),
        private readonly Response $response = new Response(),
    ) {}

    private function initUriInfo(array $route, string $uri) {
        $params = $route['params'];

        preg_match_all($route['uri'], $uri, $matches);
        
        if(isset($matches[1])) {
            $matches = $matches[1];

            for($i = 0; $i < count($params); $i++) {
                $this->request->uri[$params[$i]] = $matches[$i];
            }
        }
    }

    private function runMiddlewares(array $middlewares) {
        foreach($middlewares as $middleware) {
            $m = new $middleware();
            
            if($m->handle($this->request) === false) {
                exit(0);
            }
        }
    }

    public function handle() {
        $uri = '/' . trim($_GET['uri'], '/');

        foreach(Route::$routes as $route) {
            if(preg_match($route['uri'], $uri) && $route['method']->value == $_SERVER['REQUEST_METHOD']) {
                $this->initUriInfo($route, $uri);

                $this->runMiddlewares($route['middlewares']);

                $controller = new $route['controller'][0]($this->request);
                $method = $route['controller'][1];
                $this->response->render($controller->$method($this->request));
                
                return;
            }
        }

        $view = response()
            ->setStatus(404)
            ->json([
                "status"=> 404,
                "message"=> "Route not found"
            ]);

        $view->render();
        return;
    }
}