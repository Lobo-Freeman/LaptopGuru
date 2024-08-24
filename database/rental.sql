-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-08-21 20:07:29
-- 伺服器版本： 10.4.32-MariaDB
-- PHP 版本： 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `my_test_db`
--

-- --------------------------------------------------------

--
-- 資料表結構 `rental`
--

CREATE TABLE `rental` (
  `id` int(50) UNSIGNED NOT NULL,
  `images` varchar(50) NOT NULL,
  `model` varchar(200) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `price` int(100) UNSIGNED NOT NULL,
  `num` int(50) UNSIGNED NOT NULL,
  `state` varchar(20) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `rental`
--

INSERT INTO `rental` (`id`, `images`, `model`, `brand`, `price`, `num`, `state`, `user_id`, `created_at`) VALUES
(1, 'Vector 16 HX A14VHG-638TW.png', 'Vector 16 HX A14VHG-638TW', 'MSI', 1000, 1, 'No', '1', '2024-08-21 11:58:04'),
(2, '1724257001.png', '34569', 'MSI', 100, 1, 'No', '1', '2024-08-21 18:16:41'),
(3, '1724263605.png', 'Stealth 16 MercedesAMG A1VGG-263TW', 'MSI', 1000, 1, 'available', '2', '2024-08-21 20:06:45'),
(4, '1724263595.png', 'Stealth 18 AI Studio A1VHG-014TW', 'MSI', 200, 1, 'available', '2', '2024-08-21 20:06:35'),
(5, '1724256662.png', 'Raider 18 HX A14VIG-222TW', 'MSI', 5000, 1, 'available', '2', '2024-08-21 18:11:02'),
(7, 'Cyborg 14 A13VF-026TW.png', 'msi', 'MSI', 1500, 84, 'available', '', '2024-08-21 13:33:13'),
(8, 'Cyborg 15 A13VFK-831TW.png', '0', 'MSI', 1500, 84, 'available', '', '2024-08-21 13:34:05'),
(9, 'Cyborg 15 A12VE-054TW.png', '3', 'MSI', 1500, 84, 'available', '', '2024-08-21 13:34:20'),
(10, 'Katana A15 AI B8VF-433TW.png', '7', 'MSI', 1500, 84, 'available', '', '2024-08-21 13:34:28'),
(11, 'Cyborg 15 AI A1VEK-015TW.png', '0000', 'MSI', 100, 84, 'available', '', '2024-08-21 13:30:22'),
(13, 'Cyborg 15 A13VFK-831TW.png', '55', 'MSI', 100, 84, 'available', '', '2024-08-21 13:32:39'),
(14, 'Katana 15 B13VFK-1471TW.png', '888', 'MSI', 100, 84, 'available', '', '2024-08-21 13:29:34'),
(15, 'Cyborg 15 A12VE-054TW.png', '456', 'MSI', 1500, 84, 'available', '', '2024-08-21 14:50:35'),
(16, '', '6', 'MSI', 1000, 84, 'available', '', '2024-08-21 16:17:39'),
(17, '', '8', 'MSI', 1000, 84, 'available', '', '2024-08-21 16:38:35'),
(18, '', '9', 'MSI', 1000, 84, 'available', '', '2024-08-21 16:38:44'),
(19, '', '10', 'MSI', 500, 84, 'available', '', '2024-08-21 17:08:01'),
(20, '1724255958.png', 'vv3', 'MSI', 1000, 282, 'available', '', '2024-08-21 18:16:55'),
(21, '1724255958.png', '000000', 'MSI', 1000, 282, 'available', '', '2024-08-21 18:17:52'),
(22, '1724256662.png', '300', 'MSI', 1200, 84, 'available', '', '2024-08-21 18:18:16'),
(23, '1724255958.png', 'm666', 'ROG', 1200, 20, 'available', '', '2024-08-21 20:02:03');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `rental`
--
ALTER TABLE `rental`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `rental`
--
ALTER TABLE `rental`
  MODIFY `id` int(50) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
