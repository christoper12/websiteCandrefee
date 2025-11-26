<?php
header("Content-Type: application/json");

// Cek apakah ada data POST
if (!isset($_POST['data'])) {
    echo json_encode([
        "status" => "error",
        "message" => "No data received"
    ]);
    exit;
}

$data = json_decode($_POST['data'], true);

// Jika JSON tidak valid
if (!$data) {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid JSON data"
    ]);
    exit;
}

// --------------------------------------------------
// Load koneksi dari config.php
// Pastikan config.php punya variabel: $conn (mysqli)
// --------------------------------------------------
require_once "config.php";

if (!$conn || $conn->connect_error) {
    echo json_encode([
        "status" => "error",
        "message" => "Database connection failed"
    ]);
    exit;
}

// --------------------------------------------------
// Prepared statement
// --------------------------------------------------
$stmt = $conn->prepare("
    INSERT INTO ti_candidaterefee_refeeformcheck (
        referee_name,
        referee_phone,
        referee_email,
        referee_title,
        candno,
        details_correct,
        details_wrong_explain,
        q_follow_instructions,
        q_work_independently,
        q_accuracy,
        q_attitude,
        q_attendance,
        q_safety,
        consider_rehire,
        reason_leaving,
        other_comments,
        created_at
    ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?, NOW())
");

$stmt->bind_param(
    "ssssissiiiiiisss",
    $data['referee_name'],
    $data['referee_phone'],
    $data['referee_email'],
    $data['referee_title'],
    $data['candno'],
    $data['details_correct'],
    $data['details_wrong_explain'],
    $data['q_follow_instructions'],
    $data['q_work_independently'],
    $data['q_accuracy'],
    $data['q_attitude'],
    $data['q_attendance'],
    $data['q_safety'],
    $data['consider_rehire'],
    $data['reason_leaving'],
    $data['other_comments']
);

// --------------------------------------------------
// Eksekusi Query
// --------------------------------------------------
if ($stmt->execute()) {
    echo json_encode([
        "status" => "success",
        "message" => "Referee check saved"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Failed to save: " . $stmt->error
    ]);
}

$stmt->close();
$conn->close();
?>