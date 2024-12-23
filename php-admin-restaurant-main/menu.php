<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quanlyquan";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $imageUrl = $_POST['imageUrl'];
    $description = $_POST['description'];

    // Kiểm tra dữ liệu trước khi thêm
    $checkStmt = $conn->prepare("SELECT * FROM mon_an WHERE ten_mon = ? AND gia = ? AND the_loai = ?");
    $checkStmt->bind_param("sss", $name, $price, $category);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        echo "<script>
            alert('Món ăn đã tồn tại trong danh sách!');
        </script>";
    } else {
        // Thêm dữ liệu vào cơ sở dữ liệu
        $stmt = $conn->prepare("INSERT INTO mon_an (ten_mon, gia, the_loai, hinh_anh, mo_ta) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $price, $category, $imageUrl, $description);

        if ($stmt->execute()) {
            echo "<script>
                alert('Thêm món ăn thành công!');
                window.location.href = window.location.href; // Refresh trang
            </script>";
        } else {
            echo "<script>alert('Lỗi: " . $stmt->error . "');</script>";
        }

        $stmt->close();
    }

    $checkStmt->close();
}
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
    <link rel="stylesheet" href="./css/menu.css" />
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
          <a href="./menu.php" class="tab_item active">
            <i class="ti-menu-alt"></i>
            <span>Thực đơn</span>
          </a>
          <a href="./staff.php" class="tab_item">
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
              <h3>Thực đơn</h3>
              <div class="d-flex gap-2 justify-content-end">
                <select
                  class="form-select select-menu"
                  aria-label="Default select example"
                >
                  <option selected>Tất cả</option>
                  <option value="Trà sữa">Trà sữa</option>
                  <option value="Cafe">Cafe</option>
                  <option value="Nước hoa quả">Nước hoa quả</option>
                  <option value="Đồ ăn vặt">Đồ ăn vặt</option>
                </select>
                <button
                  type="button"
                  class="btn btn-success bg-success-btn add-menu-btn"
                  data-bs-toggle="modal"
                  data-bs-target="#modalAdd"
                >
                  <i class="ti-plus"></i>
                  Thêm món ăn
                </button>
              </div>
            </div>
            <div class="row">
            <?php
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

// Truy vấn dữ liệu từ bảng mon_an
$sql = "SELECT id, ten_mon, gia, the_loai, hinh_anh, mo_ta FROM mon_an";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Hiển thị dữ liệu cho từng món ăn
    while($row = $result->fetch_assoc()) {
        echo '<div class="col-12 col-sm-6 col-lg-3 mt-4">';
        echo '    <div class="card">';
        echo '        <div class="ratio ratio-4x3">';
        echo '            <img src="' . $row["hinh_anh"] . '" class="card-img-top" alt="...">';
        echo '        </div>';
        echo '        <div class="card-body">';
        echo '            <h5 class="card-title">' . $row["ten_mon"] . '</h5>';
        echo '            <p class="card-text">Giá: ' . number_format($row["gia"]),'' . ' VNĐ <br />Thể loại: ' . $row["the_loai"] . '</p>';
        echo '            <div class="d-flex gap-2">';
        echo '                <button class="btn btn-primary bg-primary-btn btn-luu" data-bs-toggle="modal" data-bs-target="#modalEdit" data-id="' . $row["id"] . '">Sửa</button>';
        echo '                <button class="btn btn-danger bg-danger-btn" data-bs-toggle="modal" data-bs-target="#modalDelete" data-id="' . $row["id"] . '">Xóa</button>';
        echo '            </div>';
        echo '        </div>';
        echo '    </div>';
        echo '</div>';
    }
} else {
    echo "Không có món ăn nào trong cơ sở dữ liệu.";
}

$conn->close();
?>



<!-- Modal xác nhận xóa -->
<div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDeleteLabel">Xác nhận xóa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Bạn có chắc chắn muốn xóa món ăn này không?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Xóa</button>
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
              href="./login.html"
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
                <h5 class="modal-title" id="modalAddLabel">Thêm món ăn</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form id="addFoodForm" action="add_food.php" method="POST" enctype="multipart/form-data">
    <div class="mb-4">
        <label for="nameAdd" class="form-label">Tên món ăn</label>
        <input type="text" class="form-control" id="nameAdd" name="name" required>
    </div>
    <div class="row">
        <div class="col">
            <div class="mb-4">
                <label for="priceAdd" class="form-label">Đơn giá</label>
                <input type="text" class="form-control" id="priceAdd" name="price" required>
            </div>
        </div>
        <div class="col">
            <div class="mb-4">
                <label for="categoryAdd" class="form-label">Thể loại</label>
                <select class="form-select" id="categoryAdd" name="category" required>
                    <option selected disabled>Chọn</option>
                    <option value="Trà Sữa">Trà sữa</option>
                    <option value="Cafe">Cafe</option>
                    <option value="Nước hoa quả">Nước hoa quả</option>
                    <option value="Đồ ăn vặt">Đồ ăn vặt</option>
                </select>
            </div>
        </div>
    </div>
    <div class="mb-4">
        <label for="fileAdd" class="form-label">Hình ảnh minh họa</label>
        <input class="form-control" type="text" id="fileAdd" name="image" required>
    </div>
    <div class="mb-4">
        <label for="descAdd" class="form-label">Mô tả</label>
        <textarea class="form-control" id="descAdd" name="description" rows="4"></textarea>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
        <button type="submit" class="btn btn-success bg-success-btn">Thêm</button>
    </div>
</form>
            </div>
        </div>
    </div>
