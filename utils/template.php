<?php

class Template {
    public function __construct(
        private $content = null,
        private int $status = 200,
        private array $headers = [],
        private array $cookies = []
    ) {}

    public function json(string | array $json) {
        $this->content = $json;
        
        return $this->setHeaders([
            'Content-Type' => 'application/json'
        ]);
    }

    public function setStatus(int $status) {
        $this->status = $status;

        return $this;
    }

    public function setHeaders(array $headers) {
        foreach($headers as $header => $value) {
            $this->headers[$header] = $value;
        }

        return $this;
    }

    public function setCookie(array $cookie) {
        $this->cookies[$cookie[0]] = $cookie[1];

        return $this;
    }

    public function load() {
        http_response_code($this->status);

        foreach($this->headers as $header => $value) {
            header(
                "$header: $value"
            );
        }

        foreach($this->cookies as $cookie) {
            setcookie(
                $cookie['name'],
                $cookie['value'],
                $cookie['duration'],
                $cookie['path'],
                $cookie['domain'],
                $cookie['secure'],
                $cookie['httponly']
            );
        }

        return $this->content;
    }
}