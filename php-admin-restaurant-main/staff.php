<?php
// Phần xử lý kết nối CSDL và thêm nhân viên
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quanlyquan";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra nếu form được submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Lấy dữ liệu từ form
        $ho_ten = $_POST['ho_ten'];
        $so_dien_thoai = $_POST['so_dien_thoai'];
        $email = $_POST['email'];
        $gioi_tinh = $_POST['gioi_tinh'];
        $ngay_sinh = $_POST['ngay_sinh'];
        $luong = $_POST['luong'];
    
        // Kiểm tra email đã tồn tại chưa
        $check_email = $conn->prepare("SELECT * FROM nhan_vien WHERE email = ?");
        $check_email->bind_param("s", $email);
        $check_email->execute();
        $result = $check_email->get_result();
    
        if ($result->num_rows > 0) {
            echo "<script>alert('Email đã tồn tại!');</script>";
        } else {
            // Chuẩn bị câu lệnh SQL
            $stmt = $conn->prepare("INSERT INTO nhan_vien (ho_ten, so_dien_thoai, email, gioi_tinh, ngay_sinh, luong) VALUES (?, ?, ?, ?, ?, ?)");
            
            // Liên kết các tham số
            $stmt->bind_param("sssssd", $ho_ten, $so_dien_thoai, $email, $gioi_tinh, $ngay_sinh, $luong);
    
            // Thực thi câu lệnh
            if ($stmt->execute()) {
                echo "<script>
                    alert('Thêm nhân viên thành công!');
                    window.location.href = window.location.href; // Refresh trang
                </script>";
            } else {
                echo "<script>alert('Lỗi: " . $stmt->error . "');</script>";
            }
    
            // Đóng statement
            $stmt->close();
        }
    
        $check_email->close();
}

// Truy vấn lấy danh sách nhân viên
$sql = "SELECT * FROM nhan_vien";
$result = $conn->query($sql);
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
    <link rel="stylesheet" href="./css/staff.css" />
    <link rel="stylesheet" href="./css/themify-icons.css" />
  </head>
  <body>
    <div class="container-fluid">
      <div class="row">
        <div class="col-2 tab py-3">
          <div class="d-flex px-4">
            <h4 class="mb-0">ADMIN</h4>
          </div>
          <hr />
          <a href="./home.php" class="mt-4 tab_item">
            <i class="ti-home"></i>
            <span>Trang chủ</span>
          </a>
          <a href="./menu.php" class="tab_item">
            <i class="ti-menu-alt"></i>
            <span>Thực đơn</span>
          </a>
          <a href="./staff.php" class="tab_item active">
            <i class="ti-user"></i>
            <span>Nhân viên</span>
          </a>
          <a href="./order.php" class="tab_item">
            <i class="ti-clipboard"></i>
            <span>Đơn hàng</span>
          </a>
          <!-- <hr class="hr-tab" /> -->
          <button
            class="btn btn-danger bg-danger-btn logout-btn"
            data-bs-toggle="modal"
            data-bs-target="#signOut"
          >
            Đăng xuất
          </button>
        </div>
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
                <a href="./user.html" class="list-group-item">Tài khoản</a>
                <a
                  href="./index.php"
                  class="list-group-item"
                  >Trở về</a
                >
              </ul>
            </div>
          </div>
          <div class="mt-4 wrapper-content">
            <div class="d-flex justify-content-between">
              <h3>Nhân viên</h3>
              <div class="d-flex gap-2 justify-content-end wrapper-staff-btn">
                <button
                  type="button"
                  class="btn btn-primary bg-primary-btn bg-primary-btn export-staff-btn"
                >
                  <i class="ti-export"></i>
                  Xuất CSV
                </button>
                <button
                  type="button"
                  class="btn btn-success bg-success-btn add-staff-btn"
                  data-bs-toggle="modal"
                  data-bs-target="#modalAdd"
                >
                  <i class="ti-plus"></i>
                  Thêm
                </button>
              </div>
            </div>
            <table class="table table-bordered mt-4">
              <thead>
                <tr>
                  <th scope="col">Mã nhân viên</th>
                  <th scope="col" style="width: 140px">Họ và tên</th>
                  <th scope="col">Số điện thoại</th>
                  <th scope="col">Email</th>
                  <th scope="col">Giới tính</th>
                  <th scope="col">Ngày sinh</th>
                  <th>Lương</th>
                  <th class="text-end"></th>
                </tr>
              </thead>
              <tbody>
        <?php
        // Kiểm tra và hiển thị dữ liệu
        if ($result->num_rows > 0) {
            $stt = 1;
            // Lặp qua từng dòng dữ liệu
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $stt++ . "</td>";
                echo "<td>" . htmlspecialchars($row['ho_ten']) . "</td>";
                echo "<td>" . htmlspecialchars($row['so_dien_thoai']) . "</td>";
                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                echo "<td>" . htmlspecialchars($row['gioi_tinh']) . "</td>";
                echo "<td>" . date('d/m/Y', strtotime($row['ngay_sinh'])) . "</td>";
                echo "<td>" . number_format($row['luong'], 0, ',', '.') . " VNĐ</td>";
                echo "<td class='text-center'>
                <div class='d-flex justify-content-center'>
                  <button type='button' class='btn btn-primary bg-primary-btn me-2' data-bs-toggle='modal' data-bs-target='#modalEdit'>Sửa</button>
                  <button type='button' class='btn btn-danger bg-danger-btn delete-btn' data-bs-toggle='modal' data-bs-target='#modalDelete' data-id='" . (isset($row['ma_nv']) ? htmlspecialchars($row['ma_nv']) : '') . "'>Xóa</button>
                </div>
                </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>Không có nhân viên nào</td></tr>";
        }
        ?>
    </tbody>
            </table>
            <?php
