<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quanlyquan";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    // Xóa món ăn khỏi cơ sở dữ liệu
    $sql = "DELETE FROM mon_an WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Xóa món ăn thành công!";
    } else {
        echo "Có lỗi xảy ra. Vui lòng thử lại.";
    }

    $stmt->close();
}

$conn->close();
?>
