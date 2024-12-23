<?php
session_start();
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

// Truy vấn để lấy danh sách các món
$sql = "SELECT * FROM mon_an";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thực Đơn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.lineicons.com/4.0/lineicons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./css/style.css" />
    <style>
        body {
            background-color: rgb(207, 134, 9);
            padding-top: 100px;
        }
        .card {
            transition: transform 0.3s;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .fooder {
    width: 100%;
    margin: 0;
    padding: 0;
}

.fooder .row {
    margin: 0;
    padding: 0;
}
.cart-count {
    background-color: red;
    color: white !important;
    border-radius: 50%;
    padding: 2px 6px;
    font-size: 12px;
    display: inline-block;
}
#cart-items {
    display: flex;
    flex-direction: column; /* Xếp các item theo trục dọc */
    gap: 1rem; /* Khoảng cách giữa các item */
}
#cart-items > .cart-item {
    display: block; /* Loại bỏ cấu trúc flex ngang (nếu có) */
    width: 100%; /* Đảm bảo item chiếm toàn bộ chiều ngang */
}
    </style>
</head>
<body>
    <!-- header -->
    <nav class="navbar navbar-expand-lg py-4 py-lg-0 m-2 m-sm-3 shadow bg-dark rounded fixed-top">
        <div class="container-fluid px-4">
            <img class="img-logo" src="./img/logo.png" alt="LoGo" />

            <div class="bg-dark" tabindex="-1" id="top-navbar" aria-labelledby="top-navbarLabel">
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#top-navbar" aria-controls="top-navbar">
                    <div class="d-flex justify-content-between p-3">
                        <img src="./img/logo.png" alt="LoGo" />
                        <i class="lni lni-xmark"></i>
                    </div>
                </button>
                <ul class="navbar-nav mx-lg-auto p-4 p-lg-0">
                    <li class="nav-item px-3 py-1 py-lg-4">
                        <a class="nav-link" href="./index.php">Trang chủ</a>
                    </li>
                    <li class="nav-item px-3 py-1 py-lg-4">
                        <a class="nav-link" href="#">Giới thiệu</a>
                    </li>
                    <li class="nav-item px-3 py-1 py-lg-4">
                        <a class="nav-link" href="./menu_customer.php">Menu</a>
                    </li>
                    <li class="nav-item px-3 py-1 py-lg-4">
                        <a class="nav-link" href="#">Liên hệ</a>
                    </li>
                    <li class="nav-item px-3 py-1 py-lg-4">
                        <a class="nav-link" href="#">Tin tức</a>
                    </li>
                </ul>
            </div>
            <?php if (isset($_SESSION['user_id'])): ?>
                <div class="dropdown position-relative">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="./img/avt.png" alt="Avatar" class="rounded-circle" style="width: 40px; height: 40px;">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end bg-dark text-light shadow" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item text-light" href="home.php">Quản lý</a></li>
                        <li><a class="dropdown-item text-light" href="#" id="view-cart-btn">Xem Giỏ Hàng <span id="cart-count" class="cart-count">0</span></a></li>
                        <li><a class="dropdown-item text-light" href="logout.php">Đăng xuất</a></li>
                    </ul>
                </div>
            <?php else: ?>
                <button class="btn btn-secondary rounded-pill ms-2" onclick="window.location.href='login.php'">Đăng nhập</button>
            <?php endif; ?>
        </div>
    </nav>

    <div class="container py-5">
        <h1 class="text-center my-4 text-white">Thực Đơn</h1>
        <div class="row mb-4">
          <div class="col-12">
            <select id="categoryFilter" class="form-select">
                <option value="">Tất cả</option>
                <option value="Cafe">Cafe</option>
                <option value="Trà Sữa">Trà Sữa</option>
                <option value="Nước hoa quả">Nước hoa quả</option>
                <option value="Đồ ăn vặt">Đồ ăn vặt</option>
            </select>
          </div>
        </div>
        
        <div class="row" id="menu-container">
            <?php
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
            ?>
        </div>

        <!-- Giỏ hàng Modal -->
