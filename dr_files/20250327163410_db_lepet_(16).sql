-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2025 at 04:15 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_lepet`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounting_bank`
--

CREATE TABLE `accounting_bank` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `account_bank` varchar(255) NOT NULL,
  `balance` decimal(65,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounting_bank`
--

INSERT INTO `accounting_bank` (`id`, `name`, `account_bank`, `balance`) VALUES
(1, 'MANDIRI', '0', '1320000'),
(2, 'CASH', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `accounting_daily_report`
--

CREATE TABLE `accounting_daily_report` (
  `id` int(255) NOT NULL,
  `date` date NOT NULL,
  `incharge` varchar(255) NOT NULL,
  `know1` varchar(255) DEFAULT NULL,
  `know2` varchar(255) DEFAULT NULL,
  `director` varchar(255) DEFAULT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounting_daily_report`
--

INSERT INTO `accounting_daily_report` (`id`, `date`, `incharge`, `know1`, `know2`, `director`, `create_at`) VALUES
(18, '2025-02-27', '14', NULL, NULL, NULL, '2025-02-27 03:25:28'),
(19, '2025-02-27', '14', NULL, NULL, NULL, '2025-02-27 03:27:03'),
(20, '2025-02-27', '14', NULL, NULL, NULL, '2025-02-27 03:27:54'),
(21, '2025-02-27', '14', NULL, NULL, NULL, '2025-02-27 03:33:30'),
(22, '2025-02-27', '14', NULL, NULL, NULL, '2025-02-27 03:35:30'),
(23, '2025-02-27', '14', NULL, NULL, NULL, '2025-02-27 03:37:13'),
(24, '2025-02-27', '14', NULL, NULL, NULL, '2025-02-27 03:40:32'),
(25, '2025-02-27', '14', NULL, NULL, NULL, '2025-02-27 03:41:24'),
(26, '2025-02-27', '14', NULL, NULL, NULL, '2025-02-27 03:47:42'),
(27, '2025-02-27', '14', NULL, NULL, NULL, '2025-02-27 08:07:31'),
(28, '2025-02-27', '14', NULL, NULL, NULL, '2025-02-27 08:18:27');

-- --------------------------------------------------------

--
-- Table structure for table `accounting_daily_report_balance`
--

CREATE TABLE `accounting_daily_report_balance` (
  `id` int(255) NOT NULL,
  `id_dr` int(255) NOT NULL,
  `id_bank` varchar(255) NOT NULL,
  `start_balance` decimal(65,0) NOT NULL,
  `end_balance` decimal(65,0) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounting_daily_report_balance`
--

INSERT INTO `accounting_daily_report_balance` (`id`, `id_dr`, `id_bank`, `start_balance`, `end_balance`, `create_at`) VALUES
(13, 18, '1', '120', '120', '2025-02-27 03:25:28'),
(14, 18, '2', '0', '0', '2025-02-27 03:25:28'),
(15, 19, '1', '120', '120', '2025-02-27 03:27:03'),
(16, 19, '2', '0', '0', '2025-02-27 03:27:03'),
(17, 20, '1', '120', '243', '2025-02-27 03:27:54'),
(18, 20, '2', '0', '0', '2025-02-27 03:27:54'),
(19, 21, '1', '120', '1', '2025-02-27 03:33:30'),
(20, 21, '2', '0', '0', '2025-02-27 03:33:30'),
(21, 22, '1', '120', '143', '2025-02-27 03:35:30'),
(22, 22, '2', '0', '0', '2025-02-27 03:35:30'),
(23, 23, '1', '120', '243', '2025-02-27 03:37:13'),
(24, 23, '2', '0', '0', '2025-02-27 03:37:13'),
(25, 24, '1', '120', '243', '2025-02-27 03:40:32'),
(26, 24, '2', '0', '0', '2025-02-27 03:40:32'),
(27, 25, '1', '120', '121', '2025-02-27 03:41:24'),
(28, 25, '2', '0', '0', '2025-02-27 03:41:24'),
(29, 26, '1', '120000', '120023', '2025-02-27 03:47:42'),
(30, 26, '2', '0', '0', '2025-02-27 03:47:42'),
(31, 27, '1', '120000', '120123', '2025-02-27 08:07:31'),
(32, 27, '2', '0', '0', '2025-02-27 08:07:31'),
(33, 28, '1', '120000', '1320000', '2025-02-27 08:18:27'),
(34, 28, '2', '0', '0', '2025-02-27 08:18:27');

-- --------------------------------------------------------

--
-- Table structure for table `accounting_daily_report_transaction`
--

CREATE TABLE `accounting_daily_report_transaction` (
  `id` int(255) NOT NULL,
  `id_dr` varchar(255) NOT NULL,
  `transaction_desc` varchar(255) NOT NULL,
  `in-out` varchar(255) NOT NULL,
  `id_bank` varchar(255) NOT NULL,
  `amount` decimal(65,0) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounting_daily_report_transaction`
--

INSERT INTO `accounting_daily_report_transaction` (`id`, `id_dr`, `transaction_desc`, `in-out`, `id_bank`, `amount`, `remark`, `create_at`, `file`) VALUES
(14, '18', '123', 'In', '1', '123', '123', '2025-02-27 03:25:28', './AccountingFiles/Invoice/1740601528_Laporan_Voucher_20250225.pdf'),
(15, '19', '123', 'In', '1', '123', '123', '2025-02-27 03:27:03', './AccountingFiles/Invoice/1740601623_IMG-20250121-WA0021 - Fathur Ramdhany.jpg'),
(16, '20', '12123', 'In', '1', '123123', '123123', '2025-02-27 03:27:54', './AccountingFiles/Invoice/1740601674_25022025123522.pdf'),
(17, '21', '123', 'In', '1', '1111451', '123', '2025-02-27 03:33:30', './AccountingFiles/Invoice/1740602010_25022025123522.pdf'),
(18, '22', '123', 'In', '1', '23123', '123123', '2025-02-27 03:35:30', './AccountingFiles/Invoice/1740602130_IMG-20250121-WA0021 - Fathur Ramdhany.jpg'),
(19, '23', '123', 'In', '1', '123123', '123', '2025-02-27 03:37:13', './AccountingFiles/Invoice/1740602233_knan.png'),
(20, '24', '123', 'In', '1', '123123', '123', '2025-02-27 03:40:32', './AccountingFiles/Invoice/1740602432_knan.png'),
(21, '25', 'ewqwe', 'In', '1', '1212', '123', '2025-02-27 03:41:24', './AccountingFiles/Invoice/1740602484_knan.png'),
(22, '26', 'qweqwe', 'In', '1', '23', '123', '2025-02-27 03:47:42', './AccountingFiles/Invoice/1740602862_IMG-20250121-WA0021 - Fathur Ramdhany.jpg'),
(23, '27', '123', 'In', '1', '123', '123', '2025-02-27 08:07:31', './AccountingFiles/Invoice/1740618451_IMG-20250121-WA0021 - Fathur Ramdhany.jpg'),
(24, '28', 'qweqwe', 'In', '1', '1200000', 'Remark', '2025-02-27 08:18:27', './AccountingFiles/Invoice/1740619107_Laporan_Voucher_20250225.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `accounting_voucher`
--

CREATE TABLE `accounting_voucher` (
  `id` int(255) NOT NULL,
  `no_doc` varchar(255) NOT NULL,
  `account` varchar(255) NOT NULL,
  `incharge` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `recipient` varchar(255) NOT NULL,
  `recipient_bank` varchar(255) NOT NULL,
  `bank_account` int(255) NOT NULL,
  `due_date` date NOT NULL,
  `status` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounting_voucher`
--

INSERT INTO `accounting_voucher` (`id`, `no_doc`, `account`, `incharge`, `date`, `recipient`, `recipient_bank`, `bank_account`, `due_date`, `status`) VALUES
(26, '1', '1', 'LUTFI WIJAYA', '2025-02-19', 'Lutfi', '1', 0, '2025-02-19', 0),
(27, '2', '2', 'LUTFI WIJAYA', '2025-02-20', '2', '2', 2, '2025-02-20', 1),
(28, '323', '23123', 'LUTFI WIJAYA', '2025-02-26', 'wer', '123', 0, '2025-02-26', 2);

-- --------------------------------------------------------

--
-- Table structure for table `accounting_voucher_spec`
--

CREATE TABLE `accounting_voucher_spec` (
  `id` int(255) NOT NULL,
  `voucher_id` int(255) NOT NULL,
  `spec` varchar(255) NOT NULL,
  `qty` int(255) NOT NULL,
  `price` decimal(65,0) NOT NULL,
  `amount` decimal(65,0) NOT NULL,
  `invoice` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounting_voucher_spec`
--

INSERT INTO `accounting_voucher_spec` (`id`, `voucher_id`, `spec`, `qty`, `price`, `amount`, `invoice`) VALUES
(16, 26, 'PEMBAYARAN STNK', 1, '2216000', '2216000', 'http://localhost/cka-pot-master/AccountingFiles/Invoice/1_1.pdf'),
(17, 27, '2', 2, '2', '4', 'http://localhost/cka-pot-master/AccountingFiles/Invoice/2_1.pdf'),
(18, 28, '12', 2, '123123', '246246', 'http://localhost/cka-pot-master/AccountingFiles/Invoice/323_1.pdf'),
(19, 28, '3333', 5, '3123', '15615', 'http://localhost/cka-pot-master/AccountingFiles/Invoice/323_2.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `dr_akses`
--

CREATE TABLE `dr_akses` (
  `id` int(255) NOT NULL,
  `id_user` int(255) NOT NULL,
  `table_name` varchar(255) NOT NULL,
  `id_table` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dr_akses`
--

INSERT INTO `dr_akses` (`id`, `id_user`, `table_name`, `id_table`) VALUES
(1, 14, 'sd_ho_lv1', 1),
(2, 14, 'sd_ho_lv1', 2),
(3, 14, 'sd_ho_lv1', 3),
(4, 14, 'sd_ho_lv1', 4),
(5, 14, 'sd_ho_lv1', 5),
(7, 14, 'sd_ho_lv1', 7),
(8, 14, 'sd_ho_lv1', 8),
(9, 14, 'sd_ho_lv1', 9),
(10, 14, 'sd_ho_lv1', 10),
(11, 14, 'sd_ho_lv1', 11),
(12, 14, 'sd_ho_lv1', 12),
(13, 14, 'sd_ho_lv1', 13),
(14, 14, 'sd_ho_lv1', 14),
(15, 14, 'sd_ho_lv1', 15),
(16, 14, 'sd_ho_lv1', 16),
(17, 14, 'sd_ho_lv1', 17),
(18, 14, 'sd_ho_lv1', 18),
(19, 14, 'sd_ho_lv1', 19),
(20, 14, 'sd_ho_lv1', 20),
(21, 14, 'sd_ho_lv1', 21),
(22, 14, 'sd_ho_lv1', 22),
(23, 14, 'sd_ho_lv1', 23),
(24, 14, 'sd_ho_lv1', 24),
(25, 14, 'sd_ho_lv1', 25),
(26, 14, 'sd_ho_lv1', 26),
(27, 14, 'sd_ho_lv1', 27),
(28, 14, 'sd_ho_lv1', 28),
(29, 14, 'sd_ho_lv1', 29),
(30, 14, 'sd_ho_lv1', 30),
(31, 14, 'sd_ho_lv1', 31),
(32, 14, 'sd_ho_lv1', 32),
(33, 20, 'sd_ho_lv1', 33),
(34, 20, 'sd_ho_lv1', 1),
(35, 20, 'sd_ho_lv1', 2),
(36, 20, 'sd_ho_lv1', 3),
(37, 20, 'sd_ho_lv1', 4),
(38, 20, 'sd_ho_lv1', 5),
(39, 20, 'sd_ho_lv1', 6),
(40, 20, 'sd_ho_lv1', 7),
(41, 20, 'sd_ho_lv1', 8),
(42, 20, 'sd_ho_lv1', 9),
(43, 20, 'sd_ho_lv1', 10),
(44, 20, 'sd_ho_lv1', 11),
(45, 20, 'sd_ho_lv1', 12),
(46, 20, 'sd_ho_lv1', 13),
(47, 20, 'sd_ho_lv1', 14),
(48, 20, 'sd_ho_lv1', 15),
(49, 20, 'sd_ho_lv1', 16),
(50, 20, 'sd_ho_lv1', 17),
(51, 20, 'sd_ho_lv1', 18),
(52, 20, 'sd_ho_lv1', 19),
(53, 20, 'sd_ho_lv1', 20),
(54, 20, 'sd_ho_lv1', 21),
(55, 20, 'sd_ho_lv1', 22),
(56, 20, 'sd_ho_lv1', 23),
(57, 20, 'sd_ho_lv1', 24),
(58, 20, 'sd_ho_lv1', 25),
(59, 20, 'sd_ho_lv1', 26),
(60, 20, 'sd_ho_lv1', 27),
(61, 20, 'sd_ho_lv1', 28),
(62, 20, 'sd_ho_lv1', 29),
(63, 20, 'sd_ho_lv1', 30),
(64, 20, 'sd_ho_lv1', 31),
(65, 20, 'sd_ho_lv1', 32),
(66, 20, 'sd_ho_lv1', 33),
(67, 21, 'sd_ho_lv1', 1),
(68, 21, 'sd_ho_lv1', 2),
(69, 21, 'sd_ho_lv1', 3),
(70, 21, 'sd_ho_lv1', 4),
(71, 21, 'sd_ho_lv1', 5),
(72, 21, 'sd_ho_lv1', 6),
(73, 21, 'sd_ho_lv1', 7),
(74, 21, 'sd_ho_lv1', 8),
(75, 21, 'sd_ho_lv1', 9),
(76, 21, 'sd_ho_lv1', 10),
(77, 21, 'sd_ho_lv1', 11),
(78, 21, 'sd_ho_lv1', 12),
(79, 21, 'sd_ho_lv1', 13),
(80, 21, 'sd_ho_lv1', 14),
(81, 21, 'sd_ho_lv1', 15),
(82, 21, 'sd_ho_lv1', 16),
(83, 21, 'sd_ho_lv1', 17),
(84, 21, 'sd_ho_lv1', 18),
(85, 21, 'sd_ho_lv1', 19),
(86, 21, 'sd_ho_lv1', 20),
(87, 21, 'sd_ho_lv1', 21),
(88, 21, 'sd_ho_lv1', 22),
(89, 21, 'sd_ho_lv1', 23),
(90, 21, 'sd_ho_lv1', 24),
(91, 21, 'sd_ho_lv1', 25),
(92, 21, 'sd_ho_lv1', 26),
(93, 21, 'sd_ho_lv1', 27),
(94, 21, 'sd_ho_lv1', 28),
(95, 21, 'sd_ho_lv1', 29),
(96, 21, 'sd_ho_lv1', 30),
(97, 21, 'sd_ho_lv1', 31),
(98, 21, 'sd_ho_lv1', 32),
(99, 21, 'sd_ho_lv1', 33),
(100, 22, 'sd_ho_lv1', 1),
(101, 22, 'sd_ho_lv1', 2),
(102, 22, 'sd_ho_lv1', 3),
(103, 22, 'sd_ho_lv1', 4),
(104, 22, 'sd_ho_lv1', 5),
(105, 22, 'sd_ho_lv1', 6),
(106, 22, 'sd_ho_lv1', 7),
(107, 22, 'sd_ho_lv1', 8),
(108, 22, 'sd_ho_lv1', 9),
(109, 22, 'sd_ho_lv1', 10),
(110, 22, 'sd_ho_lv1', 11),
(111, 22, 'sd_ho_lv1', 12),
(112, 22, 'sd_ho_lv1', 13),
(113, 22, 'sd_ho_lv1', 14),
(114, 22, 'sd_ho_lv1', 15),
(115, 22, 'sd_ho_lv1', 16),
(116, 22, 'sd_ho_lv1', 17),
(117, 22, 'sd_ho_lv1', 18),
(118, 22, 'sd_ho_lv1', 19),
(119, 22, 'sd_ho_lv1', 20),
(120, 22, 'sd_ho_lv1', 21),
(121, 22, 'sd_ho_lv1', 22),
(122, 22, 'sd_ho_lv1', 23),
(123, 22, 'sd_ho_lv1', 24),
(124, 22, 'sd_ho_lv1', 25),
(125, 22, 'sd_ho_lv1', 26),
(126, 22, 'sd_ho_lv1', 27),
(127, 22, 'sd_ho_lv1', 28),
(128, 22, 'sd_ho_lv1', 29),
(129, 22, 'sd_ho_lv1', 30),
(130, 22, 'sd_ho_lv1', 31),
(131, 22, 'sd_ho_lv1', 32),
(132, 22, 'sd_ho_lv1', 33),
(133, 23, 'sd_ho_lv1', 6),
(134, 23, 'sd_ho_lv1', 7),
(135, 23, 'sd_ho_lv1', 8),
(136, 23, 'sd_ho_lv1', 9),
(137, 23, 'sd_ho_lv1', 10),
(138, 23, 'sd_ho_lv1', 11),
(139, 23, 'sd_ho_lv1', 12),
(140, 23, 'sd_ho_lv1', 13),
(141, 23, 'sd_ho_lv1', 14),
(142, 23, 'sd_ho_lv1', 15),
(143, 23, 'sd_ho_lv1', 16);

-- --------------------------------------------------------

--
-- Table structure for table `dr_file`
--

CREATE TABLE `dr_file` (
  `id` int(11) NOT NULL,
  `id_user` int(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `name_file` varchar(255) NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `size` varchar(255) DEFAULT NULL,
  `type_file` varchar(255) DEFAULT NULL,
  `link` text NOT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `table_name` varchar(255) NOT NULL,
  `id_table` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `file_shared`
--

CREATE TABLE `file_shared` (
  `id` int(11) NOT NULL,
  `level1` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `name_file` varchar(255) NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `size` varchar(255) DEFAULT NULL,
  `type_file` varchar(255) DEFAULT NULL,
  `link` text NOT NULL,
  `remark` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `file_shared`
--

INSERT INTO `file_shared` (`id`, `level1`, `Description`, `name_file`, `upload_date`, `size`, `type_file`, `link`, `remark`) VALUES
(50, 'Steel Structure', 'Scanned PDF file - KN Office', '1. Drawing roofing KN (scanned).zip', '2024-12-21 11:06:22', '59.07 MB', 'Other', 'https://achivon.app/fileshared/1._Drawing_roofing_KN_(scanned).zip', ''),
(51, 'Steel Structure', 'Photo', '2. Photo roofing KN.zip', '2024-12-21 11:10:01', '35.70 MB', 'Other', 'https://achivon.app/fileshared/2._Photo_roofing_KN.zip', '');

-- --------------------------------------------------------

--
-- Table structure for table `params`
--

CREATE TABLE `params` (
  `id` int(11) NOT NULL,
  `param_name` varchar(255) NOT NULL,
  `param_group` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` int(30) DEFAULT NULL,
  `delete_at` int(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `params`
--

INSERT INTO `params` (`id`, `param_name`, `param_group`, `status`, `remark`, `created_at`, `updated_at`, `is_deleted`, `delete_at`) VALUES
(16, 'TCS', 'category', '', 'Tools Control System', '2024-09-10 04:19:29', '2024-09-19 02:36:25', NULL, NULL),
(17, 'CCS', 'category', '', 'Consumable Control System', '2024-09-10 04:19:42', '2024-09-19 02:36:38', NULL, NULL),
(18, 'EA', 'inisial_kuantitas', '', '', '2024-09-10 06:49:06', '2024-09-10 06:49:06', NULL, NULL),
(19, 'Meter', 'inisial_kuantitas', '', '', '2024-09-10 06:49:23', '2024-09-10 06:49:23', NULL, NULL),
(20, 'Kg', 'inisial_kuantitas', '', '', '2024-09-10 06:49:43', '2024-09-10 06:49:43', NULL, NULL),
(31, 'Warehouse', 'distribution_value', '', 'wh_warehouse', '2024-09-18 01:39:06', '2024-09-18 01:39:06', NULL, NULL),
(32, 'Employee', 'distribution_value', '', 'tbl_user', '2024-09-18 01:39:33', '2024-09-18 01:39:33', NULL, NULL),
(33, 'Supplier', 'distribution_value', '', 'tbl_suplayer', '2024-09-18 01:40:05', '2024-09-23 09:14:24', NULL, NULL),
(34, 'ECS', 'category', '', '', '2024-09-19 02:35:41', '2024-09-19 02:35:41', NULL, NULL),
(35, 'MCS', 'category', '', '', '2024-09-19 02:35:49', '2024-09-19 02:35:49', NULL, NULL),
(36, 'SCS', 'category', '', '', '2024-09-19 02:36:03', '2024-09-19 02:36:03', NULL, NULL),
(37, 'Power Tools', 'wh_level_1', '1', '', '2024-09-19 02:49:58', '2024-09-19 02:49:58', NULL, NULL),
(38, 'Non Power Tools', 'wh_level_1', '2', '', '2024-09-19 02:50:16', '2024-09-19 02:50:16', NULL, NULL),
(39, 'Wire', 'wh_level_2', '10', 'Power Tools', '2024-09-19 02:51:50', '2024-09-19 07:45:06', NULL, NULL),
(40, 'Wireless', 'wh_level_2', '20', 'Power Tools', '2024-09-19 02:52:27', '2024-09-19 02:52:27', NULL, NULL),
(41, 'Non Power Tools', 'wh_level_2', '10', 'Non Power Tools', '2024-09-19 06:47:00', '2024-09-19 06:47:00', NULL, NULL),
(42, 'Kunci Inggris', 'wh_level_3', '100', 'Non Power Tools', '2024-09-19 06:48:54', '2024-09-19 06:48:54', NULL, NULL),
(43, '6\"', 'wh_level_4', '10', 'Kunci Inggris', '2024-09-19 06:49:33', '2024-09-19 06:49:33', NULL, NULL),
(44, '8\"', 'wh_level_4', '11', 'Kunci Inggris', '2024-09-19 06:51:02', '2024-09-19 06:51:02', NULL, NULL),
(45, '10\"', 'wh_level_4', '12', 'Kunci Inggris', '2024-09-19 06:51:26', '2024-09-19 06:51:26', NULL, NULL),
(46, '12\"', 'wh_level_4', '13', 'Kunci Inggris', '2024-09-19 06:59:03', '2024-09-19 06:59:03', NULL, NULL),
(47, '15\"', 'wh_level_4', '14', 'Kunci Inggris', '2024-09-19 06:59:33', '2024-09-19 06:59:33', NULL, NULL),
(48, '18\"', 'wh_level_4', '15', 'Kunci Inggris', '2024-09-19 06:59:53', '2024-09-19 06:59:53', NULL, NULL),
(49, '24\"', 'wh_level_4', '16', 'Kunci Inggris', '2024-09-19 07:00:23', '2024-09-19 07:00:23', NULL, NULL),
(50, 'P&ID', 'KN_Chemical_Plant', '', '', '2024-11-22 02:02:23', '2024-11-24 06:07:03', NULL, NULL),
(51, 'Piping', 'KN_Chemical_Plant', '', '', '2024-11-22 02:03:23', '2024-11-22 02:03:23', NULL, NULL),
(52, 'Steel Structure', 'KN_Chemical_Plant', '', '', '2024-11-22 02:03:42', '2024-11-22 02:03:42', NULL, NULL),
(53, 'Equipment', 'KN_Chemical_Plant', '', '', '2024-11-22 02:04:01', '2024-11-22 02:04:01', NULL, NULL),
(57, 'List', 'P&ID', 'PID', 'KN_Chemical_Plant', '2024-11-24 04:15:43', '2024-11-24 06:09:42', NULL, NULL),
(58, 'Scanned PDF file - KN Office', 'P&ID', 'PID', 'KN_Chemical_Plant', '2024-11-24 04:16:45', '2024-11-24 08:24:34', NULL, NULL),
(59, 'CAD Drawing', 'P&ID', 'PID', 'KN_Chemical_Plant', '2024-11-24 04:17:17', '2024-11-24 06:09:55', NULL, NULL),
(60, 'CAD to PDF', 'P&ID', 'PID', 'KN_Chemical_Plant', '2024-11-24 04:17:59', '2024-11-24 06:10:01', NULL, NULL),
(61, 'List', 'Piping', 'Piping', 'KN_Chemical_Plant', '2024-11-24 04:18:27', '2024-11-24 06:12:15', NULL, NULL),
(62, 'Scanned PDF file - KN Office', 'Piping', 'Piping', 'KN_Chemical_Plant', '2024-11-24 04:45:06', '2024-11-24 08:24:26', NULL, NULL),
(63, 'CAD Drawing', 'Piping', 'Piping', 'KN_Chemical_Plant', '2024-11-24 04:45:23', '2024-11-24 06:12:25', NULL, NULL),
(64, 'CAD to PDF', 'Piping', 'Piping', 'KN_Chemical_Plant', '2024-11-24 04:45:41', '2024-11-24 06:12:31', NULL, NULL),
(65, 'Bill of Quantity', 'Piping', 'Piping', 'KN_Chemical_Plant', '2024-11-24 06:13:18', '2024-11-24 06:13:31', NULL, NULL),
(66, 'List', 'Steel Structure', 'Steel Structure', 'KN_Chemical_Plant', '2024-11-24 06:14:35', '2024-11-24 06:14:35', NULL, NULL),
(70, 'Scanned PDF file - KN Office', 'Steel Structure', 'Steel Structure', 'KN_Chemical_Plant', '2024-11-24 06:16:05', '2024-11-24 08:21:07', NULL, NULL),
(71, 'CAD Drawing', 'Steel Structure', 'Steel Structure', 'KN_Chemical_Plant', '2024-11-24 06:16:06', '2024-11-24 06:16:21', NULL, NULL),
(72, 'CAD to PDF', 'Steel Structure', 'Steel Structure', 'KN_Chemical_Plant', '2024-11-24 06:17:05', '2024-11-24 06:17:05', NULL, NULL),
(73, 'Bill of Quantity', 'Steel Structure', 'Steel Structure', 'KN_Chemical_Plant', '2024-11-24 06:17:47', '2024-11-24 06:17:47', NULL, NULL),
(74, 'Equipment List', 'Equipment', 'Equipment', 'KN_Chemical_Plant', '2024-11-24 06:18:13', '2024-11-24 06:18:13', NULL, NULL),
(75, 'Inspection Report', 'Equipment', 'Equipment', 'KN_Chemical_Plant', '2024-11-24 06:18:39', '2024-11-24 06:19:21', NULL, NULL),
(76, 'Other', 'P&ID', 'PID', 'KN_Chemical_Plant', '2024-11-24 06:20:19', '2024-11-24 06:20:51', NULL, NULL),
(77, 'Other', 'Piping', 'Piping', 'KN_Chemical_Plant', '2024-11-24 06:21:07', '2024-11-24 06:21:07', NULL, NULL),
(78, 'Photo', 'Steel Structure', 'Steel Structure', 'KN_Chemical_Plant', '2024-11-24 06:21:23', '2024-12-21 04:00:33', NULL, NULL),
(79, 'Other', 'Equipment', 'Equipment', 'KN_Chemical_Plant', '2024-11-24 06:21:42', '2024-11-24 06:21:42', NULL, NULL),
(80, 'Image', 'type_file', '', '', '2024-12-02 02:50:25', '2024-12-02 02:50:25', NULL, NULL),
(81, 'PDF Document', 'type_file', '', '', '2024-12-02 02:51:02', '2024-12-02 02:51:02', NULL, NULL),
(82, 'Word Document', 'type_file', '', '', '2024-12-02 02:51:11', '2024-12-02 02:51:11', NULL, NULL),
(83, 'Excel Document', 'type_file', '', '', '2024-12-02 02:51:22', '2024-12-02 02:51:22', NULL, NULL),
(84, 'AutoCAD File', 'type_file', '', '', '2024-12-02 02:51:31', '2024-12-02 02:51:31', NULL, NULL),
(85, 'Other', 'type_file', '', '', '2024-12-02 02:51:38', '2024-12-02 02:51:38', NULL, NULL),
(86, 'Other', 'Steel Structure', 'Steel Structure', 'KN_Chemical_Plant', '2024-12-21 03:57:40', '2024-12-21 03:57:40', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `procurement_po`
--

CREATE TABLE `procurement_po` (
  `id` int(30) NOT NULL,
  `po_number` int(255) NOT NULL,
  `Supplier_id` int(30) NOT NULL,
  `po_date` date NOT NULL,
  `expeted_date` date NOT NULL,
  `total_amount` int(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sd_ho_lv1`
--

CREATE TABLE `sd_ho_lv1` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `depart` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sd_ho_lv1`
--

INSERT INTO `sd_ho_lv1` (`id`, `name`, `link`, `depart`) VALUES
(1, 'A. Company Administration', '', 'ho'),
(2, 'B. Finance & Accounting', '', 'ho'),
(3, 'C. Human Resources', '', 'ho'),
(4, 'E. Project Control', '', 'ho'),
(5, 'G. Procurement', '', 'ho'),
(6, 'B. Finance & Accounting', '', 'project_berau'),
(7, 'C. Human Resources', '', 'project_berau'),
(8, 'D. Project Administration', '', 'project_berau'),
(9, 'E. Project Control', '', 'project_berau'),
(10, 'F. Engineering', '', 'project_berau'),
(11, 'G. Procurement', '', 'project_berau'),
(12, 'H. Warehouse', '', 'project_berau'),
(13, 'I. Construction', '', 'project_berau'),
(14, 'J. Quality Management', '', 'project_berau'),
(15, 'K. Safety Management', '', 'project_berau'),
(16, 'L. Commissioning', '', 'project_berau'),
(17, 'H01-Delivery Note', '', 'warehouse'),
(18, 'H02-Receiving Confirmation', '', 'warehouse'),
(19, 'H03-Report (Overage_Shortage_Damage)', '', 'warehouse'),
(20, 'H04-Material', '', 'warehouse'),
(21, 'H05-Construction Equipment', '', 'warehouse'),
(22, 'H06-Construction Mobil', '', 'warehouse'),
(23, 'H07-Container', '', 'warehouse'),
(24, 'H08-Storage Rack', '', 'warehouse'),
(25, 'H09-Tools & Devices', '', 'warehouse'),
(26, 'H10-Consumables', '', 'warehouse'),
(27, 'H11-Scaffolding', '', 'warehouse'),
(28, 'H12-Safety Items', '', 'warehouse'),
(29, 'H13-Quality Items', '', 'warehouse'),
(30, 'H14-Damaged & Repair Status', '', 'warehouse'),
(31, 'H15-Loss Status', '', 'warehouse'),
(32, 'H16-Waste & Scrap Status', '', 'warehouse'),
(33, 'H17-Others', '', 'warehouse');

-- --------------------------------------------------------

--
-- Table structure for table `sd_ho_lv2`
--

CREATE TABLE `sd_ho_lv2` (
  `id` int(255) NOT NULL,
  `lv1_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sd_ho_lv2`
--

INSERT INTO `sd_ho_lv2` (`id`, `lv1_id`, `name`, `link`) VALUES
(1, 1, 'A01-Company Registration & Renewal', ''),
(2, 1, 'A02-ISO Certificate & Renewal', ''),
(3, 1, 'A03-Mobil Registration & Renewal', ''),
(4, 1, 'A04-Tools/Devices Calibration & Certificate ', ''),
(5, 1, 'A05-VISA Processing', ''),
(6, 1, 'A06-Rental', ''),
(7, 1, 'A07-Contract General', ''),
(8, 1, 'A08-Others', ''),
(9, 2, 'B01-Accounting_Financing Report', ''),
(10, 2, 'B02-Payment Request', ''),
(11, 2, 'B03-Voucher', ''),
(12, 2, 'B04-Tax', ''),
(13, 2, 'B05-BPJS', ''),
(14, 2, 'B06-Others', ''),
(15, 3, 'C01-HR Recording Format', ''),
(16, 3, 'C02-Document Check List', ''),
(17, 3, 'C03-Contract', ''),
(18, 3, 'C04-Others', ''),
(19, 4, 'E01-Contract', ''),
(20, 4, 'E02-Report', ''),
(21, 4, 'E03-Invoice', ''),
(22, 4, 'E04-Schedule', ''),
(23, 4, 'E05-Organization', ''),
(24, 4, 'E06-Project Control & Operation', ''),
(25, 4, 'E10-Correspondence', ''),
(26, 5, 'G01-RFQ or RFP', ''),
(27, 5, 'G02-PO (Purchase Order)', ''),
(28, 6, 'B01-Accounting_Financing Report', ''),
(29, 6, 'B02-Payment Request', ''),
(30, 6, 'B03-Voucher', ''),
(31, 6, 'B04-Tax', ''),
(32, 6, 'B05-BPJS', ''),
(33, 6, 'B06-Others', ''),
(34, 7, 'C01-HR Recording Format', ''),
(35, 7, 'C02-Document Check List', ''),
(36, 7, 'C03-Contract', ''),
(37, 8, 'D01-Office Facility', ''),
(38, 8, 'D02-Stationary', ''),
(39, 8, 'D03-Electronics', ''),
(40, 8, 'D04-Office Consumables', ''),
(41, 8, 'D05-Water, Electric, Waste Disposal', ''),
(42, 8, 'D06-Accomodation', ''),
(43, 8, 'D07-Traveling', ''),
(44, 8, 'D08-Meal Management', ''),
(45, 8, 'D09-Rental', ''),
(46, 9, 'E01-Contract', ''),
(47, 9, 'E02-Report', ''),
(48, 9, 'E03-Invoice', ''),
(49, 9, 'E04-Schedule', ''),
(50, 9, 'E05-Organization', ''),
(51, 9, 'E06-Project Control & Operation', ''),
(52, 9, 'E07-Project Specification', ''),
(53, 9, 'E08-Procedure & Manual', ''),
(54, 9, 'E09-Meeting Minutes & Agenda', ''),
(55, 9, 'E10-Correspondence', ''),
(56, 9, 'E11-Others', ''),
(57, 10, 'F01-Process', ''),
(58, 10, 'F02-Civil', ''),
(59, 10, 'F03-Architecture', ''),
(60, 10, 'F04-Steel Structure', ''),
(61, 10, 'F05-Tank', ''),
(62, 10, 'F06-Mechnical Equipment', ''),
(63, 10, 'F07-Piping', ''),
(64, 10, 'F08-Firefighting', ''),
(65, 10, 'F09-HVAC', ''),
(66, 10, 'F10-Electric', ''),
(67, 10, 'F11-Instrument', ''),
(68, 10, 'F12-Painting', ''),
(69, 10, 'F13-Insulation', ''),
(70, 10, 'F14-Others', ''),
(71, 11, 'G01-RFQ or RFP', ''),
(72, 11, 'G02-PO (Purchase Order)', ''),
(73, 12, 'H01-Delivery Note', ''),
(74, 12, 'H02-Receiving Confirmation', ''),
(75, 12, 'H03-Report (Overage_Shortage_Damage)', ''),
(76, 12, 'H04-Material', ''),
(77, 12, 'H05-Construction Equipment', ''),
(78, 12, 'H06-Construction Mobil', ''),
(79, 12, 'H07-Container', ''),
(80, 12, 'H08-Storage Rack', ''),
(81, 12, 'H09-Tools & Devices', ''),
(82, 12, 'H10-Consumables', ''),
(83, 12, 'H11-Scaffolding', ''),
(84, 12, 'H12-Safety Items', ''),
(85, 12, 'H13-Quality Items', ''),
(86, 12, 'H14-Damaged & Repair Status', ''),
(87, 12, 'H15-Loss Status', ''),
(88, 12, 'H16-Waste & Scrap Status', ''),
(89, 12, 'H17-Others', ''),
(90, 13, 'I01-Civil', ''),
(91, 13, 'I02-Architecture', ''),
(92, 13, 'I03-Steel Structure', ''),
(93, 13, 'I04-Tank', ''),
(94, 13, 'I05-Mechnocal Equipment', ''),
(95, 13, 'I06-Piping', ''),
(96, 13, 'I07-Firefighting', ''),
(97, 13, 'I08-HVAC', ''),
(98, 13, 'I09-Electric', ''),
(99, 13, 'I10-Instrument', ''),
(100, 13, 'I11-Painting', ''),
(101, 13, 'I12-Insulation', ''),
(102, 13, 'I13-Temporary Facility', ''),
(103, 13, 'I14-Others', ''),
(104, 14, 'J01-Quality Plan & Procedure', ''),
(105, 14, 'J02-Inspection & Test Plan', ''),
(106, 14, 'J03-Test & Inspection Report', ''),
(107, 14, 'J04-Non-Conformance Report', ''),
(108, 14, 'J05-Non-Destructive Examination', ''),
(109, 14, 'J06-Others', ''),
(110, 15, 'K01-Safety Plan & Procedure', ''),
(111, 15, 'K02-Job Safety Analysis', ''),
(112, 15, 'K03-Safety Report', ''),
(113, 15, 'KK04-Others', ''),
(114, 20, 'H0401-Civil', ''),
(115, 20, 'H0402-Architecture', ''),
(116, 20, 'H0403-Steel Structure', ''),
(117, 20, 'H0404-Tank', ''),
(118, 20, 'H0405-Mechnocal Equipment', ''),
(119, 20, 'H0406-Piping', ''),
(120, 20, 'H0407-Firefighting', ''),
(121, 20, 'H0408-HVAC', ''),
(122, 20, 'H0409-Electric', ''),
(123, 20, 'H0410-Instrument', ''),
(124, 20, 'H0411-Painting', ''),
(125, 20, 'H0412-Insulation', ''),
(126, 20, 'H0413-Temporary Facility', ''),
(127, 21, 'H0501-Operation Status', ''),
(128, 21, 'H0502-Fuel Control', ''),
(129, 22, 'H0601-Operation Status', ''),
(130, 23, 'H0701-20ft Container', ''),
(131, 23, 'H0702-40ft Container', ''),
(132, 24, 'H0801-Fabricated Rack', ''),
(133, 24, 'H0802-Purchassed Rack', ''),
(134, 25, 'H0901-Power Tools & Devices', ''),
(135, 25, 'H0902-Non-Power Tools & Devices', ''),
(136, 25, 'H0903-Electric Tools & Devices', ''),
(137, 25, 'H0904-Safety Tools & Devices', ''),
(138, 25, 'H0905-Quality Tools & Devices', ''),
(139, 26, 'H1001-Common Consumable', ''),
(140, 26, 'H1002-Steel Works Consumables', ''),
(141, 26, 'H1003-Non-Metal Works Consumables', ''),
(142, 26, 'H1004-Welding Consumables', ''),
(143, 26, 'H1005-Test Consumables', ''),
(144, 26, 'H1006-Electrical Consumables', ''),
(145, 28, 'H1201-Tools & Devices', ''),
(146, 28, 'H1202-Safety Consumables', ''),
(147, 28, 'H1203-Others', ''),
(148, 29, 'H1301-Tools & Devices', '');

-- --------------------------------------------------------

--
-- Table structure for table `sd_ho_lv3`
--

CREATE TABLE `sd_ho_lv3` (
  `id` int(255) NOT NULL,
  `lv2_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sd_ho_lv3`
--

INSERT INTO `sd_ho_lv3` (`id`, `lv2_id`, `name`, `link`) VALUES
(1, 1, 'A0101-Company Name', ''),
(2, 1, 'A0102-AKTA', ''),
(3, 1, 'A0103-Company Share Holder & Stock Share', ''),
(4, 1, 'A0104-Company Domicile', ''),
(5, 1, 'A0105-Izin Lokasi', ''),
(6, 1, 'A0106-NIB', ''),
(7, 1, 'A0107-IUJK and/or SIUP', ''),
(8, 1, 'A0108-KTA and/or SBU', ''),
(9, 1, 'A0109-Tax (VAT & NPWP)', ''),
(10, 6, 'A0601-Office', ''),
(11, 6, 'A0602-Camp', ''),
(12, 6, 'A0603-Warehouse', ''),
(13, 6, 'A0604-Office Electronics', ''),
(14, 9, 'B0101-Monthly', ''),
(15, 9, 'B0102-Yearly', ''),
(16, 16, 'C0201-Direct', ''),
(17, 16, 'C0202-Indirect', ''),
(18, 17, 'C0301-Direct', ''),
(19, 17, 'C0302-Indirect', ''),
(20, 19, 'E0101-Main Contract', ''),
(21, 19, 'E0102-Subcontract', ''),
(22, 19, 'E0103-Other Contract', ''),
(23, 20, 'E0201-Format', ''),
(24, 24, 'E0601-Kick Off Meerting', ''),
(25, 24, 'E0602-Execution Plan', ''),
(26, 24, 'E0603-Construction Completion Certificate', ''),
(27, 24, 'E0604-Final Acceptance Certificate', ''),
(28, 24, 'E0605-Others', ''),
(29, 25, 'E1001-Format', ''),
(30, 25, 'E1002-With Home Office', ''),
(31, 26, 'G0101-Material', ''),
(32, 26, 'G0102-Construction Equipment', ''),
(33, 26, 'G0103-Tools & Devices', ''),
(34, 26, 'G0104-Consumables', ''),
(35, 26, 'G0105-Scaffolding', ''),
(36, 26, 'G0106-Safety Items', ''),
(37, 26, 'G0107-Quality Items', ''),
(38, 26, 'G0108-Others', ''),
(39, 27, 'G0201-Material', ''),
(40, 27, 'G0202-Construction Equipment', ''),
(41, 27, 'G0203-Tools & Devices', ''),
(42, 27, 'G0204-Consumables', ''),
(43, 27, 'G0205-Scaffolding', ''),
(44, 27, 'G0206-Safety Items', ''),
(45, 27, 'G0207-Quality Items', ''),
(46, 27, 'G0208-Others', ''),
(47, 6, 'B0101-Monthly', ''),
(48, 6, 'B0102-Yearly', ''),
(49, 35, 'C0201-Direct', ''),
(50, 35, 'C0202-Indirect', ''),
(51, 36, 'C0301-Direct', ''),
(52, 36, 'C0302-Indirect', ''),
(53, 45, 'A0901-Office', ''),
(54, 45, 'A0902-Camp', ''),
(55, 45, 'A0903-Warehouse', ''),
(56, 45, 'A0904-Office Electronics', ''),
(57, 46, 'E0101-Main Contract', ''),
(58, 46, 'E0102-Subcontract', ''),
(59, 46, 'E0103-Other Contract', ''),
(60, 47, 'E0201-Format', ''),
(61, 47, 'E0202-Daily', ''),
(62, 47, 'E0203-Weekly', ''),
(63, 47, 'E0204-Monthly', ''),
(64, 47, 'E0205-Document Tracking', ''),
(65, 47, 'E0206-Drawing Status', ''),
(66, 47, 'E0206-PO Status', ''),
(67, 47, 'E0207-Project Close Out', ''),
(68, 47, 'E0208-Others', ''),
(69, 51, 'E0601-Kick Off Meerting', ''),
(70, 51, 'E0602-Execution Plan', ''),
(71, 51, 'E0603-Construction Completion Certificate', ''),
(72, 51, 'E0604-Final Acceptance Certificate', ''),
(73, 51, 'E0605-Others', ''),
(74, 52, 'E0701-Common', ''),
(75, 52, 'E0702-Civil', ''),
(76, 52, 'E0703-Architecture', ''),
(77, 52, 'E0704-Steel Structure', ''),
(78, 52, 'E0705-Tank', ''),
(79, 52, 'E0706-Mechnocal Equipment', ''),
(80, 52, 'E0707-Piping', ''),
(81, 52, 'E0708-Firefighting', ''),
(82, 52, 'E0709-HVAC', ''),
(83, 52, 'E0710-Electric', ''),
(84, 52, 'E0711-Instrument', ''),
(85, 52, 'E0712-Painting', ''),
(86, 52, 'E0713-Insulation', ''),
(87, 52, 'E0714-Others', ''),
(88, 53, 'E0801-Standard Procedure & Manual', ''),
(89, 53, 'E0802-Project Procedure & Manual', ''),
(90, 53, 'E0803-Licensor Procedure & Manual', ''),
(91, 53, 'E0804- Other', ''),
(92, 54, 'E0901-Format', ''),
(93, 54, 'E0902-with Client', ''),
(94, 54, 'E0903-with Licensor', ''),
(95, 54, 'E0904-with Vendor', ''),
(96, 54, 'E0905-with Sub-Contractor', ''),
(97, 54, 'E0906-with Internal', ''),
(98, 54, 'E0907-with Others', ''),
(99, 55, 'E1001-Format', ''),
(100, 55, 'E1002-With Home Office', ''),
(101, 55, 'E1003-Project Internal', ''),
(102, 55, 'E1004-With Client', ''),
(103, 55, 'E1005-With Licensor', ''),
(104, 55, 'E1006-With Vendor', ''),
(105, 55, 'E1007-With Sub-Contractor', ''),
(106, 55, 'E1008-Between Others (Government, etc)', ''),
(107, 57, 'F0101-Process Data & Calculaltion', ''),
(108, 57, 'F0102-P & ID', ''),
(109, 57, 'F0103-PFD', ''),
(110, 57, 'F0104-Project Layout', ''),
(111, 57, 'F0105-Others', ''),
(112, 58, 'F0201-Calculation', ''),
(113, 58, 'F0202-Location Plan & Map', ''),
(114, 58, 'F0203-Drawing', ''),
(115, 58, 'F0204-Bill of Quantity', ''),
(116, 58, 'F0205-Work Method Statement', ''),
(117, 59, 'F0301-Calculation', ''),
(118, 59, 'F0302-Location Plan', ''),
(119, 59, 'F0303-Drawing', ''),
(120, 59, 'F0304-Bill of Quantity', ''),
(121, 59, 'F0305-Work Method Statement', ''),
(122, 60, 'F0401-Calculation', ''),
(123, 60, 'F0402-Location Plan', ''),
(124, 60, 'F0403-Drawing', ''),
(125, 60, 'F0404-Bill of Quantity', ''),
(126, 60, 'F0405-Work Method Statement', ''),
(127, 61, 'F0501-Calculation', ''),
(128, 61, 'F0502-Location Plan', ''),
(129, 61, 'F0503-Drawing', ''),
(130, 61, 'F0504-Bill of Quantity', ''),
(131, 61, 'F0505-Work Method Statement', ''),
(132, 62, 'F0601-Calculation', ''),
(133, 62, 'F0602-Equipment Layout & Location Plan', ''),
(134, 62, 'F0603-Drawing', ''),
(135, 62, 'F0604-Vendor Print', ''),
(136, 62, 'F0605-Bill of Quantity', ''),
(137, 62, 'F0606-Spare Parts', ''),
(138, 62, 'F0607-Work Method Statement', ''),
(139, 63, 'F0701-Calculation', ''),
(140, 63, 'F0702-Piping Plan', ''),
(141, 63, 'F0703-Drawing', ''),
(142, 63, 'F0704-Bill of Quantity', ''),
(143, 63, 'F0705-Work Method Statement', ''),
(144, 64, 'F0801-Calculation', ''),
(145, 64, 'F0802-Firefighting Plan', ''),
(146, 64, 'F0803-Drawing', ''),
(147, 64, 'F0804-Bill of Quantity', ''),
(148, 64, 'F0805-Work Method Statement', ''),
(149, 65, 'F0901-Calculation', ''),
(150, 65, 'F0902-Location Plan', ''),
(151, 65, 'F0903-Diagram and/or Drawing', ''),
(152, 65, 'F0904-Bill of Quantity', ''),
(153, 65, 'F0905-Work Method Statement', ''),
(154, 66, 'F1001-Calculation', ''),
(155, 66, 'F1002-Location Plan', ''),
(156, 66, 'F1003-Diagram and/or Drawing', ''),
(157, 66, 'F1004-Bill of Quantity', ''),
(158, 66, 'F1005-Work Method Statement', ''),
(159, 67, 'F1101-Calculation', ''),
(160, 67, 'F1102-Location Plan', ''),
(161, 67, 'F1103-Diagram and/or Drawing', ''),
(162, 67, 'F1104-Bill of Quantity', ''),
(163, 67, 'F1105-Work Method Statement', ''),
(164, 68, 'F1201-Calculation', ''),
(165, 68, 'F1202-Bill of Quantity', ''),
(166, 68, 'F1203-Work Method Statement', ''),
(167, 69, 'F1301-Calculation', ''),
(168, 69, 'F1302-Bill of Quantity', ''),
(169, 69, 'F1303-Work Method Statement', ''),
(170, 71, 'G0101-Material', ''),
(171, 71, 'G0102-Construction Equipment', ''),
(172, 71, 'G0103-Tools & Devices', ''),
(173, 71, 'G0104-Consumables', ''),
(174, 71, 'G0105-Scaffolding', ''),
(175, 71, 'G0106-Safety Items', ''),
(176, 71, 'G0107-Quality Items', ''),
(177, 71, 'G0108-Others', ''),
(178, 72, 'G0201-Material', ''),
(179, 72, 'G0202-Construction Equipment', ''),
(180, 72, 'G0203-Tools & Devices', ''),
(181, 72, 'G0204-Consumables', ''),
(182, 72, 'G0205-Scaffolding', ''),
(183, 72, 'G0206-Safety Items', ''),
(184, 72, 'G0207-Quality Items', ''),
(185, 72, 'G0208-Others', ''),
(186, 76, 'H0401-Civil', ''),
(187, 76, 'H0402-Architecture', ''),
(188, 76, 'H0403-Steel Structure', ''),
(189, 76, 'H0404-Tank', ''),
(190, 76, 'H0405-Mechnocal Equipment', ''),
(191, 76, 'H0406-Piping', ''),
(192, 76, 'H0407-Firefighting', ''),
(193, 76, 'H0408-HVAC', ''),
(194, 76, 'H0409-Electric', ''),
(195, 76, 'H0410-Instrument', ''),
(196, 76, 'H0411-Painting', ''),
(197, 76, 'H0412-Insulation', ''),
(198, 76, 'H0413-Temporary Facility', ''),
(199, 77, 'H0501-Operation Status', ''),
(200, 77, 'H0502-Fuel Control', ''),
(201, 78, 'H0601-Operation Status', ''),
(202, 79, 'H0701-20ft Container', ''),
(203, 79, 'H0702-40ft Container', ''),
(204, 80, 'H0801-Fabricated Rack', ''),
(205, 80, 'H0802-Purchassed Rack', ''),
(206, 81, 'H0901-Power Tools & Devices', ''),
(207, 81, 'H0902-Non-Power Tools & Devices', ''),
(208, 81, 'H0903-Electric Tools & Devices', ''),
(209, 81, 'H0904-Safety Tools & Devices', ''),
(210, 81, 'H0905-Quality Tools & Devices', ''),
(211, 82, 'H1001-Common Consumable', ''),
(212, 82, 'H1002-Steel Works Consumables', ''),
(213, 82, 'H1003-Non-Metal Works Consumables', ''),
(214, 82, 'H1004-Welding Consumables', ''),
(215, 82, 'H1005-Test Consumables', ''),
(216, 82, 'H1006-Electrical Consumables', ''),
(217, 84, 'H1201-Tools & Devices', ''),
(218, 84, 'H1202-Safety Consumables', ''),
(219, 84, 'H1203-Others', ''),
(220, 85, 'H1301-Tools & Devices', ''),
(221, 106, 'J0301-Civil', ''),
(222, 106, 'J0302-Architecture', ''),
(223, 106, 'J0303-teel Structure', ''),
(224, 106, 'J0304-Tank', ''),
(225, 106, 'J0305-Mechnocal Equipment', ''),
(226, 106, 'J0306-Piping', ''),
(227, 106, 'J0307-Firefighting', ''),
(228, 106, 'J0308-HVAC', ''),
(229, 106, 'J0309-Electric', ''),
(230, 106, 'J0310-Instrument', ''),
(231, 106, 'J0311-Painting', ''),
(232, 106, 'J0312-Insulation', ''),
(233, 112, 'k0301-Daily', ''),
(234, 112, 'K0302-Weekly', ''),
(235, 112, 'K0303-Monthly', ''),
(236, 112, 'K0304-Accident', ''),
(237, 112, 'K0305-Surveillance', ''),
(238, 127, 'H0501A-Daily', ''),
(239, 127, 'H0501B-Weekly', ''),
(240, 127, 'H0501C-Monthly', ''),
(241, 128, 'H0502A-Daily', ''),
(242, 128, 'H0502B-Weekly', ''),
(243, 128, 'H0502C-Monthly', '');

-- --------------------------------------------------------

--
-- Table structure for table `sd_ho_lv4`
--

CREATE TABLE `sd_ho_lv4` (
  `id` int(255) NOT NULL,
  `lv3_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sd_ho_lv4`
--

INSERT INTO `sd_ho_lv4` (`id`, `lv3_id`, `name`, `link`) VALUES
(1, 29, 'E1001A-Letter', ''),
(2, 29, 'E1001B-Transmittal', ''),
(3, 29, 'E1001C-E-mail', ''),
(4, 29, 'E1001D-Others', ''),
(5, 30, 'E1002A-Incoming', ''),
(6, 30, 'E1002B-Outgoing', ''),
(7, 31, 'G0101A-Civil', ''),
(8, 31, 'G0101B-Architecture', ''),
(9, 31, 'G0101C-Steel Structure', ''),
(10, 31, 'G0101D-Tank', ''),
(11, 31, 'G0101E-Mechnocal Equipment', ''),
(12, 31, 'G0101F-Piping', ''),
(13, 31, 'G0101G-Firefighting', ''),
(14, 31, 'G0101H-HVAC', ''),
(15, 31, 'G0101I-Electric', ''),
(16, 31, 'G0101J-Instrument', ''),
(17, 31, 'G0101K-Painting', ''),
(18, 31, 'G0101L-Insulation', ''),
(19, 31, 'G0101M-Spare Parts', ''),
(20, 31, 'G0101N-Temporary Facility', ''),
(21, 39, 'G0201A-Civil', ''),
(22, 39, 'G0201B-Architecture', ''),
(23, 39, 'G0201C-Steel Structure', ''),
(24, 39, 'G0201D-Tank', ''),
(25, 39, 'G0201E-Mechnocal Equipment', ''),
(26, 39, 'G0201F-Piping', ''),
(27, 39, 'G0201G-Firefighting', ''),
(28, 39, 'G0201H-HVAC', ''),
(29, 39, 'G0201I-Electric', ''),
(30, 39, 'G0201J-Instrument', ''),
(31, 39, 'G0201K-Painting', ''),
(32, 39, 'G0201L-Insulation', ''),
(33, 39, 'G0201M-Temporary Facility', ''),
(34, 99, 'E1001A-Letter', ''),
(35, 99, 'E1001B-Transmittal', ''),
(36, 99, 'E1001C-E-mail', ''),
(37, 99, 'E1001D-Others', ''),
(38, 100, 'E1002A-Incoming', ''),
(39, 100, 'E1002B-Outgoing', ''),
(40, 101, 'E1003A-Incoming', ''),
(41, 101, 'E1003B-Outgoing', ''),
(42, 102, 'E1004A-Incoming', ''),
(43, 102, 'E1004B-Outgoing', ''),
(44, 103, 'E1005A-Incoming', ''),
(45, 103, 'E1005B-Outgoing', ''),
(46, 104, 'E1006A-Incoming', ''),
(47, 104, 'E1006B-Outgoing', ''),
(48, 105, 'E1007A-Incoming', ''),
(49, 105, 'E1007B-Outgoing', ''),
(50, 106, 'E1008A-Incoming', ''),
(51, 106, 'E1008B-Outgoing', ''),
(52, 170, 'G0101A-Civil', ''),
(53, 170, 'G0101B-Architecture', ''),
(54, 170, 'G0101C-Steel Structure', ''),
(55, 170, 'G0101D-Tank', ''),
(56, 170, 'G0101E-Mechnocal Equipment', ''),
(57, 170, 'G0101F-Piping', ''),
(58, 170, 'G0101G-Firefighting', ''),
(59, 170, 'G0101H-HVAC', ''),
(60, 170, 'G0101I-Electric', ''),
(61, 170, 'G0101J-Instrument', ''),
(62, 170, 'G0101K-Painting', ''),
(63, 170, 'G0101L-Insulation', ''),
(64, 170, 'G0101M-Spare Parts', ''),
(65, 170, 'G0101N-Temporary Facility', ''),
(66, 178, 'G0201A-Civil', ''),
(67, 178, 'G0201B-Architecture', ''),
(68, 178, 'G0201C-Steel Structure', ''),
(69, 178, 'G0201D-Tank', ''),
(70, 178, 'G0201E-Mechnocal Equipment', ''),
(71, 178, 'G0201F-Piping', ''),
(72, 178, 'G0201G-Firefighting', ''),
(73, 178, 'G0201H-HVAC', ''),
(74, 178, 'G0201I-Electric', ''),
(75, 178, 'G0201J-Instrument', ''),
(76, 178, 'G0201K-Painting', ''),
(77, 178, 'G0201L-Insulation', ''),
(78, 178, 'G0201M-Temporary Facility', ''),
(79, 199, 'H0501A-Daily', ''),
(80, 199, 'H0501B-Weekly', ''),
(81, 199, 'H0501C-Monthly', ''),
(82, 200, 'H0502A-Daily', ''),
(83, 200, 'H0502B-Weekly', ''),
(84, 200, 'H0502C-Monthly', '');

-- --------------------------------------------------------

--
-- Table structure for table `sd_ho_lv5`
--

CREATE TABLE `sd_ho_lv5` (
  `id` int(255) NOT NULL,
  `lv4_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sd_ho_lv5`
--

INSERT INTO `sd_ho_lv5` (`id`, `lv4_id`, `name`, `link`) VALUES
(1, 5, 'E1002A1-Letter', ''),
(2, 5, 'E1002A2-Transmittal', ''),
(3, 5, 'E1002A3-E-mail', ''),
(4, 5, 'E1002A4-SNS & Others', ''),
(5, 6, 'E1002B1-Letter', ''),
(6, 6, 'E1002B2-Transmittal', ''),
(7, 6, 'E1002B3-E-mail', ''),
(8, 6, 'E1002B4-SNS & Others', ''),
(9, 38, 'E1002A1-Letter', ''),
(10, 38, 'E1002A2-Transmittal', ''),
(11, 38, 'E1002A3-E-mail', ''),
(12, 38, 'E1002A4-SNS & Others', ''),
(13, 39, 'E1002B1-Letter', ''),
(14, 39, 'E1002B2-Transmittal', ''),
(15, 39, 'E1002B3-E-mail', ''),
(16, 39, 'E1002B4-SNS & Others', ''),
(17, 40, 'E1003A1-Letter', ''),
(18, 40, 'E1003A2-Transmittal', ''),
(19, 40, 'E1003A3-E-mail', ''),
(20, 40, 'E1003A4-SNS & Others', ''),
(21, 41, 'E1003B1-Letter', ''),
(22, 41, 'E1003B2-Transmittal', ''),
(23, 41, 'E1003B3-E-mail', ''),
(24, 41, 'E1003B4-SNS & Others', ''),
(25, 42, 'E1004A1-Letter', ''),
(26, 42, 'E1004A2-Transmittal', ''),
(27, 42, 'E1004A3-E-mail', ''),
(28, 42, 'E1004A4-SNS & Others', ''),
(29, 43, 'E1004B1-Letter', ''),
(30, 43, 'E1004B2-Transmittal', ''),
(31, 43, 'E1004B3-E-mail', ''),
(32, 43, 'E1004B4-SNS & Others', ''),
(33, 44, 'E1005A1-Letter', ''),
(34, 44, 'E1005A2-Transmittal', ''),
(35, 44, 'E10052A3-E-mail', ''),
(36, 44, 'E1005A4-SNS & Others', ''),
(37, 45, 'E1005B1-Letter', ''),
(38, 45, 'E1005B2-Transmittal', ''),
(39, 45, 'E1005B3-E-mail', ''),
(40, 45, 'E1005B4-SNS & Others', ''),
(41, 46, 'E1006A1-Letter', ''),
(42, 46, 'E1006A2-Transmittal', ''),
(43, 46, 'E1006A3-E-mail', ''),
(44, 46, 'E1006A4-SNS & Others', ''),
(45, 47, 'E1006B1-Letter', ''),
(46, 47, 'E1006B2-Transmittal', ''),
(47, 47, 'E1006B3-E-mail', ''),
(48, 47, 'E1006B4-SNS & Others', ''),
(49, 48, 'E1007A1-Letter', ''),
(50, 48, 'E1007A2-Transmittal', ''),
(51, 48, 'E1007A3-E-mail', ''),
(52, 48, 'E1007A4-SNS & Others', ''),
(53, 49, 'E1007B1-Letter', ''),
(54, 49, 'E1007B2-Transmittal', ''),
(55, 49, 'E1007B3-E-mail', ''),
(56, 49, 'E1007B4-SNS & Others', ''),
(57, 50, 'E1008A1-Letter', ''),
(58, 50, 'E1008A2-E-mail', ''),
(59, 50, 'E1008A3-SNS & Others', ''),
(60, 51, 'E1008B1-Letter', ''),
(61, 51, 'E1008B2-E-mail', ''),
(62, 51, 'E1008B3-SNS & Others', '');

-- --------------------------------------------------------

--
-- Table structure for table `sd_ho_lv6`
--

CREATE TABLE `sd_ho_lv6` (
  `id` int(255) NOT NULL,
  `lv5_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sd_ho_lv7`
--

CREATE TABLE `sd_ho_lv7` (
  `id` int(255) NOT NULL,
  `lv6_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sd_ho_lv8`
--

CREATE TABLE `sd_ho_lv8` (
  `id` int(255) NOT NULL,
  `lv7_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sd_ho_lv9`
--

CREATE TABLE `sd_ho_lv9` (
  `id` int(255) NOT NULL,
  `lv8_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sd_ho_lv10`
--

CREATE TABLE `sd_ho_lv10` (
  `id` int(255) NOT NULL,
  `lv9_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `_id` int(11) NOT NULL,
  `kode_barang` char(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga_barang` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_barang`
--

INSERT INTO `tbl_barang` (`_id`, `kode_barang`, `nama_barang`, `harga_barang`, `stok`, `created_at`) VALUES
(1, 'P-001', 'Panci Ajaib', 700000, 80, '2021-02-14 04:18:50'),
(2, 'P-002', 'Panci Kurang Ajaib Tapi Boong', 1000000, 128, '2021-01-28 15:41:06'),
(3, 'P-003', 'Panci Anti Perang', 1500000, 149, '2021-02-13 14:41:45');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang_masuk`
--

CREATE TABLE `tbl_barang_masuk` (
  `_id` int(11) NOT NULL,
  `kode_faktur` char(15) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_barang_masuk`
--

INSERT INTO `tbl_barang_masuk` (`_id`, `kode_faktur`, `id_barang`, `jumlah`, `tgl_masuk`, `created_at`) VALUES
(24, 'm-001', 1, 50, '2021-01-20', '2021-01-20 15:53:53'),
(25, 'M-002', 3, 50, '2021-02-13', '2021-02-13 14:41:15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_catatan`
--

CREATE TABLE `tbl_catatan` (
  `_id` int(11) NOT NULL,
  `id_penjualan` int(11) NOT NULL,
  `catatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_catatan`
--

INSERT INTO `tbl_catatan` (`_id`, `id_penjualan`, `catatan`) VALUES
(1, 1, 'test'),
(2, 1, 'dfgdkfghdlfgh');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_levels`
--

CREATE TABLE `tbl_levels` (
  `_id` int(11) NOT NULL,
  `id_posisi` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_levels`
--

INSERT INTO `tbl_levels` (`_id`, `id_posisi`, `id_menu`) VALUES
(2, 1, 2),
(3, 1, 3),
(4, 1, 5),
(5, 1, 6),
(6, 1, 7),
(7, 1, 9),
(8, 1, 8),
(9, 1, 10),
(10, 1, 13),
(11, 1, 14),
(12, 1, 15),
(13, 1, 1),
(14, 2, 1),
(15, 2, 2),
(16, 2, 5),
(23, 5, 5),
(24, 5, 7),
(25, 5, 8),
(26, 5, 9),
(27, 6, 8),
(28, 6, 10),
(29, 8, 5),
(30, 8, 6),
(31, 8, 7),
(32, 1, 16),
(33, 1, 17),
(34, 1, 18),
(35, 1, 19),
(36, 1, 20),
(37, 2, 17),
(38, 2, 19),
(39, 2, 16),
(40, 1, 21),
(42, 1, 22),
(43, 1, 23),
(44, 1, 24),
(45, 1, 25),
(46, 1, 26),
(47, 1, 27),
(48, 1, 28),
(49, 1, 29),
(50, 1, 30),
(51, 12, 26),
(52, 12, 27),
(53, 12, 25),
(54, 12, 28),
(55, 12, 29),
(56, 12, 30),
(57, 13, 30),
(58, 13, 29),
(59, 13, 28),
(60, 13, 27),
(62, 1, 31),
(63, 1, 32),
(64, 1, 33),
(65, 1, 34),
(66, 1, 35),
(67, 1, 36),
(68, 1, 37),
(69, 1, 38),
(70, 1, 39),
(71, 1, 40),
(72, 1, 41),
(73, 1, 42),
(74, 1, 43),
(75, 1, 44),
(76, 1, 45),
(77, 1, 46),
(78, 1, 47),
(79, 1, 48),
(80, 1, 49),
(81, 1, 50),
(82, 1, 51),
(83, 1, 52),
(84, 1, 53),
(85, 1, 54),
(86, 1, 55),
(87, 1, 56),
(88, 1, 57),
(89, 1, 58),
(90, 1, 59),
(91, 1, 60),
(92, 1, 61),
(93, 1, 62),
(94, 1, 63),
(95, 1, 64),
(96, 1, 65),
(97, 1, 66),
(98, 12, 34),
(99, 12, 35),
(100, 12, 36),
(101, 12, 37),
(102, 12, 38),
(103, 12, 39),
(104, 12, 40),
(105, 12, 41),
(106, 12, 42),
(107, 12, 43),
(108, 12, 44),
(109, 12, 45),
(110, 12, 46),
(111, 12, 47),
(112, 12, 48),
(113, 12, 49),
(114, 12, 50),
(115, 12, 51),
(116, 12, 52),
(117, 12, 53),
(118, 12, 54),
(119, 12, 55),
(120, 12, 56),
(121, 12, 57),
(122, 12, 58),
(123, 12, 59),
(124, 12, 60),
(125, 12, 61),
(126, 12, 62),
(127, 12, 63),
(128, 12, 64),
(129, 12, 65),
(130, 12, 66),
(131, 13, 34),
(132, 13, 35),
(133, 13, 36),
(134, 13, 37),
(135, 13, 38),
(136, 13, 39),
(137, 13, 40),
(138, 13, 41),
(139, 13, 42),
(140, 13, 43),
(141, 13, 44),
(142, 13, 45),
(143, 13, 46),
(144, 13, 47),
(145, 13, 48),
(146, 13, 49),
(147, 13, 50),
(148, 13, 51),
(149, 13, 52),
(150, 13, 53),
(151, 13, 54),
(152, 13, 55),
(153, 13, 56),
(154, 13, 57),
(155, 13, 58),
(156, 13, 59),
(157, 13, 60),
(158, 13, 61),
(159, 13, 62),
(160, 13, 63),
(161, 13, 64),
(162, 13, 65),
(163, 13, 66),
(165, 13, 25),
(166, 1, 67),
(167, 1, 68),
(168, 12, 67),
(169, 12, 68),
(170, 13, 67),
(171, 13, 68),
(173, 14, 25),
(174, 14, 29),
(175, 14, 57),
(176, 14, 53),
(177, 1, 69),
(178, 1, 70),
(179, 1, 71),
(180, 1, 72),
(181, 1, 73),
(182, 1, 75),
(183, 1, 76),
(184, 1, 77),
(185, 1, 78),
(186, 1, 79),
(187, 1, 80),
(189, 15, 78),
(190, 15, 79),
(191, 15, 80),
(192, 15, 77);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menus`
--

CREATE TABLE `tbl_menus` (
  `_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `is_main` int(11) NOT NULL,
  `is_aktif` int(11) NOT NULL,
  `ordinal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_menus`
--

INSERT INTO `tbl_menus` (`_id`, `title`, `uri`, `icon`, `is_main`, `is_aktif`, `ordinal`) VALUES
(1, 'Users', '#', 'fa fa-users', 0, 1, 1),
(2, 'Pegawai', 'admin/users', 'fa fa-user', 1, 1, 1),
(3, 'Posisi', 'admin/posisi', 'fas fa-user-shield', 1, 1, 2),
(5, 'Warehouse', '#', 'fa fa-warehouse', 0, 0, 3),
(6, 'Barang masuk', 'admin/barang', 'fa fa-truck-loading', 5, 0, 1),
(7, 'Barang', 'admin/barang', 'fas fa-boxes', 5, 0, 2),
(8, 'Transaksi', '#', 'fa fa-cash-register', 0, 0, 3),
(9, 'Penjualan', 'admin/penjualan', 'fa fa-file-invoice-dollar', 8, 1, 1),
(10, 'Penagihan', 'admin/penagihan', 'fas fa-receipt', 8, 0, 2),
(13, 'Laporan', '#', 'fa fa-file-invoice-dollar', 0, 0, 4),
(14, 'Aplikasi', '#', 'fas fa-cog', 0, 1, 0),
(15, 'Menu Aplikasi', 'admin/menu', 'fas fa-cog', 14, 1, 1),
(16, 'Items Management', 'admin/stock', 'fas fa-boxes', 5, 1, 1),
(17, 'Distribution Management', 'admin/distribution', 'fas fa-boxes', 5, 1, 2),
(18, 'Report', '#', 'fas fa-boxes', 5, 0, 6),
(19, 'Warehouse Management', '#', 'fas fa-boxes', 5, 1, 5),
(20, 'Params', 'admin/params', 'fas fa-cog', 14, 1, 2),
(21, 'Request Item', 'admin/requestitem', 'fas fa-clipboard-list', 5, 1, 4),
(22, 'Supplier', 'admin/supplier', 'fas fa-handshake', 23, 1, 2),
(23, 'Procurement', '#', 'fa fa-shopping-basket', 0, 0, 1),
(24, 'Purchase Order', 'admin/po', 'fas fa-cart-plus', 23, 1, 2),
(25, 'KN Chemical Plant', '#', 'fas fa-drafting-compass', 0, 1, 7),
(26, 'Admin Share', 'admin/adminshare', 'fas fa-user-plus', 25, 1, 1),
(27, 'P&ID', 'admin/filesharepid', 'fas fa-folder', 25, 0, 2),
(28, 'Piping', 'admin/filesharedpiping', 'fas fa-folder', 25, 1, 3),
(29, 'Steel Structure', 'admin/filesharedsteelstructure', 'fas fa-folder', 25, 1, 4),
(30, 'Equipment', 'admin/fileshareequipment', 'fas fa-folder', 25, 1, 5),
(34, 'All', 'admin/fileshareequipment/all', 'fas fa-angle-double-right', 30, 1, 1),
(35, 'Equipment List', 'admin/fileshareequipment/Equipment List', 'fas fa-angle-double-right', 30, 1, 1),
(36, 'Inspection Report', 'admin/fileshareequipment/Inspection Report', 'fas fa-angle-double-right', 30, 1, 1),
(37, 'Other', 'admin/fileshareequipment/Other', 'fas fa-angle-double-right', 30, 1, 1),
(38, 'All', 'admin/filesharepid/all', 'fas fa-angle-double-right', 27, 1, 1),
(39, 'List', 'admin/filesharepid/List', 'fas fa-angle-double-right', 27, 1, 1),
(40, 'Scanned PDF File - KN Office', 'admin/filesharepid/Scanned PDF File - KN Office', 'fas fa-angle-double-right', 27, 1, 1),
(41, 'CAD Drawing', 'admin/filesharepid/CAD Drawing', 'fas fa-angle-double-right', 27, 1, 1),
(42, 'CAD to PDF', 'admin/filesharepid/CAD to PDF', 'fas fa-angle-double-right', 27, 1, 1),
(43, 'Other', 'admin/filesharepid/Other', 'fas fa-angle-double-right', 27, 1, 1),
(44, 'All', 'admin/filesharedpiping/all', 'fas fa-angle-double-right', 28, 1, 1),
(45, 'List', 'admin/filesharedpiping/List', 'fas fa-angle-double-right', 28, 1, 1),
(46, 'Scanned PDF File - KN Office', 'admin/filesharedpiping/Scanned PDF File - KN Office', 'fas fa-angle-double-right', 28, 1, 1),
(47, 'Cad Drawing', 'admin/filesharedpiping/Cad Drawing', 'fas fa-angle-double-right', 28, 1, 1),
(48, 'Cad to PDF', 'admin/filesharedpiping/Cad to PDF', 'fas fa-angle-double-right', 28, 1, 1),
(49, 'Bill of Quantity', 'admin/filesharedpiping/Bill of Quantity', 'fas fa-angle-double-right', 28, 1, 1),
(50, 'Other', 'admin/filesharedpiping/other', 'fas fa-angle-double-right', 28, 1, 1),
(51, 'All', 'admin/filesharedsteelstructure/all', 'fas fa-angle-double-right', 29, 1, 1),
(52, 'List', 'admin/filesharedsteelstructure/List', 'fas fa-angle-double-right', 29, 1, 1),
(53, 'Scanned PDF File - KN Office', 'admin/filesharedsteelstructure/Scanned PDF File - KN Office', 'fas fa-angle-double-right', 29, 1, 1),
(54, 'CAD Drawing', 'admin/filesharedsteelstructure/CAD Drawing', 'fas fa-angle-double-right', 29, 1, 1),
(55, 'CAD to PDF', 'admin/filesharedsteelstructure/CAD to PDF', 'fas fa-angle-double-right', 29, 1, 1),
(56, 'Bill of Quantity', 'admin/filesharedsteelstructure/Bill of Quantity', 'fas fa-angle-double-right', 29, 1, 1),
(57, 'Photo', 'admin/filesharedsteelstructure/Photo', 'fas fa-angle-double-right', 29, 1, 1),
(58, 'All', 'admin/adminshare/all', 'fas fa-angle-double-right', 26, 1, 1),
(59, 'List', 'admin/adminshare/List', 'fas fa-angle-double-right', 26, 1, 1),
(60, 'Scanned PDF File - KN Office', 'admin/adminshare/Scanned PDF File - KN Office', 'fas fa-angle-double-right', 26, 1, 1),
(61, 'CAD Drawing', 'admin/adminshare/CAD Drawing', 'fas fa-angle-double-right', 26, 1, 1),
(62, 'CAD to PDF', 'admin/adminshare/CAD to PDF', 'fas fa-angle-double-right', 26, 1, 1),
(63, 'Bill of Quantity', 'admin/adminshare/Bill of Quantity', 'fas fa-angle-double-right', 26, 1, 1),
(64, 'Equipment List', 'admin/adminshare/Equipment List', 'fas fa-angle-double-right', 26, 1, 1),
(65, 'Inspection Report', 'admin/adminshare/Inspection Report', 'fas fa-angle-double-right', 26, 1, 1),
(66, 'Photo', 'admin/adminshare/Photo', 'fas fa-angle-double-right', 26, 1, 1),
(67, 'Other', 'admin/filesharedsteelstructure/other', 'fas fa-angle-double-right', 29, 1, 1),
(68, 'Other', 'admin/adminshare/other', 'fas fa-angle-double-right', 26, 1, 1),
(69, 'Accounting', '#', 'fas fa-file-invoice-dollar', 0, 1, 9),
(70, 'Voucher', 'admin/accounting_voucher', 'fas fa-money-check', 69, 1, 1),
(71, 'Voucher List', 'admin/accounting_voucher', 'fas fa-money-check', 70, 1, 1),
(72, 'Voucher Approval', 'admin/accounting_voucher_approval', 'fas fa-receipt', 70, 1, 2),
(73, 'Voucher Payment', '#', 'fas fa-receipt', 70, 1, 3),
(75, 'Bank Account', 'admin/accounting_bank', 'fas fa-receipt', 69, 1, 2),
(76, 'Input Report', 'admin/form_input_report', 'fas fa-receipt', 69, 1, 3),
(77, 'Directory', '#', 'fas fa-server', 0, 1, 1),
(78, 'HO-25-H00101', 'admin/holv1/ho', 'fas fa-building', 77, 1, 1),
(79, 'Warehouse-25-G11202', 'admin/holv1/warehouse', 'fa fa-warehouse', 77, 1, 2),
(80, 'Project Brau-25-O87401', 'admin/holv1/project_berau', 'fas fa-drafting-compass', 77, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penagihan`
--

CREATE TABLE `tbl_penagihan` (
  `_id` int(11) NOT NULL,
  `kode_bayar` char(11) NOT NULL,
  `no_faktur` char(11) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `id_user` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_penagihan`
--

INSERT INTO `tbl_penagihan` (`_id`, `kode_bayar`, `no_faktur`, `total_bayar`, `tgl_bayar`, `id_user`, `status`, `created_at`) VALUES
(1, 'F-001-1', 'F-001', 100000, '2021-02-01', 1, '1', '2021-02-14 05:23:00'),
(2, 'F-001-2', 'F-001', 500000, '2021-02-11', 1, '0', '2021-02-11 14:16:54'),
(3, 'F-002-1', 'F-002', 70000, '2021-02-11', 1, '0', '2021-02-11 14:19:30'),
(4, 'F-001-3', 'F-001', 70000, '2021-02-11', 1, '0', '2021-01-01 14:20:40'),
(5, 'F-001-4', 'F-001', 50000, '2021-02-11', 1, '0', '2021-02-11 14:58:25'),
(6, 'F-004-1', 'F-004', 700000, '2021-02-12', 1, '0', '2021-02-12 15:00:21'),
(7, 'F-001-5', 'F-001', 50000, '2021-02-13', 1, '0', '2021-02-13 14:04:05'),
(8, 'F-005-1', 'F-005', 100000, '2021-01-01', 1, '0', '2021-02-13 14:05:37'),
(9, 'F-006-1', 'F-006', 700000, '2021-02-13', 1, '0', '2021-02-13 14:06:21'),
(10, 'F-007-1', 'F-007', 300000, '2021-01-14', 1, '0', '2021-02-13 14:41:45'),
(12, 'F-008-1', 'F-008', 70000, '2021-02-14', 1, '0', '2021-02-14 04:18:50'),
(13, 'F-008-2', 'F-008', 70000, '2021-02-14', 1, '0', '2021-02-14 04:24:05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penjualan`
--

CREATE TABLE `tbl_penjualan` (
  `_id` int(11) NOT NULL,
  `no_faktur` char(11) NOT NULL,
  `nama_pembeli` varchar(255) NOT NULL,
  `alamat` longtext NOT NULL,
  `no_telp` varchar(50) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_user` char(11) NOT NULL,
  `id_penagih` int(11) NOT NULL,
  `status_bayar` enum('0','1','2') NOT NULL,
  `status_penjualan` int(11) NOT NULL,
  `tgl_tempo` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `status_approve` enum('0','1') NOT NULL DEFAULT '0',
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_penjualan`
--

INSERT INTO `tbl_penjualan` (`_id`, `no_faktur`, `nama_pembeli`, `alamat`, `no_telp`, `tgl_transaksi`, `id_barang`, `id_user`, `id_penagih`, `status_bayar`, `status_penjualan`, `tgl_tempo`, `total`, `status_approve`, `last_update`) VALUES
(1, 'F-001', 'Lukman', 'test', '213', '2021-02-01', 1, '1', 5, '1', 7, 6, 700000, '1', '2021-02-11 14:22:04'),
(2, 'F-002', 'L', 'kjkj', '4293792834', '2021-02-11', 1, '1', 6, '1', 10, 10, 700000, '1', '2021-02-14 04:56:52'),
(4, 'F-003', 'Hadi', 'Mars', '123123123', '2021-02-12', 1, '1', 7, '0', 0, 0, 700000, '1', '2021-02-12 14:54:00'),
(5, 'F-004', 'Lukman Hadi', 'TEST', '3412341234', '2021-02-12', 1, '1', 7, '0', 0, 0, 700000, '1', '2021-02-12 15:00:44'),
(6, 'F-005', 'JUPLe', 'glc', '555', '2021-01-01', 1, '1', 6, '1', 7, 5, 700000, '1', '2021-02-13 14:45:33'),
(7, 'F-006', 'JUPLe', 'glc', '555', '2021-02-13', 1, '1', 7, '0', 0, 0, 700000, '1', '2021-02-13 14:06:36'),
(8, 'F-007', 'TEST JUAl;', 'LSKDSJKJ', '1212', '2021-01-14', 3, '1', 5, '1', 5, 5, 1500000, '1', '2021-02-13 14:45:45'),
(9, 'F-008', 'TEST APPROVE', 'TEST APPROVE', '123123', '2021-02-14', 1, '1', 5, '1', 10, 5, 700000, '1', '2021-02-14 04:18:50');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_perusahaan`
--

CREATE TABLE `tbl_perusahaan` (
  `_id` int(11) NOT NULL,
  `nama_perusahaan` varchar(100) NOT NULL,
  `telp` char(13) NOT NULL,
  `alamat` longtext NOT NULL,
  `logo` varchar(50) NOT NULL,
  `nama_apps` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_po`
--

CREATE TABLE `tbl_po` (
  `id` int(255) NOT NULL,
  `po_number` varchar(255) NOT NULL,
  `Supplier_id` int(255) NOT NULL,
  `expeted_date` date NOT NULL,
  `total_amount` bigint(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `po_date` date NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `po_description` varchar(255) NOT NULL,
  `item_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_po`
--

INSERT INTO `tbl_po` (`id`, `po_number`, `Supplier_id`, `expeted_date`, `total_amount`, `status`, `po_date`, `file`, `po_description`, `item_description`) VALUES
(1, '123', 1, '0000-00-00', 123, '3231', '0000-00-00', 'http://localhost/cka-pot-master/uploads/po-files/1232.jpg', '123', NULL),
(2, 'Test 2', 1, '2024-10-01', 12000, '123', '2024-10-01', 'http://localhost/cka-pot-master/uploads/po-files/Test_2.jpg', 'Test 2', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_posisi`
--

CREATE TABLE `tbl_posisi` (
  `_id` int(11) NOT NULL,
  `posisi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_posisi`
--

INSERT INTO `tbl_posisi` (`_id`, `posisi`) VALUES
(1, 'Superadmin'),
(2, 'Admin'),
(3, 'Supervisor'),
(4, 'Owner'),
(5, 'Manager'),
(6, 'Helper'),
(8, 'Foreman'),
(10, 'Welder'),
(12, 'AdminShare'),
(13, 'Guest'),
(14, 'Guest01'),
(15, 'Director');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `id` int(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `PIC_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `bank_account` varchar(255) DEFAULT NULL,
  `rek_bank` varchar(255) DEFAULT NULL,
  `tax` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`id`, `nama`, `PIC_name`, `email`, `phone`, `address`, `bank_account`, `rek_bank`, `tax`, `status`, `created_at`, `update_at`) VALUES
(1, 'PT. Bina Mas Teknik', 'AAL', 'Testemail@gmail.com', '085280446016', 'Jl. Raya Merak No. 10 Cilegon - Banten', 'Mandir', '123123123123', '123123123123', '1', '2024-09-30 13:54:06', '2024-09-30 10:51:51'),
(3, 'PT. Anugerah Kota Baja', 'Budi Supriyanto', 'Budi@anugerahkotabaja.co.id', '081316313661', 'Metro Cilegon Blok N14 No.8 Kota Cilegon - Banten', 'Mandiri', '08123212312', '123123123', '1', '2024-10-01 10:26:15', '2024-10-01 15:26:15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `_id` int(11) NOT NULL,
  `nik` char(20) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `tgl_masuk` date NOT NULL,
  `posisi` char(11) NOT NULL,
  `alamat` longtext NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_aktif` enum('0','1') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `no_hp` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL DEFAULT '-',
  `marital` varchar(30) NOT NULL,
  `npwp` varchar(30) NOT NULL DEFAULT '-',
  `bpjs_ks` varchar(30) NOT NULL DEFAULT '-',
  `bpjs_kt` varchar(30) NOT NULL DEFAULT '-',
  `path_foto` varchar(255) NOT NULL,
  `employee-id` varchar(30) NOT NULL DEFAULT '-',
  `superior_id` varchar(30) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`_id`, `nik`, `nama`, `jk`, `tempat_lahir`, `tgl_lahir`, `tgl_masuk`, `posisi`, `alamat`, `password`, `is_aktif`, `created_at`, `no_hp`, `email`, `marital`, `npwp`, `bpjs_ks`, `bpjs_kt`, `path_foto`, `employee-id`, `superior_id`) VALUES
(14, '1', 'LUTFI WIJAYA', 'L', 'Serang', '2024-09-07', '2024-09-07', '1', 'Kp. Babakan Sompok RT 11 RW 05', '$2y$04$R8vOyZhkTaKbcv9WKUwlnOPCo.9ubE1HPwbbX8fsq2DWJol7V3BZC', '1', '2024-09-07 03:01:57', '082248951236', 'lutfiwijhaya@gmail.com', 'K', '', '', '', 'https://achivon.app/uploads/Lutfi.png ', 'h-000023', '0'),
(17, 'admin', 'admin', 'L', 'admin', '2024-11-22', '2024-11-22', '12', 'admin', '$2y$04$kOOsE6sK6H22GEhhJuR.TOidO6sUZEJe16N0iq77BzOl/B7BWvljq', '1', '2024-11-22 04:08:48', '0822', '', 'Tidak Kawin', '', '', '', 'https://achivon.app/uploads/icon-admin-128.png', 'admin', '0'),
(18, 'guest', 'Guest', 'L', 'Guset', '2024-11-22', '2024-11-22', '13', 'Guest', '$2y$04$gOXEWERXen2HgbsFiU6TtukDVwRHYfCnlZ0AwYDVcPrSYTFJ/6G5S', '1', '2024-11-22 04:13:21', '08', '', 'Tidak Kawin', '', '', '', 'https://achivon.app/uploads/guest-128.png', 'guest', '0'),
(19, 'guest01', 'Guest', 'L', 'guest', '2024-12-21', '2024-12-21', '14', 'guest', '$2y$04$Yrp3P.KITHoLlNq8cuOEKeTqsizkAMwBRrMQZ2wv4VOne1hjmDNHa', '1', '2024-12-21 04:19:47', '123123123', '', 'Kawin', '', '', '', 'https://achivon.app/uploads/guest-128.png', 'guest01', '0'),
(20, 'H-000001', 'Jong Ky Ahn', 'L', 'Seoul', '1966-10-08', '2019-05-19', '15', 'Jakarta', '$2y$04$uZcQ1R6afheZJ8Ka2qIAZuNbkDIz9JCfYLuo9EDtNuqBcoxoCcSru', '1', '2025-03-11 10:03:31', '-', 'justinahn@achivon.co.id', 'Kawin', '', '', '', 'https://achivon.app/uploads/Screenshot_2025-03-11_170314.png', 'H-000001', '0'),
(21, 'H-000002', 'Oh Chin Phang', 'L', 'Perak', '1986-08-18', '2024-04-01', '15', 'Malaysia', '$2y$04$Pc5irCPg0g372ktppGbEi.nWqoh2gEYmJDOGSl9UuT3hW4Wv9H6sa', '1', '2025-03-11 10:09:39', '-', 'cpoh@achivon.co.id', 'Kawin', '', '', '', 'https://achivon.app/uploads/Screenshot_2025-03-11_170504.png', 'H-000002', '0'),
(22, 'H-000003', 'Lee Byung Sam', 'L', 'Korea', '2025-03-11', '2025-03-11', '15', 'Jakarta', '$2y$04$NhQ6FozbR5GdFyb1PRjoaOpiDVa2amukYINlfUbidll6Q5klqqj4G', '1', '2025-03-11 10:12:07', '-', 'bslee@achivon.co.id ', 'Kawin', '', '', '', 'https://achivon.app/uploads/Screenshot_2025-03-11_170525.png', 'H-000003', '0'),
(23, 'H-0-230011', 'Ilham Kelana', 'L', 'PLAJU', '1982-01-09', '2023-01-20', '5', 'PERUM BUKIT CILEGON ASRI BLOK NH NO.21', '$2y$04$Pc5irCPg0g372ktppGbEi.nWqoh2gEYmJDOGSl9UuT3hW4Wv9H6sa', '1', '2025-03-11 10:23:27', '082210470237', 'ilham.kelana@achivon.co.id', 'Kawin', '680516267417000', '', '', 'https://achivon.app/uploads/Screenshot_2025-03-11_172311.png', 'H-0-230011', '0');

-- --------------------------------------------------------

--
-- Table structure for table `wh_distribution`
--

CREATE TABLE `wh_distribution` (
  `id` int(30) NOT NULL,
  `item_id` int(30) NOT NULL,
  `from_warehouse_id` int(30) DEFAULT NULL,
  `to_warehouse_id` int(30) DEFAULT NULL,
  `employee_id_from` int(30) DEFAULT NULL,
  `employee_id_to` int(30) DEFAULT NULL,
  `qty` int(30) NOT NULL,
  `distribution_date` date NOT NULL,
  `distribution_type` varchar(255) NOT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `from_suplier_id` int(30) DEFAULT NULL,
  `to_suplier_id` int(30) DEFAULT NULL,
  `po_id` int(30) DEFAULT NULL,
  `request_id` int(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wh_distribution`
--

INSERT INTO `wh_distribution` (`id`, `item_id`, `from_warehouse_id`, `to_warehouse_id`, `employee_id_from`, `employee_id_to`, `qty`, `distribution_date`, `distribution_type`, `remark`, `from_suplier_id`, `to_suplier_id`, `po_id`, `request_id`) VALUES
(2, 1, 1, NULL, NULL, 14, 1, '2024-09-09', 'Loan', '', NULL, NULL, NULL, NULL),
(3, 10, 2, NULL, NULL, 15, 1, '2024-09-24', 'Loan', 'Adjustble wrech', NULL, NULL, 1, 1),
(4, 10, 1, NULL, NULL, 15, 1, '2024-09-24', 'Loan', 'Adjustble wrech', NULL, NULL, 1, 1),
(5, 10, 1, 2, NULL, NULL, 1, '2024-09-24', 'Loan', 'Adjustble wrech', NULL, NULL, 0, 0),
(6, 10, 1, NULL, NULL, 15, 1, '2024-09-24', 'Loan', 'Adjustble wrech', NULL, NULL, 0, 0),
(7, 10, 1, NULL, NULL, 15, 1, '2024-09-24', 'Loan', 'Adjustble wrech', NULL, NULL, 0, 0),
(8, 10, 1, NULL, NULL, 15, 1, '2024-09-24', 'Loan', 'Adjustble wrech', NULL, NULL, 0, 0),
(9, 10, 1, NULL, NULL, 15, 1, '2024-09-24', 'Loan', 'Adjustble wrech', NULL, NULL, 0, 0),
(10, 10, 1, NULL, NULL, 15, 1, '2024-09-24', 'Loan', 'Adjustble wrech', NULL, NULL, 0, 0),
(11, 10, 1, NULL, NULL, 15, 1, '2024-09-24', 'Loan', 'Adjustble wrech', NULL, NULL, 0, 0),
(12, 10, NULL, NULL, 15, 14, 1, '2024-09-24', 'Loan', 'Adjustble wrech', NULL, NULL, 0, 0),
(13, 10, 1, 2, NULL, NULL, 1, '2024-09-24', 'Loan', 'Adjustble wrech', NULL, NULL, 0, 0),
(14, 10, 1, 2, NULL, NULL, 1, '2024-09-24', 'Loan', 'Adjustble wrech', NULL, NULL, 0, 0),
(15, 10, 2, NULL, NULL, 15, 1, '2024-09-24', 'Consumable', '', NULL, NULL, 0, 0),
(16, 10, 2, NULL, NULL, 14, 1, '2024-09-24', 'Consumable', '', NULL, NULL, 0, 0),
(17, 10, 2, NULL, NULL, 15, 1, '2024-09-24', 'Consumable', '', NULL, NULL, 0, 0),
(18, 11, 1, 2, NULL, NULL, 23, '2024-09-30', 'New', '', NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wh_items`
--

CREATE TABLE `wh_items` (
  `id` int(30) NOT NULL,
  `kode_barang` varchar(100) NOT NULL,
  `category` varchar(30) NOT NULL,
  `inisial_kuantitas` varchar(30) NOT NULL,
  `Level_1` varchar(255) DEFAULT NULL,
  `level_2` varchar(255) DEFAULT '-',
  `level_3` varchar(255) DEFAULT '-',
  `level_4` varchar(255) DEFAULT '-',
  `remark` varchar(255) NOT NULL DEFAULT '-',
  `is_deleted` int(3) NOT NULL DEFAULT 0,
  `path_foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wh_items`
--

INSERT INTO `wh_items` (`id`, `kode_barang`, `category`, `inisial_kuantitas`, `Level_1`, `level_2`, `level_3`, `level_4`, `remark`, `is_deleted`, `path_foto`) VALUES
(1, 'H-01', 'inventory', 'EA', 'Office Electronic', 'Laptop', 'Asus', '-', '-', 1, ''),
(2, 'H-02', 'inventory', 'EA', 'Office Electronic', 'Laptop', 'HP', '-', '-', 1, ''),
(3, 'H-03', 'Consumable', 'EA', 'Office Stationary', 'Bolpoint', 'Standart', '-', '-', 1, ''),
(4, 'OE-0003', 'Consumable', 'EA', 'Office Electronic', 'Laptop', '', '', '', 1, ''),
(5, 'OE-0004', 'Inventory', 'Meter', 'Office Electronic', 'Laptop', '', '', '', 1, ''),
(6, 'OE-0005', 'Inventory', 'Meter', 'Office Electronic', 'Laptop', 'Test', '', '', 1, ''),
(7, 'MT-0001', 'Consumable', 'Meter', 'Material', 'Galvaniz', 'Pipe', '5\" 5M', '', 1, 'http://localhost/cka-pot-master/uploads/foto-items/MT-0001.png'),
(8, 'EQ-0001', 'Inventory', 'EA', 'Equipment', 'ID Bedge', '', '', '', 1, 'http://localhost/cka-pot-master/uploads/foto-items/EQ-0001.jpg'),
(9, '2-10-100-12', 'CCS', 'EA', 'Equipment', 'ID Bedge', 'Doosan', '-', '-', 0, 'http://localhost/cka-pot-master/uploads/foto-items/2-10-100-121.png'),
(10, '2-10-100-12', 'TCS', 'EA', 'Non Power Tools', 'Non Power Tools', 'Kunci Inggris', '18\"', 'Adjustble wrech', 0, 'http://localhost/cka-pot-master/uploads/foto-items/2-10-100-12.png'),
(11, '2-10-100-10', 'TCS', 'EA', 'Non Power Tools', 'Non Power Tools', 'Kunci Inggris', '6\"', 're', 0, NULL),
(12, '2-10-100-14', 'TCS', 'EA', 'Non Power Tools', 'Non Power Tools', 'Kunci Inggris', '15\"', '', 0, NULL),
(13, '2-10-100-13', 'TCS', 'EA', 'Non Power Tools', 'Non Power Tools', 'Kunci Inggris', '12\"', '231', 0, 'http://localhost/cka-pot-master/uploads/foto-items/2-10-100-13.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `wh_items_stock`
--

CREATE TABLE `wh_items_stock` (
  `id` int(30) NOT NULL,
  `item_id` int(30) NOT NULL,
  `warehouse_id` int(30) DEFAULT NULL,
  `employee_id` int(30) DEFAULT NULL,
  `quantity` int(30) NOT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wh_items_stock`
--

INSERT INTO `wh_items_stock` (`id`, `item_id`, `warehouse_id`, `employee_id`, `quantity`, `status`) VALUES
(1, 10, 1, NULL, 0, ''),
(4, 10, 2, NULL, 1, ''),
(5, 10, NULL, 14, 2, 'Loan'),
(6, 2, 1, NULL, 8, ''),
(7, 2, 2, NULL, 1, ''),
(8, 10, NULL, 15, 1, 'Loan'),
(9, 11, 2, NULL, 23, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wh_item_set`
--

CREATE TABLE `wh_item_set` (
  `id` int(30) NOT NULL,
  `item_id` int(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `qty` int(30) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `remark` text DEFAULT NULL,
  `doc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wh_item_set`
--

INSERT INTO `wh_item_set` (`id`, `item_id`, `name`, `qty`, `status`, `remark`, `doc`) VALUES
(1, 11, 'Certificate', 1, 'Status', 'Remark', NULL),
(2, 11, 'Certificate 2', 1, NULL, NULL, NULL),
(3, 11, 'test', 11, '11', '11', NULL),
(7, 2, 'TCS', 0, 'Non Power Tools', 'Non Power Tools', NULL),
(8, 2, 'TCS', 0, 'Non Power Tools', 'Non Power Tools', 'http://localhost/cka-pot-master/uploads/foto-items-set/2-10-100-12.jpg'),
(9, 2, 'TCS', 0, 'Non Power Tools', 'Non Power Tools', NULL),
(10, 2, 'TCS', 0, 'Non Power Tools', 'Non Power Tools', NULL),
(11, 2, 'TCS', 0, 'Non Power Tools', 'Non Power Tools', NULL),
(12, 11, '1', 1, '1', '1', NULL),
(13, 11, '2', 2, '2', '2', NULL),
(14, 11, '1', 1, '1', '1', NULL),
(15, 123, '1', 1, '1', '1', NULL),
(16, 12333, '1', 1, '1', '1', NULL),
(17, 444, '44', 44, '4', '4', NULL),
(18, 32, '33', 3, '3', '3', NULL),
(19, 32, '33', 3, '3', '3', NULL),
(20, 32, '33', 3, '3', '3', NULL),
(21, 2, '2', 2, '2', '2', NULL),
(22, 2, '2', 2, '2', '2', NULL),
(23, 2, '2', 2, '2', '2', NULL),
(24, 2, '2', 2, '2', '2', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wh_request`
--

CREATE TABLE `wh_request` (
  `id` int(30) NOT NULL,
  `item_id` int(30) NOT NULL,
  `from_warehouse_id` int(30) DEFAULT NULL,
  `to_warehouse_id` int(30) DEFAULT NULL,
  `employee_id_from` int(30) DEFAULT NULL,
  `employee_id_to` int(30) DEFAULT NULL,
  `quantity` int(255) NOT NULL,
  `for_date` date NOT NULL,
  `back_date` date DEFAULT NULL,
  `create_date` date NOT NULL DEFAULT current_timestamp(),
  `reason` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wh_warehouse`
--

CREATE TABLE `wh_warehouse` (
  `id` int(30) NOT NULL,
  `wh_name` varchar(100) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wh_warehouse`
--

INSERT INTO `wh_warehouse` (`id`, `wh_name`, `location`) VALUES
(1, 'Warehouse Office (Damkar Cilegon)', 'Office Damkar (Cilegon)'),
(2, 'Container 20Ft 1', 'Office Damkar (Cilegon)');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounting_bank`
--
ALTER TABLE `accounting_bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounting_daily_report`
--
ALTER TABLE `accounting_daily_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounting_daily_report_balance`
--
ALTER TABLE `accounting_daily_report_balance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounting_daily_report_transaction`
--
ALTER TABLE `accounting_daily_report_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounting_voucher`
--
ALTER TABLE `accounting_voucher`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_doc` (`no_doc`);

--
-- Indexes for table `accounting_voucher_spec`
--
ALTER TABLE `accounting_voucher_spec`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dr_akses`
--
ALTER TABLE `dr_akses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dr_file`
--
ALTER TABLE `dr_file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `file_shared`
--
ALTER TABLE `file_shared`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `params`
--
ALTER TABLE `params`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sd_ho_lv1`
--
ALTER TABLE `sd_ho_lv1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sd_ho_lv2`
--
ALTER TABLE `sd_ho_lv2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sd_ho_lv3`
--
ALTER TABLE `sd_ho_lv3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sd_ho_lv4`
--
ALTER TABLE `sd_ho_lv4`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sd_ho_lv5`
--
ALTER TABLE `sd_ho_lv5`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sd_ho_lv6`
--
ALTER TABLE `sd_ho_lv6`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sd_ho_lv7`
--
ALTER TABLE `sd_ho_lv7`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sd_ho_lv8`
--
ALTER TABLE `sd_ho_lv8`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sd_ho_lv9`
--
ALTER TABLE `sd_ho_lv9`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sd_ho_lv10`
--
ALTER TABLE `sd_ho_lv10`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`_id`);

--
-- Indexes for table `tbl_barang_masuk`
--
ALTER TABLE `tbl_barang_masuk`
  ADD PRIMARY KEY (`_id`);

--
-- Indexes for table `tbl_catatan`
--
ALTER TABLE `tbl_catatan`
  ADD PRIMARY KEY (`_id`);

--
-- Indexes for table `tbl_levels`
--
ALTER TABLE `tbl_levels`
  ADD PRIMARY KEY (`_id`);

--
-- Indexes for table `tbl_menus`
--
ALTER TABLE `tbl_menus`
  ADD PRIMARY KEY (`_id`);

--
-- Indexes for table `tbl_penagihan`
--
ALTER TABLE `tbl_penagihan`
  ADD PRIMARY KEY (`_id`),
  ADD UNIQUE KEY `kode_bayar` (`kode_bayar`);

--
-- Indexes for table `tbl_penjualan`
--
ALTER TABLE `tbl_penjualan`
  ADD PRIMARY KEY (`_id`),
  ADD UNIQUE KEY `no_faktur` (`no_faktur`);

--
-- Indexes for table `tbl_perusahaan`
--
ALTER TABLE `tbl_perusahaan`
  ADD PRIMARY KEY (`_id`);

--
-- Indexes for table `tbl_po`
--
ALTER TABLE `tbl_po`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_posisi`
--
ALTER TABLE `tbl_posisi`
  ADD PRIMARY KEY (`_id`);

--
-- Indexes for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`_id`),
  ADD UNIQUE KEY `nik` (`nik`);

--
-- Indexes for table `wh_distribution`
--
ALTER TABLE `wh_distribution`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wh_items`
--
ALTER TABLE `wh_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wh_items_stock`
--
ALTER TABLE `wh_items_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wh_item_set`
--
ALTER TABLE `wh_item_set`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wh_warehouse`
--
ALTER TABLE `wh_warehouse`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounting_bank`
--
ALTER TABLE `accounting_bank`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `accounting_daily_report`
--
ALTER TABLE `accounting_daily_report`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `accounting_daily_report_balance`
--
ALTER TABLE `accounting_daily_report_balance`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `accounting_daily_report_transaction`
--
ALTER TABLE `accounting_daily_report_transaction`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `accounting_voucher`
--
ALTER TABLE `accounting_voucher`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `accounting_voucher_spec`
--
ALTER TABLE `accounting_voucher_spec`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `dr_akses`
--
ALTER TABLE `dr_akses`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `dr_file`
--
ALTER TABLE `dr_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `file_shared`
--
ALTER TABLE `file_shared`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `params`
--
ALTER TABLE `params`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `sd_ho_lv1`
--
ALTER TABLE `sd_ho_lv1`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `sd_ho_lv2`
--
ALTER TABLE `sd_ho_lv2`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `sd_ho_lv3`
--
ALTER TABLE `sd_ho_lv3`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=245;

--
-- AUTO_INCREMENT for table `sd_ho_lv4`
--
ALTER TABLE `sd_ho_lv4`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `sd_ho_lv5`
--
ALTER TABLE `sd_ho_lv5`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `sd_ho_lv6`
--
ALTER TABLE `sd_ho_lv6`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sd_ho_lv7`
--
ALTER TABLE `sd_ho_lv7`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sd_ho_lv8`
--
ALTER TABLE `sd_ho_lv8`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sd_ho_lv9`
--
ALTER TABLE `sd_ho_lv9`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sd_ho_lv10`
--
ALTER TABLE `sd_ho_lv10`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_barang_masuk`
--
ALTER TABLE `tbl_barang_masuk`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_catatan`
--
ALTER TABLE `tbl_catatan`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_levels`
--
ALTER TABLE `tbl_levels`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=193;

--
-- AUTO_INCREMENT for table `tbl_menus`
--
ALTER TABLE `tbl_menus`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `tbl_penagihan`
--
ALTER TABLE `tbl_penagihan`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_penjualan`
--
ALTER TABLE `tbl_penjualan`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_perusahaan`
--
ALTER TABLE `tbl_perusahaan`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_po`
--
ALTER TABLE `tbl_po`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_posisi`
--
ALTER TABLE `tbl_posisi`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `wh_distribution`
--
ALTER TABLE `wh_distribution`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `wh_items`
--
ALTER TABLE `wh_items`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `wh_items_stock`
--
ALTER TABLE `wh_items_stock`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `wh_item_set`
--
ALTER TABLE `wh_item_set`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `wh_warehouse`
--
ALTER TABLE `wh_warehouse`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
