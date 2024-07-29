<?php

namespace App\Http;

class Collection {
    public array $attributes;
    
    public function __construct(array | null $rows) {
        $this->attributes = $rows ?? [];
    }

    public function map(callable $callback) : Collection {
        $result = [];

        foreach($this->attributes as $value) {
            $result[] = $callback($value);
        }

        return new Collection($result);
    }

    public function toArray() : array {
        return $this->attributes;
    }
}