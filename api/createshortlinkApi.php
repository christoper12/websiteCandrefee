<?php
require "../config.php";

if (!isset($_GET['url'])) {
    echo "ERROR: url parameter missing";
    exit;
}

$longUrl = $conn->real_escape_string($_GET['url']);
$code = substr(md5(uniqid()), 0, 6);

$sql = "INSERT INTO shortlinks (code, long_url) VALUES ('$code', '$longUrl')";

if ($conn->query($sql)) {
    $shortUrl = "https://" . $_SERVER['HTTP_HOST'] . "/candidaterefee/" . $code;
    echo $shortUrl;
} else {
    echo "ERROR: failed to create link";
}
?>