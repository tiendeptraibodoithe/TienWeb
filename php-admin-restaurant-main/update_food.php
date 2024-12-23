<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quanlyquan";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode([
        'status' => 'error', 
        'message' => "Kết nối thất bại: " . $conn->connect_error
    ]));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $image = $_POST['image'];

    $sql = "UPDATE mon_an SET ten_mon = ?, gia = ?, the_loai = ?, hinh_anh = ?, mo_ta = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisssi", $name, $price, $category, $image, $description, $id);

    try {
        if ($stmt->execute()) {
            // Lấy thông tin món ăn đã cập nhật để trả về
            $selectSql = "SELECT * FROM mon_an WHERE id = ?";
            $selectStmt = $conn->prepare($selectSql);
            $selectStmt->bind_param("i", $id);
            $selectStmt->execute();
            $result = $selectStmt->get_result();
            $updatedFood = $result->fetch_assoc();

            echo json_encode([
                'status' => 'success', 
                'message' => 'Cập nhật món ăn thành công!',
                'food' => $updatedFood
            ]);
        } else {
            echo json_encode([
                'status' => 'error', 
                'message' => "Lỗi cập nhật: " . $stmt->error
            ]);
        }
    } catch (Exception $e) {
        echo json_encode([
            'status' => 'error', 
            'message' => "Lỗi: " . $e->getMessage()
        ]);
    }

    $stmt->close();
} else {
    echo json_encode([
        'status' => 'error', 
        'message' => "Phương thức yêu cầu không hợp lệ."
    ]);
}

$conn->close();
?>