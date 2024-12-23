<?php
$host = "localhost"; 
$user = "root";      
$password = "";      
$database = "quanlyquan";

// Kết nối tới MySQL
$connection = new mysqli($host, $user, $password, $database);

// Kiểm tra kết nối
if ($connection->connect_error) {
    die("Kết nối thất bại: " . $connection->connect_error);
}

// Lấy giá trị bộ lọc thời gian từ GET parameter
$timeFilter = isset($_GET['timeFilter']) ? $_GET['timeFilter'] : 'all-time';

// Chuẩn bị truy vấn cơ sở dữ liệu
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
    WHERE 1=1
";

// Thêm điều kiện thời gian dựa trên giá trị timeFilter
switch ($timeFilter) {
    case 'this-week':
        $query .= " AND dh.ngay_dat >= DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) DAY)";
        break;
    case 'this-month':
        $query .= " AND YEAR(dh.ngay_dat) = YEAR(CURDATE()) AND MONTH(dh.ngay_dat) = MONTH(CURDATE())";
        break;
    case 'this-year':
        $query .= " AND YEAR(dh.ngay_dat) = YEAR(CURDATE())";
        break;
    default:
        // Không áp dụng bộ lọc thời gian
        break;
}

// Sắp xếp đơn hàng theo ngày đặt và ID
$query .= " ORDER BY dh.ngay_dat DESC, dh.id, ctdh.mon_an_id";

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
        echo "<td>" . htmlspecialchars($order['order_id']) . "</td>";
        echo "<td>" . htmlspecialchars($order['order_date']) . "</td>";
        echo "<td>" . htmlspecialchars($order['customer_name']) . "</td>";
        echo "<td>" . htmlspecialchars($order['table_number']) . "</td>";
        echo "<td>" . htmlspecialchars(implode(', ', $order['food_names'])) . "</td>";
        echo "<td>" . number_format($order['total_price'], 3) . " VND</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7' class='text-center'>Không có đơn hàng nào.</td></tr>";
}

// Đóng kết nối
$connection->close();
?>
