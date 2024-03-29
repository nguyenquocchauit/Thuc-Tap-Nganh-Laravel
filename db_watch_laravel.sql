-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2023 at 12:29 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_watch_laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `id` varchar(15) NOT NULL,
  `name` varchar(255) NOT NULL,
  `avt` text NOT NULL,
  `address` text NOT NULL,
  `phone_number` varchar(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(100) DEFAULT NULL,
  `create_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `role` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`id`, `name`, `avt`, `address`, `phone_number`, `email`, `password`, `token`, `create_at`, `updated_at`, `role`) VALUES
('nv105122022', 'Nguyễn Quốc Châu', 'nguyen-quoc-chau.png', '074 Nguyễn Tất Thành, Xã Phước Đồng, Thành phố Nha Trang, Tỉnh Khánh Hòa', '0386888829', 'chauquocnguyen.cun1@gmail.com', '$2y$10$btLjHt8eVhebOQNdTSMHcuxlKJ74yWjju1PkqhqaWXnWHqndPePrG', '', '2022-12-05 17:58:39', '2023-05-30 20:26:31', 2),
('nv226052023', 'Nguyễn Khánh Nam', 'nguyen-khanh-nam.png', '25 Nguyễn Trung Trực, Thị trấn Kép, Huyện Lạng Giang, Tỉnh Bắc Giang', '0386888888', 'nguyenkhanhnam@gmail.com', '$2y$10$/nMeQirGpmQwSI.XG24aCeVEbpF3BLpMfQ0.JEshDf/ROn.cSOYou', NULL, '2023-05-23 15:21:32', '2023-06-07 22:57:13', 1),
('nv323052023', 'Nguyễn Trần Hoàn Kim', 'nguyen-tran-hoan-kim3.png', '100 Nguyễn Thiện Thuật, Phường Trưng Trắc, Thành phố Phúc Yên, Tỉnh Vĩnh Phúc', '0926266666', 'hoankim.nguyentran@gmail.com', '$2y$10$8kb3RBJ5boVYZ2WDyIcvPuL', NULL, '2023-04-05 01:36:13', '2023-05-30 20:21:30', 1),
('nv426052023', 'Lê Thị Mỹ Huyền', 'le-thi-my-huyen4.png', 'Địa chỉ 1c, Phường Quang Trung, Thành phố Hà Giang, Tỉnh Hà Giang', '0926383585', 'lethimyhuyen@gmail.com', '$2y$10$1ubzOIQEJok63jCNWdH1euS', NULL, '2023-05-26 19:41:36', '2023-05-26 19:41:36', 1);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `slug` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`) VALUES
('Avia', 'Aviator', 'aviator'),
('Baby', 'Baby-G', 'baby-g'),
('Bentley', 'Bentley', 'bentley'),
('Citizen', 'Citizen', 'citizen'),
('GShock', 'G-Shock', 'g-shock'),
('Olym', 'Olym Pianus', 'olym-pianus');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` varchar(100) NOT NULL,
  `customers` varchar(15) NOT NULL,
  `product` varchar(20) NOT NULL,
  `content` text DEFAULT NULL,
  `star` smallint(5) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `customers`, `product`, `content`, `star`, `created_at`) VALUES
('cm108122022', 'kh105122022', 'sp427052023', 'Sản phẩm tốt, đẹp. Mình đánh giá 4 sao nha', 4, '2022-12-08 10:03:41'),
('cm208122022', 'kh105122022', 'sp427052023', 'Sản phẩm ok lắm nha. Ưng lắm', 5, '2022-12-15 11:53:14'),
('cm308122022', 'kh105122022', 'sp127052023', 'Đẹp lắm ', 5, '2022-12-15 12:31:23'),
('cm408122022', 'kh26122022', 'sp127052023', 'ddd', 4, '2022-12-25 05:10:34'),
('cm508122022', 'kh26122022', 'sp527052023', 'đẹp lắm bạn ạ', 0, '2023-04-01 07:00:00'),
('cm608122022', 'kh26122022', 'sp327052023', 'good', 4, '2023-04-28 05:44:35'),
('cm727052023', 'kh26122022', 'sp827052023', 'Sản phẩm đẹp lắm', 4, '2023-05-27 01:31:53'),
('cm827052023', 'kh26122022', 'sp827052023', '', 4, '2023-05-27 01:43:25'),
('cm929052023', 'kh1026052023', 'sp527052023', '.', 4, '2023-05-29 19:01:26');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` varchar(100) NOT NULL,
  `customers` varchar(15) NOT NULL,
  `product` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL COMMENT 'none or liked',
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `customers`, `product`, `status`, `created_at`) VALUES
('like127052023', 'kh26122022', 'sp827052023', 'like', '2023-05-27 01:31:34'),
('like227052023', 'kh26122022', 'sp727052023', 'none', '2023-05-27 01:31:35'),
('like327052023', 'kh26122022', 'sp1027052023', 'like', '2023-05-27 02:00:29'),
('like427052023', 'kh26122022', 'sp1127052023', 'like', '2023-05-27 02:00:30'),
('like527052023', 'kh26122022', 'sp127052023', 'like', '2023-05-27 02:00:31');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` varchar(20) NOT NULL,
  `customers` varchar(15) NOT NULL,
  `employee` varchar(15) NOT NULL,
  `status` varchar(3) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `total` float NOT NULL,
  `note` text NOT NULL,
  `method_payment` varchar(50) NOT NULL,
  `status_payment` tinyint(1) NOT NULL,
  `delivery_address` text NOT NULL,
  `order_notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customers`, `employee`, `status`, `created_at`, `updated_at`, `total`, `note`, `method_payment`, `status_payment`, `delivery_address`, `order_notes`) VALUES
('HD1018253928052023', 'kh1026052023', 'nv105122022', 'TC', '2023-05-28 18:25:39', '2023-05-28 18:26:43', 97200, 'nv105122022 status: Thành công - 18:26:43 28-05-2023, nv105122022 status: Chưa xác nhận - 18:25:39 28-05-2023', '', 0, '', ''),
('HD1118255228052023', 'kh1026052023', 'nv105122022', 'TC', '2023-04-06 18:25:52', '2023-04-06 18:25:52', 8721000, 'nv105122022 status: Thành công - 18:26:41 28-05-2023, nv105122022 status: Chưa xác nhận - 18:25:52 28-05-2023', '', 0, '', ''),
('HD114523728052023', 'kh1026052023', 'nv105122022', 'TC', '2023-04-14 14:52:37', '2023-05-28 15:11:25', 105909000, 'nv105122022 status: Thành công - 15:11:25 28-05-2023, nv105122022 status: Thất bại - 14:52:57 28-05-2023, nv323052023 status: Chưa xác nhận - 14:52:37 28-05-2023', '', 0, '', ''),
('HD1218261128052023', 'kh1026052023', 'nv105122022', 'TC', '2023-05-28 18:26:11', '2023-05-28 18:26:38', 9354420, 'nv105122022 status: Thành công - 18:26:38 28-05-2023, nv105122022 status: Chưa xác nhận - 18:26:11 28-05-2023', '', 0, '', ''),
('HD1318261728052023', 'kh1026052023', 'nv105122022', 'DVC', '2023-05-28 18:26:17', '2023-05-29 14:11:55', 5201820, 'nv105122022 status: Đang vận chuyển - 14:11:55 29-05-2023, nv105122022 status: Thành công - 18:26:36 28-05-2023, nv105122022 status: Chưa xác nhận - 18:26:17 28-05-2023', '', 0, '', ''),
('HD1418261928052023', 'kh1026052023', 'nv105122022', 'TC', '2023-05-28 18:26:19', '2023-05-28 18:26:34', 19440000, 'nv105122022 status: Thành công - 18:26:34 28-05-2023, nv105122022 status: Chưa xác nhận - 18:26:19 28-05-2023', '', 0, '', ''),
('HD1518262128052023', 'kh1026052023', 'nv105122022', 'TC', '2023-05-28 18:26:21', '2023-05-28 18:26:30', 9090360, 'nv105122022 status: Thành công - 18:26:30 28-05-2023, nv105122022 status: Chưa xác nhận - 18:26:21 28-05-2023', '', 0, '', ''),
('HD1614083129052023', 'kh1026052023', 'nv105122022', 'TC', '2023-05-29 14:08:31', '2023-06-11 16:18:50', 97200, 'nv105122022 status: Thành công - 16:18:50 11-06-2023, nv105122022 status: Chưa xác nhận - 14:09:48 29-05-2023, nv105122022 status: Đang vận chuyển - 14:09:44 29-05-2023, nv323052023 status: Chưa xác nhận - 14:08:31 29-05-2023', '', 0, '', ''),
('HD1714483729052023', 'kh26122022', 'nv105122022', 'TB', '2023-05-29 14:48:37', '2023-06-08 14:32:10', 31807500, 'nv105122022 status: Thất bại - 14:32:10 08-06-2023, nv105122022 status: Đang vận chuyển - 14:28:45 08-06-2023, nv105122022 status: Thành công - 14:27:14 08-06-2023, nv323052023 status: Chưa xác nhận - 14:48:37 29-05-2023', '', 0, '', ''),
('HD1814375808062023', 'kh1130052023', 'nv105122022', 'TC', '2023-06-08 14:37:58', '2023-06-11 16:04:11', 2967840, 'nv105122022 status: Thành công - 16:04:11 11-06-2023, nv105122022 status: Đang vận chuyển - 15:57:03 11-06-2023, nv105122022 status: Thất bại - 14:48:31 08-06-2023, nv105122022 status: Thành công - 14:48:06 08-06-2023, nv105122022 status: Chưa xác nhận - 14:47:59 08-06-2023, nv105122022 status: Thất bại - 14:47:43 08-06-2023, nv105122022 status: Đang vận chuyển - 14:47:27 08-06-2023, nv105122022 status: Thất bại - 14:46:10 08-06-2023, nv105122022 status: Đang vận chuyển - 14:46:03 08-06-2023, nv105122022 status: Thất bại - 14:45:35 08-06-2023, nv105122022 status: Thành công - 14:45:27 08-06-2023, nv105122022 status: Thất bại - 14:45:20 08-06-2023, nv105122022 status: Thành công - 14:44:23 08-06-2023, nv105122022 status: Thất bại - 14:43:13 08-06-2023, nv105122022 status: Thành công - 14:43:06 08-06-2023, nv105122022 status: Thất bại - 14:42:36 08-06-2023, nv105122022 status: Thành công - 14:42:31 08-06-2023, nv105122022 status: Thất bại - 14:42:25 08-06-2023, nv105122022 status: Đang vận chuyển - 14:38:22 08-06-2023, nv323052023 status: Chưa xác nhận - 14:37:58 08-06-2023', '', 0, '', ''),
('HD1917000611062023', 'kh105122022', 'nv105122022', 'TC', '2023-06-11 17:00:06', '2023-06-11 17:00:25', 98010000, 'nv105122022 status: Thành công - 17:00:25 11-06-2023, nv323052023 status: Chưa xác nhận - 17:00:06 11-06-2023', '', 0, '', ''),
('HD2017344911062023', 'kh105122022', 'nv105122022', 'XN', '2023-06-11 17:34:49', '2023-06-11 17:34:49', 118144000, 'nv105122022 status: Chưa xác nhận - 17:34:49 11-06-2023', '', 0, '', ''),
('HD2117240716062023', 'kh1130052023', 'nv323052023', 'XN', '2023-06-16 17:24:07', '2023-06-16 17:24:07', 25693200, 'nv323052023 status: Chưa xác nhận - 17:24:07 16-06-2023', 'bank', 1, 'Địa chỉ 1c, Phường Ngọc Hà, Thành phố Hà Giang, Tỉnh Hà Giang', 'giao hàng giờ chưa'),
('HD214524428052023', 'kh1026052023', 'nv105122022', 'TC', '2023-05-28 14:52:44', '2023-05-28 14:52:55', 29294800, 'nv105122022 status: Thành công - 14:52:55 28-05-2023, nv323052023 status: Chưa xác nhận - 14:52:44 28-05-2023', '', 0, '', ''),
('HD2217321616062023', 'kh1130052023', 'nv105122022', 'XN', '2023-06-16 17:32:16', '2023-06-16 17:32:16', 9504000, 'nv105122022 status: Chưa xác nhận - 17:32:16 16-06-2023', 'cash', 0, 'Địa chỉ 1c, Phường Ngọc Hà, Thành phố Hà Giang, Tỉnh Hà Giang', NULL),
('HD2317332916062023', 'kh1130052023', 'nv105122022', 'TB', '2023-06-16 17:33:29', '2023-06-16 17:33:29', 9504000, 'kh cancel - nv105122022 status: Chưa xác nhận - 17:33:29 16-06-2023', 'cash', 0, 'Địa chỉ 1c, Phường Ngọc Hà, Thành phố Hà Giang, Tỉnh Hà Giang', NULL),
('HD2417334416062023', 'kh1130052023', 'nv105122022', 'TC', '2023-06-16 17:33:44', '2023-06-16 19:45:04', 9504000, 'nv105122022 status: Thành công - 19:45:04 16-06-2023, nv105122022 status: Chưa xác nhận - 17:33:44 16-06-2023', 'cash', 1, 'Địa chỉ 1c, Phường Ngọc Hà, Thành phố Hà Giang, Tỉnh Hà Giang', 'ok'),
('HD2520192116062023', 'kh1130052023', 'nv105122022', 'DVC', '2023-06-16 20:19:21', '2023-06-16 21:56:31', 25693200, 'nv105122022 status: Đang vận chuyển - 21:56:31 16-06-2023, nv105122022 status: Chưa xác nhận - 21:50:58 16-06-2023, nv105122022 status: Chưa xác nhận - 20:19:21 16-06-2023', 'cash', 0, 'Địa chỉ 1c, Phường Ngọc Hà, Thành phố Hà Giang, Tỉnh Hà Giang', NULL),
('HD2623133816062023', 'kh1130052023', 'nv105122022', 'XN', '2023-06-16 23:13:38', '2023-06-16 23:13:38', 6469200, 'nv105122022 status: Chưa xác nhận - 23:13:38 16-06-2023', 'bank', 0, 'Địa chỉ 1a, Phường Ngọc Hà, Thành phố Hà Giang, Tỉnh Hà Giang', NULL),
('HD2723181616062023', 'kh1130052023', 'nv105122022', 'XN', '2023-06-16 23:18:16', '2023-06-16 23:18:16', 9504000, 'nv105122022 status: Chưa xác nhận - 23:18:16 16-06-2023', 'bank', 2, 'Địa chỉ 1a, Phường Ngọc Hà, Thành phố Hà Giang, Tỉnh Hà Giang', NULL),
('HD314532028052023', 'kh1026052023', 'nv105122022', 'TB', '2023-05-28 14:53:20', '2023-05-28 14:53:25', 29294800, 'nv105122022 status: Thất bại - 14:53:25 28-05-2023, nv323052023 status: Chưa xác nhận - 14:53:20 28-05-2023', '', 0, '', ''),
('HD414534728052023', 'kh1026052023', 'nv105122022', 'TC', '2023-05-28 14:53:47', '2023-05-28 17:01:44', 20005900, 'nv105122022 status: Thành công - 17:01:44 28-05-2023, nv105122022 status: Chưa xác nhận - 16:11:43 28-05-2023, nv105122022 status: Thành công - 14:54:21 28-05-2023, nv105122022 status: Thất bại - 14:53:50 28-05-2023, nv323052023 status: Chưa xác nhận - 14:53:47 28-05-2023', '', 0, '', ''),
('HD517010428052023', 'kh1026052023', 'nv105122022', 'TC', '2023-05-28 17:01:04', '2023-05-28 17:01:39', 121236000, 'nv105122022 status: Thành công - 17:01:39 28-05-2023, nv323052023 status: Chưa xác nhận - 17:01:04 28-05-2023', '', 0, '', ''),
('HD617025428052023', 'kh1026052023', 'nv323052023', 'TC', '2023-03-08 17:02:54', '2023-03-09 17:02:54', 78019600, 'nv323052023 status: Chưa xác nhận - 17:02:54 28-05-2023', '', 0, '', ''),
('HD718192428052023', 'kh1026052023', 'nv105122022', 'TC', '2023-03-09 18:19:24', '2023-03-09 18:19:24', 588557000, 'nv105122022 status: Thành công - 18:19:29 28-05-2023, nv105122022 status: Chưa xác nhận - 18:19:24 28-05-2023', '', 0, '', ''),
('HD818204928052023', 'kh1026052023', 'nv105122022', 'TC', '2023-01-11 18:20:49', '2023-05-28 18:22:12', 163652000, 'nv105122022 status: Thành công - 18:22:12 28-05-2023, nv105122022 status: Chưa xác nhận - 18:20:49 28-05-2023', '', 0, '', ''),
('HD918213528052023', 'kh1026052023', 'nv105122022', 'TC', '2023-02-07 18:21:35', '2023-02-07 18:22:15', 192402000, 'nv105122022 status: Thành công - 18:22:15 28-05-2023, nv105122022 status: Chưa xác nhận - 18:21:35 28-05-2023', '', 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` varchar(100) NOT NULL,
  `orders` varchar(20) NOT NULL,
  `product` varchar(20) NOT NULL,
  `quantity` smallint(2) NOT NULL,
  `price` float NOT NULL,
  `discount` tinyint(3) NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `orders`, `product`, `quantity`, `price`, `discount`, `total`) VALUES
