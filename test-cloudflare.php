<?php

$host = "127.0.0.1"; // ini yang dibuat cloudflared
$port = 5400;
$user = "root"; 
$pass = "";
$db   = "trackitlive";

$conn = new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

echo "Koneksi MySQL BERHASIL!<br>";

$result = $conn->query("SELECT NOW() as waktu");

$row = $result->fetch_assoc();

echo "Waktu server: " . $row['waktu'];

?>