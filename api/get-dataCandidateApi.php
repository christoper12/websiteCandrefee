<?php
header("Content-Type: application/json");
require "../config.php";
require __DIR__ . "../../vendor/autoload.php";

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$secret = "alliedrec";

// ================================
// 1. Ambil Token
// ================================
$token = $_GET['token'] ?? '';

if (!$token) {
    http_response_code(401);
    echo json_encode([
        "status" => "error",
        "message" => "Token missing"
    ]);
    exit;
}

try {
    $decoded = JWT::decode($token, new Key($secret, 'HS256'));
} catch (Exception $e) {
    http_response_code(401);
    echo json_encode([
        "status" => "error",
        "message" => "Invalid token"
    ]);
    exit;
}

// ================================
// 2. Validasi ID
// ================================
$id = $_GET['id'] ?? '';

if (!$id) {
    http_response_code(400);
    echo json_encode([
        "status" => "error",
        "message" => "ID parameter is required"
    ]);
    exit;
}

// ================================
// 3. Query Database
// ================================
$stmt = $conn->prepare("SELECT * FROM ti_candidaterefee_candform WHERE dbcandno = ?");
$stmt->bind_param("s", $id);
$stmt->execute();

$data = $stmt->get_result()->fetch_assoc();

// ================================
// 4. Jika Data Tidak Ada
// ================================
if (!$data) {
    echo json_encode([
        "status" => "error",
        "message" => "No record found for ID: $id",
        "id" => $id
    ]);
    exit;
}

// ================================
// 5. Berhasil
// ================================
echo json_encode([
    "status" => "success",
    "data" => $data
]);

?>