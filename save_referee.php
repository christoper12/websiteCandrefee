<?php
header("Content-Type: application/json");

require_once "config.php"; // koneksi DB

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

$candno = $conn->real_escape_string($data["candno"]);

// Referee 1
$r1_company = $conn->real_escape_string($data["referee1"]["company"]);
$r1_role = $conn->real_escape_string($data["referee1"]["role"]);
$r1_start = $conn->real_escape_string($data["referee1"]["start"]);
$r1_end = $conn->real_escape_string($data["referee1"]["end"]);
$r1_name = $conn->real_escape_string($data["referee1"]["name"]);
$r1_job = $conn->real_escape_string($data["referee1"]["job"]);
$r1_email = $conn->real_escape_string($data["referee1"]["email"]);
$r1_phone = $conn->real_escape_string($data["referee1"]["phone"]);
$r1_relation = $conn->real_escape_string($data["referee1"]["relation"]);

// Referee 2
$r2_company = $conn->real_escape_string($data["referee2"]["company"]);
$r2_role = $conn->real_escape_string($data["referee2"]["role"]);
$r2_start = $conn->real_escape_string($data["referee2"]["start"]);
$r2_end = $conn->real_escape_string($data["referee2"]["end"]);
$r2_name = $conn->real_escape_string($data["referee2"]["name"]);
$r2_job = $conn->real_escape_string($data["referee2"]["job"]);
$r2_email = $conn->real_escape_string($data["referee2"]["email"]);
$r2_phone = $conn->real_escape_string($data["referee2"]["phone"]);
$r2_relation = $conn->real_escape_string($data["referee2"]["relation"]);

// Referee 3
$r3_company = $conn->real_escape_string($data["referee3"]["company"]);
$r3_role = $conn->real_escape_string($data["referee3"]["role"]);
$r3_start = $conn->real_escape_string($data["referee3"]["start"]);
$r3_end = $conn->real_escape_string($data["referee3"]["end"]);
$r3_name = $conn->real_escape_string($data["referee3"]["name"]);
$r3_job = $conn->real_escape_string($data["referee3"]["job"]);
$r3_email = $conn->real_escape_string($data["referee3"]["email"]);
$r3_phone = $conn->real_escape_string($data["referee3"]["phone"]);
$r3_relation = $conn->real_escape_string($data["referee3"]["relation"]);

$sql = "
INSERT INTO ti_candidaterefee_candform 
(
    dbcandno,

    companyReff1, roleReff1, startDateReff1, endDateReff1, refereesFullNameReff1, 
    refereesJobTitleReff1, refereesEmailReff1, refereesNumberReff1, refereesRelationshipToCandidateReff1,

    companyReff2, roleReff2, startDateReff2, endDateReff2, refereesFullNameReff2, 
    refereesJobTitleReff2, refereesEmailReff2, refereesNumberReff2, refereesRelationshipToCandidateReff2,

    companyReff3, roleReff3, startDateReff3, endDateReff3, refereesFullNameReff3, 
    refereesJobTitleReff3, refereesEmailReff3, refereesNumberReff3, refereesRelationshipToCandidateReff3
)
VALUES 
(
    '$candno',

    '$r1_company','$r1_role','$r1_start','$r1_end','$r1_name',
    '$r1_job','$r1_email','$r1_phone','$r1_relation',

    '$r2_company','$r2_role','$r2_start','$r2_end','$r2_name',
    '$r2_job','$r2_email','$r2_phone','$r2_relation',

    '$r3_company','$r3_role','$r3_start','$r3_end','$r3_name',
    '$r3_job','$r3_email','$r3_phone','$r3_relation'
)
";

if ($conn->query($sql)) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "msg" => $conn->error]);
}

?>