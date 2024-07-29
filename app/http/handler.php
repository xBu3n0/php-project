<?php

namespace App\Http;

class Handler {
    public function __construct(
        private Request $request = new Request(),
        private readonly Response $response = new Response(),
    ) {}

    public function handle(): void {
        $path = '/' . trim($_GET['path'], '/');

        foreach(Route::$routes as $route) {
            if(preg_match($route['path'], $path)) {
                foreach($route['middleware'] as $middleware) {
                    if($middleware->handle($this->request) === false) {
                        exit(0);
                    }
                }

                $params = $route['params'];

                preg_match_all($route['path'], $path, $matches);
                $matches = $matches[1];

                for($i = 0; $i < count($params); $i++) {
                    $this->request->uri[$params[$i]] = $matches[$i];
                }

                $controller = new $route['controller'][0]($this->request);
                $method = $route['controller'][1];

                $this->response->render($controller->$method($this->request));

                exit(0);
            }
        }

        $view = response()
            ->setStatus(404)
            ->json([
                "status"=> 404,
                "message"=> "Route not found"
            ]);

        $view->render();
        exit(0);
    }
}