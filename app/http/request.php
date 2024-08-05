<?php

namespace App\Http;

class Request {
    public readonly array $query;
    public readonly array $body;
    public readonly array $header;
    public readonly array $cookies;
    public array $uri = [];
    public array $user;


    public function __construct() {
        $this->query = $_GET;
        $this->body = (array) json_decode(file_get_contents('php://input'));
        $this->header = getallheaders();
        $this->cookies = $_COOKIE;
    }
}