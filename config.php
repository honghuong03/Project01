<?php
define("HOST", "sql113.infinityfree.com");          // MySQL Hostname
define("DATABASE", "if0_40557505_studentdb");       // Database Name
define("USERNAME", "if0_40557505");                // MySQL Username
define("PASSWORD", "Honghuong12345");              // MySQL Password

try {
    $conn = new PDO(
        "mysql:host=" . HOST . ";dbname=" . DATABASE . ";charset=utf8",
        USERNAME,
        PASSWORD
    );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Kết nối database thất bại: " . $e->getMessage());
}
?>