-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 28 Agu 2025 pada 01.54
-- Versi server: 8.4.3
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_abni`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `params`
--

CREATE TABLE `params` (
  `id` int NOT NULL,
  `param_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `param_group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` int DEFAULT NULL,
  `delete_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `params`
--

INSERT INTO `params` (`id`, `param_name`, `param_group`, `status`, `remark`, `created_at`, `updated_at`, `is_deleted`, `delete_at`) VALUES
(18, 'EA', 'inisial_kuantitas', '', '', '2024-09-10 06:49:06', '2024-09-10 06:49:06', NULL, NULL),
(19, 'Meter', 'inisial_kuantitas', '', '', '2024-09-10 06:49:23', '2024-09-10 06:49:23', NULL, NULL),
(20, 'Kg', 'inisial_kuantitas', '', '', '2024-09-10 06:49:43', '2024-09-10 06:49:43', NULL, NULL),
(31, 'Warehouse', 'distribution_value', '', 'wh_warehouse', '2024-09-18 01:39:06', '2024-09-18 01:39:06', NULL, NULL),
(32, 'Employee', 'distribution_value', '', 'tbl_user', '2024-09-18 01:39:33', '2024-09-18 01:39:33', NULL, NULL),
(33, 'Supplier', 'distribution_value', '', 'tbl_supplier', '2024-09-18 01:40:05', '2025-05-30 01:47:35', NULL, NULL),
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
(86, 'Other', 'Steel Structure', 'Steel Structure', 'KN_Chemical_Plant', '2024-12-21 03:57:40', '2024-12-21 03:57:40', NULL, NULL),
(97, 'Unit', 'inisial_kuantitas', '', '', '2025-05-28 11:08:34', '2025-05-28 11:08:34', NULL, NULL),
(98, 'SET', 'inisial_kuantitas', '', '', '2025-06-09 06:48:51', '2025-06-09 06:48:51', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_levels`
--