</div>

    <!-- Sửa -->
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditLabel">Sửa món ăn</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" id="foodId">
                    <div class="mb-4">
                        <label for="nameEdit" class="form-label">Tên món ăn</label>
                        <input type="text" class="form-control" id="nameEdit" aria-describedby="nameEdit">
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-4">
                                <label for="priceEdit" class="form-label">Đơn giá</label>
                                <input type="text" class="form-control" id="priceEdit">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-4">
                                <label for="category" class="form-label">Thể loại</label>
                                <select class="form-select" id="category" aria-label="Default select example">
                                    <option selected disabled>Chọn</option>
                                    <option value="Trà sữa">Trà sữa</option>
                                    <option value="Cafe">Cafe</option>
                                    <option value="Nước hoa quả">Nước hoa quả</option>
                                    <option value="Đồ ăn vặt">Đồ ăn vặt</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="fileEdit" class="form-label">Hình ảnh minh họa</label>
                        <input class="form-control" type="text" id="fileEdit" name="image" required>
                    </div>
                    <div class="mb-4">
                        <label for="descEdit" class="form-label">Mô tả</label>
                        <textarea class="form-control" id="descEdit" rows="4"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary bg-primary-btn" id="saveChanges">Lưu thay đổi</button>
            </div>
        </div>
    </div>
</div>


    <!-- Xóa -->
    <div
      class="modal fade"
      id="modalDelete"
      tabindex="-1"
      aria-labelledby="modalDeleteLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalDeleteLabel">Xóa món ăn</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">Bạn chắc chắn muốn xóa?</div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Hủy
            </button>
            <button type="button" class="btn btn-danger bg-danger-btn">
              Xóa
            </button>
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
    <script src="./js/menu.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
    const addFoodForm = document.getElementById('addFoodForm');

    addFoodForm.addEventListener('submit', function (e) {
        e.preventDefault(); // Ngăn chặn hành động submit mặc định của form

        // Tạo dữ liệu từ form
        const formData = new FormData(addFoodForm);

        // Gửi dữ liệu đến server qua AJAX
        fetch('add_food.php', {
            method: 'POST',
            body: formData,
        })
            .then((response) => response.json()) // Lấy phản hồi dưới dạng JSON
            .then((data) => {
                if (data.status === 'success') {
                    alert(data.message); // Hiển thị thông báo thành công

                    // Đóng modal và reset form
                    addFoodForm.reset();
                    const modal = document.getElementById('modalAdd');
                    const modalInstance = bootstrap.Modal.getInstance(modal);
                    modalInstance.hide();

                    // Reload trang để cập nhật menu
                    window.location.reload();
                } else {
                    alert(data.message); // Hiển thị thông báo lỗi
                }
            })
            .catch((error) => {
                console.error('Lỗi:', error);
                alert('Có lỗi xảy ra, vui lòng thử lại.');
            });
    });
});

    </script>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    var editButtons = document.querySelectorAll('.btn-primary[data-bs-target="#modalEdit"]');
    editButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var id = this.getAttribute('data-id');
            // Gửi yêu cầu AJAX để lấy thông tin món ăn
            fetch('get_food.php?id=' + id)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('nameEdit').value = data.ten_mon;
                    document.getElementById('priceEdit').value = data.gia;
                    document.getElementById('category').value = data.the_loai;
                    document.getElementById('fileEdit').value = data.hinh_anh;
                    document.getElementById('descEdit').value = data.mo_ta;
                    document.getElementById('foodId').value = data.id;

                    // Gán sự kiện click cho nút "Lưu thay đổi"
    document.querySelector('#saveChanges').onclick = function() {
    var id = document.getElementById('foodId').value;
    var name = document.getElementById('nameEdit').value;
    var price = document.getElementById('priceEdit').value;
    var category = document.getElementById('category').value;
    var description = document.getElementById('descEdit').value;
    var image = document.getElementById('fileEdit').value;

    var formData = new FormData();
    formData.append('id', id);
    formData.append('name', name);
    formData.append('price', price);
    formData.append('category', category);
    formData.append('description', description);
    formData.append('image', image);

    console.log('Clicked "Lưu thay đổi" button');
console.log('Form data:', formData);

fetch('update_food.php', {
    method: 'POST',
    body: formData
})
.then(response => response.text())
.then(data => {
    console.log('Server response:', data);
    if (data.includes('Cập nhật món ăn thành công!')) {
        alert('Cập nhật thành công!');
        window.location.reload();
    } else {
        alert('Có lỗi xảy ra. Vui lòng thử lại.');
    }
})
.catch(error => {
    console.error('Error:', error);
    alert('Có lỗi xảy ra. Vui lòng thử lại.');
});
};
                });
        });
    });
});
</script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Biến lưu id của món ăn cần xóa
    let deleteId = null;

    // Thêm sự kiện click cho các nút "Xóa"
    document.querySelectorAll('.btn-danger').forEach(button => {
        button.addEventListener('click', function() {
            deleteId = this.getAttribute('data-id');
            document.getElementById('confirmDelete').setAttribute('data-id', deleteId);
        });
    });

    // Thêm sự kiện click cho nút "Xác nhận xóa"
    document.getElementById('confirmDelete').addEventListener('click', function() {
        deleteId = this.getAttribute('data-id');
        if (deleteId) {
            fetch('delete_food.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `id=${deleteId}`
            })
            .then(response => response.text())
            .then(data => {
                console.log('Server response:', data);
                if (data.includes('Xóa món ăn thành công!')) {
                    alert('Xóa thành công!');
                    window.location.reload();
                } else {
                    alert('Có lỗi xảy ra. Vui lòng thử lại.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Có lỗi xảy ra. Vui lòng thử lại.');
            });
        }
    });
});
</script>

  </body>
</html>
