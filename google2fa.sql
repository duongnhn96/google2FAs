-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 21, 2018 lúc 07:59 PM
-- Phiên bản máy phục vụ: 10.1.34-MariaDB
-- Phiên bản PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `google2fa`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `balance`
--

CREATE TABLE `balance` (
  `id` int(11) NOT NULL,
  `taikhoanchinh` decimal(19,4) NOT NULL,
  `tietkiem` decimal(19,4) NOT NULL,
  `chovay` decimal(19,4) NOT NULL,
  `username` varchar(30) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `balance`
--

INSERT INTO `balance` (`id`, `taikhoanchinh`, `tietkiem`, `chovay`, `username`) VALUES
(1, '8000.0000', '8000.0000', '200.0000', 'duong');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(23) NOT NULL,
  `username` varchar(45) COLLATE utf8_vietnamese_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_vietnamese_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_vietnamese_ci NOT NULL,
  `fullname` varchar(100) COLLATE utf8_vietnamese_ci NOT NULL,
  `secret_code` varchar(30) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `fullname`, `secret_code`) VALUES
(28, 'namduong', 'e014a1a6da1c1a11489cb6bb658372c190704eaa', 'namduong@gmail.com', 'namduong', 'PSDT6JN67J32YUOV'),
(29, 'duongnguyen', '4b3a581cb9a21f0b9102d7760fc2d393a21ec372', 'duongnguyen@gmail.com', 'Duong Nguyen', 'JXJLO6OLPLKCOGOK'),
(30, 'duongnguyen1', '8b963926f59c93f1685b2d7f8f8412a262a35f62', 'duongnguyen4@gmail.com', 'Duong Nguyen', 'HUIHCYQNZERB4ZZE'),
(31, 'duongnguyen12', '9a8e363a1ad68c58b3d77131dc398a5f06fb3ec5', 'duongnguyen42@gmail.com', 'Duong Nguyen', 'RFHXXZSOJLZXTXH2');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `balance`
--
ALTER TABLE `balance`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `balance`
--
ALTER TABLE `balance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(23) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
