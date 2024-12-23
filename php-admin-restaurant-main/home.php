<?php
$servername = "localhost";
$username = "root";  
$password = "";      
$dbname = "quanlyquan";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 1. Total Revenue (Tổng Doanh Thu)
$revenue_query = "SELECT SUM(so_luong * gia) AS total_revenue 
                  FROM chi_tiet_don_hang";
$revenue_result = $conn->query($revenue_query);
$total_revenue = ($revenue_result->fetch_assoc())['total_revenue'];

// 2. Number of Menu Items (Số Thức Uống)
$menu_query = "SELECT COUNT(*) AS total_menu_items FROM mon_an";
$menu_result = $conn->query($menu_query);
$total_menu_items = ($menu_result->fetch_assoc())['total_menu_items'];

// 3. Number of Employees (Nhân Viên)
$employee_query = "SELECT COUNT(*) AS total_employees FROM nhan_vien";
$employee_result = $conn->query($employee_query);
$total_employees = ($employee_result->fetch_assoc())['total_employees'];

// 4. Total Orders (Tổng Hóa Đơn)
$orders_query = "SELECT COUNT(*) AS total_orders FROM don_hang";
$orders_result = $conn->query($orders_query);
$total_orders = ($orders_result->fetch_assoc())['total_orders'];

// Close connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Afacad+Flux:wght@100..1000&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="./css/global.css" />
    <link rel="stylesheet" href="./css/home.css" />
    <link rel="stylesheet" href="./css/themify-icons.css" />
  </head>
  <body>
    <div class="container-fluid">
      <div class="row">
      <?php include 'bar.php'; ?>
        <div class="col"></div>
        <div class="col-10 main">
          <div class="header d-flex align-items-center justify-content-between">
            <div class="input-group search-bar">
              <input
                type="text"
                class="form-control"
                placeholder="Vui lòng nhập..."
                aria-label="Recipient's username"
                aria-describedby="button-addon2"
              />
              <button
                class="btn btn-outline-success"
                type="button"
                id="button-addon2"
              >
                Tìm kiếm
              </button>
            </div>
            <div class="d-flex gap-2 align-items-center header_user">
              <span>Chào, Quản lý! </span>
              <i class="ti-angle-down dropdown-user"></i>

              <ul class="list-group header_user-dropdown visually-hidden">
                <a href="./user.php" class="list-group-item">Tài khoản</a>
                <a
                  href="index.php"
                  class="list-group-item"
                  >Trở về</a
                >
              </ul>
            </div>
          </div>
          <div class="mt-4 wrapper-content">
            <h3>Trang chủ</h3>
            <div class="mt-4 greeting px-5 py-4 shadow-sm">
              <h2>Xin chào!</h2>
              <div
                class="d-flex flex-wrap wrapper_greeting-text align-items-center"
              >
                <p class="mt-2 greeting-text">
                  Đây là không gian dành riêng cho người quản lý, với mục đích
                  theo dõi và điều hành hoạt động của Katilat một cách
                  hiệu quả.
                </p>
                <a
                  href="#start"
                  type="button"
                  class="btn btn-success greeting-btn px-3 d-flex gap-2 align-items-center bg-success-btn"
                >
                  <i class="ti-arrow-down"></i>
                  Bắt đầu
                </a>
              </div>
            </div>
            <div class="row mt-4 gap-3 items_containter-index" id="start">
              <div class="col text-center shadow-sm item-index">
                <div class="text-item-index1">TỔNG DOANH THU</div>
                <div class="text-item-index2"><?php echo number_format($total_revenue, 3, ',', '.'); ?></div>
                <div class="text-item-index3">VNĐ</div>
              </div>
              <div class="col text-center shadow-sm item-index">
                <div class="text-item-index1">SỐ THỨC UỐNG</div>
                <div class="text-item-index2"><?php echo $total_menu_items; ?></div>
                <div class="text-item-index3">Loại</div>
              </div>
              <div class="col text-center shadow-sm item-index">
                <div class="text-item-index1">NHÂN VIÊN</div>
                <div class="text-item-index2"><?php echo $total_employees; ?></div>
                <div class="text-item-index3">Người</div>
              </div>
              <div class="col text-center shadow-sm item-index">
                <div class="text-item-index1">TỔNG HÓA ĐƠN</div>
                <div class="text-item-index2"><?php echo $total_orders; ?></div>
                <div class="text-item-index3">Đơn</div>
              </div>
            </div>
            <div class="row mt-4 gap-3 chart-container">
              <div class="col chart rounded shadow-sm">
                <canvas id="linechart"></canvas>
              </div>
              <div class="col chart rounded shadow-sm">
                <canvas id="barchart"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div
      class="modal fade"
      id="signOut"
      tabindex="-1"
      aria-labelledby="signOutLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="signOutLabel">Đăng xuất</h1>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">Bạn chắc chắn muốn đăng xuất?</div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Đóng
            </button>
            <a
              href="./login.php"
              type="button"
              class="btn btn-danger bg-danger-btn"
              >Đăng xuất</a
            >
          </div>
        </div>
      </div>
    </div>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="./js/chart.js"></script>
    <script src="./js/home.js"></script>
  </body>
</html>
