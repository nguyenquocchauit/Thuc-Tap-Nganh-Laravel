-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2023 at 08:50 PM
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
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `role` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`id`, `name`, `avt`, `address`, `phone_number`, `email`, `password`, `create_at`, `updated_at`, `role`) VALUES
('nv105122022', 'Nguyễn Quốc Châu', 'nguyen-quoc-chau.png', '074 Nguyễn Tất Thành, Xã Phước Đồng, Thành phố Nha Trang, Tỉnh Khánh Hòa', '0386818829', 'chauquocnguyen.cun1@gmail.com', '$2y$10$tSkxt3MiZmU599FKUhud0uN0AF/EWps/PaDqpMmi8z2ryul3vh.gO', '2022-12-05 17:58:39', '2023-05-26 01:58:50', 2),
('nv226052023', 'Nguyễn Khánh Namm', 'nguyen-khanh-nam.png', '25 Nguyễn Trung Trực, Thị trấn Kép, Huyện Lạng Giang, Tỉnh Bắc Giang', '0386888888', 'nguyenkhanhnam@gmail.com', '$2y$10$Vc9cEkOcGOlmm9S10mVbB.C0uVFUsYFZJuDRqdSSD5rRRkGSK3p7y', '2023-05-23 15:21:32', '2023-05-26 16:44:24', 1),
('nv323052023', 'Nguyễn Trần Hoàn Kim', 'nguyen-tran-hoan-kim3.png', '100 Nguyễn Thiện Thuật, Phường Hùng Vương, Thành phố Phúc Yên, Tỉnh Vĩnh Phúc', '0926262626', 'hoankim.nguyentran@gmail.com', '$2y$10$8kb3RBJ5boVYZ2WDyIcvPuLwL2wilp.yqQw2aDpJr05mqUkC2DZr6', '2023-04-05 01:36:13', '2023-05-26 16:31:16', 1),
('nv426052023', 'Lê Thị Mỹ Huyền', 'le-thi-my-huyen4.png', 'Địa chỉ 1c, Phường Quang Trung, Thành phố Hà Giang, Tỉnh Hà Giang', '0926383585', 'lethimyhuyen@gmail.com', '$2y$10$1ubzOIQEJok63jCNWdH1euSKw9qfw5teFk1ys2LszCS6RjtfAhTte', '2023-05-26 19:41:36', '2023-05-26 19:41:36', 1);

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
('cm827052023', 'kh26122022', 'sp827052023', '', 4, '2023-05-27 01:43:25');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` varchar(255) NOT NULL,
  `image_1` text NOT NULL,
  `image_2` text NOT NULL,
  `image_3` text NOT NULL,
  `image_4` text NOT NULL,
  `image_5` text NOT NULL,
  `image_6` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `image_1`, `image_2`, `image_3`, `image_4`, `image_5`, `image_6`) VALUES
('airacobra-p45-chrono', 'airacobra-p45-chrono-1.png', 'airacobra-p45-chrono-2.png', 'airacobra-p45-chrono-3.png', 'airacobra-p45-chrono-4.png', 'airacobra-p45-chrono-5.png', 'airacobra-p45-chrono-6.png'),
('airacobra-p45-chrono-1', 'airacobra-p45-chrono-1-1.png', 'airacobra-p45-chrono-1-2.png', 'airacobra-p45-chrono-1-3.png', 'airacobra-p45-chrono-1-4.png', 'airacobra-p45-chrono-1-5.png', 'airacobra-p45-chrono-1-6.png'),
('baby-g-ba-110xsm-2a', 'baby-g-ba-110xsm-2a-1.png', 'baby-g-ba-110xsm-2a-2.png', 'baby-g-ba-110xsm-2a-3.png', 'baby-g-ba-110xsm-2a-4.png', 'baby-g-ba-110xsm-2a-5.png', 'baby-g-ba-110xsm-2a-6.png'),
('baby-g-ba-130pm-4a', 'baby-g-ba-130pm-4a-1.png', 'baby-g-ba-130pm-4a-2.png', 'baby-g-ba-130pm-4a-3.png', 'baby-g-ba-130pm-4a-4.png', 'baby-g-ba-130pm-4a-5.png', 'baby-g-ba-130pm-4a-6.png'),
('baby-g-bga-310-4a', 'baby-g-bga-310-4a-1.png', 'baby-g-bga-310-4a-2.png', 'baby-g-bga-310-4a-3.png', 'baby-g-bga-310-4a-4.png', 'baby-g-bga-310-4a-5.png', 'baby-g-bga-310-4a-6.png'),
('baby-g-bga-310-7a2', 'baby-g-bga-310-7a2-1.png', 'baby-g-bga-310-7a2-2.png', 'baby-g-bga-310-7a2-3.png', 'baby-g-bga-310-7a2-4.png', 'baby-g-bga-310-7a2-5.png', 'baby-g-bga-310-7a2-6.png'),
('bentley-bl1707-101lwww', 'bentley-bl1707-101lwww-1.png', 'bentley-bl1707-101lwww-2.png', 'bentley-bl1707-101lwww-3.png', 'bentley-bl1707-101lwww-4.png', 'bentley-bl1707-101lwww-5.png', 'bentley-bl1707-101lwww-6.png'),
('bentley-bl1805-20lkwd', 'bentley-bl1805-20lkwd-1.png', 'bentley-bl1805-20lkwd-2.png', 'bentley-bl1805-20lkwd-3.png', 'bentley-bl1805-20lkwd-4.png', 'bentley-bl1805-20lkwd-5.png', 'bentley-bl1805-20lkwd-6.png'),
('bentley-bl1831-25mknn', 'bentley-bl1831-25mknn-1.png', 'bentley-bl1831-25mknn-2.png', 'bentley-bl1831-25mknn-3.png', 'bentley-bl1831-25mknn-4.png', 'bentley-bl1831-25mknn-5.png', 'bentley-bl1831-25mknn-6.png'),
('bentley-bl2080-252mkki', 'bentley-bl2080-252mkki-1.png', 'bentley-bl2080-252mkki-2.png', 'bentley-bl2080-252mkki-3.png', 'bentley-bl2080-252mkki-4.png', 'bentley-bl2080-252mkki-5.png', 'bentley-bl2080-252mkki-6.png'),
('citizen-ag835186e', 'citizen-ag835186e-1.png', 'citizen-ag835186e-2.png', 'citizen-ag835186e-3.png', 'citizen-ag835186e-4.png', 'citizen-ag835186e-5.png', 'citizen-ag835186e-6.png'),
('citizen-eco-drive-bm7480', 'citizen-eco-drive-bm7480-1.png', 'citizen-eco-drive-bm7480-2.png', 'citizen-eco-drive-bm7480-3.png', 'citizen-eco-drive-bm7480-4.png', 'citizen-eco-drive-bm7480-5.png', 'citizen-eco-drive-bm7480-6.png'),
('citizen-em0710-54y', 'citizen-em0710-54y-1.png', 'citizen-em0710-54y-2.png', 'citizen-em0710-54y-3.png', 'citizen-em0710-54y-4.png', 'citizen-em0710-54y-5.png', 'citizen-em0710-54y-6.png'),
('citizen-er0212-50d', 'citizen-er0212-50d-1.png', 'citizen-er0212-50d-2.png', 'citizen-er0212-50d-3.png', 'citizen-er0212-50d-4.png', 'citizen-er0212-50d-5.png', 'citizen-er0212-50d-6.png'),
('douglas-day-date-41', 'douglas-day-date-41-1.png', 'douglas-day-date-41-2.png', 'douglas-day-date-41-3.png', 'douglas-day-date-41-4.png', 'douglas-day-date-41-5.png', 'douglas-day-date-41-6.png'),
('douglas-moonflight', 'douglas-moonflight-1.png', 'douglas-moonflight-2.png', 'douglas-moonflight-3.png', 'douglas-moonflight-4.png', 'douglas-moonflight-5.png', 'douglas-moonflight-6.png'),
('g-shock-gm-s5600gb-1', 'g-shock-gm-s5600gb-1-1.png', 'g-shock-gm-s5600gb-1-2.png', 'g-shock-gm-s5600gb-1-3.png', 'g-shock-gm-s5600gb-1-4.png', 'g-shock-gm-s5600gb-1-5.png', 'g-shock-gm-s5600gb-1-6.png'),
('g-shock-gma-s110cw-7a2', 'g-shock-gma-s110cw-7a2-1.png', 'g-shock-gma-s110cw-7a2-2.png', 'g-shock-gma-s110cw-7a2-3.png', 'g-shock-gma-s110cw-7a2-4.png', 'g-shock-gma-s110cw-7a2-5.png', 'g-shock-gma-s110cw-7a2-6.png'),
('g-shock-gma-s120sr-7a', 'g-shock-gma-s120sr-7a-1.png', 'g-shock-gma-s120sr-7a-2.png', 'g-shock-gma-s120sr-7a-3.png', 'g-shock-gma-s120sr-7a-4.png', 'g-shock-gma-s120sr-7a-5.png', 'g-shock-gma-s120sr-7a-6.png'),
('g-shock-gma-s2100sk-2a', 'g-shock-gma-s2100sk-2a-1.png', 'g-shock-gma-s2100sk-2a-2.png', 'g-shock-gma-s2100sk-2a-3.png', 'g-shock-gma-s2100sk-2a-4.png', 'g-shock-gma-s2100sk-2a-5.png', 'g-shock-gma-s2100sk-2a-6.png'),
('nguyen-quoc-chau-02572224052023', 'nguyen-quoc-chau-02572224052023-1.png', 'nguyen-quoc-chau-02572224052023-2.png', 'nguyen-quoc-chau-02572224052023-3.png', 'nguyen-quoc-chau-02572224052023-4.png', 'nguyen-quoc-chau-02572224052023-5.png', 'nguyen-quoc-chau-02572224052023-6.png'),
('nguyen-quoc-chau-08160025052023', 'nguyen-quoc-chau-08160025052023-1.png', 'nguyen-quoc-chau-08160025052023-2.png', 'nguyen-quoc-chau-08160025052023-3.png', 'nguyen-quoc-chau-08160025052023-4.png', 'nguyen-quoc-chau-08160025052023-5.png', 'nguyen-quoc-chau-08160025052023-6.png'),
('nguyen-quoc-chau-10421724052023', 'nguyen-quoc-chau-10421724052023-1.png', 'nguyen-quoc-chau-10421724052023-2.png', 'nguyen-quoc-chau-10421724052023-3.png', 'nguyen-quoc-chau-10421724052023-4.png', 'nguyen-quoc-chau-10421724052023-5.png', 'nguyen-quoc-chau-10421724052023-6.png'),
('nguyen-quoc-chau-12350025052023', 'nguyen-quoc-chau-12350025052023-1.png', 'nguyen-quoc-chau-12350025052023-2.png', 'nguyen-quoc-chau-12350025052023-3.png', 'nguyen-quoc-chau-12350025052023-4.png', 'nguyen-quoc-chau-12350025052023-5.png', 'nguyen-quoc-chau-12350025052023-6.png'),
('nguyen-quoc-chau-14532324052023', 'nguyen-quoc-chau-14532324052023-1.png', 'nguyen-quoc-chau-14532324052023-2.png', 'nguyen-quoc-chau-14532324052023-3.png', 'nguyen-quoc-chau-14532324052023-4.png', 'nguyen-quoc-chau-14532324052023-5.png', 'nguyen-quoc-chau-14532324052023-6.png'),
('nguyen-quoc-chau-44340025052023', 'nguyen-quoc-chau-44340025052023-1.png', 'nguyen-quoc-chau-44340025052023-2.png', 'nguyen-quoc-chau-44340025052023-3.png', 'nguyen-quoc-chau-44340025052023-4.png', 'nguyen-quoc-chau-44340025052023-5.png', 'nguyen-quoc-chau-44340025052023-6.png'),
('nguyen-quoc-chau-50331724052023', 'nguyen-quoc-chau-50331724052023-1.png', 'nguyen-quoc-chau-50331724052023-2.png', 'nguyen-quoc-chau-50331724052023-3.png', 'nguyen-quoc-chau-50331724052023-4.png', 'nguyen-quoc-chau-50331724052023-5.png', 'nguyen-quoc-chau-50331724052023-6.png'),
('olym-pianus-899833g1b', 'olym-pianus-899833g1b-1.png', 'olym-pianus-899833g1b-2.png', 'olym-pianus-899833g1b-3.png', 'olym-pianus-899833g1b-4.png', 'olym-pianus-899833g1b-5.png', 'olym-pianus-899833g1b-6.png'),
('olym-pianus-9946-1ags', 'olym-pianus-9946-1ags-1.png', 'olym-pianus-9946-1ags-2.png', 'olym-pianus-9946-1ags-3.png', 'olym-pianus-9946-1ags-4.png', 'olym-pianus-9946-1ags-5.png', 'olym-pianus-9946-1ags-6.png'),
('olym-pianus-fusion-op990-45addgr-x', 'olym-pianus-fusion-op990-45addgr-x-1.png', 'olym-pianus-fusion-op990-45addgr-x-2.png', 'olym-pianus-fusion-op990-45addgr-x-3.png', 'olym-pianus-fusion-op990-45addgr-x-4.png', 'olym-pianus-fusion-op990-45addgr-x-5.png', 'olym-pianus-fusion-op990-45addgr-x-6.png'),
('olym-pianus-la-ban-op9943ags-gl-d-kd', 'olym-pianus-la-ban-op9943ags-gl-d-kd-1.png', 'olym-pianus-la-ban-op9943ags-gl-d-kd-2.png', 'olym-pianus-la-ban-op9943ags-gl-d-kd-3.png', 'olym-pianus-la-ban-op9943ags-gl-d-kd-4.png', 'olym-pianus-la-ban-op9943ags-gl-d-kd-5.png', 'olym-pianus-la-ban-op9943ags-gl-d-kd-6.png'),
('olym-pianus-op130-06ls-gl-t', 'olym-pianus-op130-06ls-gl-t-1.png', 'olym-pianus-op130-06ls-gl-t-2.png', 'olym-pianus-op130-06ls-gl-t-3.png', 'olym-pianus-op130-06ls-gl-t-4.png', 'olym-pianus-op130-06ls-gl-t-5.png', 'olym-pianus-op130-06ls-gl-t-6.png'),
('olym-pianus-op2467lk-t', 'olym-pianus-op2467lk-t-1.png', 'olym-pianus-op2467lk-t-2.png', 'olym-pianus-op2467lk-t-3.png', 'olym-pianus-op2467lk-t-4.png', 'olym-pianus-op2467lk-t-5.png', 'olym-pianus-op2467lk-t-6.png'),
('olym-pianus-op990-143agr-gl-xl', 'olym-pianus-op990-143agr-gl-xl-1.png', 'olym-pianus-op990-143agr-gl-xl-2.png', 'olym-pianus-op990-143agr-gl-xl-3.png', 'olym-pianus-op990-143agr-gl-xl-4.png', 'olym-pianus-op990-143agr-gl-xl-5.png', 'olym-pianus-op990-143agr-gl-xl-6.png'),
('olym-pianus-op990-15amsk-t', 'olym-pianus-op990-15amsk-t-1.png', 'olym-pianus-op990-15amsk-t-2.png', 'olym-pianus-op990-15amsk-t-3.png', 'olym-pianus-op990-15amsk-t-4.png', 'olym-pianus-op990-15amsk-t-5.png', 'olym-pianus-op990-15amsk-t-6.png'),
('olym-pianus-op990-45adgr-gl-d', 'olym-pianus-op990-45adgr-gl-d-1.png', 'olym-pianus-op990-45adgr-gl-d-2.png', 'olym-pianus-op990-45adgr-gl-d-3.png', 'olym-pianus-op990-45adgr-gl-d-4.png', 'olym-pianus-op990-45adgr-gl-d-5.png', 'olym-pianus-op990-45adgr-gl-d-6.png'),
('olym-pianus-op990-45adgs-gl-t', 'olym-pianus-op990-45adgs-gl-t-1.png', 'olym-pianus-op990-45adgs-gl-t-2.png', 'olym-pianus-op990-45adgs-gl-t-3.png', 'olym-pianus-op990-45adgs-gl-t-4.png', 'olym-pianus-op990-45adgs-gl-t-5.png', 'olym-pianus-op990-45adgs-gl-t-6.png'),
('olym-pianus-op9908-88agsk-xl', 'olym-pianus-op9908-88agsk-xl-1.png', 'olym-pianus-op9908-88agsk-xl-2.png', 'olym-pianus-op9908-88agsk-xl-3.png', 'olym-pianus-op9908-88agsk-xl-4.png', 'olym-pianus-op9908-88agsk-xl-5.png', 'olym-pianus-op9908-88agsk-xl-6.png'),
('olym-pianus-op99141-71agk-t', 'olym-pianus-op99141-71agk-t-1.png', 'olym-pianus-op99141-71agk-t-2.png', 'olym-pianus-op99141-71agk-t-3.png', 'olym-pianus-op99141-71agk-t-4.png', 'olym-pianus-op99141-71agk-t-5.png', 'olym-pianus-op99141-71agk-t-6.png'),
('olym-pianus-op9941-84agk-gl-v', 'olym-pianus-op9941-84agk-gl-v-1.png', 'olym-pianus-op9941-84agk-gl-v-2.png', 'olym-pianus-op9941-84agk-gl-v-3.png', 'olym-pianus-op9941-84agk-gl-v-4.png', 'olym-pianus-op9941-84agk-gl-v-5.png', 'olym-pianus-op9941-84agk-gl-v-6.png'),
('olym-pianus-op99411-84agk-gl-xl', 'olym-pianus-op99411-84agk-gl-xl-1.png', 'olym-pianus-op99411-84agk-gl-xl-2.png', 'olym-pianus-op99411-84agk-gl-xl-3.png', 'olym-pianus-op99411-84agk-gl-xl-4.png', 'olym-pianus-op99411-84agk-gl-xl-5.png', 'olym-pianus-op99411-84agk-gl-xl-6.png'),
('olym-pianus-op99411-84ags-d', 'olym-pianus-op99411-84ags-d-1.png', 'olym-pianus-op99411-84ags-d-2.png', 'olym-pianus-op99411-84ags-d-3.png', 'olym-pianus-op99411-84ags-d-4.png', 'olym-pianus-op99411-84ags-d-5.png', 'olym-pianus-op99411-84ags-d-6.png'),
('olym-pianus-op99411-84ags-x', 'olym-pianus-op99411-84ags-x-1.png', 'olym-pianus-op99411-84ags-x-2.png', 'olym-pianus-op99411-84ags-x-3.png', 'olym-pianus-op99411-84ags-x-4.png', 'olym-pianus-op99411-84ags-x-5.png', 'olym-pianus-op99411-84ags-x-6.png'),
('olym-pianus-op99411-84agsk-v', 'olym-pianus-op99411-84agsk-v-1.png', 'olym-pianus-op99411-84agsk-v-2.png', 'olym-pianus-op99411-84agsk-v-3.png', 'olym-pianus-op99411-84agsk-v-4.png', 'olym-pianus-op99411-84agsk-v-5.png', 'olym-pianus-op99411-84agsk-v-6.png'),
('olym-pianus-op9946-1agk-t', 'olym-pianus-op9946-1agk-t-1.png', 'olym-pianus-op9946-1agk-t-2.png', 'olym-pianus-op9946-1agk-t-3.png', 'olym-pianus-op9946-1agk-t-4.png', 'olym-pianus-op9946-1agk-t-5.png', 'olym-pianus-op9946-1agk-t-6.png');

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
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `total` decimal(10,0) NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customers`, `employee`, `status`, `created_at`, `updated_at`, `total`, `note`) VALUES
('HD101090027052023', 'kh26122022', 'nv105122022', 'TC', '2023-05-27 01:09:00', '2023-05-27 01:09:00', '8776080', ''),
('HD202030127052023', 'kh26122022', 'nv105122022', 'XN', '2023-05-27 02:03:01', '2023-05-27 02:03:01', '134178768', ''),
('HD314552527052023', 'kh624052023', 'nv105122022', 'DVC', '2023-05-27 14:55:25', '2023-05-28 00:31:10', '24873264', 'nv105122022 status: Đang vận chuyển - 00:31:10 28-05-2023, '),
('HD415034627052023', 'kh523052023', 'nv323052023', 'DVC', '2023-05-27 15:03:46', '2023-05-27 15:03:46', '9354420', ''),
('HD518341727052023', 'kh412122022', 'nv323052023', 'TC', '2023-05-27 18:34:17', '2023-05-27 23:30:27', '64151784', ''),
('HD623331227052023', 'kh724052023', 'nv105122022', 'TC', '2023-04-01 23:33:12', '2023-05-28 00:30:43', '22951512', 'nv105122022 status: Thành công - 00:30:43 28-05-2023, nv105122022 status: Chưa xác nhận - 23:33:12 27-05-2023'),
('HD700420928052023', 'kh105122022', 'nv105122022', 'XN', '2023-05-28 00:42:09', '2023-05-28 00:42:09', '96228000', 'nv105122022 status: Chưa xác nhận - 00:42:09 28-05-2023'),
('HD800540928052023', 'kh105122022', 'nv105122022', 'XN', '2023-05-28 00:54:09', '2023-05-28 00:54:09', '96228000', 'nv105122022 status: Chưa xác nhận - 00:54:09 28-05-2023'),
('HD901003228052023', 'kh105122022', 'nv105122022', 'XN', '2023-05-28 01:00:32', '2023-05-28 01:00:32', '115197984', 'nv105122022 status: Chưa xác nhận - 01:00:32 28-05-2023');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` varchar(100) NOT NULL,
  `orders` varchar(20) NOT NULL,
  `product` varchar(20) NOT NULL,
  `quantity` smallint(20) NOT NULL,
  `price` float NOT NULL,
  `discount` tinyint(3) NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `orders`, `product`, `quantity`, `price`, `discount`, `total`) VALUES
('CTHD101090027052023', 'HD101090027052023', 'sp827052023', 1, 9560000, 15, 8776080),
('CTHD1018341727052023', 'HD518341727052023', 'sp1127052023', 1, 19960000, 12, 18970000),
('CTHD1118341727052023', 'HD518341727052023', 'sp1427052023', 1, 4960000, 45, 2946240),
('CTHD1218341727052023', 'HD518341727052023', 'sp227052023', 1, 18000000, 1, 19245600),
('CTHD1318341727052023', 'HD518341727052023', 'sp2227052023', 1, 7440000, 25, 6026400),
('CTHD1418341727052023', 'HD518341727052023', 'sp2127052023', 1, 14560000, 50, 7862400),
('CTHD1518341727052023', 'HD518341727052023', 'sp2027052023', 1, 8860000, 5, 9090360),
('CTHD1623331227052023', 'HD623331227052023', 'sp3927052023', 1, 100000, 10, 97200),
('CTHD1723331227052023', 'HD623331227052023', 'sp427052023', 1, 11000000, 20, 9504000),
('CTHD1823331227052023', 'HD623331227052023', 'sp527052023', 1, 8500000, 5, 8721000),
('CTHD1923331227052023', 'HD623331227052023', 'sp727052023', 1, 4560000, 6, 4629310),
('CTHD2000420928052023', 'HD700420928052023', 'sp1027052023', 1, 99000000, 10, 96228000),
('CTHD202030127052023', 'HD202030127052023', 'sp1127052023', 2, 19960000, 12, 37940000),
('CTHD2100540928052023', 'HD800540928052023', 'sp1027052023', 1, 99000000, 10, 96228000),
('CTHD2201003228052023', 'HD901003228052023', 'sp1127052023', 1, 19960000, 12, 18970000),
('CTHD2301003228052023', 'HD901003228052023', 'sp1027052023', 1, 99000000, 10, 96228000),
('CTHD302030127052023', 'HD202030127052023', 'sp1027052023', 1, 99000000, 10, 96228000),
('CTHD402030127052023', 'HD202030127052023', 'sp127052023', 1, 999999, 99, 10800),
('CTHD514552527052023', 'HD314552527052023', 'sp127052023', 1, 999999, 99, 10800),
('CTHD614552527052023', 'HD314552527052023', 'sp1127052023', 1, 19960000, 12, 18970000),
('CTHD714552527052023', 'HD314552527052023', 'sp1427052023', 2, 4960000, 45, 5892480),
('CTHD815034627052023', 'HD415034627052023', 'sp1727052023', 1, 10190000, 15, 9354420),
('CTHD918341727052023', 'HD518341727052023', 'sp127052023', 1, 999999, 99, 10800);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `quantity` smallint(20) NOT NULL,
  `price` float NOT NULL,
  `discount` tinyint(3) NOT NULL,
  `create_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `gender` smallint(5) NOT NULL COMMENT '1 is men, 2 is women',
  `brand` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `image`, `quantity`, `price`, `discount`, `create_at`, `updated_at`, `gender`, `brand`) VALUES