$conn->close();
?>

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
    <!-- Thêm -->
    <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddLabel">Thêm nhân viên</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Thêm method và action vào form -->
                <form method="POST" action="" id="addStaffForm">
                    <div class="row">
                        <div class="col">
                            <div class="mb-4">
                                <label for="nameAdd" class="form-label">Tên nhân viên</label>
                                <input
                                    type="text"
                                    name="ho_ten" 
                                    class="form-control"
                                    id="nameAdd"
                                    required  
                                />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-4">
                                <label for="phoneAdd" class="form-label">Số điện thoại</label>
                                <input 
                                    type="text" 
                                    name="so_dien_thoai" 
                                    class="form-control" 
                                    id="phoneAdd" 
                                    required  
                                />
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-4">
                                <label for="emailAdd" class="form-label">Email</label>
                                <input 
                                    type="email"  
                                    name="email"  
                                    class="form-control" 
                                    id="emailAdd" 
                                    required  
                                />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-4">
                                <label for="genderAdd" class="form-label">Giới tính</label>
                                <select
                                    name="gioi_tinh"  
                                    class="form-select"
                                    aria-label="Default select example"
                                    required  
                                >
                                    <option selected disabled value="">Chọn</option>
                                    <option value="Nam">Nam</option>
                                    <option value="Nữ">Nữ</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-4">
                                <label for="birthAdd" class="form-label">Ngày sinh</label>
                                <input 
                                    type="date" 
                                    name="ngay_sinh"  
                                    class="form-control" 
                                    id="birthAdd" 
                                    required  
                                />
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-4">
                                <label for="salaryAdd" class="form-label">Lương</label>
                                <input 
                                    type="number"  
                                    name="luong"  
                                    class="form-control" 
                                    id="salaryAdd" 
                                    required  
                                />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                >
                    Đóng
                </button>
                <button 
                    type="submit"  
                    form="addStaffForm" 
                    class="btn btn-success"
                >
                    Thêm
                </button>
            </div>
        </div>
    </div>
</div>
    <!-- Sửa -->
    <div
      class="modal fade"
      id="modalEdit"
      tabindex="-1"
      aria-labelledby="modalEditLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalEditLabel">Sửa nhân viên</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <form>
              <div class="row">
                <div class="col">
                  <div class="mb-4">
                    <label for="nameEdit" class="form-label"
                      >Tên nhân viên
                    </label>
                    <input
                      type="text"
                      class="form-control"
                      id="nameEdit"
                      aria-describedby="nameEdit"
                    />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="mb-4">
                    <label for="phoneEdit" class="form-label"
                      >Số điện thoại
                    </label>
                    <input type="text" class="form-control" id="phoneEdit" />
                  </div>
                </div>
                <div class="col">
                  <div class="mb-4">
                    <label for="emailEdit" class="form-label">Email</label>
                    <input type="text" class="form-control" id="emailEdit" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="mb-4">
                    <label for="genderEdit" class="form-label"
                      >Giới tính
                    </label>
                    <select
                      class="form-select"
                      aria-label="Default select example"
                    >
                      <option selected disabled>Chọn</option>
                      <option value="male">Nam</option>
                      <option value="female">Nữ</option>
                    </select>
                  </div>
                </div>
                <div class="col">
                  <div class="mb-4">
                    <label for="birthEdit" class="form-label">Ngày sinh</label>
                    <input type="date" class="form-control" id="birthEdit" />
                  </div>
                </div>
                <div class="col">
                  <div class="mb-4">
                    <label for="salaryEdit" class="form-label">Lương</label>
                    <input type="text" class="form-control" id="salaryEdit" />
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Đóng
            </button>
            <button type="button" class="btn btn-primary bg-primary-btn" id="confirmEditBtn">
             Lưu thay đổi
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- Xóa -->
    <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDeleteLabel">Xóa nhân viên</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Bạn chắc chắn muốn xóa?</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-danger bg-danger-btn" id="confirmDeleteBtn">Xóa</button>
            </div>
        </div>
    </div>
