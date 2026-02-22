<?php
$host = "mainline.proxy.rlwy.net";
$user = "root";
$password = "hello123";
$database = "railway";
$port = 53273;

$db = mysqli_connect($host, $user, $password, $database, $port);

if (!$db) {
    exit("Database connection failed.");
}
?>
