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
    <link rel="stylesheet" href="./css/user.css" />
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
          <a href="./staff.php" class="tab_item">
            <i class="ti-user"></i>
            <span>Nhân viên</span>
          </a>
          <a href="./customer.php" class="tab_item">
            <i class="ti-face-smile"></i>
            <span>Khách hàng</span>
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
              <span>Chào, Trần Hà! </span>
              <i class="ti-angle-down dropdown-user"></i>

              <ul class="list-group header_user-dropdown visually-hidden">
                <a href="./user.html" class="list-group-item">Tài khoản</a>
                <a
                  href=""
                  class="list-group-item"
                  data-bs-toggle="modal"
                  data-bs-target="#signOut"
                  >Đăng xuất</a
                >
              </ul>
            </div>
          </div>
          <div class="mt-4 wrapper-content">
            <h3>Tài khoản</h3>
            <hr class="mt-4" />
            <div class="row mt-4 general-info">
              <div class="col-12 col-sm-5">
                <h4>Thông tin chung</h4>
                <p class="text-body-secondary">
                  Tại đây, bạn có thể tùy chỉnh các thông tin cá nhân cơ bản như
                  họ tên, mật khẩu và cài đặt tài khoản của mình.
                </p>
              </div>
              <div class="col-12 col-sm-7 form-info-user shadow-sm rounded">
                <form class="form-user">
                  <div class="mb-3">
                    <label for="name" class="form-label h6">Họ và tên</label>
                    <input
                      type="text"
                      class="form-control"
                      id="name"
                      value="Trần Hà"
                    />
                  </div>
                  <div class="mb-3">
                    <label for="email" class="form-label h6"
                      >Địa chỉ email</label
                    >
                    <input
                      type="email"
                      class="form-control"
                      id="email"
                      value="haqt2003@gmail.com"
                      disabled
                    />
                  </div>
                  <div class="mb-3">
                    <label for="password" class="form-label h6">Mật khẩu</label>
                    <input
                      type="text"
                      class="form-control"
                      id="password"
                      placeholder="••••••"
                      disabled
                    />
                  </div>

                  <button
                    type="button"
                    class="btn btn-success bg-success-btn"
                    data-bs-toggle="modal"
                    data-bs-target="#modalConfirm"
                  >
                    Lưu thay đổi
                  </button>
                  <button
                    type="button"
                    class="btn btn-danger bg-danger-btn changePasswordBtn"
                  >
                    Đổi mật khẩu
                  </button>
                </form>
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
              href="./login.html"
              type="button"
              class="btn btn-danger bg-danger-btn"
              >Đăng xuất</a
            >
          </div>
        </div>
      </div>
    </div>
    <!-- Xác nhận -->
    <div
      class="modal fade"
      id="modalConfirm"
      tabindex="-1"
      aria-labelledby="modalConfirmLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalConfirmLabel">Lưu thông tin</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">Bạn chắc chắn về thay đổi của mình?</div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Hủy
            </button>
            <button type="button" class="btn btn-success bg-success-btn">
              Lưu
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
    <script src="./js/user.js"></script>
  </body>
</html>
