<?php
require_once "config.php";

$sql = "SELECT * FROM students";
$stmt = $conn->prepare($sql);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách sinh viên</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>

<div class="page">
    <h1>📘 Danh sách sinh viên</h1>

    <div class="table-wrapper">
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
                <?php foreach ($data as $row): ?>
                <tr>
                    <td><?= $row['student_code']; ?></td>
                    <td><?= $row['full_name']; ?></td>
                    <td><?= $row['birth_date']; ?></td>
                    <td><?= $row['major']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
