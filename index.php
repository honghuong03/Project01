<?php
require_once "config.php";

$sql = "SELECT * FROM students";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách sinh viên</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h1>📋 Danh sách sinh viên</h1>

<table>
    <thead>
        <tr>
            <th>Mã SV</th>
            <th>Họ tên</th>
            <th>Ngày sinh</th>
            <th>Chuyên ngành</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?= $row['student_code']; ?></td>
            <td><?= $row['full_name']; ?></td>
            <td><?= $row['birth_date']; ?></td>
            <td><?= $row['major']; ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

</body>
</html>
