<?php
use App\Http\Collection;

class Template {
    public function __construct(
        private $content = null,
        private int $status = 200,
        private array $headers = [],
        private array $cookies = []
    ) {}

    public function json(Collection | string | array $json) {
        if(is_object($json)) {
            $json = $json->attributes;
        }
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

    public function setCookie(
        string $name,
        string $value,
        string $duration,
        string $uri = '/',
        string $domain = '',
        bool $secure = false,
        bool $httponly = false,
    ) {
        $this->cookies[$name] = [
            'name' => $name,
            'value' => $value,
            'duration' => $duration,
            'uri' => $uri,
            'domain' => $domain,
            'secure' => $secure,
            'httponly' => $httponly,
        ];

        return $this;
    }

    public function render() {
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
                time() + $cookie['duration'],
                $cookie['path'],
                $cookie['domain'],
                $cookie['secure'],
                $cookie['httponly']
            );
        }

        echo json_encode($this->content);
        exit(0);
    }
}