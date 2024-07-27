<?php

namespace App\Http;

class Response {

    public function __construct() {}

    public function render(string | array | \Template $view): void {
        echo
            match(gettype($view)) {
                'object'    => $this->render($view->load()),
                'array'     => json_encode($view),
                default     => $view
            };
    }
}