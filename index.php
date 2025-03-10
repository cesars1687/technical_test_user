<?php

require 'vendor/autoload.php';

use App\Infrastructure\Http\UserController;


$entityManager = require 'bootstrap.php';
$controller = new UserController($entityManager);


$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

header('Content-Type: application/json');

$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestUri === '/users' && $requestMethod === 'POST') {
    $controller->registerUser();
} else {
    http_response_code(404);
    echo json_encode(["error" => "Route not found"]);
}