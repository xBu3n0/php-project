<?php

namespace App\Http;

class Controller {
    public function __construct(
        protected readonly Request $request
    ) {}
}