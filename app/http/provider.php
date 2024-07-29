<?php

namespace App\Http;

class Provider {
    protected string $connection;
    
    public function __construct() {}

    public function query(string $query) {
        return \Database::connection($this->connection)->query($query);
    }
}