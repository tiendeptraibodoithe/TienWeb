<?php
// Kết nối đến cơ sở dữ liệu
function connectDatabase() {
    $servername = "localhost";
    $username = "root";  // Thay đổi thành username của bạn
    $password = "";      // Thay đổi thành password của bạn
    $dbname = "quanlyquan";

    // Tạo kết nối
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    return $conn;
}

// Xử lý đăng ký
function registerUser($fullname, $email, $password) {
    $conn = connectDatabase();

    // Kiểm tra email đã tồn tại chưa
    $check_email = $conn->prepare("SELECT * FROM tai_khoan WHERE email = ?");
    $check_email->bind_param("s", $email);
    $check_email->execute();
    $result = $check_email->get_result();

    if ($result->num_rows > 0) {
        // Email đã tồn tại
        $conn->close();
        return "Email đã được sử dụng";
    }

    // Mã hóa mật khẩu (sử dụng password_hash)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Chuẩn bị câu lệnh SQL để chèn dữ liệu
    $stmt = $conn->prepare("INSERT INTO tai_khoan (ten_tai_khoan, email, mat_khau) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $fullname, $email, $hashed_password);

    // Thực thi câu lệnh
    if ($stmt->execute()) {
        $conn->close();
        return "success";
    } else {
        $conn->close();
        return "Đăng ký thất bại: " . $stmt->error;
    }
}

// Xử lý form submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Kiểm tra dữ liệu đầu vào
    if (empty($fullname) || empty($email) || empty($password)) {
        $error = "Vui lòng điền đầy đủ thông tin";
    } else {
        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Địa chỉ email không hợp lệ";
        } else {
            // Thực hiện đăng ký
            $result = registerUser($fullname, $email, $password);

            if ($result === "success") {
                // Đăng ký thành công, chuyển hướng đến trang đăng nhập
                header("Location: login.php?register=success");
                exit();
            } else {
                // Hiển thị lỗi
                $error = $result;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đăng Ký Tài Khoản</title>
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
    <link
      href="https://fonts.googleapis.com/css2?family=LXGW+WenKai+TC&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="./css/global.css" />
    <link rel="stylesheet" href="./css/themyi-icons.css" />
    <style>
      body {
        background-image: url('./img/milktea.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        font-family: 'LXGW WenKai TC', sans-serif;
      }
      .login-page {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: rgba(0, 0, 0, 0.5);
      }
      .login-container {
        max-width: 500px;
        width: 100%;
        padding: 40px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      }
      .login-text {
        font-family: 'Afacad Flux', sans-serif;
        font-weight: 700;
        color: #333;
      }
      .form-floating .form-control {
        border-radius: 6px;
        padding: 12px 16px;
        font-size: 16px;
      }
      .btn-success-btn {
        background-color: #28a745;
        border-color: #28a745;
        font-size: 16px;
        padding: 12px 0;
        transition: background-color 0.3s ease;
      }
      .btn-success-btn:hover {
        background-color: #218838;
      }
      .login-btn {
        width: 100%;
      }
      .register-link {
        margin-top: 20px;
        font-size: 14px;
      }
      .register-link a {
        color: #007bff;
        text-decoration: none;
      }
      .register-link a:hover {
        text-decoration: underline;
      }
    </style>
  </head>
  <body>
    <div class="container-fluid login-page">
      <div class="row login-container">
        <div class="col-12 login-form text-center">
          <h2 class="login-text mb-4">Đăng ký</h2>
          
          <?php if(isset($error)): ?>
            <div class="alert alert-danger mb-3"><?php echo $error; ?></div>
          <?php endif; ?>

          <form action="signup.php" method="post">
            <div class="form-floating mb-3">
              <input
                type="text"
                class="form-control"
                id="floatingFullName"
                name="fullname"
                placeholder="Họ và tên"
                required
              />
              <label for="floatingFullName">Họ và tên</label>
            </div>
            <div class="form-floating mb-3">
              <input
                type="email"
                class="form-control"
                id="floatingInput"
                name="email"
                placeholder="name@example.com"
                required
              />
              <label for="floatingInput">Địa chỉ email</label>
            </div>
            <div class="form-floating mb-4">
              <input
                type="password"
                class="form-control"
                id="floatingPassword"
                name="password"
                placeholder="Password"
                required
              />
              <label for="floatingPassword">Mật khẩu</label>
            </div>
            <button type="submit" class="btn btn-success bg-success-btn login-btn mb-3">
              Đăng ký
            </button>
          </form>
          <div class="register-link">
            Bạn đã có tài khoản? <a href="./login.php">Đăng nhập</a>
          </div>
        </div>
      </div>
    </div>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>