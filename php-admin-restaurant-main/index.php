<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hoc Bootstrap</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="https://cdn.lineicons.com/5.0/lineicons.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    />
    <link rel="stylesheet" href="./css/style.css" />
    <style>
  .navbar .rounded-circle {
    width: 40px;
    height: 40px;
    object-fit: cover;
  }
</style>
  </head>
  <body>
    <!-- header -->
    <?php
session_start();
?>

<nav class="navbar navbar-expand-lg py-4 py-lg-0 m-2 m-sm-3 shadow bg-dark rounded fixed-top">
  <div class="container-fluid px-4">
    <img class="img-logo" src="./img/logo.png" alt="LoGo" />

    <div class="bg-dark" tabindex="-1" id="top-navbar" aria-labelledby="top-navbarLabel">
      <!-- Navigation Bar Content-->
      <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#top-navbar" aria-controls="top-navbar">
        <div class="d-flex justify-content-between p-3">
          <img src="./img/logo.png" alt="LoGo" />
          <i class="lni lni-xmark"></i>
        </div>
      </button>
      <ul class="navbar-nav mx-lg-auto p-4 p-lg-0">
        <li class="nav-item px-3 py-1 py-lg-4">
          <a class="nav-link" href="#">Trang chủ</a>
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
      <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="./img/avt.png" alt="Avatar" class="rounded-circle" style="width: 40px; height: 40px;">
        </a>
        <ul class="dropdown-menu dropdown-menu-end bg-dark text-light shadow" aria-labelledby="userDropdown">
          <li><a class="dropdown-item text-light" href="home.php">Quản lý</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item text-light" href="logout.php">Đăng xuất</a></li>
        </ul>
      </div>
    <?php else: ?>
      <button class="btn btn-secondary rounded-pill ms-2" onclick="window.location.href='login.php'">Đăng nhập</button>
    <?php endif; ?>
  </div>
