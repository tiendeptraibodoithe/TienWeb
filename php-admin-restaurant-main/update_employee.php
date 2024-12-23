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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $ma_nv = $conn->real_escape_string($_POST['ma_nv']);
    $ho_ten = $conn->real_escape_string($_POST['ho_ten']);
    $so_dien_thoai = $conn->real_escape_string($_POST['so_dien_thoai']);
    $email = $conn->real_escape_string($_POST['email']);
    $gioi_tinh = $conn->real_escape_string($_POST['gioi_tinh']);
    $ngay_sinh = $conn->real_escape_string($_POST['ngay_sinh']);
    $luong = $conn->real_escape_string($_POST['luong']);

    // Chuẩn bị câu lệnh UPDATE
    $sql = "UPDATE nhan_vien SET 
            ho_ten = '$ho_ten', 
            so_dien_thoai = '$so_dien_thoai', 
            email = '$email', 
            gioi_tinh = '$gioi_tinh', 
            ngay_sinh = '$ngay_sinh', 
            luong = '$luong' 
            WHERE ma_nv = '$ma_nv'";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }

    $conn->close();
}
?>