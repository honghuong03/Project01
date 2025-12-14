CREATE DATABASE studentdb CHARACTER SET utf8mb4;
USE studentdb;

CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_code VARCHAR(20) NOT NULL,
    full_name VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL,
    birth_date DATE,
    major VARCHAR(100) CHARACTER SET utf8mb4,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO students (student_code, full_name, birth_date, major) VALUES
('SV001', 'Nguyễn Văn A', '2002-05-10', 'Công nghệ thông tin'),
('SV002', 'Trần Thị B', '2001-11-22', 'Khoa học máy tính'),
('SV003', 'Lê Văn C', '2002-03-18', 'Kỹ thuật phần mềm');
