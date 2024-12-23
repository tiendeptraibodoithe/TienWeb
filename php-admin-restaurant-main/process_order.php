<?php
session_start();
header('Content-Type: application/json');

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quanlyquan";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode([
        'success' => false, 
        'message' => 'Database connection failed'
    ]);
    exit;
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode([
        'success' => false, 
        'message' => 'Vui lòng đăng nhập'
    ]);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);

if (empty($input['cart'])) {
    echo json_encode([
        'success' => false, 
        'message' => 'Giỏ hàng trống'
    ]);
    exit;
}

// Start transaction
$conn->begin_transaction();

try {
    $user_id = $_SESSION['user_id'];
    $total_amount = array_reduce($input['cart'], function($carry, $item) {
        return $carry + ($item['price'] * $item['quantity']);
    }, 0);


    $order_sql = "INSERT INTO don_hang (user_id, tong_tien, ngay_dat, khach_hang, ban_so) VALUES (?, ?, NOW(), ?, ?)";
    $order_stmt = $conn->prepare($order_sql);
    $order_stmt->bind_param("idss", $user_id, $total_amount, $input['customerName'], $input['tableNumber']);
    $order_stmt->execute();
    $order_id = $conn->insert_id;


    $detail_sql = "INSERT INTO chi_tiet_don_hang (don_hang_id, mon_an_id, so_luong, gia) VALUES (?, ?, ?, ?)";
    $detail_stmt = $conn->prepare($detail_sql);

    foreach ($input['cart'] as $item) {
        $detail_stmt->bind_param("iiid", $order_id, $item['id'], $item['quantity'], $item['price']);
        $detail_stmt->execute();
    }


    $conn->commit();

    echo json_encode([
        'success' => true, 
        'message' => 'Đặt hàng thành công',
        'order_id' => $order_id
    ]);
} catch (Exception $e) {
    // Rollback transaction
    $conn->rollback();

    echo json_encode([
        'success' => false, 
        'message' => 'Lỗi xử lý đơn hàng: ' . $e->getMessage()
    ]);
}

$conn->close();
?>