CREATE TABLE `tbl_levels` (
  `_id` int NOT NULL,
  `id_posisi` int NOT NULL,
  `id_menu` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_levels`
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
(178, 1, 70),
(179, 1, 71),
(180, 1, 72),
(181, 1, 73),
(182, 1, 75),
(183, 1, 76),
(185, 1, 78),
(186, 1, 79),
(187, 1, 80),
(189, 15, 78),
(190, 15, 79),
(191, 15, 80),
(192, 15, 77),
(193, 5, 77),
(194, 5, 78),
(195, 5, 79),
(196, 5, 80),
(198, 1, 82),
(199, 1, 83),
(200, 1, 84),
(201, 1, 85),
(202, 1, 86),
(203, 1, 87),
(204, 1, 88),
(205, 1, 89),
(206, 1, 90),
(207, 1, 81),
(208, 1, 91),
(209, 1, 92),
(210, 1, 69),
(211, 1, 93),
(212, 1, 94),
(213, 1, 95),
(214, 1, 96),
(215, 1, 97),
(216, 1, 98),
(217, 1, 99);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_menus`
--

CREATE TABLE `tbl_menus` (
  `_id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `is_main` int NOT NULL,
  `is_aktif` int NOT NULL,
  `ordinal` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_menus`
--

INSERT INTO `tbl_menus` (`_id`, `title`, `uri`, `icon`, `is_main`, `is_aktif`, `ordinal`) VALUES
(1, 'Users', '#', 'fa fa-users', 0, 1, 1),
(2, 'Pegawai', 'admin/users', 'fa fa-user', 1, 1, 1),
(3, 'Posisi', 'admin/posisi', 'fas fa-user-shield', 1, 1, 2),
(5, 'Warehouse', '#', 'fa fa-warehouse', 0, 1, 3),
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
(19, 'Warehouse Management', '#', 'fas fa-boxes', 5, 0, 5),
(20, 'Params', 'admin/params', 'fas fa-cog', 14, 1, 2),
(21, 'Request Item', 'admin/requestitem', 'fas fa-clipboard-list', 5, 0, 4),
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
(70, 'Voucher', 'accounting/accounting_voucher', 'fas fa-money-check', 69, 1, 2),
(71, 'Voucher List', 'Accounting/accounting_voucher', 'fas fa-money-check', 70, 1, 1),
(72, 'Voucher Approval', 'accounting/accounting_voucher_approval', 'fas fa-receipt', 70, 1, 2),
(73, 'Voucher Payment', '#', 'fas fa-receipt', 70, 1, 3),
(75, 'Bank Account', 'accounting/accounting_bank', 'fas fa-receipt', 69, 1, 2),
(76, 'Input Report', 'accounting/form_input_report', 'fas fa-receipt', 69, 1, 2),
(77, 'Directory', '#', 'fas fa-server', 0, 1, 1),
(78, 'HO-25-H00101', 'admin/holv1/ho', 'fas fa-building', 77, 1, 1),
(79, 'Warehouse-25-G11202', 'admin/holv1/warehouse', 'fa fa-warehouse', 77, 1, 2),
(80, 'Project Brau-25-O87401', 'admin/holv1/project_berau', 'fas fa-drafting-compass', 77, 1, 3),
(81, 'DR', 'admin/directory', 'fas fa-boxes', 0, 1, 9),
(82, 'Params Warehouse', 'admin/wh_params', 'fas fa-boxes', 5, 1, 6),
(83, 'Supplier', 'admin/Supplier', 'fas fa-boxes', 5, 1, 6),
(85, 'Office The Smith', 'admin/stockwarehouse/1', 'fas fa-warehouse', 91, 1, 1),
(86, 'Pinangsia Warehouse', 'admin/stockwarehouse/2', 'fas fa-warehouse', 91, 1, 2),
(87, 'Container Meisa', 'admin/stockwarehouse/3', 'fas fa-warehouse', 91, 1, 3),
(88, 'KN Site', 'admin/stockwarehouse/5', 'fas fa-warehouse', 92, 1, 1),
(89, 'Reported QTY Warehouse', 'admin/stockwarehouse/7', 'fas fa-warehouse', 5, 1, 3),
(90, 'Items At Employee', 'admin/stockemployee', 'fas fa-boxes', 5, 1, 4),
(91, 'HO', '#', 'fas fa-warehouse', 5, 1, 4),
(92, 'SITE', '#', 'fas fa-warehouse', 5, 1, 5),
(93, 'FORM CADIDATE', 'Hr/formCandidate', 'fa fa-edit', 97, 1, 1),
(94, 'list candidate', 'hr/listcandidate', 'fa fa-users', 97, 1, 2),
(95, 'Form Summary ', 'hr/formSummary', 'fa fa-edit', 97, 0, 3),
(96, 'list Summary', 'hr/listsummary', 'fa fa-users', 97, 1, 4),
(97, 'HUMAN RESOURCES', '#', 'fa fa-user', 0, 1, 3),
(98, 'absensi', 'hr/absensi', 'fa fa-edit', 97, 1, 4),
(99, 'timesheet', 'hr/timesheet', 'fa fa-edit', 97, 1, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_posisi`
--

CREATE TABLE `tbl_posisi` (
  `_id` int NOT NULL,
  `posisi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `viewed` int NOT NULL DEFAULT '0',
  `indirect` enum('indirect','direct') NOT NULL,
  `Level #1` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `Level #2` varchar(50) DEFAULT NULL,
  `Level #3` varchar(50) DEFAULT NULL,
  `Level #4` varchar(50) DEFAULT NULL,
  `C1` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `C2` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `C3` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `C4` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `C5` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_posisi`
--

INSERT INTO `tbl_posisi` (`_id`, `posisi`, `viewed`, `indirect`, `Level #1`, `Level #2`, `Level #3`, `Level #4`, `C1`, `C2`, `C3`, `C4`, `C5`) VALUES
(1, 'Superadmin', 0, 'indirect', '', '', '', '', '', '', '', '', ''),
(2, 'Admin', 0, 'indirect', '', '', '', '', '', '', '', '', ''),
(3, 'Supervisor', 0, 'indirect', '', '', '', '', '', '', '', '', ''),
(5, 'Manager', 0, 'indirect', '', '', '', '', '', '', '', '', ''),
(6, 'Helper', 0, 'indirect', '', '', '', '', '', '', '', '', ''),
(8, 'Foreman', 0, 'indirect', '', '', '', '', '', '', '', '', ''),
(10, 'Welder', 0, 'indirect', '', '', '', '', '', '', '', '', ''),
(12, 'AdminShare', 0, 'indirect', '', '', '', '', '', '', '', '', ''),
(13, 'Guest', 0, 'indirect', '', '', '', '', '', '', '', '', ''),
(14, 'Guest01', 0, 'indirect', '', '', '', '', '', '', '', '', ''),
(15, 'Director', 0, 'indirect', '', '', '', '', '', '', '', '', ''),
(16, 'Candidate', 0, 'direct', '', '', '', '', '', '', '', '', ''),
(442, 'Management Executive Director', 0, 'indirect', 'Management', 'Executive Director', NULL, NULL, 'I', 'V', '1', '0', '1'),
(443, 'Management Director', 0, 'indirect', 'Management', 'Director', NULL, NULL, 'I', 'V', '2', '0', '2'),
(444, 'Project Management Project Manager', 0, 'indirect', 'Project Management', 'Project Manager', NULL, NULL, 'I', 'S', '1', '0', '1'),
(445, 'Project Management Deputy Project Manager', 0, 'indirect', 'Project Management', 'Deputy Project Manager', NULL, NULL, 'I', 'S', '1', '0', '2'),
(446, 'Project Management Site Manager', 0, 'indirect', 'Project Management', 'Site Manager', NULL, NULL, 'I', 'S', '2', '0', '1'),
(447, 'Project Management Construction Manager', 0, 'indirect', 'Project Management', 'Construction Manager', NULL, NULL, 'I', 'S', '2', '0', '2'),
(448, 'Adminstration Manager', 0, 'indirect', 'Adminstration', 'Manager', NULL, NULL, 'I', 'A', '1', '0', '1'),
(449, 'Adminstration Junior Manager', 0, 'indirect', 'Adminstration', 'Junior Manager', NULL, NULL, 'I', 'A', '1', '0', '2'),
(450, 'Adminstration Administration General Affair', 0, 'indirect', 'Adminstration', 'Administration General Affair', 'General Administration', NULL, 'I', 'A', '2', '0', '1'),
(451, 'Adminstration IT & Communication Staff', 0, 'indirect', 'Adminstration', 'IT & Communication Staff', NULL, NULL, 'I', 'A', '2', '0', '2'),
(452, 'Adminstration HRD Leader', 0, 'indirect', 'Adminstration', 'HRD Leader', NULL, NULL, 'I', 'A', '2', '0', '3'),
(453, 'Adminstration HRD Assistant', 0, 'indirect', 'Adminstration', 'HRD Assistant', NULL, NULL, 'I', 'A', '2', '0', '4'),
(454, 'Adminstration Public Relation Officer (PRO)', 0, 'indirect', 'Adminstration', 'Public Relation Officer (PRO)', NULL, NULL, 'I', 'A', '2', '0', '5'),
(455, 'Adminstration Admin Assistant', 0, 'indirect', 'Adminstration', 'Admin Assistant', NULL, NULL, 'I', 'A', '2', '0', '6'),
(456, 'Adminstration Time Keeper', 0, 'indirect', 'Adminstration', 'Time Keeper', NULL, NULL, 'I', 'A', '2', '0', '7'),
(457, 'Adminstration General Document Control', 0, 'indirect', 'Adminstration', 'General Document Control', NULL, NULL, 'I', 'A', '2', '0', '8'),
(458, 'Adminstration Secretary', 0, 'indirect', 'Adminstration', 'Secretary', NULL, NULL, 'I', 'A', '2', '0', '9'),
(459, 'Administration Security', 0, 'indirect', 'Administration', 'Security', 'ehh', NULL, 'I', 'A', '3', '0', '1'),
(460, 'Administration Common Support - Office', 0, 'indirect', 'Administration', 'Common Support', 'Office', NULL, 'I', 'A', '4', '0', '1'),
(461, 'Administration Common Support - Environment (Enviro)', 0, 'indirect', 'Administration', 'Common Support', 'Environment (Enviro)', NULL, 'I', 'A', '4', '0', '2'),
(462, 'Administration Common Support - Misc.', 0, 'indirect', 'Administration', 'Common Support', 'Misc.', NULL, 'I', 'A', '4', '0', '3'),
(463, 'Financing & Accounting Manager', 0, 'indirect', 'Financing & Accounting', 'Manager', NULL, NULL, 'I', 'F', '1', '0', '1'),
(464, 'Financing & Accounting Staff', 0, 'indirect', 'Financing & Accounting', 'Financing & Accounting Staff', NULL, NULL, 'I', 'F', '1', '0', '2'),
(465, 'Procurement & Material Puchasing & Expediting Staff', 0, 'indirect', 'Procurement & Material', 'Puchasing & Expediting Staff', NULL, NULL, 'I', 'M', '1', '0', '1'),
(466, 'Procurement & Material Material Manager/Coordinator', 0, 'indirect', 'Procurement & Material', 'Material Manager/Coordinator', NULL, NULL, 'I', 'M', '2', '0', '1'),
(467, 'Procurement & Material Material Staff (General)', 0, 'indirect', 'Procurement & Material', 'Material Staff (General)', NULL, NULL, 'I', 'M', '2', '0', '2'),
(468, 'Procurement & Material Material Assistant', 0, 'indirect', 'Procurement & Material', 'Material Assistant', NULL, NULL, 'I', 'M', '2', '0', '3'),
(469, 'Procurement & Material Material Helper', 0, 'indirect', 'Procurement & Material', 'Material Helper', NULL, NULL, 'I', 'M', '2', '1', '1'),
(470, 'Procurement & Material Spool Control Supervisor/Coordinator', 0, 'indirect', 'Procurement & Material', 'Spool Control Supervisor/Coordinator', NULL, NULL, 'I', 'M', '3', '0', '1'),
(471, 'Procurement & Material Spool Control Foreman', 0, 'indirect', 'Procurement & Material', 'Spool Control Foreman', NULL, NULL, 'I', 'M', '3', '1', '1'),
(472, 'Procurement & Material Spool Control Leader', 0, 'indirect', 'Procurement & Material', 'Spool Control Leader', NULL, NULL, 'I', 'M', '3', '1', '2'),
(473, 'Procurement & Material Spool Control Assistant', 0, 'indirect', 'Procurement & Material', 'Spool Control Assistant', NULL, NULL, 'I', 'M', '3', '1', '3'),
(474, 'Procurement & Material Spool Handling Labor', 0, 'indirect', 'Procurement & Material', 'Spool Handling Labor', NULL, NULL, 'I', 'M', '3', '1', '4'),
(475, 'Procurement & Material Logistics', 0, 'indirect', 'Procurement & Material', 'Logistics', NULL, NULL, 'I', 'M', '4', '0', '1'),
(476, 'Procurement & Material Warehouse Supervisor', 0, 'indirect', 'Procurement & Material', 'Warehouse Supervisor', NULL, NULL, 'I', 'M', '5', '0', '1'),
(477, 'Procurement & Material Warehouse Leader', 0, 'indirect', 'Procurement & Material', 'Warehouse Leader', NULL, NULL, 'I', 'M', '5', '0', '2'),
(478, 'Procurement & Material Tool/Consumable Keeper (Recording with Computer)', 0, 'indirect', 'Procurement & Material', 'Tool/Consumable Keeper', 'Recording with Computer', NULL, 'I', 'M', '5', '0', '2'),
(479, 'Procurement & Material Tool/Consumable Keeper (Non-Skill Recording with Computer)', 0, 'indirect', 'Procurement & Material', 'Tool/Consumable Keeper', 'Non-Skill Recording with Computer', NULL, 'I', 'M', '5', '0', '3'),
(480, 'Procurement & Material Fuel Controller', 0, 'indirect', 'Procurement & Material', 'Fuel Controller', NULL, NULL, 'I', 'M', '5', '0', '4'),
(481, 'Procurement & Material Warehouse Assistance (General)', 0, 'indirect', 'Procurement & Material', 'Warehouse Assistance (General)', NULL, NULL, 'I', 'M', '5', '0', '5'),
(482, 'Procurement & Material Warehouse Labor', 0, 'indirect', 'Procurement & Material', 'Warehouse Labor', NULL, NULL, 'I', 'M', '5', '1', '1'),
(483, 'Project Control Manager', 0, 'indirect', 'Project Control', 'Manager', NULL, NULL, 'I', 'P', '1', '0', '1'),
(484, 'Project Control Junior Manager', 0, 'indirect', 'Project Control', 'Junior Manager', NULL, NULL, 'I', 'P', '1', '0', '2'),
(485, 'Project Control Cost Controller', 0, 'indirect', 'Project Control', 'Cost Controller', NULL, NULL, 'I', 'P', '2', '0', '1'),
(486, 'Project Control Project Controller', 0, 'indirect', 'Project Control', 'Project Controller', NULL, NULL, 'I', 'P', '2', '0', '2'),
(487, 'Project Control Sublet Controller', 0, 'indirect', 'Project Control', 'Sublet Controller', NULL, NULL, 'I', 'P', '2', '0', '3'),
(488, 'Project Control Schedule Manager', 0, 'indirect', 'Project Control', 'Schedule Manager', NULL, NULL, 'I', 'P', '2', '0', '4'),
(489, 'Project Control Schedule Controller', 0, 'indirect', 'Project Control', 'Schedule Controller', NULL, NULL, 'I', 'P', '2', '0', '5'),
(490, 'Project Control Quantity Surveyor', 0, 'indirect', 'Project Control', 'Quantity Surveyor', NULL, NULL, 'I', 'P', '2', '0', '6'),
(491, 'Project Control Document Controller (General)', 0, 'indirect', 'Project Control', 'Document Controller (General)', NULL, NULL, 'I', 'P', '2', '0', '7'),
(492, 'Engineering Lead Engineer', 0, 'indirect', 'Engineering', 'Lead Engineer', NULL, NULL, 'I', 'E', '1', '0', '1'),
(493, 'Engineering Engineer Process', 0, 'indirect', 'Engineering', 'Engineer', 'Process', NULL, 'I', 'E', '2', '0', '1'),
(494, 'Engineering Engineer Civil', 0, 'indirect', 'Engineering', 'Engineer', 'Civil', NULL, 'I', 'E', '2', '0', '2'),
(495, 'Engineering Engineer Architecture', 0, 'indirect', 'Engineering', 'Engineer', 'Architecture', NULL, 'I', 'E', '2', '0', '3'),
(496, 'Engineering Engineer Mech. Equipment', 0, 'indirect', 'Engineering', 'Engineer', 'Mech. Equipment', NULL, 'I', 'E', '2', '0', '4'),
(497, 'Engineering Engineer Piping', 0, 'indirect', 'Engineering', 'Engineer', 'Piping', NULL, 'I', 'E', '2', '0', '5'),
(498, 'Engineering Engineer Steel Structure', 0, 'indirect', 'Engineering', 'Engineer', 'Steel Structure', NULL, 'I', 'E', '2', '0', '6'),
(499, 'Engineering Engineer Tank', 0, 'indirect', 'Engineering', 'Engineer', 'Tank', NULL, 'I', 'E', '2', '0', '7'),
(500, 'Engineering Engineer Electrical', 0, 'indirect', 'Engineering', 'Engineer', 'Electrical', NULL, 'I', 'E', '2', '0', '8'),
(501, 'Engineering Engineer Instrument', 0, 'indirect', 'Engineering', 'Engineer', 'Instrument', NULL, 'I', 'E', '2', '0', '9'),
(502, 'Engineering Engineer Firefighting', 0, 'indirect', 'Engineering', 'Engineer', 'Firefighting', NULL, 'I', 'E', '2', '1', '0'),
(503, 'Engineering Engineer HVAC', 0, 'indirect', 'Engineering', 'Engineer', 'HVAC', NULL, 'I', 'E', '2', '1', '1'),
(504, 'Engineering Drafter Civil', 0, 'indirect', 'Engineering', 'Drafter', 'Civil', NULL, 'I', 'E', '3', '0', '1'),
(505, 'Engineering Drafter Architecture', 0, 'indirect', 'Engineering', 'Drafter', 'Architecture', NULL, 'I', 'E', '3', '0', '2'),
(506, 'Engineering Drafter Mech. Equipment', 0, 'indirect', 'Engineering', 'Drafter', 'Mech. Equipment', NULL, 'I', 'E', '3', '0', '3'),
(507, 'Engineering Drafter Piping', 0, 'indirect', 'Engineering', 'Drafter', 'Piping', NULL, 'I', 'E', '3', '0', '4'),
(508, 'Engineering Drafter Steel Structure', 0, 'indirect', 'Engineering', 'Drafter', 'Steel Structure', NULL, 'I', 'E', '3', '0', '5'),
(509, 'Engineering Drafter Tank', 0, 'indirect', 'Engineering', 'Drafter', 'Tank', NULL, 'I', 'E', '3', '0', '6'),
(510, 'Engineering Drafter Electrical', 0, 'indirect', 'Engineering', 'Drafter', 'Electrical', NULL, 'I', 'E', '3', '0', '7'),
(511, 'Engineering Drafter Instrument', 0, 'indirect', 'Engineering', 'Drafter', 'Instrument', NULL, 'I', 'E', '3', '0', '8'),
(512, 'Engineering Drafter Firefighting', 0, 'indirect', 'Engineering', 'Drafter', 'Firefighting', NULL, 'I', 'E', '3', '0', '9'),
(513, 'Engineering Drafter HVAC', 0, 'indirect', 'Engineering', 'Drafter', 'HVAC', NULL, 'I', 'E', '3', '1', '0'),
(514, 'Engineering Document', 0, 'indirect', 'Engineering', 'Document', NULL, NULL, 'I', 'E', '4', '0', '1'),
(515, 'Construction Superintendent', 0, 'indirect', 'Construction', 'Superintendent', NULL, NULL, 'I', 'C', '1', '0', '1'),
(516, 'Construction Lead Supervisor', 0, 'indirect', 'Construction', 'Lead Supervisor', NULL, NULL, 'I', 'C', '1', '0', '2'),
(517, 'Construction General Supervisor', 0, 'indirect', 'Construction', 'General Supervisor', NULL, NULL, 'I', 'C', '1', '0', '3'),
(518, 'Construction Supervisor Civil', 0, 'indirect', 'Construction', 'Supervisor', 'Civil', NULL, 'I', 'C', '2', '0', '1'),
(519, 'Construction Supervisor Architecture', 0, 'indirect', 'Construction', 'Supervisor', 'Architecture', NULL, 'I', 'C', '2', '0', '2'),
(520, 'Construction Supervisor Mech. Equipment', 0, 'indirect', 'Construction', 'Supervisor', 'Mech. Equipment', NULL, 'I', 'C', '2', '0', '3'),
(521, 'Construction Supervisor Piping General', 0, 'indirect', 'Construction', 'Supervisor', 'Piping General', NULL, 'I', 'C', '2', '0', '4'),
(522, 'Construction Supervisor Piping Welding', 0, 'indirect', 'Construction', 'Supervisor', 'Piping Welding', NULL, 'I', 'C', '2', '0', '5'),
(523, 'Construction Supervisor Piping Support', 0, 'indirect', 'Construction', 'Supervisor', 'Piping Support', NULL, 'I', 'C', '2', '0', '6'),
(524, 'Construction Supervisor Steel Structure', 0, 'indirect', 'Construction', 'Supervisor', 'Steel Structure', NULL, 'I', 'C', '2', '0', '7'),
(525, 'Construction Supervisor Tank', 0, 'indirect', 'Construction', 'Supervisor', 'Tank', NULL, 'I', 'C', '2', '0', '8'),
(526, 'Construction Supervisor Electrical', 0, 'indirect', 'Construction', 'Supervisor', 'Electrical', NULL, 'I', 'C', '2', '1', '9'),
(527, 'Construction Supervisor Instrument', 0, 'indirect', 'Construction', 'Supervisor', 'Instrument', NULL, 'I', 'C', '2', '1', '0'),
(528, 'Construction Supervisor Painting', 0, 'indirect', 'Construction', 'Supervisor', 'Painting', NULL, 'I', 'C', '2', '1', '1'),
(529, 'Construction Supervisor Insulation', 0, 'indirect', 'Construction', 'Supervisor', 'Insulation', NULL, 'I', 'C', '2', '1', '2'),
(530, 'Construction Supervisor Firefighting', 0, 'indirect', 'Construction', 'Supervisor', 'Firefighting', NULL, 'I', 'C', '2', '1', '3'),
(531, 'Construction Supervisor HVAC', 0, 'indirect', 'Construction', 'Supervisor', 'HVAC', NULL, 'I', 'C', '2', '1', '4'),
(532, 'Construction Supervisor Rigging', 0, 'indirect', 'Construction', 'Supervisor', 'Rigging', NULL, 'I', 'C', '2', '1', '5'),
(533, 'Construction Supervisor Scaffolding', 0, 'indirect', 'Construction', 'Supervisor', 'Scaffolding', NULL, 'I', 'C', '2', '1', '6'),
(534, 'Construction Supervisor Const. Equip. Control', 0, 'indirect', 'Construction', 'Supervisor', 'Const. Equip. Control', NULL, 'I', 'C', '2', '1', '7'),
(535, 'Construction Assistant', 0, 'indirect', 'Construction', 'Construction Assistant', NULL, NULL, 'I', 'C', '3', '0', '1'),
(536, 'Construction Surveyor', 0, 'indirect', 'Construction', 'Surveyor', NULL, NULL, 'I', 'C', '4', '0', '1'),
(537, 'Construction Surveyor Assistant', 0, 'indirect', 'Construction', 'Surveyor Assistant', NULL, NULL, 'I', 'C', '4', '0', '2'),
(538, 'Quality Management Manager', 0, 'indirect', 'Quality Management', 'Manager', NULL, NULL, 'I', 'Q', '1', '0', '1'),
(539, 'Quality Management Coordinator', 0, 'indirect', 'Quality Management', 'Coordinator', NULL, NULL, 'I', 'Q', '2', '0', '1'),
(540, 'Quality Management Engineer', 0, 'indirect', 'Quality Management', 'Engineer', NULL, NULL, 'I', 'Q', '3', '0', '1'),
(541, 'Quality Management General Inspector', 0, 'indirect', 'Quality Management', 'General Inspector', NULL, NULL, 'I', 'Q', '3', '0', '2'),
(542, 'Quality Management Inspector Earth Work', 0, 'indirect', 'Quality Management', 'Inspector', 'Earth Work', NULL, 'I', 'Q', '4', '0', '1'),
(543, 'Quality Management Inspector Paving', 0, 'indirect', 'Quality Management', 'Inspector', 'Paving', NULL, 'I', 'Q', '4', '0', '2'),
(544, 'Quality Management Inspector Building', 0, 'indirect', 'Quality Management', 'Inspector', 'Building', NULL, 'I', 'Q', '4', '0', '3'),
(545, 'Quality Management Inspector Bridge', 0, 'indirect', 'Quality Management', 'Inspector', 'Bridge', NULL, 'I', 'Q', '4', '0', '4'),
(546, 'Quality Management Inspector Concrete Foundation', 0, 'indirect', 'Quality Management', 'Inspector', 'Concrete Foundation', NULL, 'I', 'Q', '4', '0', '5'),
(547, 'Quality Management Inspector Lowering/Bedding', 0, 'indirect', 'Quality Management', 'Inspector', 'Lowering/Bedding', NULL, 'I', 'Q', '4', '0', '6'),
(548, 'Quality Management Inspector Plumbing', 0, 'indirect', 'Quality Management', 'Inspector', 'Plumbing', NULL, 'I', 'Q', '4', '0', '7'),
(549, 'Quality Management Inspector HDPE Welding', 0, 'indirect', 'Quality Management', 'Inspector', 'HDPE Welding', NULL, 'I', 'Q', '4', '0', '8'),
(550, 'Quality Management Inspector PVC/GRP', 0, 'indirect', 'Quality Management', 'Inspector', 'PVC/GRP', NULL, 'I', 'Q', '4', '0', '9'),
(551, 'Quality Management Inspector Piping', 0, 'indirect', 'Quality Management', 'Inspector', 'Piping', NULL, 'I', 'Q', '4', '1', '0'),
(552, 'Quality Management Inspector Welding-Piping', 0, 'indirect', 'Quality Management', 'Inspector', 'Welding-Piping', NULL, 'I', 'Q', '4', '1', '1'),
(553, 'Quality Management Inspector Welding-Tank', 0, 'indirect', 'Quality Management', 'Inspector', 'Welding-Tank', NULL, 'I', 'Q', '4', '1', '2'),
(554, 'Quality Management Inspector Welding-Others', 0, 'indirect', 'Quality Management', 'Inspector', 'Welding-Others', NULL, 'I', 'Q', '4', '1', '3'),
(555, 'Quality Management Inspector Steel Structure', 0, 'indirect', 'Quality Management', 'Inspector', 'Steel Structure', NULL, 'I', 'Q', '4', '1', '4'),
(556, 'Quality Management Inspector Tank', 0, 'indirect', 'Quality Management', 'Inspector', 'Tank', NULL, 'I', 'Q', '4', '1', '5'),
(557, 'Quality Management Inspector NDE', 0, 'indirect', 'Quality Management', 'Inspector', 'NDE', NULL, 'I', 'Q', '4', '1', '6'),
(558, 'Quality Management Inspector PWHT', 0, 'indirect', 'Quality Management', 'Inspector', 'PWHT', NULL, 'I', 'Q', '4', '1', '7'),
(559, 'Quality Management Inspector PMI', 0, 'indirect', 'Quality Management', 'Inspector', 'PMI', NULL, 'I', 'Q', '4', '1', '8'),
(560, 'Quality Management Inspector Testing', 0, 'indirect', 'Quality Management', 'Inspector', 'Testing', NULL, 'I', 'Q', '4', '1', '9'),
(561, 'Quality Management Inspector Electrical', 0, 'indirect', 'Quality Management', 'Inspector', 'Electrical', NULL, 'I', 'Q', '4', '2', '0'),
(562, 'Quality Management Inspector Cathodic Protection', 0, 'indirect', 'Quality Management', 'Inspector', 'Cathodic Protection', NULL, 'I', 'Q', '4', '2', '1'),
(563, 'Quality Management Inspector Instrument', 0, 'indirect', 'Quality Management', 'Inspector', 'Instrument', NULL, 'I', 'Q', '4', '2', '2'),
(564, 'Quality Management Inspector Communication', 0, 'indirect', 'Quality Management', 'Inspector', 'Communication', NULL, 'I', 'Q', '4', '2', '3'),
(565, 'Quality Management Inspector Coating & Painting', 0, 'indirect', 'Quality Management', 'Inspector', 'Coating & Painting', NULL, 'I', 'Q', '4', '2', '4'),
(566, 'Quality Management Inspector Insulation', 0, 'indirect', 'Quality Management', 'Inspector', 'Insulation', NULL, 'I', 'Q', '4', '2', '5'),
(567, 'Quality Management Inspector Firefighting', 0, 'indirect', 'Quality Management', 'Inspector', 'Firefighting', NULL, 'I', 'Q', '4', '2', '6'),
(568, 'Quality Management Inspector HVAC', 0, 'indirect', 'Quality Management', 'Inspector', 'HVAC', NULL, 'I', 'Q', '4', '2', '7'),
(569, 'Quality Management Inspector VENDOR-PWHT', 0, 'indirect', 'Quality Management', 'Inspector', 'VENDOR-PWHT', NULL, 'I', 'Q', '4', '2', '8'),
(570, 'Quality Management Inspector VENDOR-NDE', 0, 'indirect', 'Quality Management', 'Inspector', 'VENDOR-NDE', NULL, 'I', 'Q', '4', '2', '9'),
(571, 'Quality Management Inspector VENDOR - OPEN #1', 0, 'indirect', 'Quality Management', 'Inspector', 'VENDOR - OPEN #1', NULL, 'I', 'Q', '4', '3', '0'),
(572, 'Quality Management Inspector VENDOR - OPEN #2', 0, 'indirect', 'Quality Management', 'Inspector', 'VENDOR - OPEN #2', NULL, 'I', 'Q', '4', '3', '1'),
(573, 'Quality Management Inspector VENDOR - OPEN #3', 0, 'indirect', 'Quality Management', 'Inspector', 'VENDOR - OPEN #3', NULL, 'I', 'Q', '4', '3', '2'),
(574, 'Quality Management Documentation & Assistant', 0, 'indirect', 'Quality Management', 'Documentation & Assistant', NULL, NULL, 'I', 'Q', '5', '0', '1'),
(575, 'HSE Management Manager', 0, 'indirect', 'HSE Management', 'Manager', NULL, NULL, 'I', 'H', '1', '0', '1'),
(576, 'HSE Management Coordinator', 0, 'indirect', 'HSE Management', 'Coordinator', NULL, NULL, 'I', 'H', '2', '0', '1'),
(577, 'HSE Management Supervisor', 0, 'indirect', 'HSE Management', 'Supervisor', NULL, NULL, 'I', 'H', '3', '0', '1'),
(578, 'HSE Management Staff & Officer', 0, 'indirect', 'HSE Management', 'Staff & Officer', NULL, NULL, 'I', 'H', '4', '0', '1'),
(579, 'HSE Management Permit', 0, 'indirect', 'HSE Management', 'Permit', NULL, NULL, 'I', 'H', '4', '0', '2'),
(580, 'HSE Management Administration', 0, 'indirect', 'HSE Management', 'Administration', NULL, NULL, 'I', 'H', '4', '0', '3'),
(581, 'HSE Management Assistant', 0, 'indirect', 'HSE Management', 'Assistant', NULL, NULL, 'I', 'H', '5', '0', '1'),
(582, 'HSE Management Safety Man', 0, 'indirect', 'HSE Management', 'Safety Man', NULL, NULL, 'I', 'H', '5', '0', '2'),
(583, 'HSE Management Labor', 0, 'indirect', 'HSE Management', 'Labor', NULL, NULL, 'I', 'H', '5', '0', '3'),
(584, 'HSE Management Flag man', 0, 'indirect', 'HSE Management', 'Flag man', NULL, NULL, 'I', 'H', '5', '0', '4'),
(585, 'HSE Management Doctor', 0, 'indirect', 'HSE Management', 'Doctor', NULL, NULL, 'I', 'H', '6', '0', '1'),
(586, 'HSE Management Nurse', 0, 'indirect', 'HSE Management', 'Nurse', NULL, NULL, 'I', 'H', '7', '0', '1'),
(587, 'Commissioning Manager', 0, 'indirect', 'Commissioning', 'Manager', NULL, NULL, 'I', 'G', '1', '0', '1'),
(588, 'Commissioning Engineer', 0, 'indirect', 'Commissioning', 'Engineer', NULL, NULL, 'I', 'G', '2', '0', '1'),
(589, 'Commissioning Assistant', 0, 'indirect', 'Commissioning', 'Assistant', NULL, NULL, 'I', 'G', '3', '0', '1'),
(590, 'Specialist Vendor Supervisor', 0, 'indirect', 'Specialist', 'Vendor Supervisor', NULL, NULL, 'I', 'T', '1', '0', '1'),
(591, 'Specialist Licenser Supervisor', 0, 'indirect', 'Specialist', 'Licenser Supervisor', NULL, NULL, 'I', 'T', '1', '0', '2'),
(592, 'Other Indirect & Labor Office Vehicle Driver', 0, 'indirect', 'Other Indirect & Labor', 'Office Vehicle Driver', NULL, NULL, 'I', 'O', '1', '0', '1'),
(593, 'Other Indirect & Labor Mechanic - Maintenance', 0, 'indirect', 'Other Indirect & Labor', 'Mechanic - Maintenance', NULL, NULL, 'I', 'O', '2', '0', '1'),
(594, 'Other Indirect & Labor Electrician - Maintenance', 0, 'indirect', 'Other Indirect & Labor', 'Electrician - Maintenance', NULL, NULL, 'I', 'O', '2', '0', '2'),
(595, 'Other Indirect & Labor Maintenance - Assistance', 0, 'indirect', 'Other Indirect & Labor', 'Maintenance - Assistance', NULL, NULL, 'I', 'O', '2', '0', '3'),
(596, 'Other Indirect & Labor Office Cleaner', 0, 'indirect', 'Other Indirect & Labor', 'Office Cleaner', NULL, NULL, 'I', 'O', '3', '0', '1'),
(597, 'Other Indirect & Labor Cook', 0, 'indirect', 'Other Indirect & Labor', 'Cook', NULL, NULL, 'I', 'O', '4', '0', '1'),
(598, 'Other Indirect & Labor Camp Assistant', 0, 'indirect', 'Other Indirect & Labor', 'Camp Assistant', NULL, NULL, 'I', 'O', '4', '0', '2'),
(599, 'Other Indirect & Labor Other Personnel', 0, 'indirect', 'Other Indirect & Labor', 'Other Personnel', NULL, NULL, 'I', 'O', '5', '0', '1'),
(600, 'Foreman General', 0, 'direct', 'Foreman', 'General', NULL, NULL, 'D', 'F', '0', '0', '1'),
(601, 'Foreman Civil', 0, 'direct', 'Foreman', 'Civil', NULL, NULL, 'D', 'F', '1', '0', '1'),
(602, 'Foreman Architecture', 0, 'direct', 'Foreman', 'Architecture', NULL, NULL, 'D', 'F', '1', '0', '2'),
(603, 'Foreman HVAC', 0, 'direct', 'Foreman', 'HVAC', NULL, NULL, 'D', 'F', '1', '0', '3'),
(604, 'Foreman Tank', 0, 'direct', 'Foreman', 'Tank', NULL, NULL, 'D', 'F', '2', '0', '1'),
(605, 'Foreman Steel Structure', 0, 'direct', 'Foreman', 'Steel Structure', NULL, NULL, 'D', 'F', '2', '0', '2'),
(606, 'Foreman Mech. Equipment', 0, 'direct', 'Foreman', 'Mech. Equipment', NULL, NULL, 'D', 'F', '2', '0', '3'),
(607, 'Foreman Piping', 0, 'direct', 'Foreman', 'Piping', NULL, NULL, 'D', 'F', '2', '0', '4'),
(608, 'Foreman Piping Welding', 0, 'direct', 'Foreman', 'Piping Welding', NULL, NULL, 'D', 'F', '2', '0', '5'),
(609, 'Foreman Piping Fitting', 0, 'direct', 'Foreman', 'Piping Fitting', NULL, NULL, 'D', 'F', '2', '0', '6'),
(610, 'Foreman Piping Support', 0, 'direct', 'Foreman', 'Piping Support', NULL, NULL, 'D', 'F', '2', '0', '7'),
(611, 'Foreman Piping Commissioining', 0, 'direct', 'Foreman', 'Piping Commissioining', NULL, NULL, 'D', 'F', '2', '0', '8'),
(612, 'Foreman Electrical', 0, 'direct', 'Foreman', 'Electrical', NULL, NULL, 'D', 'F', '3', '0', '1'),
(613, 'Foreman Instrument', 0, 'direct', 'Foreman', 'Instrument', NULL, NULL, 'D', 'F', '3', '0', '2'),
(614, 'Foreman Painting', 0, 'direct', 'Foreman', 'Painting', NULL, NULL, 'D', 'F', '4', '0', '1'),
(615, 'Foreman Insulation', 0, 'direct', 'Foreman', 'Insulation', NULL, NULL, 'D', 'F', '4', '0', '2'),
(616, 'Foreman Firefighting', 0, 'direct', 'Foreman', 'Firefighting', NULL, NULL, 'D', 'F', '5', '0', '1'),
(617, 'Foreman Rigging', 0, 'direct', 'Foreman', 'Rigging', NULL, NULL, 'D', 'F', '6', '0', '1'),
(618, 'Foreman Scaffolding', 0, 'direct', 'Foreman', 'Scaffolding', NULL, NULL, 'D', 'F', '6', '0', '2'),
(619, 'Civil Common Skilled', 0, 'direct', 'Civil Common Skilled', 'Civil Common Skilled', NULL, 'Skilled', 'D', 'S', '1', '0', '1'),
(620, 'Pile Driver', 0, 'direct', 'Pile Driver', 'Pile Driver', NULL, 'Skilled', 'D', 'S', '1', '0', '2'),
(621, 'Rebar Worker', 0, 'direct', 'Rebar Worker', 'Rebar Worker', NULL, 'Skilled', 'D', 'S', '1', '0', '3'),
(622, 'Carpenter & Form Worker', 0, 'direct', 'Carpenter & Form Worker', 'Carpenter & Form Worker', NULL, 'Skilled', 'D', 'S', '1', '0', '4'),
(623, 'Concrete Worker', 0, 'direct', 'Concrete Worker', 'Concrete Worker', NULL, 'Skilled', 'D', 'S', '1', '0', '5'),
(624, 'Grouting Worker', 0, 'direct', 'Grouting Worker', 'Grouting Worker', NULL, 'Skilled', 'D', 'S', '1', '0', '6'),
(625, 'Paving Skilled Worker', 0, 'direct', 'Paving Skilled Worker', 'Paving Skilled Worker', NULL, 'Skilled', 'D', 'S', '1', '0', '7'),
(626, 'Fireproofing Worker', 0, 'direct', 'Fireproofing Worker', 'Fireproofing Worker', NULL, 'Skilled', 'D', 'S', '1', '0', '8'),
(627, 'Mason', 0, 'direct', 'Mason', 'Mason', NULL, 'Skilled', 'D', 'S', '2', '0', '1'),
(628, 'Plaster', 0, 'direct', 'Plaster', 'Plaster', NULL, 'Skilled', 'D', 'S', '2', '0', '2'),
(629, 'Tile Worker', 0, 'direct', 'Tile Worker', 'Tile Worker', NULL, 'Skilled', 'D', 'S', '2', '0', '3'),
(630, 'Metal Sheet Worker', 0, 'direct', 'Metal Sheet Worker', 'Metal Sheet Worker', NULL, 'Skilled', 'D', 'S', '2', '0', '4'),
(631, 'HVAC & Duct Worker', 0, 'direct', 'HVAC & Duct Worker', 'HVAC & Duct Worker', NULL, 'Skilled', 'D', 'S', '2', '0', '5'),
(632, 'Plumber', 0, 'direct', 'Plumber', 'Plumber', NULL, 'Skilled', 'D', 'S', '2', '0', '6'),
(633, 'General Steel Worker', 0, 'direct', 'General Steel Worker', 'General Steel Worker', NULL, 'Skilled', 'D', 'S', '3', '0', '1'),
(634, 'Mill Wrighter', 0, 'direct', 'Mill Wrighter', 'Mill Wrighter', NULL, 'Skilled', 'D', 'S', '3', '0', '2'),
(635, 'Mech. Equip. Erector & Installation', 0, 'direct', 'Mech. Equip. Erector & Installation', 'Mech. Equip. Erector & Installation', NULL, 'Skilled', 'D', 'S', '3', '0', '4'),
(636, 'Welder Cement Lining', 0, 'direct', 'Welder Cement Lining', 'Welder Cement Lining', NULL, 'Skilled', 'D', 'S', '4', '0', '1'),
(637, 'Welder CS', 0, 'direct', 'Welder CS', 'Welder CS', NULL, 'Skilled', 'D', 'S', '4', '0', '2'),
(638, 'Welder SS', 0, 'direct', 'Welder SS', 'Welder SS', NULL, 'Skilled', 'D', 'S', '4', '0', '3'),
(639, 'Welder AS', 0, 'direct', 'Welder AS', 'Welder AS', NULL, 'Skilled', 'D', 'S', '4', '0', '4'),
(640, 'Welder Support', 0, 'direct', 'Welder Support', 'Welder Support', NULL, 'Skilled', 'D', 'S', '4', '0', '5'),
(641, 'Welder Cement Lining + C/S', 0, 'direct', 'Welder Cement Lining + C/S', 'Welder Cement Lining + C/S', NULL, 'Skilled', 'D', 'S', '4', '0', '6'),
(642, 'Welder C/S GTAW + SMAW', 0, 'direct', 'Welder C/S GTAW + SMAW', 'Welder C/S GTAW + SMAW', NULL, 'Skilled', 'D', 'S', '4', '0', '7'),
(643, 'Welder Plate 2G', 0, 'direct', 'Welder Plate 2G', 'Welder Plate 2G', NULL, 'Skilled', 'D', 'S', '4', '0', '8'),
(644, 'Welder Plate 3G', 0, 'direct', 'Welder Plate 3G', 'Welder Plate 3G', NULL, 'Skilled', 'D', 'S', '4', '0', '9'),
(645, 'Welder Plate 2G & 3G', 0, 'direct', 'Welder Plate 2G & 3G', 'Welder Plate 2G & 3G', NULL, 'Skilled', 'D', 'S', '4', '1', '0'),
(646, 'Welder Open #7', 0, 'direct', 'Welder Open #7', 'Welder Open #7', NULL, 'Skilled', 'D', 'S', '4', '1', '1'),
(647, 'Welder Open #8', 0, 'direct', 'Welder Open #8', 'Welder Open #8', NULL, 'Skilled', 'D', 'S', '4', '1', '2'),
(648, 'Piping Fitter #1 (1)', 0, 'direct', 'Piping Fitter #1', 'Piping Fitter #1', NULL, 'Skilled', 'D', 'S', '5', '0', '1'),
(649, 'Piping Fitter #1 (2)', 0, 'direct', 'Piping Fitter #1', 'Piping Fitter #1', NULL, 'Skilled', 'D', 'S', '5', '0', '2'),
(650, 'Piping Fitter #1 Open #1', 0, 'direct', 'Piping Fitter #1 Open #1', 'Piping Fitter #1 Open #1', NULL, 'Skilled', 'D', 'S', '5', '0', '3'),
(651, 'Piping Fitter #2 Open #1', 0, 'direct', 'Piping Fitter #2 Open #1', 'Piping Fitter #2 Open #1', NULL, 'Skilled', 'D', 'S', '5', '0', '4'),
(652, 'Steel Fitter #1', 0, 'direct', 'Steel Fitter #1', 'Steel Fitter #1', NULL, 'Skilled', 'D', 'S', '5', '0', '5'),
(653, 'Steel Fitter #2', 0, 'direct', 'Steel Fitter #2', 'Steel Fitter #2', NULL, 'Skilled', 'D', 'S', '5', '0', '6'),
(654, 'Rigger #1', 0, 'direct', 'Rigger #1', 'Rigger #1', NULL, 'Skilled', 'D', 'S', '6', '0', '1'),
(655, 'Rigger #2', 0, 'direct', 'Rigger #2', 'Rigger #2', NULL, 'Skilled', 'D', 'S', '6', '0', '2'),
(656, 'Scaffolder #1', 0, 'direct', 'Scaffolder #1', 'Scaffolder #1', NULL, 'Skilled', 'D', 'S', '7', '0', '1'),
(657, 'Scaffolder #2', 0, 'direct', 'Scaffolder #2', 'Scaffolder #2', NULL, 'Skilled', 'D', 'S', '7', '0', '2'),
(658, 'Piping Test & Flushing', 0, 'direct', 'Piping Test & Flushing', 'Piping Test & Flushing', NULL, 'Skilled', 'D', 'S', '8', '0', '1'),
(659, 'General Electrician (Cathodic Protection mapping)', 0, 'direct', 'Cathodic Protection', 'General Electrician', NULL, 'Skilled', 'D', 'S', '9', '0', '1'),
(660, 'Cathodic Protection', 0, 'direct', 'Cathodic Protection', 'Cathodic Protection', NULL, 'Skilled', 'D', 'S', '9', '0', '2'),
(661, 'Electrical Test/Check (Open - Electrical mapping)', 0, 'direct', 'Open - Electrical', 'Eelctrical Test/Check', NULL, 'Skilled', 'D', 'S', '9', '0', '3'),
(662, 'Open - Electrical', 0, 'direct', 'Open - Electrical', 'Open - Electrical', NULL, 'Skilled', 'D', 'S', '9', '0', '4'),
(663, 'General Instrument', 0, 'direct', 'General Instrument', 'General Instrument', NULL, 'Skilled', 'D', 'S', '9', '0', '5'),
(664, 'Instrument Test/Check (Open #1 map)', 0, 'direct', 'Open #1 - Instrument Skilled', 'Instrument Test/Check', NULL, 'Skilled', 'D', 'S', '9', '0', '6'),
(665, 'Open #2 - Instrument Skilled (map to Open #1)', 0, 'direct', 'Open #2 - Instrument Skilled', 'Open #1 - Instrument Skilled', NULL, 'Skilled', 'D', 'S', '9', '0', '7'),
(666, 'Open #2 - Instrument Skilled', 0, 'direct', 'Open #2 - Instrument Skilled', 'Open #2 - Instrument Skilled', NULL, 'Skilled', 'D', 'S', '9', '0', '8'),
(667, 'Sand Blaster', 0, 'direct', 'Sand Blaster', 'Sand Blaster', NULL, 'Skilled', 'D', 'S', 'A', '0', '1'),
(668, 'Painter', 0, 'direct', 'Painter', 'Painter', NULL, 'Skilled', 'D', 'S', 'A', '0', '2'),
(669, 'Insulation Fabrication', 0, 'direct', 'Insulation Fabrication', 'Insulation Fabrication', NULL, 'Skilled', 'D', 'S', 'A', '0', '3'),
(670, 'Insulation Blanketing/Jacketing (Open #1 map)', 0, 'direct', 'Open #1 - Other Skilled', 'Insulation Blanketing/Jacketing', NULL, 'Skilled', 'D', 'S', 'A', '0', '4'),
(671, 'Open #1 - Other Skilled (1)', 0, 'direct', 'Open #1 - Other Skilled', 'Open #1 - Other Skilled', NULL, 'Skilled', 'D', 'S', 'B', '0', '1'),
(672, 'Open #1 - Other Skilled (2)', 0, 'direct', 'Open #1 - Other Skilled', 'Open #1 - Other Skilled', NULL, 'Skilled', 'D', 'S', 'B', '0', '2'),
(673, 'Operator ACV', 0, 'direct', 'Open #1 - Other Skilled', 'Open #1 - Other Skilled', NULL, 'Skilled', 'D', 'S', 'B', '0', '3'),
(674, 'Operator ACV Dozer', 0, 'direct', 'Const. Equipment Operator (Direct Employee)', 'Civil', 'Dozer', 'Skilled', 'D', 'E', '0', '0', '1'),
(675, 'Operator ACV Excavator', 0, 'direct', 'Const. Equipment Operator (Direct Employee)', 'Civil', 'Excavator', 'Skilled', 'D', 'E', '0', '0', '2'),
(676, 'Operator ACV Roller', 0, 'direct', 'Const. Equipment Operator (Direct Employee)', 'Civil', 'Roller', 'Skilled', 'D', 'E', '0', '0', '3'),
(677, 'Operator ACV Grader', 0, 'direct', 'Const. Equipment Operator (Direct Employee)', 'Civil', 'Grader', 'Skilled', 'D', 'E', '0', '0', '4'),
(678, 'Operator ACV Dump Truck', 0, 'direct', 'Const. Equipment Operator (Direct Employee)', 'Civil', 'Dump Truck', 'Skilled', 'D', 'E', '0', '0', '5'),
(679, 'Operator ACV Asphalt Paver', 0, 'direct', 'Const. Equipment Operator (Direct Employee)', 'Civil', 'Asphalt Paver', 'Skilled', 'D', 'E', '0', '0', '6'),
(680, 'Operator ACV Macadam Roller', 0, 'direct', 'Const. Equipment Operator (Direct Employee)', 'Civil', 'Macadam Roller', 'Skilled', 'D', 'E', '0', '0', '7'),
(681, 'Operator ACV Tire Roller', 0, 'direct', 'Const. Equipment Operator (Direct Employee)', 'Civil', 'Tire Roller', 'Skilled', 'D', 'E', '0', '0', '8'),
(682, 'Operator ACV Tandem Roller', 0, 'direct', 'Const. Equipment Operator (Direct Employee)', 'Civil', 'Tandem Roller', 'Skilled', 'D', 'E', '0', '0', '9'),
(683, 'Operator ACV Pump Car', 0, 'direct', 'Const. Equipment Operator (Direct Employee)', 'Others', 'Pump Car', 'Skilled', 'D', 'E', '0', '1', '0'),
(684, 'Operator ACV Crane', 0, 'direct', 'Const. Equipment Operator (Direct Employee)', 'Others', 'Crane', 'Skilled', 'D', 'E', '0', '1', '1'),
(685, 'Operator ACV TMC', 0, 'direct', 'Const. Equipment Operator (Direct Employee)', 'Others', 'TMC', 'Skilled', 'D', 'E', '0', '1', '2'),
(686, 'Operator ACV Compressor', 0, 'direct', 'Const. Equipment Operator (Direct Employee)', 'Others', 'Compressor', 'Skilled', 'D', 'E', '0', '1', '3'),
(687, 'Operator ACV Generator', 0, 'direct', 'Const. Equipment Operator (Direct Employee)', 'Others', 'Generator', 'Skilled', 'D', 'E', '0', '1', '4'),
(688, 'Operator ACV Folk Lift', 0, 'direct', 'Const. Equipment Operator (Direct Employee)', 'Others', 'Folk Lift', 'Skilled', 'D', 'E', '0', '1', '5'),
(689, 'Operator ACV Trailer', 0, 'direct', 'Const. Equipment Operator (Direct Employee)', 'Others', 'Trailer', 'Skilled', 'D', 'E', '0', '1', '6'),
(690, 'Operator ACV Heavy Duty Truck', 0, 'direct', 'Const. Equipment Operator (Direct Employee)', 'Others', 'Heavy Duty Truck', 'Skilled', 'D', 'E', '0', '1', '7'),
(691, 'Operator ACV Light Duty Truck', 0, 'direct', 'Const. Equipment Operator (Direct Employee)', 'Others', 'Light Duty Truck', 'Skilled', 'D', 'E', '0', '1', '8'),
(692, 'Operator ACV Lifting System', 0, 'direct', 'Const. Equipment Operator (Direct Employee)', 'Lifting System', NULL, 'Skilled', 'D', 'E', '0', '1', '9'),
(693, 'Operator ACV Operator Assistant (Helper)', 0, 'direct', 'Const. Equipment Operator (Direct Employee)', 'Operator Assistant (Helper)', NULL, 'Helper', 'D', 'E', '0', 'H', '0'),
(694, 'Operator Supplier Dozer', 0, 'direct', 'Const. Equipment Operator (RENTAL)', 'Civil', 'Dozer', 'Skilled', 'D', 'E', '1', '0', '1'),
(695, 'Operator Supplier Excavator', 0, 'direct', 'Const. Equipment Operator (RENTAL)', 'Civil', 'Excavator', 'Skilled', 'D', 'E', '1', '0', '2'),
(696, 'Operator Supplier Roller', 0, 'direct', 'Const. Equipment Operator (RENTAL)', 'Civil', 'Roller', 'Skilled', 'D', 'E', '1', '0', '3'),
(697, 'Operator Supplier Grader', 0, 'direct', 'Const. Equipment Operator (RENTAL)', 'Civil', 'Grader', 'Skilled', 'D', 'E', '1', '0', '4'),
(698, 'Operator Supplier Dump Truck', 0, 'direct', 'Const. Equipment Operator (RENTAL)', 'Civil', 'Dump Truck', 'Skilled', 'D', 'E', '1', '0', '5'),
(699, 'Operator Supplier Asphalt Paver', 0, 'direct', 'Const. Equipment Operator (RENTAL)', 'Civil', 'Asphalt Paver', 'Skilled', 'D', 'E', '1', '0', '6'),
(700, 'Operator Supplier Macadam Roller', 0, 'direct', 'Const. Equipment Operator (RENTAL)', 'Civil', 'Macadam Roller', 'Skilled', 'D', 'E', '1', '0', '7'),
(701, 'Operator Supplier Tire Roller', 0, 'direct', 'Const. Equipment Operator (RENTAL)', 'Civil', 'Tire Roller', 'Skilled', 'D', 'E', '1', '0', '8'),
(702, 'Operator Supplier Tandem Roller', 0, 'direct', 'Const. Equipment Operator (RENTAL)', 'Civil', 'Tandem Roller', 'Skilled', 'D', 'E', '1', '0', '9'),
(703, 'Operator Supplier Pump Car', 0, 'direct', 'Const. Equipment Operator (RENTAL)', 'Others', 'Pump Car', 'Skilled', 'D', 'E', '1', '1', '0'),
(704, 'Operator Supplier Crane', 0, 'direct', 'Const. Equipment Operator (RENTAL)', 'Others', 'Crane', 'Skilled', 'D', 'E', '1', '1', '1'),
(705, 'Operator Supplier TMC', 0, 'direct', 'Const. Equipment Operator (RENTAL)', 'Others', 'TMC', 'Skilled', 'D', 'E', '1', '1', '2'),
(706, 'Operator Supplier Compressor', 0, 'direct', 'Const. Equipment Operator (RENTAL)', 'Others', 'Compressor', 'Skilled', 'D', 'E', '1', '1', '3'),
(707, 'Operator Supplier Generator', 0, 'direct', 'Const. Equipment Operator (RENTAL)', 'Others', 'Generator', 'Skilled', 'D', 'E', '1', '1', '4'),
(708, 'Operator Supplier Folk Lift', 0, 'direct', 'Const. Equipment Operator (RENTAL)', 'Others', 'Folk Lift', 'Skilled', 'D', 'E', '1', '1', '5'),
(709, 'Operator Supplier Trailer', 0, 'direct', 'Const. Equipment Operator (RENTAL)', 'Others', 'Trailer', 'Skilled', 'D', 'E', '1', '1', '6'),
(710, 'Operator Supplier Heavy Duty Truck', 0, 'direct', 'Const. Equipment Operator (RENTAL)', 'Others', 'Heavy Duty Truck', 'Skilled', 'D', 'E', '1', '1', '7'),
(711, 'Operator Supplier Light Duty Truck', 0, 'direct', 'Const. Equipment Operator (RENTAL)', 'Others', 'Light Duty Truck', 'Skilled', 'D', 'E', '1', '1', '8'),
(712, 'Operator Supplier Lifting System', 0, 'direct', 'Const. Equipment Operator (RENTAL)', 'Lifting System', NULL, 'Skilled', 'D', 'E', '1', '1', '9'),
(713, 'Operator Assistant (Helper) [Supplier]', 0, 'direct', 'Const. Equipment Operator (RENTAL)', 'Operator Assistant (Helper)', NULL, 'Helper', 'D', 'E', '1', 'H', '0'),
(714, 'Helper Common', 0, 'direct', 'Helper', 'Common', NULL, 'Helper', 'D', 'H', 'C', '0', '1'),
(715, 'Helper Civil', 0, 'direct', 'Helper', 'Civil', NULL, 'Helper', 'D', 'H', 'C', '0', '2'),
(716, 'Helper Architecture', 0, 'direct', 'Helper', 'Architecture', NULL, 'Helper', 'D', 'H', 'A', '0', '1'),
(717, 'Helper HVAC', 0, 'direct', 'Helper', 'HVAC', NULL, 'Helper', 'D', 'H', 'H', '0', '1'),
(718, 'Helper Tank', 0, 'direct', 'Helper', 'Tank', NULL, 'Helper', 'D', 'H', 'T', '0', '1'),
(719, 'Helper Steel Structure', 0, 'direct', 'Helper', 'Steel Structure', NULL, 'Helper', 'D', 'H', 'S', '0', '1'),
(720, 'Helper Mech. Equipment', 0, 'direct', 'Helper', 'Mech. Equipment', NULL, 'Helper', 'D', 'H', 'M', '0', '1'),
(721, 'Helper Piping', 0, 'direct', 'Helper', 'Piping', NULL, 'Helper', 'D', 'H', 'P', '0', '1'),
(722, 'Helper Piping Welding', 0, 'direct', 'Helper', 'Piping Welding', NULL, 'Helper', 'D', 'H', 'P', '0', '2'),
(723, 'Helper Piping Fitting', 0, 'direct', 'Helper', 'Piping Fitting', NULL, 'Helper', 'D', 'H', 'P', '0', '3'),
(724, 'Helper Piping Support', 0, 'direct', 'Helper', 'Piping Support', NULL, 'Helper', 'D', 'H', 'P', '0', '4'),
(725, 'Helper Painting', 0, 'direct', 'Helper', 'Painting', NULL, 'Helper', 'D', 'H', 'P', '0', '5'),
(726, 'Helper Insulation', 0, 'direct', 'Helper', 'Insulation', NULL, 'Helper', 'D', 'H', 'P', '0', '6'),
(727, 'Helper Firefighting', 0, 'direct', 'Helper', 'Firefighting', NULL, 'Helper', 'D', 'H', 'P', '0', '7'),
(728, 'Helper Electrical', 0, 'direct', 'Helper', 'Electrical', NULL, 'Helper', 'D', 'H', 'E', '0', '1'),
(729, 'Helper Instrument', 0, 'direct', 'Helper', 'Instrument', NULL, 'Helper', 'D', 'H', 'I', '0', '1'),
(730, 'Helper Rigging', 0, 'direct', 'Helper', 'Rigging', NULL, 'Helper', 'D', 'H', 'Z', '0', '1'),
(731, 'Helper Scaffolding', 0, 'direct', 'Helper', 'Scaffolding', NULL, 'Helper', 'D', 'H', 'Z', '0', '2'),
(732, 'Helper Commissioning', 0, 'direct', 'Helper', 'Commissioning', NULL, 'Helper', 'D', 'H', 'Z', '0', '3'),
(733, 'Others Direct Labor', 0, 'direct', 'Others', 'Direct Labor', NULL, 'Helper', 'D', 'H', 'C', '0', '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `_id` int NOT NULL,
  `nik` bigint DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `posisi` int NOT NULL,
  `candidate_status` enum('Candidate','Pre-selected','Interview','Employee') NOT NULL DEFAULT 'Candidate',
  `alamat` longtext NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '$2y$04$R8vOyZhkTaKbcv9WKUwlnOPCo.9ubE1HPwbbX8fsq2DWJol7V3BZC',
  `is_aktif` enum('0','1') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `no_hp` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL DEFAULT '-',
  `marital` varchar(30) NOT NULL,
  `npwp` varchar(30) NOT NULL DEFAULT '-',
  `bpjs_ks` varchar(30) NOT NULL DEFAULT '-',
  `bpjs_kt` varchar(30) NOT NULL DEFAULT '-',
  `path_foto` varchar(255) NOT NULL,
  `employee-id` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '-',
  `superior_id` varchar(30) NOT NULL DEFAULT '0',
  `applying_occupation` varchar(255) NOT NULL,
  `desired_salary` varchar(255) NOT NULL,
  `current_address` longtext NOT NULL,
  `deleted` int NOT NULL DEFAULT '0',
  `summary_age_years` int DEFAULT NULL,
  `summary_age_months` int DEFAULT NULL,
  `summary_career_years` int DEFAULT NULL,
  `summary_career_months` int DEFAULT NULL,
  `religion` varchar(100) NOT NULL,
  `summary_discipline` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `summary_class_grade` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`_id`, `nik`, `nama`, `jk`, `tempat_lahir`, `tgl_lahir`, `posisi`, `candidate_status`, `alamat`, `password`, `is_aktif`, `created_at`, `no_hp`, `email`, `marital`, `npwp`, `bpjs_ks`, `bpjs_kt`, `path_foto`, `employee-id`, `superior_id`, `applying_occupation`, `desired_salary`, `current_address`, `deleted`, `summary_age_years`, `summary_age_months`, `summary_career_years`, `summary_career_months`, `religion`, `summary_discipline`, `summary_class_grade`) VALUES
(14, 1, 'LUTFI WIJAYA', 'L', 'Serang', '2024-09-07', 1, 'Candidate', 'Kp. Babakan Sompok RT 11 RW 05', '$2y$04$R8vOyZhkTaKbcv9WKUwlnOPCo.9ubE1HPwbbX8fsq2DWJol7V3BZC', '1', '2024-09-07 03:01:57', '082248951236', 'lutfiwijhaya@gmail.com', 'K', '', '', '', 'https://achivon.app/uploads/Lutfi.png ', 'h-000023', '0', '', '', '', 0, NULL, NULL, NULL, NULL, '', '', ''),
(17, 2, 'admin', 'L', 'admin', '2024-11-22', 12, 'Candidate', 'admin', '$2y$04$kOOsE6sK6H22GEhhJuR.TOidO6sUZEJe16N0iq77BzOl/B7BWvljq', '1', '2024-11-22 04:08:48', '0822', '', 'Tidak Kawin', '', '', '', 'https://achivon.app/uploads/icon-admin-128.png', 'admin', '0', '', '', '', 0, NULL, NULL, NULL, NULL, '', '', ''),
(18, 3, 'Guest', 'L', 'Guset', '2024-11-22', 13, 'Candidate', 'Guest', '$2y$04$gOXEWERXen2HgbsFiU6TtukDVwRHYfCnlZ0AwYDVcPrSYTFJ/6G5S', '1', '2024-11-22 04:13:21', '08', '', 'Tidak Kawin', '', '', '', 'https://achivon.app/uploads/guest-128.png', 'guest', '0', '', '', '', 0, NULL, NULL, NULL, NULL, '', '', ''),
(19, 4, 'Guest', 'L', 'guest', '2024-12-21', 14, 'Candidate', 'guest', '$2y$04$Yrp3P.KITHoLlNq8cuOEKeTqsizkAMwBRrMQZ2wv4VOne1hjmDNHa', '1', '2024-12-21 04:19:47', '123123123', '', 'Kawin', '', '', '', 'https://achivon.app/uploads/guest-128.png', 'guest01', '0', '', '', '', 0, NULL, NULL, NULL, NULL, '', '', ''),
(20, 5, 'Jong Ky Ahn', 'L', 'Seoul', '1966-10-08', 15, 'Candidate', 'Jakarta', '$2y$04$uZcQ1R6afheZJ8Ka2qIAZuNbkDIz9JCfYLuo9EDtNuqBcoxoCcSru', '1', '2025-03-11 10:03:31', '-', 'justinahn@achivon.co.id', 'Kawin', '', '', '', 'https://achivon.app/uploads/Screenshot_2025-03-11_170314.png', 'H-000001', '0', '', '', '', 0, 58, 10, 0, 0, '', '', ''),
(21, 6, 'Oh Chin Phang', 'L', 'Perak', '1986-08-18', 15, 'Candidate', 'Malaysia', '$2y$04$Pc5irCPg0g372ktppGbEi.nWqoh2gEYmJDOGSl9UuT3hW4Wv9H6sa', '1', '2025-03-11 10:09:39', '-', 'cpoh@achivon.co.id', 'Kawin', '', '', '', 'https://achivon.app/uploads/Screenshot_2025-03-11_170504.png', 'H-000002', '0', '', '', '', 0, 38, 12, 0, 0, '', '', ''),
(22, 7, 'Lee Byung Sam', 'L', 'Korea', '2025-03-11', 15, 'Candidate', 'Jakarta', '$2y$04$NhQ6FozbR5GdFyb1PRjoaOpiDVa2amukYINlfUbidll6Q5klqqj4G', '1', '2025-03-11 10:12:07', '-', 'bslee@achivon.co.id ', 'Kawin', '', '', '', 'https://achivon.app/uploads/Screenshot_2025-03-11_170525.png', 'H-000003', '0', '', '', '', 0, 0, 5, 0, 0, '', '', ''),
(23, 8, 'Ilham Kelana', 'L', 'PLAJU', '1982-01-09', 5, 'Candidate', 'PERUM BUKIT CILEGON ASRI BLOK NH NO.21', '$2y$04$Pc5irCPg0g372ktppGbEi.nWqoh2gEYmJDOGSl9UuT3hW4Wv9H6sa', '1', '2025-03-11 10:23:27', '082210470237', 'ilham.kelana@achivon.co.id', 'Kawin', '680516267417000', '', '', 'https://achivon.app/uploads/Screenshot_2025-03-11_172311.png', 'H-0-230011', '0', '', '', '', 0, 43, 7, 0, 0, '', '', ''),
(170, 233, 'ajijiii', 'L', 'jakaartaaa', '2002-01-29', 6, 'Candidate', 'jakarrtaa bisa maju', '$2y$04$R8vOyZhkTaKbcv9WKUwlnOPCo.9ubE1HPwbbX8fsq2DWJol7V3BZC', '0', '2025-07-22 03:43:02', '08439932434', 'admin123@gmail.com', 'Single', '', '-', '', 'e27a0f28d42bbcd6e7b8c09a801c27e7.jpg', '-', '0', '', '123222', 'jakarrtaa bisa maju', 1, 23, 6, 2, 3, 'islam', 'baik', 'rajin'),
(176, 343331232123, 'ilham', 'L', 'jakaartaaa', '1998-02-04', 10, 'Candidate', 'jakarrtaa bisa maju', '$2y$04$R8vOyZhkTaKbcv9WKUwlnOPCo.9ubE1HPwbbX8fsq2DWJol7V3BZC', '1', '2025-07-22 10:26:06', '0843993224', 'admin4@gmail.com', 'Single', '', '-', '', '9f43ede74080334ab1fb9e62f7d7d946.jpg', '-', '0', 'NGELAS', '123324', 'jakarrtaa bisa maju', 0, 27, 5, 20, 3, 'islam', 'sehat', 'rajin'),
(179, 172374436383, 'Amar Maruf', 'L', '', '2004-09-14', 16, 'Candidate', 'jakarrtaa ', '$2y$04$R8vOyZhkTaKbcv9WKUwlnOPCo.9ubE1HPwbbX8fsq2DWJol7V3BZC', '1', '2025-07-25 03:13:11', '8439932492', 'candidate@gmail.com', 'Single', '', '-', '', 'aeee958898636e8bd51f96a8917123b1.jpg', '-', '0', 'bawa bawa barang', '560000', '   jakarrtaa    ', 0, NULL, NULL, NULL, NULL, 'Islam', '', ''),
(185, 192300931051003, 'Abni Basit', 'L', 'pandeglang', '2005-01-06', 6, 'Employee', 'jalan udayana', '$2y$04$R8vOyZhkTaKbcv9WKUwlnOPCo.9ubE1HPwbbX8fsq2DWJol7V3BZC', '1', '2025-08-01 08:33:16', '8439932492', 'candidate@gmail.com', 'Single', '', '-', '', '62b19b3080afcf00a40ead688547a709.jpg', '-', '0', 'masang besi ', '2600000', 'jalan udayana', 0, 20, 7, 6, 2, 'islam', 'sangat amat disciplin', 'Masuk Pagi'),
(234, 1923486730293485, 'aji', 'L', 'DKI JAKARTA', '1999-12-27', 16, 'Interview', 'jakarrtaa bisa maju\r\n', '$2y$04$R8vOyZhkTaKbcv9WKUwlnOPCo.9ubE1HPwbbX8fsq2DWJol7V3BZC', '1', '2025-08-12 10:18:27', '0895331054946', 'admin@gmail.com', 'Single', '1923849548357485', '17264452673846', '0983746573847261', 'a38f4754c9d43e0c6a6731e999926225.png', '-', '0', 'Akuntan', '5500000', '  jakarrtaa bisa maju\r\n  ', 0, NULL, NULL, NULL, NULL, 'Islam', '', ''),
(249, 1923847538291845, 'windah', 'L', 'ACEH', '2001-06-05', 16, 'Pre-selected', 'jakarrtaa bisa maju', '$2y$04$R8vOyZhkTaKbcv9WKUwlnOPCo.9ubE1HPwbbX8fsq2DWJol7V3BZC', '0', '2025-08-25 07:12:47', '0812345839231', 'candidate@gmail.com', 'Single', '012345678910000', '0001234567890', '1234567890002', '10694efd1af6cf98905133e1b0f3ef7f.png', '-', '0', 'nyatetin absen', '5000000', '  jakarrtaa bisa maju  ', 0, NULL, NULL, NULL, NULL, 'Islam', '', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `params`
--
ALTER TABLE `params`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_levels`
--
ALTER TABLE `tbl_levels`
  ADD PRIMARY KEY (`_id`);

--
-- Indeks untuk tabel `tbl_menus`
--
ALTER TABLE `tbl_menus`
  ADD PRIMARY KEY (`_id`);

--
-- Indeks untuk tabel `tbl_posisi`
--
ALTER TABLE `tbl_posisi`
  ADD PRIMARY KEY (`_id`),
  ADD UNIQUE KEY `posisi` (`posisi`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`_id`),
  ADD UNIQUE KEY `nik` (`nik`),
  ADD KEY `posisi` (`posisi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `params`
--
ALTER TABLE `params`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT untuk tabel `tbl_levels`
--
ALTER TABLE `tbl_levels`
  MODIFY `_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=218;

--
-- AUTO_INCREMENT untuk tabel `tbl_menus`
--
ALTER TABLE `tbl_menus`
  MODIFY `_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT untuk tabel `tbl_posisi`
--
ALTER TABLE `tbl_posisi`
  MODIFY `_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=734;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD CONSTRAINT `tbl_user_ibfk_1` FOREIGN KEY (`posisi`) REFERENCES `tbl_posisi` (`_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
