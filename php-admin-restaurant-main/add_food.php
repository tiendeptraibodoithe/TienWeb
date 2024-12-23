<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quanlyquan";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Kết nối thất bại: ' . $conn->connect_error
    ]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $image = $_POST['image'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("INSERT INTO mon_an (ten_mon, gia, the_loai, hinh_anh, mo_ta) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $price, $category, $image, $description);

    if ($stmt->execute()) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Thêm món ăn thành công!'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Lỗi: ' . $stmt->error
        ]);
    }

    $stmt->close();
    $conn->close();
}
?>
