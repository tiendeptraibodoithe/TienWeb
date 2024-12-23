<?php
// Kết nối với cơ sở dữ liệu
$connection = new mysqli('localhost', 'root', '', 'quanlyquan');

// Kiểm tra kết nối
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Truy vấn dữ liệu có thêm thông tin khách hàng và bàn
$query = "
    SELECT 
        dh.id AS order_id,
        dh.ngay_dat AS order_date,
        dh.tong_tien AS total_amount,
        dh.khach_hang AS customer_name,
        dh.ban_so AS table_number,
        ma.ten_mon AS food_name,
        ctdh.so_luong AS quantity,
        ctdh.gia AS price
    FROM 
        don_hang dh
    JOIN 
        chi_tiet_don_hang ctdh ON dh.id = ctdh.don_hang_id
    JOIN 
        mon_an ma ON ctdh.mon_an_id = ma.id
    ORDER BY 
        dh.ngay_dat DESC, dh.id, ctdh.mon_an_id
";

// Thực thi câu truy vấn
$result = $connection->query($query);

// Kiểm tra và xử lý kết quả
$orders = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $order_id = $row['order_id'];
        
        // Nếu đơn hàng đã tồn tại trong mảng, gộp món ăn và giá trị
        if (isset($orders[$order_id])) {
            $orders[$order_id]['food_names'][] = $row['food_name'] . " (x" . $row['quantity'] . ")";
            $orders[$order_id]['total_price'] += $row['quantity'] * $row['price'];
        } else {
            $orders[$order_id] = [
                'order_id' => $order_id,
                'order_date' => $row['order_date'],
                'customer_name' => $row['customer_name'],
                'table_number' => $row['table_number'],
                'food_names' => [$row['food_name'] . " (x" . $row['quantity'] . ")"],
                'total_price' => $row['quantity'] * $row['price']
            ];
        }
    }

    // Hiển thị kết quả
    $stt = 1;
    foreach ($orders as $order) {
        echo "<tr>";
        echo "<td>" . $stt++ . "</td>";
        echo "<td>" . $order['order_id'] . "</td>";
        echo "<td>" . $order['order_date'] . "</td>";
        echo "<td>" . $order['customer_name'] . "</td>";
        echo "<td>" . $order['table_number'] . "</td>";
        echo "<td>" . implode(', ', $order['food_names']) . "</td>";
        echo "<td>" . number_format($order['total_price'], 3) . " VND</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7'>Không có đơn hàng nào.</td></tr>";
}

// Đóng kết nối
$connection->close();
?>