('CTHD1017010428052023', 'HD517010428052023', 'sp327052023', 1, 10000000, 10, 9720000),
('CTHD1117010428052023', 'HD517010428052023', 'sp627052023', 1, 5990000, 0, 6469200),
('CTHD114523728052023', 'HD114523728052023', 'sp927052023', 1, 9960000, 10, 9681120),
('CTHD1217010428052023', 'HD517010428052023', 'sp3927052023', 1, 100000, 10, 97200),
('CTHD1317010428052023', 'HD517010428052023', 'sp1627052023', 1, 7500000, 5, 7695000),
('CTHD1417010428052023', 'HD517010428052023', 'sp1327052023', 1, 18110000, 0, 19558800),
('CTHD1517010428052023', 'HD517010428052023', 'sp1427052023', 2, 4960000, 45, 5892480),
('CTHD1617010428052023', 'HD517010428052023', 'sp1527052023', 1, 42500000, 10, 41310000),
('CTHD1717010428052023', 'HD517010428052023', 'sp3127052023', 1, 15260000, 15, 14008700),
('CTHD1817010428052023', 'HD517010428052023', 'sp3227052023', 1, 10260000, 37, 6980900),
('CTHD1917025428052023', 'HD617025428052023', 'sp427052023', 1, 11000000, 20, 9504000),
('CTHD2017025428052023', 'HD617025428052023', 'sp327052023', 1, 10000000, 10, 9720000),
('CTHD2117025428052023', 'HD617025428052023', 'sp627052023', 1, 5990000, 0, 6469200),
('CTHD214523728052023', 'HD114523728052023', 'sp1027052023', 1, 99000000, 10, 96228000),
('CTHD2217025428052023', 'HD617025428052023', 'sp727052023', 1, 4560000, 6, 4629310),
('CTHD2317025428052023', 'HD617025428052023', 'sp827052023', 1, 9560000, 15, 8776080),
('CTHD2417025428052023', 'HD617025428052023', 'sp527052023', 1, 8500000, 5, 8721000),
('CTHD2517025428052023', 'HD617025428052023', 'sp1427052023', 1, 4960000, 45, 2946240),
('CTHD2617025428052023', 'HD617025428052023', 'sp1327052023', 1, 18110000, 0, 19558800),
('CTHD2717025428052023', 'HD617025428052023', 'sp1627052023', 1, 7500000, 5, 7695000),
('CTHD2818192428052023', 'HD718192428052023', 'sp1427052023', 5, 4960000, 45, 14731200),
('CTHD2918192428052023', 'HD718192428052023', 'sp1227052023', 5, 9560000, 0, 51624000),
('CTHD3018192428052023', 'HD718192428052023', 'sp327052023', 5, 10000000, 10, 48600000),
('CTHD3118192428052023', 'HD718192428052023', 'sp627052023', 2, 5990000, 0, 12938400),
('CTHD314524428052023', 'HD214524428052023', 'sp1227052023', 1, 9560000, 0, 10324800),
('CTHD3218192428052023', 'HD718192428052023', 'sp1027052023', 2, 99000000, 10, 192456000),
('CTHD3318192428052023', 'HD718192428052023', 'sp1127052023', 3, 19960000, 12, 56910000),
('CTHD3418192428052023', 'HD718192428052023', 'sp127052023', 2, 999999, 99, 21600),
('CTHD3518192428052023', 'HD718192428052023', 'sp1527052023', 3, 42500000, 10, 123930000),
('CTHD3618192428052023', 'HD718192428052023', 'sp1627052023', 5, 7500000, 5, 38475000),
('CTHD3718192428052023', 'HD718192428052023', 'sp1727052023', 3, 10190000, 15, 28063300),
('CTHD3818192428052023', 'HD718192428052023', 'sp1827052023', 4, 7410000, 35, 20807300),
('CTHD3918204928052023', 'HD818204928052023', 'sp127052023', 5, 999999, 99, 53999.9),
('CTHD4018204928052023', 'HD818204928052023', 'sp227052023', 4, 18000000, 1, 76982400),
('CTHD4118204928052023', 'HD818204928052023', 'sp327052023', 5, 10000000, 10, 48600000),
('CTHD414524428052023', 'HD214524428052023', 'sp1127052023', 1, 19960000, 12, 18970000),
('CTHD4218204928052023', 'HD818204928052023', 'sp427052023', 4, 11000000, 20, 38016000),
('CTHD4318213528052023', 'HD918213528052023', 'sp127052023', 5, 999999, 99, 53999.9),
('CTHD4418213528052023', 'HD918213528052023', 'sp227052023', 5, 18000000, 1, 96228000),
('CTHD4518213528052023', 'HD918213528052023', 'sp327052023', 5, 10000000, 10, 48600000),
('CTHD4618213528052023', 'HD918213528052023', 'sp427052023', 5, 11000000, 20, 47520000),
('CTHD4718253928052023', 'HD1018253928052023', 'sp3927052023', 20, 100000, 10, 1944000),
('CTHD4818255228052023', 'HD1118255228052023', 'sp527052023', 20, 8500000, 5, 174420000),
('CTHD4918261128052023', 'HD1218261128052023', 'sp1727052023', 10, 10190000, 15, 93544200),
('CTHD5018261728052023', 'HD1318261728052023', 'sp1827052023', 10, 7410000, 35, 52018200),
('CTHD5118261928052023', 'HD1418261928052023', 'sp1927052023', 10, 18000000, 0, 194400000),
('CTHD514532028052023', 'HD314532028052023', 'sp1227052023', 1, 9560000, 0, 10324800),
('CTHD5218262128052023', 'HD1518262128052023', 'sp2027052023', 10, 8860000, 5, 90903600),
('CTHD5314083129052023', 'HD1614083129052023', 'sp3927052023', 1, 100000, 10, 97200),
('CTHD5414483729052023', 'HD1714483729052023', 'sp927052023', 1, 9960000, 10, 9681120),
('CTHD5514483729052023', 'HD1714483729052023', 'sp827052023', 1, 9560000, 15, 8776080),
('CTHD5614483729052023', 'HD1714483729052023', 'sp727052023', 1, 4560000, 6, 4629310),
('CTHD5714483729052023', 'HD1714483729052023', 'sp527052023', 1, 8500000, 5, 8721000),
('CTHD5814375808062023', 'HD1814375808062023', 'sp1427052023', 1, 4960000, 45, 2946240),
('CTHD5914375808062023', 'HD1814375808062023', 'sp127052023', 2, 999999, 99, 21600),
('CTHD6017000611062023', 'HD1917000611062023', 'sp1627052023', 2, 7500000, 5, 15390000),
('CTHD6117000611062023', 'HD1917000611062023', 'sp1527052023', 2, 42500000, 10, 82620000),
('CTHD614532028052023', 'HD314532028052023', 'sp1127052023', 1, 19960000, 12, 18970000),
('CTHD6217344911062023', 'HD2017344911062023', 'sp1427052023', 1, 4960000, 45, 2946240),
('CTHD6317344911062023', 'HD2017344911062023', 'sp1127052023', 1, 19960000, 12, 18970000),
('CTHD6417344911062023', 'HD2017344911062023', 'sp1027052023', 1, 99000000, 10, 96228000),
('CTHD6517240716062023', 'HD2117240716062023', 'sp427052023', 1, 11000000, 20, 9504000),
('CTHD6617240716062023', 'HD2117240716062023', 'sp327052023', 1, 10000000, 10, 9720000),
('CTHD6717240716062023', 'HD2117240716062023', 'sp627052023', 1, 5990000, 0, 6469200),
('CTHD6817321616062023', 'HD2217321616062023', 'sp427052023', 1, 11000000, 20, 9504000),
('CTHD6917332916062023', 'HD2317332916062023', 'sp427052023', 1, 11000000, 20, 9504000),
('CTHD7017334416062023', 'HD2417334416062023', 'sp427052023', 1, 11000000, 20, 9504000),
('CTHD7120192116062023', 'HD2520192116062023', 'sp427052023', 1, 11000000, 20, 9504000),
('CTHD714534728052023', 'HD414534728052023', 'sp927052023', 1, 9960000, 10, 9681120),
('CTHD7220192116062023', 'HD2520192116062023', 'sp327052023', 1, 10000000, 10, 9720000),
('CTHD7320192116062023', 'HD2520192116062023', 'sp627052023', 1, 5990000, 0, 6469200),
('CTHD7423133816062023', 'HD2623133816062023', 'sp627052023', 1, 5990000, 0, 6469200),
('CTHD7523181616062023', 'HD2723181616062023', 'sp427052023', 1, 11000000, 20, 9504000),
('CTHD814534728052023', 'HD414534728052023', 'sp1227052023', 1, 9560000, 0, 10324800),
('CTHD917010428052023', 'HD517010428052023', 'sp427052023', 1, 11000000, 20, 9504000);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `quantity` smallint(2) NOT NULL,
  `price` float NOT NULL,
  `discount` tinyint(3) NOT NULL,
  `create_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `gender` smallint(1) NOT NULL COMMENT '1 is men, 2 is women',
  `brand` varchar(50) NOT NULL,
  `image_1` text NOT NULL,
  `image_2` text NOT NULL,
  `image_3` text NOT NULL,
  `image_4` text NOT NULL,
  `image_5` text NOT NULL,
  `image_6` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `quantity`, `price`, `discount`, `create_at`, `updated_at`, `gender`, `brand`, `image_1`, `image_2`, `image_3`, `image_4`, `image_5`, `image_6`) VALUES
('sp1027052023', 'BENTLEY BL2080-252MKKI', 'BENTLEY 2080-152MKKI là mẫu đồng hồ cơ mới nhất hiện nay, xuất xứ thương hiệu đồng hồ của Đức nổi tiếng hàng đầu về sự chính xác và bền bỉ trong nghệ thuật chế tác đồng hồ. Nổi bật với 30 viên kim cương ( 12 viên tại cọc số, 18 viên còn lại được trải khắp đường viền của mặt phụ small second) và > 400 viên đá sapphire đầy sang trọng với độ tinh xảo cao mang tới phong cách sang trọng quý tộc và thanh lịch.', 209, 99000000, 10, '2022-12-06 11:23:33', '2022-12-06 11:23:33', 1, 'Bentley', 'bentley-bl2080-252mkki-1.png', 'bentley-bl2080-252mkki-2.png', 'bentley-bl2080-252mkki-3.png', 'bentley-bl2080-252mkki-4.png', 'bentley-bl2080-252mkki-5.png', 'bentley-bl2080-252mkki-6.png'),
('sp1127052023', 'BENTLY BL1805-20LKWD', 'Đồng hồ Bentley BL1805-20LKWD là mẫu đồng hồ nữ mới nhất hiện nay, xuất xứ thương hiệu đồng hồ của Đức nổi tiếng hàng đầu về sự chính xác và bền bỉ trong nghệ thuật chế tác đồng hồ, sản phẩm mang phong cách sang trọng quý tộc và thanh lịch, cuốn hút ngay từ cái nhìn đầu tiên với phong cách classic đầy tinh tế.', 343, 19960000, 12, '2022-12-06 11:23:33', '2022-12-06 11:23:33', 2, 'Bentley', 'bentley-bl1805-20lkwd-1.png', 'bentley-bl1805-20lkwd-2.png', 'bentley-bl1805-20lkwd-3.png', 'bentley-bl1805-20lkwd-4.png', 'bentley-bl1805-20lkwd-5.png', 'bentley-bl1805-20lkwd-6.png'),
('sp1227052023', 'BENTLY BL1707-101LWWW', 'Đồng hồ Bentley BL1707-101LWWW là mẫu đồng hồ nữ mới nhất hiện nay, xuất xứ thương hiệu đồng hồ của Đức nổi tiếng hàng đầu về sự chính xác và bền bỉ trong nghệ thuật chế tác đồng hồ, sản phẩm mang phong cách sang trọng quý tộc và thanh lịch, cuốn hút ngay từ cái nhìn đầu tiên với phong cách classic đầy tinh tế khi trang bị cho mình vòng bezel đính đá Swarovski', 871, 9560000, 0, '2022-12-06 11:25:45', '2022-12-06 11:25:45', 2, 'Bentley', 'bentley-bl1707-101lwww-1.png', 'bentley-bl1707-101lwww-2.png', 'bentley-bl1707-101lwww-3.png', 'bentley-bl1707-101lwww-4.png', 'bentley-bl1707-101lwww-5.png', 'bentley-bl1707-101lwww-6.png'),
('sp127052023', 'DOUGLAS DAY-DATE 41', 'Cách mạng hóa hoạt động du lịch, Douglas DC-3 vận chuyển hành khách với phong cách Hạng Nhất và trở thành công cụ trong Thời kỳ Vàng của ngành hàng không. Bằng cách pha trộn sự tinh tế của chuyến du lịch sang trọng với công nghệ tiên tiến và tay nghề thủ công, chiếc đồng hồ AVIATOR Douglas Day Date 41 vinh danh chiếc máy bay vĩ đại nhất thời đại.', 0, 999999, 99, '2022-12-05 18:22:40', '2023-06-08 14:45:57', 1, 'Avia', 'douglas-day-date-41-1.png', 'douglas-day-date-41-2.png', 'douglas-day-date-41-3.png', 'douglas-day-date-41-4.png', 'douglas-day-date-41-5.png', 'douglas-day-date-41-6.png'),
('sp1327052023', 'CITIZEN ECO DRIVE-BM7480', 'Đồng hồ Citizen BM7480-81L chính hãng, một thiết kế mới nhất của Citizen Japan năm 2022. Với chất liệu thép không gỉ 316L cao cấp, thiết kế măt số học trò to rõ đễ quan sát cùng bộ kim dạ quang sáng rõ cả trong bóng tối, mặt xanh lam dâyd sang trong. Bộ máy Eco-Drive bền bỉ có thể hoạt động với tuổi thọ trên 10 năm.', 98, 18110000, 0, '2022-12-06 11:28:05', '2022-12-06 11:28:05', 1, 'Citizen', 'citizen-eco-drive-bm7480-1.png', 'citizen-eco-drive-bm7480-2.png', 'citizen-eco-drive-bm7480-3.png', 'citizen-eco-drive-bm7480-4.png', 'citizen-eco-drive-bm7480-5.png', 'citizen-eco-drive-bm7480-6.png'),
('sp1427052023', 'CITIZEN AG835186E', 'Đồng hồ nam Citizen AG8351-86E nổi bật đồng hồ 6 kim và các chức năng lịch ngày với thiết kế độc đáo phân ra 3 ô riêng biệt mang đậm nét cá tính trên nền mặt số tone đen mạnh mẽ.', 1988, 4960000, 45, '2022-12-06 11:28:05', '2022-12-06 11:28:05', 1, 'Citizen', 'citizen-ag835186e-1.png', 'citizen-ag835186e-2.png', 'citizen-ag835186e-3.png', 'citizen-ag835186e-4.png', 'citizen-ag835186e-5.png', 'citizen-ag835186e-6.png'),
('sp1527052023', 'CITIZEN ER0212-50D', 'Citizen Quartz ER0212-50D có đường kính 30 mm và độ dày 6.7 mm. Mặt kính được làm bằng chất liệu kính khoáng. Khung vỏ được làm bằng chất liệu thép không gỉ 316L. Bên trong khung vỏ là bộ máy quartz có độ chính xác cao. Dây đeo được làm bằng thép không gỉ và được mạ màu vàng gold (yellow gold) bằng công nghệ PVD.', 705, 42500000, 10, '2022-12-06 11:30:40', '2022-12-06 11:30:40', 2, 'Citizen', 'citizen-er0212-50d-1.png', 'citizen-er0212-50d-2.png', 'citizen-er0212-50d-3.png', 'citizen-er0212-50d-4.png', 'citizen-er0212-50d-5.png', 'citizen-er0212-50d-6.png'),
('sp1627052023', 'CITIZEN EM0710-54Y', 'Đồng Hồ Nữ Citizen EM0710-54Y Chính Hãng. Đồng Hồ CitizenEco-Drive Women\'s Jolie Diamond EM0710-54Y có mặt số tròn, kim chỉ thanh mãnh,các nút chỉ giờ đính kim cương nổi bật trên nền số xà cừ màu hồng hiếm có, dây đeo stainless steel đem đến phong cách sang trọng và đẳng cấp cho phái nữ.', 1102, 7500000, 5, '2022-12-06 11:30:40', '2022-12-06 11:30:40', 2, 'Citizen', 'citizen-em0710-54y-1.png', 'citizen-em0710-54y-2.png', 'citizen-em0710-54y-3.png', 'citizen-em0710-54y-4.png', 'citizen-em0710-54y-5.png', 'citizen-em0710-54y-6.png'),
('sp1727052023', 'OLYM PIANUS OP99141-71AGK-T', 'Đồng hồ Olym Pianus OP99141-71AGK-GL-T là một thương hiệu đồng hồ Nhật Bản nổi tiếng bền bỉ với chất lượng vượt trội. Đồng hồ Olym Pianus OP99141-71AGK-GL-T kính cong vòm huyền thoại là một trong những thương hiệu đồng hồ hiếm hoi có giá thành vừa phải mà vẫn đáp ứng đầy đủ các tiêu chí về thiết kế hiện đại cũng như chất lượng sản phẩm mang tới cho khách hàng có những trải nghiệm tuyệt vời nhất.', 887, 10190000, 15, '2022-12-06 11:35:41', '2022-12-06 11:35:41', 1, 'Olym', 'olym-pianus-op99141-71agk-t-1.png', 'olym-pianus-op99141-71agk-t-2.png', 'olym-pianus-op99141-71agk-t-3.png', 'olym-pianus-op99141-71agk-t-4.png', 'olym-pianus-op99141-71agk-t-5.png', 'olym-pianus-op99141-71agk-t-6.png'),
('sp1827052023', 'OLYM PIANUS OP9946.1AGK-T', 'Đồng hồ Olym Pianus được ra đời từ những thập niên 50, trải qua suốt quá trình phát triển trên thị trường đồng hồ OP đã dần khẳng định là một trong những thương hiệu tầm trung có tiếng và được nhiều người yêu thích sử dụng. Mỗi thiết kế trong dòng OP luôn được cải tiến đổi mới cho phù hợp với lứa tuổi và thời gian hiện đại. Trong những năm trở lại đây đồng hồ OP được đưa vào thị trường Việt Nam, đã làm hài lòng đại đa số những người sử dụng về chất lượng cũng như mẫu mã sản phẩm.', 496, 7410000, 35, '2022-12-06 11:35:41', '2022-12-06 11:35:41', 1, 'Olym', 'olym-pianus-op9946-1agk-t-1.png', 'olym-pianus-op9946-1agk-t-2.png', 'olym-pianus-op9946-1agk-t-3.png', 'olym-pianus-op9946-1agk-t-4.png', 'olym-pianus-op9946-1agk-t-5.png', 'olym-pianus-op9946-1agk-t-6.png'),
('sp1927052023', 'OLYM PIANUS OP990-143AGR-GL-XL', 'Olym Pianus OP990-45ADGS-GL-T  là một thương hiệu đồng hồ Nhật Bản nổi tiếng bền bỉ với chất lượng vượt trội, mang một diện mạo phong thái phóng khoáng và vô cùng sang trọng giúp nó nổi bật ở bất cứ nơi đâu, đây là một trong những sản phẩm nổi bật của thương hiệu Olym Pianus, có giá thành vừa phải mà vẫn đáp ứng đầy đủ các tiêu chí về thiết kế cũng như chất lượng sản phẩm mang tới khách hàng có những trải nghiệm tuyệt vời nhất.', 90, 18000000, 0, '2022-12-07 02:39:07', '2022-12-07 02:39:07', 1, 'Olym', 'olym-pianus-op990-143agr-gl-xl-1.png', 'olym-pianus-op990-143agr-gl-xl-2.png', 'olym-pianus-op990-143agr-gl-xl-3.png', 'olym-pianus-op990-143agr-gl-xl-4.png', 'olym-pianus-op990-143agr-gl-xl-5.png', 'olym-pianus-op990-143agr-gl-xl-6.png'),
('sp2027052023', 'OLYM PIANUS OP9941-84AGK-GL-V', 'Đồng hồ Olym Pianus OP99411-84AGK-GL-T là một thương hiệu đồng hồ Nhật Bản nổi tiếng bền bỉ với chất lượng vượt trội. Đồng hồ Olym Pianus OP99411-84AGK-GL-T là mẫu đồng hồ cơ mới nhất 2019 với độ hoàn thiện hoàn hảo, một trong những thương hiệu đồng hồ hiếm hoi có giá thành vừa phải mà vẫn đáp ứng đầy đủ các tiêu chí về thiết kế cũng như chất lượng sản phẩm mang tới khách hàng có những trải nghiệm tuyệt vời nhất.', 534, 8860000, 5, '2022-12-07 02:39:07', '2022-12-07 02:39:07', 1, 'Olym', 'olym-pianus-op9941-84agk-gl-v-1.png', 'olym-pianus-op9941-84agk-gl-v-2.png', 'olym-pianus-op9941-84agk-gl-v-3.png', 'olym-pianus-op9941-84agk-gl-v-4.png', 'olym-pianus-op9941-84agk-gl-v-5.png', 'olym-pianus-op9941-84agk-gl-v-6.png'),
('sp2127052023', 'OLYM PIANUS OP9908-88AGSK-XL', 'Mẫu đồng hồ Automatic khẳng định giá trị của mình ở ngay thiết kế lộ máy, được biết đến như “trái tym” của OP9908-88AGSK-GL-T. Đối với anh em thích khám phá chắc hẳn rất thích nhìn chuyển động của bộ máy dưới lớp kính.Tuyệt vời hơn khi nhà sản xuất chế tác thang đo dự trữ với chiếc kim xăng hiển thị thời gian trữ cót đặt ngay giờ thứ 12. Niềm khao khát của nhiều quý ông khi hầu như thiết kế này chỉ thấy ở phân khúc đắt tiền. Ở vị trí 6h lộ diện chiếc đồng hồ 60 giây và chiếc kim nhỏ. Một tính năng được hoàn thiện thêm nhưng càng giúp OP9908-88AGSK-GL-T đánh bóng thêm đẳng cấp của mình.', 154, 14560000, 50, '2022-12-07 02:41:33', '2022-12-07 02:41:33', 1, 'Olym', 'olym-pianus-op9908-88agsk-xl-1.png', 'olym-pianus-op9908-88agsk-xl-2.png', 'olym-pianus-op9908-88agsk-xl-3.png', 'olym-pianus-op9908-88agsk-xl-4.png', 'olym-pianus-op9908-88agsk-xl-5.png', 'olym-pianus-op9908-88agsk-xl-6.png'),
('sp2227052023', 'OLYM PIANUS OP990-15AMSK-T', 'Đồng hồ Olym Pianuss Skeleton OP990-15AMSK-T chính hãng, chất liệu thép không gỉ mạ đờmi, thiết kế thời trang cao cấp, thấy máy hoạt động cùng kính chống trầy, máy auotmmatic.', 425, 7440000, 25, '2022-12-07 02:41:33', '2022-12-07 02:41:33', 1, 'Olym', 'olym-pianus-op990-15amsk-t-1.png', 'olym-pianus-op990-15amsk-t-2.png', 'olym-pianus-op990-15amsk-t-3.png', 'olym-pianus-op990-15amsk-t-4.png', 'olym-pianus-op990-15amsk-t-5.png', 'olym-pianus-op990-15amsk-t-6.png'),
('sp227052023', 'DOUGLAS MOONFLIGHT', 'Vào những năm 1930, các nhà thiết kế thời trang cao cấp đã mang đến sự quyến rũ cho đường băng và lên chiếc Douglas DC-3, chiếc máy bay đã thiết kế lại hành trình bằng cách mang đến sự sang trọng cho mỗi chuyến bay. Kết hợp các tính năng Art Deco cổ điển được đặt theo các giai đoạn của mặt trăng, AVIATOR MoonFlight cho phép bạn hạ cánh giữa các ngôi sao và tín đồ thời trang với phong cách cao cấp nhằm tôn vinh chiếc máy bay vĩ đại nhất của thời đại đó.', 90, 18000000, 1, '2022-12-06 11:08:57', '2023-05-17 09:09:14', 2, 'Avia', 'douglas-moonflight-1.png', 'douglas-moonflight-2.png', 'douglas-moonflight-3.png', 'douglas-moonflight-4.png', 'douglas-moonflight-5.png', 'douglas-moonflight-6.png'),
('sp2327052023', 'OLYM PIANUS OP99411-84AGSK-V', 'Đồng hồ Olym Pianus OP99411-84AGSK-V là một thương hiệu đồng hồ Nhật Bản nổi tiếng bền bỉ với chất lượng vượt trội. Đồng hồ Olym Pianus OP99411-84AGSK-X là mẫu đồng hồ cơ mới nhất 2019 với độ hoàn thiện hoàn hảo, một trong những thương hiệu đồng hồ hiếm hoi có giá thành vừa phải mà vẫn đáp ứng đầy đủ các tiêu chí về thiết kế cũng như chất lượng sản phẩm mang tới khách hàng có những trải nghiệm tuyệt vời nhất.', 685, 59600000, 25, '2022-12-07 02:43:34', '2022-12-07 02:43:34', 1, 'Olym', 'olym-pianus-op99411-84agsk-v-1.png', 'olym-pianus-op99411-84agsk-v-2.png', 'olym-pianus-op99411-84agsk-v-3.png', 'olym-pianus-op99411-84agsk-v-4.png', 'olym-pianus-op99411-84agsk-v-5.png', 'olym-pianus-op99411-84agsk-v-6.png'),
('sp2427052023', 'OLYM PIANUS OP99411-84AGS-X', 'Đồng hồ Olym Pianus OP99411-84AGS-X là một thương hiệu đồng hồ Nhật Bản nổi tiếng bền bỉ với chất lượng vượt trội. Đồng hồ Olym Pianus OP99411-84AGS-X là mẫu đồng hồ cơ mới nhất 2019 với độ hoàn thiện hoàn hảo, một trong những thương hiệu đồng hồ hiếm hoi có giá thành vừa phải mà vẫn đáp ứng đầy đủ các tiêu chí về thiết kế cũng như chất lượng sản phẩm mang tới khách hàng có những trải nghiệm tuyệt vời nhất.', 400, 9960000, 10, '2022-12-07 02:43:34', '2022-12-07 02:43:34', 1, 'Olym', 'olym-pianus-op99411-84ags-x-1.png', 'olym-pianus-op99411-84ags-x-2.png', 'olym-pianus-op99411-84ags-x-3.png', 'olym-pianus-op99411-84ags-x-4.png', 'olym-pianus-op99411-84ags-x-5.png', 'olym-pianus-op99411-84ags-x-6.png'),
('sp2527052023', 'OLYM PIANUS OP99411-84AGS-D', 'Đồng hồ Olym Pianus OP99411-84AGS-D là một thương hiệu đồng hồ Nhật Bản nổi tiếng bền bỉ với chất lượng vượt trội. Đồng hồ Olym Pianus OP99411-84AGS-X là mẫu đồng hồ cơ mới nhất 2019 với độ hoàn thiện hoàn hảo, một trong những thương hiệu đồng hồ hiếm hoi có giá thành vừa phải mà vẫn đáp ứng đầy đủ các tiêu chí về thiết kế cũng như chất lượng sản phẩm mang tới khách hàng có những trải nghiệm tuyệt vời nhất.', 751, 99900000, 10, '2022-12-07 02:46:05', '2022-12-07 02:46:05', 1, 'Olym', 'olym-pianus-op99411-84ags-d-1.png', 'olym-pianus-op99411-84ags-d-2.png', 'olym-pianus-op99411-84ags-d-3.png', 'olym-pianus-op99411-84ags-d-4.png', 'olym-pianus-op99411-84ags-d-5.png', 'olym-pianus-op99411-84ags-d-6.png'),
('sp2627052023', 'OLYM PIANUS LA BÀN OP9943AGS-GL-D-KD', 'Đồng hồ Olym Pianus La Bàn OP9943AGS-GL-D-KD là một thương hiệu đồng hồ Nhật Bản nổi tiếng bền bỉ với chất lượng vượt trội. Đồng hồ Olym Pianus OP99411-84AGS-X là mẫu đồng hồ cơ mới nhất 2019 với độ hoàn thiện hoàn hảo, một trong những thương hiệu đồng hồ hiếm hoi có giá thành vừa phải mà vẫn đáp ứng đầy đủ các tiêu chí về thiết kế cũng như chất lượng sản phẩm mang tới khách hàng có những trải nghiệm tuyệt vời nhất.', 642, 5560000, 6, '2022-12-07 02:46:05', '2022-12-07 02:46:05', 1, 'Olym', 'olym-pianus-la-ban-op9943ags-gl-d-kd-1.png', 'olym-pianus-la-ban-op9943ags-gl-d-kd-2.png', 'olym-pianus-la-ban-op9943ags-gl-d-kd-3.png', 'olym-pianus-la-ban-op9943ags-gl-d-kd-4.png', 'olym-pianus-la-ban-op9943ags-gl-d-kd-5.png', 'olym-pianus-la-ban-op9943ags-gl-d-kd-6.png'),
('sp2727052023', 'Olym Pianus Fusion OP990-45ADDGR-X', 'Olym Pianus Fusion OP990-45ADDGR-X. Sở hữu Case size 42mm, bezel size 40mm cực vừa vặn, tay nhỏ cũng đeo được. Có 2 phiên bản dây thép (SS) và dây cao su rất phù hợp cho mùa hè nóng bức và hay dùng nước, độ bền cực cao. Kính sapphire nguyên khối + bezel đính đá cực chắc chắn và sáng giúp tổng thể thiết kế trở lên Sang trọng - Đẳng cấp. Bộ máy Automatic quen thuộc của nhà OP - độ trữ cót 40H, chạy chính xác + bền bỉ.', 351, 75600000, 31, '2022-12-07 02:47:23', '2022-12-07 02:47:23', 1, 'Olym', 'olym-pianus-fusion-op990-45addgr-x-1.png', 'olym-pianus-fusion-op990-45addgr-x-2.png', 'olym-pianus-fusion-op990-45addgr-x-3.png', 'olym-pianus-fusion-op990-45addgr-x-4.png', 'olym-pianus-fusion-op990-45addgr-x-5.png', 'olym-pianus-fusion-op990-45addgr-x-6.png'),
('sp2827052023', 'OLYM PIANUS OP99411-84AGK-GL-XL', 'Đồng hồ Olym Pianus OP99411-84AGK-GL-XL là một thương hiệu đồng hồ Nhật Bản nổi tiếng bền bỉ với chất lượng vượt trội. Đồng hồ Olym Pianus OP99411-84AGK-GL-T là mẫu đồng hồ cơ mới nhất 2019 với độ hoàn thiện hoàn hảo, một trong những thương hiệu đồng hồ hiếm hoi có giá thành vừa phải mà vẫn đáp ứng đầy đủ các tiêu chí về thiết kế cũng như chất lượng sản phẩm mang tới khách hàng có những trải nghiệm tuyệt vời nhất.', 1656, 8500000, 10, '2022-12-07 02:47:23', '2022-12-07 02:47:23', 1, 'Olym', 'olym-pianus-op99411-84agk-gl-xl-1.png', 'olym-pianus-op99411-84agk-gl-xl-2.png', 'olym-pianus-op99411-84agk-gl-xl-3.png', 'olym-pianus-op99411-84agk-gl-xl-4.png', 'olym-pianus-op99411-84agk-gl-xl-5.png', 'olym-pianus-op99411-84agk-gl-xl-6.png'),
('sp2927052023', 'OLYM PIANUS OP990-45ADGS-GL-T', 'Olym Pianus OP990-45ADGS-GL-T  là một thương hiệu đồng hồ Nhật Bản nổi tiếng bền bỉ với chất lượng vượt trội, mang một diện mạo phong thái phóng khoáng và vô cùng sang trọng giúp nó nổi bật ở bất cứ nơi đâu, đây là một trong những sản phẩm nổi bật của thương hiệu Olym Pianus, có giá thành vừa phải mà vẫn đáp ứng đầy đủ các tiêu chí về thiết kế cũng như chất lượng sản phẩm mang tới khách hàng có những trải nghiệm tuyệt vời nhất.', 872, 88810000, 10, '2022-12-07 02:48:59', '2022-12-07 02:48:59', 1, 'Olym', 'olym-pianus-op990-45adgs-gl-t-1.png', 'olym-pianus-op990-45adgs-gl-t-2.png', 'olym-pianus-op990-45adgs-gl-t-3.png', 'olym-pianus-op990-45adgs-gl-t-4.png', 'olym-pianus-op990-45adgs-gl-t-5.png', 'olym-pianus-op990-45adgs-gl-t-6.png'),
('sp3027052023', 'OLYM PIANUS OP990-45ADGR-GL-D', 'Đồng hồ Olym Pianus OP990-45ADGR-GL-D là một thương hiệu đồng hồ Nhật Bản nổi tiếng bền bỉ với chất lượng vượt trội. Đồng hồ Olym Pianus OP99411-84AGS-X là mẫu đồng hồ cơ mới nhất 2019 với độ hoàn thiện hoàn hảo, một trong những thương hiệu đồng hồ hiếm hoi có giá thành vừa phải mà vẫn đáp ứng đầy đủ các tiêu chí về thiết kế cũng như chất lượng sản phẩm mang tới khách hàng có những trải nghiệm tuyệt vời nhất.', 666, 4400000, 5, '2022-12-07 02:48:59', '2022-12-07 02:48:59', 1, 'Olym', 'olym-pianus-op990-45adgr-gl-d-1.png', 'olym-pianus-op990-45adgr-gl-d-2.png', 'olym-pianus-op990-45adgr-gl-d-3.png', 'olym-pianus-op990-45adgr-gl-d-4.png', 'olym-pianus-op990-45adgr-gl-d-5.png', 'olym-pianus-op990-45adgr-gl-d-6.png'),
('sp3127052023', 'OLYM PIANUS 9946.1AGS', 'Đồng hồ Olym Pianus 9946.1AGS là một thương hiệu đồng hồ Nhật Bản nổi tiếng bền bỉ với chất lượng vượt trội. Đồng hồ Olym Pianus OP99411-84AGS-X là mẫu đồng hồ cơ mới nhất 2019 với độ hoàn thiện hoàn hảo, một trong những thương hiệu đồng hồ hiếm hoi có giá thành vừa phải mà vẫn đáp ứng đầy đủ các tiêu chí về thiết kế cũng như chất lượng sản phẩm mang tới khách hàng có những trải nghiệm tuyệt vời nhất.', 598, 15260000, 15, '2022-12-07 02:50:34', '2022-12-07 02:50:34', 1, 'Olym', 'olym-pianus-9946-1ags-1.png', 'olym-pianus-9946-1ags-2.png', 'olym-pianus-9946-1ags-3.png', 'olym-pianus-9946-1ags-4.png', 'olym-pianus-9946-1ags-5.png', 'olym-pianus-9946-1ags-6.png'),
('sp3227052023', 'OLYM PIANUS 899833G1B', 'Đồng hồ Olym Pianus 899833G1B là một thương hiệu đồng hồ Nhật Bản nổi tiếng bền bỉ với chất lượng vượt trội. Đồng hồ Olym Pianus OP99411-84AGS-X là mẫu đồng hồ cơ mới nhất 2019 với độ hoàn thiện hoàn hảo, một trong những thương hiệu đồng hồ hiếm hoi có giá thành vừa phải mà vẫn đáp ứng đầy đủ các tiêu chí về thiết kế cũng như chất lượng sản phẩm mang tới khách hàng có những trải nghiệm tuyệt vời nhất.', 637, 10260000, 37, '2022-12-07 02:50:34', '2022-12-07 02:50:34', 1, 'Olym', 'olym-pianus-899833g1b-1.png', 'olym-pianus-899833g1b-2.png', 'olym-pianus-899833g1b-3.png', 'olym-pianus-899833g1b-4.png', 'olym-pianus-899833g1b-5.png', 'olym-pianus-899833g1b-6.png'),
('sp327052023', 'AIRACOBRA P45 CHRONO 1', 'Tận dụng chiến lược tầm nhìn chim của mình trong suốt Thế chiến II, Airacobra là một máy bay chiến đấu ổn định mà Đồng minh có thể dựa vào để hỗ trợ quân đội trên mặt đất. Bằng cách kết hợp tinh thần đáng tin cậy của nó đã chứng tỏ là công cụ trong mọi nhiệm vụ, đồng hồ AVIATOR Airacobra P45 Chrono mang đến một vẻ ngoài giống như một công cụ xứng đáng được đề cập đến.', 983, 10000000, 10, '2022-12-06 11:08:57', '2022-12-06 11:08:57', 1, 'Avia', 'airacobra-p45-chrono-1-1.png', 'airacobra-p45-chrono-1-2.png', 'airacobra-p45-chrono-1-3.png', 'airacobra-p45-chrono-1-4.png', 'airacobra-p45-chrono-1-5.png', 'airacobra-p45-chrono-1-6.png'),
('sp3327052023', 'OLYM PIANUS OP2467LK-T', 'Thiết kế nhẹ nhàng nhưng đầy nét quý phái. Chắc chắn là điểm thu hút trên cổ tay của người phụ nữ sở hữu chiếc đồng hồ này.Tựa như một thứ trang sức lộng lẫy trên cổ tay người đẹp, OP2467LK-T là sự hòa điệu của sắc vàng quý phái, 4 viên đá quý lấp lánh trên mặt số cùng kiểu thiết kế lắc tay điệu đàng, độc lạ. Từng nấc từng nấc để lộ làn da quyến rũ của chị em trong những khoảng hổng đầy ngụ ý.', 100, 59560000, 10, '2022-12-07 02:52:57', '2022-12-07 02:52:57', 2, 'Olym', 'olym-pianus-op2467lk-t-1.png', 'olym-pianus-op2467lk-t-2.png', 'olym-pianus-op2467lk-t-3.png', 'olym-pianus-op2467lk-t-4.png', 'olym-pianus-op2467lk-t-5.png', 'olym-pianus-op2467lk-t-6.png'),
('sp3427052023', 'OLYM PIANUS OP130-06LS-GL-T', 'Thiết kế nhẹ nhàng nhưng đầy nét quý phái. Chắc chắn là điểm thu hút trên cổ tay của người phụ nữ sở hữu chiếc đồng hồ này.Tựa như một thứ trang sức lộng lẫy trên cổ tay người đẹp, OP130-06LS-GL-T là sự hòa điệu của sắc vàng quý phái, 4 viên đá quý lấp lánh trên mặt số cùng kiểu thiết kế lắc tay điệu đàng, độc lạ. Từng nấc từng nấc để lộ làn da quyến rũ của chị em trong những khoảng hổng đầy ngụ ý.', 599, 1260000, 35, '2022-12-07 02:52:57', '2022-12-07 02:52:57', 2, 'Olym', 'olym-pianus-op130-06ls-gl-t-1.png', 'olym-pianus-op130-06ls-gl-t-2.png', 'olym-pianus-op130-06ls-gl-t-3.png', 'olym-pianus-op130-06ls-gl-t-4.png', 'olym-pianus-op130-06ls-gl-t-5.png', 'olym-pianus-op130-06ls-gl-t-6.png'),
('sp3527052023', 'G-SHOCK GM-S5600GB-1', 'Chiếc đồng hồ G-SHOCK màu vàng kim trên nền đen phủ kim loại sở hữu thiết kế nhỏ và gọn hơn. Đường gờ kim loại phủ lớp ion màu vàng kim làm tôn lên vẻ ngoài trang nhã, sang trọng. Nút bấm và chốt cũng được phủ ion màu vàng kim tương phản với phần nền đen tạo nên lớp kim loại thực sự tỏa sáng. Sự kết hợp giữa màu vàng kim sang trọng và màu đen mạnh mẽ làm tôn lên vẻ đẹp lung linh độc đáo của riêng bạn.', 442, 19990000, 46, '2022-12-07 02:54:23', '2022-12-07 02:54:23', 1, 'GShock', 'g-shock-gm-s5600gb-1-1.png', 'g-shock-gm-s5600gb-1-2.png', 'g-shock-gm-s5600gb-1-3.png', 'g-shock-gm-s5600gb-1-4.png', 'g-shock-gm-s5600gb-1-5.png', 'g-shock-gm-s5600gb-1-6.png'),
('sp3627052023', 'G-SHOCK GMA-S2100SK-2A', 'Hãy đeo lên tay chiếc đồng hồ GA-2100 kết hợp kim-số, phủ kim loại trong suốt, vốn được ưa chuộng nay càng trở nên thu hút với thiết kế thanh mảnh và nhỏ gọn hơn. Chiếc đồng hồ sở hữu thiết kế kim loại trong suốt với nhiều màu cho bạn lựa chọn là phụ kiện linh hoạt, phù hợp với mọi loại trang phục trong suốt cả năm. Các vạch chỉ giờ được xử lý bằng phương pháp lắng đọng hơi bán mờ tạo nên vẻ ngoài bằng kim loại trong suốt sống động như thật.', 740, 18500000, 0, '2022-12-07 02:54:23', '2022-12-07 02:54:23', 1, 'GShock', 'g-shock-gma-s2100sk-2a-1.png', 'g-shock-gma-s2100sk-2a-2.png', 'g-shock-gma-s2100sk-2a-3.png', 'g-shock-gma-s2100sk-2a-4.png', 'g-shock-gma-s2100sk-2a-5.png', 'g-shock-gma-s2100sk-2a-6.png'),
('sp3727052023', 'G-SHOCK GMA-S120SR-7A', 'Xin trân trọng giới thiệu mẫu G-SHOCK . Xuất hiện từ những năm 1990, phong cách trong suốt từng rất phổ biến và trở thành một phần không thể thiếu trong lịch sử của G-SHOCK .\r\nPhần mặt được dát lớp vỏ kim loại màu vàng hồng kết hợp cùng thiết kế chắc chắn đã tạo nên một mẫu đồng hồ đeo tay phù hợp với mọi hoàn cảnh, từ thời trang hiện đại cho đến thời trang đường phố và thường nhật.', 997, 18000000, 11, '2022-12-07 02:56:07', '2022-12-07 02:56:07', 2, 'GShock', 'g-shock-gma-s120sr-7a-1.png', 'g-shock-gma-s120sr-7a-2.png', 'g-shock-gma-s120sr-7a-3.png', 'g-shock-gma-s120sr-7a-4.png', 'g-shock-gma-s120sr-7a-5.png', 'g-shock-gma-s120sr-7a-6.png'),
('sp3827052023', 'G-SHOCK GMA-S110CW-7A2', 'Xin trân trọng giới thiệu mẫu G-SHOCK . Xuất hiện từ những năm 1990, phong cách trong suốt từng rất phổ biến và trở thành một phần không thể thiếu trong lịch sử của G-SHOCK .\r\nPhần mặt được dát lớp vỏ kim loại màu vàng hồng kết hợp cùng thiết kế chắc chắn đã tạo nên một mẫu đồng hồ đeo tay phù hợp với mọi hoàn cảnh, từ thời trang hiện đại cho đến thời trang đường phố và thường nhật.', 360, 7500000, 5, '2022-12-07 02:56:07', '2022-12-07 02:56:07', 2, 'GShock', 'g-shock-gma-s110cw-7a2-1.png', 'g-shock-gma-s110cw-7a2-2.png', 'g-shock-gma-s110cw-7a2-3.png', 'g-shock-gma-s110cw-7a2-4.png', 'g-shock-gma-s110cw-7a2-5.png', 'g-shock-gma-s110cw-7a2-6.png'),
('sp3927052023', 'nguyen quoc chau', 'gst-b100d-1a9dr-01', 77, 100000, 10, '2023-05-25 00:35:12', '2023-05-25 02:02:37', 1, 'Baby', 'nguyen-quoc-chau-12350025052023-1.png', 'nguyen-quoc-chau-12350025052023-2.png', 'nguyen-quoc-chau-12350025052023-3.png', 'nguyen-quoc-chau-12350025052023-4.png', 'nguyen-quoc-chau-12350025052023-5.png', 'nguyen-quoc-chau-12350025052023-6.png'),
('sp427052023', 'AIRACOBRA P45 CHRONO', 'Tận dụng chiến lược tầm nhìn chim của mình trong suốt Thế chiến II, Airacobra là một máy bay chiến đấu ổn định mà Đồng minh có thể dựa vào để hỗ trợ quân đội trên mặt đất. Bằng cách kết hợp tinh thần đáng tin cậy của nó đã chứng tỏ là công cụ trong mọi nhiệm vụ, đồng hồ AVIATOR Airacobra P45 Chrono mang đến một vẻ ngoài giống như một công cụ xứng đáng được đề cập đến.', 86, 11000000, 20, '2022-12-06 11:13:51', '2022-12-06 11:13:51', 2, 'Avia', 'airacobra-p45-chrono-1.png', 'airacobra-p45-chrono-2.png', 'airacobra-p45-chrono-3.png', 'airacobra-p45-chrono-4.png', 'airacobra-p45-chrono-5.png', 'airacobra-p45-chrono-6.png'),
('sp527052023', 'BABY G BGA-310-7A2', 'Thỏa sức ngao du ngoài trời với mẫu đồng hồ BGA-310 sành điệu và mạnh mẽ. Ngoài ra bạn cũng có thể chọn màu be sáng nếu yêu thích phong cách ngoài trời. Mặt đồng hồ tròn và rộng kết hợp dây đeo lớn và vạch chỉ giờ nổi làm tôn lên vẻ ngoài nghịch ngợm và giúp bạn dễ đọc. Dây đeo màu sáng giúp hiển thị giờ rõ ràng ngay cả trong bóng tối để bạn xem nhanh hơn. Chiếc đồng hồ có phần vấu nối dây đeo vừa vặn phù hợp với mọi chuyển động. Chiếc đồng hồ này còn cung cấp nhiều chức năng thực tiễn như cấu trúc chống va đập và khả năng chống nước ở độ sâu lên đến 100 mét. Nút bấm phía trước giúp bạn dễ mở đèn LED đôi chiếu sáng mặt đồng hồ và mở màn mình LCD khi đi cắm trại hoặc phiêu lưu.', 527, 8500000, 5, '2022-12-06 11:13:51', '2022-12-06 11:13:51', 1, 'Baby', 'baby-g-bga-310-7a2-1.png', 'baby-g-bga-310-7a2-2.png', 'baby-g-bga-310-7a2-3.png', 'baby-g-bga-310-7a2-4.png', 'baby-g-bga-310-7a2-5.png', 'baby-g-bga-310-7a2-6.png'),
('sp627052023', 'BABY G BA-110XSM-2A', 'Từ BABY-G, dòng đồng hồ đơn giản dành cho giới nữ năng động, đã phát triển mẫu đồng hồ mới được hợp tác sản xuất cùng với thương hiệu Thủy thủ Mặt Trăng. Thương hiệu anime Thủy thủ Mặt Trăng và BABY-G nổi tiếng từ những năm 1990 và đã trở thành đối tác hoàn hảo của nhau. Chủ đề của mẫu đồng hồ mới này khả năng biến hình mang phong cách lãng mạn của Thủy thủ Mặt Trăng. Dựa trên mẫu đồng hồ BABY-G BA-110 nổi tiếng, chiếc đồng hồ mới này kết hợp nhiều yếu tố nguyên bản lung linh lấy cảm hứng từ phiên bản biến hình của Thủy thủ Mặt Trăng. Phần thân bán trong suốt màu xanh hải quân gợi lên hình ảnh bầu trời đêm, được trang trí bằng các ngôi sao, mặt trăng, trái tim và các hình ảnh Thủy thủ Mặt Trăng màu xanh lam, đỏ và vàng, tạo nên diện mạo vô cùng quyến rũ. Mặt đồng hồ được trang trí bằng những hình ảnh lấp lánh kết hợp dây đeo màu vàng hồng. Thiết kế đặc biệt này gợi lên hình ảnh Thủy thủ Mặt Trăng biến hình vô cùng cuốn hút và khó quên. Vòng dây đeo in hình Thủy thủ Mặt Trăng cũng được khắc trên nắp sau của đồng hồ. Thiết kế bao bì của mẫu đồng hồ này được lấy cảm hứng từ Thủy thủ Mặt Trăng. Mọi chi tiết liên quan đến mẫu đồng hồ này đều được thiết kế nhằm tôn vinh sự hợp tác đặc biệt giữa BABY-G và Thủy thủ Mặt Trăng, nữ anh hùng trong mơ của mọi cô gái.', 749, 5990000, 0, '2022-12-06 11:17:21', '2022-12-06 11:17:21', 1, 'Baby', 'baby-g-ba-110xsm-2a-1.png', 'baby-g-ba-110xsm-2a-2.png', 'baby-g-ba-110xsm-2a-3.png', 'baby-g-ba-110xsm-2a-4.png', 'baby-g-ba-110xsm-2a-5.png', 'baby-g-ba-110xsm-2a-6.png'),
('sp727052023', 'BABY G BA-130PM-4A', 'Đồng hồ BABY-G pastel nhiều màu kết hợp kim loại vừa dễ thương vừa đơn giản, phù hợp với nhịp sống năng động của bạn. Mẫu đồng hồ với các dải và khối màu tông pastel mang phong cách pop nữ tính, kết hợp với những sắc màu dịu nhẹ tạo nên phong cách thiết kế đẹp mắt. Kim đồng hồ, vạch chỉ giờ và các thành phần mặt số khác đều được phủ lớp kim loại sáng bóng, tinh tế, kết hợp với vỏ và dây đeo mờ tạo nên phong cách độc đáo. Chiếc đồng hồ này không chỉ đẹp mắt mà còn cung cấp nhiều chức năng hữu ích hàng ngày như cấu trúc chống va đập và khả năng chống nước ở độ sâu lên đến 100 mét. Thể hiện phong cách huyền bí cùng sự tương phản ấn tượng bên trong mẫu đồng hồ kim loại mạnh mẽ với màu pastel dịu nhẹ.', 508, 4560000, 6, '2022-12-06 11:17:21', '2022-12-06 11:17:21', 2, 'Baby', 'baby-g-ba-130pm-4a-1.png', 'baby-g-ba-130pm-4a-2.png', 'baby-g-ba-130pm-4a-3.png', 'baby-g-ba-130pm-4a-4.png', 'baby-g-ba-130pm-4a-5.png', 'baby-g-ba-130pm-4a-6.png'),
('sp827052023', 'BABY G BGA-310-4A', 'Thỏa sức ngao du ngoài trời với mẫu đồng hồ BGA-310 sành điệu và mạnh mẽ. Ngoài ra bạn cũng có thể chọn màu be sáng nếu yêu thích phong cách ngoài trời. Mặt đồng hồ tròn và rộng kết hợp dây đeo lớn và vạch chỉ giờ nổi làm tôn lên vẻ ngoài nghịch ngợm và giúp bạn dễ đọc. Dây đeo màu sáng giúp hiển thị giờ rõ ràng ngay cả trong bóng tối để bạn xem nhanh hơn. Chiếc đồng hồ có phần vấu nối dây đeo vừa vặn phù hợp với mọi chuyển động. Chiếc đồng hồ này còn cung cấp nhiều chức năng thực tiễn như cấu trúc chống va đập và khả năng chống nước ở độ sâu lên đến 100 mét. Nút bấm phía trước giúp bạn dễ mở đèn LED đôi chiếu sáng mặt đồng hồ và mở màn mình LCD khi đi cắm trại hoặc phiêu lưu. Bạn đang không rảnh tay? Chỉ cần nghiêng cổ tay và bật chức năng phát sáng tự động để xem giờ ngay cả trong bóng tối. Đồng hồ BABY-G giúp bạn luôn có phong cách riêng dù là khi ở nhà giữa đô thị nhộn nhịp hay đang trên đường leo núi, sẵn sàng đối mặt với mọi chuyện xảy ra trong đời sống năng động của mình.', 649, 9560000, 15, '2022-12-06 11:20:21', '2022-12-06 11:20:21', 2, 'Baby', 'baby-g-bga-310-4a-1.png', 'baby-g-bga-310-4a-2.png', 'baby-g-bga-310-4a-3.png', 'baby-g-bga-310-4a-4.png', 'baby-g-bga-310-4a-5.png', 'baby-g-bga-310-4a-6.png'),
('sp927052023', 'BENTLEY BL1831-25MKNN', 'Đồng hồ Bentley là thương hiệu được thành lập vào năm 1948 tại La Chaux-de-Fonds, Thụy Sĩ. Thị trấn được biết đến như cái nôi của đồng hồ hiện đại. Tuy là thương hiệu của Thụy Sĩ nhưng lại được thiết kế gia công tại Đức – một quốc gia với nền công nghiệp chủ đạo về cơ khí, điện tử, sản xuất ôtô. Vào đầu thập niên 90, Bentley đã phát triển thành Tập đoàn Bentley Luxury Group và mở rộng danh mục sản phẩm của mình bao gồm các phụ kiện thời trang, đồ da cao cấp với phương châm “BE IN CONTROL”.', 1015, 9960000, 10, '2022-12-06 11:20:21', '2022-12-06 11:20:21', 1, 'Bentley', 'bentley-bl1831-25mknn-1.png', 'bentley-bl1831-25mknn-2.png', 'bentley-bl1831-25mknn-3.png', 'bentley-bl1831-25mknn-4.png', 'bentley-bl1831-25mknn-5.png', 'bentley-bl1831-25mknn-6.png');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` tinyint(1) NOT NULL,
  `type` tinyint(2) NOT NULL COMMENT '0 is customer and 1,2 is employee'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `type`) VALUES
