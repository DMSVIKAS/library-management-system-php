<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "library";

$db = mysqli_connect($host, $user, $pass, $dbname);

if (!$db) {
    die("Database connection failed.");
}
?>