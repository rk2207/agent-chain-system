-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 24, 2017 at 11:11 AM
-- Server version: 5.5.57-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tree`
--

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE IF NOT EXISTS `agents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `agent_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sponsor_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pair_id` int(11) DEFAULT NULL,
  `leg` enum('Left','Right') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Left',
  `depth_level` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=43 ;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`id`, `agent_code`, `sponsor_code`, `pair_id`, `leg`, `depth_level`) VALUES
(1, '1272129311', '0', 0, 'Left', 0),
(13, '1377239554', '1349404179', 1, 'Right', 2),
(12, '1262896469', '1349404179', 2, 'Left', 2),
(11, '1132897697', '1307938503', 1, 'Right', 2),
(10, '1374219722', '1307938503', 2, 'Left', 2),
(9, '1349404179', '1272129311', 1, 'Right', 1),
(8, '1307938503', '1272129311', 2, 'Left', 1),
(14, '1268069415', '1377239554', 1, 'Left', 3),
(15, '1198376060', '1377239554', 2, 'Right', 3),
(16, '1188449843', '1272129311', 3, 'Left', 1),
(17, '1184846115', '1272129311', 4, 'Right', 1),
(18, '1179746156', '1188449843', 1, 'Left', 2),
(19, '1329195935', '1188449843', 2, 'Right', 2),
(20, '1228118217', '1184846115', 1, 'Left', 2),
(21, '1192546232', '1184846115', 2, 'Right', 2),
(22, '1351092001', '1262896469', 1, 'Left', 3),
(23, '1372632257', '1262896469', 2, 'Right', 3),
(24, '1215619212', '1179746156', 1, 'Left', 3),
(25, '1371637810', '1179746156', 2, 'Right', 3),
(26, '1249476005', '1329195935', 1, 'Left', 3),
(27, '1292401419', '1329195935', 2, 'Right', 3),
(28, '1313914305', '1228118217', 1, 'Left', 3),
(29, '1145944103', '1228118217', 2, 'Right', 3),
(30, '1220700924', '1192546232', 1, 'Left', 3),
(31, '1154802887', '1192546232', 2, 'Right', 3),
(32, '1311633464', '1132897697', 1, 'Left', 3),
(33, '1392475567', '1132897697', 2, 'Right', 3),
(34, '1291625934', '1374219722', 1, 'Left', 3),
(35, '1196898075', '1374219722', 2, 'Right', 3),
(36, '9092703134', '1377239554', 3, 'Left', 3),
(39, '1503744518', '9092703134', 1, 'Left', 4),
(40, '1503744520', '9092703134', 2, 'Right', 4),
(41, '2742255872', '1374219722', 3, 'Left', 3),
(42, '9781228361', '1377239554', 4, 'Right', 3);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
