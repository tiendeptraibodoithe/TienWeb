<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quanlyquan";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && !empty($_POST['id'])) {
    $id = $conn->real_escape_string($_POST['id']);
    
    // Truy vấn xóa
    $sql = "DELETE FROM nhan_vien WHERE ma_nv = '$id'";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }
    
    $conn->close();
} else {
    echo json_encode(['success' => false, 'error' => 'ID không hợp lệ']);
}
?>