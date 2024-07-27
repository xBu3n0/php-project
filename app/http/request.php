<?php

namespace App\Http;

class Request {
    public readonly array $query;
    public readonly array $body;
    public readonly array $header;
    public readonly array $cookies;
    public array $url;


    public function __construct() {
        $this->query = $_GET;
        $this->body = $_POST;
        $this->header = getallheaders();
        $this->cookies = $_COOKIE;
    }
}