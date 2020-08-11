-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 11, 2020 at 04:04 AM
-- Server version: 5.7.31-0ubuntu0.18.04.1-log
-- PHP Version: 7.2.24-0ubuntu0.18.04.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `modern_kranji`
--

-- --------------------------------------------------------

--
-- Table structure for table `available_status`
--

CREATE TABLE `available_status` (
  `id` int(11) NOT NULL,
  `name` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `available_status`
--

INSERT INTO `available_status` (`id`, `name`, `created_at`, `update_at`, `status`) VALUES
(1, 'Reserved', '2019-09-11 03:40:50', '2019-09-11 03:40:50', 1),
(2, 'Booked', '2019-09-11 03:40:50', '2019-09-11 03:40:50', 1),
(3, 'Sold Out', '2019-09-11 03:41:20', '2019-09-11 03:41:20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `id` int(11) NOT NULL,
  `bank_bi_code` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `bank_sbn_code` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id`, `bank_bi_code`, `name`, `bank_sbn_code`) VALUES
(1, 14, 'BANK BCA', 47),
(2, 9, 'BANK BNI', 44),
(3, 2, 'BANK BRI', 42),
(4, 8, 'BANK MANDIRI', 43),
(5, 3, 'BANK EKSPOR INDONESIA', NULL),
(6, 11, 'BANK DANAMON', 45),
(7, 13, 'PERMATA BANK', 46),
(8, 16, 'BANK BII', 48),
(9, 19, 'BANK PANIN', 49),
(10, 20, 'BANK ARTA NIAGA KENCANA', NULL),
(11, 22, 'BANK CIMB NIAGA', 50),
(12, 23, 'BANK UOB INDONESIA', 51),
(13, 26, 'BANK LIPPO', NULL),
(14, 28, 'OCBC NISP', 52),
(15, 30, 'AMERICAN EXPRESS BANK LTD', NULL),
(16, 31, 'CITIBANK', 53),
(17, 32, 'JP. MORGAN CHASE BANK, N.A.', 54),
(18, 33, 'BANK OF AMERICA, N.A', 55),
(19, 34, 'ING INDONESIA BANK', NULL),
(20, 36, 'BANK WINDU', 56),
(21, 37, 'BANK ARTHA GRAHA', 57),
(22, 39, 'BANK CREDIT AGRICOLE INDOSUEZ', NULL),
(23, 40, 'THE BANGKOK BANK COMP. LTD', 58),
(24, 41, 'HSBC', 59),
(25, 42, 'BOTM', 60),
(26, 45, 'BANK SUMITOMO MITSUI INDONESIA', 61),
(27, 46, 'BANK DBS INDONESIA', 62),
(28, 47, 'BANK RESONA PERDANIA', 63),
(29, 48, 'BANK MIZUHO INDONESIA', 64),
(30, 50, 'STANDARD CHARTERED', 65),
(31, 52, 'BANK ABN AMRO', 66),
(32, 53, 'BANK KEPPEL TATLEE BUANA', NULL),
(33, 54, 'BANK CAPITAL INDONESIA', 67),
(34, 57, 'BANK BNP PARIBAS INDONESIA', 68),
(35, 58, 'BANK UOB INDONESIA', NULL),
(36, 59, 'KOREA EXCHANGE BANK DANAMON', 69),
(37, 60, 'RABOBANK INTERNASIONAL INDONESIA', NULL),
(38, 61, 'ANZ', 70),
(39, 67, 'DEUTSCHE BANK AG.', 71),
(40, 68, 'BANK WOORI INDONESIA', 72),
(41, 69, 'BOC INDONESIA', 73),
(42, 76, 'BANK BUMI ARTA', 74),
(43, 87, 'BANK EKONOMI', 75),
(44, 88, 'BANK ANTAR DAERAH', 76),
(45, 89, 'RABOBANK', 77),
(46, 93, 'BANK IFI', NULL),
(47, 95, 'BANK MUTIARA', 78),
(48, 97, 'BANK MAYAPADA', 79),
(49, 110, 'BANK BJB', 80),
(50, 111, 'BANK DKI', 81),
(51, 112, 'BPD DIY', 82),
(52, 113, 'BANK JATENG', 83),
(53, 114, 'BANK JATIM', 84),
(54, 115, 'BANK JAMBI', 85),
(55, 116, 'BPD ACEH', 86),
(56, 117, 'BANK SUMUT', 87),
(57, 118, 'BANK NAGARI', 88),
(58, 119, 'BANK RIAU', 89),
(59, 120, 'BANK SUMSEL', 90),
(60, 121, 'BANK LAMPUNG', 91),
(61, 122, 'BPD KALSEL', 92),
(62, 123, 'BANK KALBAR', 93),
(63, 124, 'BPD KALTIM', 94),
(64, 125, 'BPD KALTENG', 95),
(65, 126, 'BANK SULSELBAR', 96),
(66, 127, 'BANK SULUT', 97),
(67, 128, 'BPD NTB', 98),
(68, 129, 'BPD BALI', 99),
(69, 130, 'BANK NTT', 100),
(70, 131, 'BANK MALUKU', 101),
(71, 132, 'BANK PAPUA', 102),
(72, 133, 'BANK BENGKULU', 103),
(73, 134, 'BANK SULTENG', 104),
(74, 135, 'BANK SULTRA', 105),
(75, 145, 'BANK NUSANTARA PARAHYANGAN', 106),
(76, 146, 'BANK SWADESI', 107),
(77, 147, 'BANK MUAMALAT', 108),
(78, 151, 'BANK MESTIKA', 109),
(79, 152, 'BANK METRO EXPRESS', 110),
(80, 153, 'BANK SINARMAS', 111),
(81, 157, 'BANK MASPION', 112),
(82, 159, 'BANK HAGAKITA', NULL),
(83, 161, 'BANK GANESHA', 113),
(84, 162, 'BANK WINDU KENTJANA', NULL),
(85, 164, 'HALIM INDONESIA BANK', 114),
(86, 166, 'BANK HARMONI INTERNATIONAL', NULL),
(87, 167, 'BANK QNB KESAWAN', 115),
(88, 200, 'BANK BTN', 116),
(89, 212, 'BANK SAUDARA', 117),
(90, 213, 'BANK BTPN', 118),
(91, 405, 'BANK VICTORIA SYARIAH', 119),
(92, 422, 'BRI SYARIAH', 120),
(93, 426, 'BANK MEGA', 122),
(94, 427, 'BANK JASA JAKARTA', NULL),
(95, 441, 'BANK BUKOPIN', 124),
(96, 451, 'BANK SYARIAH MANDIRI', 125),
(97, 459, 'BANK BISNIS INTERNASIONAL', 126),
(98, 466, 'BANK SRI PARTHA', NULL),
(99, 472, 'BANK JASA JAKARTA', 128),
(100, 484, 'BANK HANA', 129),
(101, 485, 'MNC BANK', NULL),
(102, 490, 'BANK YUDHA BHAKTI', 131),
(103, 491, 'BANK MITRANIAGA', 132),
(104, 494, 'BRI AGRONIAGA', 133),
(105, 498, 'SBI', 134),
(106, 501, 'BANK ROYAL INDONESIA', 135),
(107, 503, 'BANK NOBU', 136),
(108, 506, 'BANK MEGA SYARIAH', 137),
(109, 513, 'BANK INA PERDANA', 138),
(110, 517, 'BANK PANIN SYARIAH', 139),
(111, 520, 'PRIMA MASTER BANK', 140),
(112, 521, 'BANK SYARIAH BUKOPIN', 141),
(113, 525, 'BANK AKITA', NULL),
(114, 526, 'LIMAN INTERNATIONAL BANK', NULL),
(115, 531, 'ANGLOMAS INTERNASIONAL BANK', 144),
(116, 523, 'BANK SAHABAT SAMPOERNA', 142),
(117, 535, 'BANK KESEJAHTERAAN EKONOMI', 145),
(118, 536, 'BCA SYARIAH', 146),
(119, 542, 'BANK ARTOS', 147),
(120, 547, 'BANK PURBA DANARTA', 148),
(121, 548, 'BANK MULTI ARTA SENTOSA', 149),
(122, 553, 'BANK MAYORA', 150),
(123, 555, 'BANK INDEX SELINDO', 151),
(124, 566, 'BANK VICTORIA', 156),
(125, 558, 'BANK PUNDI', 152),
(126, 559, 'BANK CENTRATAMA NASIONAL', 153),
(127, 562, 'BANK FAMA INTERNASIONAL', 154),
(128, 564, 'BANK SINAR HARAPAN BALI', 155),
(129, 567, 'BANK HARDA', 157),
(130, 945, 'BANK AGRIS', 158),
(131, 946, 'HALIM INDONESIA BANK', NULL),
(132, 947, 'BANK MAYBANK SYARIAH', NULL),
(133, 948, 'BANK OCBC – INDONESIA', NULL),
(134, 949, 'BANK CHINATRUST INDONESIA', 160),
(135, 950, 'BANK COMMONWEALTH', 161),
(136, 784, 'BANK PERMATA SYARIAH', NULL),
(137, 425, 'BANK BJB SYARIAH', 121),
(138, 867, 'BPR EKA', NULL),
(139, 889, 'BPR KS', NULL),
(140, 9, 'BNI SYARIAH', NULL),
(141, 16, 'BANK MAYBANK INDONESIA', NULL),
(142, 724, 'BANK DKI UNIT USAHA SYARIAH', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_number` varchar(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `identity_no` varchar(16) NOT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `account_name` varchar(100) DEFAULT NULL,
  `account_number` varchar(15) DEFAULT NULL,
  `address` text NOT NULL,
  `npwp` varchar(20) DEFAULT NULL,
  `telp_rumah` varchar(20) DEFAULT NULL,
  `telp_kantor` varchar(20) DEFAULT NULL,
  `handphone` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `identity_file` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `user_id`, `order_number`, `name`, `identity_no`, `bank_id`, `account_name`, `account_number`, `address`, `npwp`, `telp_rumah`, `telp_kantor`, `handphone`, `email`, `identity_file`, `created_at`, `update_at`, `status`) VALUES
(10, 12, 'CL_12_1569609540', 'customer 1', '1234123412341234', 118, 'customer1', '12121212', 'depok', '121212', '12121212', '12121212', '121212', 'customer1@gmail.com', '2019/09/28/7pAXKbS8HiLzfkMxiykCin0XsBOxeh79QQFhC3Lg.png', '2019-09-27 18:39:00', '2019-09-27 18:39:00', 1),
(11, 12, 'CL_12_1569757256', 'Steve', '1987211922710003', 1, 'Steve', '87622198', 'Jalan Fatamawati No 45 RT 4 RW 6 No 6 Jakarta Selatan', '5432982789303', '0218406815', '0218978393', '089888838383', 'steve@gmail.com', 'clients/2019/09/30/ll4tXleWvVFiuABY8DcWGDaeQ5Zo2Ad1cCNI9IYV.jpeg', '2019-09-29 11:40:56', '2019-09-29 11:40:56', 1),
(12, 12, 'CL_12_1569829139', 'Budi', '1111111111111111', 15, NULL, NULL, 'pancoran mas', NULL, NULL, NULL, '082922121', 'budi@gmail.com', '', '2019-09-30 07:38:59', '2019-09-30 07:38:59', 1),
(13, 11, 'CL_11_1570697344', 'rahmad', '3175092408787738', 50, 'sdfswefw', '234234252', 'bekasi', '12343647we74', '534535', '3453563', '08362172367', 'rahmad@gmial.com', '', '2019-10-10 08:49:04', '2019-10-10 08:49:04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `client_units`
--

CREATE TABLE `client_units` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `clothes sizes`
--

CREATE TABLE `clothes sizes` (
  `id` int(11) NOT NULL,
  `name` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clothes sizes`
--

INSERT INTO `clothes sizes` (`id`, `name`, `created_at`, `update_at`, `status`) VALUES
(1, 'S', '2019-09-11 03:43:18', '2019-09-11 03:43:18', 1),
(2, 'M', '2019-09-11 03:43:18', '2019-09-11 03:43:18', 1),
(3, 'L', '2019-09-11 03:43:18', '2019-09-11 03:43:18', 1),
(4, 'XL', '2019-09-11 03:43:18', '2019-09-11 03:43:18', 1),
(5, 'XXL', '2019-09-11 03:43:18', '2019-09-11 03:43:18', 1),
(6, 'XXXL', '2019-09-11 03:43:18', '2019-09-11 03:43:18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `floors`
--

CREATE TABLE `floors` (
  `id` int(11) NOT NULL,
  `name` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `floors`
--

INSERT INTO `floors` (`id`, `name`, `created_at`, `update_at`, `status`) VALUES
(1, 'Lantai 1', '2019-09-11 03:44:59', '2019-09-11 03:44:59', 1),
(2, 'Lantai 2', '2019-09-11 03:44:59', '2019-09-11 03:44:59', 1),
(3, 'Lantai 3', '2019-09-11 03:44:59', '2019-09-11 03:44:59', 1),
(4, 'Lantai 4', '2019-09-11 03:44:59', '2019-09-11 03:44:59', 1),
(5, 'Lantai 5', '2019-09-11 03:44:59', '2019-09-11 03:44:59', 1),
(6, 'Lantai 6', '2019-09-11 03:44:59', '2019-09-11 03:44:59', 1),
(7, 'Lantai 7', '2019-09-11 03:44:59', '2019-09-11 03:44:59', 1),
(8, 'Lantai 8', '2019-09-11 03:44:59', '2019-09-11 03:44:59', 1),
(9, 'Lantai 9', '2019-09-11 03:44:59', '2019-09-11 03:44:59', 1),
(10, 'Lantai 10', '2019-09-11 03:44:59', '2019-09-11 03:44:59', 1),
(11, 'Lantai 11', '2019-09-11 03:44:59', '2019-09-11 03:44:59', 1),
(12, 'Lantai 12', '2019-09-11 03:44:59', '2019-09-11 03:44:59', 1),
(13, 'Lantai 13', '2019-09-11 03:44:59', '2019-09-11 03:44:59', 1),
(14, 'test11', '2019-09-22 00:55:50', '2019-09-22 01:02:49', 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(2, 'App\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(1, 'App\\User', 11),
(4, 'App\\User', 12),
(4, 'App\\User', 13),
(5, 'App\\User', 14),
(5, 'App\\User', 15),
(6, 'App\\User', 16),
(1, 'App\\User', 17);

-- --------------------------------------------------------

--
-- Table structure for table `office`
--

CREATE TABLE `office` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` smallint(6) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `office`
--

INSERT INTO `office` (`id`, `name`, `created_at`, `update_at`, `status`) VALUES
(1, 'Modern Kranji', '2019-10-04 23:48:33', '2019-10-04 23:48:33', 1),
(2, 'Investor', '2019-10-04 23:48:33', '2019-10-04 23:48:33', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_number` varchar(20) NOT NULL,
  `client_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `persen_dp` int(11) DEFAULT NULL,
  `nominal_dp` int(11) DEFAULT NULL,
  `lama_cicilan` int(11) DEFAULT NULL,
  `cicilan` int(5) DEFAULT NULL,
  `bunga` smallint(6) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reserved_date` datetime DEFAULT NULL,
  `booking_date` datetime DEFAULT NULL,
  `dp_date` datetime DEFAULT NULL,
  `lunas_date` datetime DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `notes` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `client_id`, `user_id`, `unit_id`, `persen_dp`, `nominal_dp`, `lama_cicilan`, `cicilan`, `bunga`, `created_at`, `updated_at`, `reserved_date`, `booking_date`, `dp_date`, `lunas_date`, `status`, `notes`) VALUES
(7, 'ORDER_632', 10, 12, 9, NULL, 0, 0, NULL, NULL, '2019-09-28 04:37:15', '2019-09-28 04:37:15', NULL, NULL, NULL, NULL, 1, ''),
(8, 'ORDER_17', 10, 12, 8, NULL, 0, 0, NULL, NULL, '2019-09-29 02:52:00', '2019-09-29 02:52:00', NULL, NULL, NULL, NULL, 1, ''),
(9, 'ORDER_738', 11, 12, 10, NULL, 0, 0, NULL, NULL, '2019-09-29 12:03:24', '2019-09-29 12:03:24', NULL, NULL, NULL, NULL, 1, ''),
(10, 'ORDER_411', 10, 12, 11, NULL, 0, 0, NULL, NULL, '2019-09-30 02:58:24', '2019-09-30 02:58:24', NULL, NULL, NULL, NULL, 1, ''),
(11, 'ORDER_856', 10, 12, 12, NULL, 0, 0, NULL, NULL, '2019-09-30 06:03:15', '2019-09-30 06:03:15', NULL, NULL, NULL, NULL, 1, ''),
(12, 'ORDER_841', 10, 12, 13, NULL, 0, 0, NULL, NULL, '2019-09-30 07:42:42', '2019-09-30 07:42:42', NULL, NULL, NULL, NULL, 1, ''),
(13, 'ORDER_359', 12, 12, 14, NULL, 0, 0, NULL, NULL, '2019-10-01 14:31:24', '2019-10-01 14:31:24', NULL, NULL, NULL, NULL, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_histories`
--

CREATE TABLE `payment_histories` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `payment_status_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_number` varchar(100) NOT NULL,
  `nominal` int(11) NOT NULL,
  `payment_method` tinyint(4) NOT NULL COMMENT '0 = cash, 1 = transfer',
  `payment_date` datetime NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 = not refundable, 1 = refundable',
  `refundable_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 = belum di refund, 1= sudah di refund',
  `valid_transaction` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=no, 1= yes',
  `verified_by` int(11) DEFAULT NULL,
  `transaction_file` varchar(255) DEFAULT NULL,
  `notes` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_histories`
--

INSERT INTO `payment_histories` (`id`, `order_id`, `payment_status_id`, `user_id`, `payment_number`, `nominal`, `payment_method`, `payment_date`, `created_at`, `updated_at`, `status`, `refundable_status`, `valid_transaction`, `verified_by`, `transaction_file`, `notes`) VALUES
(4, 7, 2, 12, 'PN__12_1683_1569645435', 1000000, 0, '2019-09-28 11:37:15', '2019-09-28 04:37:15', '2019-09-28 04:37:15', 0, 0, 1, 14, '2019/09/29/WjIIg1Nsmk0xNZQZNq5IseuOePdEFQ8ZmqHIlTZR.jpeg', ''),
(5, 7, 2, 12, 'PN__12_3400_1569718792', 5000000, 1, '2019-09-29 07:59:52', '2019-09-29 00:59:52', '2019-09-29 00:59:52', 0, 0, 1, 14, '2019/09/30/RgkMUNAesogvyM0UKfz4gnRRm9AA9AMAirrQ1C6H.jpeg', ''),
(6, 7, 3, 12, 'PN__12_6956_1569719007', 1200000, 1, '2019-09-29 08:03:27', '2019-09-29 01:03:27', '2019-09-29 01:03:27', 0, 0, 1, 14, 'transaction/2019/09/30/bCeVRPCEhGmiEtD1i6NkgcxZGGS1M76CsmRoaNwo.png', ''),
(7, 8, 2, 12, 'PN__12_7710_1569725520', 1000000, 0, '2019-09-29 09:52:00', '2019-09-29 02:52:00', '2019-09-29 02:52:00', 0, 0, 1, 14, '2019/09/29/3i2fSU5WfNUK9zagv4gK3mbohOkuwrZ9SfJjn6QW.png', ''),
(8, 9, 3, 12, 'PN__12_6529_1569758604', 5000000, 1, '2019-09-29 19:03:24', '2019-09-29 12:03:24', '2019-09-29 12:03:24', 0, 0, 1, 14, 'transaction/2019/09/30/uxK7KeRn6CDC7l3SRimWAyalRk7dLqmV8760myZy.png', ''),
(9, 8, 3, 12, 'PN__12_8081_1569810230', 5000000, 0, '2019-09-30 09:23:50', '2019-09-30 02:23:50', '2019-09-30 02:23:50', 0, 0, 1, 14, '2019/09/30/UPYOJdcu1Jo9nVvWKE84PmRpaUgehLqtudtex0Bk.jpeg', ''),
(10, 8, 4, 12, 'PN__12_6506_1569812229', 50000000, 0, '2019-09-30 09:57:09', '2019-09-30 02:57:09', '2019-09-30 02:57:09', 0, 0, 1, 14, '2019/09/30/6HXvZIzPiKvp7e74YJjfdaXBMvP6Ap275DLkPjut.jpeg', ''),
(11, 10, 2, 12, 'PN__12_1988_1569812304', 1000000, 0, '2019-09-30 09:58:24', '2019-09-30 02:58:24', '2019-09-30 02:58:24', 0, 0, 0, NULL, '', ''),
(12, 10, 3, 12, 'PN__12_5245_1569812343', 5000000, 0, '2019-09-30 09:59:03', '2019-09-30 02:59:03', '2019-09-30 02:59:03', 0, 0, 0, NULL, '', ''),
(13, 11, 3, 12, 'PN__12_3831_1569823395', 5000000, 0, '2019-09-30 13:03:15', '2019-09-30 06:03:15', '2019-09-30 06:03:15', 0, 0, 0, NULL, '', ''),
(14, 12, 2, 12, 'PN__12_2031_1569829362', 1000000, 1, '2019-09-30 14:42:42', '2019-09-30 07:42:42', '2019-09-30 07:42:42', 0, 0, 1, 14, 'transaction/2019/09/30/VtSq6tdmCJdpmjWulcMPKIDc8fKSW2iX1bt7F8Qm.jpeg', ''),
(15, 12, 4, 12, 'PN__12_4225_1569829969', 100000000, 1, '2019-09-30 14:52:49', '2019-09-30 07:52:49', '2019-09-30 07:52:49', 0, 0, 1, 14, 'transaction/2019/09/30/9QqRVObMl08uM7EJBt1Fzrn3k7vlBSt5Xx7a3XxZ.jpeg', ''),
(16, 13, 2, 12, 'PN__12_6400_1569940284', 1000000, 0, '2019-10-01 21:31:24', '2019-10-01 14:31:24', '2019-10-01 14:31:24', 0, 0, 0, NULL, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `payment_status`
--

CREATE TABLE `payment_status` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_status`
--

INSERT INTO `payment_status` (`id`, `name`, `description`, `created_at`, `update_at`, `status`) VALUES
(2, 'reserved', 'Biaya 1 juta berlaku untuk seminggu reserved unit, uang refundable', '2019-09-08 13:06:27', '2019-09-08 13:06:27', 1),
(3, 'Booking fee', 'Biaya 5 juta sebagai uang kepastian pemilihan unit mengurangi nominal DB, tidak refundable(hangus)', '2019-09-08 13:08:45', '2019-09-08 13:08:45', 1),
(4, 'DP', 'harga 10% dari harga terikat dikurangi booking fee 5 juta', '2019-09-08 13:08:45', '2019-09-08 13:08:45', 1),
(5, 'Cash Bertahap', 'Sejumlah term pembayaran dari harga yang terikat di akhir dibagi dalam 12x cicilan', '2019-09-08 13:09:29', '2019-09-08 13:09:29', 1),
(6, 'Pelunasan', '', '2019-09-08 13:51:44', '2019-09-08 13:51:44', 1);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'list-users', 'web', '2019-09-11 03:00:05', '2019-09-11 03:00:05'),
(2, 'create-users', 'web', '2019-09-11 03:00:16', '2019-09-11 03:00:16'),
(3, 'update-users', 'web', '2019-09-11 03:00:24', '2019-09-11 03:00:24'),
(4, 'delete-users', 'web', '2019-09-11 03:00:31', '2019-09-11 03:00:31'),
(5, 'list-units', 'web', '2019-09-13 16:43:45', '2019-09-13 16:43:45'),
(6, 'create-units', 'web', '2019-09-13 16:43:58', '2019-09-13 16:43:58'),
(7, 'update-units', 'web', '2019-09-13 16:44:07', '2019-09-13 16:44:07'),
(8, 'delete-units', 'web', '2019-09-13 16:44:12', '2019-09-13 16:44:12'),
(9, 'list-orders', 'web', '2019-09-13 16:44:24', '2019-09-13 16:44:24'),
(10, 'create-orders', 'web', '2019-09-13 16:44:29', '2019-09-13 16:44:29'),
(11, 'update-orders', 'web', '2019-09-13 16:44:34', '2019-09-13 16:44:34'),
(12, 'delete-orders', 'web', '2019-09-13 16:44:38', '2019-09-13 16:44:38'),
(13, 'list-clients', 'web', '2019-09-13 16:44:59', '2019-09-13 16:44:59'),
(14, 'create-clients', 'web', '2019-09-13 16:45:05', '2019-09-13 16:45:05'),
(15, 'update-clients', 'web', '2019-09-13 16:45:11', '2019-09-13 16:45:11'),
(16, 'delete-clients', 'web', '2019-09-13 16:45:16', '2019-09-13 16:45:16'),
(17, 'list-roles', 'web', '2019-09-14 02:40:43', '2019-09-14 02:40:43'),
(18, 'create-roles', 'web', '2019-09-14 02:40:50', '2019-09-14 02:40:50'),
(19, 'update-roles', 'web', '2019-09-14 02:40:57', '2019-09-14 02:40:57'),
(20, 'delete-roles', 'web', '2019-09-14 02:41:03', '2019-09-14 02:41:03'),
(21, 'addpermission-roles', 'web', '2019-09-14 03:02:05', '2019-09-14 03:02:05'),
(22, 'list-payment-history', 'web', '2019-09-14 03:11:46', '2019-09-14 03:11:46'),
(23, 'create-payment-history', 'web', '2019-09-14 03:12:58', '2019-09-14 03:12:58'),
(24, 'update-payment-history', 'web', '2019-09-14 03:13:05', '2019-09-14 03:13:05'),
(25, 'delete-payment-history', 'web', '2019-09-14 03:13:10', '2019-09-14 03:13:10'),
(26, 'view-units', 'web', '2019-09-14 03:40:51', '2019-09-14 03:40:51');

-- --------------------------------------------------------

--
-- Table structure for table `religions`
--

CREATE TABLE `religions` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `religions`
--

INSERT INTO `religions` (`id`, `name`, `created_at`, `update_at`, `status`) VALUES
(1, 'Islam', '2019-09-11 03:42:52', '2019-09-11 03:42:52', 1),
(2, 'Kristen', '2019-09-11 03:42:52', '2019-09-11 03:42:52', 1),
(3, 'Khatolik', '2019-09-11 03:42:52', '2019-09-11 03:42:52', 1),
(4, 'Hindu', '2019-09-11 03:42:52', '2019-09-11 03:42:52', 1),
(5, 'Budha', '2019-09-11 03:42:52', '2019-09-11 03:42:52', 1),
(6, 'Konghucu', '2019-09-11 03:42:52', '2019-09-11 03:42:52', 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'administrator', 'web', '2019-09-10 02:15:34', '2019-09-10 02:15:34'),
(2, 'supervisor', 'web', '2019-09-10 02:15:46', '2019-09-10 02:15:46'),
(3, 'admin_fp', 'web', '2019-09-10 02:15:58', '2019-09-10 02:15:58'),
(4, 'sales', 'web', '2019-09-10 02:16:02', '2019-09-10 02:16:02'),
(5, 'kasir', 'web', '2019-09-10 02:16:05', '2019-09-10 02:16:05'),
(6, 'accountant', 'web', '2019-09-10 02:16:12', '2019-09-10 02:16:12'),
(11, 'Add new Roles', 'web', '2019-09-14 09:49:45', '2019-09-14 09:49:45');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(5, 4),
(9, 4),
(10, 4),
(13, 4),
(14, 4),
(15, 4),
(16, 4),
(26, 4),
(5, 5),
(9, 5),
(10, 5),
(11, 5),
(13, 5),
(26, 5),
(22, 6),
(24, 6),
(25, 6),
(26, 6);

-- --------------------------------------------------------

--
-- Table structure for table `towers`
--

CREATE TABLE `towers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `towers`
--

INSERT INTO `towers` (`id`, `name`, `created_at`, `update_at`, `status`) VALUES
(1, 'Tower A', '2019-09-16 23:06:35', '2019-09-16 23:06:35', 1),
(2, 'Tower B', '2019-09-16 23:06:35', '2019-09-16 23:06:35', 1),
(3, 'Tower C', '2019-09-16 23:06:52', '2019-09-16 23:06:52', 1),
(4, 'Tower D', '2019-09-16 23:06:52', '2019-09-16 23:06:52', 1);

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `id` int(11) NOT NULL,
  `unit_number` int(11) NOT NULL,
  `unit_name` varchar(100) NOT NULL,
  `unit_type_id` smallint(6) NOT NULL,
  `floor_id` tinyint(4) NOT NULL,
  `view_id` int(11) NOT NULL,
  `tower_id` int(11) NOT NULL,
  `large` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `unit_total` smallint(4) NOT NULL DEFAULT '0',
  `unit_stock` smallint(4) NOT NULL DEFAULT '0',
  `description` text,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0=not available, 1= available',
  `available_status_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`id`, `unit_number`, `unit_name`, `unit_type_id`, `floor_id`, `view_id`, `tower_id`, `large`, `price`, `unit_total`, `unit_stock`, `description`, `created_at`, `update_at`, `status`, `available_status_id`) VALUES
(8, 18, 'unit 1', 1, 1, 5, 1, 40, 300000000, 0, 0, NULL, '2019-09-27 18:37:25', '2019-09-27 18:37:25', 1, 2),
(9, 182, 'unit 2', 1, 1, 5, 1, 40, 400000000, 0, 0, NULL, '2019-09-27 18:37:49', '2019-09-27 18:37:49', 1, 1),
(10, 11, 'Papua', 4, 1, 6, 1, 34, 500000000, 0, 0, NULL, '2019-09-29 12:00:58', '2019-09-29 12:00:58', 1, 1),
(11, 12, 'Sumatra', 1, 6, 6, 1, 40, 340000000, 0, 0, NULL, '2019-09-30 02:18:07', '2019-09-30 02:18:07', 1, NULL),
(12, 105, 'Modern deluxe', 1, 1, 5, 1, 32, 350000, 0, 0, NULL, '2019-09-30 06:01:47', '2019-09-30 06:01:47', 1, NULL),
(13, 76, 'Sulawesi', 2, 5, 5, 1, 70, 500000000, 0, 0, NULL, '2019-09-30 07:41:41', '2019-09-30 07:41:41', 1, 2),
(14, 19, 'hujan', 1, 1, 5, 1, 11, 500000000, 0, 0, NULL, '2019-10-01 14:31:02', '2019-10-01 14:31:02', 1, NULL),
(15, 120, 'kranji barat', 4, 12, 6, 1, 32, 525000000, 0, 0, NULL, '2019-10-10 08:47:11', '2019-10-10 08:47:11', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `unit_types`
--

CREATE TABLE `unit_types` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unit_types`
--

INSERT INTO `unit_types` (`id`, `name`, `created_at`, `update_at`, `status`) VALUES
(1, 'Studio 18', '2019-09-11 03:44:09', '2019-09-11 03:44:09', 1),
(2, 'Studio 21', '2019-09-11 03:44:09', '2019-09-11 03:44:09', 1),
(3, '1 BR', '2019-09-11 03:44:09', '2019-09-11 03:44:09', 1),
(4, '2 BR', '2019-09-11 03:44:09', '2019-09-11 03:44:09', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `office_id` int(11) NOT NULL DEFAULT '1',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1',
  `nik` int(20) DEFAULT NULL,
  `jenis_kelamin` tinyint(1) DEFAULT NULL,
  `agama` tinyint(1) DEFAULT NULL,
  `tempat_lahir` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `office_id`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `status`, `nik`, `jenis_kelamin`, `agama`, `tempat_lahir`) VALUES
(1, 'teguh', 'teguhkrstianto@gmail.com', 1, NULL, '$2y$10$oiwmKTwKEk3zdyvlSTcgTu/UyRfVNarJy32UFXn7rZ2yhoz0dRzdu', NULL, '2019-09-08 19:34:27', '2019-09-08 19:34:27', 0, 0, 0, 0, ''),
(11, 'fajar', 'fajar@gmail.com', 1, NULL, '$2y$10$IoGKJ5luK88O4X9A84b4LO/ifvb7t698funn7KePV6vS5Y8b/OPA2', NULL, '2019-09-28 01:30:04', '2019-09-28 01:30:04', 1, NULL, NULL, NULL, NULL),
(12, 'sales1', 'sales1@gmail.com', 1, NULL, '$2y$10$oiwmKTwKEk3zdyvlSTcgTu/UyRfVNarJy32UFXn7rZ2yhoz0dRzdu', NULL, '2019-09-28 01:30:31', '2019-09-28 01:30:31', 1, NULL, NULL, NULL, NULL),
(13, 'sales2', 'sales2@gmail.com', 1, NULL, '$2y$10$oiwmKTwKEk3zdyvlSTcgTu/UyRfVNarJy32UFXn7rZ2yhoz0dRzdu', NULL, '2019-09-28 01:30:54', '2019-09-28 01:30:54', 1, NULL, NULL, NULL, NULL),
(14, 'kasir1', 'kasir1@gmail.com', 1, NULL, '$2y$10$oiwmKTwKEk3zdyvlSTcgTu/UyRfVNarJy32UFXn7rZ2yhoz0dRzdu', NULL, '2019-09-28 01:31:18', '2019-09-28 01:31:18', 1, NULL, NULL, NULL, NULL),
(15, 'kasir2', 'kasir2@gmail.com', 1, NULL, '$2y$10$oiwmKTwKEk3zdyvlSTcgTu/UyRfVNarJy32UFXn7rZ2yhoz0dRzdu', NULL, '2019-09-28 01:31:39', '2019-09-28 01:31:39', 1, NULL, NULL, NULL, NULL),
(16, 'rohmad', 'rohmad@gmail.com', 1, NULL, '$2y$10$oiwmKTwKEk3zdyvlSTcgTu/UyRfVNarJy32UFXn7rZ2yhoz0dRzdu', NULL, '2019-10-10 15:50:28', '2019-10-10 15:50:28', 1, NULL, NULL, NULL, NULL),
(17, 'mimin', 'mimin@gmail.com', 1, NULL, '$2y$10$oiwmKTwKEk3zdyvlSTcgTu/UyRfVNarJy32UFXn7rZ2yhoz0dRzdu', NULL, '2019-12-18 19:01:07', '2019-12-18 19:01:07', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_bak`
--

CREATE TABLE `users_bak` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nik` int(20) NOT NULL,
  `jenis_kelamin` tinyint(1) NOT NULL,
  `agama` tinyint(1) NOT NULL,
  `tempat_lahir` varchar(15) NOT NULL,
  `tanggal_lahir` datetime NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `whatsapp` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `npwp` varchar(20) NOT NULL,
  `ukuran_baju` tinyint(1) NOT NULL,
  `no_rekening` varchar(20) NOT NULL,
  `upload_ktp` varchar(100) NOT NULL,
  `rule` tinyint(2) NOT NULL,
  `created_at` datetime NOT NULL,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `views`
--

CREATE TABLE `views` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `views`
--

INSERT INTO `views` (`id`, `name`, `created_at`, `update_at`, `status`) VALUES
(5, 'Taman Kota', '2019-09-11 03:46:05', '2019-09-11 03:46:05', 1),
(6, 'Kolam', '2019-09-11 03:46:05', '2019-09-11 03:46:05', 1),
(7, 'Gunung salak', '2019-09-22 01:22:11', '2019-09-22 01:23:46', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `available_status`
--
ALTER TABLE `available_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_units`
--
ALTER TABLE `client_units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clothes sizes`
--
ALTER TABLE `clothes sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `floors`
--
ALTER TABLE `floors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `office`
--
ALTER TABLE `office`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_histories`
--
ALTER TABLE `payment_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_status`
--
ALTER TABLE `payment_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `religions`
--
ALTER TABLE `religions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `towers`
--
ALTER TABLE `towers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit_types`
--
ALTER TABLE `unit_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `users_bak`
--
ALTER TABLE `users_bak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `available_status`
--
ALTER TABLE `available_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `client_units`
--
ALTER TABLE `client_units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `clothes sizes`
--
ALTER TABLE `clothes sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `floors`
--
ALTER TABLE `floors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `office`
--
ALTER TABLE `office`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `payment_histories`
--
ALTER TABLE `payment_histories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `payment_status`
--
ALTER TABLE `payment_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `religions`
--
ALTER TABLE `religions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `towers`
--
ALTER TABLE `towers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `unit_types`
--
ALTER TABLE `unit_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `users_bak`
--
ALTER TABLE `users_bak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `views`
--
ALTER TABLE `views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
