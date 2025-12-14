<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "studentdb";

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Kết nối database thất bại: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");