</div>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
    <script src="./js/home.js"></script>
    <script src="./js/staff.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
    let employeeIdToDelete = null;
    
    // Kiểm tra ID trước khi thực hiện
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            employeeIdToDelete = this.getAttribute('data-id');
            
            // Kiểm tra ID có tồn tại không
            if (!employeeIdToDelete) {
                alert('Không tìm thấy ID nhân viên');
                return;
            }
        });
    });

    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        if (employeeIdToDelete) {
            fetch('delete_employee.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'id=' + encodeURIComponent(employeeIdToDelete)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.querySelector(`button[data-id="${employeeIdToDelete}"]`).closest('tr').remove();
                    bootstrap.Modal.getInstance(document.getElementById('modalDelete')).hide();
                } else {
                    alert('Không thể xóa nhân viên: ' + data.error);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Đã xảy ra lỗi');
            });
        }
    });
});
    </script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
    // Lắng nghe sự kiện click cho các nút "Sửa"
    document.querySelectorAll('.bg-primary-btn').forEach(button => {
        button.addEventListener('click', function() {
            // Lấy dòng chứa thông tin nhân viên
            const row = this.closest('tr');
            
            // Lấy các giá trị từ các ô trong dòng
            const hoTen = row.cells[1].textContent;
            const soDienThoai = row.cells[2].textContent;
            const email = row.cells[3].textContent;
            const gioiTinh = row.cells[4].textContent;
            const ngaySinh = row.cells[5].textContent;
            const luong = row.cells[6].textContent.replace(' VNĐ', '').replace(/\./g, '');
            const maNV = this.closest('div').querySelector('.delete-btn').getAttribute('data-id');

            // Điền thông tin vào form
            document.getElementById('nameEdit').value = hoTen;
            document.getElementById('phoneEdit').value = soDienThoai;
            document.getElementById('emailEdit').value = email;
            document.getElementById('birthEdit').value = convertDateFormat(ngaySinh);
            document.getElementById('salaryEdit').value = luong;

            // Chọn giới tính
            const genderSelect = document.querySelector('#modalEdit select');
            genderSelect.value = gioiTinh === 'Nam' ? 'male' : 'female';

            // Lưu mã nhân viên để sử dụng cho việc cập nhật
            document.getElementById('confirmEditBtn').setAttribute('data-id', maNV);
        });
    });

    // Hàm chuyển đổi định dạng ngày từ dd/mm/yyyy sang yyyy-mm-dd
    function convertDateFormat(dateString) {
        const [day, month, year] = dateString.split('/');
        return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`;
    }

    // Xử lý lưu thay đổi
    document.getElementById('confirmEditBtn').addEventListener('click', function() {
        const maNV = this.getAttribute('data-id');
        
        // Lấy giá trị từ form
        const hoTen = document.getElementById('nameEdit').value;
        const soDienThoai = document.getElementById('phoneEdit').value;
        const email = document.getElementById('emailEdit').value;
        const gioiTinh = document.querySelector('#modalEdit select').value === 'male' ? 'Nam' : 'Nữ';
        const ngaySinh = document.getElementById('birthEdit').value;
        const luong = document.getElementById('salaryEdit').value;

        // Gửi dữ liệu đến server
        fetch('update_employee.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                ma_nv: maNV,
                ho_ten: hoTen,
                so_dien_thoai: soDienThoai,
                email: email,
                gioi_tinh: gioiTinh,
                ngay_sinh: ngaySinh,
                luong: luong
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Cập nhật thành công!');
                location.reload(); // Tải lại trang
            } else {
                alert('Lỗi: ' + data.error);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Đã xảy ra lỗi');
        });
    });
});
    </script>
  </body>
</html>
