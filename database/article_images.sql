-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-08-24 06:47:47
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
-- 資料庫： `project_db`
--

-- --------------------------------------------------------

--
-- 資料表結構 `article_images`
--

CREATE TABLE `article_images` (
  `id` int(11) NOT NULL,
  `article_id` int(30) NOT NULL,
  `article_images_thumbnail` varchar(500) NOT NULL,
  `article_images_title` varchar(500) NOT NULL,
  `	 article_video_title_url` varchar(500) NOT NULL,
  `	 article_images_main` varchar(500) NOT NULL,
  `	 article_images_content_1` varchar(500) NOT NULL,
  `	 article_images_content_2` varchar(500) NOT NULL,
  `article_images_content_3` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- 傾印資料表的資料 `article_images`
--

INSERT INTO `article_images` (`id`, `article_id`, `article_images_thumbnail`, `article_images_title`, `	 article_video_title_url`, `	 article_images_main`, `	 article_images_content_1`, `	 article_images_content_2`, `article_images_content_3`) VALUES
(2, 4, '', '', '', '', '', '', ''),
(3, 5, 'article_images/article_images_thumbnail_4.png', 'article_images/article_images_title_4.png', '', '', '', '', ''),
(4, 6, 'article_images/article_images_thumbnail_5.png', 'article_images/article_images_title_5.png', '', '', '', '', ''),
(5, 7, 'article_images/article_images_thumbnail_6.png', 'article_images/article_images_title_6.png', '', '', '', '', ''),
(6, 8, 'article_images/article_images_thumbnail_7.png', 'article_images/article_images_title_7.png', '', '', '', '', ''),
(7, 9, 'article_images/article_images_thumbnail_8.png', '', 'https://www.youtube.com/watch?v=vuENa3dBo-U', '', '', '', ''),
(8, 13, 'article_images/article_images_thumbnail_12.png', 'article_images/article_images_title_12.png', '', '', '', '', ''),
(9, 14, 'article_images/article_images_thumbnail_13.png', 'article_images/article_images_title_13.png', '', '', '', '', ''),
(10, 15, 'article_images/article_images_thumbnail_14.png', 'article_images/article_images_title_14.png', '', '', '', '', ''),
(11, 16, 'article_images/article_images_thumbnail_15.png', '', 'https://youtu.be/MrARonNVYMA', '', '', '', ''),
(12, 17, 'article_images/article_images_thumbnail_16.png', 'article_images/article_images_title_16.png', '', '', '', '', ''),
(13, 18, 'article_images/article_images_thumbnail_17.png', 'article_images/article_images_title_17.png', '', '', '', '', ''),
(14, 19, 'article_images/article_images_thumbnail_18.png', '', 'https://youtu.be/_7G-tpIEuwQ', '', '', '', ''),
(15, 20, 'article_images/article_images_thumbnail_19.png', 'article_images/article_images_title_19.png', '', '', '', '', ''),
(16, 21, 'article_images/article_images_thumbnail_20.png', 'article_images/article_images_title_20.png', '', '', '', '', ''),
(17, 22, 'article_images/article_images_thumbnail_21.png', 'article_images/article_images_title_21.png', 'https://youtu.be/HqzblQCfWpY', '', 'article_images/article_images_content_21.png', '', ''),
(18, 23, 'article_images/article_images_thumbnail_22.png', 'article_images/article_images_title_22.png', '', '', '', '', ''),
(19, 24, 'article_images/article_images_thumbnail_23.png', 'article_images/article_images_title_23.png', '', '', '', '', ''),
(20, 25, '', '', '', '', '', '', ''),
(21, 26, 'article_images/article_images_thumbnail_25.png', 'article_images/article_images_title_25.png', '', '', '', '', ''),
(22, 27, 'article_images/article_images_thumbnail_26.png', '', 'https://youtu.be/LXAmxz1PXwE', '', '', '', ''),
(23, 28, 'article_images/article_images_thumbnail_27.png', 'article_images/article_images_title_27.png', '', '', '', '', ''),
(24, 29, 'article_images/article_images_thumbnail_28.png', 'article_images/article_images_title_28.png', '', 'article_images/article_images_content_28.png', '', '', ''),
(25, 30, 'article_images/article_images_thumbnail_29.png', 'article_images/article_images_title_29.png', '', 'article_images/article_images_main_29.png', 'article_images/article_images_content_1_29', 'article_images/article_images_content_2_29', ''),
(26, 31, 'article_images/article_images_thumbnail_30.png', 'article_images/article_images_title_30.png', '', '', '', '', ''),
(27, 32, 'article_images/article_images_thumbnail_31.png', 'article_images/article_images_title_31.png', '', '', '', '', ''),
(28, 33, 'article_images/article_images_thumbnail_32.png', 'article_images/article_images_title_32.png', '', '', '', '', ''),
(29, 34, 'article_images/article_images_thumbnail_33.png', 'article_images/article_images_title_33.png', '', 'article_images/article_images_main_33.png', 'article_images/article_images_content_1_33.png', '', ''),
(30, 35, 'article_images/article_images_thumbnail_34.png', '', 'https://youtu.be/q6SEdT7jaLw', '', '', '', ''),
(31, 36, 'article_images/article_images_thumbnail_35.png', 'article_images/article_images_title_35.png', '', 'article_images/article_images_main_35.png', 'article_images/article_images_content_1_35.png', '', ''),
(32, 37, 'article_images/article_images_thumbnail_36.png', 'article_images/article_images_title_36.png', '', '', '', '', ''),
(33, 38, 'article_images/article_images_thumbnail_37.png', 'article_images/article_images_title_37.png', '', '', '', '', ''),
(34, 39, 'article_images/article_images_thumbnail_38.png', 'article_images/article_images_title_38.png', '', '', '', '', ''),
(35, 40, 'article_images/article_images_thumbnail_39.png', 'article_images/article_images_title_39.png', '', '', '', '', ''),
(36, 41, 'article_images/article_images_thumbnail_40.png', 'article_images/article_images_title_40.png', '', 'article_images/article_images_main_40.png', '', '', ''),
(37, 42, 'article_images/article_images_thumbnail_41.png', 'article_images/article_images_title_41.png', '', '', '', '', ''),
(38, 43, 'article_images/article_images_thumbnail_42.png', 'article_images/article_images_title_42.png', '', '', '', '', ''),
(39, 44, 'article_images/article_images_thumbnail_43.png', 'article_images/article_images_title_43.png', '', '', '', '', ''),
(40, 45, 'article_images/article_images_thumbnail_44.png', 'article_images/article_images_title_44.png', '', '', '', '', ''),
(41, 46, 'article_images/article_images_thumbnail_45.png', 'article_images/article_images_title_45.png', '', '', '', '', ''),
(42, 47, 'article_images/article_images_thumbnail_46.png', 'article_images/article_images_title_46.png', '', '', '', '', ''),
(43, 48, 'article_images/article_images_thumbnail_47.png', 'article_images/article_images_title_47.png', '', '', '', '', ''),
(44, 49, '', '', '', '', '', '', ''),
(45, 50, '', '', '', '', '', '', ''),
(46, 51, '', '', '', '', '', '', ''),
(47, 52, 'article_images/article_images_thumbnail_51.png', 'article_images/article_images_title_51.png', '', '', '', '', ''),
(48, 53, 'article_images/article_images_thumbnail_52.png', 'article_images/article_images_title_52.png', '', '', '', '', ''),
(49, 54, 'article_images/article_images_thumbnail_53.png', 'article_images/article_images_title_53.png', 'https://youtu.be/0tRLn5q3-48', '', '', '', ''),
(50, 55, 'article_images/article_images_thumbnail_54.png', 'article_images/article_images_title_54.png', '', '', '', '', ''),
(51, 56, 'article_images/article_images_thumbnail_55.png', 'article_images/article_images_title_55.png', '', '', '', '', ''),
(52, 57, 'article_images/article_images_thumbnail_56.png', 'article_images/article_images_title_56.png', '', '', '', '', ''),
(53, 58, 'article_images/article_images_thumbnail_57.png', 'article_images/article_images_title_57.png', '', '', '', '', ''),
(54, 59, 'article_images/article_images_thumbnail_58.png', 'article_images/article_images_title_58.png', '', '', '', '', ''),
(55, 60, 'article_images/article_images_thumbnail_59.png', 'article_images/article_images_title_59.png', '', '', '', '', ''),
(56, 61, 'article_images/article_images_thumbnail_60.png', 'article_images/article_images_title_60.png', '', '', '', '', ''),
(57, 62, '', '', '', '', '', '', ''),
(58, 63, '', '', '', '', '', '', ''),
(59, 64, '', '', '', '', '', '', ''),
(60, 65, '', '', '', '', '', '', ''),
(61, 66, '', '', '', '', '', '', ''),
(62, 67, '', '', '', '', '', '', ''),
(63, 68, 'article_images/article_images_thumbnail_67.png', 'article_images/article_images_title_67.png', '', '', '', '', ''),
(64, 69, 'article_images/article_images_thumbnail_68.png', 'article_images/article_images_title_68.png', '', '', '', '', ''),
(65, 70, 'article_images/article_images_thumbnail_69.png', 'article_images/article_images_title_69.png', '', '', '', '', ''),
(66, 71, 'article_images/article_images_thumbnail_70.png', 'article_images/article_images_title_70.png', '', '', '', '', ''),
(67, 72, 'article_images/article_images_thumbnail_71.png', 'article_images/article_images_title_71.png', '', '', '', '', ''),
(68, 73, 'article_images/article_images_thumbnail_72.png', 'article_images/article_images_title_72.png', '', '', '', '', ''),
(69, 74, 'article_images/article_images_thumbnail_73.png', 'article_images/article_images_title_73.png', '', '', '', '', ''),
(70, 75, 'article_images/article_images_thumbnail_74.png', 'article_images/article_images_title_74.png', '', '', '', '', ''),
(71, 76, 'article_images/article_images_thumbnail_75.png', 'article_images/article_images_title_75.png', '', '', '', '', ''),
(72, 77, 'article_images/article_images_thumbnail_76.png', 'article_images/article_images_title_76.png', '', '', '', '', ''),
(73, 78, 'article_images/article_images_thumbnail_77.png', 'article_images/article_images_title_77.png', '', '', '', '', ''),
(74, 79, 'article_images/article_images_thumbnail_78.png', 'article_images/article_images_title_78.png', '', '', '', '', ''),
(75, 80, 'article_images/article_images_thumbnail_79.png', 'article_images/article_images_title_79.png', '', '', '', '', ''),
(76, 81, 'article_images/article_images_thumbnail_80.png', 'article_images/article_images_title_80.png', '', '', '', '', ''),
(77, 82, 'article_images/article_images_thumbnail_81.png', 'article_images/article_images_title_81.png', '', '', '', '', ''),
(78, 83, 'article_images/article_images_thumbnail_82.png', 'article_images/article_images_title_82.png', '', '', '', '', ''),
(79, 84, 'article_images/article_images_thumbnail_83.png', 'article_images/article_images_title_83.png', '', '', '', '', ''),
(80, 85, 'article_images/article_images_thumbnail_84.png', 'article_images/article_images_title_84.png', 'https://youtu.be/XTsXZjEj3FY', '', '', '', ''),
(81, 86, '', '', '', '', '', '', ''),
(82, 87, '', '', '', '', '', '', ''),
(83, 88, 'article_images/article_images_thumbnail_87.png', 'article_images/article_images_title_87.png', '', '', '', '', ''),
(84, 89, 'article_images/article_images_thumbnail_88.png', 'article_images/article_images_title_88.png', '', '', '', '', ''),
(85, 90, 'article_images/article_images_thumbnail_89.png', 'article_images/article_images_title_89.png', '', '', '', '', ''),
(86, 91, 'article_images/article_images_thumbnail_90.png', 'article_images/article_images_title_90.png', '', '', '', '', ''),
(87, 92, 'article_images/article_images_thumbnail_91.png', 'article_images/article_images_title_91.png', 'https://youtu.be/7UzbiNvs1LU', '', '', '', ''),
(88, 93, 'article_images/article_images_thumbnail_92.png', 'article_images/article_images_title_92.png', '', '', '', '', ''),
(89, 94, 'article_images/article_images_thumbnail_93.png', 'article_images/article_images_title_93.png', '', '', '', '', ''),
(90, 95, 'article_images/article_images_thumbnail_94.png', 'article_images/article_images_title_94.png', '', '', '', '', ''),
(91, 96, '', '', 'https://scontent.ftpe8-4.fna.fbcdn.net/v/t42.1790-2/17069093_1101720943271024_3063533823582011392_n.mp4?_nc_cat=104&ccb=1-7&_nc_sid=55d0d3&efg=eyJybHIiOjMwMCwicmxhIjo1MTIsInZlbmNvZGVfdGFnIjoic3ZlX3NkI', '', '', '', ''),
(92, 97, 'article_images/article_images_thumbnail_96.png', 'article_images/article_images_title_96.png', '', '', '', '', ''),
(93, 98, 'article_images/article_images_thumbnail_97.png', 'article_images/article_images_title_97.png', '', '', '', '', ''),
(94, 99, 'article_images/article_images_thumbnail_98.png', '', 'https://youtu.be/bZJlTMg-Epw', '', '', '', ''),
(95, 100, 'article_images/article_images_thumbnail_99.png', 'article_images/article_images_title_99.png', '', 'article_images/article_images_main_99.png', 'article_images/article_images_content_1_99.png', 'article_images/article_images_content_2_99.png', ''),
(96, 101, 'article_images/article_images_thumbnail_100.png', 'article_images/article_images_title_100.png', '', 'article_images/article_images_main_100.png', '', '', ''),
(97, 102, 'article_images/article_images_thumbnail_101.png', 'article_images/article_images_title_101.png', 'https://youtu.be/ij5p-BSsds8', '', '', '', ''),
(98, 103, 'article_images/article_images_thumbnail_102.png', 'article_images/article_images_title_102.png', '', '', '', '', ''),
(99, 104, 'article_images/article_images_thumbnail_103.png', 'article_images/article_images_title_103.png', '', '', '', '', ''),
(100, 105, 'article_images/article_images_thumbnail_104.png', 'article_images/article_images_title_104.png', '', '', '', '', ''),
(101, 106, 'article_images/article_images_thumbnail_105.png', 'article_images/article_images_title_105.png', '', '', '', '', ''),
(102, 107, 'article_images/article_images_thumbnail_106.png', 'article_images/article_images_title_106.png', '', '', '', '', ''),
(103, 108, 'article_images/article_images_thumbnail_107.png', 'article_images/article_images_title_107.png', '', '', '', '', ''),
(104, 109, 'article_images/article_images_thumbnail_108.png', 'article_images/article_images_title_108.png', '', '', '', '', ''),
(105, 110, 'article_images/article_images_thumbnail_109.png', 'article_images/article_images_title_109.png', '', '', '', '', ''),
(106, 111, 'article_images/article_images_thumbnail_110.png', 'article_images/article_images_title_110.png', '', 'article_images/article_images_main_110.png', 'article_images/article_images_content_1_10.png', '', ''),
(107, 112, 'article_images/article_images_thumbnail_111.png', 'article_images/article_images_title_111.png', '', '', '', '', ''),
(108, 113, 'article_images/article_images_thumbnail_112.png', 'article_images/article_images_title_112.png', '', '', '', '', ''),
(109, 114, 'article_images/article_images_thumbnail_113.png', 'article_images/article_images_title_113.png', '', '', '', '', ''),
(110, 115, 'article_images/article_images_thumbnail_114.png', 'article_images/article_images_title_114.png', '', '', '', '', ''),
(111, 116, 'article_images/article_images_thumbnail_115.png', 'article_images/article_images_title_115.png', '', '', '', '', ''),
(112, 117, 'article_images/article_images_thumbnail_116.png', 'article_images/article_images_title_116.png', '', '', '', '', ''),
(113, 118, 'article_images/article_images_thumbnail_117.png', 'article_images/article_images_title_117.png', '', '', '', '', ''),
(114, 119, 'article_images/article_images_thumbnail_118.png', 'article_images/article_images_title_118.png', '', '', '', '', ''),
(115, 120, 'article_images/article_images_thumbnail_119.png', 'article_images/article_images_title_119.png', '', '', '', '', ''),
(116, 121, 'article_images/article_images_thumbnail_120.png', 'article_images/article_images_title_120.png', '', '', '', '', ''),
(117, 122, 'article_images/article_images_thumbnail_121.png', 'article_images/article_images_title_121.png', '', '', '', '', ''),
(118, 123, 'article_images/article_images_thumbnail_122.png', 'article_images/article_images_title_122.png', '', 'article_images/article_images_main_122.png', 'article_images/article_images_content_1_122.png', 'article_images/article_images_content_2_122.png', ''),
(119, 124, 'article_images/article_images_thumbnail_123.png', 'article_images/article_images_title_123.png', '', '', '', '', ''),
(120, 125, 'article_images/article_images_thumbnail_124.png', 'article_images/article_images_title_124.png', '', '', '', '', ''),
(121, 126, 'article_images/article_images_thumbnail_125.png', 'article_images/article_images_title_125.png', '', '', '', '', ''),
(122, 127, 'article_images/article_images_thumbnail_126.png', 'article_images/article_images_title_126.png', '', '', '', '', ''),
(123, 128, 'article_images/article_images_thumbnail_127.png', 'article_images/article_images_title_127.png', '', '', '', '', ''),
(124, 129, 'article_images/article_images_thumbnail_128.png', 'article_images/article_images_title_128.png', '', '', '', '', ''),
(125, 130, 'article_images/article_images_thumbnail_129.png', 'article_images/article_images_title_129.png', '', 'article_images/article_images_main_129.png', '', '', ''),
(126, 131, 'article_images/article_images_thumbnail_130.png', 'article_images/article_images_title_130.png', '', '', '', '', ''),
(127, 132, 'article_images/article_images_thumbnail_131.png', 'article_images/article_images_title_131.png', '', '', '', '', ''),
(128, 133, 'article_images/article_images_thumbnail_132.png', 'article_images/article_images_title_132.png', '', '', '', '', ''),
(129, 134, 'article_images/article_images_thumbnail_133.png', 'article_images/article_images_title_133.png', '', '', '', '', ''),
(130, 135, 'article_images/article_images_thumbnail_134.png', 'article_images/article_images_title_134.png', '', '', '', '', ''),
(131, 136, 'article_images/article_images_thumbnail_135.png', 'article_images/article_images_title_135.png', '', '', '', '', ''),
(132, 137, 'article_images/article_images_thumbnail_136.png', 'article_images/article_images_title_136.png', '', '', '', '', ''),
(133, 138, 'article_images/article_images_thumbnail_137.png', 'article_images/article_images_title_137.png', '', '', '', '', ''),
(134, 139, 'article_images/article_images_thumbnail_138.png', 'article_images/article_images_title_138.png', '', '', '', '', ''),
(135, 140, 'article_images/article_images_thumbnail_139.png', 'article_images/article_images_title_139.png', '', '', '', '', ''),
(136, 141, 'article_images/article_images_thumbnail_140.png', 'article_images/article_images_title_140.png', '', '', '', '', ''),
(137, 142, 'article_images/article_images_thumbnail_141.png', 'article_images/article_images_title_141.png', '', '', '', '', ''),
(138, 143, 'article_images/article_images_thumbnail_142.png', 'article_images/article_images_title_142.png', '', '', '', '', ''),
(139, 144, 'article_images/article_images_thumbnail_143.png', 'article_images/article_images_title_143.png', '', '', '', '', ''),
(140, 145, 'article_images/article_images_thumbnail_144.png', 'article_images/article_images_title_144.png', '', '', '', '', ''),
(141, 146, '', '', '', '', '', '', ''),
(142, 147, 'article_images/article_images_thumbnail_146.png', 'article_images/article_images_title_146.png', '', '', '', '', ''),
(143, 148, 'article_images/article_images_thumbnail_147.png', 'article_images/article_images_title_147.png', '', '', '', '', ''),
(144, 149, 'article_images/article_images_thumbnail_148.png', 'article_images/article_images_title_148.png', '', '', '', '', ''),
(145, 150, 'article_images/article_images_thumbnail_149.png', 'article_images/article_images_title_149.png', '', '', '', '', ''),
(146, 151, 'article_images_thumbnail_150.png', 'article_images_title_150.png', '', '', '', '', ''),
(147, 152, 'article_images/article_images_thumbnail_151.png', 'article_images/article_images_title_151.png', '', '', '', '', ''),
(148, 153, 'article_images/article_images_thumbnail_152.png', 'article_images/article_images_title_152.png', '', '', '', '', ''),
(149, 154, 'article_images/article_images_thumbnail_153.png', 'article_images/article_images_title_153.png', '', '', '', '', ''),
(150, 155, 'article_images/article_images_thumbnail_154.png', 'article_images/article_images_title_154.png', '', '', '', '', ''),
(151, 156, 'article_images/article_images_thumbnail_155.png', 'article_images/article_images_title_155.png', '', '', '', '', ''),
(152, 157, 'article_images/article_images_thumbnail_156.png', 'article_images/article_images_title_156.png', '', '', '', '', ''),
(153, 158, 'article_images/article_images_thumbnail_157.png', 'article_images/article_images_title_157.png', '', '', '', '', ''),
(154, 159, 'article_images/article_images_thumbnail_158.png', 'article_images/article_images_title_158.png', '', '', '', '', ''),
(155, 160, 'article_images/article_images_thumbnail_159.png', 'article_images/article_images_title_159.png', '', '', '', '', ''),
(156, 161, 'article_images/article_images_thumbnail_160.png', 'article_images/article_images_title_160.png', '', '', '', '', ''),
(157, 162, 'article_images/article_images_thumbnail_161.png', 'article_images/article_images_title_161.png', '', '', '', '', ''),
(158, 163, 'article_images/article_images_thumbnail_162.png', 'article_images/article_images_title_162.png', '', '', '', '', ''),
(159, 164, 'article_images/article_images_thumbnail_163.png', 'article_images/article_images_title_163.png', '', '', '', '', ''),
(160, 165, 'article_images/article_images_thumbnail_164.png', 'article_images/article_images_title_164.png', '', '', '', '', ''),
(161, 166, 'article_images/article_images_thumbnail_165.png', 'article_images/article_images_title_165.png', '', '', '', '', ''),
(162, 167, 'article_images/article_images_thumbnail_166.png', 'article_images/article_images_title_166.png', '', '', '', '', ''),
(163, 168, 'article_images/article_images_thumbnail_167.png', 'article_images/article_images_title_167.png', '', '', '', '', ''),
(164, 169, 'article_images/article_images_thumbnail_168.png', 'article_images/article_images_title_168.png', '', '', '', '', ''),
(165, 170, 'article_images/article_images_thumbnail_169.png', 'article_images/article_images_title_169.png', '', '', '', '', ''),
(166, 171, 'article_images/article_images_thumbnail_170.png', 'article_images/article_images_title_170.png', '', '', '', '', ''),
(167, 172, 'article_images/article_images_thumbnail_171.png', 'article_images/article_images_title_171.png', '', '', '', '', ''),
(168, 173, 'article_images/article_images_thumbnail_172.png', 'article_images/article_images_title_172.png', '', '', '', '', ''),
(169, 174, '', '', '', '', '', '', ''),
(170, 175, '', '', '', '', '', '', ''),
(171, 176, 'article_images_thumbnail_175.png', 'article_images_title_175.png', '', '', '', '', ''),
(172, 177, 'article_images_thumbnail_176.png', 'article_images_title_176.png', '', '', '', '', ''),
(173, 178, 'article_images_thumbnail_177.png', 'article_images_title_177.png', '', '', '', '', ''),
(174, 179, 'article_images_thumbnail_178.png', 'article_images_title_178.png', '', '', '', '', ''),
(175, 180, 'article_images_thumbnail_179.png', 'article_images_title_179.png', '', '', '', '', ''),
(176, 181, 'article_images_thumbnail_180.png', 'article_images_title_180.png', '', '', '', '', ''),
(177, 182, 'article_images_thumbnail_181.png', 'article_images_title_181.png', '', '', '', '', ''),
(178, 183, 'article_images_thumbnail_182.png', 'article_images_title_182.png', '', '', '', '', ''),
(179, 184, 'article_images_thumbnail_183.png', 'article_images_title_183.png', '', '', '', '', ''),
(180, 185, 'article_images_thumbnail_184.png', 'article_images_title_184.png', '', '', '', '', ''),
(181, 186, 'article_images_thumbnail_185.png', 'article_images_title_185.png', '', '', '', '', ''),
(182, 187, 'article_images_thumbnail_186.png', 'article_images_title_186.png', 'https://youtu.be/ukrnCwcLvV8', '', '', '', ''),
(183, 188, 'article_images_thumbnail_187.png', 'article_images_title_187.png', '', '', '', '', ''),
(184, 189, 'article_images_thumbnail_188.png', 'article_images_title_188.png', '', '', '', '', ''),
(185, 190, 'article_images/480_2024-08-24.webp', '', '', '', '', '', ''),
(186, 191, '', '', '', 'article_images/o202407151707274413_2024-08-24.jpg', '', '', ''),
(187, 192, '', '', '', '', '', '', ''),
(188, 0, '', '', '', '', '', '', ''),
(189, 0, '', '', '', '', '', '', ''),
(190, 0, '', '', '', '', '', '', ''),
(191, 0, '', '', '', '', '', '', ''),
(192, 0, '', '', '', '', '', '', ''),
(193, 0, '', '', '', '', '', '', ''),
(194, 0, '', '', '', '', '', '', ''),
(195, 0, '', '', '', '', '', '', ''),
(196, 0, '', '', '', '', '', '', ''),
(197, 0, '', '', '', '', '', '', ''),
(198, 0, '', '', '', '', '', '', ''),
(199, 0, '', '', '', '', '', '', ''),
(200, 0, '', '', '', '', '', '', ''),
(201, 0, '', '', '', '', '', '', ''),
(202, 0, '', '', '', '', '', '', ''),
(203, 0, '', '', '', '', '', '', ''),
(204, 0, '', '', '', '', '', '', ''),
(205, 0, '', '', '', '', '', '', ''),
(206, 0, '', '', '', '', '', '', ''),
(207, 0, '', '', '', '', '', '', ''),
(208, 0, '', '', '', '', '', '', ''),
(209, 0, '', '', '', '', '', '', ''),
(210, 0, '', '', '', '', '', '', ''),
(211, 0, '', '', '', '', '', '', ''),
(212, 0, '', '', '', '', '', '', ''),
(213, 0, '', '', '', '', '', '', ''),
(214, 0, '', '', '', '', '', '', ''),
(215, 0, '', '', '', '', '', '', ''),
(216, 0, '', '', '', '', '', '', ''),
(217, 0, '', '', '', '', '', '', ''),
(218, 0, '', '', '', '', '', '', ''),
(219, 0, '', '', '', '', '', '', '');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `article_images`
--
ALTER TABLE `article_images`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `article_images`
--
ALTER TABLE `article_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=220;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
