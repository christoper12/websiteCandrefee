<?php
header("Content-Type: application/json");
require_once "config.php"; 

// ===============================
// Validasi POST
// ===============================
if (!isset($_POST['data'])) {
    http_response_code(400);
    echo json_encode(["status" => "error", "msg" => "Missing POST data"]);
    exit;
}

$data = json_decode($_POST['data'], true);

if (!$data) {
    http_response_code(400);
    echo json_encode(["status" => "error", "msg" => "Invalid JSON"]);
    exit;
}

// ===============================
// Ambil candno
// ===============================
$candno = $conn->real_escape_string($data["candno"]);

// ===============================
// Ambil referee1, referee2, referee3
// ===============================
$referees = [
    $data["referee1"] ?? [],
    $data["referee2"] ?? [],
    $data["referee3"] ?? []
];

// ===============================
// Insert per referee
// ===============================
$errors = [];
$successCount = 0;

foreach ($referees as $ref) {

    // Skip jika kosong semua
    if (
        empty($ref["company"]) &&
        empty($ref["role"]) &&
        empty($ref["name"]) &&
        empty($ref["email"]) &&
        empty($ref["phone"])
    ) {
        continue;
    }
    
    // Escape
    $company   = $conn->real_escape_string($ref["company"]);
    $role      = $conn->real_escape_string($ref["role"]);
    $start     = $conn->real_escape_string($ref["start"]);
    $end       = $conn->real_escape_string($ref["end"]);
    $name      = $conn->real_escape_string($ref["name"]);
    $job       = $conn->real_escape_string($ref["job"]);
    $email     = $conn->real_escape_string($ref["email"]);
    $phone     = $conn->real_escape_string($ref["phone"]);
    $relation  = $conn->real_escape_string($ref["relation"]);

    // SQL Insert
    $sql = "
        INSERT INTO ti_candidaterefee_candform
        (
            dbcandno,
            companyReff, roleReff, startDateReff, endDateReff,
            refereesFullNameReff, refereesJobTitleReff,
            refereesEmailReff, refereesNumberReff,
            refereesRelationshipToCandidateReff
        )
        VALUES
        (
            '$candno',
            '$company','$role','$start','$end',
            '$name','$job',
            '$email','$phone',
            '$relation'
        )
    ";

    if ($conn->query($sql)) {
        $successCount++;
    } else {
        $errors[] = $conn->error;
    }
}

// ===============================
// Response
// ===============================
if (!empty($errors)) {
    echo json_encode([
        "status" => "partial",
        "inserted" => $successCount,
        "errors" => $errors
    ]);
} else {
    echo json_encode([
        "status" => "success",
        "inserted" => $successCount
    ]);
}

?>
