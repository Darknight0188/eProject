-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th7 31, 2019 lúc 05:40 PM
-- Phiên bản máy phục vụ: 5.7.25
-- Phiên bản PHP: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `category`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `phone` char(15) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `level` tinyint(4) DEFAULT '1',
  `avatar` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`id`, `name`, `address`, `email`, `password`, `phone`, `status`, `level`, `avatar`, `created_at`, `updated_at`) VALUES
(1, 'Vu Quoc Huy', NULL, 'vuquochuy04@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '09766676532', 1, 1, 'http://localhost:8080/eProject/admin/img/_1562851060.', NULL, NULL),
(2, 'Cao Thanh Tung', 'California', 'tung042@gmail.com', '681b4408c5c2bf13c15f8a602d3f995e', '0976554232', 1, 2, NULL, NULL, '2019-07-13 10:11:28'),
(3, 'test', 'hanoi', 'test_email@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '0912345678', 1, 2, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `banner` varchar(100) DEFAULT NULL,
  `home` tinyint(4) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `product_range` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`, `slug`, `image`, `banner`, `home`, `status`, `created_at`, `updated_at`, `product_range`) VALUES
(10, 'HP', NULL, NULL, NULL, 0, 1, '2019-07-15 17:36:57', '2019-07-30 15:07:10', '1, 2, 3, 4'),
(11, 'KingMax', NULL, NULL, NULL, 0, 1, '2019-07-15 17:37:41', '2019-07-30 15:07:10', '1, 2, 3, 4'),
(12, 'ADATA', NULL, NULL, NULL, 0, 1, '2019-07-15 17:38:08', '2019-07-30 15:07:10', '3, 4, 5'),
(13, 'Toshiba', NULL, NULL, NULL, 0, 1, '2019-07-15 17:38:17', '2019-07-30 15:07:10', '3, 4, 5'),
(14, 'Teclast', NULL, NULL, NULL, 0, 1, '2019-07-15 17:39:27', '2019-07-30 15:07:10', '1, 2, 3, 4'),
(15, 'Corsair', NULL, NULL, NULL, 0, 1, '2019-07-15 17:41:21', '2019-07-30 15:07:10', '1, 2, 3, 4'),
(16, 'Kingston', NULL, NULL, NULL, 0, 1, '2019-07-15 17:42:16', '2019-07-30 15:07:10', '3, 4, 5'),
(17, 'Samsung', NULL, NULL, NULL, 0, 1, '2019-07-28 07:43:04', '2019-07-30 15:07:10', '3, 4, 5');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `oders`
--

CREATE TABLE `oders` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `oders`
--

INSERT INTO `oders` (`id`, `transaction_id`, `product_id`, `qty`, `price`, `created_at`, `updated_at`) VALUES
(94, 67, 16, 1, 549000, '2019-07-27 14:54:21', '2019-07-27 14:54:21'),
(95, 67, 15, 3, 180000, '2019-07-27 14:54:21', '2019-07-27 14:54:21'),
(96, 67, 13, 1, 160000, '2019-07-27 14:54:21', '2019-07-27 14:54:21'),
(97, 68, 16, 1, 549000, '2019-07-27 14:54:57', '2019-07-27 14:54:57'),
(98, 68, 15, 4, 180000, '2019-07-27 14:54:57', '2019-07-27 14:54:57'),
(99, 68, 13, 1, 160000, '2019-07-27 14:54:57', '2019-07-27 14:54:57'),
(100, 69, 16, 2, 549000, '2019-07-27 14:56:36', '2019-07-27 14:56:36'),
(101, 69, 15, 4, 180000, '2019-07-27 14:56:36', '2019-07-27 14:56:36'),
(102, 69, 13, 1, 160000, '2019-07-27 14:56:36', '2019-07-27 14:56:36'),
(103, 70, 15, 4, 180000, '2019-07-27 15:10:38', '2019-07-27 15:10:38'),
(104, 71, 17, 1, 79000, '2019-07-29 12:33:51', '2019-07-29 12:33:51'),
(105, 71, 14, 1, 99000, '2019-07-29 12:33:52', '2019-07-29 12:33:52');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `sale` tinyint(4) DEFAULT '0',
  `thunbar` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `temp_id` int(11) DEFAULT NULL,
  `content` text,
  `head` int(11) DEFAULT '0',
  `view` int(11) DEFAULT '0',
  `hot` tinyint(4) DEFAULT '0',
  `pay` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `name`, `slug`, `price`, `number`, `sale`, `thunbar`, `category_id`, `temp_id`, `content`, `head`, `view`, `hot`, `pay`, `created_at`, `updated_at`) VALUES
(13, 'USB Kingmax 16GB MB-03', '', 160000, 50, 0, 'http://localhost:8080/eProject/admin/img/usb_adata_c008_1_2_3_3_1564414543.jpg', 11, 1, '<ul>\r\n	<li>Thiết kế thời trang, năng động, c&aacute; t&iacute;nh.</li>\r\n	<li>USB c&oacute; kiểu d&aacute;ng thanh, k&iacute;ch thước nhỏ gọn</li>\r\n	<li>Sản phẩm được trang bị cổng kết nối USB 3.0, cho tốc độ truyền tải dữ liệu nhanh ch&oacute;ng.</li>\r\n	<li>Thiết bị tự động nhận driver.</li>\r\n	<li>Sản phẩm tương th&iacute;ch với hầu hết c&aacute;c hệ điều h&agrave;nh hiện nay.</li>\r\n</ul>\r\n', 0, 0, 0, NULL, '2019-07-15 18:19:02', '2019-07-30 15:42:25'),
(14, 'USB Kingmax 16GB PB07B', '', 99000, 40, 20, 'http://localhost:8080/eProject/admin/img/dbc966a00960b8d3f4f63dc050df58cf_1564302491.jpg', 11, 1, '<ul>\r\n	<li>Tu&acirc;n thủ ti&ecirc;u chuẩn tốc độ cao USB 3.1 Gen 1</li>\r\n	<li>Thiết kế kh&oacute;a nắp, kh&ocirc;ng phải lo lắng về việc mất nắp</li>\r\n	<li>Lỗ d&acirc;y đeo</li>\r\n</ul>\r\n', 0, 0, 0, -1, '2019-07-15 18:21:13', '2019-07-31 17:32:45'),
(15, 'USB Kingmax MA-06 16GB', '', 180000, 96, 0, 'http://localhost:8080/eProject/admin/img/1.u2409.d20170509.t143802.44261_1563214952.jpg', 11, 1, '<ul>\r\n	<li>Chế độ chờ tiết kiệm năng lượng</li>\r\n	<li>Kh&ocirc;ng cần nguồn điện b&ecirc;n ngo&agrave;i</li>\r\n	<li>Kết nối với nhiều hệ điều h&agrave;nh</li>\r\n	<li>K&iacute;ch thước gọn nhẹ, tiện lợi dễ sử dụng</li>\r\n</ul>\r\n', 0, 0, 0, NULL, '2019-07-15 18:22:32', '2019-07-30 15:42:25'),
(16, 'USB HP 64 GB X730W 3.0', '', 549000, 100, 0, 'http://localhost:8080/eProject/admin/img/a15d8ef8bdba8308406a32ac180a5904_1564492753.jpg', 10, 1, '<ul>\r\n	<li>USB HP 16GB</li>\r\n	<li>Chuẩn giao tiếp USB 3.0</li>\r\n	<li>Model: x730W</li>\r\n	<li>Vỏ kim loại kh&ocirc;ng rỉ</li>\r\n	<li>Thương hiệu HP, ủy quyền do PNY Mỹ sản xuất</li>\r\n</ul>\r\n', 0, 0, 0, NULL, '2019-07-15 18:24:04', '2019-07-30 15:42:25'),
(17, 'USB Adata 3.0 UV128 16GB', '', 79000, 12, 0, 'http://localhost:8080/eProject/admin/img/128162_1_1564302037.jpg', 12, 1, '<ul>\r\n	<li>C&oacute; kiểu d&aacute;ng thiết kế nhỏ gọn, đẹp v&agrave; phong c&aacute;ch</li>\r\n	<li>Cổng USB chuẩn 3.0, tương th&iacute;ch với tất cả c&aacute;c hệ điều h&agrave;nh của m&aacute;y t&iacute;nh Windows Vista/XP/2000, Mac OS, Linux</li>\r\n	<li>Thiết kế nhỏ gọn, c&aacute;c g&oacute;c bo tr&ograve;n với hai m&agrave;u kết hợp một c&aacute;ch h&agrave;i h&ograve;a</li>\r\n</ul>\r\n', 0, 0, 0, -1, '2019-07-28 07:54:53', '2019-07-31 17:32:45'),
(19, 'USB ADATA UV250 16GB', '', 89000, 20, 0, 'http://localhost:8080/eProject/admin/img/b37ed5c0f9ef65117c3dbdba2f403608_1564302655.jpg', 12, 1, '<ul>\r\n	<li>Thiết kế kh&ocirc;ng nắp gọn g&agrave;ng, kiểu c&aacute;ch</li>\r\n	<li>Dung lượng 16GB</li>\r\n	<li>Chất liệu b&ecirc;n ngo&agrave;i bằng kim loại s&aacute;ng b&oacute;ng</li>\r\n	<li>Chuẩn USB: 2.0</li>\r\n	<li>K&iacute;ch thước (D x R x C): 42,4 x 14,95 x 5,35mm</li>\r\n	<li>Trọng lượng: 5,6g</li>\r\n	<li>Tương th&iacute;ch hệ điều h&agrave;nh: Windows XP, Vista, 7, 8, 8.1, 10, Mac OS X 10.6 hoặc cao hơn, Linux kernel 2.6 hoặc cao hơn, kh&ocirc;ng cần tr&igrave;nh điều khiển cho thiết bị</li>\r\n</ul>\r\n', 0, 0, 0, NULL, '2019-07-28 08:30:55', '2019-07-30 15:42:25'),
(22, 'USB Toshiba Yamabiko 128GB', '', 910000, 10, 0, 'http://localhost:8080/eProject/admin/img/522d0b808717de6a1de07e7ce1566a98_1564335240.jpg', 13, 1, '<ul>\r\n	<li>Đủ dung lượng cho h&agrave;ng trăm tập tin ph&acirc;n giải cao.</li>\r\n	<li>Dung lượng: 128GB</li>\r\n	<li>Tốc độ đọc l&ecirc;n tới 150MB / s</li>\r\n	<li>Sử dụng cho: PC &amp; MAC, điện thoại di động, m&aacute;y t&iacute;nh bảng</li>\r\n</ul>\r\n', 0, 0, 0, NULL, '2019-07-28 17:34:00', '2019-07-30 15:42:25'),
(23, 'USB 3.0 Teclast 32GB', '', 183000, 0, 0, 'http://localhost:8080/eProject/admin/img/5d00818cf9e1857881d8562a62f92d02_1564335914.jpg', 14, 1, '<ul>\r\n	<li>USB 3.0 nhanh gấp 4x lần so với USB 2.0</li>\r\n	<li>Dung lượng 32GB</li>\r\n	<li>Th&acirc;n kim loại chắc chắn</li>\r\n	<li>Thiết kế chống trượt</li>\r\n</ul>\r\n', 0, 0, 0, NULL, '2019-07-28 17:45:14', '2019-07-31 13:55:01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `temp`
--

CREATE TABLE `temp` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `temp`
--

INSERT INTO `temp` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'USB 3.0', '2019-07-18 13:27:59', '2019-07-18 13:27:59'),
(2, 'CD Rom', '2019-07-18 13:28:28', '2019-07-18 13:28:28'),
(3, 'SSD', '2019-07-18 13:28:40', '2019-07-18 13:28:40'),
(4, 'RAM', '2019-07-18 13:28:44', '2019-07-18 13:28:44'),
(5, 'USB 2.0', '2019-07-18 13:29:19', '2019-07-18 13:29:19');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `amount` int(11) DEFAULT NULL,
  `users_id` int(4) DEFAULT NULL,
  `status` tinyint(11) DEFAULT '0',
  `note` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `transaction`
--

INSERT INTO `transaction` (`id`, `amount`, `users_id`, `status`, `note`, `created_at`, `updated_at`) VALUES
(67, 1249000, 2, 0, '', '2019-07-27 14:54:21', '2019-07-28 06:05:49'),
(68, 1429000, 2, 0, '', '2019-07-27 14:54:57', '2019-07-28 06:06:42'),
(69, 1978000, 2, 0, '', '2019-07-27 14:56:36', '2019-07-28 06:06:01'),
(70, 720000, 2, 0, '', '2019-07-27 15:10:38', '2019-07-28 06:06:21'),
(71, 178000, 1, 0, 'Giao tan noi OK', '2019-07-29 12:33:51', '2019-07-31 17:32:45');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` char(15) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `token` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `address`, `password`, `dob`, `gender`, `status`, `token`, `created_at`, `updated_at`) VALUES
(1, 'Vu Ngoc Lan', 'darknight0188@gmail.com', '0976185572', 'Ha Noi', 'acce98c2d3f25ce94bd8af274dbfd14b', '1972-12-11', 'Female', 1, NULL, NULL, NULL),
(2, 'Tran Thanh Tung', 'thanhtung012@gmail.com', '01653221412', 'Ha Noi', '827ccb0eea8a706c4c34a16891f84e7b', '1996-09-10', 'Male', 1, NULL, NULL, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `oders`
--
ALTER TABLE `oders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_transaction_id` (`transaction_id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `temp`
--
ALTER TABLE `temp`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `oders`
--
ALTER TABLE `oders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `temp`
--
ALTER TABLE `temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `oders`
--
ALTER TABLE `oders`
  ADD CONSTRAINT `fk_transaction_id` FOREIGN KEY (`transaction_id`) REFERENCES `transaction` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
