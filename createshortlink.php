<?php
require "config.php";

if (!isset($_POST['url'])) {
    echo "URL tidak ditemukan";
    exit;
}

$longUrl = $conn->real_escape_string($_POST['url']);
$code = substr(md5(uniqid()), 0, 6);

$sql = "INSERT INTO shortlinks (code, long_url) VALUES ('$code', '$longUrl')";

if ($conn->query($sql)) {
    $shortUrl = "https://" . $_SERVER['HTTP_HOST'] . "/candidaterefee/" . $code;
    echo "Short URL: <a href='$shortUrl'>$shortUrl</a>";
} else {
    echo "Gagal membuat short link.";
}
?>