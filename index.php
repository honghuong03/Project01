<?php
require_once "config.php";

/* 1️⃣ Xử lý tìm kiếm */
$keyword = $_GET['keyword'] ?? '';

if ($keyword !== '') {
    $sql = "SELECT * FROM students
            WHERE student_code LIKE :kw
               OR full_name LIKE :kw";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['kw' => "%$keyword%"]);
} else {
    $sql = "SELECT * FROM students";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
}

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

    <!-- 2️⃣ FORM SEARCH -->
    <form class="search-box" method="get">
        <input
            type="text"
            name="keyword"
            placeholder="Tìm mã SV hoặc họ tên..."
            value="<?= htmlspecialchars($keyword) ?>">
        <button type="submit">🔍 Tìm</button>
    </form>

    <!-- 3️⃣ BẢNG DANH SÁCH -->
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Mã SV</th>
                    <th>Họ tên</th>
                    <th>Ngày sinh</th>
                    <th>Chuyên ngành</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($data) === 0): ?>
                    <tr>
                        <td colspan="5">Không có dữ liệu</td>
                    </tr>
                <?php endif; ?>

                <?php foreach ($data as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['student_code']) ?></td>
                    <td><?= htmlspecialchars($row['full_name']) ?></td>
                    <td><?= $row['birth_date'] ?></td>
                    <td><?= htmlspecialchars($row['major']) ?></td>
                    <td>
                        <a class="btn edit" href="edit.php?id=<?= $row['id'] ?>">✏️ Sửa</a>
                        <a class="btn delete"
                           href="delete.php?id=<?= $row['id'] ?>"
                           onclick="return confirm('Xoá sinh viên này?')">
                           🗑️ Xoá
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
