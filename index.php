<?php
require_once "config.php";

/* ======================
   XỬ LÝ THÊM SINH VIÊN
====================== */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_code = $_POST['student_code'] ?? '';
    $full_name    = $_POST['full_name'] ?? '';
    $birth_date   = $_POST['birth_date'] ?? null;
    $major        = $_POST['major'] ?? '';

    if ($student_code && $full_name) {
        $sqlInsert = "INSERT INTO students (student_code, full_name, birth_date, major)
                      VALUES (:code, :name, :birth, :major)";
        $stmtInsert = $conn->prepare($sqlInsert);
        $stmtInsert->execute([
            'code'  => $student_code,
            'name'  => $full_name,
            'birth' => $birth_date,
            'major' => $major
        ]);

        // Tránh submit lại khi F5
        header("Location: index.php");
        exit;
    }
}

/* ======================
   XỬ LÝ TÌM KIẾM
====================== */
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
    <link rel="stylesheet" href="./CSS/style.css">
</head>
<body>
    <div class="page">
        <h1>Danh sách sinh viên</h1>
        <!-- FORM THÊM SINH VIÊN -->
        <form method="post" class="card add-student-card">
        <div class="card-header">
            <h3>Thêm sinh viên</h3>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label>Mã sinh viên</label>
                <input type="text" name="student_code" placeholder="VD: SV001" required>
            </div>
            <div class="form-group">
                <label>Họ và tên</label>
                <input type="text" name="full_name" placeholder="Nguyễn Văn A" required>
            </div>
            <div class="form-group">
                <label>Ngày sinh</label>
                <input type="date" name="birth_date">
            </div>
            <div class="form-group">
                <label>Chuyên ngành</label>
                <input type="text" name="major" placeholder="Công nghệ thông tin">
            </div>
        </div>
        <div class="card-footer">
            <button type="submit">Thêm sinh viên</button>
        </div>
    </form>
        <!-- SEARCH -->
        <form method="get" class="search-card">
        <input type="text"
            name="keyword"
            placeholder="Tìm theo mã hoặc tên sinh viên..."
            value="<?= htmlspecialchars($keyword) ?>">
        <button type="submit">Tìm kiếm</button>
    </form>
        <!-- TABLE -->
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
                        <td><?= htmlspecialchars($row['student_code']); ?></td>
                        <td><?= htmlspecialchars($row['full_name']); ?></td>
                        <td><?= $row['birth_date']; ?></td>
                        <td><?= htmlspecialchars($row['major']); ?></td>
                    </tr>
                    <?php endforeach; ?>

                    <?php if (empty($data)): ?>
                    <tr>
                        <td colspan="4">Không có dữ liệu</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