</nav>

    <!-- Slider 1 -->
    <div id="hero-carousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button
          type="button"
          data-bs-target="#hero-carousel"
          data-bs-slide-to="0"
          class="active"
          aria-current="true"
          aria-label="Slide 1"
        ></button>
        <button
          type="button"
          data-bs-target="#hero-carousel"
          data-bs-slide-to="1"
          aria-label="Slide 2"
        ></button>
        <button
          type="button"
          data-bs-target="#hero-carousel"
          data-bs-slide-to="2"
          aria-label="Slide 3"
        ></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active c-item">
          <img
            src="./img/MilkTea.jpg"
            class="d-block w-100 c-img"
            alt="Slide 1"
          />
          <div class="carousel-caption top-1 mt-4">
            <p class="display-1 fw-bolder text-capitalize text-uppercase">
              Chào mừng đến với Katilat
            </p>
            <h1 class="mt-5 fs-2">
              Cà phê tuyệt vời <br />
              Chất lượng hoàn hảo
            </h1>
            <button
              class="btn btn-warning px-4 py-2 fs-5 mt-5"
              onclick="document.getElementById('book').scrollIntoView({ behavior: 'smooth' });"
            >
              Đặt bàn ngay
            </button>
          </div>
        </div>
        <div class="carousel-item c-item">
          <img
            src="./img/picS1.png"
            class="d-block w-100 c-img"
            alt="Slide 2"
          />
          <div class="carousel-caption top-1 mt-4">
            <p class="display-1 fw-bolder text-capitalize text-uppercase">
              Đến với Katilat
            </p>
            <p class="mt-5 fs-2">
              Chúng tôi có thể thỏa mãn mọi yêu cầu<br />
              về thức uống của bạn
            </p>
            <button
              class="btn btn-warning px-4 py-2 fs-5 mt-5"
              onclick="document.getElementById('book').scrollIntoView({ behavior: 'smooth' });"
            >
              Đặt bàn ngay
            </button>
          </div>
        </div>
        <div class="carousel-item c-item">
          <img src="img/picS2.png" class="d-block w-100 c-img" alt="Slide 3" />
          <div class="carousel-caption top-1 mt-4">
            <p class="display-1 fw-bolder text-capitalize text-uppercase">
              Katilat mang đến cho bạn
            </p>
            <p class="mt-5 fs-2">Trải nghiệm tốt nhất</p>
            <button
              class="btn btn-warning px-4 py-2 fs-5 mt-5"
              onclick="document.getElementById('book').scrollIntoView({ behavior: 'smooth' });"
            >
              Đặt bàn ngay
            </button>
          </div>
        </div>
      </div>
      <button
        class="carousel-control-prev"
        type="button"
        data-bs-target="#hero-carousel"
        data-bs-slide="prev"
      >
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button
        class="carousel-control-next"
        type="button"
        data-bs-target="#hero-carousel"
        data-bs-slide="next"
      >
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

    <!-- Giới thiệu -->
    <div style="margin-top: 150px" class="container">
      <div class="row g-3">
        <div class="container col col-lg-6 col-12 text-center">
          <div class="text-uppercase h2 fw-bolder">
            Chúng tôi là <br />
            Katilat
          </div>
          Thứ hai đến Thứ bảy 9:00am - 21:00pm | Hotline: 0123.456.789
          <div
            style="width: 60%"
            class="border border-top border-1 m-3 mx-auto"
          ></div>
          <p style="opacity: 0.7">
            Chúng tôi đi khắp thế giới để tìm kiếm cà phê tuyệt vời. Trong quá
            trình đó, chúng tôi phát hiện ra những hạt đậu đặc biệt và hiếm đến
            nỗi chúng tôi có thể chờ đợi để mang chúng về.
          </p>
        </div>
        <div class="container col col-lg-6 col-12">
          <img style="width: 100%" src="./img/hinhquan.jpg" alt="pic" />
        </div>
      </div>
    </div>

    <!-- Menu -->
    <div class="container-fluid mt-5 mx-auto">
      <div class="display-5 h5 text-uppercase fw-bolder text-center my-4">
        Thức uống phổ biến
      </div>
      <div class="container row bg-white py-5 gy-4 mx-auto">
        <div class="col col-lg-6 col-12">
          <div class="row">
            <div
              class="col-2 d-flex d-flex justify-content-center align-items-start"
            >
              <img
                class="rounded-circle pm"
                src="./img/Sua-Tuoi-Nep-Cam.png"
                alt="p1"
              />
            </div>
            <div class="menu-item col-9">
              <p class="title-item-1">Sữa tươi nếp cẩm</p>
              <p class="title-item-2">50.000 ₫</p>
            </div>
          </div>
        </div>
        <div class="col col-lg-6 col-12">
          <div class="row">
            <div
              class="col-2 d-flex d-flex justify-content-center align-items-start"
            >
              <img
                class="rounded-circle pm"
                src="./img/Sua-Tuoi-Yen-Mach.png"
                alt="p1"
              />
            </div>
            <div class="menu-item col-9">
              <p class="title-item-1">Sữa tươi yên mạch</p>
              <p class="title-item-2">45.000 ₫</p>
            </div>
          </div>
        </div>
        <div class="col col-lg-6 col-12">
          <div class="row">
            <div
              class="col-2 d-flex d-flex justify-content-center align-items-start"
            >
              <img
                class="rounded-circle pm"
                src="./img/Phe-Tra-Chanh-Vang.png"
                alt="p3"
              />
            </div>
            <div class="menu-item col-9">
              <p class="title-item-1">Cà phê Latte</p>
              <p class="title-item-2">45.000 ₫</p>
            </div>
          </div>
        </div>
        <div class="col col-lg-6 col-12">
          <div class="row">
            <div
              class="col-2 d-flex d-flex justify-content-center align-items-start"
            >
              <img
                class="rounded-circle pm"
                src="./img/JellyMilk.jpg"
                alt="p4"
              />
            </div>
            <div class="menu-item col-9">
              <p class="title-item-1">Jelly Milk</p>
              <p class="title-item-2">30.000 ₫</p>
            </div>
          </div>
        </div>
        <div class="col col-lg-6 col-12">
          <div class="row">
            <div
              class="col-2 d-flex d-flex justify-content-center align-items-start"
            >
              <img
                class="rounded-circle pm"
                src="./img/O-Long-Yen-Mach.png"
                alt="p5"
              />
            </div>
            <div class="menu-item col-9">
              <p class="title-item-1">Ô Long Yến Mạch</p>
              <p class="title-item-2">30.000 ₫</p>
            </div>
          </div>
        </div>
        <div class="col col-lg-6 col-12">
          <div class="row">
            <div
              class="col-2 d-flex d-flex justify-content-center align-items-start"
            >
              <img
                class="rounded-circle pm"
                src="./img/OLongSuaTranChau.jpg"
                alt="p6"
              />
            </div>
            <div class="menu-item col-9">
              <p class="title-item-1">Ô Long Sữa Trân Châu</p>
              <p class="title-item-2">30.000 ₫</p>
            </div>
          </div>
        </div>
        <div class="col col-lg-6 col-12">
          <div class="row">
            <div
              class="col-2 d-flex d-flex justify-content-center align-items-start"
            >
              <img
                class="rounded-circle pm"
                src="./img/Tra-Xanh-Dao-Que-Hoa.png"
                alt="p7"
              />
            </div>
            <div class="menu-item col-9">
              <p class="title-item-1">Trà Đào Quế Hoa</p>
              <p class="title-item-2">46.000 ₫</p>
            </div>
          </div>
        </div>
        <div class="col col-lg-6 col-12">
          <div class="row">
            <div
              class="col-2 d-flex d-flex justify-content-center align-items-start"
            >
              <img
                class="rounded-circle pm"
                src="./img/Xanh-Nhai-Mang-Cau.png"
                alt="p8"
              />
            </div>
            <div class="menu-item col-9">
              <p class="title-item-1">Xanh Nhài Mãng cầu</p>
              <p class="title-item-2">35.000 ₫</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Gallery -->
    <div class="container-fluid">
      <div class="container mt-5 mx-auto">
        <div class="display-5 h5 text-uppercase fw-bolder text-center my-4">
          Đa dạng các loại đồ uống
        </div>
        <div class="row g-3">
          <div class="col-12 col-lg-6 pic-container">
            <div class="card-pic lagre">
              <img
                style="max-width: 100%"
                src="./img/MilkTea1.jpg"
                class="card-img-top"
                alt="Coffee 1"
              />
            </div>
          </div>
          <div class="col-12 col-lg-6">
            <div class="row pic-container g-3">
              <div class="col-6">
                <div class="card-pic">
                  <img
                    src="./img/image2.jpg"
                    class="card-img-top"
                    alt="Coffee 2"
                  />
                </div>
              </div>
              <div class="col-6">
                <div class="card-pic">
                  <img
                    src="./img/MilkTea3.jpg"
                    class="card-img-top"
                    alt="Coffee 3"
                  />
                </div>
              </div>
              <div class="col-6">
                <div class="card-pic">
                  <img
                    src="./img/image4.jpg"
                    class="card-img-top"
                    alt="Coffee 4"
                  />
                </div>
              </div>
              <div class="col-6">
                <div class="card-pic">
                  <img
                    src="./img/MilkTea2.jpg"
                    class="card-img-top"
                    alt="Coffee 5"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal -->
      <div
        class="modal fade"
        id="gallery-modal"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-body p-0">
              <img class="modal-img" src="./img/juice.jpg" alt="" />
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Book -->

    <div id="book" class="container bg-white">
      <div class="container row">
        <div class="time col col-lg-6 col-12 my-auto">
          <div class="h4 text-center text-warning fw-bolder mb-2">
            GIỜ MỞ CỬA
          </div>
          <p class="text-center text-dark">
            Thứ 2 - Thứ 6 hàng tuần <br />
            8am – 11am <br />
            11am – 9pm <br /><br />
            Thứ 7, Chủ nhật hàng tuần <br />
            9am – 1 am<br />
            11am – 10pm
          </p>
          <div class="line mx-auto"></div>
          <p class="text-center text-dark">Số điện thoại</p>
          <div class="h2 text-center text-warning fw-bolder">0123.456.789</div>
        </div>
        <div class="books col col-lg-6 col-12 p-5 rounded text-center">
          <div class="h3 text-center fw-bolder text-uppercase mb-2">
            Bạn có muốn đặt bàn ?
          </div>
          <p class="text-center">Gọi ngay cho chúng tôi để đặt bàn</p>
          <form class="row g-3">
            <div class="col-md-6">
              <label for="inputName4" class="form-label">Tên</label>
              <input
                type="text"
                class="form-control"
                id="inputName"
                placeholder="Nguyễn Văn A"
              />
            </div>
            <div class="col-md-6">
              <label for="inputEmail4" class="form-label">Email</label>
              <input
                type="email"
                class="form-control"
                id="inputEmail4"
                placeholder="a123@gmail.com"
              />
            </div>
            <div class="col-12">
              <label for="inputPhone" class="form-label">Số Điện Thoại</label>
              <input
                type="text"
                class="form-control"
                id="inputPhone"
                placeholder="0987654321"
              />
            </div>
            <div class="col-12">
              <label for="inputDate" class="form-label">Ngày</label>
              <input type="date" class="form-control" id="inputDate" />
            </div>
            <div class="col-md-7">
              <label for="inputTime" class="form-label">Thời gian</label>
              <input
                type="text"
                class="form-control"
                id="inputTime"
                placeholder="8:00"
              />
            </div>
            <div class="col-md-5">
              <label for="inputState" class="form-label">Số Ngưởi</label>
              <select id="inputState" class="form-select">
                <option selected>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
              </select>
            </div>
            <div class="col-12 text-center mt-5">
              <button type="submit" class="btn btn-primary btn-lg">
                Xác nhận đặt
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Biểu tượng -->
    <div style="margin-top: 100px" class="container">
      <div class="row g-3">
        <div
          style="height: 130px"
          class="d-flex col col-12 col-lg-4 border-top"
        >
          <div class="row">
            <img
              style="width: auto; height: 50px"
              class="col col-4 my-auto"
              src="./img/service_1.png"
              alt="service_1"
            />
            <div class="text col col-8 my-auto">
              Đồ uống chất lượng hàng đầu châu Á
            </div>
          </div>
        </div>
        <div
          style="height: 130px"
          class="d-flex col col-12 col-lg-4 border-top"
        >
          <div class="row">
            <img
              style="width: auto; height: 40px"
              class="col col-4 my-auto"
              src="./img/service_2.png"
              alt="service_2"
            />
            <div class="text col col-8 my-auto">
              Đồ uống với nguồn gốc nhập khẩu rõ ràng
            </div>
          </div>
        </div>
        <div
          style="height: 130px"
          class="d-flex col col-12 col-lg-4 border-top"
        >
          <div class="row">
            <img
              style="width: auto; height: 55px"
              class="col col-4 my-auto"
              src="./img/service_3.png"
              alt="service_3"
            />
            <div class="text col col-8 my-auto">
              Đồ uống với giá thành hợp lý nhất
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- fooder -->
    <div class="fooder row p-5">
      <div class="col col-sm-6 col-lg-3 col-12 mb-4">
        <a href="#"
          ><img class="logo-fooder" src="./img/logo.png" alt="logo"
        /></a>
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
              <img
                src="./img/MilkTea1.jpg"
                class="card-img-top"
                alt="Coffee 1"
              />
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
              <img
                src="./img/MilkTea2.jpg"
                class="card-img-top"
                alt="Coffee 6"
              />
            </div>
          </div>
        </div>
      </div>
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
    <script src="./js/script.js"></script>
  </body>
</html>
