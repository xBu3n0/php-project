<?php

namespace App\Http;
use Template;

class Response {
    // Remover a classe Template e criar de forma que tudo vire response
    public function __construct() {}


    public function render(string | array | Template | Collection $view): void {
        if(is_array($view)) {
            echo json_encode($view);
        }

        if(is_object($view)) {
            switch(get_class($view)) {
                case Template::class:
                    $view->render();
                    
                    break;
                case Collection::class:
                    http_response_code(200);
                    header('Content-Type: application/json');
                    echo json_encode($view->attributes);

                    break;
                default:
                    $view = response()
                        ->setStatus(500)
                        ->json([
                            "status"=> 500,
                            "message"=> "Internal error"
                        ]);

                    $view->render();
                    break;
            }
        }
    }
}