<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cartModalLabel">Giỏ Hàng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="cart-items">
                <!-- Các item của giỏ hàng sẽ được hiển thị ở đây -->
            </div>
            <div class="modal-footer">
                <div class="container-fluid">
                    <div class="row mb-3">
                        <div class="col-12 col-md-6 mb-2">
                            <input type="text" class="form-control" id="customer-name" placeholder="Tên khách hàng" required>
                        </div>
                        <div class="col-12 col-md-6">
                            <input type="text" class="form-control" id="table-number" placeholder="Số bàn" required>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between w-100">
                        <div>
                            <strong>Tổng cộng:</strong> 
                            <span id="cart-total">0đ</span>
                        </div>
                        <div>
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Quay lại</button>
                            <button type="button" class="btn btn-primary" id="checkout-btn">Gửi Đơn</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
          </div>

    
  </div>
  <div class="fooder container-fluid row p-5">
        <div class="col col-sm-6 col-lg-3 col-12 mb-4">
            <a href="#"><img class="logo-fooder" src="./img/logo.png" alt="logo"/></a>
        </div>
        <div class="col col-sm-6 col-lg-3 col-12 mt-4">
            <div class="h5">Thời Gian Làm Việc</div>
            <li>
                Thứ 2 - Thứ 7 <br />
                8h sáng - 9h tối
            </li>
            <li>
                Chủ nhật <br />
                9h sáng - 10h tối
            </li>
        </div>
        <div class="col col-sm-6 col-lg-3 col-12 mt-4">
            <div class="h5">Liên Hệ</div>
            <i class="bi bi-geo-alt">
                Địa chỉ : <br />
                70, Nguyễn Trãi, Hà Đông, Hà Nội
            </i>
            <br />
            <i class="bi bi-envelope">
                Địa chỉ Email : <br />
                tienhaku0412@gmail.com
            </i>
            <br />
            <i class="bi bi-telephone">
                Số điện thoại : <br />
                0398237832
            </i>
        </div>
        <div class="col col-sm-6 col-lg-3 col-12 mt-4">
            <div class="h5">Thư Viện</div>
            <div class="row gallery-container g-3">
                <div class="col-4">
                    <div class="card">
                        <img src="./img/MilkTea1.jpg" class="card-img-top" alt="Coffee 1" />
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <img src="./img/image2.jpg" class="card-img-top" alt="Coffee 2" />
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <img src="./img/image3.jpg" class="card-img-top" alt="Coffee 3" />
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <img src="./img/image4.jpg" class="card-img-top" alt="Coffee 4" />
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <img src="./img/juice.jpg" class="card-img-top" alt="Coffee 5" />
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <img src="./img/MilkTea2.jpg" class="card-img-top" alt="Coffee 6" />
                    </div>
                </div>
            </div>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    const cartItemsContainer = document.getElementById('cart-items');
    const cartTotalElement = document.getElementById('cart-total');
    const viewCartBtn = document.getElementById('view-cart-btn');
    const cartCount = document.getElementById('cart-count');
    const checkoutBtn = document.getElementById('checkout-btn');

    let cart = [];

    // Thêm vào giỏ hàng
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productCard = this.closest('.card');
            const productId = this.getAttribute('data-id');
            const productName = productCard.querySelector('.card-title').innerText;
            const productPrice = parseInt(productCard.querySelector('.card-text').innerText.split('Giá: ')[1].split('đ')[0].replace(/\./g, ''));
            const productImage = productCard.querySelector('.card-img-top').src;
            const productCategory = productCard.querySelector('.card-text').innerText.split('Thể loại: ')[1];

            // Kiểm tra sản phẩm đã tồn tại
            const existingProductIndex = cart.findIndex(item => item.id === productId);
            if (existingProductIndex > -1) {
                cart[existingProductIndex].quantity += 1;
            } else {
                cart.push({
                    id: productId,
                    name: productName,
                    price: productPrice,
                    image: productImage,
                    category: productCategory,
                    quantity: 1
                });
            }

            updateCartView();
            updateCartCount();
        });
    });

    // Cập nhật số lượng giỏ hàng
    function updateCartCount() {
        const totalItems = cart.reduce((total, item) => total + item.quantity, 0);
        cartCount.textContent = totalItems;
    }

    // Hiển thị giỏ hàng chi tiết
    function updateCartView() {
    if (cart.length === 0) {
        cartItemsContainer.innerHTML = '<p class="text-center">Giỏ hàng trống</p>';
        cartTotalElement.textContent = '0đ';
        return;
    }

    let cartHTML = '';
    let total = 0;

    cart.forEach(item => {
        const itemTotal = item.price * item.quantity;
        total += itemTotal;

        cartHTML += `
            <div class="cart-item row align-items-center mb-3 border-bottom pb-2" data-id="${item.id}">
                <div class="col-12 col-md-3 mb-2">
                    <img src="${item.image}" class="img-fluid" style="max-height: 100px; object-fit: cover;">
                </div>
                <div class="col-12 col-md-9">
                    <h6 class="mb-1">${item.name}</h6>
                    <p class="text-muted mb-1">Giá: ${new Intl.NumberFormat('vi-VN').format(item.price)}đ</p>
                    <p class="text-muted mb-1">Thể loại: ${item.category}</p>
                    <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center">
                        <div class="d-flex align-items-center mb-2 mb-sm-0 me-sm-3">
                            <button class="btn btn-sm btn-outline-secondary decrease-quantity me-2" data-id="${item.id}">-</button>
                            <span class="mx-2 quantity-display" style="color: black;">${item.quantity}</span>
                            <button class="btn btn-sm btn-outline-secondary increase-quantity ms-2" data-id="${item.id}">+</button>
                        </div>
                        <span class="ms-0 ms-sm-3 mb-2 mb-sm-0">Tổng: ${new Intl.NumberFormat('vi-VN').format(itemTotal)}đ</span>
                        <button class="btn btn-sm btn-danger remove-item ms-auto" data-id="${item.id}">Xóa</button>
                    </div>
                </div>
            </div>
        `;
    });

    cartItemsContainer.innerHTML = cartHTML;
    cartTotalElement.textContent = new Intl.NumberFormat('vi-VN').format(total) + 'đ';

    attachCartEvents();
}

    // Gán sự kiện cho các nút trong giỏ hàng
    function attachCartEvents() {
        // Giảm số lượng
        document.querySelectorAll('.decrease-quantity').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-id');
                const cartItemIndex = cart.findIndex(item => item.id === productId);
                
                if (cart[cartItemIndex].quantity > 1) {
                    cart[cartItemIndex].quantity -= 1;
                } else {
                    cart.splice(cartItemIndex, 1);
                }

                updateCartView();
                updateCartCount();
            });
        });

        // Tăng số lượng
        document.querySelectorAll('.increase-quantity').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-id');
                const cartItemIndex = cart.findIndex(item => item.id === productId);
                
                cart[cartItemIndex].quantity += 1;
                
                updateCartView();
                updateCartCount();
            });
        });

        // Xóa sản phẩm
        document.querySelectorAll('.remove-item').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-id');
                cart = cart.filter(item => item.id !== productId);
                
                updateCartView();
                updateCartCount();
            });
        });
    }

    // Hiển thị giỏ hàng khi nhấn nút
    viewCartBtn.addEventListener('click', function() {
        updateCartView();
        const cartModal = new bootstrap.Modal(document.getElementById('cartModal'));
        cartModal.show();
    });

    checkoutBtn.addEventListener('click', function() {
    if (cart.length === 0) {
        alert('Giỏ hàng trống');
        return;
    }

    const customerName = document.getElementById('customer-name').value.trim();
    const tableNumber = document.getElementById('table-number').value.trim();

    if (!customerName || !tableNumber) {
        alert('Vui lòng nhập tên khách hàng và số bàn');
        return;
    }

    const orderData = {
        cart: cart,
        customerName: customerName,
        tableNumber: tableNumber
    };

    fetch('process_order.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(orderData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Đặt hàng thành công!');
            cart = [];
            updateCartView();
            updateCartCount();
            document.getElementById('customer-name').value = '';
            document.getElementById('table-number').value = '';
            const cartModal = bootstrap.Modal.getInstance(document.getElementById('cartModal'));
            cartModal.hide();
        } else {
            alert('Đặt hàng thất bại: ' + data.message);
        }
    })
        .catch(error => {
            console.error('Error:', error);
            alert('Có lỗi xảy ra khi đặt hàng');
        });
    });
});
    </script>
    <script>
document.getElementById('categoryFilter').addEventListener('change', function() {
    var category = this.value;
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'filter_menu.php?category=' + category, true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById('menu-container').innerHTML = xhr.responseText;
        }
    };
    xhr.send();
});
</script>
</body>
</html>

<?php
$conn->close();
?>