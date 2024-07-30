<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: *");

if($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(204);
    exit(0);
}

require_once(dirname(__FILE__) ."/vendor/autoload.php");
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Funções para facilitar e templates
require_once(dirname(__FILE__) ."/utils/bootstrap.php");

// A aplicação
require_once(dirname(__FILE__) ."/app/bootstrap.php");
// Rotas validas
require_once(dirname(__FILE__) ."/routes/bootstrap.php");

$handler = new \App\Http\Handler();

// Gerenciar a request do usuário
$handler->handle();