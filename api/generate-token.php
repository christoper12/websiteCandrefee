<?php
require __DIR__ . "../../vendor/autoload.php";

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$secret = "alliedrec"; // ganti dengan panjang & acak

$payload = [
    "iss" => "allied-api",
    "iat" => time(),
    "exp" => time() + 3600, // token valid 1 jam
    "role" => "local-app"
];

$jwt = JWT::encode($payload, $secret, 'HS256');

echo json_encode(["token" => $jwt]);
?>