<?php

// Get Firebase

// Autoloading
require 'vendor/autoload.php';

// Container
$container = require 'config/services.php';

// Obtain username and Password
$username = $argv[1];
$password = $argv[2];

// PDO
/** @var PDO $pdo */
$pdo = $container->get(\App\Database\Connection::class)->getPdo();

// Prepapre stmt
$stmt = $pdo->prepare("SELECT password, plan FROM users WHERE username= ?");

// Execute the statement + fetch
$stmt->execute([$username]);

$user = $stmt->fetch();

// Verify password
$authenticated = password_verify($password, $user['password']);

// Exit if not authenticated
if(!$authenticated){
    die('Auth failed');
}

// Generate a key (add .env and container)
$key = '4mNxk1zLPvvH0XXB3nWboe+hX8VINMwAmU8F37SfMzQ=';

// Create issued at
$issuedAt = time();

// Create payload
$payload = [
    'iss' => 'https://books-api.org',
    'aud' => 'https://books-api.com',
    'iat' => $issuedAt,
    'nbf' => $issuedAt,
    'data' => [
        'username' => $username,
        'plan' => $user['plan']
    ]
];

// JWT::encode
// (this will json encode payload then base64urlencoded header + payload and sign using secret key)
$jwt = \Firebase\JWT\JWT::encode($payload, $key, 'HS256');

// Return the JWT to the client
echo $jwt . PHP_EOL;
