<?php
require "config.php";

// Ambil code dari parameter rewrite
$code = isset($_GET['code']) ? trim($_GET['code']) : "";

// Jika tidak ada code → tampilkan form
if ($code === "") {
    header("Location: https://alliedrec.com.au/", true, 302);
    exit;
}

// Escape
$code = $conn->real_escape_string($code);

// Query
$sql = "SELECT long_url FROM shortlinks WHERE code='$code'";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    header("Location: " . $row['long_url'], true, 302);
    exit;
} else {
    echo "Short link tidak ditemukan.";
}
?>