('sp1027052023', 'BENTLEY BL2080-252MKKI', 'BENTLEY 2080-152MKKI là mẫu đồng hồ cơ mới nhất hiện nay, xuất xứ thương hiệu đồng hồ của Đức nổi tiếng hàng đầu về sự chính xác và bền bỉ trong nghệ thuật chế tác đồng hồ. Nổi bật với 30 viên kim cương ( 12 viên tại cọc số, 18 viên còn lại được trải khắp đường viền của mặt phụ small second) và > 400 viên đá sapphire đầy sang trọng với độ tinh xảo cao mang tới phong cách sang trọng quý tộc và thanh lịch.', 'bentley-bl2080-252mkki', 220, 99000000, 10, '2022-12-06 11:23:33', '2022-12-06 11:23:33', 1, 'Bentley'),
('sp1127052023', 'BENTLY BL1805-20LKWD', 'Đồng hồ Bentley BL1805-20LKWD là mẫu đồng hồ nữ mới nhất hiện nay, xuất xứ thương hiệu đồng hồ của Đức nổi tiếng hàng đầu về sự chính xác và bền bỉ trong nghệ thuật chế tác đồng hồ, sản phẩm mang phong cách sang trọng quý tộc và thanh lịch, cuốn hút ngay từ cái nhìn đầu tiên với phong cách classic đầy tinh tế.', 'bentley-bl1805-20lkwd', 349, 19960000, 12, '2022-12-06 11:23:33', '2022-12-06 11:23:33', 2, 'Bentley'),
('sp1227052023', 'BENTLY BL1707-101LWWW', 'Đồng hồ Bentley BL1707-101LWWW là mẫu đồng hồ nữ mới nhất hiện nay, xuất xứ thương hiệu đồng hồ của Đức nổi tiếng hàng đầu về sự chính xác và bền bỉ trong nghệ thuật chế tác đồng hồ, sản phẩm mang phong cách sang trọng quý tộc và thanh lịch, cuốn hút ngay từ cái nhìn đầu tiên với phong cách classic đầy tinh tế khi trang bị cho mình vòng bezel đính đá Swarovski', 'bentley-bl1707-101lwww', 880, 9560000, 0, '2022-12-06 11:25:45', '2022-12-06 11:25:45', 2, 'Bentley'),
('sp127052023', 'DOUGLAS DAY-DATE 41', 'Cách mạng hóa hoạt động du lịch, Douglas DC-3 vận chuyển hành khách với phong cách Hạng Nhất và trở thành công cụ trong Thời kỳ Vàng của ngành hàng không. Bằng cách pha trộn sự tinh tế của chuyến du lịch sang trọng với công nghệ tiên tiến và tay nghề thủ công, chiếc đồng hồ AVIATOR Douglas Day Date 41 vinh danh chiếc máy bay vĩ đại nhất thời đại.', 'douglas-day-date-41', 0, 999999, 99, '2022-12-05 18:22:40', '2023-05-18 11:53:59', 1, 'Avia'),
('sp1327052023', 'CITIZEN ECO DRIVE-BM7480', 'Đồng hồ Citizen BM7480-81L chính hãng, một thiết kế mới nhất của Citizen Japan năm 2022. Với chất liệu thép không gỉ 316L cao cấp, thiết kế măt số học trò to rõ đễ quan sát cùng bộ kim dạ quang sáng rõ cả trong bóng tối, mặt xanh lam dâyd sang trong. Bộ máy Eco-Drive bền bỉ có thể hoạt động với tuổi thọ trên 10 năm.', 'citizen-eco-drive-bm7480', 100, 18110000, 0, '2022-12-06 11:28:05', '2022-12-06 11:28:05', 1, 'Citizen'),
('sp1427052023', 'CITIZEN AG835186E', 'Đồng hồ nam Citizen AG8351-86E nổi bật đồng hồ 6 kim và các chức năng lịch ngày với thiết kế độc đáo phân ra 3 ô riêng biệt mang đậm nét cá tính trên nền mặt số tone đen mạnh mẽ.', 'citizen-ag835186e', 2000, 4960000, 45, '2022-12-06 11:28:05', '2022-12-06 11:28:05', 1, 'Citizen'),
('sp1527052023', 'CITIZEN ER0212-50D', 'Citizen Quartz ER0212-50D có đường kính 30 mm và độ dày 6.7 mm. Mặt kính được làm bằng chất liệu kính khoáng. Khung vỏ được làm bằng chất liệu thép không gỉ 316L. Bên trong khung vỏ là bộ máy quartz có độ chính xác cao. Dây đeo được làm bằng thép không gỉ và được mạ màu vàng gold (yellow gold) bằng công nghệ PVD.', 'citizen-er0212-50d', 711, 42500000, 10, '2022-12-06 11:30:40', '2022-12-06 11:30:40', 2, 'Citizen'),
('sp1627052023', 'CITIZEN EM0710-54Y', 'Đồng Hồ Nữ Citizen EM0710-54Y Chính Hãng. Đồng Hồ CitizenEco-Drive Women\'s Jolie Diamond EM0710-54Y có mặt số tròn, kim chỉ thanh mãnh,các nút chỉ giờ đính kim cương nổi bật trên nền số xà cừ màu hồng hiếm có, dây đeo stainless steel đem đến phong cách sang trọng và đẳng cấp cho phái nữ.', 'citizen-em0710-54y', 1111, 7500000, 5, '2022-12-06 11:30:40', '2022-12-06 11:30:40', 2, 'Citizen'),
('sp1727052023', 'OLYM PIANUS OP99141-71AGK-T', 'Đồng hồ Olym Pianus OP99141-71AGK-GL-T là một thương hiệu đồng hồ Nhật Bản nổi tiếng bền bỉ với chất lượng vượt trội. Đồng hồ Olym Pianus OP99141-71AGK-GL-T kính cong vòm huyền thoại là một trong những thương hiệu đồng hồ hiếm hoi có giá thành vừa phải mà vẫn đáp ứng đầy đủ các tiêu chí về thiết kế hiện đại cũng như chất lượng sản phẩm mang tới cho khách hàng có những trải nghiệm tuyệt vời nhất.', 'olym-pianus-op99141-71agk-t', 900, 10190000, 15, '2022-12-06 11:35:41', '2022-12-06 11:35:41', 1, 'Olym'),
('sp1827052023', 'OLYM PIANUS OP9946.1AGK-T', 'Đồng hồ Olym Pianus được ra đời từ những thập niên 50, trải qua suốt quá trình phát triển trên thị trường đồng hồ OP đã dần khẳng định là một trong những thương hiệu tầm trung có tiếng và được nhiều người yêu thích sử dụng. Mỗi thiết kế trong dòng OP luôn được cải tiến đổi mới cho phù hợp với lứa tuổi và thời gian hiện đại. Trong những năm trở lại đây đồng hồ OP được đưa vào thị trường Việt Nam, đã làm hài lòng đại đa số những người sử dụng về chất lượng cũng như mẫu mã sản phẩm.', 'olym-pianus-op9946-1agk-t', 510, 7410000, 35, '2022-12-06 11:35:41', '2022-12-06 11:35:41', 1, 'Olym'),
('sp1927052023', 'OLYM PIANUS OP990-143AGR-GL-XL', 'Olym Pianus OP990-45ADGS-GL-T  là một thương hiệu đồng hồ Nhật Bản nổi tiếng bền bỉ với chất lượng vượt trội, mang một diện mạo phong thái phóng khoáng và vô cùng sang trọng giúp nó nổi bật ở bất cứ nơi đâu, đây là một trong những sản phẩm nổi bật của thương hiệu Olym Pianus, có giá thành vừa phải mà vẫn đáp ứng đầy đủ các tiêu chí về thiết kế cũng như chất lượng sản phẩm mang tới khách hàng có những trải nghiệm tuyệt vời nhất.', 'olym-pianus-op990-143agr-gl-xl', 100, 18000000, 0, '2022-12-07 02:39:07', '2022-12-07 02:39:07', 1, 'Olym'),
('sp2027052023', 'OLYM PIANUS OP9941-84AGK-GL-V', 'Đồng hồ Olym Pianus OP99411-84AGK-GL-T là một thương hiệu đồng hồ Nhật Bản nổi tiếng bền bỉ với chất lượng vượt trội. Đồng hồ Olym Pianus OP99411-84AGK-GL-T là mẫu đồng hồ cơ mới nhất 2019 với độ hoàn thiện hoàn hảo, một trong những thương hiệu đồng hồ hiếm hoi có giá thành vừa phải mà vẫn đáp ứng đầy đủ các tiêu chí về thiết kế cũng như chất lượng sản phẩm mang tới khách hàng có những trải nghiệm tuyệt vời nhất.', 'olym-pianus-op9941-84agk-gl-v', 545, 8860000, 5, '2022-12-07 02:39:07', '2022-12-07 02:39:07', 1, 'Olym'),
('sp2127052023', 'OLYM PIANUS OP9908-88AGSK-XL', 'Mẫu đồng hồ Automatic khẳng định giá trị của mình ở ngay thiết kế lộ máy, được biết đến như “trái tym” của OP9908-88AGSK-GL-T. Đối với anh em thích khám phá chắc hẳn rất thích nhìn chuyển động của bộ máy dưới lớp kính.Tuyệt vời hơn khi nhà sản xuất chế tác thang đo dự trữ với chiếc kim xăng hiển thị thời gian trữ cót đặt ngay giờ thứ 12. Niềm khao khát của nhiều quý ông khi hầu như thiết kế này chỉ thấy ở phân khúc đắt tiền. Ở vị trí 6h lộ diện chiếc đồng hồ 60 giây và chiếc kim nhỏ. Một tính năng được hoàn thiện thêm nhưng càng giúp OP9908-88AGSK-GL-T đánh bóng thêm đẳng cấp của mình.', 'olym-pianus-op9908-88agsk-xl', 155, 14560000, 50, '2022-12-07 02:41:33', '2022-12-07 02:41:33', 1, 'Olym'),
('sp2227052023', 'OLYM PIANUS OP990-15AMSK-T', 'Đồng hồ Olym Pianuss Skeleton OP990-15AMSK-T chính hãng, chất liệu thép không gỉ mạ đờmi, thiết kế thời trang cao cấp, thấy máy hoạt động cùng kính chống trầy, máy auotmmatic.', 'olym-pianus-op990-15amsk-t', 426, 7440000, 25, '2022-12-07 02:41:33', '2022-12-07 02:41:33', 1, 'Olym'),
('sp227052023', 'DOUGLAS MOONFLIGHT', 'Vào những năm 1930, các nhà thiết kế thời trang cao cấp đã mang đến sự quyến rũ cho đường băng và lên chiếc Douglas DC-3, chiếc máy bay đã thiết kế lại hành trình bằng cách mang đến sự sang trọng cho mỗi chuyến bay. Kết hợp các tính năng Art Deco cổ điển được đặt theo các giai đoạn của mặt trăng, AVIATOR MoonFlight cho phép bạn hạ cánh giữa các ngôi sao và tín đồ thời trang với phong cách cao cấp nhằm tôn vinh chiếc máy bay vĩ đại nhất của thời đại đó.', 'douglas-moonflight', 100, 18000000, 1, '2022-12-06 11:08:57', '2023-05-17 09:09:14', 2, 'Avia'),
('sp2327052023', 'OLYM PIANUS OP99411-84AGSK-V', 'Đồng hồ Olym Pianus OP99411-84AGSK-V là một thương hiệu đồng hồ Nhật Bản nổi tiếng bền bỉ với chất lượng vượt trội. Đồng hồ Olym Pianus OP99411-84AGSK-X là mẫu đồng hồ cơ mới nhất 2019 với độ hoàn thiện hoàn hảo, một trong những thương hiệu đồng hồ hiếm hoi có giá thành vừa phải mà vẫn đáp ứng đầy đủ các tiêu chí về thiết kế cũng như chất lượng sản phẩm mang tới khách hàng có những trải nghiệm tuyệt vời nhất.', 'olym-pianus-op99411-84agsk-v', 685, 59600000, 25, '2022-12-07 02:43:34', '2022-12-07 02:43:34', 1, 'Olym'),
('sp2427052023', 'OLYM PIANUS OP99411-84AGS-X', 'Đồng hồ Olym Pianus OP99411-84AGS-X là một thương hiệu đồng hồ Nhật Bản nổi tiếng bền bỉ với chất lượng vượt trội. Đồng hồ Olym Pianus OP99411-84AGS-X là mẫu đồng hồ cơ mới nhất 2019 với độ hoàn thiện hoàn hảo, một trong những thương hiệu đồng hồ hiếm hoi có giá thành vừa phải mà vẫn đáp ứng đầy đủ các tiêu chí về thiết kế cũng như chất lượng sản phẩm mang tới khách hàng có những trải nghiệm tuyệt vời nhất.', 'olym-pianus-op99411-84ags-x', 400, 9960000, 10, '2022-12-07 02:43:34', '2022-12-07 02:43:34', 1, 'Olym'),
('sp2527052023', 'OLYM PIANUS OP99411-84AGS-D', 'Đồng hồ Olym Pianus OP99411-84AGS-D là một thương hiệu đồng hồ Nhật Bản nổi tiếng bền bỉ với chất lượng vượt trội. Đồng hồ Olym Pianus OP99411-84AGS-X là mẫu đồng hồ cơ mới nhất 2019 với độ hoàn thiện hoàn hảo, một trong những thương hiệu đồng hồ hiếm hoi có giá thành vừa phải mà vẫn đáp ứng đầy đủ các tiêu chí về thiết kế cũng như chất lượng sản phẩm mang tới khách hàng có những trải nghiệm tuyệt vời nhất.', 'olym-pianus-op99411-84ags-d', 751, 99900000, 10, '2022-12-07 02:46:05', '2022-12-07 02:46:05', 1, 'Olym'),
('sp2627052023', 'OLYM PIANUS LA BÀN OP9943AGS-GL-D-KD', 'Đồng hồ Olym Pianus La Bàn OP9943AGS-GL-D-KD là một thương hiệu đồng hồ Nhật Bản nổi tiếng bền bỉ với chất lượng vượt trội. Đồng hồ Olym Pianus OP99411-84AGS-X là mẫu đồng hồ cơ mới nhất 2019 với độ hoàn thiện hoàn hảo, một trong những thương hiệu đồng hồ hiếm hoi có giá thành vừa phải mà vẫn đáp ứng đầy đủ các tiêu chí về thiết kế cũng như chất lượng sản phẩm mang tới khách hàng có những trải nghiệm tuyệt vời nhất.', 'olym-pianus-la-ban-op9943ags-gl-d-kd', 642, 5560000, 6, '2022-12-07 02:46:05', '2022-12-07 02:46:05', 1, 'Olym'),
('sp2727052023', 'Olym Pianus Fusion OP990-45ADDGR-X', 'Olym Pianus Fusion OP990-45ADDGR-X. Sở hữu Case size 42mm, bezel size 40mm cực vừa vặn, tay nhỏ cũng đeo được. Có 2 phiên bản dây thép (SS) và dây cao su rất phù hợp cho mùa hè nóng bức và hay dùng nước, độ bền cực cao. Kính sapphire nguyên khối + bezel đính đá cực chắc chắn và sáng giúp tổng thể thiết kế trở lên Sang trọng - Đẳng cấp. Bộ máy Automatic quen thuộc của nhà OP - độ trữ cót 40H, chạy chính xác + bền bỉ.', 'olym-pianus-fusion-op990-45addgr-x', 352, 75600000, 31, '2022-12-07 02:47:23', '2022-12-07 02:47:23', 1, 'Olym'),
('sp2827052023', 'OLYM PIANUS OP99411-84AGK-GL-XL', 'Đồng hồ Olym Pianus OP99411-84AGK-GL-XL là một thương hiệu đồng hồ Nhật Bản nổi tiếng bền bỉ với chất lượng vượt trội. Đồng hồ Olym Pianus OP99411-84AGK-GL-T là mẫu đồng hồ cơ mới nhất 2019 với độ hoàn thiện hoàn hảo, một trong những thương hiệu đồng hồ hiếm hoi có giá thành vừa phải mà vẫn đáp ứng đầy đủ các tiêu chí về thiết kế cũng như chất lượng sản phẩm mang tới khách hàng có những trải nghiệm tuyệt vời nhất.', 'olym-pianus-op99411-84agk-gl-xl', 1656, 8500000, 10, '2022-12-07 02:47:23', '2022-12-07 02:47:23', 1, 'Olym'),
('sp2927052023', 'OLYM PIANUS OP990-45ADGS-GL-T', 'Olym Pianus OP990-45ADGS-GL-T  là một thương hiệu đồng hồ Nhật Bản nổi tiếng bền bỉ với chất lượng vượt trội, mang một diện mạo phong thái phóng khoáng và vô cùng sang trọng giúp nó nổi bật ở bất cứ nơi đâu, đây là một trong những sản phẩm nổi bật của thương hiệu Olym Pianus, có giá thành vừa phải mà vẫn đáp ứng đầy đủ các tiêu chí về thiết kế cũng như chất lượng sản phẩm mang tới khách hàng có những trải nghiệm tuyệt vời nhất.', 'olym-pianus-op990-45adgs-gl-t', 872, 88810000, 10, '2022-12-07 02:48:59', '2022-12-07 02:48:59', 1, 'Olym'),
('sp3027052023', 'OLYM PIANUS OP990-45ADGR-GL-D', 'Đồng hồ Olym Pianus OP990-45ADGR-GL-D là một thương hiệu đồng hồ Nhật Bản nổi tiếng bền bỉ với chất lượng vượt trội. Đồng hồ Olym Pianus OP99411-84AGS-X là mẫu đồng hồ cơ mới nhất 2019 với độ hoàn thiện hoàn hảo, một trong những thương hiệu đồng hồ hiếm hoi có giá thành vừa phải mà vẫn đáp ứng đầy đủ các tiêu chí về thiết kế cũng như chất lượng sản phẩm mang tới khách hàng có những trải nghiệm tuyệt vời nhất.', 'olym-pianus-op990-45adgr-gl-d', 666, 4400000, 5, '2022-12-07 02:48:59', '2022-12-07 02:48:59', 1, 'Olym'),
('sp3127052023', 'OLYM PIANUS 9946.1AGS', 'Đồng hồ Olym Pianus 9946.1AGS là một thương hiệu đồng hồ Nhật Bản nổi tiếng bền bỉ với chất lượng vượt trội. Đồng hồ Olym Pianus OP99411-84AGS-X là mẫu đồng hồ cơ mới nhất 2019 với độ hoàn thiện hoàn hảo, một trong những thương hiệu đồng hồ hiếm hoi có giá thành vừa phải mà vẫn đáp ứng đầy đủ các tiêu chí về thiết kế cũng như chất lượng sản phẩm mang tới khách hàng có những trải nghiệm tuyệt vời nhất.', 'olym-pianus-9946-1ags', 600, 15260000, 15, '2022-12-07 02:50:34', '2022-12-07 02:50:34', 1, 'Olym'),
('sp3227052023', 'OLYM PIANUS 899833G1B', 'Đồng hồ Olym Pianus 899833G1B là một thương hiệu đồng hồ Nhật Bản nổi tiếng bền bỉ với chất lượng vượt trội. Đồng hồ Olym Pianus OP99411-84AGS-X là mẫu đồng hồ cơ mới nhất 2019 với độ hoàn thiện hoàn hảo, một trong những thương hiệu đồng hồ hiếm hoi có giá thành vừa phải mà vẫn đáp ứng đầy đủ các tiêu chí về thiết kế cũng như chất lượng sản phẩm mang tới khách hàng có những trải nghiệm tuyệt vời nhất.', 'olym-pianus-899833g1b', 639, 10260000, 37, '2022-12-07 02:50:34', '2022-12-07 02:50:34', 1, 'Olym'),
('sp327052023', 'AIRACOBRA P45 CHRONO 1', 'Tận dụng chiến lược tầm nhìn chim của mình trong suốt Thế chiến II, Airacobra là một máy bay chiến đấu ổn định mà Đồng minh có thể dựa vào để hỗ trợ quân đội trên mặt đất. Bằng cách kết hợp tinh thần đáng tin cậy của nó đã chứng tỏ là công cụ trong mọi nhiệm vụ, đồng hồ AVIATOR Airacobra P45 Chrono mang đến một vẻ ngoài giống như một công cụ xứng đáng được đề cập đến.', 'airacobra-p45-chrono-1', 1000, 10000000, 10, '2022-12-06 11:08:57', '2022-12-06 11:08:57', 1, 'Avia'),
('sp3327052023', 'OLYM PIANUS OP2467LK-T', 'Thiết kế nhẹ nhàng nhưng đầy nét quý phái. Chắc chắn là điểm thu hút trên cổ tay của người phụ nữ sở hữu chiếc đồng hồ này.Tựa như một thứ trang sức lộng lẫy trên cổ tay người đẹp, OP2467LK-T là sự hòa điệu của sắc vàng quý phái, 4 viên đá quý lấp lánh trên mặt số cùng kiểu thiết kế lắc tay điệu đàng, độc lạ. Từng nấc từng nấc để lộ làn da quyến rũ của chị em trong những khoảng hổng đầy ngụ ý.', 'olym-pianus-op2467lk-t', 100, 59560000, 10, '2022-12-07 02:52:57', '2022-12-07 02:52:57', 2, 'Olym'),
('sp3427052023', 'OLYM PIANUS OP130-06LS-GL-T', 'Thiết kế nhẹ nhàng nhưng đầy nét quý phái. Chắc chắn là điểm thu hút trên cổ tay của người phụ nữ sở hữu chiếc đồng hồ này.Tựa như một thứ trang sức lộng lẫy trên cổ tay người đẹp, OP130-06LS-GL-T là sự hòa điệu của sắc vàng quý phái, 4 viên đá quý lấp lánh trên mặt số cùng kiểu thiết kế lắc tay điệu đàng, độc lạ. Từng nấc từng nấc để lộ làn da quyến rũ của chị em trong những khoảng hổng đầy ngụ ý.', 'olym-pianus-op130-06ls-gl-t', 599, 1260000, 35, '2022-12-07 02:52:57', '2022-12-07 02:52:57', 2, 'Olym'),
('sp3527052023', 'G-SHOCK GM-S5600GB-1', 'Chiếc đồng hồ G-SHOCK màu vàng kim trên nền đen phủ kim loại sở hữu thiết kế nhỏ và gọn hơn. Đường gờ kim loại phủ lớp ion màu vàng kim làm tôn lên vẻ ngoài trang nhã, sang trọng. Nút bấm và chốt cũng được phủ ion màu vàng kim tương phản với phần nền đen tạo nên lớp kim loại thực sự tỏa sáng. Sự kết hợp giữa màu vàng kim sang trọng và màu đen mạnh mẽ làm tôn lên vẻ đẹp lung linh độc đáo của riêng bạn.', 'g-shock-gm-s5600gb-1', 444, 19990000, 46, '2022-12-07 02:54:23', '2022-12-07 02:54:23', 1, 'GShock'),
('sp3627052023', 'G-SHOCK GMA-S2100SK-2A', 'Hãy đeo lên tay chiếc đồng hồ GA-2100 kết hợp kim-số, phủ kim loại trong suốt, vốn được ưa chuộng nay càng trở nên thu hút với thiết kế thanh mảnh và nhỏ gọn hơn. Chiếc đồng hồ sở hữu thiết kế kim loại trong suốt với nhiều màu cho bạn lựa chọn là phụ kiện linh hoạt, phù hợp với mọi loại trang phục trong suốt cả năm. Các vạch chỉ giờ được xử lý bằng phương pháp lắng đọng hơi bán mờ tạo nên vẻ ngoài bằng kim loại trong suốt sống động như thật.', 'g-shock-gma-s2100sk-2a', 741, 18500000, 0, '2022-12-07 02:54:23', '2022-12-07 02:54:23', 1, 'GShock'),
('sp3727052023', 'G-SHOCK GMA-S120SR-7A', 'Xin trân trọng giới thiệu mẫu G-SHOCK . Xuất hiện từ những năm 1990, phong cách trong suốt từng rất phổ biến và trở thành một phần không thể thiếu trong lịch sử của G-SHOCK .\r\nPhần mặt được dát lớp vỏ kim loại màu vàng hồng kết hợp cùng thiết kế chắc chắn đã tạo nên một mẫu đồng hồ đeo tay phù hợp với mọi hoàn cảnh, từ thời trang hiện đại cho đến thời trang đường phố và thường nhật.', 'g-shock-gma-s120sr-7a', 999, 18000000, 11, '2022-12-07 02:56:07', '2022-12-07 02:56:07', 2, 'GShock'),
('sp3827052023', 'G-SHOCK GMA-S110CW-7A2', 'Xin trân trọng giới thiệu mẫu G-SHOCK . Xuất hiện từ những năm 1990, phong cách trong suốt từng rất phổ biến và trở thành một phần không thể thiếu trong lịch sử của G-SHOCK .\r\nPhần mặt được dát lớp vỏ kim loại màu vàng hồng kết hợp cùng thiết kế chắc chắn đã tạo nên một mẫu đồng hồ đeo tay phù hợp với mọi hoàn cảnh, từ thời trang hiện đại cho đến thời trang đường phố và thường nhật.', 'g-shock-gma-s110cw-7a2', 362, 7500000, 5, '2022-12-07 02:56:07', '2022-12-07 02:56:07', 2, 'GShock'),
('sp3927052023', 'nguyen quoc chau', 'gst-b100d-1a9dr-01', 'nguyen-quoc-chau-12350025052023', 100, 100000, 10, '2023-05-25 00:35:12', '2023-05-25 02:02:37', 1, 'Baby'),
('sp427052023', 'AIRACOBRA P45 CHRONO', 'Tận dụng chiến lược tầm nhìn chim của mình trong suốt Thế chiến II, Airacobra là một máy bay chiến đấu ổn định mà Đồng minh có thể dựa vào để hỗ trợ quân đội trên mặt đất. Bằng cách kết hợp tinh thần đáng tin cậy của nó đã chứng tỏ là công cụ trong mọi nhiệm vụ, đồng hồ AVIATOR Airacobra P45 Chrono mang đến một vẻ ngoài giống như một công cụ xứng đáng được đề cập đến.', 'airacobra-p45-chrono', 100, 11000000, 20, '2022-12-06 11:13:51', '2022-12-06 11:13:51', 2, 'Avia'),
('sp527052023', 'BABY G BGA-310-7A2', 'Thỏa sức ngao du ngoài trời với mẫu đồng hồ BGA-310 sành điệu và mạnh mẽ. Ngoài ra bạn cũng có thể chọn màu be sáng nếu yêu thích phong cách ngoài trời. Mặt đồng hồ tròn và rộng kết hợp dây đeo lớn và vạch chỉ giờ nổi làm tôn lên vẻ ngoài nghịch ngợm và giúp bạn dễ đọc. Dây đeo màu sáng giúp hiển thị giờ rõ ràng ngay cả trong bóng tối để bạn xem nhanh hơn. Chiếc đồng hồ có phần vấu nối dây đeo vừa vặn phù hợp với mọi chuyển động. Chiếc đồng hồ này còn cung cấp nhiều chức năng thực tiễn như cấu trúc chống va đập và khả năng chống nước ở độ sâu lên đến 100 mét. Nút bấm phía trước giúp bạn dễ mở đèn LED đôi chiếu sáng mặt đồng hồ và mở màn mình LCD khi đi cắm trại hoặc phiêu lưu.', 'baby-g-bga-310-7a2', 550, 8500000, 5, '2022-12-06 11:13:51', '2022-12-06 11:13:51', 1, 'Baby'),
('sp627052023', 'BABY G BA-110XSM-2A', 'Từ BABY-G, dòng đồng hồ đơn giản dành cho giới nữ năng động, đã phát triển mẫu đồng hồ mới được hợp tác sản xuất cùng với thương hiệu Thủy thủ Mặt Trăng. Thương hiệu anime Thủy thủ Mặt Trăng và BABY-G nổi tiếng từ những năm 1990 và đã trở thành đối tác hoàn hảo của nhau. Chủ đề của mẫu đồng hồ mới này khả năng biến hình mang phong cách lãng mạn của Thủy thủ Mặt Trăng. Dựa trên mẫu đồng hồ BABY-G BA-110 nổi tiếng, chiếc đồng hồ mới này kết hợp nhiều yếu tố nguyên bản lung linh lấy cảm hứng từ phiên bản biến hình của Thủy thủ Mặt Trăng. Phần thân bán trong suốt màu xanh hải quân gợi lên hình ảnh bầu trời đêm, được trang trí bằng các ngôi sao, mặt trăng, trái tim và các hình ảnh Thủy thủ Mặt Trăng màu xanh lam, đỏ và vàng, tạo nên diện mạo vô cùng quyến rũ. Mặt đồng hồ được trang trí bằng những hình ảnh lấp lánh kết hợp dây đeo màu vàng hồng. Thiết kế đặc biệt này gợi lên hình ảnh Thủy thủ Mặt Trăng biến hình vô cùng cuốn hút và khó quên. Vòng dây đeo in hình Thủy thủ Mặt Trăng cũng được khắc trên nắp sau của đồng hồ. Thiết kế bao bì của mẫu đồng hồ này được lấy cảm hứng từ Thủy thủ Mặt Trăng. Mọi chi tiết liên quan đến mẫu đồng hồ này đều được thiết kế nhằm tôn vinh sự hợp tác đặc biệt giữa BABY-G và Thủy thủ Mặt Trăng, nữ anh hùng trong mơ của mọi cô gái.', 'baby-g-ba-110xsm-2a', 753, 5990000, 0, '2022-12-06 11:17:21', '2022-12-06 11:17:21', 1, 'Baby'),
('sp727052023', 'BABY G BA-130PM-4A', 'Đồng hồ BABY-G pastel nhiều màu kết hợp kim loại vừa dễ thương vừa đơn giản, phù hợp với nhịp sống năng động của bạn. Mẫu đồng hồ với các dải và khối màu tông pastel mang phong cách pop nữ tính, kết hợp với những sắc màu dịu nhẹ tạo nên phong cách thiết kế đẹp mắt. Kim đồng hồ, vạch chỉ giờ và các thành phần mặt số khác đều được phủ lớp kim loại sáng bóng, tinh tế, kết hợp với vỏ và dây đeo mờ tạo nên phong cách độc đáo. Chiếc đồng hồ này không chỉ đẹp mắt mà còn cung cấp nhiều chức năng hữu ích hàng ngày như cấu trúc chống va đập và khả năng chống nước ở độ sâu lên đến 100 mét. Thể hiện phong cách huyền bí cùng sự tương phản ấn tượng bên trong mẫu đồng hồ kim loại mạnh mẽ với màu pastel dịu nhẹ.', 'baby-g-ba-130pm-4a', 511, 4560000, 6, '2022-12-06 11:17:21', '2022-12-06 11:17:21', 2, 'Baby'),
('sp827052023', 'BABY G BGA-310-4A', 'Thỏa sức ngao du ngoài trời với mẫu đồng hồ BGA-310 sành điệu và mạnh mẽ. Ngoài ra bạn cũng có thể chọn màu be sáng nếu yêu thích phong cách ngoài trời. Mặt đồng hồ tròn và rộng kết hợp dây đeo lớn và vạch chỉ giờ nổi làm tôn lên vẻ ngoài nghịch ngợm và giúp bạn dễ đọc. Dây đeo màu sáng giúp hiển thị giờ rõ ràng ngay cả trong bóng tối để bạn xem nhanh hơn. Chiếc đồng hồ có phần vấu nối dây đeo vừa vặn phù hợp với mọi chuyển động. Chiếc đồng hồ này còn cung cấp nhiều chức năng thực tiễn như cấu trúc chống va đập và khả năng chống nước ở độ sâu lên đến 100 mét. Nút bấm phía trước giúp bạn dễ mở đèn LED đôi chiếu sáng mặt đồng hồ và mở màn mình LCD khi đi cắm trại hoặc phiêu lưu. Bạn đang không rảnh tay? Chỉ cần nghiêng cổ tay và bật chức năng phát sáng tự động để xem giờ ngay cả trong bóng tối. Đồng hồ BABY-G giúp bạn luôn có phong cách riêng dù là khi ở nhà giữa đô thị nhộn nhịp hay đang trên đường leo núi, sẵn sàng đối mặt với mọi chuyện xảy ra trong đời sống năng động của mình.', 'baby-g-bga-310-4a', 652, 9560000, 15, '2022-12-06 11:20:21', '2022-12-06 11:20:21', 2, 'Baby'),
('sp927052023', 'BENTLEY BL1831-25MKNN', 'Đồng hồ Bentley là thương hiệu được thành lập vào năm 1948 tại La Chaux-de-Fonds, Thụy Sĩ. Thị trấn được biết đến như cái nôi của đồng hồ hiện đại. Tuy là thương hiệu của Thụy Sĩ nhưng lại được thiết kế gia công tại Đức – một quốc gia với nền công nghiệp chủ đạo về cơ khí, điện tử, sản xuất ôtô. Vào đầu thập niên 90, Bentley đã phát triển thành Tập đoàn Bentley Luxury Group và mở rộng danh mục sản phẩm của mình bao gồm các phụ kiện thời trang, đồ da cao cấp với phương châm “BE IN CONTROL”.', 'bentley-bl1831-25mknn', 1020, 9960000, 10, '2022-12-06 11:20:21', '2022-12-06 11:20:21', 1, 'Bentley');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(1) NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '0 is customer and 1,2 is employee'
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
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `role` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone_number`, `address`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
('kh1026052023', 'Nguyen Quoc Chau', '0926383006', '20 Nha Trang Khanh Hoa, Xã Lũng Táo, Huyện Đồng Văn, Tỉnh Hà Giang', 'chauquocnguyen.cun1@gmail.com', NULL, '$2y$10$/nMeQirGpmQwSI.XG24aCeVEbpF3BLpMfQ0.JEshDf/ROn.cSOYou', NULL, '2023-05-26 19:27:26', '2023-05-26 19:32:58', 0),
('kh105122022', 'Nguyễn Quốc Châu', '0386888889', '12 Nguyễn Tất Thành, Xã Nghĩa Hiệp, Huyện Yên Mỹ, Tỉnh Hưng Yên', 'chau.nq.61cntt@ntu.edu.vn', NULL, '$2y$10$gkNHqPktu4xPHBP21yEpbu8aftSeVjfn4wSH.z7zibQgpHLfeLuKu', NULL, '2022-12-05 18:15:54', '2023-05-19 09:31:46', 0),
('kh26122022', 'Phan Thị Huyền Trâm', '0926858585', '02 Nguyễn Tất Thành, Xã Phước Đồng, Thành phố Nha Trang, Tỉnh Khánh Hòa', 'phanthihuyentram@gmail.com', NULL, '$2y$10$zVkefGONz.3kvfgb1DpwHOT5xdQ3c.Tj8oyXOc0FM55hQkrrfDh.W', NULL, '2022-12-26 16:01:25', '2023-05-22 09:27:59', 0),
('kh312122022', 'Lê Thị E', '0926355076', '03 Hưng, Phường Quang Trung, Quận Đống Đa, Thành phố Hà Nội', 'lethie@gmail.com', NULL, '$2y$10$huFy/caUfNuL2S52nYiwJu6s/ob2L0V5mQcdcreo986vsmEhJKV2.', NULL, '2022-12-12 17:23:17', '2023-05-24 08:32:04', 0),
('kh412122022', 'Trần Văn D', '0926383006', 'Nguyễn Trung Trực, Thị trấn Kép, Huyện Lạng Giang, Tỉnh Bắc Giang', 'tranvand@gmail.com', NULL, '$2y$10$CM9tvkv48v4u0HzfgFLeceE1WyXPKLUUpRQbe1.7Y3ko6BvZsxnbK', NULL, '2022-12-12 16:36:59', '2023-05-24 08:30:32', 0),
('kh523052023', 'Nguyễn Trần Hoàn Kim', '0966666666', '20 Phùng Hưng, Phường Cửa Ông, Thành phố Cẩm Phả, Tỉnh Quảng Ninh', 'nguyentranhoankim@gmail.com', NULL, '$2y$10$ns0/RvgnHeKBw0jR7rrA3.kvXlSv4e5iIyA/U0bs8fmFK7P676i4.', NULL, '2023-05-23 08:21:44', '2023-05-24 08:12:11', 0),
('kh624052023', 'Trần Văn AB', '0826666666', 'Địa chỉ 2, Xã Lý Bôn, Huyện Bảo Lâm, Tỉnh Cao Bằng', 'tranvanab@gmail.com', NULL, '$2y$10$A3Rd6DuaT5z52LtU5Mz3CeWyZDj5tHAQTzLvgxHLNVuo6lpAOBfDi', NULL, '2023-05-24 08:29:05', '2023-05-24 16:19:12', 0),
('kh724052023', 'Trần Văn B', '0826666668', 'Địa chỉ 2, Xã Hồng Trị, Huyện Bảo Lạc, Tỉnh Cao Bằng', 'tranvanb@gmail.com', NULL, '$2y$10$XBEr.WZumGnh3H3mOZH0T.TLrXIyQqhA1TRUB0Ub/Vd1eI6ZuDXd.', NULL, '2023-05-24 08:29:32', '2023-05-24 08:29:32', 0),
('kh824052023', 'Trần Văn C', '0866666668', 'Địa chỉ 2, Xã Tân Tri, Huyện Bắc Sơn, Tỉnh Lạng Sơn', 'tranvanc@gmail.com', NULL, '$2y$10$ns0/RvgnHeKBw0jR7rrA3.kvXlSv4e5iIyA/U0bs8fmFK7P676i4.', NULL, '2023-05-24 08:29:48', '2023-05-24 08:29:48', 0),
('kh924052023', 'Nguyễn Yến Nhi', '0386888881', 'Địa chỉ 1c, Thị trấn Pác Miầu, Huyện Bảo Lâm, Tỉnh Cao Bằng', 'nguyenyennhi@gmail.com', NULL, '$2y$10$/IyXglucDzCGHbDHRhnbfew74.kSddBb7UfVfz7D4Y4K6PiCmEa7m', NULL, '2023-05-24 17:54:22', '2023-05-25 01:57:09', 0);

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
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer` (`customers`),
  ADD KEY `product` (`product`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `brand` (`brand`),
  ADD KEY `image` (`image`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `administrator`
--
ALTER TABLE `administrator`
  ADD CONSTRAINT `administrator_ibfk_1` FOREIGN KEY (`role`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `products_brand` FOREIGN KEY (`brand`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_6` FOREIGN KEY (`image`) REFERENCES `images` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