(0, 0),
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(15) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone_number` varchar(11) NOT NULL,
  `address` text DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `role` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone_number`, `address`, `email`, `password`, `token`, `created_at`, `updated_at`, `role`) VALUES
('kh1026052023', 'Nguyen Quoc Chau', '0926383006', '20 Nha Trang Khanh Hoa, Xã Lũng Táo, Huyện Đồng Văn, Tỉnh Hà Giang', 'chauquocnguyen.cun1@gmail.com', '$2y$10$/nMeQirGpmQwSI.XG24aCeVEbpF3BLpMfQ0.JEshDf/ROn.cSOYou', 'Oye7lzaUnvb9XgxDjxxxC09c8cEcYFXAWc4bcwDiEVlxHekSXFsVv4oo3G0mO0L5bvzwad4y1qZRfh3UIiUY7wf0jCgpnrvj192p', '2023-05-26 19:27:26', '2023-05-26 19:32:58', 0),
('kh105122022', 'Nguyễn Quốc Châu', '0386888889', '12 Nguyễn Tất Thành, Xã Nghĩa Hiệp, Huyện Yên Mỹ, Tỉnh Hưng Yên', 'chau.nq.61cntt@ntu.edu.vn', '$2y$10$/nMeQirGpmQwSI.XG24aCeVEbpF3BLpMfQ0.JEshDf/ROn.cSOYou', NULL, '2022-12-05 18:15:54', '2023-05-19 09:31:46', 0),
('kh1130052023', 'Nguyen Quoc Chauit', '0926383006', 'Địa chỉ 1a, Phường Ngọc Hà, Thành phố Hà Giang, Tỉnh Hà Giang', 'chauquocnguyen.cun@gmail.com', '$2y$10$yUZLAzXNzj91Zh5vAr8DHuFHglNYuoriPtOLJJhhfDcGuKrj6xyYa', '', '2023-05-30 11:14:51', '2023-06-16 22:53:47', 0),
('kh26122022', 'Phan Thị Huyền Trâm', '0926858585', '02 Nguyễn Tất Thành, Xã Phước Đồng, Thành phố Nha Trang, Tỉnh Khánh Hòa', 'phanthihuyentram@gmail.com', '$2y$10$zVkefGONz.3kvfgb1DpwHOT', NULL, '2022-12-26 16:01:25', '2023-05-22 09:27:59', 0),
('kh312122022', 'Lê Thị E', '0926355076', '03 Hưng, Phường Quang Trung, Quận Đống Đa, Thành phố Hà Nội', 'lethie@gmail.com', '$2y$10$huFy/caUfNuL2S52nYiwJu6', NULL, '2022-12-12 17:23:17', '2023-05-24 08:32:04', 0),
('kh412122022', 'Trần Văn D', '0926383006', 'Nguyễn Trung Trực, Thị trấn Kép, Huyện Lạng Giang, Tỉnh Bắc Giang', 'tranvand@gmail.com', '$2y$10$CM9tvkv48v4u0HzfgFLeceE', NULL, '2022-12-12 16:36:59', '2023-05-24 08:30:32', 0),
('kh523052023', 'Nguyễn Trần Hoàn Kim', '0966666666', '20 Phùng Hưng, Phường Cửa Ông, Thành phố Cẩm Phả, Tỉnh Quảng Ninh', 'nguyentranhoankim@gmail.com', '$2y$10$ns0/RvgnHeKBw0jR7rrA3.k', NULL, '2023-06-02 08:21:44', '2023-06-07 08:12:11', 0),
('kh624052023', 'Trần Văn AB', '0826666666', 'Địa chỉ 2, Xã Lý Bôn, Huyện Bảo Lâm, Tỉnh Cao Bằng', 'tranvanab@gmail.com', '$2y$10$A3Rd6DuaT5z52LtU5Mz3CeW', NULL, '2023-05-24 08:29:05', '2023-05-24 16:19:12', 0),
('kh724052023', 'Trần Văn B', '0826666668', 'Địa chỉ 2, Xã Hồng Trị, Huyện Bảo Lạc, Tỉnh Cao Bằng', 'tranvanb@gmail.com', '$2y$10$XBEr.WZumGnh3H3mOZH0T.T', NULL, '2023-05-24 08:29:32', '2023-05-24 08:29:32', 0),
('kh824052023', 'Trần Văn C', '0866666668', 'Địa chỉ 2, Xã Tân Tri, Huyện Bắc Sơn, Tỉnh Lạng Sơn', 'tranvanc@gmail.com', '$2y$10$ns0/RvgnHeKBw0jR7rrA3.k', NULL, '2023-05-24 08:29:48', '2023-05-24 08:29:48', 0),
('kh924052023', 'Nguyễn Yến Nhi', '0386888881', 'Địa chỉ 1c, Thị trấn Pác Miầu, Huyện Bảo Lâm, Tỉnh Cao Bằng', 'nguyenyennhi@gmail.com', '$2y$10$/IyXglucDzCGHbDHRhnbfew', NULL, '2023-05-24 17:54:22', '2023-05-25 01:57:09', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`id`,`email`),
  ADD KEY `role` (`role`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers` (`customers`),
  ADD KEY `product` (`product`),
  ADD KEY `product_2` (`product`),
  ADD KEY `customers_2` (`customers`),
  ADD KEY `product_3` (`product`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer` (`customers`),
  ADD KEY `product` (`product`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers` (`customers`),
  ADD KEY `orders_employee` (`employee`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product` (`product`),
  ADD KEY `orders_details_fk` (`orders`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand` (`brand`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`,`email`),
  ADD KEY `role` (`role`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `administrator`
--
ALTER TABLE `administrator`
  ADD CONSTRAINT `administrator_role` FOREIGN KEY (`role`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_customers` FOREIGN KEY (`customers`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_products` FOREIGN KEY (`product`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_customers` FOREIGN KEY (`customers`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `likes_products` FOREIGN KEY (`product`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_customers` FOREIGN KEY (`customers`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_employee` FOREIGN KEY (`employee`) REFERENCES `administrator` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `orders_details_fk` FOREIGN KEY (`orders`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_details_products` FOREIGN KEY (`product`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand` FOREIGN KEY (`brand`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role` FOREIGN KEY (`role`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
