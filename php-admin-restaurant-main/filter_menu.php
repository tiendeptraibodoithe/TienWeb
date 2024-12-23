<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quanlyquan";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}

$category = isset($_GET['category']) ? $_GET['category'] : '';

$sql = "SELECT * FROM mon_an";
if ($category) {
    $sql .= " WHERE the_loai = '" . $conn->real_escape_string($category) . "'";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<div class="col-12 col-sm-6 col-lg-3 mt-4">';
        echo '    <div class="card">';
        echo '        <div class="ratio ratio-4x3">';
        echo '            <img src="' . htmlspecialchars($row["hinh_anh"]) . '" class="card-img-top" alt="' . htmlspecialchars($row["ten_mon"]) . '">';
        echo '        </div>';
        echo '        <div class="card-body">';
        echo '            <h5 class="card-title">' . htmlspecialchars($row["ten_mon"]) . '</h5>';
        echo '            <p class="card-text">Giá: ' . number_format($row["gia"]) . 'đ <br />Thể loại: ' . htmlspecialchars($row["the_loai"]) . '</p>';
        echo '            <div class="d-flex gap-2">';
        echo '                <button class="btn btn-primary add-to-cart" data-id="' . $row["id"] . '">Thêm vào giỏ</button>';
        echo '            </div>';
        echo '        </div>';
        echo '    </div>';
        echo '</div>';
    }
} else {
    echo '<div class="col-12"><p class="text-center text-white">Không có sản phẩm nào</p></div>';
}

$conn->close();
?>