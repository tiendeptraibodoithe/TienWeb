-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2024 at 04:18 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quanlyquan`
--

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_don_hang`
--

CREATE TABLE `chi_tiet_don_hang` (
  `id` int(11) NOT NULL,
  `don_hang_id` int(11) DEFAULT NULL,
  `mon_an_id` int(11) DEFAULT NULL,
  `so_luong` int(11) DEFAULT NULL,
  `gia` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chi_tiet_don_hang`
--

INSERT INTO `chi_tiet_don_hang` (`id`, `don_hang_id`, `mon_an_id`, `so_luong`, `gia`) VALUES
(1, 1, 34, 7, 30),
(2, 1, 35, 1, 35),
(3, 2, 36, 2, 40),
(4, 2, 35, 2, 35),
(5, 2, 34, 2, 30),
(6, 3, 36, 3, 40),
(7, 3, 34, 4, 30),
(8, 4, 35, 1, 35),
(9, 4, 36, 1, 40),
(10, 4, 34, 1, 30),
(11, 5, 35, 2, 35),
(12, 5, 36, 2, 40),
(13, 5, 34, 1, 30),
(14, 6, 37, 1, 20),
(15, 6, 36, 1, 40),
(16, 6, 35, 1, 35),
(17, 6, 34, 1, 30),
(18, 7, 36, 2, 40),
(19, 7, 35, 1, 35),
(20, 7, 34, 1, 30),
(21, 8, 36, 2, 40),
(22, 8, 37, 1, 20);

-- --------------------------------------------------------

--
-- Table structure for table `don_hang`
--

CREATE TABLE `don_hang` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tong_tien` decimal(10,0) DEFAULT NULL,
  `ngay_dat` datetime DEFAULT NULL,
  `khach_hang` varchar(255) DEFAULT NULL,
  `ban_so` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `don_hang`
--

INSERT INTO `don_hang` (`id`, `user_id`, `tong_tien`, `ngay_dat`, `khach_hang`, `ban_so`) VALUES
(1, 1, 245, '2024-11-05 22:45:45', NULL, NULL),
(2, 1, 210, '2024-12-05 23:45:37', NULL, NULL),
(3, 1, 240, '2024-12-06 10:00:18', NULL, NULL),
(4, 1, 105, '2024-12-06 12:58:31', 'Phạm Long', 3),
(5, 1, 180, '2024-12-07 13:37:26', 'Trung Tien', 8),
(6, 1, 125, '2024-12-07 14:40:30', 'Toan', 4),
(7, 1, 145, '2024-12-12 20:05:44', 'Long', 5),
(8, 1, 100, '2024-12-12 22:05:14', 'Long', 4);

-- --------------------------------------------------------

--
-- Table structure for table `khach_hang`
--

CREATE TABLE `khach_hang` (
  `ma_khach_hang` varchar(10) NOT NULL,
  `ho_va_ten` varchar(100) NOT NULL,
  `gioi_tinh` varchar(5) DEFAULT NULL,
  `ngay_sinh` date DEFAULT NULL,
  `so_dien_thoai` varchar(15) DEFAULT NULL,
  `tong_so_don_hang` int(11) DEFAULT 0,
  `tong_chi_tieu` decimal(15,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `khach_hang`
--

INSERT INTO `khach_hang` (`ma_khach_hang`, `ho_va_ten`, `gioi_tinh`, `ngay_sinh`, `so_dien_thoai`, `tong_so_don_hang`, `tong_chi_tieu`) VALUES
('KH001', 'Nguyễn Văn An', 'Nam', '1990-05-15', '0912345678', 5, 15000000.00),
('KH002', 'Trần Thị Bích', 'Nữ', '1985-10-20', '0987654321', 3, 8500000.00),
('KH003', 'Lê Quang Minh', 'Nam', '1995-03-10', '0909090909', 7, 22000000.00),
('KH004', 'Phạm Thị Hương', 'Nữ', '1988-12-25', '0923456789', 4, 12500000.00),
('KH005', 'Vũ Đức Tuấn', 'Nam', '1992-07-30', '0945678901', 6, 18000000.00),
('KH006', 'GA', 'Nữ', '2024-11-14', '30122310', 8, 2312312.00);

-- --------------------------------------------------------

--
-- Table structure for table `mon_an`
--

CREATE TABLE `mon_an` (
  `id` int(11) NOT NULL,
  `ten_mon` varchar(255) NOT NULL,
  `gia` decimal(10,0) NOT NULL,
  `the_loai` varchar(255) DEFAULT NULL,
  `hinh_anh` varchar(255) DEFAULT NULL,
  `mo_ta` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mon_an`
--

INSERT INTO `mon_an` (`id`, `ten_mon`, `gia`, `the_loai`, `hinh_anh`, `mo_ta`) VALUES
(34, 'Cafe Kem chi', 30000, 'Cafe', '.\\img\\cafekemchi.png', 'ngon'),
(35, 'Sữa tươi nếp cẩm', 35000, 'Trà Sữa', '.\\img\\Sua-Tuoi-Nep-Cam.png', 'ngon'),
(36, 'Trà Đào', 40000, 'Nước hoa quả', '.\\img\\Tra-Dao-Tien-Que-Hoa.png', 'ngon'),
(37, 'Ô long đào lê tắc', 20000, 'Nước hoa quả', '.\\img\\O-long-dao-le-tay-bac-khong-lo.png', 'ngon');

-- --------------------------------------------------------

--
-- Table structure for table `nhan_vien`
--

CREATE TABLE `nhan_vien` (
  `ma_nv` int(11) NOT NULL,
  `ho_ten` varchar(100) NOT NULL,
  `so_dien_thoai` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `gioi_tinh` enum('Nam','Nữ','Khác') NOT NULL,
  `ngay_sinh` date DEFAULT NULL,
  `luong` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nhan_vien`
--

INSERT INTO `nhan_vien` (`ma_nv`, `ho_ten`, `so_dien_thoai`, `email`, `gioi_tinh`, `ngay_sinh`, `luong`) VALUES
(2, 'Tiến', '0326928423', 'tienadmin@gmail.com', 'Nam', '2003-12-07', 50000000.00),
(4, 'Tien', '123131', 'tienhaku0412@gmail.com', 'Nam', '2024-11-13', 777777.00),
(5, 'Long', '03123145', 'longlong@gmail.ocm', 'Nam', '2024-12-25', 99999999.99),
(6, 'GA', '0312513', 'ga23weqw@gmail.com', 'Nam', '2024-12-17', 2312314.00),
(7, 'ưeqw', '01239123', 'tienhaku2231@gmail.com', 'Nam', '2024-12-11', 23122312.00);

-- --------------------------------------------------------

--
-- Table structure for table `tai_khoan`
--

CREATE TABLE `tai_khoan` (
  `id` int(11) NOT NULL,
  `ten_tai_khoan` varchar(50) NOT NULL,
  `mat_khau` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tai_khoan`
--

INSERT INTO `tai_khoan` (`id`, `ten_tai_khoan`, `mat_khau`, `email`) VALUES
(1, 'Phạm Minh Tiến', '$2y$10$My5IqysUQmsHHQcEBkg7SeXNUBosokyezEb/xTv2kijvCwLNRjbXO', 'tienadmin@gmail.com'),
(2, 'Long', '$2y$10$Y5qNNyF1ygJvLjJcG4uyE.AVKof8RMljbt8awVktIvvt4/G3gF9G6', 'longga2003@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `don_hang`
--
ALTER TABLE `don_hang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `khach_hang`
--
ALTER TABLE `khach_hang`
  ADD PRIMARY KEY (`ma_khach_hang`);

--
-- Indexes for table `mon_an`
--
ALTER TABLE `mon_an`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nhan_vien`
--
ALTER TABLE `nhan_vien`
  ADD PRIMARY KEY (`ma_nv`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tai_khoan`
--
ALTER TABLE `tai_khoan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ten_tai_khoan` (`ten_tai_khoan`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `don_hang`
--
ALTER TABLE `don_hang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `mon_an`
--
ALTER TABLE `mon_an`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `nhan_vien`
--
ALTER TABLE `nhan_vien`
  MODIFY `ma_nv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tai_khoan`
--
ALTER TABLE `tai_khoan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
