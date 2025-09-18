-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 24 Jun 2025 pada 12.23
-- Versi server: 10.11.10-MariaDB
-- Versi PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u646404504_acv_app`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `accounting_bank`
--

CREATE TABLE `accounting_bank` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `account_bank` varchar(255) NOT NULL,
  `balance` decimal(65,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `accounting_bank`
--

INSERT INTO `accounting_bank` (`id`, `name`, `account_bank`, `balance`) VALUES
(1, 'MANDIRI', '0', 1320000),
(2, 'CASH', '0', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `accounting_daily_report`
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
-- Dumping data untuk tabel `accounting_daily_report`
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
-- Struktur dari tabel `accounting_daily_report_balance`
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
-- Dumping data untuk tabel `accounting_daily_report_balance`
--

INSERT INTO `accounting_daily_report_balance` (`id`, `id_dr`, `id_bank`, `start_balance`, `end_balance`, `create_at`) VALUES
(13, 18, '1', 120, 120, '2025-02-27 03:25:28'),
(14, 18, '2', 0, 0, '2025-02-27 03:25:28'),
(15, 19, '1', 120, 120, '2025-02-27 03:27:03'),
(16, 19, '2', 0, 0, '2025-02-27 03:27:03'),
(17, 20, '1', 120, 243, '2025-02-27 03:27:54'),
(18, 20, '2', 0, 0, '2025-02-27 03:27:54'),
(19, 21, '1', 120, 1, '2025-02-27 03:33:30'),
(20, 21, '2', 0, 0, '2025-02-27 03:33:30'),
(21, 22, '1', 120, 143, '2025-02-27 03:35:30'),
(22, 22, '2', 0, 0, '2025-02-27 03:35:30'),
(23, 23, '1', 120, 243, '2025-02-27 03:37:13'),
(24, 23, '2', 0, 0, '2025-02-27 03:37:13'),
(25, 24, '1', 120, 243, '2025-02-27 03:40:32'),
(26, 24, '2', 0, 0, '2025-02-27 03:40:32'),
(27, 25, '1', 120, 121, '2025-02-27 03:41:24'),
(28, 25, '2', 0, 0, '2025-02-27 03:41:24'),
(29, 26, '1', 120000, 120023, '2025-02-27 03:47:42'),
(30, 26, '2', 0, 0, '2025-02-27 03:47:42'),
(31, 27, '1', 120000, 120123, '2025-02-27 08:07:31'),
(32, 27, '2', 0, 0, '2025-02-27 08:07:31'),
(33, 28, '1', 120000, 1320000, '2025-02-27 08:18:27'),
(34, 28, '2', 0, 0, '2025-02-27 08:18:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `accounting_daily_report_transaction`
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
-- Dumping data untuk tabel `accounting_daily_report_transaction`
--

INSERT INTO `accounting_daily_report_transaction` (`id`, `id_dr`, `transaction_desc`, `in-out`, `id_bank`, `amount`, `remark`, `create_at`, `file`) VALUES
(14, '18', '123', 'In', '1', 123, '123', '2025-02-27 03:25:28', './AccountingFiles/Invoice/1740601528_Laporan_Voucher_20250225.pdf'),
(15, '19', '123', 'In', '1', 123, '123', '2025-02-27 03:27:03', './AccountingFiles/Invoice/1740601623_IMG-20250121-WA0021 - Fathur Ramdhany.jpg'),
(16, '20', '12123', 'In', '1', 123123, '123123', '2025-02-27 03:27:54', './AccountingFiles/Invoice/1740601674_25022025123522.pdf'),
(17, '21', '123', 'In', '1', 1111451, '123', '2025-02-27 03:33:30', './AccountingFiles/Invoice/1740602010_25022025123522.pdf'),
(18, '22', '123', 'In', '1', 23123, '123123', '2025-02-27 03:35:30', './AccountingFiles/Invoice/1740602130_IMG-20250121-WA0021 - Fathur Ramdhany.jpg'),
(19, '23', '123', 'In', '1', 123123, '123', '2025-02-27 03:37:13', './AccountingFiles/Invoice/1740602233_knan.png'),
(20, '24', '123', 'In', '1', 123123, '123', '2025-02-27 03:40:32', './AccountingFiles/Invoice/1740602432_knan.png'),
(21, '25', 'ewqwe', 'In', '1', 1212, '123', '2025-02-27 03:41:24', './AccountingFiles/Invoice/1740602484_knan.png'),
(22, '26', 'qweqwe', 'In', '1', 23, '123', '2025-02-27 03:47:42', './AccountingFiles/Invoice/1740602862_IMG-20250121-WA0021 - Fathur Ramdhany.jpg'),
(23, '27', '123', 'In', '1', 123, '123', '2025-02-27 08:07:31', './AccountingFiles/Invoice/1740618451_IMG-20250121-WA0021 - Fathur Ramdhany.jpg'),
(24, '28', 'qweqwe', 'In', '1', 1200000, 'Remark', '2025-02-27 08:18:27', './AccountingFiles/Invoice/1740619107_Laporan_Voucher_20250225.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `accounting_voucher`
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
-- Dumping data untuk tabel `accounting_voucher`
--

INSERT INTO `accounting_voucher` (`id`, `no_doc`, `account`, `incharge`, `date`, `recipient`, `recipient_bank`, `bank_account`, `due_date`, `status`) VALUES
(26, '1', '1', 'LUTFI WIJAYA', '2025-02-19', 'Lutfi', '1', 0, '2025-02-19', 0),
(27, '2', '2', 'LUTFI WIJAYA', '2025-02-20', '2', '2', 2, '2025-02-20', 1),
(28, '323', '23123', 'LUTFI WIJAYA', '2025-02-26', 'wer', '123', 0, '2025-02-26', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `accounting_voucher_spec`
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
-- Dumping data untuk tabel `accounting_voucher_spec`
--

INSERT INTO `accounting_voucher_spec` (`id`, `voucher_id`, `spec`, `qty`, `price`, `amount`, `invoice`) VALUES
(16, 26, 'PEMBAYARAN STNK', 1, 2216000, 2216000, 'http://localhost/cka-pot-master/AccountingFiles/Invoice/1_1.pdf'),
(17, 27, '2', 2, 2, 4, 'http://localhost/cka-pot-master/AccountingFiles/Invoice/2_1.pdf'),
(18, 28, '12', 2, 123123, 246246, 'http://localhost/cka-pot-master/AccountingFiles/Invoice/323_1.pdf'),
(19, 28, '3333', 5, 3123, 15615, 'http://localhost/cka-pot-master/AccountingFiles/Invoice/323_2.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dr_akses`
--

CREATE TABLE `dr_akses` (
  `id` int(255) NOT NULL,
  `id_user` int(255) NOT NULL,
  `table_name` varchar(255) NOT NULL,
  `id_table` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dr_akses`
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
-- Struktur dari tabel `dr_file`
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
  `id_table` int(255) NOT NULL,
  `is_aktiv` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `dr_file`
--

INSERT INTO `dr_file` (`id`, `id_user`, `subject`, `name_file`, `upload_date`, `size`, `type_file`, `link`, `remark`, `table_name`, `id_table`, `is_aktiv`) VALUES
(26, 23, '', '20250326161737_Structure_Material_List_Summary_(20250324).xlsx', '2025-03-26 09:17:37', '1625.57', 'Excel Document', 'https://achivon.app/dr_files/20250326161737_Structure_Material_List_Summary_%2820250324%29.xlsx', '', 'sd_ho_lv3', 245, 0),
(27, 23, '', '20250327085023_Structure_Material_List_Summary_(20250327).xlsx', '2025-03-27 01:50:23', '1664.45', 'Excel Document', 'https://achivon.app/dr_files/20250327085023_Structure_Material_List_Summary_%2820250327%29.xlsx', '', 'sd_ho_lv3', 245, 0),
(28, 23, '', '20250327085246_Civil_Material_List_Summary_(20250328).xlsx', '2025-03-27 01:52:46', '60.84', 'Excel Document', 'https://achivon.app/dr_files/20250327085246_Civil_Material_List_Summary_%2820250328%29.xlsx', '', 'sd_ho_lv3', 246, 0),
(29, 23, '', '20250327085435_Piping_Material_List_Summary_(20250328).xlsx', '2025-03-27 11:08:46', '4813.43', 'Excel Document', 'https://achivon.app/dr_files/20250327085435_Piping_Material_List_Summary_%2820250328%29.xlsx', '', 'sd_ho_lv3', 247, 1),
(30, 23, '', '20250327085637_1-2000.DWG', '2025-03-28 01:24:11', '82.78', 'AutoCAD File', 'https://achivon.app/dr_files/20250327085637_1-2000.DWG', '', 'sd_ho_lv4', 86, 1),
(31, 23, '', '20250327085647_1-2100.DWG', '2025-03-28 01:24:13', '461.1', 'AutoCAD File', 'https://achivon.app/dr_files/20250327085647_1-2100.DWG', '', 'sd_ho_lv4', 86, 1),
(32, 23, '', '20250327085655_1-2101.DWG', '2025-03-28 01:24:20', '359.7', 'AutoCAD File', 'https://achivon.app/dr_files/20250327085655_1-2101.DWG', '', 'sd_ho_lv4', 86, 1),
(33, 23, '', '20250327085708_1-2103.DWG', '2025-03-28 01:24:22', '157.25', 'AutoCAD File', 'https://achivon.app/dr_files/20250327085708_1-2103.DWG', '', 'sd_ho_lv4', 86, 1),
(34, 23, '', '20250327085719_1-2104.DWG', '2025-03-28 01:24:25', '151.81', 'AutoCAD File', 'https://achivon.app/dr_files/20250327085719_1-2104.DWG', '', 'sd_ho_lv4', 86, 1),
(35, 23, '', '20250327085735_1-2105.DWG', '2025-03-28 01:24:28', '158.29', 'AutoCAD File', 'https://achivon.app/dr_files/20250327085735_1-2105.DWG', '', 'sd_ho_lv4', 86, 1),
(36, 23, '', '20250327085905_Civil_Drawing.pdf', '2025-03-27 01:59:05', '26607.43', 'PDF Document', 'https://achivon.app/dr_files/20250327085905_Civil_Drawing.pdf', '', 'sd_ho_lv4', 87, 0),
(37, 23, '', '20250327090007_1-2106.DWG', '2025-03-28 01:24:31', '139.39', 'AutoCAD File', 'https://achivon.app/dr_files/20250327090007_1-2106.DWG', '', 'sd_ho_lv4', 86, 1),
(38, 23, '', '20250327090016_1-2107.DWG', '2025-03-28 01:24:33', '99.11', 'AutoCAD File', 'https://achivon.app/dr_files/20250327090016_1-2107.DWG', '', 'sd_ho_lv4', 86, 1),
(39, 23, '', '20250327090027_1-2110.DWG', '2025-03-28 01:24:35', '240.55', 'AutoCAD File', 'https://achivon.app/dr_files/20250327090027_1-2110.DWG', '', 'sd_ho_lv4', 86, 1),
(40, 23, '', '20250327090054_2-2200.DWG', '2025-03-28 01:24:38', '108.11', 'AutoCAD File', 'https://achivon.app/dr_files/20250327090054_2-2200.DWG', '', 'sd_ho_lv4', 86, 1),
(41, 23, '', '20250327090112_2-2201.DWG', '2025-03-28 01:24:40', '397.66', 'AutoCAD File', 'https://achivon.app/dr_files/20250327090112_2-2201.DWG', '', 'sd_ho_lv4', 86, 1),
(42, 23, '', '20250327090122_2-2202.DWG', '2025-03-28 01:24:42', '364.65', 'AutoCAD File', 'https://achivon.app/dr_files/20250327090122_2-2202.DWG', '', 'sd_ho_lv4', 86, 1),
(43, 23, '', '20250327090136_2-2203.DWG', '2025-03-28 01:24:44', '218.21', 'AutoCAD File', 'https://achivon.app/dr_files/20250327090136_2-2203.DWG', '', 'sd_ho_lv4', 86, 1),
(44, 23, '', '20250327090156_2-2204.DWG', '2025-03-28 01:24:46', '252.19', 'AutoCAD File', 'https://achivon.app/dr_files/20250327090156_2-2204.DWG', '', 'sd_ho_lv4', 86, 1),
(45, 23, '', '20250327090207_2-2205.DWG', '2025-03-28 01:24:49', '124.23', 'AutoCAD File', 'https://achivon.app/dr_files/20250327090207_2-2205.DWG', '', 'sd_ho_lv4', 86, 1),
(46, 23, '', '20250327090225_2-2207.DWG', '2025-03-28 01:24:51', '97.36', 'AutoCAD File', 'https://achivon.app/dr_files/20250327090225_2-2207.DWG', '', 'sd_ho_lv4', 86, 1),
(47, 23, '', '20250327090254_2-2206.DWG', '2025-03-28 01:24:54', '188.07', 'AutoCAD File', 'https://achivon.app/dr_files/20250327090254_2-2206.DWG', '', 'sd_ho_lv4', 86, 1),
(48, 23, '', '20250327090309_2-2208.DWG', '2025-03-28 01:24:59', '147.8', 'AutoCAD File', 'https://achivon.app/dr_files/20250327090309_2-2208.DWG', '', 'sd_ho_lv4', 86, 1),
(49, 23, '', '20250327090323_2-2209.DWG', '2025-03-28 01:25:01', '149.97', 'AutoCAD File', 'https://achivon.app/dr_files/20250327090323_2-2209.DWG', '', 'sd_ho_lv4', 86, 1),
(50, 23, '', '20250327090438_1-2000.DWG', '2025-03-27 02:04:38', '82.78', 'AutoCAD File', 'https://achivon.app/dr_files/20250327090438_1-2000.DWG', '', 'sd_ho_lv5', 64, 0),
(51, 23, '', '20250327090447_1-2100.DWG', '2025-03-27 02:04:47', '461.1', 'AutoCAD File', 'https://achivon.app/dr_files/20250327090447_1-2100.DWG', '', 'sd_ho_lv5', 64, 0),
(52, 23, '', '20250327090456_1-2101.DWG', '2025-03-27 02:04:56', '359.7', 'AutoCAD File', 'https://achivon.app/dr_files/20250327090456_1-2101.DWG', '', 'sd_ho_lv5', 64, 0),
(53, 23, '', '20250327090512_1-2103.DWG', '2025-03-27 02:05:12', '157.25', 'AutoCAD File', 'https://achivon.app/dr_files/20250327090512_1-2103.DWG', '', 'sd_ho_lv5', 64, 0),
(54, 23, '', '20250327090521_1-2104.DWG', '2025-03-27 02:05:21', '151.81', 'AutoCAD File', 'https://achivon.app/dr_files/20250327090521_1-2104.DWG', '', 'sd_ho_lv5', 64, 0),
(55, 23, '', '20250327090532_1-2105.DWG', '2025-03-27 02:05:32', '158.29', 'AutoCAD File', 'https://achivon.app/dr_files/20250327090532_1-2105.DWG', '', 'sd_ho_lv5', 64, 0),
(56, 23, '', '20250327090541_1-2106.DWG', '2025-03-27 02:05:41', '139.39', 'AutoCAD File', 'https://achivon.app/dr_files/20250327090541_1-2106.DWG', '', 'sd_ho_lv5', 64, 0),
(57, 23, '', '20250327090552_1-2107.DWG', '2025-03-27 02:05:52', '99.11', 'AutoCAD File', 'https://achivon.app/dr_files/20250327090552_1-2107.DWG', '', 'sd_ho_lv5', 64, 0),
(58, 23, '', '20250327090604_1-2110.DWG', '2025-03-27 02:06:04', '240.55', 'AutoCAD File', 'https://achivon.app/dr_files/20250327090604_1-2110.DWG', '', 'sd_ho_lv5', 64, 0),
(59, 23, '', '20250327090945_2-2200.DWG', '2025-03-27 02:09:45', '108.11', 'AutoCAD File', 'https://achivon.app/dr_files/20250327090945_2-2200.DWG', '', 'sd_ho_lv5', 66, 0),
(60, 23, '', '20250327090954_2-2201.DWG', '2025-03-27 02:09:54', '397.66', 'AutoCAD File', 'https://achivon.app/dr_files/20250327090954_2-2201.DWG', '', 'sd_ho_lv5', 66, 0),
(61, 23, '', '20250327091002_2-2203.DWG', '2025-03-27 02:10:02', '218.21', 'AutoCAD File', 'https://achivon.app/dr_files/20250327091002_2-2203.DWG', '', 'sd_ho_lv5', 66, 0),
(62, 23, '', '20250327091017_2-2204.DWG', '2025-03-27 02:10:17', '252.19', 'AutoCAD File', 'https://achivon.app/dr_files/20250327091017_2-2204.DWG', '', 'sd_ho_lv5', 66, 0),
(63, 23, '', '20250327091025_2-2205.DWG', '2025-03-27 02:10:25', '124.23', 'AutoCAD File', 'https://achivon.app/dr_files/20250327091025_2-2205.DWG', '', 'sd_ho_lv5', 66, 0),
(64, 23, '', '20250327091048_2-2206.DWG', '2025-03-27 02:10:48', '188.07', 'AutoCAD File', 'https://achivon.app/dr_files/20250327091048_2-2206.DWG', '', 'sd_ho_lv5', 66, 0),
(65, 23, '', '20250327091059_2-2207.DWG', '2025-03-27 02:10:59', '97.36', 'AutoCAD File', 'https://achivon.app/dr_files/20250327091059_2-2207.DWG', '', 'sd_ho_lv5', 66, 0),
(66, 23, '', '20250327091110_2-2208.DWG', '2025-03-27 02:11:10', '147.8', 'AutoCAD File', 'https://achivon.app/dr_files/20250327091110_2-2208.DWG', '', 'sd_ho_lv5', 66, 0),
(67, 23, '', '20250327091118_2-2209.DWG', '2025-03-27 02:11:18', '149.97', 'AutoCAD File', 'https://achivon.app/dr_files/20250327091118_2-2209.DWG', '', 'sd_ho_lv5', 66, 0),
(68, 23, '', '20250327091133_2-2210.DWG', '2025-03-27 02:11:33', '192.27', 'AutoCAD File', 'https://achivon.app/dr_files/20250327091133_2-2210.DWG', '', 'sd_ho_lv5', 66, 0),
(69, 23, '', '20250327091146_2-2211.DWG', '2025-03-27 02:11:46', '216.41', 'AutoCAD File', 'https://achivon.app/dr_files/20250327091146_2-2211.DWG', '', 'sd_ho_lv5', 66, 0),
(70, 23, '', '20250327091159_2-2212.DWG', '2025-03-27 02:11:59', '178.29', 'AutoCAD File', 'https://achivon.app/dr_files/20250327091159_2-2212.DWG', '', 'sd_ho_lv5', 66, 0),
(71, 23, '', '20250327091217_2-2213.DWG', '2025-03-27 02:12:17', '117.13', 'AutoCAD File', 'https://achivon.app/dr_files/20250327091217_2-2213.DWG', '', 'sd_ho_lv5', 66, 0),
(72, 23, '', '20250327091228_2-2214.DWG', '2025-03-27 02:12:28', '132.46', 'AutoCAD File', 'https://achivon.app/dr_files/20250327091228_2-2214.DWG', '', 'sd_ho_lv5', 66, 0),
(73, 23, '', '20250327091240_2-2215.DWG', '2025-03-27 02:12:40', '180.6', 'AutoCAD File', 'https://achivon.app/dr_files/20250327091240_2-2215.DWG', '', 'sd_ho_lv5', 66, 0),
(74, 23, '', '20250327091306_2-2216.DWG', '2025-03-27 02:13:06', '142.84', 'AutoCAD File', 'https://achivon.app/dr_files/20250327091306_2-2216.DWG', '', 'sd_ho_lv5', 66, 0),
(75, 23, '', '20250327091321_2-2217.DWG', '2025-03-27 02:13:21', '304.93', 'AutoCAD File', 'https://achivon.app/dr_files/20250327091321_2-2217.DWG', '', 'sd_ho_lv5', 66, 0),
(76, 23, '', '20250327091336_2-2218.DWG', '2025-03-27 02:13:36', '163.13', 'AutoCAD File', 'https://achivon.app/dr_files/20250327091336_2-2218.DWG', '', 'sd_ho_lv5', 66, 0),
(77, 23, '', '20250327091351_2-2219.DWG', '2025-03-27 02:13:51', '111.79', 'AutoCAD File', 'https://achivon.app/dr_files/20250327091351_2-2219.DWG', '', 'sd_ho_lv5', 66, 0),
(78, 23, '', '20250327091502_2-2220.DWG', '2025-03-27 02:15:02', '89.26', 'AutoCAD File', 'https://achivon.app/dr_files/20250327091502_2-2220.DWG', '', 'sd_ho_lv5', 66, 0),
(79, 23, '', '20250327091509_2-2221.DWG', '2025-03-27 02:15:09', '233.06', 'AutoCAD File', 'https://achivon.app/dr_files/20250327091509_2-2221.DWG', '', 'sd_ho_lv5', 66, 0),
(80, 23, '', '20250327091519_2-2222.DWG', '2025-03-27 02:15:19', '137.9', 'AutoCAD File', 'https://achivon.app/dr_files/20250327091519_2-2222.DWG', '', 'sd_ho_lv5', 66, 0),
(81, 23, '', '20250327091535_2-2224.DWG', '2025-03-27 02:15:35', '215.21', 'AutoCAD File', 'https://achivon.app/dr_files/20250327091535_2-2224.DWG', '', 'sd_ho_lv5', 66, 0),
(82, 23, '', '20250327091547_2-2225.DWG', '2025-03-27 02:15:47', '247.25', 'AutoCAD File', 'https://achivon.app/dr_files/20250327091547_2-2225.DWG', '', 'sd_ho_lv5', 66, 0),
(83, 23, '', '20250327091726_2-2226.DWG', '2025-03-27 02:17:26', '453.06', 'AutoCAD File', 'https://achivon.app/dr_files/20250327091726_2-2226.DWG', '', 'sd_ho_lv5', 66, 0),
(84, 23, '', '20250327091735_2-2227.DWG', '2025-03-27 02:17:35', '296.06', 'AutoCAD File', 'https://achivon.app/dr_files/20250327091735_2-2227.DWG', '', 'sd_ho_lv5', 66, 0),
(85, 23, '', '20250327091751_2-2228.DWG', '2025-03-27 02:17:51', '202.97', 'AutoCAD File', 'https://achivon.app/dr_files/20250327091751_2-2228.DWG', '', 'sd_ho_lv5', 66, 0),
(86, 23, '', '20250327091801_2-2229.DWG', '2025-03-27 02:18:01', '160.81', 'AutoCAD File', 'https://achivon.app/dr_files/20250327091801_2-2229.DWG', '', 'sd_ho_lv5', 66, 0),
(87, 23, '', '20250327091811_2-2230.DWG', '2025-03-27 02:18:11', '273.3', 'AutoCAD File', 'https://achivon.app/dr_files/20250327091811_2-2230.DWG', '', 'sd_ho_lv5', 66, 0),
(88, 23, '', '20250327092024_3-3305.DWG', '2025-03-27 02:20:24', '188.36', 'AutoCAD File', 'https://achivon.app/dr_files/20250327092024_3-3305.DWG', '', 'sd_ho_lv5', 67, 0),
(89, 23, '', '20250327092042_3-2301.DWG', '2025-03-27 02:20:42', '413.18', 'AutoCAD File', 'https://achivon.app/dr_files/20250327092042_3-2301.DWG', '', 'sd_ho_lv5', 67, 0),
(90, 23, '', '20250327092059_3-2302.DWG', '2025-03-27 02:20:59', '447.76', 'AutoCAD File', 'https://achivon.app/dr_files/20250327092059_3-2302.DWG', '', 'sd_ho_lv5', 67, 0),
(91, 23, '', '20250327092122_3-2303.DWG', '2025-03-27 02:21:22', '417.5', 'AutoCAD File', 'https://achivon.app/dr_files/20250327092122_3-2303.DWG', '', 'sd_ho_lv5', 67, 0),
(92, 23, '', '20250327092729_3-2300.DWG', '2025-03-27 02:27:29', '97.47', 'AutoCAD File', 'https://achivon.app/dr_files/20250327092729_3-2300.DWG', '', 'sd_ho_lv5', 67, 0),
(93, 23, '', '20250327092738_3-2301.DWG', '2025-03-27 02:27:38', '413.18', 'AutoCAD File', 'https://achivon.app/dr_files/20250327092738_3-2301.DWG', '', 'sd_ho_lv5', 67, 0),
(94, 23, '', '20250327092844_3-2302.DWG', '2025-03-27 02:28:44', '447.76', 'AutoCAD File', 'https://achivon.app/dr_files/20250327092844_3-2302.DWG', '', 'sd_ho_lv5', 67, 0),
(95, 23, '', '20250327092913_3-2304.DWG', '2025-03-27 02:29:13', '314.73', 'AutoCAD File', 'https://achivon.app/dr_files/20250327092913_3-2304.DWG', '', 'sd_ho_lv5', 67, 0),
(96, 23, '', '20250327093030_3-2305.DWG', '2025-03-27 02:30:30', '367.08', 'AutoCAD File', 'https://achivon.app/dr_files/20250327093030_3-2305.DWG', '', 'sd_ho_lv5', 67, 0),
(97, 23, '', '20250327093042_3-2306.DWG', '2025-03-27 02:30:42', '388.53', 'AutoCAD File', 'https://achivon.app/dr_files/20250327093042_3-2306.DWG', '', 'sd_ho_lv5', 67, 0),
(98, 23, '', '20250327093145_3-2310.DWG', '2025-03-27 02:31:45', '297.62', 'AutoCAD File', 'https://achivon.app/dr_files/20250327093145_3-2310.DWG', '', 'sd_ho_lv5', 67, 0),
(99, 23, '', '20250327093159_3-2311.DWG', '2025-03-27 02:31:59', '412.98', 'AutoCAD File', 'https://achivon.app/dr_files/20250327093159_3-2311.DWG', '', 'sd_ho_lv5', 67, 0),
(100, 23, '', '20250327093223_3-2321.DWG', '2025-03-27 02:32:23', '163.46', 'AutoCAD File', 'https://achivon.app/dr_files/20250327093223_3-2321.DWG', '', 'sd_ho_lv5', 67, 0),
(101, 23, '', '20250327093240_3-2322.DWG', '2025-03-27 02:32:40', '229.33', 'AutoCAD File', 'https://achivon.app/dr_files/20250327093240_3-2322.DWG', '', 'sd_ho_lv5', 67, 0),
(102, 23, '', '20250327093248_3-2323.DWG', '2025-03-27 02:32:48', '145.98', 'AutoCAD File', 'https://achivon.app/dr_files/20250327093248_3-2323.DWG', '', 'sd_ho_lv5', 67, 0),
(103, 23, '', '20250327093258_3-2324.DWG', '2025-03-27 02:32:58', '297.13', 'AutoCAD File', 'https://achivon.app/dr_files/20250327093258_3-2324.DWG', '', 'sd_ho_lv5', 67, 0),
(104, 23, '', '20250327093321_3-2325.DWG', '2025-03-27 02:33:21', '140.52', 'AutoCAD File', 'https://achivon.app/dr_files/20250327093321_3-2325.DWG', '', 'sd_ho_lv5', 67, 0),
(105, 23, '', '20250327093332_3-3302.DWG', '2025-03-27 02:33:32', '210.9', 'AutoCAD File', 'https://achivon.app/dr_files/20250327093332_3-3302.DWG', '', 'sd_ho_lv5', 67, 0),
(106, 23, '', '20250327093341_3-3303.DWG', '2025-03-27 02:33:41', '149.61', 'AutoCAD File', 'https://achivon.app/dr_files/20250327093341_3-3303.DWG', '', 'sd_ho_lv5', 67, 0),
(107, 23, '', '20250327093358_3-3304.DWG', '2025-03-27 02:33:58', '147.86', 'AutoCAD File', 'https://achivon.app/dr_files/20250327093358_3-3304.DWG', '', 'sd_ho_lv5', 67, 0),
(108, 23, '', '20250327093409_3-3305.DWG', '2025-03-27 02:34:09', '188.36', 'AutoCAD File', 'https://achivon.app/dr_files/20250327093409_3-3305.DWG', '', 'sd_ho_lv5', 67, 0),
(109, 23, '', '20250327093539_4-2401.DWG', '2025-03-27 02:35:39', '235.56', 'AutoCAD File', 'https://achivon.app/dr_files/20250327093539_4-2401.DWG', '', 'sd_ho_lv5', 68, 0),
(110, 23, '', '20250327093546_4-2402.DWG', '2025-03-27 02:35:46', '349.23', 'AutoCAD File', 'https://achivon.app/dr_files/20250327093546_4-2402.DWG', '', 'sd_ho_lv5', 68, 0),
(111, 23, '', '20250327093725_4-2403.DWG', '2025-03-27 02:37:25', '219.35', 'AutoCAD File', 'https://achivon.app/dr_files/20250327093725_4-2403.DWG', '', 'sd_ho_lv5', 68, 0),
(112, 23, '', '20250327093736_4-2407.DWG', '2025-03-27 02:37:36', '219.99', 'AutoCAD File', 'https://achivon.app/dr_files/20250327093736_4-2407.DWG', '', 'sd_ho_lv5', 68, 0),
(113, 23, '', '20250327093754_4-2408.DWG', '2025-03-27 02:37:54', '185.3', 'AutoCAD File', 'https://achivon.app/dr_files/20250327093754_4-2408.DWG', '', 'sd_ho_lv5', 68, 0),
(114, 23, '', '20250327093805_4-2409.DWG', '2025-03-27 02:38:05', '208.25', 'AutoCAD File', 'https://achivon.app/dr_files/20250327093805_4-2409.DWG', '', 'sd_ho_lv5', 68, 0),
(115, 23, '', '20250327093811_4-2410.DWG', '2025-03-27 02:38:11', '108.86', 'AutoCAD File', 'https://achivon.app/dr_files/20250327093811_4-2410.DWG', '', 'sd_ho_lv5', 68, 0),
(116, 23, '', '20250327093820_4-2410.DWG', '2025-03-27 02:38:20', '108.86', 'AutoCAD File', 'https://achivon.app/dr_files/20250327093820_4-2410.DWG', '', 'sd_ho_lv5', 68, 0),
(117, 23, '', '20250327093833_4-2411.DWG', '2025-03-27 02:38:33', '202.61', 'AutoCAD File', 'https://achivon.app/dr_files/20250327093833_4-2411.DWG', '', 'sd_ho_lv5', 68, 0),
(118, 23, '', '20250327093843_4-2412.DWG', '2025-03-27 02:38:43', '203.17', 'AutoCAD File', 'https://achivon.app/dr_files/20250327093843_4-2412.DWG', '', 'sd_ho_lv5', 68, 0),
(119, 23, '', '20250327093913_4-2413.DWG', '2025-03-27 02:39:13', '140.79', 'AutoCAD File', 'https://achivon.app/dr_files/20250327093913_4-2413.DWG', '', 'sd_ho_lv5', 68, 0),
(120, 23, '', '20250327095235_4-2414.DWG', '2025-03-27 02:52:35', '170.95', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095235_4-2414.DWG', '', 'sd_ho_lv5', 68, 0),
(121, 23, '', '20250327095247_4-2415.DWG', '2025-03-27 02:52:47', '162.01', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095247_4-2415.DWG', '', 'sd_ho_lv5', 68, 0),
(122, 23, '', '20250327095255_4-2416.DWG', '2025-03-27 02:52:55', '197.88', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095255_4-2416.DWG', '', 'sd_ho_lv5', 68, 0),
(123, 23, '', '20250327095303_4-2417.DWG', '2025-03-27 02:53:03', '231.35', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095303_4-2417.DWG', '', 'sd_ho_lv5', 68, 0),
(124, 23, '', '20250327095314_4-2418.DWG', '2025-03-27 02:53:14', '166.83', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095314_4-2418.DWG', '', 'sd_ho_lv5', 68, 0),
(125, 23, '', '20250327095326_1-3000.DWG', '2025-03-27 02:53:26', '83.28', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095326_1-3000.DWG', '', 'sd_ho_lv4', 88, 0),
(126, 23, '', '20250327095328_4-26105.DWG', '2025-03-27 02:53:28', '174.83', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095328_4-26105.DWG', '', 'sd_ho_lv5', 68, 0),
(127, 23, '', '20250327095334_1-3101.DWG', '2025-03-27 02:53:34', '154.16', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095334_1-3101.DWG', '', 'sd_ho_lv4', 88, 0),
(128, 23, '', '20250327095341_4-26106.DWG', '2025-03-27 02:53:41', '208.55', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095341_4-26106.DWG', '', 'sd_ho_lv5', 68, 0),
(129, 23, '', '20250327095403_4-26107.DWG', '2025-03-27 02:54:03', '232.94', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095403_4-26107.DWG', '', 'sd_ho_lv5', 68, 0),
(130, 23, '', '20250327095417_1-3000.DWG', '2025-03-27 02:54:17', '83.28', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095417_1-3000.DWG', '', 'sd_ho_lv5', 69, 0),
(131, 23, '', '20250327095419_4-26108.DWG', '2025-03-27 02:54:19', '189.48', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095419_4-26108.DWG', '', 'sd_ho_lv5', 68, 0),
(132, 23, '', '20250327095424_1-3101.DWG', '2025-03-27 02:54:24', '154.16', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095424_1-3101.DWG', '', 'sd_ho_lv5', 69, 0),
(133, 23, '', '20250327095431_1-3102.DWG', '2025-03-27 02:54:31', '218.94', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095431_1-3102.DWG', '', 'sd_ho_lv5', 69, 0),
(134, 23, '', '20250327095433_4-26109.DWG', '2025-03-27 02:54:33', '170.24', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095433_4-26109.DWG', '', 'sd_ho_lv5', 68, 0),
(135, 23, '', '20250327095438_1-3103.DWG', '2025-03-27 02:54:38', '239.91', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095438_1-3103.DWG', '', 'sd_ho_lv5', 69, 0),
(136, 23, '', '20250327095445_4-26110.DWG', '2025-03-27 02:54:45', '183.39', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095445_4-26110.DWG', '', 'sd_ho_lv5', 68, 0),
(137, 23, '', '20250327095449_1-3104.DWG', '2025-03-27 02:54:49', '263.45', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095449_1-3104.DWG', '', 'sd_ho_lv5', 69, 0),
(138, 23, '', '20250327095454_4-26111.DWG', '2025-03-27 02:54:54', '254.13', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095454_4-26111.DWG', '', 'sd_ho_lv5', 68, 0),
(139, 23, '', '20250327095455_1-3105.DWG', '2025-03-27 02:54:55', '209.74', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095455_1-3105.DWG', '', 'sd_ho_lv5', 69, 0),
(140, 23, '', '20250327095504_1-3106.DWG', '2025-03-27 02:55:04', '152.29', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095504_1-3106.DWG', '', 'sd_ho_lv5', 69, 0),
(141, 23, '', '20250327095506_4-26112.DWG', '2025-03-27 02:55:06', '242.23', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095506_4-26112.DWG', '', 'sd_ho_lv5', 68, 0),
(142, 23, '', '20250327095511_1-3110.DWG', '2025-03-27 02:55:11', '205.79', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095511_1-3110.DWG', '', 'sd_ho_lv5', 69, 0),
(143, 23, '', '20250327095514_4-26113.DWG', '2025-03-27 02:55:14', '188.76', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095514_4-26113.DWG', '', 'sd_ho_lv5', 68, 0),
(144, 23, '', '20250327095521_4-26114.DWG', '2025-03-27 02:55:21', '281.68', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095521_4-26114.DWG', '', 'sd_ho_lv5', 68, 0),
(145, 23, '', '20250327095607_2-3201.DWG', '2025-03-27 02:56:07', '153.52', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095607_2-3201.DWG', '', 'sd_ho_lv5', 70, 0),
(146, 23, '', '20250327095615_2-3202.DWG', '2025-03-27 02:56:15', '526.24', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095615_2-3202.DWG', '', 'sd_ho_lv5', 70, 0),
(147, 23, '', '20250327095623_5-2500.DWG', '2025-03-27 02:56:23', '99.44', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095623_5-2500.DWG', '', 'sd_ho_lv5', 73, 0),
(148, 23, '', '20250327095629_5-2501.DWG', '2025-03-27 02:56:29', '244.53', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095629_5-2501.DWG', '', 'sd_ho_lv5', 73, 0),
(149, 23, '', '20250327095632_2-3203.DWG', '2025-03-27 02:56:32', '646.74', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095632_2-3203.DWG', '', 'sd_ho_lv5', 70, 0),
(150, 23, '', '20250327095635_5-2502.DWG', '2025-03-27 02:56:35', '168.88', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095635_5-2502.DWG', '', 'sd_ho_lv5', 73, 0),
(151, 23, '', '20250327095641_5-2503.DWG', '2025-03-27 02:56:41', '355.39', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095641_5-2503.DWG', '', 'sd_ho_lv5', 73, 0),
(152, 23, '', '20250327095651_5-2504.DWG', '2025-03-27 02:56:51', '194.22', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095651_5-2504.DWG', '', 'sd_ho_lv5', 73, 0),
(153, 23, '', '20250327095701_5-2505.DWG', '2025-03-27 02:57:01', '205.72', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095701_5-2505.DWG', '', 'sd_ho_lv5', 73, 0),
(154, 23, '', '20250327095711_5-2506.DWG', '2025-03-27 02:57:11', '156.8', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095711_5-2506.DWG', '', 'sd_ho_lv5', 73, 0),
(155, 23, '', '20250327095719_5-2507.DWG', '2025-03-27 02:57:19', '145.61', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095719_5-2507.DWG', '', 'sd_ho_lv5', 73, 0),
(156, 23, '', '20250327095736_5-2508.DWG', '2025-03-27 02:57:36', '139.91', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095736_5-2508.DWG', '', 'sd_ho_lv5', 73, 0),
(157, 23, '', '20250327095746_5-2509.DWG', '2025-03-27 02:57:46', '114.49', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095746_5-2509.DWG', '', 'sd_ho_lv5', 73, 0),
(158, 23, '', '20250327095805_5-2510.DWG', '2025-03-27 02:58:05', '264', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095805_5-2510.DWG', '', 'sd_ho_lv5', 73, 0),
(159, 23, '', '20250327095819_5-2511.DWG', '2025-03-27 02:58:19', '165.4', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095819_5-2511.DWG', '', 'sd_ho_lv5', 73, 0),
(160, 23, '', '20250327095831_2-3204.DWG', '2025-03-27 02:58:31', '362.79', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095831_2-3204.DWG', '', 'sd_ho_lv5', 70, 0),
(161, 23, '', '20250327095833_5-2512.DWG', '2025-03-27 02:58:33', '225.37', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095833_5-2512.DWG', '', 'sd_ho_lv5', 73, 0),
(162, 23, '', '20250327095838_2-3205.DWG', '2025-03-27 02:58:38', '899.18', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095838_2-3205.DWG', '', 'sd_ho_lv5', 70, 0),
(163, 23, '', '20250327095843_2-3206.DWG', '2025-03-27 02:58:43', '202.34', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095843_2-3206.DWG', '', 'sd_ho_lv5', 70, 0),
(164, 23, '', '20250327095849_2-3207.DWG', '2025-03-27 02:58:49', '253.71', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095849_2-3207.DWG', '', 'sd_ho_lv5', 70, 0),
(165, 23, '', '20250327095854_5-2513.DWG', '2025-03-27 02:58:54', '394.96', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095854_5-2513.DWG', '', 'sd_ho_lv5', 73, 0),
(166, 23, '', '20250327095856_2-3208.DWG', '2025-03-27 02:58:56', '122.44', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095856_2-3208.DWG', '', 'sd_ho_lv5', 70, 0),
(167, 23, '', '20250327095900_5-2514.DWG', '2025-03-27 02:59:00', '292.14', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095900_5-2514.DWG', '', 'sd_ho_lv5', 73, 0),
(168, 23, '', '20250327095903_2-3209.DWG', '2025-03-27 02:59:03', '107.11', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095903_2-3209.DWG', '', 'sd_ho_lv5', 70, 0),
(169, 23, '', '20250327095911_2-3210.DWG', '2025-03-27 02:59:11', '111.17', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095911_2-3210.DWG', '', 'sd_ho_lv5', 70, 0),
(170, 23, '', '20250327095922_2-3211.DWG', '2025-03-27 02:59:22', '241.35', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095922_2-3211.DWG', '', 'sd_ho_lv5', 70, 0),
(171, 23, '', '20250327095930_2-3212.DWG', '2025-03-27 02:59:30', '117.51', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095930_2-3212.DWG', '', 'sd_ho_lv5', 70, 0),
(172, 23, '', '20250327095942_2-3213.DWG', '2025-03-27 02:59:42', '282.12', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095942_2-3213.DWG', '', 'sd_ho_lv5', 70, 0),
(173, 23, '', '20250327095945_6-2601.DWG', '2025-03-27 02:59:45', '300.45', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095945_6-2601.DWG', '', 'sd_ho_lv5', 74, 0),
(174, 23, '', '20250327095951_2-3214.DWG', '2025-03-27 02:59:51', '184.81', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095951_2-3214.DWG', '', 'sd_ho_lv5', 70, 0),
(175, 23, '', '20250327095951_6-2602.DWG', '2025-03-27 02:59:51', '526.51', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095951_6-2602.DWG', '', 'sd_ho_lv5', 74, 0),
(176, 23, '', '20250327095957_6-2603.DWG', '2025-03-27 02:59:57', '291', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095957_6-2603.DWG', '', 'sd_ho_lv5', 74, 0),
(177, 23, '', '20250327095957_2-3215.DWG', '2025-03-27 02:59:57', '170.15', 'AutoCAD File', 'https://achivon.app/dr_files/20250327095957_2-3215.DWG', '', 'sd_ho_lv5', 70, 0),
(178, 23, '', '20250327100002_6-2604.DWG', '2025-03-27 03:00:02', '477.33', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100002_6-2604.DWG', '', 'sd_ho_lv5', 74, 0),
(179, 23, '', '20250327100003_2-3216.DWG', '2025-03-27 03:00:03', '176.98', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100003_2-3216.DWG', '', 'sd_ho_lv5', 70, 0),
(180, 23, '', '20250327100008_6-2605.DWG', '2025-03-27 03:00:08', '148', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100008_6-2605.DWG', '', 'sd_ho_lv5', 74, 0),
(181, 23, '', '20250327100011_2-3217.DWG', '2025-03-27 03:00:11', '177.66', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100011_2-3217.DWG', '', 'sd_ho_lv5', 70, 0),
(182, 23, '', '20250327100014_6-2606.DWG', '2025-03-27 03:00:14', '252.85', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100014_6-2606.DWG', '', 'sd_ho_lv5', 74, 0),
(183, 23, '', '20250327100019_2-3218.DWG', '2025-03-27 03:00:19', '121.14', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100019_2-3218.DWG', '', 'sd_ho_lv5', 70, 0),
(184, 23, '', '20250327100021_6-2607.DWG', '2025-03-27 03:00:21', '224.68', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100021_6-2607.DWG', '', 'sd_ho_lv5', 74, 0),
(185, 23, '', '20250327100025_2-3219.DWG', '2025-03-27 03:00:25', '232.8', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100025_2-3219.DWG', '', 'sd_ho_lv5', 70, 0),
(186, 23, '', '20250327100029_6-2608-1.DWG', '2025-03-27 03:00:29', '244.15', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100029_6-2608-1.DWG', '', 'sd_ho_lv5', 74, 0),
(187, 23, '', '20250327100031_2-3220.DWG', '2025-03-27 03:00:31', '218.97', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100031_2-3220.DWG', '', 'sd_ho_lv5', 70, 0),
(188, 23, '', '20250327100037_6-2609.DWG', '2025-03-27 03:00:37', '304.29', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100037_6-2609.DWG', '', 'sd_ho_lv5', 74, 0),
(189, 23, '', '20250327100037_2-3221.DWG', '2025-03-27 03:00:37', '127.92', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100037_2-3221.DWG', '', 'sd_ho_lv5', 70, 0),
(190, 23, '', '20250327100044_2-3222.DWG', '2025-03-27 03:00:44', '291.82', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100044_2-3222.DWG', '', 'sd_ho_lv5', 70, 0),
(191, 23, '', '20250327100045_6-2610.DWG', '2025-03-27 03:00:45', '224.74', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100045_6-2610.DWG', '', 'sd_ho_lv5', 74, 0),
(192, 23, '', '20250327100052_2-3223.DWG', '2025-03-27 03:00:52', '212', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100052_2-3223.DWG', '', 'sd_ho_lv5', 70, 0),
(193, 23, '', '20250327100053_6-2615.DWG', '2025-03-27 03:00:53', '181.03', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100053_6-2615.DWG', '', 'sd_ho_lv5', 74, 0),
(194, 23, '', '20250327100101_6-2616.DWG', '2025-03-27 03:01:01', '149.53', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100101_6-2616.DWG', '', 'sd_ho_lv5', 74, 0),
(195, 23, '', '20250327100102_2-3224.DWG', '2025-03-27 03:01:02', '189.66', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100102_2-3224.DWG', '', 'sd_ho_lv5', 70, 0),
(196, 23, '', '20250327100108_2-3225.DWG', '2025-03-27 03:01:08', '170.45', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100108_2-3225.DWG', '', 'sd_ho_lv5', 70, 0),
(197, 23, '', '20250327100109_6-2617.DWG', '2025-03-27 03:01:09', '255.36', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100109_6-2617.DWG', '', 'sd_ho_lv5', 74, 0),
(198, 23, '', '20250327100116_2-3227.DWG', '2025-03-27 03:01:16', '210.2', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100116_2-3227.DWG', '', 'sd_ho_lv5', 70, 0),
(199, 23, '', '20250327100116_6-2618.DWG', '2025-03-27 03:01:16', '165.39', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100116_6-2618.DWG', '', 'sd_ho_lv5', 74, 0),
(200, 23, '', '20250327100123_2-3250.DWG', '2025-03-27 03:01:23', '136.77', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100123_2-3250.DWG', '', 'sd_ho_lv5', 70, 0),
(201, 23, '', '20250327100125_6-2619.DWG', '2025-03-27 03:01:25', '160.92', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100125_6-2619.DWG', '', 'sd_ho_lv5', 74, 0),
(202, 23, '', '20250327100129_2-3251.DWG', '2025-03-27 03:01:29', '121.68', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100129_2-3251.DWG', '', 'sd_ho_lv5', 70, 0),
(203, 23, '', '20250327100134_6-2620.DWG', '2025-03-27 03:01:34', '230.63', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100134_6-2620.DWG', '', 'sd_ho_lv5', 74, 0),
(204, 23, '', '20250327100135_2-3252.DWG', '2025-03-27 03:01:35', '120.51', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100135_2-3252.DWG', '', 'sd_ho_lv5', 70, 0),
(205, 23, '', '20250327100141_2-3253.DWG', '2025-03-27 03:01:41', '108.34', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100141_2-3253.DWG', '', 'sd_ho_lv5', 70, 0),
(206, 23, '', '20250327100143_6-2621.DWG', '2025-03-27 03:01:43', '193.79', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100143_6-2621.DWG', '', 'sd_ho_lv5', 74, 0),
(207, 23, '', '20250327100147_2-3254.DWG', '2025-03-27 03:01:47', '68.69', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100147_2-3254.DWG', '', 'sd_ho_lv5', 70, 0),
(208, 23, '', '20250327100150_6-2622.DWG', '2025-03-27 03:01:50', '268.49', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100150_6-2622.DWG', '', 'sd_ho_lv5', 74, 0),
(209, 23, '', '20250327100158_6-2626.DWG', '2025-03-27 03:01:58', '292.7', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100158_6-2626.DWG', '', 'sd_ho_lv5', 74, 0),
(210, 23, '', '20250327100240_7-2700.DWG', '2025-03-27 03:02:40', '100.86', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100240_7-2700.DWG', '', 'sd_ho_lv5', 75, 0),
(211, 23, '', '20250327100242_3-3301.DWG', '2025-03-27 03:02:42', '107.12', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100242_3-3301.DWG', '', 'sd_ho_lv5', 71, 0),
(212, 23, '', '20250327100248_7-2701.DWG', '2025-03-27 03:02:48', '199.5', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100248_7-2701.DWG', '', 'sd_ho_lv5', 75, 0),
(213, 23, '', '20250327100249_3-3311.DWG', '2025-03-27 03:02:49', '192.69', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100249_3-3311.DWG', '', 'sd_ho_lv5', 71, 0),
(214, 23, '', '20250327100255_3-3312.DWG', '2025-03-27 03:02:55', '203.64', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100255_3-3312.DWG', '', 'sd_ho_lv5', 71, 0),
(215, 23, '', '20250327100255_7-2702.DWG', '2025-03-27 03:02:55', '95.44', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100255_7-2702.DWG', '', 'sd_ho_lv5', 75, 0),
(216, 23, '', '20250327100259_3-3313.DWG', '2025-03-27 03:03:00', '155.31', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100259_3-3313.DWG', '', 'sd_ho_lv5', 71, 0),
(217, 23, '', '20250327100300_7-2703.DWG', '2025-03-27 03:03:00', '266.56', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100300_7-2703.DWG', '', 'sd_ho_lv5', 75, 0),
(218, 23, '', '20250327100305_3-3314.DWG', '2025-03-27 03:03:05', '475.93', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100305_3-3314.DWG', '', 'sd_ho_lv5', 71, 0),
(219, 23, '', '20250327100306_7-2704.DWG', '2025-03-27 03:03:06', '109.89', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100306_7-2704.DWG', '', 'sd_ho_lv5', 75, 0),
(220, 23, '', '20250327100310_3-3316.DWG', '2025-03-27 03:03:10', '130.9', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100310_3-3316.DWG', '', 'sd_ho_lv5', 71, 0),
(221, 23, '', '20250327100311_7-2705.DWG', '2025-03-27 03:03:11', '319.06', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100311_7-2705.DWG', '', 'sd_ho_lv5', 75, 0),
(222, 23, '', '20250327100316_7-2706.DWG', '2025-03-27 03:03:16', '112.67', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100316_7-2706.DWG', '', 'sd_ho_lv5', 75, 0),
(223, 23, '', '20250327100317_3-3320.DWG', '2025-03-27 03:03:17', '147.91', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100317_3-3320.DWG', '', 'sd_ho_lv5', 71, 0),
(224, 23, '', '20250327100322_7-2707.DWG', '2025-03-27 03:03:22', '122.18', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100322_7-2707.DWG', '', 'sd_ho_lv5', 75, 0),
(225, 23, '', '20250327100325_3-3350.DWG', '2025-03-27 03:03:25', '256.32', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100325_3-3350.DWG', '', 'sd_ho_lv5', 71, 0),
(226, 23, '', '20250327100329_7-2708.DWG', '2025-03-27 03:03:29', '264.48', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100329_7-2708.DWG', '', 'sd_ho_lv5', 75, 0),
(227, 23, '', '20250327100336_7-2709.DWG', '2025-03-27 03:03:36', '176.41', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100336_7-2709.DWG', '', 'sd_ho_lv5', 75, 0),
(228, 23, '', '20250327100346_7-2710.DWG', '2025-03-27 03:03:46', '243.13', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100346_7-2710.DWG', '', 'sd_ho_lv5', 75, 0),
(229, 23, '', '20250327100354_7-2711.DWG', '2025-03-27 03:03:54', '124.91', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100354_7-2711.DWG', '', 'sd_ho_lv5', 75, 0),
(230, 23, '', '20250327100402_7-2712.DWG', '2025-03-27 03:04:02', '181.53', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100402_7-2712.DWG', '', 'sd_ho_lv5', 75, 0),
(231, 23, '', '20250327100413_7-2713.DWG', '2025-03-27 03:04:13', '345.82', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100413_7-2713.DWG', '', 'sd_ho_lv5', 75, 0),
(232, 23, '', '20250327100415_4-3402.DWG', '2025-03-27 03:04:15', '181.14', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100415_4-3402.DWG', '', 'sd_ho_lv5', 72, 0),
(233, 23, '', '20250327100420_7-2714.DWG', '2025-03-27 03:04:20', '140.14', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100420_7-2714.DWG', '', 'sd_ho_lv5', 75, 0),
(234, 23, '', '20250327100421_4-3403.DWG', '2025-03-27 03:04:21', '180.77', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100421_4-3403.DWG', '', 'sd_ho_lv5', 72, 0),
(235, 23, '', '20250327100426_4-3404.DWG', '2025-03-27 03:04:26', '212.24', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100426_4-3404.DWG', '', 'sd_ho_lv5', 72, 0),
(236, 23, '', '20250327100426_7-2715.DWG', '2025-03-27 03:04:26', '236.64', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100426_7-2715.DWG', '', 'sd_ho_lv5', 75, 0),
(237, 23, '', '20250327100432_4-3405.DWG', '2025-03-27 03:04:32', '204.09', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100432_4-3405.DWG', '', 'sd_ho_lv5', 72, 0),
(238, 23, '', '20250327100436_7-2720.DWG', '2025-03-27 03:04:36', '251.16', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100436_7-2720.DWG', '', 'sd_ho_lv5', 75, 0),
(239, 23, '', '20250327100437_4-3406.DWG', '2025-03-27 03:04:37', '228.99', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100437_4-3406.DWG', '', 'sd_ho_lv5', 72, 0),
(240, 23, '', '20250327100445_7-2721.DWG', '2025-03-27 03:04:45', '148.4', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100445_7-2721.DWG', '', 'sd_ho_lv5', 75, 0),
(241, 23, '', '20250327100449_4-3411.DWG', '2025-03-27 03:04:49', '209.47', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100449_4-3411.DWG', '', 'sd_ho_lv5', 72, 0),
(242, 23, '', '20250327100449_4-3411.DWG', '2025-03-27 03:04:49', '209.47', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100449_4-3411.DWG', '', 'sd_ho_lv5', 72, 0),
(243, 23, '', '20250327100503_7-2722.DWG', '2025-03-27 03:05:03', '317.48', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100503_7-2722.DWG', '', 'sd_ho_lv5', 75, 0),
(244, 23, '', '20250327100509_4-3412.DWG', '2025-03-27 03:05:09', '160.57', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100509_4-3412.DWG', '', 'sd_ho_lv5', 72, 0),
(245, 23, '', '20250327100512_7-2723.DWG', '2025-03-27 03:05:12', '550.8', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100512_7-2723.DWG', '', 'sd_ho_lv5', 75, 0),
(246, 23, '', '20250327100520_4-3450.DWG', '2025-03-27 03:05:20', '160.26', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100520_4-3450.DWG', '', 'sd_ho_lv5', 72, 0),
(247, 23, '', '20250327100529_4-3451.DWG', '2025-03-27 03:05:29', '308.07', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100529_4-3451.DWG', '', 'sd_ho_lv5', 72, 0),
(248, 23, '', '20250327100551_8-2800.DWG', '2025-03-27 03:05:51', '93.9', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100551_8-2800.DWG', '', 'sd_ho_lv5', 76, 0),
(249, 23, '', '20250327100557_8-2801.DWG', '2025-03-27 03:05:57', '253.2', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100557_8-2801.DWG', '', 'sd_ho_lv5', 76, 0),
(250, 23, '', '20250327100603_8-2802.DWG', '2025-03-27 03:06:03', '202.27', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100603_8-2802.DWG', '', 'sd_ho_lv5', 76, 0),
(251, 23, '', '20250327100609_8-2803.DWG', '2025-03-27 03:06:09', '171.54', 'AutoCAD File', 'https://achivon.app/dr_files/20250327100609_8-2803.DWG', '', 'sd_ho_lv5', 76, 0),
(252, 23, '', '20250327103938_5-3501.DWG', '2025-03-27 03:39:38', '153.38', 'AutoCAD File', 'https://achivon.app/dr_files/20250327103938_5-3501.DWG', '', 'sd_ho_lv5', 77, 0),
(253, 23, '', '20250327103944_5-3502.DWG', '2025-03-27 03:39:44', '169.04', 'AutoCAD File', 'https://achivon.app/dr_files/20250327103944_5-3502.DWG', '', 'sd_ho_lv5', 77, 0),
(254, 23, '', '20250327103950_5-3503.DWG', '2025-03-27 03:39:50', '280.31', 'AutoCAD File', 'https://achivon.app/dr_files/20250327103950_5-3503.DWG', '', 'sd_ho_lv5', 77, 0),
(255, 23, '', '20250327103956_5-3504.DWG', '2025-03-27 03:39:56', '123.68', 'AutoCAD File', 'https://achivon.app/dr_files/20250327103956_5-3504.DWG', '', 'sd_ho_lv5', 77, 0),
(256, 23, '', '20250327104001_5-3505.DWG', '2025-03-27 03:40:01', '233.22', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104001_5-3505.DWG', '', 'sd_ho_lv5', 77, 0),
(257, 23, '', '20250327104006_5-3506.DWG', '2025-03-27 03:40:06', '114.92', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104006_5-3506.DWG', '', 'sd_ho_lv5', 77, 0),
(258, 23, '', '20250327104020_5-3507.DWG', '2025-03-27 03:40:20', '105.36', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104020_5-3507.DWG', '', 'sd_ho_lv5', 77, 0),
(259, 23, '', '20250327104026_5-3508.DWG', '2025-03-27 03:40:26', '207.96', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104026_5-3508.DWG', '', 'sd_ho_lv5', 77, 0),
(260, 23, '', '20250327104037_5-3509.DWG', '2025-03-27 03:40:37', '160.88', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104037_5-3509.DWG', '', 'sd_ho_lv5', 77, 0),
(261, 23, '', '20250327104043_5-3510.DWG', '2025-03-27 03:40:43', '152.38', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104043_5-3510.DWG', '', 'sd_ho_lv5', 77, 0),
(262, 23, '', '20250327104050_5-3511.DWG', '2025-03-27 03:40:50', '112.42', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104050_5-3511.DWG', '', 'sd_ho_lv5', 77, 0),
(263, 23, '', '20250327104058_5-3512.DWG', '2025-03-27 03:40:58', '230.75', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104058_5-3512.DWG', '', 'sd_ho_lv5', 77, 0),
(264, 23, '', '20250327104107_5-3513.DWG', '2025-03-27 03:41:07', '136.15', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104107_5-3513.DWG', '', 'sd_ho_lv5', 77, 0),
(265, 23, '', '20250327104116_5-3514.DWG', '2025-03-27 03:41:16', '81.16', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104116_5-3514.DWG', '', 'sd_ho_lv5', 77, 0),
(266, 23, '', '20250327104124_5-3515.DWG', '2025-03-27 03:41:24', '212.46', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104124_5-3515.DWG', '', 'sd_ho_lv5', 77, 0),
(267, 23, '', '20250327104135_5-3520.DWG', '2025-03-27 03:41:35', '176.52', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104135_5-3520.DWG', '', 'sd_ho_lv5', 77, 0),
(268, 23, '', '20250327104150_5-3521.DWG', '2025-03-27 03:41:50', '157.46', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104150_5-3521.DWG', '', 'sd_ho_lv5', 77, 0),
(269, 23, '', '20250327104206_5-3550.DWG', '2025-03-27 03:42:06', '154.25', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104206_5-3550.DWG', '', 'sd_ho_lv5', 77, 0),
(270, 23, '', '20250327104221_5-3551.DWG', '2025-03-27 03:42:21', '314.21', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104221_5-3551.DWG', '', 'sd_ho_lv5', 77, 0),
(271, 23, '', '20250327104241_8-2804.DWG', '2025-03-27 03:42:41', '168.85', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104241_8-2804.DWG', '', 'sd_ho_lv5', 76, 0),
(272, 23, '', '20250327104246_8-2805.DWG', '2025-03-27 03:42:46', '251.96', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104246_8-2805.DWG', '', 'sd_ho_lv5', 76, 0),
(273, 23, '', '20250327104251_8-2806.DWG', '2025-03-27 03:42:51', '237.55', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104251_8-2806.DWG', '', 'sd_ho_lv5', 76, 0),
(274, 23, '', '20250327104257_8-2807.DWG', '2025-03-27 03:42:57', '180.28', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104257_8-2807.DWG', '', 'sd_ho_lv5', 76, 0),
(275, 23, '', '20250327104304_8-2808.DWG', '2025-03-27 03:43:04', '227.6', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104304_8-2808.DWG', '', 'sd_ho_lv5', 76, 0),
(276, 23, '', '20250327104310_8-2809.DWG', '2025-03-27 03:43:10', '193.3', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104310_8-2809.DWG', '', 'sd_ho_lv5', 76, 0),
(277, 23, '', '20250327104316_5-3552.DWG', '2025-03-27 03:43:16', '152.55', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104316_5-3552.DWG', '', 'sd_ho_lv5', 77, 0),
(278, 23, '', '20250327104317_8-2810.DWG', '2025-03-27 03:43:17', '82.9', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104317_8-2810.DWG', '', 'sd_ho_lv5', 76, 0),
(279, 23, '', '20250327104325_5-4390-1.DWG', '2025-03-27 03:43:25', '85.35', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104325_5-4390-1.DWG', '', 'sd_ho_lv5', 77, 0),
(280, 23, '', '20250327104325_8-2811.DWG', '2025-03-27 03:43:25', '192.49', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104325_8-2811.DWG', '', 'sd_ho_lv5', 76, 0),
(281, 23, '', '20250327104333_5-4390-2.DWG', '2025-03-27 03:43:33', '233.83', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104333_5-4390-2.DWG', '', 'sd_ho_lv5', 77, 0),
(282, 23, '', '20250327104334_8-2812.DWG', '2025-03-27 03:43:34', '273.56', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104334_8-2812.DWG', '', 'sd_ho_lv5', 76, 0),
(283, 23, '', '20250327104343_8-2813.DWG', '2025-03-27 03:43:43', '231.34', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104343_8-2813.DWG', '', 'sd_ho_lv5', 76, 0),
(284, 23, '', '20250327104350_8-2814.DWG', '2025-03-27 03:43:50', '109.61', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104350_8-2814.DWG', '', 'sd_ho_lv5', 76, 0),
(285, 23, '', '20250327104356_8-2815.DWG', '2025-03-27 03:43:56', '113.22', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104356_8-2815.DWG', '', 'sd_ho_lv5', 76, 0),
(286, 23, '', '20250327104403_7-3701.DWG', '2025-03-27 03:44:03', '171.05', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104403_7-3701.DWG', '', 'sd_ho_lv5', 79, 0),
(287, 23, '', '20250327104409_7-3702.DWG', '2025-03-27 03:44:09', '245.75', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104409_7-3702.DWG', '', 'sd_ho_lv5', 79, 0),
(288, 23, '', '20250327104414_8-2816.DWG', '2025-03-27 03:44:14', '188.78', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104414_8-2816.DWG', '', 'sd_ho_lv5', 76, 0),
(289, 23, '', '20250327104415_7-3703.DWG', '2025-03-27 03:44:15', '280.39', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104415_7-3703.DWG', '', 'sd_ho_lv5', 79, 0),
(290, 23, '', '20250327104420_7-3704.DWG', '2025-03-27 03:44:20', '135.16', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104420_7-3704.DWG', '', 'sd_ho_lv5', 79, 0),
(291, 23, '', '20250327104421_8-2817.DWG', '2025-03-27 03:44:21', '152.46', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104421_8-2817.DWG', '', 'sd_ho_lv5', 76, 0),
(292, 23, '', '20250327104425_7-3705.DWG', '2025-03-27 03:44:25', '107.39', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104425_7-3705.DWG', '', 'sd_ho_lv5', 79, 0),
(293, 23, '', '20250327104428_8-2818.DWG', '2025-03-27 03:44:28', '407.2', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104428_8-2818.DWG', '', 'sd_ho_lv5', 76, 0),
(294, 23, '', '20250327104430_7-3706.DWG', '2025-03-27 03:44:30', '170.89', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104430_7-3706.DWG', '', 'sd_ho_lv5', 79, 0),
(295, 23, '', '20250327104435_8-2819.DWG', '2025-03-27 03:44:35', '130.27', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104435_8-2819.DWG', '', 'sd_ho_lv5', 76, 0),
(296, 23, '', '20250327104436_7-3707.DWG', '2025-03-27 03:44:36', '126.09', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104436_7-3707.DWG', '', 'sd_ho_lv5', 79, 0),
(297, 23, '', '20250327104442_7-3708.DWG', '2025-03-27 03:44:42', '53.24', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104442_7-3708.DWG', '', 'sd_ho_lv5', 79, 0),
(298, 23, '', '20250327104546_9-2900.DWG', '2025-03-27 03:45:46', '91.49', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104546_9-2900.DWG', '', 'sd_ho_lv5', 80, 0),
(299, 23, '', '20250327104553_9-2901.DWG', '2025-03-27 03:45:53', '125.9', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104553_9-2901.DWG', '', 'sd_ho_lv5', 80, 0),
(300, 23, '', '20250327104558_9-2902.DWG', '2025-03-27 03:45:58', '215.26', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104558_9-2902.DWG', '', 'sd_ho_lv5', 80, 0),
(301, 23, '', '20250327104603_9-2903.DWG', '2025-03-27 03:46:03', '138.2', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104603_9-2903.DWG', '', 'sd_ho_lv5', 80, 0),
(302, 23, '', '20250327104608_9-2904.DWG', '2025-03-27 03:46:08', '166.68', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104608_9-2904.DWG', '', 'sd_ho_lv5', 80, 0),
(303, 23, '', '20250327104614_9-2905.DWG', '2025-03-27 03:46:14', '229.75', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104614_9-2905.DWG', '', 'sd_ho_lv5', 80, 0),
(304, 23, '', '20250327104619_9-2906.DWG', '2025-03-27 03:46:19', '203.61', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104619_9-2906.DWG', '', 'sd_ho_lv5', 80, 0),
(305, 23, '', '20250327104624_9-2907.DWG', '2025-03-27 03:46:24', '146.67', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104624_9-2907.DWG', '', 'sd_ho_lv5', 80, 0),
(306, 23, '', '20250327104629_9-2908.DWG', '2025-03-27 03:46:29', '528.55', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104629_9-2908.DWG', '', 'sd_ho_lv5', 80, 0),
(307, 23, '', '20250327104716_7-3709.DWG', '2025-03-27 03:47:16', '149.66', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104716_7-3709.DWG', '', 'sd_ho_lv5', 79, 0),
(308, 23, '', '20250327104725_7-3710.DWG', '2025-03-27 03:47:25', '285.67', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104725_7-3710.DWG', '', 'sd_ho_lv5', 79, 0),
(309, 23, '', '20250327104735_7-3720.DWG', '2025-03-27 03:47:35', '757.54', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104735_7-3720.DWG', '', 'sd_ho_lv5', 79, 0),
(310, 23, '', '20250327104747_7-3721.DWG', '2025-03-27 03:47:47', '536.7', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104747_7-3721.DWG', '', 'sd_ho_lv5', 79, 0),
(311, 23, '', '20250327104754_7-3722.DWG', '2025-03-27 03:47:54', '140.96', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104754_7-3722.DWG', '', 'sd_ho_lv5', 79, 0);
INSERT INTO `dr_file` (`id`, `id_user`, `subject`, `name_file`, `upload_date`, `size`, `type_file`, `link`, `remark`, `table_name`, `id_table`, `is_aktiv`) VALUES
(312, 23, '', '20250327104803_7-3723.DWG', '2025-03-27 03:48:03', '163.55', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104803_7-3723.DWG', '', 'sd_ho_lv5', 79, 0),
(313, 23, '', '20250327104813_7-3724.DWG', '2025-03-27 03:48:13', '156.62', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104813_7-3724.DWG', '', 'sd_ho_lv5', 79, 0),
(314, 23, '', '20250327104821_7-3725.DWG', '2025-03-27 03:48:21', '161.59', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104821_7-3725.DWG', '', 'sd_ho_lv5', 79, 0),
(315, 23, '', '20250327104831_7-3731.DWG', '2025-03-27 03:48:31', '184.88', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104831_7-3731.DWG', '', 'sd_ho_lv5', 79, 0),
(316, 23, '', '20250327104846_7-3732.DWG', '2025-03-27 03:48:46', '215.28', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104846_7-3732.DWG', '', 'sd_ho_lv5', 79, 0),
(317, 23, '', '20250327104852_7-3733.DWG', '2025-03-27 03:48:52', '309.05', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104852_7-3733.DWG', '', 'sd_ho_lv5', 79, 0),
(318, 23, '', '20250327104859_7-3734.DWG', '2025-03-27 03:48:59', '222.54', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104859_7-3734.DWG', '', 'sd_ho_lv5', 79, 0),
(319, 23, '', '20250327104905_7-3735.DWG', '2025-03-27 03:49:05', '230.48', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104905_7-3735.DWG', '', 'sd_ho_lv5', 79, 0),
(320, 23, '', '20250327104920_7-3735.DWG', '2025-03-27 03:49:20', '230.48', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104920_7-3735.DWG', '', 'sd_ho_lv5', 79, 0),
(321, 23, '', '20250327104926_250321_Structural_Report_ClO2_Building_Foundation_Checking_eng_ver_R0.pdf', '2025-03-27 03:49:26', '17960.92', 'PDF Document', 'https://achivon.app/dr_files/20250327104926_250321_Structural_Report_ClO2_Building_Foundation_Checking_eng_ver_R0.pdf', '', 'sd_ho_lv4', 89, 0),
(322, 23, '', '20250327104928_7-3736.DWG', '2025-03-27 03:49:28', '218.74', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104928_7-3736.DWG', '', 'sd_ho_lv5', 79, 0),
(323, 23, '', '20250327104949_7-3737.DWG', '2025-03-27 03:49:49', '261.42', 'AutoCAD File', 'https://achivon.app/dr_files/20250327104949_7-3737.DWG', '', 'sd_ho_lv5', 79, 0),
(324, 23, '', '20250327105000_7-3738.DWG', '2025-03-27 03:50:00', '172.78', 'AutoCAD File', 'https://achivon.app/dr_files/20250327105000_7-3738.DWG', '', 'sd_ho_lv5', 79, 0),
(325, 23, '', '20250327105009_7-3740.DWG', '2025-03-27 03:50:09', '108.42', 'AutoCAD File', 'https://achivon.app/dr_files/20250327105009_7-3740.DWG', '', 'sd_ho_lv5', 79, 0),
(326, 23, '', '20250327105018_7-3741.DWG', '2025-03-27 03:50:18', '332.95', 'AutoCAD File', 'https://achivon.app/dr_files/20250327105018_7-3741.DWG', '', 'sd_ho_lv5', 79, 0),
(327, 23, '', '20250327105027_7-3742.DWG', '2025-03-27 03:50:27', '140.9', 'AutoCAD File', 'https://achivon.app/dr_files/20250327105027_7-3742.DWG', '', 'sd_ho_lv5', 79, 0),
(328, 23, '', '20250327105038_7-3743.DWG', '2025-03-27 03:50:38', '145.75', 'AutoCAD File', 'https://achivon.app/dr_files/20250327105038_7-3743.DWG', '', 'sd_ho_lv5', 79, 0),
(329, 23, '', '20250327105047_7-3750.DWG', '2025-03-27 03:50:47', '348.59', 'AutoCAD File', 'https://achivon.app/dr_files/20250327105047_7-3750.DWG', '', 'sd_ho_lv5', 79, 0),
(330, 23, '', '20250327105054_7-3751.DWG', '2025-03-27 03:50:54', '428.7', 'AutoCAD File', 'https://achivon.app/dr_files/20250327105054_7-3751.DWG', '', 'sd_ho_lv5', 79, 0),
(331, 23, '', '20250327105103_7-3752.DWG', '2025-03-27 03:51:03', '267.73', 'AutoCAD File', 'https://achivon.app/dr_files/20250327105103_7-3752.DWG', '', 'sd_ho_lv5', 79, 0),
(332, 23, '', '20250327105111_7-3753.DWG', '2025-03-27 03:51:11', '282.79', 'AutoCAD File', 'https://achivon.app/dr_files/20250327105111_7-3753.DWG', '', 'sd_ho_lv5', 79, 0),
(333, 23, '', '20250327105115_250307_Structural_Report_Achivon_Steel_Conversion_eng_ver_R4.pdf', '2025-03-27 03:51:15', '2473.13', 'PDF Document', 'https://achivon.app/dr_files/20250327105115_250307_Structural_Report_Achivon_Steel_Conversion_eng_ver_R4.pdf', '', 'sd_ho_lv4', 90, 0),
(334, 23, '', '20250327105120_7-3754.DWG', '2025-03-27 03:51:20', '250.94', 'AutoCAD File', 'https://achivon.app/dr_files/20250327105120_7-3754.DWG', '', 'sd_ho_lv5', 79, 0),
(335, 23, '', '20250327105125_Profile_Conversion_Final_Size.xlsx', '2025-03-27 03:51:25', '14.43', 'Excel Document', 'https://achivon.app/dr_files/20250327105125_Profile_Conversion_Final_Size.xlsx', '', 'sd_ho_lv4', 90, 0),
(336, 23, '', '20250327105128_7-3755.DWG', '2025-03-27 03:51:28', '214.47', 'AutoCAD File', 'https://achivon.app/dr_files/20250327105128_7-3755.DWG', '', 'sd_ho_lv5', 79, 0),
(337, 23, '', '20250327105206_8-3801.DWG', '2025-03-27 03:52:06', '206.28', 'AutoCAD File', 'https://achivon.app/dr_files/20250327105206_8-3801.DWG', '', 'sd_ho_lv5', 81, 0),
(338, 23, '', '20250327105211_8-3802.DWG', '2025-03-27 03:52:11', '258.15', 'AutoCAD File', 'https://achivon.app/dr_files/20250327105211_8-3802.DWG', '', 'sd_ho_lv5', 81, 0),
(339, 23, '', '20250327105217_8-3803.DWG', '2025-03-27 03:52:17', '485.84', 'AutoCAD File', 'https://achivon.app/dr_files/20250327105217_8-3803.DWG', '', 'sd_ho_lv5', 81, 0),
(340, 23, '', '20250327105222_8-3804.DWG', '2025-03-27 03:52:22', '316.04', 'AutoCAD File', 'https://achivon.app/dr_files/20250327105222_8-3804.DWG', '', 'sd_ho_lv5', 81, 0),
(341, 23, '', '20250327105227_8-3805.DWG', '2025-03-27 03:52:27', '290.06', 'AutoCAD File', 'https://achivon.app/dr_files/20250327105227_8-3805.DWG', '', 'sd_ho_lv5', 81, 0),
(342, 23, '', '20250327105233_8-3806.DWG', '2025-03-27 03:52:33', '90.21', 'AutoCAD File', 'https://achivon.app/dr_files/20250327105233_8-3806.DWG', '', 'sd_ho_lv5', 81, 0),
(343, 23, '', '20250327105238_8-3807.DWG', '2025-03-27 03:52:38', '166.14', 'AutoCAD File', 'https://achivon.app/dr_files/20250327105238_8-3807.DWG', '', 'sd_ho_lv5', 81, 0),
(344, 23, '', '20250327105245_8-3808.DWG', '2025-03-27 03:52:45', '105.91', 'AutoCAD File', 'https://achivon.app/dr_files/20250327105245_8-3808.DWG', '', 'sd_ho_lv5', 81, 0),
(345, 23, '', '20250327105252_8-3809.DWG', '2025-03-27 03:52:52', '107.09', 'AutoCAD File', 'https://achivon.app/dr_files/20250327105252_8-3809.DWG', '', 'sd_ho_lv5', 81, 0),
(346, 23, '', '20250327105300_8-3810.DWG', '2025-03-27 03:53:00', '118.24', 'AutoCAD File', 'https://achivon.app/dr_files/20250327105300_8-3810.DWG', '', 'sd_ho_lv5', 81, 0),
(347, 23, '', '20250327105309_8-3811.DWG', '2025-03-27 03:53:09', '103.91', 'AutoCAD File', 'https://achivon.app/dr_files/20250327105309_8-3811.DWG', '', 'sd_ho_lv5', 81, 0),
(348, 23, '', '20250327105315_8-3812.DWG', '2025-03-27 03:53:15', '134.59', 'AutoCAD File', 'https://achivon.app/dr_files/20250327105315_8-3812.DWG', '', 'sd_ho_lv5', 81, 0),
(349, 23, '', '20250327105323_8-3813.DWG', '2025-03-27 03:53:23', '164.44', 'AutoCAD File', 'https://achivon.app/dr_files/20250327105323_8-3813.DWG', '', 'sd_ho_lv5', 81, 0),
(350, 23, '', '20250327105329_8-3814.DWG', '2025-03-27 03:53:29', '486.84', 'AutoCAD File', 'https://achivon.app/dr_files/20250327105329_8-3814.DWG', '', 'sd_ho_lv5', 81, 0),
(351, 23, '', '20250327105337_8-3815.DWG', '2025-03-27 03:53:37', '257.1', 'AutoCAD File', 'https://achivon.app/dr_files/20250327105337_8-3815.DWG', '', 'sd_ho_lv5', 81, 0),
(352, 23, '', '20250327105344_8-3816.DWG', '2025-03-27 03:53:44', '123.46', 'AutoCAD File', 'https://achivon.app/dr_files/20250327105344_8-3816.DWG', '', 'sd_ho_lv5', 81, 0),
(353, 23, '', '20250327105350_8-3817.DWG', '2025-03-27 03:53:50', '149.04', 'AutoCAD File', 'https://achivon.app/dr_files/20250327105350_8-3817.DWG', '', 'sd_ho_lv5', 81, 0),
(354, 23, '', '20250327105356_8-3818.DWG', '2025-03-27 03:53:56', '220.96', 'AutoCAD File', 'https://achivon.app/dr_files/20250327105356_8-3818.DWG', '', 'sd_ho_lv5', 81, 0),
(355, 23, '', '20250327105402_8-3819.DWG', '2025-03-27 03:54:02', '116.06', 'AutoCAD File', 'https://achivon.app/dr_files/20250327105402_8-3819.DWG', '', 'sd_ho_lv5', 81, 0),
(356, 23, '', '20250327105411_8-3820.DWG', '2025-03-27 03:54:11', '178.4', 'AutoCAD File', 'https://achivon.app/dr_files/20250327105411_8-3820.DWG', '', 'sd_ho_lv5', 81, 0),
(357, 23, '', '20250327105419_Steel_Structure_Drawing.pdf', '2025-03-27 03:54:19', '41441.94', 'PDF Document', 'https://achivon.app/dr_files/20250327105419_Steel_Structure_Drawing.pdf', '', 'sd_ho_lv4', 91, 0),
(358, 23, '', '20250327105422_8-3821.DWG', '2025-03-27 03:54:22', '136.23', 'AutoCAD File', 'https://achivon.app/dr_files/20250327105422_8-3821.DWG', '', 'sd_ho_lv5', 81, 0),
(359, 23, '', '20250327105435_8-3822.DWG', '2025-03-27 03:54:35', '185.3', 'AutoCAD File', 'https://achivon.app/dr_files/20250327105435_8-3822.DWG', '', 'sd_ho_lv5', 81, 0),
(360, 23, '', '20250327105442_8-3823.DWG', '2025-03-27 03:54:42', '129.13', 'AutoCAD File', 'https://achivon.app/dr_files/20250327105442_8-3823.DWG', '', 'sd_ho_lv5', 81, 0),
(361, 23, '', '20250327105448_8-3824.DWG', '2025-03-27 03:54:48', '306.26', 'AutoCAD File', 'https://achivon.app/dr_files/20250327105448_8-3824.DWG', '', 'sd_ho_lv5', 81, 0),
(362, 23, '', '20250327114905_8-3825.DWG', '2025-03-27 04:49:05', '157.77', 'AutoCAD File', 'https://achivon.app/dr_files/20250327114905_8-3825.DWG', '', 'sd_ho_lv5', 81, 0),
(363, 23, '', '20250327114916_8-3826.DWG', '2025-03-27 04:49:16', '154.74', 'AutoCAD File', 'https://achivon.app/dr_files/20250327114916_8-3826.DWG', '', 'sd_ho_lv5', 81, 0),
(364, 23, '', '20250327114924_8-3827.DWG', '2025-03-27 04:49:24', '243.09', 'AutoCAD File', 'https://achivon.app/dr_files/20250327114924_8-3827.DWG', '', 'sd_ho_lv5', 81, 0),
(365, 23, '', '20250327114933_8-3850.DWG', '2025-03-27 04:49:33', '155.34', 'AutoCAD File', 'https://achivon.app/dr_files/20250327114933_8-3850.DWG', '', 'sd_ho_lv5', 81, 0),
(366, 23, '', '20250327114942_8-3851.DWG', '2025-03-27 04:49:42', '142.21', 'AutoCAD File', 'https://achivon.app/dr_files/20250327114942_8-3851.DWG', '', 'sd_ho_lv5', 81, 0),
(367, 23, '', '20250327114953_8-3852.DWG', '2025-03-27 04:49:53', '134.99', 'AutoCAD File', 'https://achivon.app/dr_files/20250327114953_8-3852.DWG', '', 'sd_ho_lv5', 81, 0),
(368, 23, '', '20250327115001_8-3853.DWG', '2025-03-27 04:50:01', '163.97', 'AutoCAD File', 'https://achivon.app/dr_files/20250327115001_8-3853.DWG', '', 'sd_ho_lv5', 81, 0),
(369, 23, '', '20250327115101_9-3901.DWG', '2025-03-27 04:51:01', '138.42', 'AutoCAD File', 'https://achivon.app/dr_files/20250327115101_9-3901.DWG', '', 'sd_ho_lv5', 84, 0),
(370, 23, '', '20250327115106_9-3902.DWG', '2025-03-27 04:51:06', '321.65', 'AutoCAD File', 'https://achivon.app/dr_files/20250327115106_9-3902.DWG', '', 'sd_ho_lv5', 84, 0),
(371, 23, '', '20250327115111_9-3903.DWG', '2025-03-27 04:51:11', '147.68', 'AutoCAD File', 'https://achivon.app/dr_files/20250327115111_9-3903.DWG', '', 'sd_ho_lv5', 84, 0),
(372, 23, '', '20250327115117_9-3904.DWG', '2025-03-27 04:51:17', '245.96', 'AutoCAD File', 'https://achivon.app/dr_files/20250327115117_9-3904.DWG', '', 'sd_ho_lv5', 84, 0),
(373, 23, '', '20250327115122_9-3905.DWG', '2025-03-27 04:51:22', '238.64', 'AutoCAD File', 'https://achivon.app/dr_files/20250327115122_9-3905.DWG', '', 'sd_ho_lv5', 84, 0),
(374, 23, '', '20250327115129_9-3906.DWG', '2025-03-27 04:51:29', '132.99', 'AutoCAD File', 'https://achivon.app/dr_files/20250327115129_9-3906.DWG', '', 'sd_ho_lv5', 84, 0),
(375, 23, '', '20250327115130_92C02400-1-1400-1_REV_05.dwg', '2025-03-27 04:51:30', '3382.91', 'AutoCAD File', 'https://achivon.app/dr_files/20250327115130_92C02400-1-1400-1_REV_05.dwg', '', 'sd_ho_lv6', 2, 0),
(376, 23, '', '20250327115136_9-3907.DWG', '2025-03-27 04:51:36', '134.33', 'AutoCAD File', 'https://achivon.app/dr_files/20250327115136_9-3907.DWG', '', 'sd_ho_lv5', 84, 0),
(377, 23, '', '20250327115142_9-3908.DWG', '2025-03-27 04:51:42', '217.77', 'AutoCAD File', 'https://achivon.app/dr_files/20250327115142_9-3908.DWG', '', 'sd_ho_lv5', 84, 0),
(378, 23, '', '20250327115145_92C02400-1-1401-1_REV_04.dwg', '2025-03-27 04:51:45', '4098.44', 'AutoCAD File', 'https://achivon.app/dr_files/20250327115145_92C02400-1-1401-1_REV_04.dwg', '', 'sd_ho_lv6', 2, 0),
(379, 23, '', '20250327115147_9-3909.DWG', '2025-03-27 04:51:47', '171.15', 'AutoCAD File', 'https://achivon.app/dr_files/20250327115147_9-3909.DWG', '', 'sd_ho_lv5', 84, 0),
(380, 23, '', '20250327115155_9-3912.DWG', '2025-03-27 04:51:55', '123.83', 'AutoCAD File', 'https://achivon.app/dr_files/20250327115155_9-3912.DWG', '', 'sd_ho_lv5', 84, 0),
(381, 23, '', '20250327115157_92C02400-1-1402-1_REV_04.dwg', '2025-03-27 04:51:57', '3434.89', 'AutoCAD File', 'https://achivon.app/dr_files/20250327115157_92C02400-1-1402-1_REV_04.dwg', '', 'sd_ho_lv6', 2, 0),
(382, 23, '', '20250327115205_9-3914.DWG', '2025-03-27 04:52:05', '596.03', 'AutoCAD File', 'https://achivon.app/dr_files/20250327115205_9-3914.DWG', '', 'sd_ho_lv5', 84, 0),
(383, 23, '', '20250327115213_92C02400-1-1403-1_REV_04.dwg', '2025-03-27 04:52:13', '4176.19', 'AutoCAD File', 'https://achivon.app/dr_files/20250327115213_92C02400-1-1403-1_REV_04.dwg', '', 'sd_ho_lv6', 2, 0),
(384, 23, '', '20250327115216_9-3915.DWG', '2025-03-27 04:52:16', '256.23', 'AutoCAD File', 'https://achivon.app/dr_files/20250327115216_9-3915.DWG', '', 'sd_ho_lv5', 84, 0),
(385, 23, '', '20250327115223_9-3950.DWG', '2025-03-27 04:52:23', '180.11', 'AutoCAD File', 'https://achivon.app/dr_files/20250327115223_9-3950.DWG', '', 'sd_ho_lv5', 84, 0),
(386, 23, '', '20250327115228_92C02400-1-1405-1_REV_03.dwg', '2025-03-27 04:52:28', '3862.66', 'AutoCAD File', 'https://achivon.app/dr_files/20250327115228_92C02400-1-1405-1_REV_03.dwg', '', 'sd_ho_lv6', 2, 0),
(387, 23, '', '20250327115230_9-3951.DWG', '2025-03-27 04:52:30', '191.16', 'AutoCAD File', 'https://achivon.app/dr_files/20250327115230_9-3951.DWG', '', 'sd_ho_lv5', 84, 0),
(388, 23, '', '20250327115237_9-3952.DWG', '2025-03-27 04:52:37', '627.82', 'AutoCAD File', 'https://achivon.app/dr_files/20250327115237_9-3952.DWG', '', 'sd_ho_lv5', 84, 0),
(389, 23, '', '20250327115249_92C02400-1-1406-1_REV_04.dwg', '2025-03-27 04:52:49', '4785.46', 'AutoCAD File', 'https://achivon.app/dr_files/20250327115249_92C02400-1-1406-1_REV_04.dwg', '', 'sd_ho_lv6', 2, 0),
(390, 23, '', '20250327115308_92C02400-1-1407-1_REV_03.dwg', '2025-03-27 04:53:08', '4449.42', 'AutoCAD File', 'https://achivon.app/dr_files/20250327115308_92C02400-1-1407-1_REV_03.dwg', '', 'sd_ho_lv6', 2, 0),
(391, 23, '', '20250327115355_92C02400-1-1409-1_REV_04.dwg', '2025-03-27 04:53:55', '4494.17', 'AutoCAD File', 'https://achivon.app/dr_files/20250327115355_92C02400-1-1409-1_REV_04.dwg', '', 'sd_ho_lv6', 2, 0),
(392, 23, '', '20250327115414_92C02400-1-1414-1_REV_04.dwg', '2025-03-27 04:54:14', '4711.27', 'AutoCAD File', 'https://achivon.app/dr_files/20250327115414_92C02400-1-1414-1_REV_04.dwg', '', 'sd_ho_lv6', 2, 0),
(393, 23, '', '20250327115434_92C02400-1-1415-1_REV_03.dwg', '2025-03-27 04:54:34', '4484.73', 'AutoCAD File', 'https://achivon.app/dr_files/20250327115434_92C02400-1-1415-1_REV_03.dwg', '', 'sd_ho_lv6', 2, 0),
(394, 23, '', '20250327115503_92C02400-1-1417-1_REV_04.dwg', '2025-03-27 04:55:03', '5719.79', 'AutoCAD File', 'https://achivon.app/dr_files/20250327115503_92C02400-1-1417-1_REV_04.dwg', '', 'sd_ho_lv6', 2, 0),
(395, 23, '', '20250327115519_92C02400-1-1419-1_REV_03.dwg', '2025-03-27 04:55:19', '3781.6', 'AutoCAD File', 'https://achivon.app/dr_files/20250327115519_92C02400-1-1419-1_REV_03.dwg', '', 'sd_ho_lv6', 2, 0),
(396, 23, '', '20250327115705_92C02400-1-1421-1_REV_03.dwg', '2025-03-27 04:57:05', '3995.57', 'AutoCAD File', 'https://achivon.app/dr_files/20250327115705_92C02400-1-1421-1_REV_03.dwg', '', 'sd_ho_lv6', 2, 0),
(397, 23, '', '20250327115722_92C02400-1-1422-1_REV_03.dwg', '2025-03-27 04:57:22', '3651.04', 'AutoCAD File', 'https://achivon.app/dr_files/20250327115722_92C02400-1-1422-1_REV_03.dwg', '', 'sd_ho_lv6', 2, 0),
(398, 23, '', '20250327115745_92C02400-1-1423-1_REV_04.dwg', '2025-03-27 04:57:45', '6232.65', 'AutoCAD File', 'https://achivon.app/dr_files/20250327115745_92C02400-1-1423-1_REV_04.dwg', '', 'sd_ho_lv6', 2, 0),
(399, 23, '', '20250327115801_92C02400-1-1424-1_REV_04.dwg', '2025-03-27 04:58:01', '4032.69', 'AutoCAD File', 'https://achivon.app/dr_files/20250327115801_92C02400-1-1424-1_REV_04.dwg', '', 'sd_ho_lv6', 2, 0),
(400, 23, '', '20250327115852_92C02400-1-1425-1_REV_03.dwg', '2025-03-27 04:58:52', '3780.83', 'AutoCAD File', 'https://achivon.app/dr_files/20250327115852_92C02400-1-1425-1_REV_03.dwg', '', 'sd_ho_lv6', 2, 0),
(401, 23, '', '20250327115852_92C02400-1-1425-1_REV_03.dwg', '2025-03-27 04:58:52', '3780.83', 'AutoCAD File', 'https://achivon.app/dr_files/20250327115852_92C02400-1-1425-1_REV_03.dwg', '', 'sd_ho_lv6', 2, 0),
(402, 23, '', '20250327115916_92C02400-1-1426-1_REV_04.dwg', '2025-03-27 04:59:16', '4163.64', 'AutoCAD File', 'https://achivon.app/dr_files/20250327115916_92C02400-1-1426-1_REV_04.dwg', '', 'sd_ho_lv6', 2, 0),
(403, 23, '', '20250327115937_92C02400-1-1427-1_REV_05.dwg', '2025-03-27 04:59:37', '4191.83', 'AutoCAD File', 'https://achivon.app/dr_files/20250327115937_92C02400-1-1427-1_REV_05.dwg', '', 'sd_ho_lv6', 2, 0),
(404, 23, '', '20250327115958_92C02400-1-1428-1_REV_04..dwg', '2025-03-27 04:59:58', '4023.33', 'AutoCAD File', 'https://achivon.app/dr_files/20250327115958_92C02400-1-1428-1_REV_04..dwg', '', 'sd_ho_lv6', 2, 0),
(405, 23, '', '20250327120017_92C02400-1-1429-1_REV_02.dwg', '2025-03-27 05:00:17', '5192.92', 'AutoCAD File', 'https://achivon.app/dr_files/20250327120017_92C02400-1-1429-1_REV_02.dwg', '', 'sd_ho_lv6', 2, 0),
(406, 23, '', '20250327120055_92C02400-1-1430-1_REV_04.dwg', '2025-03-27 05:00:55', '5104.69', 'AutoCAD File', 'https://achivon.app/dr_files/20250327120055_92C02400-1-1430-1_REV_04.dwg', '', 'sd_ho_lv6', 2, 0),
(407, 23, '', '20250327131246_PID_(Color_Marking)-_Old.pdf', '2025-06-16 10:06:22', '10771.29', 'PDF Document', 'https://achivon.app/dr_files/20250327131246_PID_%28Color_Marking%29-_Old.pdf', '', 'sd_ho_lv4', 91, 0),
(408, 23, '', '20250327131544_92C02400-1-1431-1_REV_03.dwg', '2025-03-27 06:15:44', '4878', 'AutoCAD File', 'https://achivon.app/dr_files/20250327131544_92C02400-1-1431-1_REV_03.dwg', '', 'sd_ho_lv6', 2, 0),
(409, 23, '', '20250327131559_MASTER_FILE_MATERIAL_LIST_with_PID_Pipe_Line_Marking_3-26-2025.xlsx', '2025-03-28 01:19:20', '4813.09', 'Excel Document', 'https://achivon.app/dr_files/20250327131559_MASTER_FILE_MATERIAL_LIST_with_PID_Pipe_Line_Marking_3-26-2025.xlsx', '', 'sd_ho_lv3', 142, 1),
(410, 23, '', '20250327131601_92C02400-1-1433-1_REV_04.dwg', '2025-03-27 06:16:01', '4269.47', 'AutoCAD File', 'https://achivon.app/dr_files/20250327131601_92C02400-1-1433-1_REV_04.dwg', '', 'sd_ho_lv6', 2, 0),
(411, 23, '', '20250327131630_92C02400-1-1434-1_REV_02.dwg', '2025-03-27 06:16:30', '12195.1', 'AutoCAD File', 'https://achivon.app/dr_files/20250327131630_92C02400-1-1434-1_REV_02.dwg', '', 'sd_ho_lv6', 2, 0),
(412, 23, '', '20250327131647_92C02400-1-1435-1_REV_03.dwg', '2025-03-27 06:16:47', '5073.36', 'AutoCAD File', 'https://achivon.app/dr_files/20250327131647_92C02400-1-1435-1_REV_03.dwg', '', 'sd_ho_lv6', 2, 0),
(413, 23, '', '20250327131701_92C02400-1-1436-1_REV_04.dwg', '2025-03-27 06:17:01', '3658.69', 'AutoCAD File', 'https://achivon.app/dr_files/20250327131701_92C02400-1-1436-1_REV_04.dwg', '', 'sd_ho_lv6', 2, 0),
(414, 23, '', '20250327131717_92C02400-1-1437-1_REV_04.dwg', '2025-03-27 06:17:17', '4859.41', 'AutoCAD File', 'https://achivon.app/dr_files/20250327131717_92C02400-1-1437-1_REV_04.dwg', '', 'sd_ho_lv6', 2, 0),
(415, 23, '', '20250327131731_92C02400-1-1438-1_REV_04.dwg', '2025-03-27 06:17:31', '3796.36', 'AutoCAD File', 'https://achivon.app/dr_files/20250327131731_92C02400-1-1438-1_REV_04.dwg', '', 'sd_ho_lv6', 2, 0),
(416, 23, '', '20250327131746_92C02400-1-1439-1_REV_03.dwg', '2025-03-27 06:17:46', '5868.91', 'AutoCAD File', 'https://achivon.app/dr_files/20250327131746_92C02400-1-1439-1_REV_03.dwg', '', 'sd_ho_lv6', 2, 0),
(417, 23, '', '20250327131801_92C02400-1-1440-1_REV_03.dwg', '2025-03-27 06:18:01', '3701.61', 'AutoCAD File', 'https://achivon.app/dr_files/20250327131801_92C02400-1-1440-1_REV_03.dwg', '', 'sd_ho_lv6', 2, 0),
(418, 23, '', '20250327131816_92C02400-1-1441-1_REV_03.dwg', '2025-03-27 06:18:16', '3601.04', 'AutoCAD File', 'https://achivon.app/dr_files/20250327131816_92C02400-1-1441-1_REV_03.dwg', '', 'sd_ho_lv6', 2, 0),
(419, 23, '', '20250327131829_92C02400-1-1442-1_REV_03.dwg', '2025-03-27 06:18:29', '4423.32', 'AutoCAD File', 'https://achivon.app/dr_files/20250327131829_92C02400-1-1442-1_REV_03.dwg', '', 'sd_ho_lv6', 2, 0),
(420, 23, '', '20250327131844_92C02400-1-1450-1_REV_04.dwg', '2025-03-27 06:18:44', '3866.1', 'AutoCAD File', 'https://achivon.app/dr_files/20250327131844_92C02400-1-1450-1_REV_04.dwg', '', 'sd_ho_lv6', 2, 0),
(421, 23, '', '20250327131856_92C02400-1-1451-1_REV_03.dwg', '2025-03-27 06:18:56', '3946.98', 'AutoCAD File', 'https://achivon.app/dr_files/20250327131856_92C02400-1-1451-1_REV_03.dwg', '', 'sd_ho_lv6', 2, 0),
(422, 23, '', '20250327131908_92C02400-1-1452-1_REV_03.dwg', '2025-03-27 06:19:08', '4104.96', 'AutoCAD File', 'https://achivon.app/dr_files/20250327131908_92C02400-1-1452-1_REV_03.dwg', '', 'sd_ho_lv6', 2, 0),
(423, 23, '', '20250327131933_92C02400-1-1453-1_REV_03.dwg', '2025-03-27 06:19:33', '13175.48', 'AutoCAD File', 'https://achivon.app/dr_files/20250327131933_92C02400-1-1453-1_REV_03.dwg', '', 'sd_ho_lv6', 2, 0),
(424, 23, '', '20250327131953_92C02400-1-1454-1_REV_04.dwg', '2025-03-27 06:19:53', '5879.69', 'AutoCAD File', 'https://achivon.app/dr_files/20250327131953_92C02400-1-1454-1_REV_04.dwg', '', 'sd_ho_lv6', 2, 0),
(425, 23, '', '20250327132006_92C02400-1-1455-1_REV_04.dwg', '2025-03-27 06:20:06', '4364.14', 'AutoCAD File', 'https://achivon.app/dr_files/20250327132006_92C02400-1-1455-1_REV_04.dwg', '', 'sd_ho_lv6', 2, 0),
(426, 23, '', '20250327132036_92C02400-1-1456-1_REV.06.dwg', '2025-03-27 06:20:36', '13789.43', 'AutoCAD File', 'https://achivon.app/dr_files/20250327132036_92C02400-1-1456-1_REV.06.dwg', '', 'sd_ho_lv6', 2, 0),
(427, 23, '', '20250327132104_92C02400-1-1457-1_REV_06.dwg', '2025-03-27 06:21:04', '5035.29', 'AutoCAD File', 'https://achivon.app/dr_files/20250327132104_92C02400-1-1457-1_REV_06.dwg', '', 'sd_ho_lv6', 2, 0),
(428, 23, '', '20250327132118_92C02400-1-1458-1_REV_05.dwg', '2025-03-27 06:21:18', '4576.84', 'AutoCAD File', 'https://achivon.app/dr_files/20250327132118_92C02400-1-1458-1_REV_05.dwg', '', 'sd_ho_lv6', 2, 0),
(429, 23, '', '20250327132133_92C02400-1-1459-1_REV_04.dwg', '2025-03-27 06:21:33', '3784.5', 'AutoCAD File', 'https://achivon.app/dr_files/20250327132133_92C02400-1-1459-1_REV_04.dwg', '', 'sd_ho_lv6', 2, 0),
(430, 23, '', '20250327132148_92C02400-1-1460-1_REV_03.dwg', '2025-03-27 06:21:48', '4873.44', 'AutoCAD File', 'https://achivon.app/dr_files/20250327132148_92C02400-1-1460-1_REV_03.dwg', '', 'sd_ho_lv6', 2, 0),
(431, 23, '', '20250327132219_92C02400-1-1461-1_REV_03.dwg', '2025-03-27 06:22:19', '14274.86', 'AutoCAD File', 'https://achivon.app/dr_files/20250327132219_92C02400-1-1461-1_REV_03.dwg', '', 'sd_ho_lv6', 2, 0),
(432, 23, '', '20250327132235_92C02400-1-1462-1_REV_05.dwg', '2025-03-27 06:22:35', '5210.97', 'AutoCAD File', 'https://achivon.app/dr_files/20250327132235_92C02400-1-1462-1_REV_05.dwg', '', 'sd_ho_lv6', 2, 0),
(433, 23, '', '20250327132255_92C02400-1-1463-1_REV_02.dwg', '2025-03-27 06:22:55', '5067.79', 'AutoCAD File', 'https://achivon.app/dr_files/20250327132255_92C02400-1-1463-1_REV_02.dwg', '', 'sd_ho_lv6', 2, 0),
(434, 23, '', '20250327132330_92C02400-1-1470-1_REV_03.dwg', '2025-03-27 06:23:30', '15054.19', 'AutoCAD File', 'https://achivon.app/dr_files/20250327132330_92C02400-1-1470-1_REV_03.dwg', '', 'sd_ho_lv6', 2, 0),
(435, 23, '', '20250327132347_92C02400-1-1475-1_REV_05.dwg', '2025-03-27 06:23:47', '4587.3', 'AutoCAD File', 'https://achivon.app/dr_files/20250327132347_92C02400-1-1475-1_REV_05.dwg', '', 'sd_ho_lv6', 2, 0),
(436, 23, '', '20250327132400_92C02400-1-1481-1_REV_03.dwg', '2025-03-27 06:24:00', '4665.57', 'AutoCAD File', 'https://achivon.app/dr_files/20250327132400_92C02400-1-1481-1_REV_03.dwg', '', 'sd_ho_lv6', 2, 0),
(437, 23, '', '20250327132412_92C02400-1-1501-1_REV_04.dwg', '2025-03-27 06:24:12', '3529.76', 'AutoCAD File', 'https://achivon.app/dr_files/20250327132412_92C02400-1-1501-1_REV_04.dwg', '', 'sd_ho_lv6', 2, 0),
(438, 23, '', '20250327132651_Piping_Material_List_Summary_(20250327).xlsx', '2025-03-27 06:26:51', '4813.26', 'Excel Document', 'https://achivon.app/dr_files/20250327132651_Piping_Material_List_Summary_%2820250327%29.xlsx', '', 'sd_ho_lv3', 247, 0),
(439, 23, '', '20250327133118_PID_(Color_Marking)-_Old.pdf', '2025-06-16 10:06:22', '10771.29', 'PDF Document', 'https://achivon.app/dr_files/20250327133118_PID_%28Color_Marking%29-_Old.pdf', '', 'sd_ho_lv6', 5, 0),
(440, 23, '', '20250327133529_Z921SE-2D1-1-PID-1400-R1.1_PID_-_Legend.DWG', '2025-03-27 06:35:29', '157.44', 'AutoCAD File', 'https://achivon.app/dr_files/20250327133529_Z921SE-2D1-1-PID-1400-R1.1_PID_-_Legend.DWG', '', 'sd_ho_lv6', 3, 0),
(441, 23, '', '20250327133539_Z921SE-2D1-1-PID-1401-R1.1_PID_-_Brine_Preparation.dwg', '2025-03-27 06:35:39', '201.8', 'AutoCAD File', 'https://achivon.app/dr_files/20250327133539_Z921SE-2D1-1-PID-1401-R1.1_PID_-_Brine_Preparation.dwg', '', 'sd_ho_lv6', 3, 0),
(442, 23, '', '20250327133545_Z921SE-2D1-1-PID-1402-R1.1_PID_-_Brine_Clarifier.dwg', '2025-03-27 06:35:45', '264.66', 'AutoCAD File', 'https://achivon.app/dr_files/20250327133545_Z921SE-2D1-1-PID-1402-R1.1_PID_-_Brine_Clarifier.dwg', '', 'sd_ho_lv6', 3, 0),
(443, 23, '', '20250327133553_Z921SE-2D1-1-PID-1403-R1.1_PID_-_Brine_Filtration.DWG', '2025-03-27 06:35:53', '153.06', 'AutoCAD File', 'https://achivon.app/dr_files/20250327133553_Z921SE-2D1-1-PID-1403-R1.1_PID_-_Brine_Filtration.DWG', '', 'sd_ho_lv6', 3, 0),
(444, 23, '', '20250327133607_Z921SE-2D1-1-PID-1404-R1.1_PID_-_Secondary_Brine_Treatment.dwg', '2025-03-27 06:36:07', '354.12', 'AutoCAD File', 'https://achivon.app/dr_files/20250327133607_Z921SE-2D1-1-PID-1404-R1.1_PID_-_Secondary_Brine_Treatment.dwg', '', 'sd_ho_lv6', 3, 0),
(445, 23, '', '20250327133616_Z921SE-2D1-1-PID-1405-R1.1_PID_-_Deionized_Brine_Storage.dwg', '2025-03-27 06:36:16', '192.89', 'AutoCAD File', 'https://achivon.app/dr_files/20250327133616_Z921SE-2D1-1-PID-1405-R1.1_PID_-_Deionized_Brine_Storage.dwg', '', 'sd_ho_lv6', 3, 0),
(446, 23, '', '20250327133625_Z921SE-2D1-1-PID-1406-R1.1_PID_-_cell_room.dwg', '2025-03-27 06:36:25', '367.39', 'AutoCAD File', 'https://achivon.app/dr_files/20250327133625_Z921SE-2D1-1-PID-1406-R1.1_PID_-_cell_room.dwg', '', 'sd_ho_lv6', 3, 0),
(447, 23, '', '20250327133626_Z921SE-2D1-1-PID-1400-R1.1_PID_-_Legend.PDF', '2025-03-27 06:36:26', '270.04', 'PDF Document', 'https://achivon.app/dr_files/20250327133626_Z921SE-2D1-1-PID-1400-R1.1_PID_-_Legend.PDF', '', 'sd_ho_lv6', 6, 0),
(448, 23, '', '20250327133634_Z921SE-2D1-1-PID-1415-R1.1_PID_-_Weak_Brine_and_Chlorine.dwg', '2025-03-27 06:36:34', '171.97', 'AutoCAD File', 'https://achivon.app/dr_files/20250327133634_Z921SE-2D1-1-PID-1415-R1.1_PID_-_Weak_Brine_and_Chlorine.dwg', '', 'sd_ho_lv6', 3, 0),
(449, 23, '', '20250327133636_Z921SE-2D1-1-PID-1401-R1.1_PID_-_Brine_Preparation.PDF', '2025-03-27 06:36:36', '177.07', 'PDF Document', 'https://achivon.app/dr_files/20250327133636_Z921SE-2D1-1-PID-1401-R1.1_PID_-_Brine_Preparation.PDF', '', 'sd_ho_lv6', 6, 0),
(450, 23, '', '20250327133641_Z921SE-2D1-1-PID-1417-R1.1_PID_-_Catholyte__Hydrogen.dwg', '2025-06-16 10:06:22', '205.36', 'AutoCAD File', 'https://achivon.app/dr_files/20250327133641_Z921SE-2D1-1-PID-1417-R1.1_PID_-_Catholyte__Hydrogen.dwg', '', 'sd_ho_lv6', 3, 0),
(451, 23, '', '20250327133645_Z921SE-2D1-1-PID-1402-R1.1_PID_-_Brine_Clarifier.PDF', '2025-03-27 06:36:45', '205.12', 'PDF Document', 'https://achivon.app/dr_files/20250327133645_Z921SE-2D1-1-PID-1402-R1.1_PID_-_Brine_Clarifier.PDF', '', 'sd_ho_lv6', 6, 0),
(452, 23, '', '20250327133652_Z921SE-2D1-1-PID-1403-R1.1_PID_-_Brine_Filtration.PDF', '2025-03-27 06:36:52', '175.62', 'PDF Document', 'https://achivon.app/dr_files/20250327133652_Z921SE-2D1-1-PID-1403-R1.1_PID_-_Brine_Filtration.PDF', '', 'sd_ho_lv6', 6, 0),
(453, 23, '', '20250327133654_Z921SE-2D1-1-PID-1419-R1.1_PID_-_Brine_Dechlorination.dwg', '2025-03-27 06:36:54', '200.14', 'AutoCAD File', 'https://achivon.app/dr_files/20250327133654_Z921SE-2D1-1-PID-1419-R1.1_PID_-_Brine_Dechlorination.dwg', '', 'sd_ho_lv6', 3, 0),
(454, 23, '', '20250327133659_Z921SE-2D1-1-PID-1404-R1.1_PID_-_Secondary_Brine_Treatment.PDF', '2025-03-27 06:36:59', '133.41', 'PDF Document', 'https://achivon.app/dr_files/20250327133659_Z921SE-2D1-1-PID-1404-R1.1_PID_-_Secondary_Brine_Treatment.PDF', '', 'sd_ho_lv6', 6, 0),
(455, 23, '', '20250327133707_Z921SE-2D1-1-PID-1421-R1.1_PID_-_Chlorine_cooling.dwg', '2025-03-27 06:37:07', '139.53', 'AutoCAD File', 'https://achivon.app/dr_files/20250327133707_Z921SE-2D1-1-PID-1421-R1.1_PID_-_Chlorine_cooling.dwg', '', 'sd_ho_lv6', 3, 0),
(456, 23, '', '20250327133710_Z921SE-2D1-1-PID-1405-R1.1_PID_-_Deionized_Brine_Storage.PDF', '2025-03-27 06:37:10', '185.82', 'PDF Document', 'https://achivon.app/dr_files/20250327133710_Z921SE-2D1-1-PID-1405-R1.1_PID_-_Deionized_Brine_Storage.PDF', '', 'sd_ho_lv6', 6, 0),
(457, 23, '', '20250327133716_Z921SE-2D1-1-PID-1426-R1.1_PID_-_Sodium_Hypochlorite.dwg', '2025-03-27 06:37:16', '371.54', 'AutoCAD File', 'https://achivon.app/dr_files/20250327133716_Z921SE-2D1-1-PID-1426-R1.1_PID_-_Sodium_Hypochlorite.dwg', '', 'sd_ho_lv6', 3, 0),
(458, 23, '', '20250327133723_Z921SE-2D1-1-PID-1427-R1.1_PID_-_Caustic_Storage__Dilution.dwg', '2025-06-16 10:06:22', '292.36', 'AutoCAD File', 'https://achivon.app/dr_files/20250327133723_Z921SE-2D1-1-PID-1427-R1.1_PID_-_Caustic_Storage__Dilution.dwg', '', 'sd_ho_lv6', 3, 0),
(459, 23, '', '20250327133724_Z921SE-2D1-1-PID-1406-R1.1_PID_-_cell_room.PDF', '2025-03-27 06:37:24', '241.85', 'PDF Document', 'https://achivon.app/dr_files/20250327133724_Z921SE-2D1-1-PID-1406-R1.1_PID_-_cell_room.PDF', '', 'sd_ho_lv6', 6, 0),
(460, 23, '', '20250327133730_Z921SE-2D1-1-PID-1428-R1.1_PID_-_H2SO4_Storage.dwg', '2025-03-27 06:37:30', '226.55', 'AutoCAD File', 'https://achivon.app/dr_files/20250327133730_Z921SE-2D1-1-PID-1428-R1.1_PID_-_H2SO4_Storage.dwg', '', 'sd_ho_lv6', 3, 0),
(461, 23, '', '20250327133732_Z921SE-2D1-1-PID-1415-R1.1_PID_-_Weak_Brine_and_Chlorine.PDF', '2025-03-27 06:37:32', '197.68', 'PDF Document', 'https://achivon.app/dr_files/20250327133732_Z921SE-2D1-1-PID-1415-R1.1_PID_-_Weak_Brine_and_Chlorine.PDF', '', 'sd_ho_lv6', 6, 0),
(462, 23, '', '20250327133738_Z921SE-2D1-1-PID-1429-R1.1_PID_-_Sodium_Carbonate_Tanks.dwg', '2025-03-27 06:37:38', '119.01', 'AutoCAD File', 'https://achivon.app/dr_files/20250327133738_Z921SE-2D1-1-PID-1429-R1.1_PID_-_Sodium_Carbonate_Tanks.dwg', '', 'sd_ho_lv6', 3, 0),
(463, 23, '', '20250327133746_Z921SE-2D1-1-PID-1417-R1.1_PID_-_Catholyte__Hydrogen.PDF', '2025-06-16 10:07:25', '258.15', 'PDF Document', 'https://achivon.app/dr_files/20250327133746_Z921SE-2D1-1-PID-1417-R1.1_PID_-_Catholyte__Hydrogen.PDF', '', 'sd_ho_lv6', 6, 0),
(464, 23, '', '20250327133746_Z921SE-2D1-1-PID-1427-R1.1_PID_-_Caustic_Storage__Dilution.dwg', '2025-06-16 10:07:25', '292.36', 'AutoCAD File', 'https://achivon.app/dr_files/20250327133746_Z921SE-2D1-1-PID-1427-R1.1_PID_-_Caustic_Storage__Dilution.dwg', '', 'sd_ho_lv6', 3, 0),
(465, 23, '', '20250327133756_Z921SE-2D1-1-PID-1419-R1.1_PID_-_Brine_Dechlorination.PDF', '2025-03-27 06:37:56', '171.49', 'PDF Document', 'https://achivon.app/dr_files/20250327133756_Z921SE-2D1-1-PID-1419-R1.1_PID_-_Brine_Dechlorination.PDF', '', 'sd_ho_lv6', 6, 0),
(466, 23, '', '20250327133802_Z921SE-2D1-1-PID-1428-R1.1_PID_-_H2SO4_Storage.dwg', '2025-03-27 06:38:02', '226.55', 'AutoCAD File', 'https://achivon.app/dr_files/20250327133802_Z921SE-2D1-1-PID-1428-R1.1_PID_-_H2SO4_Storage.dwg', '', 'sd_ho_lv6', 3, 0),
(467, 23, '', '20250327133805_Z921SE-2D1-1-PID-1421-R1.1_PID_-_Chlorine_cooling.PDF', '2025-03-27 06:38:05', '185.79', 'PDF Document', 'https://achivon.app/dr_files/20250327133805_Z921SE-2D1-1-PID-1421-R1.1_PID_-_Chlorine_cooling.PDF', '', 'sd_ho_lv6', 6, 0),
(468, 23, '', '20250327133819_Z921SE-2D1-1-PID-1426-R1.1_PID_-_Sodium_Hypochlorite.PDF', '2025-03-27 06:38:19', '285.71', 'PDF Document', 'https://achivon.app/dr_files/20250327133819_Z921SE-2D1-1-PID-1426-R1.1_PID_-_Sodium_Hypochlorite.PDF', '', 'sd_ho_lv6', 6, 0),
(469, 23, '', '20250327133828_Z921SE-2D1-1-PID-1429-R1.1_PID_-_Sodium_Carbonate_Tanks.dwg', '2025-03-27 06:38:28', '119.01', 'AutoCAD File', 'https://achivon.app/dr_files/20250327133828_Z921SE-2D1-1-PID-1429-R1.1_PID_-_Sodium_Carbonate_Tanks.dwg', '', 'sd_ho_lv6', 3, 0),
(470, 23, '', '20250327143238_Z921SE-2D1-1-PID-1427-R1.1_PID_-_Caustic_Storage__Dilution.PDF', '2025-06-16 10:07:25', '248.42', 'PDF Document', 'https://achivon.app/dr_files/20250327143238_Z921SE-2D1-1-PID-1427-R1.1_PID_-_Caustic_Storage__Dilution.PDF', '', 'sd_ho_lv6', 6, 0),
(471, 23, '', '20250327143246_Z921SE-2D1-1-PID-1428-R1.1_PID_-_H2SO4_Storage.PDF', '2025-03-27 07:32:46', '174.61', 'PDF Document', 'https://achivon.app/dr_files/20250327143246_Z921SE-2D1-1-PID-1428-R1.1_PID_-_H2SO4_Storage.PDF', '', 'sd_ho_lv6', 6, 0),
(472, 23, '', '20250327143255_Z921SE-2D1-1-PID-1429-R1.1_PID_-_Sodium_Carbonate_Tanks.PDF', '2025-03-27 07:32:55', '103.46', 'PDF Document', 'https://achivon.app/dr_files/20250327143255_Z921SE-2D1-1-PID-1429-R1.1_PID_-_Sodium_Carbonate_Tanks.PDF', '', 'sd_ho_lv6', 6, 0),
(473, 23, '', '20250327143307_Z921SE-2D1-1-PID-1430-R1.1_PID_-_CA_TransformerRectifier.PDF', '2025-03-27 07:33:07', '142.49', 'PDF Document', 'https://achivon.app/dr_files/20250327143307_Z921SE-2D1-1-PID-1430-R1.1_PID_-_CA_TransformerRectifier.PDF', '', 'sd_ho_lv6', 6, 0),
(474, 23, '', '20250327143316_Z921SE-2D1-1-PID-1431-R1.1_PID_-_Floor_Drain.PDF', '2025-03-27 07:33:16', '135.11', 'PDF Document', 'https://achivon.app/dr_files/20250327143316_Z921SE-2D1-1-PID-1431-R1.1_PID_-_Floor_Drain.PDF', '', 'sd_ho_lv6', 6, 0),
(475, 23, '', '20250327143330_Z921SE-2D1-1-PID-1433-R1.1_PID_-_Cooling_water.PDF', '2025-03-27 07:33:30', '234.53', 'PDF Document', 'https://achivon.app/dr_files/20250327143330_Z921SE-2D1-1-PID-1433-R1.1_PID_-_Cooling_water.PDF', '', 'sd_ho_lv6', 6, 0),
(476, 23, '', '20250327143337_Z921SE-2D1-1-PID-1434-R1.1_PID_-_Demineralized_Water.PDF', '2025-03-27 07:33:37', '188.28', 'PDF Document', 'https://achivon.app/dr_files/20250327143337_Z921SE-2D1-1-PID-1434-R1.1_PID_-_Demineralized_Water.PDF', '', 'sd_ho_lv6', 6, 0),
(477, 23, '', '20250327143351_Z921SE-2D1-1-PID-1435-R1.1_PID_-_Chilled_Water_Distribution.PDF', '2025-03-27 07:33:51', '119.19', 'PDF Document', 'https://achivon.app/dr_files/20250327143351_Z921SE-2D1-1-PID-1435-R1.1_PID_-_Chilled_Water_Distribution.PDF', '', 'sd_ho_lv6', 6, 0),
(478, 23, '', '20250327143401_Z921SE-2D1-1-PID-1436-R1.1_PID_-_Fire_Water_and_Potable_water.PDF', '2025-03-27 07:34:01', '207.18', 'PDF Document', 'https://achivon.app/dr_files/20250327143401_Z921SE-2D1-1-PID-1436-R1.1_PID_-_Fire_Water_and_Potable_water.PDF', '', 'sd_ho_lv6', 6, 0),
(479, 23, '', '20250327143409_Z921SE-2D1-1-PID-1437-R1.1_PID_-_Steam__Condensate.PDF', '2025-06-16 10:07:25', '219.53', 'PDF Document', 'https://achivon.app/dr_files/20250327143409_Z921SE-2D1-1-PID-1437-R1.1_PID_-_Steam__Condensate.PDF', '', 'sd_ho_lv6', 6, 0),
(480, 23, '', '20250327143417_Z921SE-2D1-1-PID-1438-R1.1_PID_-_Nitrogen__Oxygen.PDF', '2025-06-16 10:07:25', '177.83', 'PDF Document', 'https://achivon.app/dr_files/20250327143417_Z921SE-2D1-1-PID-1438-R1.1_PID_-_Nitrogen__Oxygen.PDF', '', 'sd_ho_lv6', 6, 0),
(481, 23, '', '20250327143426_Z921SE-2D1-1-PID-1439-R1.1_PID_-_Mill_Air.PDF', '2025-03-27 07:34:26', '169.85', 'PDF Document', 'https://achivon.app/dr_files/20250327143426_Z921SE-2D1-1-PID-1439-R1.1_PID_-_Mill_Air.PDF', '', 'sd_ho_lv6', 6, 0),
(482, 23, '', '20250327143445_Z921SE-2D1-1-PID-1440-R1.1_PID_-_Instrument_Air.PDF', '2025-03-27 07:34:45', '197.42', 'PDF Document', 'https://achivon.app/dr_files/20250327143445_Z921SE-2D1-1-PID-1440-R1.1_PID_-_Instrument_Air.PDF', '', 'sd_ho_lv6', 6, 0),
(483, 23, '', '20250327143458_Z921SE-2D1-1-PID-1441-R1.1_PID_-_Pump_Seal_Water__Ambient_Air_Monitors.PDF', '2025-06-16 10:25:39', '194.95', 'PDF Document', 'https://achivon.app/dr_files/20250327143458_Z921SE-2D1-1-PID-1441-R1.1_PID_-_Pump_Seal_Water__Ambient_Air_Monitors.PDF', '', 'sd_ho_lv6', 6, 0),
(484, 23, '', '20250327143508_Z921SE-2D1-1-PID-1442-R1.1_PID_-_Hot_and_cold_mill_water.PDF', '2025-03-27 07:35:08', '263.11', 'PDF Document', 'https://achivon.app/dr_files/20250327143508_Z921SE-2D1-1-PID-1442-R1.1_PID_-_Hot_and_cold_mill_water.PDF', '', 'sd_ho_lv6', 6, 0),
(485, 23, '', '20250327143527_Z921SE-2D1-1-PID-1450-R1.1_PID_-_Chlorate_Electrolyzer_Reactor.PDF', '2025-03-27 07:35:27', '225.94', 'PDF Document', 'https://achivon.app/dr_files/20250327143527_Z921SE-2D1-1-PID-1450-R1.1_PID_-_Chlorate_Electrolyzer_Reactor.PDF', '', 'sd_ho_lv6', 6, 0),
(486, 23, '', '20250327143538_Z921SE-2D1-1-PID-1451-R1.1_PID_-_Chlorate_Electrolyzer_Reactor.PDF', '2025-03-27 07:35:38', '143.89', 'PDF Document', 'https://achivon.app/dr_files/20250327143538_Z921SE-2D1-1-PID-1451-R1.1_PID_-_Chlorate_Electrolyzer_Reactor.PDF', '', 'sd_ho_lv6', 6, 0),
(487, 23, '', '20250327143544_Z921SE-2D1-1-PID-1452-R1.1_PID_-_Strong_Chlorate_Holding.PDF', '2025-03-27 07:35:44', '181.18', 'PDF Document', 'https://achivon.app/dr_files/20250327143544_Z921SE-2D1-1-PID-1452-R1.1_PID_-_Strong_Chlorate_Holding.PDF', '', 'sd_ho_lv6', 6, 0),
(488, 23, '', '20250327143551_Z921SE-2D1-1-PID-1453-R1.1_PID_-_Strong_Chlorate_filters.PDF', '2025-03-27 07:35:51', '161.05', 'PDF Document', 'https://achivon.app/dr_files/20250327143551_Z921SE-2D1-1-PID-1453-R1.1_PID_-_Strong_Chlorate_filters.PDF', '', 'sd_ho_lv6', 6, 0),
(489, 23, '', '20250327143615_Z921SE-2D1-1-PID-1454-R1.1_PID_-_Chlorine_Dioxide_Production.PDF', '2025-03-27 07:36:15', '322.23', 'PDF Document', 'https://achivon.app/dr_files/20250327143615_Z921SE-2D1-1-PID-1454-R1.1_PID_-_Chlorine_Dioxide_Production.PDF', '', 'sd_ho_lv6', 6, 0),
(490, 23, '', '20250327143622_Z921SE-2D1-1-PID-1455-R1.1_PID_-_Chlorine_Dioxide_Production.PDF', '2025-03-27 07:36:22', '244.82', 'PDF Document', 'https://achivon.app/dr_files/20250327143622_Z921SE-2D1-1-PID-1455-R1.1_PID_-_Chlorine_Dioxide_Production.PDF', '', 'sd_ho_lv6', 6, 0),
(491, 23, '', '20250327143631_Z921SE-2D1-1-PID-1456-R1.1_PID_-_Hydrogen_Demister__Acid_Sump.PDF', '2025-06-16 10:25:39', '345.67', 'PDF Document', 'https://achivon.app/dr_files/20250327143631_Z921SE-2D1-1-PID-1456-R1.1_PID_-_Hydrogen_Demister__Acid_Sump.PDF', '', 'sd_ho_lv6', 6, 0),
(492, 23, '', '20250327143638_Z921SE-2D1-1-PID-1457-R1.1_PID_-_HCL_Synthesis_Unit.PDF', '2025-03-27 07:36:38', '337.35', 'PDF Document', 'https://achivon.app/dr_files/20250327143638_Z921SE-2D1-1-PID-1457-R1.1_PID_-_HCL_Synthesis_Unit.PDF', '', 'sd_ho_lv6', 6, 0),
(493, 23, '', '20250327143647_Z921SE-2D1-1-PID-1458-R1.1_PID_-_HCL_Storage.PDF', '2025-03-27 07:36:47', '252.62', 'PDF Document', 'https://achivon.app/dr_files/20250327143647_Z921SE-2D1-1-PID-1458-R1.1_PID_-_HCL_Storage.PDF', '', 'sd_ho_lv6', 6, 0),
(494, 23, '', '20250327143708_Z921SE-2D1-1-PID-1459-R1.1_PID_-_Hydrogen_Scrubbing_and_Hypo.PDF', '2025-03-27 07:37:08', '193.71', 'PDF Document', 'https://achivon.app/dr_files/20250327143708_Z921SE-2D1-1-PID-1459-R1.1_PID_-_Hydrogen_Scrubbing_and_Hypo.PDF', '', 'sd_ho_lv6', 6, 0),
(495, 23, '', '20250327143725_Z921SE-2D1-1-PID-1460-R1.1_PID_-_Chlorine_Dioxide_Storage.PDF', '2025-03-27 07:37:25', '194.88', 'PDF Document', 'https://achivon.app/dr_files/20250327143725_Z921SE-2D1-1-PID-1460-R1.1_PID_-_Chlorine_Dioxide_Storage.PDF', '', 'sd_ho_lv6', 6, 0),
(496, 23, '', '20250327143731_Z921SE-2D1-1-PID-1461-R1.1_PID_-_Chilled_Water_System.PDF', '2025-03-27 07:37:31', '224.41', 'PDF Document', 'https://achivon.app/dr_files/20250327143731_Z921SE-2D1-1-PID-1461-R1.1_PID_-_Chilled_Water_System.PDF', '', 'sd_ho_lv6', 6, 0),
(497, 23, '', '20250327143738_Z921SE-2D1-1-PID-1462-R1.1_PID_-_CLO2_Transformer__Reactifier.PDF', '2025-03-27 07:37:38', '126.48', 'PDF Document', 'https://achivon.app/dr_files/20250327143738_Z921SE-2D1-1-PID-1462-R1.1_PID_-_CLO2_Transformer__Reactifier.PDF', '', 'sd_ho_lv6', 6, 0),
(498, 23, '', '20250327143808_Z921SE-2D1-1-PID-1463-R1.1_PID_-_Floor_Drain.PDF', '2025-03-27 07:38:08', '122.71', 'PDF Document', 'https://achivon.app/dr_files/20250327143808_Z921SE-2D1-1-PID-1463-R1.1_PID_-_Floor_Drain.PDF', '', 'sd_ho_lv6', 6, 0),
(499, 23, '', '20250327145144_42-2-0274001.dwg', '2025-03-27 07:51:44', '598', 'AutoCAD File', 'https://achivon.app/dr_files/20250327145144_42-2-0274001.dwg', '', 'sd_ho_lv7', 2, 0),
(500, 23, '', '20250327145153_42-2-0275001.dwg', '2025-03-27 07:51:53', '621.14', 'AutoCAD File', 'https://achivon.app/dr_files/20250327145153_42-2-0275001.dwg', '', 'sd_ho_lv7', 2, 0),
(501, 23, '', '20250327145201_42-8-0286001.dwg', '2025-03-27 07:52:01', '618.5', 'AutoCAD File', 'https://achivon.app/dr_files/20250327145201_42-8-0286001.dwg', '', 'sd_ho_lv7', 2, 0),
(502, 23, '', '20250327145209_42-9-0285001.dwg', '2025-03-27 07:52:09', '619.94', 'AutoCAD File', 'https://achivon.app/dr_files/20250327145209_42-9-0285001.dwg', '', 'sd_ho_lv7', 2, 0),
(503, 23, '', '20250327145252_42-1-0017G001.dwg', '2025-03-27 07:52:52', '799.98', 'AutoCAD File', 'https://achivon.app/dr_files/20250327145252_42-1-0017G001.dwg', '', 'sd_ho_lv7', 3, 0),
(504, 23, '', '20250327145306_42-1-0017H001.dwg', '2025-03-27 07:53:06', '675.47', 'AutoCAD File', 'https://achivon.app/dr_files/20250327145306_42-1-0017H001.dwg', '', 'sd_ho_lv7', 3, 0),
(505, 23, '', '20250327145317_42-1-3000001.dwg', '2025-03-27 07:53:17', '704.02', 'AutoCAD File', 'https://achivon.app/dr_files/20250327145317_42-1-3000001.dwg', '', 'sd_ho_lv7', 3, 0),
(506, 23, '', '20250327145337_42-2-0150E001.dwg', '2025-03-27 07:53:37', '736.33', 'AutoCAD File', 'https://achivon.app/dr_files/20250327145337_42-2-0150E001.dwg', '', 'sd_ho_lv7', 3, 0),
(507, 23, '', '20250327145410_42-2-0150E002.dwg', '2025-03-27 07:54:10', '620.16', 'AutoCAD File', 'https://achivon.app/dr_files/20250327145410_42-2-0150E002.dwg', '', 'sd_ho_lv7', 3, 0),
(508, 23, '', '20250327145428_42-2-0150E003.dwg', '2025-03-27 07:54:28', '634.6', 'AutoCAD File', 'https://achivon.app/dr_files/20250327145428_42-2-0150E003.dwg', '', 'sd_ho_lv7', 3, 0),
(509, 23, '', '20250327145444_42-2-0150E004.dwg', '2025-03-27 07:54:44', '649.32', 'AutoCAD File', 'https://achivon.app/dr_files/20250327145444_42-2-0150E004.dwg', '', 'sd_ho_lv7', 3, 0),
(510, 23, '', '20250327145455_42-2-0150E005.dwg', '2025-03-27 07:54:55', '638.74', 'AutoCAD File', 'https://achivon.app/dr_files/20250327145455_42-2-0150E005.dwg', '', 'sd_ho_lv7', 3, 0),
(511, 23, '', '20250327145514_42-2-0150F001.dwg', '2025-03-27 07:55:14', '654.03', 'AutoCAD File', 'https://achivon.app/dr_files/20250327145514_42-2-0150F001.dwg', '', 'sd_ho_lv7', 3, 0),
(512, 23, '', '20250327145557_42-2-0210001.dwg', '2025-03-27 07:55:57', '692.43', 'AutoCAD File', 'https://achivon.app/dr_files/20250327145557_42-2-0210001.dwg', '', 'sd_ho_lv7', 3, 0),
(513, 23, '', '20250327145608_42-2-0210002.dwg', '2025-03-27 07:56:08', '687.74', 'AutoCAD File', 'https://achivon.app/dr_files/20250327145608_42-2-0210002.dwg', '', 'sd_ho_lv7', 3, 0),
(514, 23, '', '20250327145616_42-2-0210003.dwg', '2025-03-27 07:56:16', '650.2', 'AutoCAD File', 'https://achivon.app/dr_files/20250327145616_42-2-0210003.dwg', '', 'sd_ho_lv7', 3, 0),
(515, 23, '', '20250327145625_42-2-0210004.dwg', '2025-03-27 07:56:25', '652.47', 'AutoCAD File', 'https://achivon.app/dr_files/20250327145625_42-2-0210004.dwg', '', 'sd_ho_lv7', 3, 0),
(516, 23, '', '20250327145633_42-2-0210005.dwg', '2025-03-27 07:56:33', '652.47', 'AutoCAD File', 'https://achivon.app/dr_files/20250327145633_42-2-0210005.dwg', '', 'sd_ho_lv7', 3, 0),
(517, 23, '', '20250327145642_42-2-0210006.dwg', '2025-03-27 07:56:42', '628.89', 'AutoCAD File', 'https://achivon.app/dr_files/20250327145642_42-2-0210006.dwg', '', 'sd_ho_lv7', 3, 0),
(518, 23, '', '20250327145650_42-2-0210007.dwg', '2025-03-27 07:56:50', '652.86', 'AutoCAD File', 'https://achivon.app/dr_files/20250327145650_42-2-0210007.dwg', '', 'sd_ho_lv7', 3, 0),
(519, 23, '', '20250327145706_42-3-0060G001.dwg', '2025-03-27 07:57:06', '616', 'AutoCAD File', 'https://achivon.app/dr_files/20250327145706_42-3-0060G001.dwg', '', 'sd_ho_lv7', 3, 0),
(520, 23, '', '20250327145714_42-4-0200G001.dwg', '2025-03-27 07:57:14', '649.29', 'AutoCAD File', 'https://achivon.app/dr_files/20250327145714_42-4-0200G001.dwg', '', 'sd_ho_lv7', 3, 0),
(521, 23, '', '20250327145725_42-5-0010001.dwg', '2025-03-27 07:57:25', '679.44', 'AutoCAD File', 'https://achivon.app/dr_files/20250327145725_42-5-0010001.dwg', '', 'sd_ho_lv7', 3, 0),
(522, 23, '', '20250327145738_42-7-0476001.dwg', '2025-03-27 07:57:38', '694.75', 'AutoCAD File', 'https://achivon.app/dr_files/20250327145738_42-7-0476001.dwg', '', 'sd_ho_lv7', 3, 0),
(523, 23, '', '20250327145748_42-7-0477001.dwg', '2025-03-27 07:57:48', '743.67', 'AutoCAD File', 'https://achivon.app/dr_files/20250327145748_42-7-0477001.dwg', '', 'sd_ho_lv7', 3, 0),
(524, 23, '', '20250327145759_42-7-0478001.dwg', '2025-03-27 07:57:59', '630.97', 'AutoCAD File', 'https://achivon.app/dr_files/20250327145759_42-7-0478001.dwg', '', 'sd_ho_lv7', 3, 0),
(525, 23, '', '20250327145808_42-7-0479001.dwg', '2025-03-27 07:58:08', '751.86', 'AutoCAD File', 'https://achivon.app/dr_files/20250327145808_42-7-0479001.dwg', '', 'sd_ho_lv7', 3, 0),
(526, 23, '', '20250327145826_42-7-0480001.dwg', '2025-03-27 07:58:26', '624.8', 'AutoCAD File', 'https://achivon.app/dr_files/20250327145826_42-7-0480001.dwg', '', 'sd_ho_lv7', 3, 0),
(527, 23, '', '20250327145838_42-7-0481001.dwg', '2025-03-27 07:58:38', '634.95', 'AutoCAD File', 'https://achivon.app/dr_files/20250327145838_42-7-0481001.dwg', '', 'sd_ho_lv7', 3, 0),
(528, 23, '', '20250327145847_42-7-0482001.dwg', '2025-03-27 07:58:47', '613.4', 'AutoCAD File', 'https://achivon.app/dr_files/20250327145847_42-7-0482001.dwg', '', 'sd_ho_lv7', 3, 0),
(529, 23, '', '20250327145901_42-7-0490001.dwg', '2025-03-27 07:59:01', '629.18', 'AutoCAD File', 'https://achivon.app/dr_files/20250327145901_42-7-0490001.dwg', '', 'sd_ho_lv7', 3, 0),
(530, 23, '', '20250327145910_42-7-0491001.dwg', '2025-03-27 07:59:10', '625.49', 'AutoCAD File', 'https://achivon.app/dr_files/20250327145910_42-7-0491001.dwg', '', 'sd_ho_lv7', 3, 0),
(531, 23, '', '20250327145918_42-7-0492001.dwg', '2025-03-27 07:59:18', '621.97', 'AutoCAD File', 'https://achivon.app/dr_files/20250327145918_42-7-0492001.dwg', '', 'sd_ho_lv7', 3, 0),
(532, 23, '', '20250327145927_42-7-0493001.dwg', '2025-03-27 07:59:27', '765.85', 'AutoCAD File', 'https://achivon.app/dr_files/20250327145927_42-7-0493001.dwg', '', 'sd_ho_lv7', 3, 0),
(533, 23, '', '20250327145940_42-7-0493002.dwg', '2025-03-27 07:59:40', '714.71', 'AutoCAD File', 'https://achivon.app/dr_files/20250327145940_42-7-0493002.dwg', '', 'sd_ho_lv7', 3, 0),
(534, 23, '', '20250327145950_42-7-0494001.dwg', '2025-03-27 07:59:50', '606.54', 'AutoCAD File', 'https://achivon.app/dr_files/20250327145950_42-7-0494001.dwg', '', 'sd_ho_lv7', 3, 0),
(535, 23, '', '20250327150002_42-7-0495001.dwg', '2025-03-27 08:00:02', '642.27', 'AutoCAD File', 'https://achivon.app/dr_files/20250327150002_42-7-0495001.dwg', '', 'sd_ho_lv7', 3, 0),
(536, 23, '', '20250327150013_42-8-0487001.dwg', '2025-03-27 08:00:13', '697.38', 'AutoCAD File', 'https://achivon.app/dr_files/20250327150013_42-8-0487001.dwg', '', 'sd_ho_lv7', 3, 0),
(537, 23, '', '20250327150021_42-8-0488001.dwg', '2025-03-27 08:00:21', '645.74', 'AutoCAD File', 'https://achivon.app/dr_files/20250327150021_42-8-0488001.dwg', '', 'sd_ho_lv7', 3, 0),
(538, 23, '', '20250327150032_42-8-0489001.dwg', '2025-03-27 08:00:32', '633.99', 'AutoCAD File', 'https://achivon.app/dr_files/20250327150032_42-8-0489001.dwg', '', 'sd_ho_lv7', 3, 0),
(539, 23, '', '20250327150044_42-9-0483001.dwg', '2025-03-27 08:00:44', '666', 'AutoCAD File', 'https://achivon.app/dr_files/20250327150044_42-9-0483001.dwg', '', 'sd_ho_lv7', 3, 0),
(540, 23, '', '20250327150055_42-9-0484001.dwg', '2025-03-27 08:00:55', '687.04', 'AutoCAD File', 'https://achivon.app/dr_files/20250327150055_42-9-0484001.dwg', '', 'sd_ho_lv7', 3, 0),
(541, 23, '', '20250327150103_42-9-0485001.dwg', '2025-03-27 08:01:03', '633.56', 'AutoCAD File', 'https://achivon.app/dr_files/20250327150103_42-9-0485001.dwg', '', 'sd_ho_lv7', 3, 0),
(542, 23, '', '20250327150111_42-9-0486001.dwg', '2025-03-27 08:01:11', '629.04', 'AutoCAD File', 'https://achivon.app/dr_files/20250327150111_42-9-0486001.dwg', '', 'sd_ho_lv7', 3, 0),
(543, 23, '', '20250327150154_42-1-0057G001.dwg', '2025-03-27 08:01:54', '780.73', 'AutoCAD File', 'https://achivon.app/dr_files/20250327150154_42-1-0057G001.dwg', '', 'sd_ho_lv7', 4, 0),
(544, 23, '', '20250327150247_42-1-3001G001.dwg', '2025-03-27 08:02:47', '749.99', 'AutoCAD File', 'https://achivon.app/dr_files/20250327150247_42-1-3001G001.dwg', '', 'sd_ho_lv7', 4, 0),
(545, 23, '', '20250327150257_42-2-0055001.dwg', '2025-03-27 08:02:57', '752.8', 'AutoCAD File', 'https://achivon.app/dr_files/20250327150257_42-2-0055001.dwg', '', 'sd_ho_lv7', 4, 0),
(546, 23, '', '20250327150311_42-2-0055002.dwg', '2025-03-27 08:03:11', '666.55', 'AutoCAD File', 'https://achivon.app/dr_files/20250327150311_42-2-0055002.dwg', '', 'sd_ho_lv7', 4, 0),
(547, 23, '', '20250327150350_MA42_PIPING_ISOMETRICS_FILE_A_Part1.pdf', '2025-03-27 08:03:52', '173839.06', 'PDF Document', 'https://achivon.app/dr_files/20250327150350_MA42_PIPING_ISOMETRICS_FILE_A_Part1.pdf', '', 'sd_ho_lv6', 7, 0),
(548, 23, '', '20250327150703_42-2-0055003.dwg', '2025-03-27 08:07:03', '746.46', 'AutoCAD File', 'https://achivon.app/dr_files/20250327150703_42-2-0055003.dwg', '', 'sd_ho_lv7', 4, 0),
(549, 23, '', '20250327150711_42-2-0055004.dwg', '2025-03-27 08:07:11', '645.87', 'AutoCAD File', 'https://achivon.app/dr_files/20250327150711_42-2-0055004.dwg', '', 'sd_ho_lv7', 4, 0);
INSERT INTO `dr_file` (`id`, `id_user`, `subject`, `name_file`, `upload_date`, `size`, `type_file`, `link`, `remark`, `table_name`, `id_table`, `is_aktiv`) VALUES
(550, 23, '', '20250327150724_42-2-0056001.dwg', '2025-03-27 08:07:24', '676.35', 'AutoCAD File', 'https://achivon.app/dr_files/20250327150724_42-2-0056001.dwg', '', 'sd_ho_lv7', 4, 0),
(551, 23, '', '20250327150738_42-2-0267001.dwg', '2025-03-27 08:07:38', '650.47', 'AutoCAD File', 'https://achivon.app/dr_files/20250327150738_42-2-0267001.dwg', '', 'sd_ho_lv7', 4, 0),
(552, 23, '', '20250327150750_42-2-0267002.dwg', '2025-03-27 08:07:50', '662.83', 'AutoCAD File', 'https://achivon.app/dr_files/20250327150750_42-2-0267002.dwg', '', 'sd_ho_lv7', 4, 0),
(553, 23, '', '20250327150800_42-2-0267003.dwg', '2025-03-27 08:08:00', '633.58', 'AutoCAD File', 'https://achivon.app/dr_files/20250327150800_42-2-0267003.dwg', '', 'sd_ho_lv7', 4, 0),
(554, 23, '', '20250327150815_42-2-0267004.dwg', '2025-03-27 08:08:15', '612.63', 'AutoCAD File', 'https://achivon.app/dr_files/20250327150815_42-2-0267004.dwg', '', 'sd_ho_lv7', 4, 0),
(555, 23, '', '20250327150832_42-2-0267005.dwg', '2025-03-27 08:08:32', '729.46', 'AutoCAD File', 'https://achivon.app/dr_files/20250327150832_42-2-0267005.dwg', '', 'sd_ho_lv7', 4, 0),
(556, 23, '', '20250327150846_MA42_PIPING_ISOMETRICS_FILE_A_Part2_.pdf', '2025-03-27 08:08:47', '114210.87', 'PDF Document', 'https://achivon.app/dr_files/20250327150846_MA42_PIPING_ISOMETRICS_FILE_A_Part2_.pdf', '', 'sd_ho_lv6', 7, 0),
(557, 23, '', '20250327150854_42-2-0280001.dwg', '2025-03-27 08:08:54', '733.95', 'AutoCAD File', 'https://achivon.app/dr_files/20250327150854_42-2-0280001.dwg', '', 'sd_ho_lv7', 4, 0),
(558, 23, '', '20250327150904_42-2-0281001.dwg', '2025-03-27 08:09:04', '677.82', 'AutoCAD File', 'https://achivon.app/dr_files/20250327150904_42-2-0281001.dwg', '', 'sd_ho_lv7', 4, 0),
(559, 23, '', '20250327150917_42-3-0061G001.dwg', '2025-03-27 08:09:17', '690.38', 'AutoCAD File', 'https://achivon.app/dr_files/20250327150917_42-3-0061G001.dwg', '', 'sd_ho_lv7', 4, 0),
(560, 23, '', '20250327150926_42-3-0063G001.dwg', '2025-03-27 08:09:26', '638.5', 'AutoCAD File', 'https://achivon.app/dr_files/20250327150926_42-3-0063G001.dwg', '', 'sd_ho_lv7', 4, 0),
(561, 23, '', '20250327150937_42-3-0064G001.dwg', '2025-03-27 08:09:37', '622.76', 'AutoCAD File', 'https://achivon.app/dr_files/20250327150937_42-3-0064G001.dwg', '', 'sd_ho_lv7', 4, 0),
(562, 23, '', '20250327150950_42-3-0062001.dwg', '2025-03-27 08:09:50', '650.01', 'AutoCAD File', 'https://achivon.app/dr_files/20250327150950_42-3-0062001.dwg', '', 'sd_ho_lv7', 4, 0),
(563, 23, '', '20250327150959_42-4-0065G001.dwg', '2025-03-27 08:09:59', '625.71', 'AutoCAD File', 'https://achivon.app/dr_files/20250327150959_42-4-0065G001.dwg', '', 'sd_ho_lv7', 4, 0),
(564, 23, '', '20250327151014_42-5-0048001.dwg', '2025-03-27 08:10:14', '699.75', 'AutoCAD File', 'https://achivon.app/dr_files/20250327151014_42-5-0048001.dwg', '', 'sd_ho_lv7', 4, 0),
(565, 23, '', '20250327151031_42-5-0060001.dwg', '2025-03-27 08:10:31', '728.09', 'AutoCAD File', 'https://achivon.app/dr_files/20250327151031_42-5-0060001.dwg', '', 'sd_ho_lv7', 4, 0),
(566, 23, '', '20250327151043_42-5-0060002.dwg', '2025-03-27 08:10:43', '690.3', 'AutoCAD File', 'https://achivon.app/dr_files/20250327151043_42-5-0060002.dwg', '', 'sd_ho_lv7', 4, 0),
(567, 23, '', '20250327151055_42-5-0060003.dwg', '2025-03-27 08:10:55', '738.8', 'AutoCAD File', 'https://achivon.app/dr_files/20250327151055_42-5-0060003.dwg', '', 'sd_ho_lv7', 4, 0),
(568, 23, '', '20250327151112_42-7-0628001.dwg', '2025-03-27 08:11:12', '779.05', 'AutoCAD File', 'https://achivon.app/dr_files/20250327151112_42-7-0628001.dwg', '', 'sd_ho_lv7', 4, 0),
(569, 23, '', '20250327151129_42-7-0629001.dwg', '2025-03-27 08:11:29', '643.8', 'AutoCAD File', 'https://achivon.app/dr_files/20250327151129_42-7-0629001.dwg', '', 'sd_ho_lv7', 4, 0),
(570, 23, '', '20250327151148_42-7-0630001.dwg', '2025-03-27 08:11:48', '663.25', 'AutoCAD File', 'https://achivon.app/dr_files/20250327151148_42-7-0630001.dwg', '', 'sd_ho_lv7', 4, 0),
(571, 23, '', '20250327151157_42-8-0623001.dwg', '2025-03-27 08:11:57', '666.87', 'AutoCAD File', 'https://achivon.app/dr_files/20250327151157_42-8-0623001.dwg', '', 'sd_ho_lv7', 4, 0),
(572, 23, '', '20250327151208_42-8-0624001.dwg', '2025-03-27 08:12:08', '636.8', 'AutoCAD File', 'https://achivon.app/dr_files/20250327151208_42-8-0624001.dwg', '', 'sd_ho_lv7', 4, 0),
(573, 23, '', '20250327151217_42-8-0625001.dwg', '2025-03-27 08:12:17', '679.3', 'AutoCAD File', 'https://achivon.app/dr_files/20250327151217_42-8-0625001.dwg', '', 'sd_ho_lv7', 4, 0),
(574, 23, '', '20250327151224_42-8-0626001.dwg', '2025-03-27 08:12:24', '651.5', 'AutoCAD File', 'https://achivon.app/dr_files/20250327151224_42-8-0626001.dwg', '', 'sd_ho_lv7', 4, 0),
(575, 23, '', '20250327151231_42-8-0627001.dwg', '2025-03-27 08:12:31', '629.95', 'AutoCAD File', 'https://achivon.app/dr_files/20250327151231_42-8-0627001.dwg', '', 'sd_ho_lv7', 4, 0),
(576, 23, '', '20250327151242_42-9-0621001.dwg', '2025-03-27 08:12:42', '697.83', 'AutoCAD File', 'https://achivon.app/dr_files/20250327151242_42-9-0621001.dwg', '', 'sd_ho_lv7', 4, 0),
(577, 23, '', '20250327151251_42-9-0622001.dwg', '2025-03-27 08:12:51', '660.66', 'AutoCAD File', 'https://achivon.app/dr_files/20250327151251_42-9-0622001.dwg', '', 'sd_ho_lv7', 4, 0),
(578, 23, '', '20250327151356_42-2-0087E001.dwg', '2025-03-27 08:13:56', '634.13', 'AutoCAD File', 'https://achivon.app/dr_files/20250327151356_42-2-0087E001.dwg', '', 'sd_ho_lv7', 5, 0),
(579, 23, '', '20250327151407_42-2-0087E002.dwg', '2025-03-27 08:14:07', '620.02', 'AutoCAD File', 'https://achivon.app/dr_files/20250327151407_42-2-0087E002.dwg', '', 'sd_ho_lv7', 5, 0),
(580, 23, '', '20250327151415_42-2-0087E003.dwg', '2025-03-27 08:14:15', '620.04', 'AutoCAD File', 'https://achivon.app/dr_files/20250327151415_42-2-0087E003.dwg', '', 'sd_ho_lv7', 5, 0),
(581, 23, '', '20250327151423_42-2-0087G001.dwg', '2025-03-27 08:14:23', '640.33', 'AutoCAD File', 'https://achivon.app/dr_files/20250327151423_42-2-0087G001.dwg', '', 'sd_ho_lv7', 5, 0),
(582, 23, '', '20250327151439_42-2-0107001.dwg', '2025-03-27 08:14:39', '641.02', 'AutoCAD File', 'https://achivon.app/dr_files/20250327151439_42-2-0107001.dwg', '', 'sd_ho_lv7', 5, 0),
(583, 23, '', '20250327151450_42-7-0004C001.dwg', '2025-03-27 08:14:50', '716.76', 'AutoCAD File', 'https://achivon.app/dr_files/20250327151450_42-7-0004C001.dwg', '', 'sd_ho_lv7', 5, 0),
(584, 23, '', '20250327151457_42-7-0004G001.dwg', '2025-03-27 08:14:57', '642.48', 'AutoCAD File', 'https://achivon.app/dr_files/20250327151457_42-7-0004G001.dwg', '', 'sd_ho_lv7', 5, 0),
(585, 23, '', '20250327151504_42-7-0004M001.dwg', '2025-03-27 08:15:04', '689.72', 'AutoCAD File', 'https://achivon.app/dr_files/20250327151504_42-7-0004M001.dwg', '', 'sd_ho_lv7', 5, 0),
(586, 23, '', '20250327151514_42-7-0005C001.dwg', '2025-03-27 08:15:14', '661.14', 'AutoCAD File', 'https://achivon.app/dr_files/20250327151514_42-7-0005C001.dwg', '', 'sd_ho_lv7', 5, 0),
(587, 23, '', '20250327151525_42-7-0005G001.dwg', '2025-03-27 08:15:25', '651.26', 'AutoCAD File', 'https://achivon.app/dr_files/20250327151525_42-7-0005G001.dwg', '', 'sd_ho_lv7', 5, 0),
(588, 23, '', '20250327151535_42-7-0005M001.dwg', '2025-03-27 08:15:35', '630.52', 'AutoCAD File', 'https://achivon.app/dr_files/20250327151535_42-7-0005M001.dwg', '', 'sd_ho_lv7', 5, 0),
(589, 23, '', '20250327151548_42-7-0019C001.dwg', '2025-03-27 08:15:48', '757.49', 'AutoCAD File', 'https://achivon.app/dr_files/20250327151548_42-7-0019C001.dwg', '', 'sd_ho_lv7', 5, 0),
(590, 23, '', '20250327151555_42-7-0019G001.dwg', '2025-03-27 08:15:55', '664.15', 'AutoCAD File', 'https://achivon.app/dr_files/20250327151555_42-7-0019G001.dwg', '', 'sd_ho_lv7', 5, 0),
(591, 23, '', '20250327151607_42-7-0001001.dwg', '2025-03-27 08:16:07', '660.32', 'AutoCAD File', 'https://achivon.app/dr_files/20250327151607_42-7-0001001.dwg', '', 'sd_ho_lv7', 5, 0),
(592, 23, '', '20250327151616_42-7-0002001.dwg', '2025-03-27 08:16:16', '683.56', 'AutoCAD File', 'https://achivon.app/dr_files/20250327151616_42-7-0002001.dwg', '', 'sd_ho_lv7', 5, 0),
(593, 23, '', '20250327151622_42-7-0003001.dwg', '2025-03-27 08:16:22', '660.53', 'AutoCAD File', 'https://achivon.app/dr_files/20250327151622_42-7-0003001.dwg', '', 'sd_ho_lv7', 5, 0),
(594, 23, '', '20250327151631_42-7-0006001.dwg', '2025-03-27 08:16:31', '672.83', 'AutoCAD File', 'https://achivon.app/dr_files/20250327151631_42-7-0006001.dwg', '', 'sd_ho_lv7', 5, 0),
(595, 23, '', '20250327151642_42-7-0006002.dwg', '2025-03-27 08:16:42', '674.08', 'AutoCAD File', 'https://achivon.app/dr_files/20250327151642_42-7-0006002.dwg', '', 'sd_ho_lv7', 5, 0),
(596, 23, '', '20250327151652_42-7-0007001.dwg', '2025-03-27 08:16:52', '632.81', 'AutoCAD File', 'https://achivon.app/dr_files/20250327151652_42-7-0007001.dwg', '', 'sd_ho_lv7', 5, 0),
(597, 23, '', '20250327151705_42-7-0008001.dwg', '2025-03-27 08:17:05', '644.34', 'AutoCAD File', 'https://achivon.app/dr_files/20250327151705_42-7-0008001.dwg', '', 'sd_ho_lv7', 5, 0),
(598, 23, '', '20250327151717_42-7-0009001.dwg', '2025-03-27 08:17:17', '632.45', 'AutoCAD File', 'https://achivon.app/dr_files/20250327151717_42-7-0009001.dwg', '', 'sd_ho_lv7', 5, 0),
(599, 23, '', '20250327151727_42-7-0010001.dwg', '2025-03-27 08:17:27', '687.17', 'AutoCAD File', 'https://achivon.app/dr_files/20250327151727_42-7-0010001.dwg', '', 'sd_ho_lv7', 5, 0),
(600, 23, '', '20250327151737_42-7-0011001.dwg', '2025-03-27 08:17:37', '709.91', 'AutoCAD File', 'https://achivon.app/dr_files/20250327151737_42-7-0011001.dwg', '', 'sd_ho_lv7', 5, 0),
(601, 23, '', '20250327151751_42-7-0012001.dwg', '2025-03-27 08:17:51', '754.98', 'AutoCAD File', 'https://achivon.app/dr_files/20250327151751_42-7-0012001.dwg', '', 'sd_ho_lv7', 5, 0),
(602, 23, '', '20250327151803_42-7-0013001.dwg', '2025-03-27 08:18:03', '645.55', 'AutoCAD File', 'https://achivon.app/dr_files/20250327151803_42-7-0013001.dwg', '', 'sd_ho_lv7', 5, 0),
(603, 23, '', '20250327151814_42-7-0014001.dwg', '2025-03-27 08:18:14', '783.51', 'AutoCAD File', 'https://achivon.app/dr_files/20250327151814_42-7-0014001.dwg', '', 'sd_ho_lv7', 5, 0),
(604, 23, '', '20250327151825_42-7-0014002.dwg', '2025-03-27 08:18:25', '683.98', 'AutoCAD File', 'https://achivon.app/dr_files/20250327151825_42-7-0014002.dwg', '', 'sd_ho_lv7', 5, 0),
(605, 23, '', '20250327151834_42-7-0015001.dwg', '2025-03-27 08:18:34', '639.21', 'AutoCAD File', 'https://achivon.app/dr_files/20250327151834_42-7-0015001.dwg', '', 'sd_ho_lv7', 5, 0),
(606, 23, '', '20250327151843_42-7-0016001.dwg', '2025-03-27 08:18:43', '730.37', 'AutoCAD File', 'https://achivon.app/dr_files/20250327151843_42-7-0016001.dwg', '', 'sd_ho_lv7', 5, 0),
(607, 23, '', '20250327151858_42-7-0016002.dwg', '2025-03-27 08:18:58', '809.63', 'AutoCAD File', 'https://achivon.app/dr_files/20250327151858_42-7-0016002.dwg', '', 'sd_ho_lv7', 5, 0),
(608, 23, '', '20250327151913_42-7-0016003.dwg', '2025-03-27 08:19:13', '735.93', 'AutoCAD File', 'https://achivon.app/dr_files/20250327151913_42-7-0016003.dwg', '', 'sd_ho_lv7', 5, 0),
(609, 23, '', '20250327151928_42-7-0017001.dwg', '2025-03-27 08:19:28', '709.22', 'AutoCAD File', 'https://achivon.app/dr_files/20250327151928_42-7-0017001.dwg', '', 'sd_ho_lv7', 5, 0),
(610, 23, '', '20250327151954_42-7-0018001.dwg', '2025-03-27 08:19:54', '643.83', 'AutoCAD File', 'https://achivon.app/dr_files/20250327151954_42-7-0018001.dwg', '', 'sd_ho_lv7', 5, 0),
(611, 23, '', '20250327152008_42-7-0021001.dwg', '2025-03-27 08:20:08', '679.04', 'AutoCAD File', 'https://achivon.app/dr_files/20250327152008_42-7-0021001.dwg', '', 'sd_ho_lv7', 5, 0),
(612, 23, '', '20250327152021_42-7-0048001.dwg', '2025-03-27 08:20:21', '735.48', 'AutoCAD File', 'https://achivon.app/dr_files/20250327152021_42-7-0048001.dwg', '', 'sd_ho_lv7', 5, 0),
(613, 23, '', '20250327152035_42-7-0049001.dwg', '2025-03-27 08:20:35', '632.81', 'AutoCAD File', 'https://achivon.app/dr_files/20250327152035_42-7-0049001.dwg', '', 'sd_ho_lv7', 5, 0),
(614, 23, '', '20250327152048_42-7-0057001.dwg', '2025-03-27 08:20:48', '651.85', 'AutoCAD File', 'https://achivon.app/dr_files/20250327152048_42-7-0057001.dwg', '', 'sd_ho_lv7', 5, 0),
(615, 23, '', '20250327152104_42-7-0058001.dwg', '2025-03-27 08:21:04', '651.85', 'AutoCAD File', 'https://achivon.app/dr_files/20250327152104_42-7-0058001.dwg', '', 'sd_ho_lv7', 5, 0),
(616, 23, '', '20250327152117_42-7-0059001.dwg', '2025-03-27 08:21:17', '728.67', 'AutoCAD File', 'https://achivon.app/dr_files/20250327152117_42-7-0059001.dwg', '', 'sd_ho_lv7', 5, 0),
(617, 23, '', '20250327152132_42-7-0059002.dwg', '2025-03-27 08:21:32', '716.11', 'AutoCAD File', 'https://achivon.app/dr_files/20250327152132_42-7-0059002.dwg', '', 'sd_ho_lv7', 5, 0),
(618, 23, '', '20250327152237_42-7-0084001.dwg', '2025-03-27 08:22:37', '625.2', 'AutoCAD File', 'https://achivon.app/dr_files/20250327152237_42-7-0084001.dwg', '', 'sd_ho_lv7', 5, 0),
(619, 23, '', '20250327152252_42-7-0085001.dwg', '2025-03-27 08:22:52', '624.82', 'AutoCAD File', 'https://achivon.app/dr_files/20250327152252_42-7-0085001.dwg', '', 'sd_ho_lv7', 5, 0),
(620, 23, '', '20250327153957_42-7-0530001.dwg', '2025-03-27 08:39:57', '603.51', 'AutoCAD File', 'https://achivon.app/dr_files/20250327153957_42-7-0530001.dwg', '', 'sd_ho_lv7', 5, 0),
(621, 23, '', '20250327154009_42-7-0531001.dwg', '2025-03-27 08:40:09', '613.15', 'AutoCAD File', 'https://achivon.app/dr_files/20250327154009_42-7-0531001.dwg', '', 'sd_ho_lv7', 5, 0),
(622, 23, '', '20250327154023_42-7-0532001.dwg', '2025-03-27 08:40:23', '613.15', 'AutoCAD File', 'https://achivon.app/dr_files/20250327154023_42-7-0532001.dwg', '', 'sd_ho_lv7', 5, 0),
(623, 23, '', '20250327154038_42-7-0534001.dwg', '2025-03-27 08:40:38', '620.17', 'AutoCAD File', 'https://achivon.app/dr_files/20250327154038_42-7-0534001.dwg', '', 'sd_ho_lv7', 5, 0),
(624, 23, '', '20250327154050_42-7-0535001.dwg', '2025-03-27 08:40:50', '612.03', 'AutoCAD File', 'https://achivon.app/dr_files/20250327154050_42-7-0535001.dwg', '', 'sd_ho_lv7', 5, 0),
(625, 23, '', '20250327154109_MA42_PIPING_ISOMETRICS_FILE_A_Part4.pdf', '2025-03-27 08:41:11', '200278.05', 'PDF Document', 'https://achivon.app/dr_files/20250327154109_MA42_PIPING_ISOMETRICS_FILE_A_Part4.pdf', '', 'sd_ho_lv6', 7, 0),
(626, 23, '', '20250327154131_42-7-0536001.dwg', '2025-03-27 08:41:31', '603.51', 'AutoCAD File', 'https://achivon.app/dr_files/20250327154131_42-7-0536001.dwg', '', 'sd_ho_lv7', 5, 0),
(627, 23, '', '20250327154149_42-7-0536001.dwg', '2025-03-27 08:41:49', '603.51', 'AutoCAD File', 'https://achivon.app/dr_files/20250327154149_42-7-0536001.dwg', '', 'sd_ho_lv7', 5, 0),
(628, 23, '', '20250327154202_42-7-0537001.dwg', '2025-03-27 08:42:02', '605.16', 'AutoCAD File', 'https://achivon.app/dr_files/20250327154202_42-7-0537001.dwg', '', 'sd_ho_lv7', 5, 0),
(629, 23, '', '20250327154217_MA42_PIPING_ISOMETRICS_FILE_A_Part2.pdf', '2025-03-27 08:42:17', '15481.07', 'PDF Document', 'https://achivon.app/dr_files/20250327154217_MA42_PIPING_ISOMETRICS_FILE_A_Part2.pdf', '', 'sd_ho_lv6', 7, 0),
(630, 23, '', '20250327154238_42-8-0052G001.dwg', '2025-03-27 08:42:38', '690.11', 'AutoCAD File', 'https://achivon.app/dr_files/20250327154238_42-8-0052G001.dwg', '', 'sd_ho_lv7', 5, 0),
(631, 23, '', '20250327154251_42-8-0020001.dwg', '2025-03-27 08:42:51', '736.41', 'AutoCAD File', 'https://achivon.app/dr_files/20250327154251_42-8-0020001.dwg', '', 'sd_ho_lv7', 5, 0),
(632, 23, '', '20250327154304_42-8-0022001.dwg', '2025-03-27 08:43:04', '701.14', 'AutoCAD File', 'https://achivon.app/dr_files/20250327154304_42-8-0022001.dwg', '', 'sd_ho_lv7', 5, 0),
(633, 23, '', '20250327154333_42-8-0023001.dwg', '2025-03-27 08:43:33', '804.15', 'AutoCAD File', 'https://achivon.app/dr_files/20250327154333_42-8-0023001.dwg', '', 'sd_ho_lv7', 5, 0),
(634, 23, '', '20250327154350_42-8-0025001.dwg', '2025-03-27 08:43:50', '653.72', 'AutoCAD File', 'https://achivon.app/dr_files/20250327154350_42-8-0025001.dwg', '', 'sd_ho_lv7', 5, 0),
(635, 23, '', '20250327154418_42-8-0026001.dwg', '2025-03-27 08:44:18', '695.98', 'AutoCAD File', 'https://achivon.app/dr_files/20250327154418_42-8-0026001.dwg', '', 'sd_ho_lv7', 5, 0),
(636, 23, '', '20250327154429_42-8-0027001.dwg', '2025-03-27 08:44:29', '765.56', 'AutoCAD File', 'https://achivon.app/dr_files/20250327154429_42-8-0027001.dwg', '', 'sd_ho_lv7', 5, 0),
(637, 23, '', '20250327154441_42-8-0028001.dwg', '2025-03-27 08:44:41', '767.29', 'AutoCAD File', 'https://achivon.app/dr_files/20250327154441_42-8-0028001.dwg', '', 'sd_ho_lv7', 5, 0),
(638, 23, '', '20250327154458_MA42_PIPING_ISOMETRICS_FILE_A_Part3.pdf', '2025-03-27 08:44:58', '96541.35', 'PDF Document', 'https://achivon.app/dr_files/20250327154458_MA42_PIPING_ISOMETRICS_FILE_A_Part3.pdf', '', 'sd_ho_lv6', 7, 0),
(639, 23, '', '20250327154513_42-8-0028002.dwg', '2025-03-27 08:45:13', '753.3', 'AutoCAD File', 'https://achivon.app/dr_files/20250327154513_42-8-0028002.dwg', '', 'sd_ho_lv7', 5, 0),
(640, 23, '', '20250327154534_42-8-0029001.dwg', '2025-03-27 08:45:34', '797.74', 'AutoCAD File', 'https://achivon.app/dr_files/20250327154534_42-8-0029001.dwg', '', 'sd_ho_lv7', 5, 0),
(641, 23, '', '20250327154621_42-8-0030001.dwg', '2025-03-27 08:46:21', '658.99', 'AutoCAD File', 'https://achivon.app/dr_files/20250327154621_42-8-0030001.dwg', '', 'sd_ho_lv7', 5, 0),
(642, 23, '', '20250327154710_42-8-0031001.dwg', '2025-03-27 08:47:10', '658.99', 'AutoCAD File', 'https://achivon.app/dr_files/20250327154710_42-8-0031001.dwg', '', 'sd_ho_lv7', 5, 0),
(643, 23, '', '20250327154737_42-8-0032001.dwg', '2025-03-27 08:47:37', '658.99', 'AutoCAD File', 'https://achivon.app/dr_files/20250327154737_42-8-0032001.dwg', '', 'sd_ho_lv7', 5, 0),
(644, 23, '', '20250327154750_42-8-0033001.dwg', '2025-03-27 08:47:50', '658.99', 'AutoCAD File', 'https://achivon.app/dr_files/20250327154750_42-8-0033001.dwg', '', 'sd_ho_lv7', 5, 0),
(645, 23, '', '20250327154811_42-8-0034001.dwg', '2025-03-27 08:48:11', '658.99', 'AutoCAD File', 'https://achivon.app/dr_files/20250327154811_42-8-0034001.dwg', '', 'sd_ho_lv7', 5, 0),
(646, 23, '', '20250327154855_42-8-0035001.dwg', '2025-03-27 08:48:55', '658.99', 'AutoCAD File', 'https://achivon.app/dr_files/20250327154855_42-8-0035001.dwg', '', 'sd_ho_lv7', 5, 0),
(647, 23, '', '20250327154913_42-8-0036001.dwg', '2025-03-27 08:49:13', '658.99', 'AutoCAD File', 'https://achivon.app/dr_files/20250327154913_42-8-0036001.dwg', '', 'sd_ho_lv7', 5, 0),
(648, 23, '', '20250327154959_42-8-0037001.dwg', '2025-03-27 08:49:59', '658.99', 'AutoCAD File', 'https://achivon.app/dr_files/20250327154959_42-8-0037001.dwg', '', 'sd_ho_lv7', 5, 0),
(649, 23, '', '20250327155010_42-8-0038001.dwg', '2025-03-27 08:50:10', '658.99', 'AutoCAD File', 'https://achivon.app/dr_files/20250327155010_42-8-0038001.dwg', '', 'sd_ho_lv7', 5, 0),
(650, 23, '', '20250327155042_42-8-0039001.dwg', '2025-03-27 08:50:42', '658.95', 'AutoCAD File', 'https://achivon.app/dr_files/20250327155042_42-8-0039001.dwg', '', 'sd_ho_lv7', 5, 0),
(651, 23, '', '20250327155106_42-8-0030001.dwg', '2025-03-27 08:51:06', '658.99', 'AutoCAD File', 'https://achivon.app/dr_files/20250327155106_42-8-0030001.dwg', '', 'sd_ho_lv7', 5, 0),
(652, 23, '', '20250327155225_42-8-0040001.dwg', '2025-03-27 08:52:25', '658.95', 'AutoCAD File', 'https://achivon.app/dr_files/20250327155225_42-8-0040001.dwg', '', 'sd_ho_lv7', 5, 0),
(653, 23, '', '20250327155241_42-8-0041001.dwg', '2025-03-27 08:52:41', '658.95', 'AutoCAD File', 'https://achivon.app/dr_files/20250327155241_42-8-0041001.dwg', '', 'sd_ho_lv7', 5, 0),
(654, 23, '', '20250327155335_42-8-0042001.dwg', '2025-03-27 08:53:35', '658.95', 'AutoCAD File', 'https://achivon.app/dr_files/20250327155335_42-8-0042001.dwg', '', 'sd_ho_lv7', 5, 0),
(655, 23, '', '20250327155354_42-8-0043001.dwg', '2025-03-27 08:53:54', '658.95', 'AutoCAD File', 'https://achivon.app/dr_files/20250327155354_42-8-0043001.dwg', '', 'sd_ho_lv7', 5, 0),
(656, 23, '', '20250327155548_42-8-0044001.dwg', '2025-03-27 08:55:48', '658.95', 'AutoCAD File', 'https://achivon.app/dr_files/20250327155548_42-8-0044001.dwg', '', 'sd_ho_lv7', 5, 0),
(657, 23, '', '20250327155628_42-8-0045001.dwg', '2025-03-27 08:56:28', '658.95', 'AutoCAD File', 'https://achivon.app/dr_files/20250327155628_42-8-0045001.dwg', '', 'sd_ho_lv7', 5, 0),
(658, 23, '', '20250327155757_42-8-0046001.dwg', '2025-03-27 08:57:57', '658.95', 'AutoCAD File', 'https://achivon.app/dr_files/20250327155757_42-8-0046001.dwg', '', 'sd_ho_lv7', 5, 0),
(659, 23, '', '20250327155848_42-8-0046001.dwg', '2025-03-27 08:58:48', '658.95', 'AutoCAD File', 'https://achivon.app/dr_files/20250327155848_42-8-0046001.dwg', '', 'sd_ho_lv7', 5, 0),
(660, 23, '', '20250327155907_42-8-0047001.dwg', '2025-03-27 08:59:07', '658.95', 'AutoCAD File', 'https://achivon.app/dr_files/20250327155907_42-8-0047001.dwg', '', 'sd_ho_lv7', 5, 0),
(661, 23, '', '20250327155921_42-8-0050001.dwg', '2025-03-27 08:59:21', '740.03', 'AutoCAD File', 'https://achivon.app/dr_files/20250327155921_42-8-0050001.dwg', '', 'sd_ho_lv7', 5, 0),
(662, 23, '', '20250327155935_42-8-0051001.dwg', '2025-03-27 08:59:35', '645.11', 'AutoCAD File', 'https://achivon.app/dr_files/20250327155935_42-8-0051001.dwg', '', 'sd_ho_lv7', 5, 0),
(663, 23, '', '20250327160010_42-8-0052001.dwg', '2025-03-27 09:00:10', '815.97', 'AutoCAD File', 'https://achivon.app/dr_files/20250327160010_42-8-0052001.dwg', '', 'sd_ho_lv7', 5, 0),
(664, 23, '', '20250327160025_42-8-0053001.dwg', '2025-03-27 09:00:25', '722.03', 'AutoCAD File', 'https://achivon.app/dr_files/20250327160025_42-8-0053001.dwg', '', 'sd_ho_lv7', 5, 0),
(665, 23, '', '20250327160040_42-8-0054001.dwg', '2025-03-27 09:00:40', '659.92', 'AutoCAD File', 'https://achivon.app/dr_files/20250327160040_42-8-0054001.dwg', '', 'sd_ho_lv7', 5, 0),
(666, 23, '', '20250327160056_42-8-0055001.dwg', '2025-03-27 09:00:56', '655.19', 'AutoCAD File', 'https://achivon.app/dr_files/20250327160056_42-8-0055001.dwg', '', 'sd_ho_lv7', 5, 0),
(667, 23, '', '20250327160203_42-8-0056001.dwg', '2025-03-27 09:02:03', '638.92', 'AutoCAD File', 'https://achivon.app/dr_files/20250327160203_42-8-0056001.dwg', '', 'sd_ho_lv7', 5, 0),
(668, 23, '', '20250327160215_42-8-0060001.dwg', '2025-03-27 09:02:15', '685.75', 'AutoCAD File', 'https://achivon.app/dr_files/20250327160215_42-8-0060001.dwg', '', 'sd_ho_lv7', 5, 0),
(669, 23, '', '20250327160226_42-8-0061001.dwg', '2025-03-27 09:02:26', '685.75', 'AutoCAD File', 'https://achivon.app/dr_files/20250327160226_42-8-0061001.dwg', '', 'sd_ho_lv7', 5, 0),
(670, 23, '', '20250327160242_42-8-0062001.dwg', '2025-03-27 09:02:42', '685.75', 'AutoCAD File', 'https://achivon.app/dr_files/20250327160242_42-8-0062001.dwg', '', 'sd_ho_lv7', 5, 0),
(671, 23, '', '20250327160253_42-8-0063001.dwg', '2025-03-27 09:02:53', '685.75', 'AutoCAD File', 'https://achivon.app/dr_files/20250327160253_42-8-0063001.dwg', '', 'sd_ho_lv7', 5, 0),
(672, 23, '', '20250327160307_42-8-0064001.dwg', '2025-03-27 09:03:07', '685.75', 'AutoCAD File', 'https://achivon.app/dr_files/20250327160307_42-8-0064001.dwg', '', 'sd_ho_lv7', 5, 0),
(673, 23, '', '20250327160320_42-8-0065001.dwg', '2025-03-27 09:03:20', '685.75', 'AutoCAD File', 'https://achivon.app/dr_files/20250327160320_42-8-0065001.dwg', '', 'sd_ho_lv7', 5, 0),
(674, 23, '', '20250327160334_42-8-0066001.dwg', '2025-03-27 09:03:34', '685.75', 'AutoCAD File', 'https://achivon.app/dr_files/20250327160334_42-8-0066001.dwg', '', 'sd_ho_lv7', 5, 0),
(675, 23, '', '20250327160418_42-8-0067001.dwg', '2025-03-27 09:04:18', '685.75', 'AutoCAD File', 'https://achivon.app/dr_files/20250327160418_42-8-0067001.dwg', '', 'sd_ho_lv7', 5, 0),
(676, 23, '', '20250327160431_42-8-0068001.dwg', '2025-03-27 09:04:31', '685.75', 'AutoCAD File', 'https://achivon.app/dr_files/20250327160431_42-8-0068001.dwg', '', 'sd_ho_lv7', 5, 0),
(677, 23, '', '20250327160447_42-8-0069001.dwg', '2025-03-27 09:04:47', '685.79', 'AutoCAD File', 'https://achivon.app/dr_files/20250327160447_42-8-0069001.dwg', '', 'sd_ho_lv7', 5, 0),
(678, 23, '', '20250327160630_42-8-0070001.dwg', '2025-03-27 09:06:30', '685.79', 'AutoCAD File', 'https://achivon.app/dr_files/20250327160630_42-8-0070001.dwg', '', 'sd_ho_lv7', 5, 0),
(679, 23, '', '20250327160818_42-8-0071001.dwg', '2025-03-27 09:08:18', '685.79', 'AutoCAD File', 'https://achivon.app/dr_files/20250327160818_42-8-0071001.dwg', '', 'sd_ho_lv7', 5, 0),
(680, 23, '', '20250327160835_42-8-0072001.dwg', '2025-03-27 09:08:35', '685.79', 'AutoCAD File', 'https://achivon.app/dr_files/20250327160835_42-8-0072001.dwg', '', 'sd_ho_lv7', 5, 0),
(681, 23, '', '20250327161010_42-8-0073001.dwg', '2025-03-27 09:10:10', '685.79', 'AutoCAD File', 'https://achivon.app/dr_files/20250327161010_42-8-0073001.dwg', '', 'sd_ho_lv7', 5, 0),
(682, 23, '', '20250327161103_42-8-0074001.dwg', '2025-03-27 09:11:03', '685.79', 'AutoCAD File', 'https://achivon.app/dr_files/20250327161103_42-8-0074001.dwg', '', 'sd_ho_lv7', 5, 0),
(683, 23, '', '20250327161109_MA42_PIPING_ISOMETRICS_FILE_A_Part5.pdf', '2025-03-27 09:11:09', '94074.13', 'PDF Document', 'https://achivon.app/dr_files/20250327161109_MA42_PIPING_ISOMETRICS_FILE_A_Part5.pdf', '', 'sd_ho_lv6', 7, 0),
(684, 23, '', '20250327161203_42-8-0075001.dwg', '2025-03-27 09:12:03', '685.79', 'AutoCAD File', 'https://achivon.app/dr_files/20250327161203_42-8-0075001.dwg', '', 'sd_ho_lv7', 5, 0),
(685, 23, '', '20250327161221_42-8-0076001.dwg', '2025-03-27 09:12:21', '685.79', 'AutoCAD File', 'https://achivon.app/dr_files/20250327161221_42-8-0076001.dwg', '', 'sd_ho_lv7', 5, 0),
(686, 23, '', '20250327161236_42-8-0077001.dwg', '2025-03-27 09:12:36', '685.79', 'AutoCAD File', 'https://achivon.app/dr_files/20250327161236_42-8-0077001.dwg', '', 'sd_ho_lv7', 5, 0),
(687, 23, '', '20250327161254_MA42_PIPING_ISOMETRICS_FILE_A_Part6.pdf', '2025-03-27 09:12:54', '50065.35', 'PDF Document', 'https://achivon.app/dr_files/20250327161254_MA42_PIPING_ISOMETRICS_FILE_A_Part6.pdf', '', 'sd_ho_lv6', 7, 0),
(688, 23, '', '20250327161258_42-8-0078001.dwg', '2025-03-27 09:12:58', '836.97', 'AutoCAD File', 'https://achivon.app/dr_files/20250327161258_42-8-0078001.dwg', '', 'sd_ho_lv7', 5, 0),
(689, 23, '', '20250327161310_42-8-0079001.dwg', '2025-03-27 09:13:10', '741.47', 'AutoCAD File', 'https://achivon.app/dr_files/20250327161310_42-8-0079001.dwg', '', 'sd_ho_lv7', 5, 0),
(690, 23, '', '20250327161323_42-8-0080001.dwg', '2025-03-27 09:13:23', '701.87', 'AutoCAD File', 'https://achivon.app/dr_files/20250327161323_42-8-0080001.dwg', '', 'sd_ho_lv7', 5, 0),
(691, 23, '', '20250327161433_42-8-0080002.dwg', '2025-03-27 09:14:33', '686.47', 'AutoCAD File', 'https://achivon.app/dr_files/20250327161433_42-8-0080002.dwg', '', 'sd_ho_lv7', 5, 0),
(692, 23, '', '20250327161624_42-8-0081001.dwg', '2025-03-27 09:16:24', '685.31', 'AutoCAD File', 'https://achivon.app/dr_files/20250327161624_42-8-0081001.dwg', '', 'sd_ho_lv7', 5, 0),
(693, 23, '', '20250327161637_42-8-0082002.dwg', '2025-03-27 09:16:37', '778.03', 'AutoCAD File', 'https://achivon.app/dr_files/20250327161637_42-8-0082002.dwg', '', 'sd_ho_lv7', 5, 0),
(694, 23, '', '20250327161711_MA42_PIPING_ISOMETRICS_FILE_A_Part7.pdf', '2025-03-27 09:17:11', '30034.81', 'PDF Document', 'https://achivon.app/dr_files/20250327161711_MA42_PIPING_ISOMETRICS_FILE_A_Part7.pdf', '', 'sd_ho_lv6', 7, 0),
(695, 23, '', '20250327161841_MA42_PIPING_ISOMETRICS_FILE_A_Part8.pdf', '2025-03-27 09:18:41', '43142.17', 'PDF Document', 'https://achivon.app/dr_files/20250327161841_MA42_PIPING_ISOMETRICS_FILE_A_Part8.pdf', '', 'sd_ho_lv6', 7, 0),
(696, 23, '', '20250327162053_42-8-0540001.dwg', '2025-03-27 09:20:53', '614.36', 'AutoCAD File', 'https://achivon.app/dr_files/20250327162053_42-8-0540001.dwg', '', 'sd_ho_lv7', 5, 0),
(697, 23, '', '20250327162108_42-8-0541001.dwg', '2025-03-27 09:21:08', '603.95', 'AutoCAD File', 'https://achivon.app/dr_files/20250327162108_42-8-0541001.dwg', '', 'sd_ho_lv7', 5, 0),
(698, 23, '', '20250327162127_42-8-0542001.dwg', '2025-03-27 09:21:27', '605.59', 'AutoCAD File', 'https://achivon.app/dr_files/20250327162127_42-8-0542001.dwg', '', 'sd_ho_lv7', 5, 0),
(699, 23, '', '20250327162140_42-8-0543001.dwg', '2025-03-27 09:21:40', '605.53', 'AutoCAD File', 'https://achivon.app/dr_files/20250327162140_42-8-0543001.dwg', '', 'sd_ho_lv7', 5, 0),
(700, 23, '', '20250327162153_42-8-0544001.dwg', '2025-03-27 09:21:53', '605.53', 'AutoCAD File', 'https://achivon.app/dr_files/20250327162153_42-8-0544001.dwg', '', 'sd_ho_lv7', 5, 0),
(701, 23, '', '20250327162211_42-8-0545001.dwg', '2025-03-27 09:22:11', '604.22', 'AutoCAD File', 'https://achivon.app/dr_files/20250327162211_42-8-0545001.dwg', '', 'sd_ho_lv7', 5, 0),
(702, 23, '', '20250327162225_42-8-0546001.dwg', '2025-03-27 09:22:25', '605.22', 'AutoCAD File', 'https://achivon.app/dr_files/20250327162225_42-8-0546001.dwg', '', 'sd_ho_lv7', 5, 0),
(703, 23, '', '20250327162238_42-8-0547001.dwg', '2025-03-27 09:22:38', '604.91', 'AutoCAD File', 'https://achivon.app/dr_files/20250327162238_42-8-0547001.dwg', '', 'sd_ho_lv7', 5, 0),
(704, 23, '', '20250327162254_42-8-0548001.dwg', '2025-03-27 09:22:54', '605.36', 'AutoCAD File', 'https://achivon.app/dr_files/20250327162254_42-8-0548001.dwg', '', 'sd_ho_lv7', 5, 0),
(705, 23, '', '20250327162305_42-8-0549001.dwg', '2025-03-27 09:23:05', '605.05', 'AutoCAD File', 'https://achivon.app/dr_files/20250327162305_42-8-0549001.dwg', '', 'sd_ho_lv7', 5, 0),
(706, 23, '', '20250327162314_42-8-0550001.dwg', '2025-03-27 09:23:14', '603.75', 'AutoCAD File', 'https://achivon.app/dr_files/20250327162314_42-8-0550001.dwg', '', 'sd_ho_lv7', 5, 0),
(707, 23, '', '20250327162326_42-8-0551001.dwg', '2025-03-27 09:23:26', '605.53', 'AutoCAD File', 'https://achivon.app/dr_files/20250327162326_42-8-0551001.dwg', '', 'sd_ho_lv7', 5, 0),
(708, 23, '', '20250327162326_MA42_PIPING_ISOMETRICS_FILE_B_Part1.pdf', '2025-03-27 09:23:27', '91759.45', 'PDF Document', 'https://achivon.app/dr_files/20250327162326_MA42_PIPING_ISOMETRICS_FILE_B_Part1.pdf', '', 'sd_ho_lv6', 7, 0),
(709, 23, '', '20250327162335_42-8-0552001.dwg', '2025-03-27 09:23:35', '614.55', 'AutoCAD File', 'https://achivon.app/dr_files/20250327162335_42-8-0552001.dwg', '', 'sd_ho_lv7', 5, 0),
(710, 23, '', '20250327162354_42-8-0553001.dwg', '2025-03-27 09:23:54', '605.26', 'AutoCAD File', 'https://achivon.app/dr_files/20250327162354_42-8-0553001.dwg', '', 'sd_ho_lv7', 5, 0),
(711, 23, '', '20250327162404_42-8-0554001.dwg', '2025-03-27 09:24:04', '603.51', 'AutoCAD File', 'https://achivon.app/dr_files/20250327162404_42-8-0554001.dwg', '', 'sd_ho_lv7', 5, 0),
(712, 23, '', '20250327162524_42-2-0405E001.dwg', '2025-03-27 09:25:24', '632.48', 'AutoCAD File', 'https://achivon.app/dr_files/20250327162524_42-2-0405E001.dwg', '', 'sd_ho_lv7', 6, 0),
(713, 23, '', '20250327162532_42-2-0405E002.dwg', '2025-03-27 09:25:32', '611.95', 'AutoCAD File', 'https://achivon.app/dr_files/20250327162532_42-2-0405E002.dwg', '', 'sd_ho_lv7', 6, 0),
(714, 23, '', '20250327162606_42-2-0405E003.dwg', '2025-03-27 09:26:06', '636.64', 'AutoCAD File', 'https://achivon.app/dr_files/20250327162606_42-2-0405E003.dwg', '', 'sd_ho_lv7', 6, 0),
(715, 23, '', '20250327162613_42-2-0405G001.dwg', '2025-03-27 09:26:13', '628.25', 'AutoCAD File', 'https://achivon.app/dr_files/20250327162613_42-2-0405G001.dwg', '', 'sd_ho_lv7', 6, 0),
(716, 23, '', '20250327162633_42-2-0265001.dwg', '2025-03-27 09:26:33', '646.53', 'AutoCAD File', 'https://achivon.app/dr_files/20250327162633_42-2-0265001.dwg', '', 'sd_ho_lv7', 6, 0),
(717, 23, '', '20250327162646_42-2-0282001.dwg', '2025-03-27 09:26:46', '702.25', 'AutoCAD File', 'https://achivon.app/dr_files/20250327162646_42-2-0282001.dwg', '', 'sd_ho_lv7', 6, 0),
(718, 23, '', '20250327162658_42-2-0285001.dwg', '2025-03-27 09:26:58', '671.86', 'AutoCAD File', 'https://achivon.app/dr_files/20250327162658_42-2-0285001.dwg', '', 'sd_ho_lv7', 6, 0),
(719, 23, '', '20250327162709_42-5-0054G001.dwg', '2025-03-27 09:27:09', '632.86', 'AutoCAD File', 'https://achivon.app/dr_files/20250327162709_42-5-0054G001.dwg', '', 'sd_ho_lv7', 6, 0),
(720, 23, '', '20250327162719_42-5-0392G001.dwg', '2025-03-27 09:27:19', '653.24', 'AutoCAD File', 'https://achivon.app/dr_files/20250327162719_42-5-0392G001.dwg', '', 'sd_ho_lv7', 6, 0),
(721, 23, '', '20250327162730_42-5-0392K001.dwg', '2025-03-27 09:27:30', '643.54', 'AutoCAD File', 'https://achivon.app/dr_files/20250327162730_42-5-0392K001.dwg', '', 'sd_ho_lv7', 6, 0),
(722, 23, '', '20250327162752_42-5-0392G001.dwg', '2025-03-27 10:11:21', '653.24', 'AutoCAD File', 'https://achivon.app/dr_files/20250327162752_42-5-0392G001.dwg', '', 'sd_ho_lv7', 6, 1),
(723, 23, '', '20250327162808_42-5-0030001.dwg', '2025-03-27 09:28:08', '638.32', 'AutoCAD File', 'https://achivon.app/dr_files/20250327162808_42-5-0030001.dwg', '', 'sd_ho_lv7', 6, 0),
(724, 23, '', '20250327162849_42-5-0397G001.dwg', '2025-03-27 09:28:49', '667.21', 'AutoCAD File', 'https://achivon.app/dr_files/20250327162849_42-5-0397G001.dwg', '', 'sd_ho_lv7', 6, 0),
(725, 23, '', '20250327162859_42-5-0397K001.dwg', '2025-03-27 09:28:59', '644.35', 'AutoCAD File', 'https://achivon.app/dr_files/20250327162859_42-5-0397K001.dwg', '', 'sd_ho_lv7', 6, 0),
(726, 23, '', '20250327162917_42-5-0029001.dwg', '2025-03-27 09:29:17', '610.96', 'AutoCAD File', 'https://achivon.app/dr_files/20250327162917_42-5-0029001.dwg', '', 'sd_ho_lv7', 6, 0),
(727, 23, '', '20250327162920_MA42_PIPING_ISOMETRICS_FILE_B_Part2.pdf', '2025-03-27 09:29:20', '41456.8', 'PDF Document', 'https://achivon.app/dr_files/20250327162920_MA42_PIPING_ISOMETRICS_FILE_B_Part2.pdf', '', 'sd_ho_lv6', 7, 0),
(728, 23, '', '20250327162950_42-5-0031001.dwg', '2025-03-27 09:29:50', '664.84', 'AutoCAD File', 'https://achivon.app/dr_files/20250327162950_42-5-0031001.dwg', '', 'sd_ho_lv7', 6, 0),
(729, 23, '', '20250327163005_42-5-0032001.dwg', '2025-03-27 09:30:05', '735.74', 'AutoCAD File', 'https://achivon.app/dr_files/20250327163005_42-5-0032001.dwg', '', 'sd_ho_lv7', 6, 0),
(730, 23, '', '20250327163019_42-5-0039001.dwg', '2025-03-27 09:30:19', '603.7', 'AutoCAD File', 'https://achivon.app/dr_files/20250327163019_42-5-0039001.dwg', '', 'sd_ho_lv7', 6, 0),
(731, 23, '', '20250327163029_42-5-0040001.dwg', '2025-03-27 09:30:29', '605.23', 'AutoCAD File', 'https://achivon.app/dr_files/20250327163029_42-5-0040001.dwg', '', 'sd_ho_lv7', 6, 0),
(732, 23, '', '20250327163043_42-5-0390001.dwg', '2025-03-27 09:30:43', '679.66', 'AutoCAD File', 'https://achivon.app/dr_files/20250327163043_42-5-0390001.dwg', '', 'sd_ho_lv7', 6, 0),
(733, 23, '', '20250327163058_42-5-0391001.dwg', '2025-03-27 09:30:58', '733.63', 'AutoCAD File', 'https://achivon.app/dr_files/20250327163058_42-5-0391001.dwg', '', 'sd_ho_lv7', 6, 0),
(734, 23, '', '20250327163111_42-5-0393001.dwg', '2025-03-27 09:31:11', '727.62', 'AutoCAD File', 'https://achivon.app/dr_files/20250327163111_42-5-0393001.dwg', '', 'sd_ho_lv7', 6, 0),
(735, 23, '', '20250327163126_42-5-0394001.dwg', '2025-03-27 09:31:26', '640.25', 'AutoCAD File', 'https://achivon.app/dr_files/20250327163126_42-5-0394001.dwg', '', 'sd_ho_lv7', 6, 0),
(736, 23, '', '20250327163139_MA42_PIPING_ISOMETRICS_FILE_B_Part3.pdf', '2025-03-27 09:31:39', '37010', 'PDF Document', 'https://achivon.app/dr_files/20250327163139_MA42_PIPING_ISOMETRICS_FILE_B_Part3.pdf', '', 'sd_ho_lv6', 7, 0),
(737, 23, '', '20250327163144_42-5-0394001.dwg', '2025-03-27 09:31:44', '640.25', 'AutoCAD File', 'https://achivon.app/dr_files/20250327163144_42-5-0394001.dwg', '', 'sd_ho_lv7', 6, 0),
(738, 23, '', '20250327163223_MA42_PIPING_ISOMETRICS_FILE_B_Part4.pdf', '2025-03-27 09:32:23', '72006.55', 'PDF Document', 'https://achivon.app/dr_files/20250327163223_MA42_PIPING_ISOMETRICS_FILE_B_Part4.pdf', '', 'sd_ho_lv6', 7, 0),
(739, 23, '', '20250327163236_42-5-0412001.dwg', '2025-03-27 09:32:36', '613.38', 'AutoCAD File', 'https://achivon.app/dr_files/20250327163236_42-5-0412001.dwg', '', 'sd_ho_lv7', 6, 0),
(740, 23, '', '20250327163255_42-5-0413001.dwg', '2025-03-27 09:32:55', '603.39', 'AutoCAD File', 'https://achivon.app/dr_files/20250327163255_42-5-0413001.dwg', '', 'sd_ho_lv7', 6, 0),
(741, 23, '', '20250327163311_42-5-0414001.dwg', '2025-03-27 09:33:11', '604.6', 'AutoCAD File', 'https://achivon.app/dr_files/20250327163311_42-5-0414001.dwg', '', 'sd_ho_lv7', 6, 0),
(742, 23, '', '20250327163325_42-7-0222001.dwg', '2025-03-27 09:33:25', '701.27', 'AutoCAD File', 'https://achivon.app/dr_files/20250327163325_42-7-0222001.dwg', '', 'sd_ho_lv7', 6, 0),
(743, 23, '', '20250327163337_42-7-0223001.dwg', '2025-03-27 09:33:37', '662.79', 'AutoCAD File', 'https://achivon.app/dr_files/20250327163337_42-7-0223001.dwg', '', 'sd_ho_lv7', 6, 0),
(744, 23, '', '20250327163340_MA42_PIPING_ISOMETRICS_FILE_B_Part5.pdf', '2025-03-27 09:33:41', '154020.32', 'PDF Document', 'https://achivon.app/dr_files/20250327163340_MA42_PIPING_ISOMETRICS_FILE_B_Part5.pdf', '', 'sd_ho_lv6', 7, 0),
(745, 23, '', '20250327163350_42-7-0226001.dwg', '2025-03-27 09:33:50', '606.69', 'AutoCAD File', 'https://achivon.app/dr_files/20250327163350_42-7-0226001.dwg', '', 'sd_ho_lv7', 6, 0),
(746, 23, '', '20250327163400_42-7-0233001.dwg', '2025-03-27 09:34:00', '599.66', 'AutoCAD File', 'https://achivon.app/dr_files/20250327163400_42-7-0233001.dwg', '', 'sd_ho_lv7', 6, 0),
(747, 23, '', '20250327163412_42-8-0218B001.dwg', '2025-03-27 09:34:12', '662.93', 'AutoCAD File', 'https://achivon.app/dr_files/20250327163412_42-8-0218B001.dwg', '', 'sd_ho_lv7', 6, 0),
(748, 23, '', '20250327163423_42-8-0218G001.dwg', '2025-03-27 09:34:23', '618.5', 'AutoCAD File', 'https://achivon.app/dr_files/20250327163423_42-8-0218G001.dwg', '', 'sd_ho_lv7', 6, 0),
(749, 23, '', '20250327163433_42-8-0170001.dwg', '2025-03-27 09:34:33', '650.7', 'AutoCAD File', 'https://achivon.app/dr_files/20250327163433_42-8-0170001.dwg', '', 'sd_ho_lv7', 6, 0),
(750, 23, '', '20250327163528_42-8-0171001.dwg', '2025-03-27 09:35:28', '650.7', 'AutoCAD File', 'https://achivon.app/dr_files/20250327163528_42-8-0171001.dwg', '', 'sd_ho_lv7', 6, 0),
(751, 23, '', '20250327163542_42-8-0172001.dwg', '2025-03-27 09:35:42', '650.7', 'AutoCAD File', 'https://achivon.app/dr_files/20250327163542_42-8-0172001.dwg', '', 'sd_ho_lv7', 6, 0),
(752, 23, '', '20250327163555_42-8-0173001.dwg', '2025-03-27 09:35:55', '650.7', 'AutoCAD File', 'https://achivon.app/dr_files/20250327163555_42-8-0173001.dwg', '', 'sd_ho_lv7', 6, 0),
(753, 23, '', '20250327163614_42-8-0174001.dwg', '2025-03-27 09:36:14', '650.7', 'AutoCAD File', 'https://achivon.app/dr_files/20250327163614_42-8-0174001.dwg', '', 'sd_ho_lv7', 6, 0),
(754, 23, '', '20250327163626_42-8-0175001.dwg', '2025-03-27 09:36:26', '650.7', 'AutoCAD File', 'https://achivon.app/dr_files/20250327163626_42-8-0175001.dwg', '', 'sd_ho_lv7', 6, 0),
(755, 23, '', '20250327163645_42-8-0176001.dwg', '2025-03-27 09:36:46', '650.7', 'AutoCAD File', 'https://achivon.app/dr_files/20250327163645_42-8-0176001.dwg', '', 'sd_ho_lv7', 6, 0),
(756, 23, '', '20250327163707_42-8-0177001.dwg', '2025-03-27 09:37:07', '650.7', 'AutoCAD File', 'https://achivon.app/dr_files/20250327163707_42-8-0177001.dwg', '', 'sd_ho_lv7', 6, 0),
(757, 23, '', '20250327163724_42-8-0178001.dwg', '2025-03-27 09:37:24', '650.7', 'AutoCAD File', 'https://achivon.app/dr_files/20250327163724_42-8-0178001.dwg', '', 'sd_ho_lv7', 6, 0),
(758, 23, '', '20250327163739_42-8-0179001.dwg', '2025-03-27 09:37:39', '650.33', 'AutoCAD File', 'https://achivon.app/dr_files/20250327163739_42-8-0179001.dwg', '', 'sd_ho_lv7', 6, 0),
(759, 23, '', '20250327163750_42-8-0180001.dwg', '2025-03-27 09:37:50', '650.33', 'AutoCAD File', 'https://achivon.app/dr_files/20250327163750_42-8-0180001.dwg', '', 'sd_ho_lv7', 6, 0),
(760, 23, '', '20250327163804_42-8-0181001.dwg', '2025-03-27 09:38:04', '650.33', 'AutoCAD File', 'https://achivon.app/dr_files/20250327163804_42-8-0181001.dwg', '', 'sd_ho_lv7', 6, 0),
(761, 23, '', '20250327163820_42-8-0182001.dwg', '2025-03-27 09:38:20', '650.33', 'AutoCAD File', 'https://achivon.app/dr_files/20250327163820_42-8-0182001.dwg', '', 'sd_ho_lv7', 6, 0),
(762, 23, '', '20250327163838_42-8-0183001.dwg', '2025-03-27 09:38:38', '650.33', 'AutoCAD File', 'https://achivon.app/dr_files/20250327163838_42-8-0183001.dwg', '', 'sd_ho_lv7', 6, 0),
(763, 23, '', '20250327163850_42-8-0184001.dwg', '2025-03-27 09:38:50', '650.33', 'AutoCAD File', 'https://achivon.app/dr_files/20250327163850_42-8-0184001.dwg', '', 'sd_ho_lv7', 6, 0),
(764, 23, '', '20250327163907_42-8-0185001.dwg', '2025-03-27 09:39:07', '650.33', 'AutoCAD File', 'https://achivon.app/dr_files/20250327163907_42-8-0185001.dwg', '', 'sd_ho_lv7', 6, 0),
(765, 23, '', '20250327163924_42-8-0186001.dwg', '2025-03-27 09:39:24', '650.33', 'AutoCAD File', 'https://achivon.app/dr_files/20250327163924_42-8-0186001.dwg', '', 'sd_ho_lv7', 6, 0),
(766, 23, '', '20250327163941_42-8-0187001.dwg', '2025-03-27 09:39:41', '650.33', 'AutoCAD File', 'https://achivon.app/dr_files/20250327163941_42-8-0187001.dwg', '', 'sd_ho_lv7', 6, 0),
(767, 23, '', '20250327164002_42-8-0188001.dwg', '2025-03-27 09:40:02', '816.19', 'AutoCAD File', 'https://achivon.app/dr_files/20250327164002_42-8-0188001.dwg', '', 'sd_ho_lv7', 6, 0),
(768, 23, '', '20250327164028_42-8-0189001.dwg', '2025-03-27 09:40:28', '778.34', 'AutoCAD File', 'https://achivon.app/dr_files/20250327164028_42-8-0189001.dwg', '', 'sd_ho_lv7', 6, 0),
(769, 23, '', '20250327164048_42-8-0190001.dwg', '2025-03-27 09:40:48', '677.09', 'AutoCAD File', 'https://achivon.app/dr_files/20250327164048_42-8-0190001.dwg', '', 'sd_ho_lv7', 6, 0),
(770, 23, '', '20250327164249_MA42_PIPING_ISOMETRICS_FILE_B_Part6.pdf', '2025-03-27 09:42:50', '178360.19', 'PDF Document', 'https://achivon.app/dr_files/20250327164249_MA42_PIPING_ISOMETRICS_FILE_B_Part6.pdf', '', 'sd_ho_lv6', 7, 0),
(771, 23, '', '20250327164301_42-8-0191001.dwg', '2025-03-27 09:43:01', '677.09', 'AutoCAD File', 'https://achivon.app/dr_files/20250327164301_42-8-0191001.dwg', '', 'sd_ho_lv7', 6, 0),
(772, 23, '', '20250327164717_42-8-0191001.dwg', '2025-03-27 10:13:02', '677.09', 'AutoCAD File', 'https://achivon.app/dr_files/20250327164717_42-8-0191001.dwg', '', 'sd_ho_lv7', 6, 1),
(773, 23, '', '20250327164906_42-8-0192001.dwg', '2025-03-27 09:49:06', '677.09', 'AutoCAD File', 'https://achivon.app/dr_files/20250327164906_42-8-0192001.dwg', '', 'sd_ho_lv7', 6, 0),
(774, 23, '', '20250327164918_42-8-0192001.dwg', '2025-03-27 09:49:18', '677.09', 'AutoCAD File', 'https://achivon.app/dr_files/20250327164918_42-8-0192001.dwg', '', 'sd_ho_lv7', 6, 0),
(775, 23, '', '20250327165021_42-8-0193001.dwg', '2025-03-27 09:50:21', '677.09', 'AutoCAD File', 'https://achivon.app/dr_files/20250327165021_42-8-0193001.dwg', '', 'sd_ho_lv7', 6, 0),
(776, 23, '', '20250327165033_42-8-0194001.dwg', '2025-03-27 09:50:33', '677.09', 'AutoCAD File', 'https://achivon.app/dr_files/20250327165033_42-8-0194001.dwg', '', 'sd_ho_lv7', 6, 0),
(777, 23, '', '20250327165047_42-8-0195001.dwg', '2025-03-27 10:14:43', '678.14', 'AutoCAD File', 'https://achivon.app/dr_files/20250327165047_42-8-0195001.dwg', '', 'sd_ho_lv7', 6, 1),
(778, 23, '', '20250327165219_42-8-0195001.dwg', '2025-03-27 09:52:19', '678.14', 'AutoCAD File', 'https://achivon.app/dr_files/20250327165219_42-8-0195001.dwg', '', 'sd_ho_lv7', 6, 0),
(779, 23, '', '20250327165232_42-8-0195001.dwg', '2025-03-27 10:14:33', '678.14', 'AutoCAD File', 'https://achivon.app/dr_files/20250327165232_42-8-0195001.dwg', '', 'sd_ho_lv7', 6, 1),
(780, 23, '', '20250327165304_42-8-0196001.dwg', '2025-03-27 09:53:04', '677.09', 'AutoCAD File', 'https://achivon.app/dr_files/20250327165304_42-8-0196001.dwg', '', 'sd_ho_lv7', 6, 0),
(781, 23, '', '20250327165320_42-8-0197001.dwg', '2025-03-27 09:53:20', '677.09', 'AutoCAD File', 'https://achivon.app/dr_files/20250327165320_42-8-0197001.dwg', '', 'sd_ho_lv7', 6, 0),
(782, 23, '', '20250327165332_42-8-0198001.dwg', '2025-03-27 09:53:32', '677.71', 'AutoCAD File', 'https://achivon.app/dr_files/20250327165332_42-8-0198001.dwg', '', 'sd_ho_lv7', 6, 0),
(783, 23, '', '20250327165420_42-8-0196001.dwg', '2025-03-27 10:14:55', '677.09', 'AutoCAD File', 'https://achivon.app/dr_files/20250327165420_42-8-0196001.dwg', '', 'sd_ho_lv7', 6, 1),
(784, 23, '', '20250327165459_42-8-0199001.dwg', '2025-03-27 09:54:59', '684.82', 'AutoCAD File', 'https://achivon.app/dr_files/20250327165459_42-8-0199001.dwg', '', 'sd_ho_lv7', 6, 0),
(785, 23, '', '20250327165512_42-8-0200001.dwg', '2025-03-27 09:55:12', '684.82', 'AutoCAD File', 'https://achivon.app/dr_files/20250327165512_42-8-0200001.dwg', '', 'sd_ho_lv7', 6, 0),
(786, 23, '', '20250327165538_42-8-0201001.dwg', '2025-03-27 09:55:38', '685.76', 'AutoCAD File', 'https://achivon.app/dr_files/20250327165538_42-8-0201001.dwg', '', 'sd_ho_lv7', 6, 0),
(787, 23, '', '20250327165554_42-8-0202001.dwg', '2025-03-27 09:55:54', '684.82', 'AutoCAD File', 'https://achivon.app/dr_files/20250327165554_42-8-0202001.dwg', '', 'sd_ho_lv7', 6, 0),
(788, 23, '', '20250327165622_42-8-0203001.dwg', '2025-03-27 09:56:22', '684.82', 'AutoCAD File', 'https://achivon.app/dr_files/20250327165622_42-8-0203001.dwg', '', 'sd_ho_lv7', 6, 0),
(789, 23, '', '20250327165647_42-8-0204001.dwg', '2025-03-27 09:56:47', '685.76', 'AutoCAD File', 'https://achivon.app/dr_files/20250327165647_42-8-0204001.dwg', '', 'sd_ho_lv7', 6, 0),
(790, 23, '', '20250327165702_42-8-0205001.dwg', '2025-03-27 09:57:02', '684.82', 'AutoCAD File', 'https://achivon.app/dr_files/20250327165702_42-8-0205001.dwg', '', 'sd_ho_lv7', 6, 0),
(791, 23, '', '20250327165740_42-8-0206001.dwg', '2025-03-27 09:57:40', '684.82', 'AutoCAD File', 'https://achivon.app/dr_files/20250327165740_42-8-0206001.dwg', '', 'sd_ho_lv7', 6, 0),
(792, 23, '', '20250327165844_42-8-0207001.dwg', '2025-03-27 09:58:44', '684.82', 'AutoCAD File', 'https://achivon.app/dr_files/20250327165844_42-8-0207001.dwg', '', 'sd_ho_lv7', 6, 0),
(793, 23, '', '20250327165901_42-8-0208001.dwg', '2025-03-27 09:59:01', '724.04', 'AutoCAD File', 'https://achivon.app/dr_files/20250327165901_42-8-0208001.dwg', '', 'sd_ho_lv7', 6, 0),
(794, 23, '', '20250327165902_MA42_PIPING_ISOMETRICS_FILE_B_Part7.pdf', '2025-03-27 09:59:04', '188830.51', 'PDF Document', 'https://achivon.app/dr_files/20250327165902_MA42_PIPING_ISOMETRICS_FILE_B_Part7.pdf', '', 'sd_ho_lv6', 7, 0),
(795, 23, '', '20250327165928_42-8-0208002.dwg', '2025-03-27 09:59:28', '718.31', 'AutoCAD File', 'https://achivon.app/dr_files/20250327165928_42-8-0208002.dwg', '', 'sd_ho_lv7', 6, 0),
(796, 23, '', '20250327165946_42-8-0209001.dwg', '2025-03-27 09:59:46', '817.66', 'AutoCAD File', 'https://achivon.app/dr_files/20250327165946_42-8-0209001.dwg', '', 'sd_ho_lv7', 6, 0),
(797, 23, '', '20250327165958_42-8-0210001.dwg', '2025-03-27 09:59:58', '705.64', 'AutoCAD File', 'https://achivon.app/dr_files/20250327165958_42-8-0210001.dwg', '', 'sd_ho_lv7', 6, 0),
(798, 23, '', '20250327170012_42-8-0211001.dwg', '2025-03-27 10:00:12', '747.28', 'AutoCAD File', 'https://achivon.app/dr_files/20250327170012_42-8-0211001.dwg', '', 'sd_ho_lv7', 6, 0),
(799, 23, '', '20250327170037_42-8-0211001.dwg', '2025-03-27 10:15:15', '747.28', 'AutoCAD File', 'https://achivon.app/dr_files/20250327170037_42-8-0211001.dwg', '', 'sd_ho_lv7', 6, 1),
(800, 23, '', '20250327170102_42-8-0212001.dwg', '2025-03-27 10:01:02', '780.92', 'AutoCAD File', 'https://achivon.app/dr_files/20250327170102_42-8-0212001.dwg', '', 'sd_ho_lv7', 6, 0),
(801, 23, '', '20250327170122_42-8-0213001.dwg', '2025-03-27 10:01:22', '637.2', 'AutoCAD File', 'https://achivon.app/dr_files/20250327170122_42-8-0213001.dwg', '', 'sd_ho_lv7', 6, 0),
(802, 23, '', '20250327170155_42-8-0213001.dwg', '2025-03-27 10:15:23', '637.2', 'AutoCAD File', 'https://achivon.app/dr_files/20250327170155_42-8-0213001.dwg', '', 'sd_ho_lv7', 6, 1),
(803, 23, '', '20250327170213_42-8-0214001.dwg', '2025-03-27 10:02:13', '810.55', 'AutoCAD File', 'https://achivon.app/dr_files/20250327170213_42-8-0214001.dwg', '', 'sd_ho_lv7', 6, 0),
(804, 23, '', '20250327171357_MA42_PIPING_ISOMETRICS_FILE_A_Part8.pdf', '2025-03-27 10:13:57', '43142.17', 'PDF Document', 'https://achivon.app/dr_files/20250327171357_MA42_PIPING_ISOMETRICS_FILE_A_Part8.pdf', '', 'sd_ho_lv6', 7, 0),
(805, 23, '', '20250327171557_42-8-0215001.dwg', '2025-03-27 10:15:57', '700.96', 'AutoCAD File', 'https://achivon.app/dr_files/20250327171557_42-8-0215001.dwg', '', 'sd_ho_lv7', 6, 0),
(806, 23, '', '20250327171615_42-8-0216001.dwg', '2025-03-27 10:16:15', '642.48', 'AutoCAD File', 'https://achivon.app/dr_files/20250327171615_42-8-0216001.dwg', '', 'sd_ho_lv7', 6, 0),
(807, 23, '', '20250327171634_42-8-0217001.dwg', '2025-03-27 10:16:34', '641.28', 'AutoCAD File', 'https://achivon.app/dr_files/20250327171634_42-8-0217001.dwg', '', 'sd_ho_lv7', 6, 0),
(808, 23, '', '20250327171651_42-8-0220001.dwg', '2025-03-27 10:16:51', '719.92', 'AutoCAD File', 'https://achivon.app/dr_files/20250327171651_42-8-0220001.dwg', '', 'sd_ho_lv7', 6, 0),
(809, 23, '', '20250327171710_42-8-0221001.dwg', '2025-03-27 10:17:10', '609.14', 'AutoCAD File', 'https://achivon.app/dr_files/20250327171710_42-8-0221001.dwg', '', 'sd_ho_lv7', 6, 0),
(810, 23, '', '20250327171734_42-8-0224001.dwg', '2025-03-27 10:17:34', '613.79', 'AutoCAD File', 'https://achivon.app/dr_files/20250327171734_42-8-0224001.dwg', '', 'sd_ho_lv7', 6, 0),
(811, 23, '', '20250327171746_42-8-0224001.dwg', '2025-03-27 10:17:46', '613.79', 'AutoCAD File', 'https://achivon.app/dr_files/20250327171746_42-8-0224001.dwg', '', 'sd_ho_lv7', 6, 0),
(812, 23, '', '20250327172032_MA42_PIPING_ISOMETRICS_FILE_C1_Part1.pdf', '2025-03-27 10:20:33', '162963.14', 'PDF Document', 'https://achivon.app/dr_files/20250327172032_MA42_PIPING_ISOMETRICS_FILE_C1_Part1.pdf', '', 'sd_ho_lv6', 7, 0),
(813, 23, '', '20250327172048_42-8-0225001.dwg', '2025-03-27 10:20:48', '603.71', 'AutoCAD File', 'https://achivon.app/dr_files/20250327172048_42-8-0225001.dwg', '', 'sd_ho_lv7', 6, 0),
(814, 23, '', '20250327172100_42-8-0227001.dwg', '2025-03-27 10:21:00', '697.29', 'AutoCAD File', 'https://achivon.app/dr_files/20250327172100_42-8-0227001.dwg', '', 'sd_ho_lv7', 6, 0),
(815, 23, '', '20250327172112_42-8-0228001.dwg', '2025-03-27 10:21:12', '604.91', 'AutoCAD File', 'https://achivon.app/dr_files/20250327172112_42-8-0228001.dwg', '', 'sd_ho_lv7', 6, 0);
INSERT INTO `dr_file` (`id`, `id_user`, `subject`, `name_file`, `upload_date`, `size`, `type_file`, `link`, `remark`, `table_name`, `id_table`, `is_aktiv`) VALUES
(816, 23, '', '20250327172125_42-8-0229001.dwg', '2025-03-27 10:21:25', '605.22', 'AutoCAD File', 'https://achivon.app/dr_files/20250327172125_42-8-0229001.dwg', '', 'sd_ho_lv7', 6, 0),
(817, 23, '', '20250327172133_42-8-0230001.dwg', '2025-03-27 10:21:33', '605.13', 'AutoCAD File', 'https://achivon.app/dr_files/20250327172133_42-8-0230001.dwg', '', 'sd_ho_lv7', 6, 0),
(818, 23, '', '20250327172145_42-8-0231001.dwg', '2025-03-27 10:21:45', '605.36', 'AutoCAD File', 'https://achivon.app/dr_files/20250327172145_42-8-0231001.dwg', '', 'sd_ho_lv7', 6, 0),
(819, 23, '', '20250327172202_42-8-0232001.dwg', '2025-03-27 10:22:02', '603.74', 'AutoCAD File', 'https://achivon.app/dr_files/20250327172202_42-8-0232001.dwg', '', 'sd_ho_lv7', 6, 0),
(820, 23, '', '20250327172350_42-8-0290001.dwg', '2025-03-27 10:23:50', '638.36', 'AutoCAD File', 'https://achivon.app/dr_files/20250327172350_42-8-0290001.dwg', '', 'sd_ho_lv7', 7, 0),
(821, 23, '', '20250327172358_42-8-0291001.dwg', '2025-03-27 10:23:58', '699.58', 'AutoCAD File', 'https://achivon.app/dr_files/20250327172358_42-8-0291001.dwg', '', 'sd_ho_lv7', 7, 0),
(822, 23, '', '20250327172404_42-8-0292001.dwg', '2025-03-27 10:24:04', '621.49', 'AutoCAD File', 'https://achivon.app/dr_files/20250327172404_42-8-0292001.dwg', '', 'sd_ho_lv7', 7, 0),
(823, 23, '', '20250327172410_42-8-0293001.dwg', '2025-03-27 10:24:10', '637.04', 'AutoCAD File', 'https://achivon.app/dr_files/20250327172410_42-8-0293001.dwg', '', 'sd_ho_lv7', 7, 0),
(824, 23, '', '20250327172455_42-8-0303001.dwg', '2025-03-27 10:24:55', '603.96', 'AutoCAD File', 'https://achivon.app/dr_files/20250327172455_42-8-0303001.dwg', '', 'sd_ho_lv7', 8, 0),
(825, 23, '', '20250327172504_42-8-0304001.dwg', '2025-03-27 10:25:04', '603.73', 'AutoCAD File', 'https://achivon.app/dr_files/20250327172504_42-8-0304001.dwg', '', 'sd_ho_lv7', 8, 0),
(826, 23, '', '20250327172512_42-8-0305001.dwg', '2025-03-27 10:25:12', '735.91', 'AutoCAD File', 'https://achivon.app/dr_files/20250327172512_42-8-0305001.dwg', '', 'sd_ho_lv7', 8, 0),
(827, 23, '', '20250327172520_42-8-0306001.dwg', '2025-03-27 10:25:20', '616.13', 'AutoCAD File', 'https://achivon.app/dr_files/20250327172520_42-8-0306001.dwg', '', 'sd_ho_lv7', 8, 0),
(828, 23, '', '20250327172527_42-8-0307001.dwg', '2025-03-27 10:25:27', '675.44', 'AutoCAD File', 'https://achivon.app/dr_files/20250327172527_42-8-0307001.dwg', '', 'sd_ho_lv7', 8, 0),
(829, 23, '', '20250327172608_42-2-0208F001.dwg', '2025-03-27 10:26:08', '607.23', 'AutoCAD File', 'https://achivon.app/dr_files/20250327172608_42-2-0208F001.dwg', '', 'sd_ho_lv7', 9, 0),
(830, 23, '', '20250327172624_42-2-0208F002.dwg', '2025-03-27 10:26:24', '766.93', 'AutoCAD File', 'https://achivon.app/dr_files/20250327172624_42-2-0208F002.dwg', '', 'sd_ho_lv7', 9, 0),
(831, 23, '', '20250327172638_42-2-0059001.dwg', '2025-03-27 10:26:38', '638.2', 'AutoCAD File', 'https://achivon.app/dr_files/20250327172638_42-2-0059001.dwg', '', 'sd_ho_lv7', 9, 0),
(832, 23, '', '20250327172647_42-2-0059002.dwg', '2025-03-27 10:26:47', '724.81', 'AutoCAD File', 'https://achivon.app/dr_files/20250327172647_42-2-0059002.dwg', '', 'sd_ho_lv7', 9, 0),
(833, 23, '', '20250327172701_42-9-0337D001.dwg', '2025-03-27 10:27:01', '664.37', 'AutoCAD File', 'https://achivon.app/dr_files/20250327172701_42-9-0337D001.dwg', '', 'sd_ho_lv7', 9, 0),
(834, 23, '', '20250327172712_42-9-0337G001.dwg', '2025-03-27 10:27:12', '643.05', 'AutoCAD File', 'https://achivon.app/dr_files/20250327172712_42-9-0337G001.dwg', '', 'sd_ho_lv7', 9, 0),
(835, 23, '', '20250327172723_42-9-0351G001.dwg', '2025-03-27 10:27:23', '614.62', 'AutoCAD File', 'https://achivon.app/dr_files/20250327172723_42-9-0351G001.dwg', '', 'sd_ho_lv7', 9, 0),
(836, 23, '', '20250327172741_42-9-0358D001.dwg', '2025-03-27 10:27:41', '678.5', 'AutoCAD File', 'https://achivon.app/dr_files/20250327172741_42-9-0358D001.dwg', '', 'sd_ho_lv7', 9, 0),
(837, 23, '', '20250327172753_42-9-0358G001.dwg', '2025-03-27 10:27:53', '661.49', 'AutoCAD File', 'https://achivon.app/dr_files/20250327172753_42-9-0358G001.dwg', '', 'sd_ho_lv7', 9, 0),
(838, 23, '', '20250327172806_42-9-0332001.dwg', '2025-03-27 10:28:06', '692.66', 'AutoCAD File', 'https://achivon.app/dr_files/20250327172806_42-9-0332001.dwg', '', 'sd_ho_lv7', 9, 0),
(839, 23, '', '20250327210251_Structure_Material_List_Summary_Updated_(20250327).xlsx', '2025-03-27 14:02:51', '1650.19', 'Excel Document', 'https://achivon.app/dr_files/20250327210251_Structure_Material_List_Summary_Updated_%2820250327%29.xlsx', '', 'sd_ho_lv3', 245, 0),
(840, 23, '', '20250328073215_Piping_Material_List_Summary_(20250328).xlsx', '2025-03-28 00:59:21', '4850.02', 'Excel Document', 'https://achivon.app/dr_files/20250328073215_Piping_Material_List_Summary_%2820250328%29.xlsx', '', 'sd_ho_lv3', 247, 1),
(841, 23, '', '20250328073857_42-9-0334001.dwg', '2025-03-28 00:38:57', '684.91', 'AutoCAD File', 'https://achivon.app/dr_files/20250328073857_42-9-0334001.dwg', '', 'sd_ho_lv7', 9, 0),
(842, 23, '', '20250328073921_42-9-0333001.dwg', '2025-03-28 00:39:21', '603.73', 'AutoCAD File', 'https://achivon.app/dr_files/20250328073921_42-9-0333001.dwg', '', 'sd_ho_lv7', 9, 0),
(843, 23, '', '20250328073940_42-9-0335001.dwg', '2025-03-28 00:39:40', '651.95', 'AutoCAD File', 'https://achivon.app/dr_files/20250328073940_42-9-0335001.dwg', '', 'sd_ho_lv7', 9, 0),
(844, 23, '', '20250328073958_42-9-0336001.dwg', '2025-03-28 00:39:58', '728.36', 'AutoCAD File', 'https://achivon.app/dr_files/20250328073958_42-9-0336001.dwg', '', 'sd_ho_lv7', 9, 0),
(845, 23, '', '20250328074024_42-9-0336001.dwg', '2025-03-28 00:40:24', '728.36', 'AutoCAD File', 'https://achivon.app/dr_files/20250328074024_42-9-0336001.dwg', '', 'sd_ho_lv7', 9, 0),
(846, 23, '', '20250328074036_42-9-0336001.dwg', '2025-03-28 00:40:36', '728.36', 'AutoCAD File', 'https://achivon.app/dr_files/20250328074036_42-9-0336001.dwg', '', 'sd_ho_lv7', 9, 0),
(847, 23, '', '20250328074108_42-9-0339001.dwg', '2025-03-28 00:41:08', '636.44', 'AutoCAD File', 'https://achivon.app/dr_files/20250328074108_42-9-0339001.dwg', '', 'sd_ho_lv7', 9, 0),
(848, 23, '', '20250328074130_42-9-0340001.dwg', '2025-03-28 00:41:30', '741.88', 'AutoCAD File', 'https://achivon.app/dr_files/20250328074130_42-9-0340001.dwg', '', 'sd_ho_lv7', 9, 0),
(849, 23, '', '20250328074151_42-9-0342001.dwg', '2025-03-28 00:41:51', '643.29', 'AutoCAD File', 'https://achivon.app/dr_files/20250328074151_42-9-0342001.dwg', '', 'sd_ho_lv7', 9, 0),
(850, 23, '', '20250328074216_42-9-0343001.dwg', '2025-03-28 00:42:16', '690.24', 'AutoCAD File', 'https://achivon.app/dr_files/20250328074216_42-9-0343001.dwg', '', 'sd_ho_lv7', 9, 0),
(851, 23, '', '20250328074243_42-9-0344001.dwg', '2025-03-28 00:42:43', '628.39', 'AutoCAD File', 'https://achivon.app/dr_files/20250328074243_42-9-0344001.dwg', '', 'sd_ho_lv7', 9, 0),
(852, 23, '', '20250328074310_42-9-0344001.dwg', '2025-03-28 00:43:44', '628.39', 'AutoCAD File', 'https://achivon.app/dr_files/20250328074310_42-9-0344001.dwg', '', 'sd_ho_lv7', 9, 1),
(853, 23, '', '20250328074406_42-9-0345001.dwg', '2025-03-28 00:44:06', '600.14', 'AutoCAD File', 'https://achivon.app/dr_files/20250328074406_42-9-0345001.dwg', '', 'sd_ho_lv7', 9, 0),
(854, 23, '', '20250328074423_42-9-0346001.dwg', '2025-03-28 00:44:23', '681.7', 'AutoCAD File', 'https://achivon.app/dr_files/20250328074423_42-9-0346001.dwg', '', 'sd_ho_lv7', 9, 0),
(855, 23, '', '20250328074533_42-9-0346001.dwg', '2025-03-28 00:45:43', '681.7', 'AutoCAD File', 'https://achivon.app/dr_files/20250328074533_42-9-0346001.dwg', '', 'sd_ho_lv7', 9, 1),
(856, 23, '', '20250328074553_42-9-0346002.dwg', '2025-03-28 00:45:53', '747.26', 'AutoCAD File', 'https://achivon.app/dr_files/20250328074553_42-9-0346002.dwg', '', 'sd_ho_lv7', 9, 0),
(857, 23, '', '20250328074603_42-9-0347001.dwg', '2025-03-28 00:46:03', '709.01', 'AutoCAD File', 'https://achivon.app/dr_files/20250328074603_42-9-0347001.dwg', '', 'sd_ho_lv7', 9, 0),
(858, 23, '', '20250328074611_42-9-0347002.dwg', '2025-03-28 00:46:11', '628.55', 'AutoCAD File', 'https://achivon.app/dr_files/20250328074611_42-9-0347002.dwg', '', 'sd_ho_lv7', 9, 0),
(859, 23, '', '20250328074623_42-9-0348001.dwg', '2025-03-28 00:46:23', '639.69', 'AutoCAD File', 'https://achivon.app/dr_files/20250328074623_42-9-0348001.dwg', '', 'sd_ho_lv7', 9, 0),
(860, 23, '', '20250328074645_42-9-0349001.dwg', '2025-03-28 00:46:45', '798.85', 'AutoCAD File', 'https://achivon.app/dr_files/20250328074645_42-9-0349001.dwg', '', 'sd_ho_lv7', 9, 0),
(861, 23, '', '20250328074700_42-9-0349002.dwg', '2025-03-28 00:47:00', '745.52', 'AutoCAD File', 'https://achivon.app/dr_files/20250328074700_42-9-0349002.dwg', '', 'sd_ho_lv7', 9, 0),
(862, 23, '', '20250328074726_42-9-0350001.dwg', '2025-03-28 00:47:26', '635.21', 'AutoCAD File', 'https://achivon.app/dr_files/20250328074726_42-9-0350001.dwg', '', 'sd_ho_lv7', 9, 0),
(863, 23, 'Isometric', 'Isometric', '2025-03-28 00:52:47', NULL, '', 'https://drive.google.com/drive/folders/1yC5N7hGVpELml07Fe6PUj96RJyHsuh0u?usp=drive_link', '', 'sd_ho_lv6', 7, 1),
(864, 23, 'Isometric', 'File Scan Isometric', '2025-03-28 00:53:18', NULL, '', 'https://drive.google.com/drive/folders/1yC5N7hGVpELml07Fe6PUj96RJyHsuh0u?usp=drive_link', '', 'sd_ho_lv6', 7, 0),
(865, 23, '', '20250328075907_20250328073215_Piping_Material_List_Summary_(20250328).xlsx', '2025-03-28 00:59:07', '4848.91', 'Excel Document', 'https://achivon.app/dr_files/20250328075907_20250328073215_Piping_Material_List_Summary_%2820250328%29.xlsx', '', 'sd_ho_lv3', 247, 0),
(866, 23, '', '20250328075916_42-9-0351001.dwg', '2025-03-28 00:59:16', '726.75', 'AutoCAD File', 'https://achivon.app/dr_files/20250328075916_42-9-0351001.dwg', '', 'sd_ho_lv7', 9, 0),
(867, 23, '', '20250328075931_42-9-0351002.dwg', '2025-03-28 00:59:31', '716.01', 'AutoCAD File', 'https://achivon.app/dr_files/20250328075931_42-9-0351002.dwg', '', 'sd_ho_lv7', 9, 0),
(868, 23, '', '20250328080008_42-9-0352001.dwg', '2025-03-28 01:00:08', '687.5', 'AutoCAD File', 'https://achivon.app/dr_files/20250328080008_42-9-0352001.dwg', '', 'sd_ho_lv7', 9, 0),
(869, 23, '', '20250328080030_42-9-0353001.dwg', '2025-03-28 01:00:30', '687.5', 'AutoCAD File', 'https://achivon.app/dr_files/20250328080030_42-9-0353001.dwg', '', 'sd_ho_lv7', 9, 0),
(870, 23, '', '20250328080048_42-9-0354001.dwg', '2025-03-28 01:00:48', '687.5', 'AutoCAD File', 'https://achivon.app/dr_files/20250328080048_42-9-0354001.dwg', '', 'sd_ho_lv7', 9, 0),
(871, 23, '', '20250328080105_42-9-0355001.dwg', '2025-03-28 01:01:05', '600.14', 'AutoCAD File', 'https://achivon.app/dr_files/20250328080105_42-9-0355001.dwg', '', 'sd_ho_lv7', 9, 0),
(872, 23, '', '20250328080118_42-9-0356001.dwg', '2025-03-28 01:01:18', '604.27', 'AutoCAD File', 'https://achivon.app/dr_files/20250328080118_42-9-0356001.dwg', '', 'sd_ho_lv7', 9, 0),
(873, 23, '', '20250328080136_42-9-0357001.dwg', '2025-03-28 01:01:36', '605.96', 'AutoCAD File', 'https://achivon.app/dr_files/20250328080136_42-9-0357001.dwg', '', 'sd_ho_lv7', 9, 0),
(874, 14, '', '20250328084418_Transmittal__Engineering_Document_Status_Report.xlsx', '2025-06-16 10:25:39', '939.16', 'Excel Document', 'https://achivon.app/dr_files/20250328084418_Transmittal__Engineering_Document_Status_Report.xlsx', '', 'sd_ho_lv2', 151, 1),
(875, 20, '', '20250328084620_Contract_KN-ACV_Revamping_Project_-_Construction,_Erection_Work_and_Procurement_Supply_of_Chemical_Plant.pdf', '2025-03-28 01:46:20', '29386.93', 'PDF Document', 'https://achivon.app/dr_files/20250328084620_Contract_KN-ACV_Revamping_Project_-_Construction%2C_Erection_Work_and_Procurement_Supply_of_Chemical_Plant.pdf', '', 'sd_ho_lv3', 57, 0),
(876, 20, '', '20250328084816_Rev._1_PO_25-O87401-PKE60-01_(Generator___PT_Rajawali_Diesel_Indonesia).pdf', '2025-03-28 01:48:16', '185.53', 'PDF Document', 'https://achivon.app/dr_files/20250328084816_Rev._1_PO_25-O87401-PKE60-01_%28Generator___PT_Rajawali_Diesel_Indonesia%29.pdf', '', 'sd_ho_lv2', 154, 0),
(877, 20, '', '20250328084841_Rev._1_PO_25-O87401-PKE70-01_(Air_Compressor_-_PT_Sunway_Trek_Masindo).pdf', '2025-03-28 01:48:41', '183.42', 'PDF Document', 'https://achivon.app/dr_files/20250328084841_Rev._1_PO_25-O87401-PKE70-01_%28Air_Compressor_-_PT_Sunway_Trek_Masindo%29.pdf', '', 'sd_ho_lv2', 154, 0),
(878, 20, '', '20250328084858_PO_25-O87401-PKR10-01_(Rental_Crane_50T).pdf', '2025-03-28 01:48:58', '201.95', 'PDF Document', 'https://achivon.app/dr_files/20250328084858_PO_25-O87401-PKR10-01_%28Rental_Crane_50T%29.pdf', '', 'sd_ho_lv2', 154, 0),
(879, 20, '', '20250328084910_PO_25-O87401-PKR10-02_(Rental_TMC_10_Ton).pdf', '2025-03-28 01:49:10', '202.34', 'PDF Document', 'https://achivon.app/dr_files/20250328084910_PO_25-O87401-PKR10-02_%28Rental_TMC_10_Ton%29.pdf', '', 'sd_ho_lv2', 154, 0),
(880, 20, '', '20250328084925_PO_25-O87401-PKT90-01_(Transportation).pdf', '2025-03-28 01:49:25', '183.4', 'PDF Document', 'https://achivon.app/dr_files/20250328084925_PO_25-O87401-PKT90-01_%28Transportation%29.pdf', '', 'sd_ho_lv2', 154, 0),
(881, 20, '', '20250328084937_Rev._1_PO_25-O87401-PKT90-02_(Transportation-2nd).pdf', '2025-03-28 01:49:37', '182.51', 'PDF Document', 'https://achivon.app/dr_files/20250328084937_Rev._1_PO_25-O87401-PKT90-02_%28Transportation-2nd%29.pdf', '', 'sd_ho_lv2', 154, 0),
(882, 20, '', '20250328084950_Rev._1_PO_25-O87401-PKT90-03_(Transportation-3rd).pdf', '2025-03-28 01:49:50', '182.65', 'PDF Document', 'https://achivon.app/dr_files/20250328084950_Rev._1_PO_25-O87401-PKT90-03_%28Transportation-3rd%29.pdf', '', 'sd_ho_lv2', 154, 0),
(883, 20, '', '20250328085010_Rev._1_PO_25-O87401-POW61-01_(Scaffolding_Materials__Accessories)_PT_Lineone_Indonesia.pdf', '2025-06-16 10:25:39', '421.1', 'PDF Document', 'https://achivon.app/dr_files/20250328085010_Rev._1_PO_25-O87401-POW61-01_%28Scaffolding_Materials__Accessories%29_PT_Lineone_Indonesia.pdf', '', 'sd_ho_lv2', 154, 0),
(884, 20, '', '20250328085050_PO_25-O87401-POW61-02_(Scaffolding_Clamps)_PT_Morlin_Satya_Bhakti.pdf', '2025-03-28 01:50:50', '274.03', 'PDF Document', 'https://achivon.app/dr_files/20250328085050_PO_25-O87401-POW61-02_%28Scaffolding_Clamps%29_PT_Morlin_Satya_Bhakti.pdf', '', 'sd_ho_lv2', 154, 0),
(885, 20, '', '20250328085105_Rev._1_PO_25-O87401-PRI80-01_(Gas_-_Samator_Berau).pdf', '2025-03-28 01:51:05', '287.16', 'PDF Document', 'https://achivon.app/dr_files/20250328085105_Rev._1_PO_25-O87401-PRI80-01_%28Gas_-_Samator_Berau%29.pdf', '', 'sd_ho_lv2', 154, 0),
(886, 20, '', '20250328085133_PO_(PT_Hidayat_Sentra_Teknik)_25-O550101-01_(Engineering_Subcontract).pdf', '2025-03-28 01:51:33', '202.69', 'PDF Document', 'https://achivon.app/dr_files/20250328085133_PO_%28PT_Hidayat_Sentra_Teknik%29_25-O550101-01_%28Engineering_Subcontract%29.pdf', '', 'sd_ho_lv2', 154, 0),
(887, 20, '', '20250328085154_PO_(PT_BERLIAN_PERMATA_ENERGI)_25-O550101-02_(Engineering_Subcontract).pdf', '2025-03-28 01:51:54', '203.09', 'PDF Document', 'https://achivon.app/dr_files/20250328085154_PO_%28PT_BERLIAN_PERMATA_ENERGI%29_25-O550101-02_%28Engineering_Subcontract%29.pdf', '', 'sd_ho_lv2', 154, 0),
(888, 20, '', '20250328085205_PO_(Gunawan_Gorden_Office_Curtain)_25-O550101-PHF00-01.pdf', '2025-03-28 01:52:05', '178.74', 'PDF Document', 'https://achivon.app/dr_files/20250328085205_PO_%28Gunawan_Gorden_Office_Curtain%29_25-O550101-PHF00-01.pdf', '', 'sd_ho_lv2', 154, 0),
(889, 23, '', '20250328085934_Piping_Material_List_Summary_Update(20250328).xlsx', '2025-03-28 01:59:34', '4955.06', 'Excel Document', 'https://achivon.app/dr_files/20250328085934_Piping_Material_List_Summary_Update%2820250328%29.xlsx', '', 'sd_ho_lv3', 247, 0),
(890, 23, '', '20250328093600_Piping_Material_List_Summary_Rev.1_(20250328).xlsx', '2025-03-28 02:59:47', '4955.24', 'Excel Document', 'https://achivon.app/dr_files/20250328093600_Piping_Material_List_Summary_Rev.1_%2820250328%29.xlsx', '', 'sd_ho_lv3', 247, 1),
(891, 14, '', '20250328095408_Subekti_Agus_Setyono_Safety_Officer__Safety_Coordinator_Resume.pdf', '2025-06-16 10:25:39', '250.78', 'PDF Document', 'https://achivon.app/dr_files/20250328095408_Subekti_Agus_Setyono_Safety_Officer__Safety_Coordinator_Resume.pdf', '', 'sd_ho_lv2', 153, 1),
(892, 23, '', '20250328101049_Piping_Material_List_Summary_Rev.1_(20250328).xlsx', '2025-03-28 10:10:49', '4955.3', 'Excel Document', 'https://achivon.app/dr_files/20250328101049_Piping_Material_List_Summary_Rev.1_%2820250328%29.xlsx', '', 'sd_ho_lv3', 247, 0),
(893, 23, '', '20250328125704_2C02400-42-2-0018_(220).dwg', '2025-03-28 12:57:04', '72.53', 'AutoCAD File', 'https://achivon.app/dr_files/20250328125704_2C02400-42-2-0018_%28220%29.dwg', '', 'sd_ho_lv6', 10, 0),
(894, 23, '', '20250328125717_2C02400-42-2-0025_(223).dwg', '2025-03-28 12:57:17', '312.03', 'AutoCAD File', 'https://achivon.app/dr_files/20250328125717_2C02400-42-2-0025_%28223%29.dwg', '', 'sd_ho_lv6', 10, 0),
(895, 23, '', '20250328125729_2C02400-42-2-0026_(224).dwg', '2025-03-28 12:57:29', '172.17', 'AutoCAD File', 'https://achivon.app/dr_files/20250328125729_2C02400-42-2-0026_%28224%29.dwg', '', 'sd_ho_lv6', 10, 0),
(896, 23, '', '20250328125736_2C02400-42-2-0028_(226).dwg', '2025-03-28 12:57:36', '103.77', 'AutoCAD File', 'https://achivon.app/dr_files/20250328125736_2C02400-42-2-0028_%28226%29.dwg', '', 'sd_ho_lv6', 10, 0),
(897, 23, '', '20250328125745_2C02400-42-2-0029_(227).dwg', '2025-03-28 12:57:45', '119.42', 'AutoCAD File', 'https://achivon.app/dr_files/20250328125745_2C02400-42-2-0029_%28227%29.dwg', '', 'sd_ho_lv6', 10, 0),
(898, 23, '', '20250328125800_2C02400-42-2-0030_(1of4)_(228).dwg', '2025-03-28 12:58:00', '148.29', 'AutoCAD File', 'https://achivon.app/dr_files/20250328125800_2C02400-42-2-0030_%281of4%29_%28228%29.dwg', '', 'sd_ho_lv6', 10, 0),
(899, 23, '', '20250328125811_2C02400-42-2-0030_(2of4)_(229).dwg', '2025-03-28 12:58:11', '125.64', 'AutoCAD File', 'https://achivon.app/dr_files/20250328125811_2C02400-42-2-0030_%282of4%29_%28229%29.dwg', '', 'sd_ho_lv6', 10, 0),
(900, 23, '', '20250328125820_2C02400-42-2-0030_(3of4)_(230)_(rev_5).dwg', '2025-03-28 12:58:20', '318.64', 'AutoCAD File', 'https://achivon.app/dr_files/20250328125820_2C02400-42-2-0030_%283of4%29_%28230%29_%28rev_5%29.dwg', '', 'sd_ho_lv6', 10, 0),
(901, 23, '', '20250328125834_2C02400-42-2-0030_(3of4)_(231)_(rev_2).dwg', '2025-03-28 12:58:34', '198.46', 'AutoCAD File', 'https://achivon.app/dr_files/20250328125834_2C02400-42-2-0030_%283of4%29_%28231%29_%28rev_2%29.dwg', '', 'sd_ho_lv6', 10, 0),
(902, 23, '', '20250328125846_2C02400-42-2-0030_(4of4)_(232).dwg', '2025-03-28 12:58:46', '127.43', 'AutoCAD File', 'https://achivon.app/dr_files/20250328125846_2C02400-42-2-0030_%284of4%29_%28232%29.dwg', '', 'sd_ho_lv6', 10, 0),
(903, 23, '', '20250328125903_2C02400-42-2-0031_(233).dwg', '2025-03-28 12:59:03', '123.02', 'AutoCAD File', 'https://achivon.app/dr_files/20250328125903_2C02400-42-2-0031_%28233%29.dwg', '', 'sd_ho_lv6', 10, 0),
(904, 23, '', '20250328125922_2C02400-42-2-0032_(234).dwg', '2025-03-28 12:59:22', '144.83', 'AutoCAD File', 'https://achivon.app/dr_files/20250328125922_2C02400-42-2-0032_%28234%29.dwg', '', 'sd_ho_lv6', 10, 0),
(905, 23, '', '20250328125934_2C02400-42-2-0036_(236).dwg', '2025-03-28 12:59:34', '123.28', 'AutoCAD File', 'https://achivon.app/dr_files/20250328125934_2C02400-42-2-0036_%28236%29.dwg', '', 'sd_ho_lv6', 10, 0),
(906, 23, '', '20250328125952_2C02400-42-2-0038_(2of2)_(239).dwg', '2025-03-28 12:59:52', '118.42', 'AutoCAD File', 'https://achivon.app/dr_files/20250328125952_2C02400-42-2-0038_%282of2%29_%28239%29.dwg', '', 'sd_ho_lv6', 10, 0),
(907, 23, '', '20250328130002_2C02400-42-2-0039_(240).dwg', '2025-03-28 13:00:02', '212.18', 'AutoCAD File', 'https://achivon.app/dr_files/20250328130002_2C02400-42-2-0039_%28240%29.dwg', '', 'sd_ho_lv6', 10, 0),
(908, 23, '', '20250328130013_2C02400-42-2-0043_(244).dwg', '2025-03-28 13:00:13', '209.5', 'AutoCAD File', 'https://achivon.app/dr_files/20250328130013_2C02400-42-2-0043_%28244%29.dwg', '', 'sd_ho_lv6', 10, 0),
(909, 23, '', '20250328130039_92C02400-41-1-0015G_(3of3)_(13).dwg', '2025-03-28 13:00:39', '164.73', 'AutoCAD File', 'https://achivon.app/dr_files/20250328130039_92C02400-41-1-0015G_%283of3%29_%2813%29.dwg', '', 'sd_ho_lv6', 10, 0),
(910, 23, '', '20250328130050_92C02400-42-1-0001G_(1of2)_(01).dwg', '2025-03-28 13:00:50', '199.2', 'AutoCAD File', 'https://achivon.app/dr_files/20250328130050_92C02400-42-1-0001G_%281of2%29_%2801%29.dwg', '', 'sd_ho_lv6', 10, 0),
(911, 23, '', '20250328130111_92C02400-42-1-0001G_(2of2)_(02).dwg', '2025-03-28 13:01:11', '168.22', 'AutoCAD File', 'https://achivon.app/dr_files/20250328130111_92C02400-42-1-0001G_%282of2%29_%2802%29.dwg', '', 'sd_ho_lv6', 10, 0),
(912, 23, '', '20250328130149_92C02400-42-1-0004G_(1of4)_(03).dwg', '2025-03-28 13:01:49', '140.84', 'AutoCAD File', 'https://achivon.app/dr_files/20250328130149_92C02400-42-1-0004G_%281of4%29_%2803%29.dwg', '', 'sd_ho_lv6', 10, 0),
(913, 23, '', '20250328130207_92C02400-42-1-0004G_(2of4)_(04).dwg', '2025-03-28 06:03:24', '206.36', 'AutoCAD File', 'https://achivon.app/dr_files/20250328130207_92C02400-42-1-0004G_%282of4%29_%2804%29.dwg', '', 'sd_ho_lv6', 10, 1),
(914, 23, '', '20250328130227_92C02400-42-1-0004G_(2of4)_(04).dwg', '2025-03-28 13:02:27', '206.36', 'AutoCAD File', 'https://achivon.app/dr_files/20250328130227_92C02400-42-1-0004G_%282of4%29_%2804%29.dwg', '', 'sd_ho_lv6', 10, 0),
(915, 23, '', '20250328130243_92C02400-42-1-0004G_(3of4)_(05).dwg', '2025-03-28 13:02:43', '248.5', 'AutoCAD File', 'https://achivon.app/dr_files/20250328130243_92C02400-42-1-0004G_%283of4%29_%2805%29.dwg', '', 'sd_ho_lv6', 10, 0),
(916, 23, '', '20250328130319_92C02400-42-1-0004G_(4of4)_(06).dwg', '2025-03-28 13:03:19', '125.72', 'AutoCAD File', 'https://achivon.app/dr_files/20250328130319_92C02400-42-1-0004G_%284of4%29_%2806%29.dwg', '', 'sd_ho_lv6', 10, 0),
(917, 23, '', '20250328130430_92C02400-42-1-0006_(07).dwg', '2025-03-28 13:04:30', '129.88', 'AutoCAD File', 'https://achivon.app/dr_files/20250328130430_92C02400-42-1-0006_%2807%29.dwg', '', 'sd_ho_lv6', 10, 0),
(918, 23, '', '20250328130455_92C02400-42-1-0008_(08).dwg', '2025-03-28 13:04:55', '112.32', 'AutoCAD File', 'https://achivon.app/dr_files/20250328130455_92C02400-42-1-0008_%2808%29.dwg', '', 'sd_ho_lv6', 10, 0),
(919, 23, '', '20250328130506_92C02400-42-1-0010G_(09).dwg', '2025-03-28 13:05:06', '130.22', 'AutoCAD File', 'https://achivon.app/dr_files/20250328130506_92C02400-42-1-0010G_%2809%29.dwg', '', 'sd_ho_lv6', 10, 0),
(920, 23, '', '20250328130528_92C02400-42-1-0014G_(10).dwg', '2025-03-28 13:05:28', '3751.99', 'AutoCAD File', 'https://achivon.app/dr_files/20250328130528_92C02400-42-1-0014G_%2810%29.dwg', '', 'sd_ho_lv6', 10, 0),
(921, 23, '', '20250328130531_92C02400-42-1-0014G_(10).dwg', '2025-03-28 06:05:40', '3751.99', 'AutoCAD File', 'https://achivon.app/dr_files/20250328130531_92C02400-42-1-0014G_%2810%29.dwg', '', 'sd_ho_lv6', 10, 1),
(922, 23, '', '20250328130600_92C02400-42-1-0015G_(1of3)_(11).dwg', '2025-03-28 13:06:00', '3756.07', 'AutoCAD File', 'https://achivon.app/dr_files/20250328130600_92C02400-42-1-0015G_%281of3%29_%2811%29.dwg', '', 'sd_ho_lv6', 10, 0),
(923, 23, '', '20250328130602_92C02400-42-1-0015G_(1of3)_(11).dwg', '2025-03-28 13:06:02', '3756.07', 'AutoCAD File', 'https://achivon.app/dr_files/20250328130602_92C02400-42-1-0015G_%281of3%29_%2811%29.dwg', '', 'sd_ho_lv6', 10, 0),
(924, 23, '', '20250328130637_92C02400-42-1-0015G_(2of3)(12).dwg', '2025-03-28 13:06:37', '3714.75', 'AutoCAD File', 'https://achivon.app/dr_files/20250328130637_92C02400-42-1-0015G_%282of3%29%2812%29.dwg', '', 'sd_ho_lv6', 10, 0),
(925, 23, '', '20250328130722_92C02400-42-1-0016E_(1of3)_(215).dwg', '2025-03-28 13:07:22', '109.83', 'AutoCAD File', 'https://achivon.app/dr_files/20250328130722_92C02400-42-1-0016E_%281of3%29_%28215%29.dwg', '', 'sd_ho_lv6', 10, 0),
(926, 23, '', '20250328130745_92C02400-42-1-0016E_(3of3)_(217).dwg', '2025-03-28 13:07:45', '315.45', 'AutoCAD File', 'https://achivon.app/dr_files/20250328130745_92C02400-42-1-0016E_%283of3%29_%28217%29.dwg', '', 'sd_ho_lv6', 10, 0),
(927, 23, '', '20250328130834_92C02400-42-1-0016F_(218).dwg', '2025-03-28 13:08:34', '128.96', 'AutoCAD File', 'https://achivon.app/dr_files/20250328130834_92C02400-42-1-0016F_%28218%29.dwg', '', 'sd_ho_lv6', 10, 0),
(928, 23, '', '20250328130900_92C02400-42-1-0017G_(1of2)(14).dwg', '2025-03-28 13:09:00', '3751.58', 'AutoCAD File', 'https://achivon.app/dr_files/20250328130900_92C02400-42-1-0017G_%281of2%29%2814%29.dwg', '', 'sd_ho_lv6', 10, 0),
(929, 23, '', '20250328130936_92C02400-42-1-0017G_(2of2)_(15).dwg', '2025-03-28 13:09:36', '5017.1', 'AutoCAD File', 'https://achivon.app/dr_files/20250328130936_92C02400-42-1-0017G_%282of2%29_%2815%29.dwg', '', 'sd_ho_lv6', 10, 0),
(930, 23, '', '20250328131006_92C02400-42-1-0017H_(144).dwg', '2025-03-28 13:10:06', '4408.58', 'AutoCAD File', 'https://achivon.app/dr_files/20250328131006_92C02400-42-1-0017H_%28144%29.dwg', '', 'sd_ho_lv6', 10, 0),
(931, 23, '', '20250328131051_92C02400-42-1-0021G_(16).dwg', '2025-03-28 13:10:51', '4977.31', 'AutoCAD File', 'https://achivon.app/dr_files/20250328131051_92C02400-42-1-0021G_%2816%29.dwg', '', 'sd_ho_lv6', 10, 0),
(932, 23, '', '20250328131123_92C02400-42-1-0025_(17).dwg', '2025-03-28 13:11:23', '109.37', 'AutoCAD File', 'https://achivon.app/dr_files/20250328131123_92C02400-42-1-0025_%2817%29.dwg', '', 'sd_ho_lv6', 10, 0),
(933, 23, '', '20250328131159_92C02400-42-1-0026_(18).dwg', '2025-03-28 13:11:59', '175.28', 'AutoCAD File', 'https://achivon.app/dr_files/20250328131159_92C02400-42-1-0026_%2818%29.dwg', '', 'sd_ho_lv6', 10, 0),
(934, 23, '', '20250328131223_92C02400-42-1-0045G_(1of4)_(19).dwg', '2025-03-28 13:12:23', '4870.31', 'AutoCAD File', 'https://achivon.app/dr_files/20250328131223_92C02400-42-1-0045G_%281of4%29_%2819%29.dwg', '', 'sd_ho_lv6', 10, 0),
(935, 23, '', '20250328131301_92C02400-42-1-0045G_(2of5)_(133).dwg', '2025-03-28 13:13:01', '117.6', 'AutoCAD File', 'https://achivon.app/dr_files/20250328131301_92C02400-42-1-0045G_%282of5%29_%28133%29.dwg', '', 'sd_ho_lv6', 10, 0),
(936, 23, '', '20250328131407_92C02400-42-1-0045G_(3of5)_(134).dwg', '2025-03-28 13:14:07', '120.2', 'AutoCAD File', 'https://achivon.app/dr_files/20250328131407_92C02400-42-1-0045G_%283of5%29_%28134%29.dwg', '', 'sd_ho_lv6', 10, 0),
(937, 23, '', '20250328131448_92C02400-42-1-0045G_(2of4)_(20).dwg', '2025-03-28 13:14:48', '4827.08', 'AutoCAD File', 'https://achivon.app/dr_files/20250328131448_92C02400-42-1-0045G_%282of4%29_%2820%29.dwg', '', 'sd_ho_lv6', 10, 0),
(938, 23, '', '20250328131523_92C02400-42-1-0045G_(4of5)_(135).dwg', '2025-03-28 13:15:23', '113.57', 'AutoCAD File', 'https://achivon.app/dr_files/20250328131523_92C02400-42-1-0045G_%284of5%29_%28135%29.dwg', '', 'sd_ho_lv6', 10, 0),
(939, 23, '', '20250328131556_92C02400-42-1-0045G_(5of5)_(136).dwg', '2025-03-28 13:15:56', '151', 'AutoCAD File', 'https://achivon.app/dr_files/20250328131556_92C02400-42-1-0045G_%285of5%29_%28136%29.dwg', '', 'sd_ho_lv6', 10, 0),
(940, 23, '', '20250328131634_92C02400-42-1-0045G_(132).dwg', '2025-03-28 13:16:34', '173.85', 'AutoCAD File', 'https://achivon.app/dr_files/20250328131634_92C02400-42-1-0045G_%28132%29.dwg', '', 'sd_ho_lv6', 10, 0),
(941, 23, '', '20250328131658_92C02400-42-1-0025_(17).dwg', '2025-03-28 06:18:19', '109.37', 'AutoCAD File', 'https://achivon.app/dr_files/20250328131658_92C02400-42-1-0025_%2817%29.dwg', '', 'sd_ho_lv6', 10, 1),
(942, 23, '', '20250328131801_92C02400-42-1-0046G_(23).dwg', '2025-03-28 13:18:01', '4795.88', 'AutoCAD File', 'https://achivon.app/dr_files/20250328131801_92C02400-42-1-0046G_%2823%29.dwg', '', 'sd_ho_lv6', 10, 0),
(943, 23, '', '20250328131845_92C02400-42-2-0047_(248).dwg', '2025-03-28 06:21:41', '124.6', 'AutoCAD File', 'https://achivon.app/dr_files/20250328131845_92C02400-42-2-0047_%28248%29.dwg', '', 'sd_ho_lv6', 10, 1),
(944, 23, '', '20250328132056_92C02400-42-1-0049G_(24).dwg', '2025-03-28 13:20:56', '285.09', 'AutoCAD File', 'https://achivon.app/dr_files/20250328132056_92C02400-42-1-0049G_%2824%29.dwg', '', 'sd_ho_lv6', 10, 0),
(945, 23, '', '20250328132137_92C02400-42-1-0050_(25).dwg', '2025-03-28 13:21:37', '237.03', 'AutoCAD File', 'https://achivon.app/dr_files/20250328132137_92C02400-42-1-0050_%2825%29.dwg', '', 'sd_ho_lv6', 10, 0),
(946, 23, '', '20250328132208_92C02400-42-1-0057G_(1of2)_(26).dwg', '2025-03-28 13:22:08', '4934.98', 'AutoCAD File', 'https://achivon.app/dr_files/20250328132208_92C02400-42-1-0057G_%281of2%29_%2826%29.dwg', '', 'sd_ho_lv6', 10, 0),
(947, 23, '', '20250328132236_92C02400-42-1-0057G_(2of2)_(27).dwg', '2025-03-28 13:22:36', '4836.93', 'AutoCAD File', 'https://achivon.app/dr_files/20250328132236_92C02400-42-1-0057G_%282of2%29_%2827%29.dwg', '', 'sd_ho_lv6', 10, 0),
(948, 23, '', '20250328133608_92C02400-42-1-0060G_(28).dwg', '2025-03-28 13:36:08', '117.24', 'AutoCAD File', 'https://achivon.app/dr_files/20250328133608_92C02400-42-1-0060G_%2828%29.dwg', '', 'sd_ho_lv6', 10, 0),
(949, 23, '', '20250328133625_92C02400-42-1-0080G_(29).dwg', '2025-03-28 13:36:25', '139.12', 'AutoCAD File', 'https://achivon.app/dr_files/20250328133625_92C02400-42-1-0080G_%2829%29.dwg', '', 'sd_ho_lv6', 10, 0),
(950, 23, '', '20250328133640_92C02400-42-1-0180G_(41).dwg', '2025-03-28 13:36:40', '137.78', 'AutoCAD File', 'https://achivon.app/dr_files/20250328133640_92C02400-42-1-0180G_%2841%29.dwg', '', 'sd_ho_lv6', 10, 0),
(951, 23, '', '20250328133651_92C02400-42-1-0586_(30).dwg', '2025-03-28 13:36:51', '96.64', 'AutoCAD File', 'https://achivon.app/dr_files/20250328133651_92C02400-42-1-0586_%2830%29.dwg', '', 'sd_ho_lv6', 10, 0),
(952, 23, '', '20250328133721_92C02400-42-1-0618_(82).dwg', '2025-03-28 13:37:21', '219.26', 'AutoCAD File', 'https://achivon.app/dr_files/20250328133721_92C02400-42-1-0618_%2882%29.dwg', '', 'sd_ho_lv6', 10, 0),
(953, 23, '', '20250328133745_92C02400-42-1-1005G_(31).dwg', '2025-03-28 13:37:45', '260.54', 'AutoCAD File', 'https://achivon.app/dr_files/20250328133745_92C02400-42-1-1005G_%2831%29.dwg', '', 'sd_ho_lv6', 10, 0),
(954, 23, '', '20250328133804_92C02400-42-1-2016_(32).dwg', '2025-03-28 13:38:04', '147.44', 'AutoCAD File', 'https://achivon.app/dr_files/20250328133804_92C02400-42-1-2016_%2832%29.dwg', '', 'sd_ho_lv6', 10, 0),
(955, 23, '', '20250328133821_92C02400-42-1-3000_(33).dwg', '2025-03-28 13:38:21', '3825.88', 'AutoCAD File', 'https://achivon.app/dr_files/20250328133821_92C02400-42-1-3000_%2833%29.dwg', '', 'sd_ho_lv6', 10, 0),
(956, 23, '', '20250328133844_92C02400-42-1-3010G_(34).dwg', '2025-03-28 13:38:44', '3806.28', 'AutoCAD File', 'https://achivon.app/dr_files/20250328133844_92C02400-42-1-3010G_%2834%29.dwg', '', 'sd_ho_lv6', 10, 0),
(957, 23, '', '20250328133902_92C02400-42-2-0001_(186).dwg', '2025-03-28 13:39:02', '185.95', 'AutoCAD File', 'https://achivon.app/dr_files/20250328133902_92C02400-42-2-0001_%28186%29.dwg', '', 'sd_ho_lv6', 10, 0),
(958, 23, '', '20250328133928_92C02400-42-2-0002_(1of2)_(188).dwg', '2025-03-28 13:39:28', '148.03', 'AutoCAD File', 'https://achivon.app/dr_files/20250328133928_92C02400-42-2-0002_%281of2%29_%28188%29.dwg', '', 'sd_ho_lv6', 10, 0),
(959, 23, '', '20250328133947_92C02400-42-2-0002_(2of2)_(190).dwg', '2025-03-28 13:39:47', '102.9', 'AutoCAD File', 'https://achivon.app/dr_files/20250328133947_92C02400-42-2-0002_%282of2%29_%28190%29.dwg', '', 'sd_ho_lv6', 10, 0),
(960, 23, '', '20250328134001_92C02400-42-2-0003_(192).dwg', '2025-03-28 13:40:01', '145.16', 'AutoCAD File', 'https://achivon.app/dr_files/20250328134001_92C02400-42-2-0003_%28192%29.dwg', '', 'sd_ho_lv6', 10, 0),
(961, 23, '', '20250328134013_92C02400-42-2-0004_(197).dwg', '2025-03-28 13:40:13', '109.22', 'AutoCAD File', 'https://achivon.app/dr_files/20250328134013_92C02400-42-2-0004_%28197%29.dwg', '', 'sd_ho_lv6', 10, 0),
(962, 23, '', '20250328134043_92C02400-42-2-0005_(1of2)_(195).dwg', '2025-03-28 13:40:43', '172.83', 'AutoCAD File', 'https://achivon.app/dr_files/20250328134043_92C02400-42-2-0005_%281of2%29_%28195%29.dwg', '', 'sd_ho_lv6', 10, 0),
(963, 23, '', '20250328134057_92C02400-42-2-0005_(2of2)_(198).dwg', '2025-03-28 13:40:57', '71.97', 'AutoCAD File', 'https://achivon.app/dr_files/20250328134057_92C02400-42-2-0005_%282of2%29_%28198%29.dwg', '', 'sd_ho_lv6', 10, 0),
(964, 23, '', '20250328134129_92C02400-42-2-0006_(200).dwg', '2025-03-28 13:41:29', '128.68', 'AutoCAD File', 'https://achivon.app/dr_files/20250328134129_92C02400-42-2-0006_%28200%29.dwg', '', 'sd_ho_lv6', 10, 0),
(965, 23, '', '20250328134147_92C02400-42-2-0007_(202).dwg', '2025-03-28 13:41:47', '122.61', 'AutoCAD File', 'https://achivon.app/dr_files/20250328134147_92C02400-42-2-0007_%28202%29.dwg', '', 'sd_ho_lv6', 10, 0),
(966, 23, '', '20250328134421_92C02400-42-2-0008_(204).dwg', '2025-03-28 13:44:21', '97.02', 'AutoCAD File', 'https://achivon.app/dr_files/20250328134421_92C02400-42-2-0008_%28204%29.dwg', '', 'sd_ho_lv6', 10, 0),
(967, 23, '', '20250328134434_92C02400-42-2-0009E_(206).dwg', '2025-03-28 13:44:34', '219.96', 'AutoCAD File', 'https://achivon.app/dr_files/20250328134434_92C02400-42-2-0009E_%28206%29.dwg', '', 'sd_ho_lv6', 10, 0),
(968, 23, '', '20250328134449_92C02400-42-2-0009F_(1of2)_(207).dwg', '2025-03-28 13:44:49', '126.15', 'AutoCAD File', 'https://achivon.app/dr_files/20250328134449_92C02400-42-2-0009F_%281of2%29_%28207%29.dwg', '', 'sd_ho_lv6', 10, 0),
(969, 23, '', '20250328134505_92C02400-42-2-0009F_(2of2)_(208).dwg', '2025-03-28 13:45:05', '122.14', 'AutoCAD File', 'https://achivon.app/dr_files/20250328134505_92C02400-42-2-0009F_%282of2%29_%28208%29.dwg', '', 'sd_ho_lv6', 10, 0),
(970, 23, '', '20250328134516_92C02400-42-2-0010_(209).dwg', '2025-03-28 13:45:16', '305.66', 'AutoCAD File', 'https://achivon.app/dr_files/20250328134516_92C02400-42-2-0010_%28209%29.dwg', '', 'sd_ho_lv6', 10, 0),
(971, 23, '', '20250328134531_92C02400-42-2-0011_(210).dwg', '2025-03-28 13:45:31', '95.12', 'AutoCAD File', 'https://achivon.app/dr_files/20250328134531_92C02400-42-2-0011_%28210%29.dwg', '', 'sd_ho_lv6', 10, 0),
(972, 23, '', '20250328134543_92C02400-42-2-0012_(211).dwg', '2025-03-28 13:45:43', '119.98', 'AutoCAD File', 'https://achivon.app/dr_files/20250328134543_92C02400-42-2-0012_%28211%29.dwg', '', 'sd_ho_lv6', 10, 0),
(973, 23, '', '20250328134552_92C02400-42-2-0013_(212).dwg', '2025-03-28 13:45:52', '117.79', 'AutoCAD File', 'https://achivon.app/dr_files/20250328134552_92C02400-42-2-0013_%28212%29.dwg', '', 'sd_ho_lv6', 10, 0),
(974, 23, '', '20250328134619_92C02400-42-2-0014_(213).dwg', '2025-03-28 13:46:19', '108.28', 'AutoCAD File', 'https://achivon.app/dr_files/20250328134619_92C02400-42-2-0014_%28213%29.dwg', '', 'sd_ho_lv6', 10, 0),
(975, 23, '', '20250328134646_92C02400-42-2-0015_(214).dwg', '2025-03-28 13:46:46', '131.21', 'AutoCAD File', 'https://achivon.app/dr_files/20250328134646_92C02400-42-2-0015_%28214%29.dwg', '', 'sd_ho_lv6', 10, 0),
(976, 23, '', '20250328134705_92C02400-42-2-0016E_(2of3)_(_(216).dwg', '2025-03-28 13:47:05', '140.81', 'AutoCAD File', 'https://achivon.app/dr_files/20250328134705_92C02400-42-2-0016E_%282of3%29_%28_%28216%29.dwg', '', 'sd_ho_lv6', 10, 0),
(977, 23, '', '20250328134717_92C02400-42-2-0017_(219).dwg', '2025-03-28 13:47:17', '97.96', 'AutoCAD File', 'https://achivon.app/dr_files/20250328134717_92C02400-42-2-0017_%28219%29.dwg', '', 'sd_ho_lv6', 10, 0),
(978, 23, '', '20250328134745_92C02400-42-2-0019_(221).dwg', '2025-03-28 13:47:45', '148.43', 'AutoCAD File', 'https://achivon.app/dr_files/20250328134745_92C02400-42-2-0019_%28221%29.dwg', '', 'sd_ho_lv6', 10, 0),
(979, 23, '', '20250328134801_92C02400-42-2-0020_(222).dwg', '2025-03-28 13:48:01', '223.67', 'AutoCAD File', 'https://achivon.app/dr_files/20250328134801_92C02400-42-2-0020_%28222%29.dwg', '', 'sd_ho_lv6', 10, 0),
(980, 23, '', '20250328134821_92C02400-42-2-0027_(225).dwg', '2025-03-28 13:48:21', '187.46', 'AutoCAD File', 'https://achivon.app/dr_files/20250328134821_92C02400-42-2-0027_%28225%29.dwg', '', 'sd_ho_lv6', 10, 0),
(981, 23, '', '20250328134854_92C02400-42-2-0034_(235).dwg', '2025-03-28 13:48:54', '113.79', 'AutoCAD File', 'https://achivon.app/dr_files/20250328134854_92C02400-42-2-0034_%28235%29.dwg', '', 'sd_ho_lv6', 10, 0),
(982, 23, '', '20250328134906_92C02400-42-2-0037_(237).dwg', '2025-03-28 13:49:06', '130.7', 'AutoCAD File', 'https://achivon.app/dr_files/20250328134906_92C02400-42-2-0037_%28237%29.dwg', '', 'sd_ho_lv6', 10, 0),
(983, 23, '', '20250328134926_92C02400-42-2-0038_(1of2)_(238).dwg', '2025-03-28 13:49:26', '148.31', 'AutoCAD File', 'https://achivon.app/dr_files/20250328134926_92C02400-42-2-0038_%281of2%29_%28238%29.dwg', '', 'sd_ho_lv6', 10, 0),
(984, 23, '', '20250328134944_92C02400-42-2-0040_(241).dwg', '2025-03-28 13:49:44', '176.05', 'AutoCAD File', 'https://achivon.app/dr_files/20250328134944_92C02400-42-2-0040_%28241%29.dwg', '', 'sd_ho_lv6', 10, 0),
(985, 23, '', '20250328135002_92C02400-42-2-0041_(242).dwg', '2025-03-28 13:50:02', '133.08', 'AutoCAD File', 'https://achivon.app/dr_files/20250328135002_92C02400-42-2-0041_%28242%29.dwg', '', 'sd_ho_lv6', 10, 0),
(986, 23, '', '20250328135027_92C02400-42-2-0042_(243).dwg', '2025-03-28 13:50:27', '208.89', 'AutoCAD File', 'https://achivon.app/dr_files/20250328135027_92C02400-42-2-0042_%28243%29.dwg', '', 'sd_ho_lv6', 10, 0),
(987, 23, '', '20250328135039_92C02400-42-2-0044_(245).dwg', '2025-03-28 13:50:39', '174.27', 'AutoCAD File', 'https://achivon.app/dr_files/20250328135039_92C02400-42-2-0044_%28245%29.dwg', '', 'sd_ho_lv6', 10, 0),
(988, 23, '', '20250328135105_92C02400-42-2-0045_(246).dwg', '2025-03-28 13:51:05', '130.83', 'AutoCAD File', 'https://achivon.app/dr_files/20250328135105_92C02400-42-2-0045_%28246%29.dwg', '', 'sd_ho_lv6', 10, 0),
(989, 23, '', '20250328135258_92C02400-42-2-0046_(247).dwg', '2025-03-28 13:52:58', '122.86', 'AutoCAD File', 'https://achivon.app/dr_files/20250328135258_92C02400-42-2-0046_%28247%29.dwg', '', 'sd_ho_lv6', 10, 0),
(990, 23, '', '20250328135306_92C02400-42-2-0047_(248).dwg', '2025-03-28 13:53:06', '124.6', 'AutoCAD File', 'https://achivon.app/dr_files/20250328135306_92C02400-42-2-0047_%28248%29.dwg', '', 'sd_ho_lv6', 10, 0),
(991, 23, '', '20250328135327_92C02400-42-2-0048F_(249).dwg', '2025-03-28 13:53:27', '155.32', 'AutoCAD File', 'https://achivon.app/dr_files/20250328135327_92C02400-42-2-0048F_%28249%29.dwg', '', 'sd_ho_lv6', 10, 0),
(992, 23, '', '20250328135614_92C02400-42-2-0048G_(35).dwg', '2025-03-28 13:56:14', '4382.68', 'AutoCAD File', 'https://achivon.app/dr_files/20250328135614_92C02400-42-2-0048G_%2835%29.dwg', '', 'sd_ho_lv6', 10, 0),
(993, 23, '', '20250328135701_92C02400-42-2-0051_(250).dwg', '2025-03-28 13:57:01', '160.53', 'AutoCAD File', 'https://achivon.app/dr_files/20250328135701_92C02400-42-2-0051_%28250%29.dwg', '', 'sd_ho_lv6', 10, 0),
(994, 23, '', '20250328135714_92C02400-42-2-0052_(251).dwg', '2025-03-28 13:57:14', '146.11', 'AutoCAD File', 'https://achivon.app/dr_files/20250328135714_92C02400-42-2-0052_%28251%29.dwg', '', 'sd_ho_lv6', 10, 0),
(995, 23, '', '20250328135724_92C02400-42-2-0053_(1of2)_(252).dwg', '2025-03-28 13:57:24', '176.73', 'AutoCAD File', 'https://achivon.app/dr_files/20250328135724_92C02400-42-2-0053_%281of2%29_%28252%29.dwg', '', 'sd_ho_lv6', 10, 0),
(996, 23, '', '20250328135737_92C02400-42-2-0053_(2of2)_(253).dwg', '2025-03-28 13:57:37', '131.42', 'AutoCAD File', 'https://achivon.app/dr_files/20250328135737_92C02400-42-2-0053_%282of2%29_%28253%29.dwg', '', 'sd_ho_lv6', 10, 0),
(997, 23, '', '20250328135757_92C02400-42-2-0054_(254).dwg', '2025-03-28 13:57:57', '146.31', 'AutoCAD File', 'https://achivon.app/dr_files/20250328135757_92C02400-42-2-0054_%28254%29.dwg', '', 'sd_ho_lv6', 10, 0),
(998, 23, '', '20250328135815_92C02400-42-2-0055_(1of4)_(255).dwg', '2025-03-28 13:58:15', '147.98', 'AutoCAD File', 'https://achivon.app/dr_files/20250328135815_92C02400-42-2-0055_%281of4%29_%28255%29.dwg', '', 'sd_ho_lv6', 10, 0),
(999, 23, '', '20250328135839_92C02400-42-2-0070G_(36).dwg', '2025-03-28 13:58:39', '3932.88', 'AutoCAD File', 'https://achivon.app/dr_files/20250328135839_92C02400-42-2-0070G_%2836%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1000, 23, '', '20250328135854_92C02400-42-2-0086G_(37).dwg', '2025-03-28 13:58:54', '211.43', 'AutoCAD File', 'https://achivon.app/dr_files/20250328135854_92C02400-42-2-0086G_%2837%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1001, 23, '', '20250328135905_92C02400-42-2-0087G_(38).dwg', '2025-03-28 13:59:05', '135.2', 'AutoCAD File', 'https://achivon.app/dr_files/20250328135905_92C02400-42-2-0087G_%2838%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1002, 23, '', '20250328135925_92C02400-42-2-0144G_(39).dwg', '2025-03-28 13:59:25', '3787.76', 'AutoCAD File', 'https://achivon.app/dr_files/20250328135925_92C02400-42-2-0144G_%2839%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1003, 23, '', '20250328135946_92C02400-42-2-0174G_(40).dwg', '2025-03-28 13:59:46', '3812.12', 'AutoCAD File', 'https://achivon.app/dr_files/20250328135946_92C02400-42-2-0174G_%2840%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1004, 23, '', '20250328140017_92C02400-42-2-0174G_(138).dwg', '2025-03-28 14:00:17', '119.69', 'AutoCAD File', 'https://achivon.app/dr_files/20250328140017_92C02400-42-2-0174G_%28138%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1005, 23, '', '20250328140034_92C02400-42-2-0189G_(42).dwg', '2025-03-28 14:00:34', '86.73', 'AutoCAD File', 'https://achivon.app/dr_files/20250328140034_92C02400-42-2-0189G_%2842%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1006, 23, '', '20250328140053_92C02400-42-2-0212G_(43).dwg', '2025-03-28 14:00:53', '150.74', 'AutoCAD File', 'https://achivon.app/dr_files/20250328140053_92C02400-42-2-0212G_%2843%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1007, 23, '', '20250328140120_92C02400-42-2-0212G_(139).dwg', '2025-03-28 14:01:20', '162.25', 'AutoCAD File', 'https://achivon.app/dr_files/20250328140120_92C02400-42-2-0212G_%28139%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1008, 23, '', '20250328140141_92C02400-42-2-0405G_(44).dwg', '2025-03-28 14:01:41', '127.78', 'AutoCAD File', 'https://achivon.app/dr_files/20250328140141_92C02400-42-2-0405G_%2844%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1009, 23, '', '20250328140200_92C02400-42-3-0005G_(45).dwg', '2025-03-28 14:02:00', '145.66', 'AutoCAD File', 'https://achivon.app/dr_files/20250328140200_92C02400-42-3-0005G_%2845%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1010, 23, '', '20250328140216_92C02400-42-3-0006_(145).dwg', '2025-03-28 14:02:16', '120.84', 'AutoCAD File', 'https://achivon.app/dr_files/20250328140216_92C02400-42-3-0006_%28145%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1011, 23, '', '20250328140232_92C02400-42-3-0015_(46).dwg', '2025-03-28 14:02:32', '171.11', 'AutoCAD File', 'https://achivon.app/dr_files/20250328140232_92C02400-42-3-0015_%2846%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1012, 23, '', '20250328140256_92C02400-42-3-0016_(1of2)_(146).dwg', '2025-03-28 14:02:56', '183.41', 'AutoCAD File', 'https://achivon.app/dr_files/20250328140256_92C02400-42-3-0016_%281of2%29_%28146%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1013, 23, '', '20250328140309_92C02400-42-3-0016_(2of2)_(147).dwg', '2025-03-28 14:03:09', '143.4', 'AutoCAD File', 'https://achivon.app/dr_files/20250328140309_92C02400-42-3-0016_%282of2%29_%28147%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1014, 23, '', '20250328140327_92C02400-42-3-0019_(148).dwg', '2025-03-28 14:03:27', '64.65', 'AutoCAD File', 'https://achivon.app/dr_files/20250328140327_92C02400-42-3-0019_%28148%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1015, 23, '', '20250328140354_92C02400-42-3-0020_(149).dwg', '2025-03-28 14:03:54', '73.76', 'AutoCAD File', 'https://achivon.app/dr_files/20250328140354_92C02400-42-3-0020_%28149%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1016, 23, '', '20250328140407_92C02400-42-3-0021_(150).dwg', '2025-03-28 14:04:07', '72.85', 'AutoCAD File', 'https://achivon.app/dr_files/20250328140407_92C02400-42-3-0021_%28150%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1017, 23, '', '20250328140431_92C02400-42-3-0022G_(47).dwg', '2025-03-28 14:04:31', '3779.92', 'AutoCAD File', 'https://achivon.app/dr_files/20250328140431_92C02400-42-3-0022G_%2847%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1018, 23, '', '20250328140500_92C02400-42-3-0022G_(47).dwg', '2025-03-28 07:05:07', '3779.92', 'AutoCAD File', 'https://achivon.app/dr_files/20250328140500_92C02400-42-3-0022G_%2847%29.dwg', '', 'sd_ho_lv6', 10, 1),
(1019, 23, '', '20250328140522_92C02400-42-3-0023_(151).dwg', '2025-03-28 14:05:22', '164.5', 'AutoCAD File', 'https://achivon.app/dr_files/20250328140522_92C02400-42-3-0023_%28151%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1020, 23, '', '20250328140551_92C02400-42-3-0025_(152).dwg', '2025-03-28 14:05:51', '4746.21', 'AutoCAD File', 'https://achivon.app/dr_files/20250328140551_92C02400-42-3-0025_%28152%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1021, 23, '', '20250328140610_92C02400-42-3-0026_(153).dwg', '2025-03-28 14:06:10', '122.54', 'AutoCAD File', 'https://achivon.app/dr_files/20250328140610_92C02400-42-3-0026_%28153%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1022, 23, '', '20250328140626_92C02400-42-3-0027G_(48).dwg', '2025-03-28 14:06:26', '3815.53', 'AutoCAD File', 'https://achivon.app/dr_files/20250328140626_92C02400-42-3-0027G_%2848%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1023, 23, '', '20250328140642_92C02400-42-3-0027H_(154).dwg', '2025-03-28 14:06:42', '173.45', 'AutoCAD File', 'https://achivon.app/dr_files/20250328140642_92C02400-42-3-0027H_%28154%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1024, 23, '', '20250328140658_92C02400-42-3-0029_(49).dwg', '2025-03-28 14:06:58', '145.88', 'AutoCAD File', 'https://achivon.app/dr_files/20250328140658_92C02400-42-3-0029_%2849%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1025, 23, '', '20250328140712_92C02400-42-3-0047G_(155).dwg', '2025-03-28 14:07:12', '105.38', 'AutoCAD File', 'https://achivon.app/dr_files/20250328140712_92C02400-42-3-0047G_%28155%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1026, 23, '', '20250328140746_92C02400-42-3-0047H_(156).dwg', '2025-03-28 14:07:46', '103.06', 'AutoCAD File', 'https://achivon.app/dr_files/20250328140746_92C02400-42-3-0047H_%28156%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1027, 23, '', '20250328140817_92C02400-42-3-0048H_(1of3)_(157).dwg', '2025-03-28 14:08:17', '113.25', 'AutoCAD File', 'https://achivon.app/dr_files/20250328140817_92C02400-42-3-0048H_%281of3%29_%28157%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1028, 23, '', '20250328140833_92C02400-42-3-0048H_(2of3)_(158).dwg', '2025-03-28 14:08:33', '158.06', 'AutoCAD File', 'https://achivon.app/dr_files/20250328140833_92C02400-42-3-0048H_%282of3%29_%28158%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1029, 23, '', '20250328140902_92C02400-42-3-0048H_(3of3)_(159).dwg', '2025-03-28 14:09:02', '102.06', 'AutoCAD File', 'https://achivon.app/dr_files/20250328140902_92C02400-42-3-0048H_%283of3%29_%28159%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1030, 23, '', '20250328140918_92C02400-42-3-0049_(1of5)_(160).dwg', '2025-03-28 14:09:18', '181.01', 'AutoCAD File', 'https://achivon.app/dr_files/20250328140918_92C02400-42-3-0049_%281of5%29_%28160%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1031, 23, '', '20250328140933_92C02400-42-3-0049_(2of5)(161).dwg', '2025-03-28 14:09:33', '123.62', 'AutoCAD File', 'https://achivon.app/dr_files/20250328140933_92C02400-42-3-0049_%282of5%29%28161%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1032, 23, '', '20250328141010_92C02400-42-3-0049_(3of5)_(162).dwg', '2025-03-28 14:10:10', '191.7', 'AutoCAD File', 'https://achivon.app/dr_files/20250328141010_92C02400-42-3-0049_%283of5%29_%28162%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1033, 23, '', '20250328141022_92C02400-42-3-0049_(4of5)_(163).dwg', '2025-03-28 14:10:22', '64.81', 'AutoCAD File', 'https://achivon.app/dr_files/20250328141022_92C02400-42-3-0049_%284of5%29_%28163%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1034, 23, '', '20250328141031_92C02400-42-3-0049_(5of5)_(164).dwg', '2025-03-28 14:10:31', '122.71', 'AutoCAD File', 'https://achivon.app/dr_files/20250328141031_92C02400-42-3-0049_%285of5%29_%28164%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1035, 23, '', '20250328141057_92C02400-42-3-0050G_(50).dwg', '2025-03-28 14:10:57', '4735.03', 'AutoCAD File', 'https://achivon.app/dr_files/20250328141057_92C02400-42-3-0050G_%2850%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1036, 23, '', '20250328141117_92C02400-42-3-0050H_(1of3)_(165).dwg', '2025-03-28 14:11:17', '206.94', 'AutoCAD File', 'https://achivon.app/dr_files/20250328141117_92C02400-42-3-0050H_%281of3%29_%28165%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1037, 23, '', '20250328141131_92C02400-42-3-0050H_(2of3)_(166).dwg', '2025-03-28 14:11:31', '166.5', 'AutoCAD File', 'https://achivon.app/dr_files/20250328141131_92C02400-42-3-0050H_%282of3%29_%28166%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1038, 23, '', '20250328141206_92C02400-42-3-0050H_(3of3)_(167).dwg', '2025-03-28 14:12:06', '107.97', 'AutoCAD File', 'https://achivon.app/dr_files/20250328141206_92C02400-42-3-0050H_%283of3%29_%28167%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1039, 23, '', '20250328141234_92C02400-42-3-0055_(168).dwg', '2025-03-28 14:12:34', '187.08', 'AutoCAD File', 'https://achivon.app/dr_files/20250328141234_92C02400-42-3-0055_%28168%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1040, 23, '', '20250328141247_92C02400-42-3-0056_(1of3)_(169).dwg', '2025-03-28 14:12:47', '130.45', 'AutoCAD File', 'https://achivon.app/dr_files/20250328141247_92C02400-42-3-0056_%281of3%29_%28169%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1041, 23, '', '20250328141304_92C02400-42-3-0056_(2of3)_(170).dwg', '2025-03-28 14:13:04', '214.29', 'AutoCAD File', 'https://achivon.app/dr_files/20250328141304_92C02400-42-3-0056_%282of3%29_%28170%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1042, 23, '', '20250328141336_92C02400-42-3-0056_(3of3)_(171).dwg', '2025-03-28 14:13:36', '120.29', 'AutoCAD File', 'https://achivon.app/dr_files/20250328141336_92C02400-42-3-0056_%283of3%29_%28171%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1043, 23, '', '20250328141410_92C02400-42-3-0057G_(51).dwg', '2025-03-28 14:14:10', '335.87', 'AutoCAD File', 'https://achivon.app/dr_files/20250328141410_92C02400-42-3-0057G_%2851%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1044, 23, '', '20250328141430_92C02400-42-3-0057G_(51).dwg', '2025-03-28 07:14:45', '335.87', 'AutoCAD File', 'https://achivon.app/dr_files/20250328141430_92C02400-42-3-0057G_%2851%29.dwg', '', 'sd_ho_lv6', 10, 1);
INSERT INTO `dr_file` (`id`, `id_user`, `subject`, `name_file`, `upload_date`, `size`, `type_file`, `link`, `remark`, `table_name`, `id_table`, `is_aktiv`) VALUES
(1045, 23, '', '20250328141606_92C02400-42-3-0057H_(1of2)_(172).dwg', '2025-03-28 14:16:06', '227.51', 'AutoCAD File', 'https://achivon.app/dr_files/20250328141606_92C02400-42-3-0057H_%281of2%29_%28172%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1046, 23, '', '20250328141624_92C02400-42-3-0057H_(2of2)_(173).dwg', '2025-03-28 14:16:24', '135.1', 'AutoCAD File', 'https://achivon.app/dr_files/20250328141624_92C02400-42-3-0057H_%282of2%29_%28173%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1047, 23, '', '20250328141636_92C02400-42-3-0058_(174).dwg', '2025-03-28 14:16:36', '117.72', 'AutoCAD File', 'https://achivon.app/dr_files/20250328141636_92C02400-42-3-0058_%28174%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1048, 23, '', '20250328141653_92C02400-42-3-0060G_(52).dwg', '2025-03-28 14:16:53', '90.52', 'AutoCAD File', 'https://achivon.app/dr_files/20250328141653_92C02400-42-3-0060G_%2852%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1049, 23, '', '20250328141720_92C02400-42-3-0061G_(53).dwg', '2025-03-28 14:17:20', '3922.76', 'AutoCAD File', 'https://achivon.app/dr_files/20250328141720_92C02400-42-3-0061G_%2853%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1050, 23, '', '20250328141750_92C02400-42-3-0062_(175).dwg', '2025-03-28 14:17:50', '110.13', 'AutoCAD File', 'https://achivon.app/dr_files/20250328141750_92C02400-42-3-0062_%28175%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1051, 23, '', '20250328141809_92C02400-42-3-0063G_(54).dwg', '2025-03-28 14:18:09', '326.13', 'AutoCAD File', 'https://achivon.app/dr_files/20250328141809_92C02400-42-3-0063G_%2854%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1052, 23, '', '20250328141840_92C02400-42-3-0064G_(55).dwg', '2025-03-28 14:18:40', '200.3', 'AutoCAD File', 'https://achivon.app/dr_files/20250328141840_92C02400-42-3-0064G_%2855%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1053, 23, '', '20250328141859_92C02400-42-3-0082_(176).dwg', '2025-03-28 14:18:59', '164.41', 'AutoCAD File', 'https://achivon.app/dr_files/20250328141859_92C02400-42-3-0082_%28176%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1054, 23, '', '20250328141930_92C02400-42-3-0083_(177).dwg', '2025-03-28 14:19:30', '153.43', 'AutoCAD File', 'https://achivon.app/dr_files/20250328141930_92C02400-42-3-0083_%28177%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1055, 23, '', '20250328141956_92C02400-42-3-0084_(178).dwg', '2025-03-28 14:19:56', '161.41', 'AutoCAD File', 'https://achivon.app/dr_files/20250328141956_92C02400-42-3-0084_%28178%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1056, 23, '', '20250328142031_92C02400-42-3-0085_(179).dwg', '2025-03-28 14:20:31', '154.71', 'AutoCAD File', 'https://achivon.app/dr_files/20250328142031_92C02400-42-3-0085_%28179%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1057, 23, '', '20250328142057_92C02400-42-3-0086_(180).dwg', '2025-03-28 14:20:57', '147.68', 'AutoCAD File', 'https://achivon.app/dr_files/20250328142057_92C02400-42-3-0086_%28180%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1058, 23, '', '20250328142121_92C02400-42-3-0087_(181).dwg', '2025-03-28 14:21:21', '153.03', 'AutoCAD File', 'https://achivon.app/dr_files/20250328142121_92C02400-42-3-0087_%28181%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1059, 23, '', '20250328142202_92C02400-42-3-0088_(182).dwg', '2025-03-28 14:22:02', '151.78', 'AutoCAD File', 'https://achivon.app/dr_files/20250328142202_92C02400-42-3-0088_%28182%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1060, 23, '', '20250328142254_92C02400-42-3-0089_(183).dwg', '2025-03-28 14:22:54', '148.21', 'AutoCAD File', 'https://achivon.app/dr_files/20250328142254_92C02400-42-3-0089_%28183%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1061, 23, '', '20250328142341_92C02400-42-3-0165_(1of3)_(56).dwg', '2025-03-28 14:23:41', '171.59', 'AutoCAD File', 'https://achivon.app/dr_files/20250328142341_92C02400-42-3-0165_%281of3%29_%2856%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1062, 23, '', '20250328142358_92C02400-42-3-0165_(2of3)_(57).dwg', '2025-03-28 14:23:58', '3819.65', 'AutoCAD File', 'https://achivon.app/dr_files/20250328142358_92C02400-42-3-0165_%282of3%29_%2857%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1063, 23, '', '20250328142416_92C02400-42-3-0165_(3of3)_(58).dwg', '2025-03-28 14:24:16', '162.78', 'AutoCAD File', 'https://achivon.app/dr_files/20250328142416_92C02400-42-3-0165_%283of3%29_%2858%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1064, 23, '', '20250328142439_92C02400-42-3-0166_(1of2)_(59).dwg', '2025-03-28 14:24:39', '131.33', 'AutoCAD File', 'https://achivon.app/dr_files/20250328142439_92C02400-42-3-0166_%281of2%29_%2859%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1065, 23, '', '20250328142507_92C02400-42-3-0166_(2of2)_(60).dwg', '2025-03-28 14:25:07', '157.01', 'AutoCAD File', 'https://achivon.app/dr_files/20250328142507_92C02400-42-3-0166_%282of2%29_%2860%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1066, 23, '', '20250328142527_92C02400-42-3-0181_(61).dwg', '2025-03-28 14:25:27', '157.53', 'AutoCAD File', 'https://achivon.app/dr_files/20250328142527_92C02400-42-3-0181_%2861%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1067, 23, '', '20250328142548_92C02400-42-3-0184_(62).dwg', '2025-03-28 14:25:48', '157.07', 'AutoCAD File', 'https://achivon.app/dr_files/20250328142548_92C02400-42-3-0184_%2862%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1068, 23, '', '20250328142604_92C02400-42-3-0190_(63).dwg', '2025-03-28 14:26:04', '4294.99', 'AutoCAD File', 'https://achivon.app/dr_files/20250328142604_92C02400-42-3-0190_%2863%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1069, 23, '', '20250328142613_92C02400-42-3-0192_(64).dwg', '2025-03-28 14:26:13', '122.04', 'AutoCAD File', 'https://achivon.app/dr_files/20250328142613_92C02400-42-3-0192_%2864%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1070, 23, '', '20250328142630_92C02400-42-3-0193_(65).dwg', '2025-03-28 14:26:30', '173.74', 'AutoCAD File', 'https://achivon.app/dr_files/20250328142630_92C02400-42-3-0193_%2865%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1071, 23, '', '20250328142642_92C02400-42-3-0194_(66).dwg', '2025-03-28 14:26:42', '219.09', 'AutoCAD File', 'https://achivon.app/dr_files/20250328142642_92C02400-42-3-0194_%2866%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1072, 23, '', '20250328142653_92C02400-42-3-0195_(67).dwg', '2025-03-28 14:26:53', '202.38', 'AutoCAD File', 'https://achivon.app/dr_files/20250328142653_92C02400-42-3-0195_%2867%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1073, 23, '', '20250328142722_92C02400-42-3-0196_(68).dwg', '2025-03-28 14:27:22', '213.31', 'AutoCAD File', 'https://achivon.app/dr_files/20250328142722_92C02400-42-3-0196_%2868%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1074, 23, '', '20250328142735_92C02400-42-3-0199_(184).dwg', '2025-03-28 14:27:35', '132.94', 'AutoCAD File', 'https://achivon.app/dr_files/20250328142735_92C02400-42-3-0199_%28184%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1075, 23, '', '20250328142749_92C02400-42-3-0200G_(69).dwl2', '2025-03-28 07:39:45', '0.19', 'Other', 'https://achivon.app/dr_files/20250328142749_92C02400-42-3-0200G_%2869%29.dwl2', '', 'sd_ho_lv6', 10, 1),
(1076, 23, '', '20250328142752_Structure_Material_List_Summary_Updated_Rev._1_(20250328).xlsx', '2025-03-28 14:27:52', '1651.79', 'Excel Document', 'https://achivon.app/dr_files/20250328142752_Structure_Material_List_Summary_Updated_Rev._1_%2820250328%29.xlsx', '', 'sd_ho_lv3', 245, 0),
(1077, 23, '', '20250328142820_92C02400-42-3-0215_(70).dwg', '2025-03-28 14:28:20', '291.52', 'AutoCAD File', 'https://achivon.app/dr_files/20250328142820_92C02400-42-3-0215_%2870%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1078, 23, '', '20250328142911_92C02400-42-3-0216_(1of2)_(71).dwg', '2025-03-28 14:29:11', '135.84', 'AutoCAD File', 'https://achivon.app/dr_files/20250328142911_92C02400-42-3-0216_%281of2%29_%2871%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1079, 23, '', '20250328142943_92C02400-42-3-0216_(2of2)_(72).dwg', '2025-03-28 14:29:43', '165.03', 'AutoCAD File', 'https://achivon.app/dr_files/20250328142943_92C02400-42-3-0216_%282of2%29_%2872%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1080, 23, '', '20250328143823_92C02400-42-3-0217_(73).dwg', '2025-03-28 14:38:23', '276.66', 'AutoCAD File', 'https://achivon.app/dr_files/20250328143823_92C02400-42-3-0217_%2873%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1081, 23, '', '20250328143844_92C02400-42-3-0218G_(1of2)_(74).dwg', '2025-03-28 14:38:44', '154.32', 'AutoCAD File', 'https://achivon.app/dr_files/20250328143844_92C02400-42-3-0218G_%281of2%29_%2874%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1082, 23, '', '20250328143855_92C02400-42-3-0218G_(2of2)_(75).dwl', '2025-03-28 07:39:10', '0.04', 'Other', 'https://achivon.app/dr_files/20250328143855_92C02400-42-3-0218G_%282of2%29_%2875%29.dwl', '', 'sd_ho_lv6', 10, 1),
(1083, 23, '', '20250328143926_92C02400-42-3-0218G_(2of2)_(75).dwg', '2025-03-28 14:39:26', '137.02', 'AutoCAD File', 'https://achivon.app/dr_files/20250328143926_92C02400-42-3-0218G_%282of2%29_%2875%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1084, 23, '', '20250328144001_92C02400-42-3-0200G_(69).dwg', '2025-03-28 14:40:01', '153.83', 'AutoCAD File', 'https://achivon.app/dr_files/20250328144001_92C02400-42-3-0200G_%2869%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1085, 23, '', '20250328144104_92C02400-42-3-0219_(76).dwg', '2025-03-28 14:41:04', '148.37', 'AutoCAD File', 'https://achivon.app/dr_files/20250328144104_92C02400-42-3-0219_%2876%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1086, 23, '', '20250328144120_92C02400-42-3-0220_(185).dwg', '2025-03-28 14:41:20', '95.08', 'AutoCAD File', 'https://achivon.app/dr_files/20250328144120_92C02400-42-3-0220_%28185%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1087, 23, '', '20250328144139_92C02400-42-3-0221G_(77).dwg', '2025-03-28 14:41:39', '312.49', 'AutoCAD File', 'https://achivon.app/dr_files/20250328144139_92C02400-42-3-0221G_%2877%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1088, 23, '', '20250328144155_92C02400-42-3-0221G_(77).dwg', '2025-03-28 07:42:00', '312.49', 'AutoCAD File', 'https://achivon.app/dr_files/20250328144155_92C02400-42-3-0221G_%2877%29.dwg', '', 'sd_ho_lv6', 10, 1),
(1089, 23, '', '20250328144209_92C02400-42-3-0601_(78).dwg', '2025-03-28 14:42:09', '159.07', 'AutoCAD File', 'https://achivon.app/dr_files/20250328144209_92C02400-42-3-0601_%2878%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1090, 23, '', '20250328144227_92C02400-42-3-0615_(79).dwg', '2025-03-28 14:42:27', '245.11', 'AutoCAD File', 'https://achivon.app/dr_files/20250328144227_92C02400-42-3-0615_%2879%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1091, 23, '', '20250328144244_92C02400-42-3-0616_(80).dwg', '2025-03-28 14:42:44', '88.01', 'AutoCAD File', 'https://achivon.app/dr_files/20250328144244_92C02400-42-3-0616_%2880%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1092, 23, '', '20250328144303_92C02400-42-3-0617_(81).dwg', '2025-03-28 14:43:03', '127.86', 'AutoCAD File', 'https://achivon.app/dr_files/20250328144303_92C02400-42-3-0617_%2881%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1093, 23, '', '20250328144324_92C02400-42-4-0002_(83).dwg', '2025-03-28 14:43:24', '153.93', 'AutoCAD File', 'https://achivon.app/dr_files/20250328144324_92C02400-42-4-0002_%2883%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1094, 23, '', '20250328144341_92C02400-42-4-0004G_(84).dwg', '2025-03-28 14:43:41', '147.76', 'AutoCAD File', 'https://achivon.app/dr_files/20250328144341_92C02400-42-4-0004G_%2884%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1095, 23, '', '20250328144354_92C02400-42-4-0008G_(85).dwg', '2025-03-28 14:43:54', '86.18', 'AutoCAD File', 'https://achivon.app/dr_files/20250328144354_92C02400-42-4-0008G_%2885%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1096, 23, '', '20250328144416_92C02400-42-4-0010G_(86).dwg', '2025-03-28 14:44:16', '189.09', 'AutoCAD File', 'https://achivon.app/dr_files/20250328144416_92C02400-42-4-0010G_%2886%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1097, 23, '', '20250328144441_92C02400-42-4-0015_(87).dwg', '2025-03-28 14:44:41', '169.04', 'AutoCAD File', 'https://achivon.app/dr_files/20250328144441_92C02400-42-4-0015_%2887%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1098, 23, '', '20250328144452_92C02400-42-4-0016_(88).dwg', '2025-03-28 14:44:52', '167.94', 'AutoCAD File', 'https://achivon.app/dr_files/20250328144452_92C02400-42-4-0016_%2888%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1099, 23, '', '20250328144504_92C02400-42-4-0065G_(89).dwg', '2025-03-28 14:45:04', '183.58', 'AutoCAD File', 'https://achivon.app/dr_files/20250328144504_92C02400-42-4-0065G_%2889%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1100, 23, '', '20250328144520_92C02400-42-4-0174G_(90).dwg', '2025-03-28 14:45:20', '105.55', 'AutoCAD File', 'https://achivon.app/dr_files/20250328144520_92C02400-42-4-0174G_%2890%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1101, 23, '', '20250328144548_92C02400-42-4-0200G_(91).dwg', '2025-03-28 14:45:48', '113.94', 'AutoCAD File', 'https://achivon.app/dr_files/20250328144548_92C02400-42-4-0200G_%2891%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1102, 23, '', '20250328144613_92C02400-42-4-0801G_(92).dwg', '2025-03-28 14:46:13', '204.44', 'AutoCAD File', 'https://achivon.app/dr_files/20250328144613_92C02400-42-4-0801G_%2892%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1103, 23, '', '20250328144643_92C02400-42-5-0019G_(93).dwg', '2025-03-28 14:46:43', '111.97', 'AutoCAD File', 'https://achivon.app/dr_files/20250328144643_92C02400-42-5-0019G_%2893%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1104, 23, '', '20250328144658_92C02400-42-5-0024G_(94).dwg', '2025-03-28 14:46:58', '135.88', 'AutoCAD File', 'https://achivon.app/dr_files/20250328144658_92C02400-42-5-0024G_%2894%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1105, 23, '', '20250328144715_92C02400-42-5-0054G_(95).dwg', '2025-03-28 14:47:15', '171.19', 'AutoCAD File', 'https://achivon.app/dr_files/20250328144715_92C02400-42-5-0054G_%2895%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1106, 23, '', '20250328144731_92C02400-42-5-0397G_(96).dwg', '2025-03-28 14:47:31', '4397.56', 'AutoCAD File', 'https://achivon.app/dr_files/20250328144731_92C02400-42-5-0397G_%2896%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1107, 23, '', '20250328144742_92C02400-42-5-0467G_(97).dwg', '2025-03-28 14:47:42', '248.47', 'AutoCAD File', 'https://achivon.app/dr_files/20250328144742_92C02400-42-5-0467G_%2897%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1108, 23, '', '20250328144756_92C02400-42-5-0482G_(98).dwg', '2025-03-28 14:47:56', '265.63', 'AutoCAD File', 'https://achivon.app/dr_files/20250328144756_92C02400-42-5-0482G_%2898%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1109, 23, '', '20250328144813_92C02400-42-5-0485G_(99).dwg', '2025-03-28 14:48:13', '551.36', 'AutoCAD File', 'https://achivon.app/dr_files/20250328144813_92C02400-42-5-0485G_%2899%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1110, 23, '', '20250328144829_92C02400-42-5-0487G_(100).dwg', '2025-03-28 14:48:29', '425.74', 'AutoCAD File', 'https://achivon.app/dr_files/20250328144829_92C02400-42-5-0487G_%28100%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1111, 23, '', '20250328144841_92C02400-42-7-0004G_(101).dwg', '2025-03-28 14:48:41', '173.73', 'AutoCAD File', 'https://achivon.app/dr_files/20250328144841_92C02400-42-7-0004G_%28101%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1112, 23, '', '20250328144923_92C02400-42-7-0004G_(140).dwg', '2025-03-28 14:49:23', '3765.14', 'AutoCAD File', 'https://achivon.app/dr_files/20250328144923_92C02400-42-7-0004G_%28140%29.dwg', '', 'sd_ho_lv6', 10, 0),
(1113, 21, '', '20250328170828_Chemical_plant_Achivon-MS_CNP_Meeting_Memo_20250225.pdf', '2025-03-28 17:08:28', '149.28', 'PDF Document', 'https://achivon.app/dr_files/20250328170828_Chemical_plant_Achivon-MS_CNP_Meeting_Memo_20250225.pdf', '', 'sd_ho_lv3', 248, 0),
(1114, 21, '', '20250328171055_Comparison_List_of_Steel_Structure_Material_(20250328).xlsx', '2025-03-28 17:10:55', '2564.8', 'Excel Document', 'https://achivon.app/dr_files/20250328171055_Comparison_List_of_Steel_Structure_Material_%2820250328%29.xlsx', '', 'sd_ho_lv4', 54, 0),
(1115, 21, '', '20250328171558_NSBLISLE2024-VIII0639_-_FY25_-_CERTIFICATE_OF_DISTRIBUTOR_-_CV__SAMUDERA_JAYA_ABADI.pdf', '2025-03-28 17:15:58', '244.3', 'PDF Document', 'https://achivon.app/dr_files/20250328171558_NSBLISLE2024-VIII0639_-_FY25_-_CERTIFICATE_OF_DISTRIBUTOR_-_CV__SAMUDERA_JAYA_ABADI.pdf', '', 'sd_ho_lv7', 10, 0),
(1116, 21, '', '20250328171612_SJA_Penawaran_-_Project_KN_Berau.pdf', '2025-03-28 17:16:12', '234.72', 'PDF Document', 'https://achivon.app/dr_files/20250328171612_SJA_Penawaran_-_Project_KN_Berau.pdf', '', 'sd_ho_lv7', 10, 0),
(1117, 21, '', '20250328171623_Catalogue-November-2022-edition.pdf', '2025-03-28 17:16:23', '1393.21', 'PDF Document', 'https://achivon.app/dr_files/20250328171623_Catalogue-November-2022-edition.pdf', '', 'sd_ho_lv7', 10, 0),
(1118, 21, '', '20250328171730_Pt_Artokaya_Indonesia-Kertas_Nusantara_Berau_Renovation_Project_-_Material_Supply.pdf', '2025-03-28 17:17:30', '378.52', 'PDF Document', 'https://achivon.app/dr_files/20250328171730_Pt_Artokaya_Indonesia-Kertas_Nusantara_Berau_Renovation_Project_-_Material_Supply.pdf', '', 'sd_ho_lv7', 11, 0),
(1119, 21, '', '20250328171844_PY_Yane_Roof-BERAU_-_KALTIM_014_(20250325).pdf', '2025-03-28 17:18:44', '258.63', 'PDF Document', 'https://achivon.app/dr_files/20250328171844_PY_Yane_Roof-BERAU_-_KALTIM_014_%2820250325%29.pdf', '', 'sd_ho_lv7', 12, 0),
(1120, 21, '', '20250328172008_Karlita_Emas__Grating_Q_-_25020013_ACHIVON_PRESTASI_ABADI,_PT._(1).pdf', '2025-03-28 17:20:08', '953.29', 'PDF Document', 'https://achivon.app/dr_files/20250328172008_Karlita_Emas__Grating_Q_-_25020013_ACHIVON_PRESTASI_ABADI%2C_PT._%281%29.pdf', '', 'sd_ho_lv7', 13, 0),
(1121, 21, '', '20250328172133_Qtn_Achivon020404_(1).pdf', '2025-03-28 17:21:33', '673.69', 'PDF Document', 'https://achivon.app/dr_files/20250328172133_Qtn_Achivon020404_%281%29.pdf', '', 'sd_ho_lv7', 14, 0),
(1122, 21, '', '20250328172333_Didik_Kairos_1070_SPH_PT_ACHIVON_PRESTASI_ABADI.pdf', '2025-03-28 17:23:33', '258.19', 'PDF Document', 'https://achivon.app/dr_files/20250328172333_Didik_Kairos_1070_SPH_PT_ACHIVON_PRESTASI_ABADI.pdf', '', 'sd_ho_lv7', 15, 0),
(1123, 21, '', '20250328172357_Sutardi_CIta_Baya__penawaran_Bolt__nuts.pdf', '2025-06-16 10:25:39', '451.65', 'PDF Document', 'https://achivon.app/dr_files/20250328172357_Sutardi_CIta_Baya__penawaran_Bolt__nuts.pdf', '', 'sd_ho_lv7', 16, 0),
(1124, 21, '', '20250328172748_Lisa_Smartindo_Garuda_Karya_Penawaran_Steel_Structure_20250224.pdf', '2025-03-28 17:27:48', '304.54', 'PDF Document', 'https://achivon.app/dr_files/20250328172748_Lisa_Smartindo_Garuda_Karya_Penawaran_Steel_Structure_20250224.pdf', '', 'sd_ho_lv6', 19, 0),
(1125, 21, '', '20250328172758_Lisa-Smartindo_052_-_Penawaran_Harga_Indent_Produksi.pdf', '2025-03-28 17:27:58', '301.8', 'PDF Document', 'https://achivon.app/dr_files/20250328172758_Lisa-Smartindo_052_-_Penawaran_Harga_Indent_Produksi.pdf', '', 'sd_ho_lv6', 19, 0),
(1126, 21, '', '20250328172808_Lisa_Smartindo_Garuda_Karya_250225_-_Perihal_Beam_Section.pdf', '2025-03-28 17:28:08', '567.1', 'PDF Document', 'https://achivon.app/dr_files/20250328172808_Lisa_Smartindo_Garuda_Karya_250225_-_Perihal_Beam_Section.pdf', '', 'sd_ho_lv6', 19, 0),
(1127, 21, '', '20250328172907_Lina_Bintang_Baja_Penawaran_Steel_Structure_20250224.pdf', '2025-03-28 17:29:07', '679.18', 'PDF Document', 'https://achivon.app/dr_files/20250328172907_Lina_Bintang_Baja_Penawaran_Steel_Structure_20250224.pdf', '', 'sd_ho_lv7', 18, 0),
(1128, 21, '', '20250328172918_Lina_Penawaran_Harga_PT._Achivon_26_Februari_2025.pdf', '2025-03-28 17:29:18', '145.71', 'PDF Document', 'https://achivon.app/dr_files/20250328172918_Lina_Penawaran_Harga_PT._Achivon_26_Februari_2025.pdf', '', 'sd_ho_lv7', 18, 0),
(1129, 21, '', '20250328173016_Mr_Park_Steel_Structure_Materials_(20250221).xlsx', '2025-03-28 17:30:16', '16.31', 'Excel Document', 'https://achivon.app/dr_files/20250328173016_Mr_Park_Steel_Structure_Materials_%2820250221%29.xlsx', '', 'sd_ho_lv7', 19, 0),
(1130, 23, '', '20250404074107_42-1-0008001.dwg', '2025-04-04 07:41:07', '658.15', 'AutoCAD File', 'https://achivon.app/dr_files/20250404074107_42-1-0008001.dwg', '', 'sd_ho_lv7', 20, 0),
(1131, 23, '', '20250404074120_42-2-0088001.dwg', '2025-04-04 07:41:20', '630.19', 'AutoCAD File', 'https://achivon.app/dr_files/20250404074120_42-2-0088001.dwg', '', 'sd_ho_lv7', 20, 0),
(1132, 23, '', '20250404074128_42-2-0089001.dwg', '2025-04-04 07:41:28', '855.9', 'AutoCAD File', 'https://achivon.app/dr_files/20250404074128_42-2-0089001.dwg', '', 'sd_ho_lv7', 20, 0),
(1133, 23, '', '20250404074223_42-2-0089002.dwg', '2025-04-04 07:42:23', '588.38', 'AutoCAD File', 'https://achivon.app/dr_files/20250404074223_42-2-0089002.dwg', '', 'sd_ho_lv7', 20, 0),
(1134, 23, '', '20250404074235_42-2-0090001.dwg', '2025-04-04 07:42:35', '637.03', 'AutoCAD File', 'https://achivon.app/dr_files/20250404074235_42-2-0090001.dwg', '', 'sd_ho_lv7', 20, 0),
(1135, 23, '', '20250404074244_42-2-0091001.dwg', '2025-04-04 07:42:44', '858.42', 'AutoCAD File', 'https://achivon.app/dr_files/20250404074244_42-2-0091001.dwg', '', 'sd_ho_lv7', 20, 0),
(1136, 23, '', '20250404074301_42-2-0091002.dwg', '2025-04-04 07:43:01', '588.38', 'AutoCAD File', 'https://achivon.app/dr_files/20250404074301_42-2-0091002.dwg', '', 'sd_ho_lv7', 20, 0),
(1137, 23, '', '20250404074313_42-2-0092001.dwg', '2025-04-04 07:43:13', '856.69', 'AutoCAD File', 'https://achivon.app/dr_files/20250404074313_42-2-0092001.dwg', '', 'sd_ho_lv7', 20, 0),
(1138, 23, '', '20250404074322_42-2-0093001.dwg', '2025-04-04 07:43:22', '850.53', 'AutoCAD File', 'https://achivon.app/dr_files/20250404074322_42-2-0093001.dwg', '', 'sd_ho_lv7', 20, 0),
(1139, 23, '', '20250404074332_42-2-0094001.dwg', '2025-04-04 07:43:32', '641.93', 'AutoCAD File', 'https://achivon.app/dr_files/20250404074332_42-2-0094001.dwg', '', 'sd_ho_lv7', 20, 0),
(1140, 23, '', '20250404074341_42-2-0094001.dwg', '2025-04-04 07:43:41', '641.93', 'AutoCAD File', 'https://achivon.app/dr_files/20250404074341_42-2-0094001.dwg', '', 'sd_ho_lv7', 20, 0),
(1141, 23, '', '20250404074353_42-2-0095001.dwg', '2025-04-04 07:43:53', '642.34', 'AutoCAD File', 'https://achivon.app/dr_files/20250404074353_42-2-0095001.dwg', '', 'sd_ho_lv7', 20, 0),
(1142, 23, '', '20250404074402_42-2-0096001.dwg', '2025-04-04 07:44:02', '641.39', 'AutoCAD File', 'https://achivon.app/dr_files/20250404074402_42-2-0096001.dwg', '', 'sd_ho_lv7', 20, 0),
(1143, 23, '', '20250404074415_42-2-0097001.dwg', '2025-04-04 07:44:15', '699.88', 'AutoCAD File', 'https://achivon.app/dr_files/20250404074415_42-2-0097001.dwg', '', 'sd_ho_lv7', 20, 0),
(1144, 23, '', '20250404074431_42-2-0100001.dwg', '2025-04-04 07:44:31', '708.92', 'AutoCAD File', 'https://achivon.app/dr_files/20250404074431_42-2-0100001.dwg', '', 'sd_ho_lv7', 20, 0),
(1145, 23, '', '20250404074443_42-2-0101001.dwg', '2025-04-04 07:44:43', '650', 'AutoCAD File', 'https://achivon.app/dr_files/20250404074443_42-2-0101001.dwg', '', 'sd_ho_lv7', 20, 0),
(1146, 23, '', '20250404074503_42-2-0102001.dwg', '2025-04-04 07:45:03', '753.36', 'AutoCAD File', 'https://achivon.app/dr_files/20250404074503_42-2-0102001.dwg', '', 'sd_ho_lv7', 20, 0),
(1147, 23, '', '20250404074517_42-2-0103001.dwg', '2025-04-04 07:45:17', '652.2', 'AutoCAD File', 'https://achivon.app/dr_files/20250404074517_42-2-0103001.dwg', '', 'sd_ho_lv7', 20, 0),
(1148, 23, '', '20250404080412_42-2-0104001.dwg', '2025-04-04 08:04:12', '745.78', 'AutoCAD File', 'https://achivon.app/dr_files/20250404080412_42-2-0104001.dwg', '', 'sd_ho_lv7', 20, 0),
(1149, 23, '', '20250404080422_42-2-0220001.dwg', '2025-04-04 08:04:22', '713.54', 'AutoCAD File', 'https://achivon.app/dr_files/20250404080422_42-2-0220001.dwg', '', 'sd_ho_lv7', 20, 0),
(1150, 23, '', '20250404080432_42-2-0220002.dwg', '2025-04-04 08:04:32', '730.2', 'AutoCAD File', 'https://achivon.app/dr_files/20250404080432_42-2-0220002.dwg', '', 'sd_ho_lv7', 20, 0),
(1151, 23, '', '20250404082748_42-2-0220003.dwg', '2025-04-04 08:27:48', '637.33', 'AutoCAD File', 'https://achivon.app/dr_files/20250404082748_42-2-0220003.dwg', '', 'sd_ho_lv7', 20, 0),
(1152, 23, '', '20250404082801_42-2-0220004.dwg', '2025-04-04 08:28:01', '678.74', 'AutoCAD File', 'https://achivon.app/dr_files/20250404082801_42-2-0220004.dwg', '', 'sd_ho_lv7', 20, 0),
(1153, 23, '', '20250404082813_42-2-0220005.dwg', '2025-04-04 08:28:13', '737.18', 'AutoCAD File', 'https://achivon.app/dr_files/20250404082813_42-2-0220005.dwg', '', 'sd_ho_lv7', 20, 0),
(1154, 23, '', '20250404082831_42-2-0221001.dwg', '2025-04-04 08:28:31', '657.53', 'AutoCAD File', 'https://achivon.app/dr_files/20250404082831_42-2-0221001.dwg', '', 'sd_ho_lv7', 20, 0),
(1155, 23, '', '20250404082841_42-2-0222001.dwg', '2025-04-04 08:28:41', '653.23', 'AutoCAD File', 'https://achivon.app/dr_files/20250404082841_42-2-0222001.dwg', '', 'sd_ho_lv7', 20, 0),
(1156, 23, '', '20250404085039_42-2-0223001.dwg', '2025-04-04 08:50:39', '652.77', 'AutoCAD File', 'https://achivon.app/dr_files/20250404085039_42-2-0223001.dwg', '', 'sd_ho_lv7', 20, 0),
(1157, 23, '', '20250404085113_42-2-0224001.dwg', '2025-04-04 08:51:13', '656.73', 'AutoCAD File', 'https://achivon.app/dr_files/20250404085113_42-2-0224001.dwg', '', 'sd_ho_lv7', 20, 0),
(1158, 23, '', '20250404085127_42-2-0225001.dwg', '2025-04-04 08:51:27', '654.13', 'AutoCAD File', 'https://achivon.app/dr_files/20250404085127_42-2-0225001.dwg', '', 'sd_ho_lv7', 20, 0),
(1159, 23, '', '20250404085213_42-2-0226001.dwg', '2025-04-04 08:52:13', '659.6', 'AutoCAD File', 'https://achivon.app/dr_files/20250404085213_42-2-0226001.dwg', '', 'sd_ho_lv7', 20, 0),
(1160, 23, '', '20250404085223_42-2-0227001.dwg', '2025-04-04 08:52:23', '654.13', 'AutoCAD File', 'https://achivon.app/dr_files/20250404085223_42-2-0227001.dwg', '', 'sd_ho_lv7', 20, 0),
(1161, 23, '', '20250404085312_42-2-0228001.dwg', '2025-04-04 08:53:12', '654.13', 'AutoCAD File', 'https://achivon.app/dr_files/20250404085312_42-2-0228001.dwg', '', 'sd_ho_lv7', 20, 0),
(1162, 23, '', '20250404085322_42-2-0229001.dwg', '2025-04-04 08:53:22', '654.17', 'AutoCAD File', 'https://achivon.app/dr_files/20250404085322_42-2-0229001.dwg', '', 'sd_ho_lv7', 20, 0),
(1163, 23, '', '20250404085331_42-2-0230001.dwg', '2025-04-04 08:53:31', '619.72', 'AutoCAD File', 'https://achivon.app/dr_files/20250404085331_42-2-0230001.dwg', '', 'sd_ho_lv7', 20, 0),
(1164, 23, '', '20250404085600_42-2-0231001.dwg', '2025-04-04 08:56:00', '619.31', 'AutoCAD File', 'https://achivon.app/dr_files/20250404085600_42-2-0231001.dwg', '', 'sd_ho_lv7', 20, 0),
(1165, 23, '', '20250404085622_42-2-0232001.dwg', '2025-04-04 08:56:22', '618.47', 'AutoCAD File', 'https://achivon.app/dr_files/20250404085622_42-2-0232001.dwg', '', 'sd_ho_lv7', 20, 0),
(1166, 23, '', '20250404085647_42-2-0233001.dwg', '2025-04-04 08:56:47', '615.03', 'AutoCAD File', 'https://achivon.app/dr_files/20250404085647_42-2-0233001.dwg', '', 'sd_ho_lv7', 20, 0),
(1167, 23, '', '20250404085800_42-2-0234001.dwg', '2025-04-04 08:58:00', '615.03', 'AutoCAD File', 'https://achivon.app/dr_files/20250404085800_42-2-0234001.dwg', '', 'sd_ho_lv7', 20, 0),
(1168, 23, '', '20250404090157_42-2-0235001.dwg', '2025-04-04 09:01:57', '618.01', 'AutoCAD File', 'https://achivon.app/dr_files/20250404090157_42-2-0235001.dwg', '', 'sd_ho_lv7', 20, 0),
(1169, 23, '', '20250404090227_42-2-0236001.dwg', '2025-04-04 09:02:27', '615.03', 'AutoCAD File', 'https://achivon.app/dr_files/20250404090227_42-2-0236001.dwg', '', 'sd_ho_lv7', 20, 0),
(1170, 23, '', '20250404090410_42-2-0237001.dwg', '2025-04-04 09:04:10', '615.03', 'AutoCAD File', 'https://achivon.app/dr_files/20250404090410_42-2-0237001.dwg', '', 'sd_ho_lv7', 20, 0),
(1171, 23, '', '20250404090657_42-2-0238001.dwg', '2025-04-04 09:06:57', '615.03', 'AutoCAD File', 'https://achivon.app/dr_files/20250404090657_42-2-0238001.dwg', '', 'sd_ho_lv7', 20, 0),
(1172, 23, '', '20250404090710_42-2-0240001.dwg', '2025-04-04 09:07:10', '862.81', 'AutoCAD File', 'https://achivon.app/dr_files/20250404090710_42-2-0240001.dwg', '', 'sd_ho_lv7', 20, 0),
(1173, 23, '', '20250404090729_42-2-0240002.dwg', '2025-04-04 09:07:29', '689.68', 'AutoCAD File', 'https://achivon.app/dr_files/20250404090729_42-2-0240002.dwg', '', 'sd_ho_lv7', 20, 0),
(1174, 23, '', '20250404090858_42-2-0240003.dwg', '2025-04-04 09:08:58', '637.02', 'AutoCAD File', 'https://achivon.app/dr_files/20250404090858_42-2-0240003.dwg', '', 'sd_ho_lv7', 20, 0),
(1175, 23, '', '20250404090922_42-2-0240004.dwg', '2025-04-04 09:09:22', '702.04', 'AutoCAD File', 'https://achivon.app/dr_files/20250404090922_42-2-0240004.dwg', '', 'sd_ho_lv7', 20, 0),
(1176, 23, '', '20250404091013_42-2-0240005.dwg', '2025-04-04 09:10:13', '712.13', 'AutoCAD File', 'https://achivon.app/dr_files/20250404091013_42-2-0240005.dwg', '', 'sd_ho_lv7', 20, 0),
(1177, 23, '', '20250404091157_42-2-0245001.dwg', '2025-04-04 09:11:57', '657.33', 'AutoCAD File', 'https://achivon.app/dr_files/20250404091157_42-2-0245001.dwg', '', 'sd_ho_lv7', 20, 0),
(1178, 23, '', '20250404091426_42-2-0246001.dwg', '2025-04-04 09:14:26', '659.56', 'AutoCAD File', 'https://achivon.app/dr_files/20250404091426_42-2-0246001.dwg', '', 'sd_ho_lv7', 20, 0),
(1179, 23, '', '20250404091445_42-2-0247001.dwg', '2025-04-04 09:14:45', '654.13', 'AutoCAD File', 'https://achivon.app/dr_files/20250404091445_42-2-0247001.dwg', '', 'sd_ho_lv7', 20, 0),
(1180, 23, '', '20250404091632_42-2-0248001.dwg', '2025-04-04 09:16:32', '654.13', 'AutoCAD File', 'https://achivon.app/dr_files/20250404091632_42-2-0248001.dwg', '', 'sd_ho_lv7', 20, 0),
(1181, 23, '', '20250404091739_42-2-0249001.dwg', '2025-04-04 09:17:39', '654.17', 'AutoCAD File', 'https://achivon.app/dr_files/20250404091739_42-2-0249001.dwg', '', 'sd_ho_lv7', 20, 0),
(1182, 23, '', '20250404091824_42-2-0250001.dwg', '2025-04-04 09:18:24', '629.7', 'AutoCAD File', 'https://achivon.app/dr_files/20250404091824_42-2-0250001.dwg', '', 'sd_ho_lv7', 20, 0),
(1183, 23, '', '20250404091921_42-2-0251001.dwg', '2025-04-04 09:19:21', '628.83', 'AutoCAD File', 'https://achivon.app/dr_files/20250404091921_42-2-0251001.dwg', '', 'sd_ho_lv7', 20, 0),
(1184, 23, '', '20250404091939_42-2-0252001.dwg', '2025-04-04 09:19:39', '626.46', 'AutoCAD File', 'https://achivon.app/dr_files/20250404091939_42-2-0252001.dwg', '', 'sd_ho_lv7', 20, 0),
(1185, 23, '', '20250404092045_42-2-0255001.dwg', '2025-04-04 09:20:45', '618.32', 'AutoCAD File', 'https://achivon.app/dr_files/20250404092045_42-2-0255001.dwg', '', 'sd_ho_lv7', 20, 0),
(1186, 23, '', '20250404092622_42-2-0256001.dwg', '2025-04-04 09:26:22', '615.34', 'AutoCAD File', 'https://achivon.app/dr_files/20250404092622_42-2-0256001.dwg', '', 'sd_ho_lv7', 20, 0),
(1187, 23, '', '20250404092757_42-2-0257001.dwg', '2025-04-04 09:27:57', '615.34', 'AutoCAD File', 'https://achivon.app/dr_files/20250404092757_42-2-0257001.dwg', '', 'sd_ho_lv7', 20, 0),
(1188, 23, '', '20250404092811_42-2-0258001.dwg', '2025-04-04 09:28:11', '615.34', 'AutoCAD File', 'https://achivon.app/dr_files/20250404092811_42-2-0258001.dwg', '', 'sd_ho_lv7', 20, 0),
(1189, 23, '', '20250404092834_42-8-0090001.dwg', '2025-04-04 09:28:34', '630.98', 'AutoCAD File', 'https://achivon.app/dr_files/20250404092834_42-8-0090001.dwg', '', 'sd_ho_lv7', 20, 0),
(1190, 23, '', '20250404092853_42-8-0091001.dwg', '2025-04-04 09:28:53', '630.24', 'AutoCAD File', 'https://achivon.app/dr_files/20250404092853_42-8-0091001.dwg', '', 'sd_ho_lv7', 20, 0),
(1191, 23, '', '20250404092923_42-8-0092001.dwg', '2025-04-04 09:29:23', '630.38', 'AutoCAD File', 'https://achivon.app/dr_files/20250404092923_42-8-0092001.dwg', '', 'sd_ho_lv7', 20, 0),
(1192, 23, '', '20250404092945_42-8-0093001.dwg', '2025-04-04 09:29:45', '629.79', 'AutoCAD File', 'https://achivon.app/dr_files/20250404092945_42-8-0093001.dwg', '', 'sd_ho_lv7', 20, 0),
(1193, 23, '', '20250404093003_42-8-0094001.dwg', '2025-04-04 09:30:03', '630.24', 'AutoCAD File', 'https://achivon.app/dr_files/20250404093003_42-8-0094001.dwg', '', 'sd_ho_lv7', 20, 0),
(1194, 23, '', '20250404093019_42-8-0095001.dwg', '2025-04-04 09:30:19', '629.93', 'AutoCAD File', 'https://achivon.app/dr_files/20250404093019_42-8-0095001.dwg', '', 'sd_ho_lv7', 20, 0),
(1195, 23, '', '20250404093038_42-8-0096001.dwg', '2025-04-04 09:30:38', '630.38', 'AutoCAD File', 'https://achivon.app/dr_files/20250404093038_42-8-0096001.dwg', '', 'sd_ho_lv7', 20, 0),
(1196, 23, '', '20250404093107_42-8-0097001.dwg', '2025-04-04 09:31:07', '630.38', 'AutoCAD File', 'https://achivon.app/dr_files/20250404093107_42-8-0097001.dwg', '', 'sd_ho_lv7', 20, 0),
(1197, 23, '', '20250404100423_42-8-0098001.dwg', '2025-04-04 10:04:23', '629.79', 'AutoCAD File', 'https://achivon.app/dr_files/20250404100423_42-8-0098001.dwg', '', 'sd_ho_lv7', 20, 0),
(1198, 23, '', '20250404100439_42-8-0099001.dwg', '2025-04-04 10:04:39', '630.87', 'AutoCAD File', 'https://achivon.app/dr_files/20250404100439_42-8-0099001.dwg', '', 'sd_ho_lv7', 20, 0),
(1199, 23, '', '20250404100500_42-8-0100001.dwg', '2025-04-04 10:05:00', '629.86', 'AutoCAD File', 'https://achivon.app/dr_files/20250404100500_42-8-0100001.dwg', '', 'sd_ho_lv7', 20, 0),
(1200, 23, '', '20250404100526_42-8-0101001.dwg', '2025-04-04 10:05:26', '630.17', 'AutoCAD File', 'https://achivon.app/dr_files/20250404100526_42-8-0101001.dwg', '', 'sd_ho_lv7', 20, 0),
(1201, 23, '', '20250404100712_42-8-0102001.dwg', '2025-04-04 10:07:12', '629.86', 'AutoCAD File', 'https://achivon.app/dr_files/20250404100712_42-8-0102001.dwg', '', 'sd_ho_lv7', 20, 0),
(1202, 23, '', '20250404100723_42-8-0103001.dwg', '2025-04-04 10:07:23', '629.86', 'AutoCAD File', 'https://achivon.app/dr_files/20250404100723_42-8-0103001.dwg', '', 'sd_ho_lv7', 20, 0),
(1203, 23, '', '20250404100733_42-8-0104001.dwg', '2025-04-04 10:07:33', '630.17', 'AutoCAD File', 'https://achivon.app/dr_files/20250404100733_42-8-0104001.dwg', '', 'sd_ho_lv7', 20, 0),
(1204, 23, '', '20250404100747_42-8-0105001.dwg', '2025-04-04 10:07:47', '629.86', 'AutoCAD File', 'https://achivon.app/dr_files/20250404100747_42-8-0105001.dwg', '', 'sd_ho_lv7', 20, 0),
(1205, 23, '', '20250404100800_42-8-0106001.dwg', '2025-04-04 10:08:00', '630.17', 'AutoCAD File', 'https://achivon.app/dr_files/20250404100800_42-8-0106001.dwg', '', 'sd_ho_lv7', 20, 0),
(1206, 23, '', '20250404100820_42-8-0107001.dwg', '2025-04-04 10:08:20', '629.86', 'AutoCAD File', 'https://achivon.app/dr_files/20250404100820_42-8-0107001.dwg', '', 'sd_ho_lv7', 20, 0),
(1207, 23, '', '20250404100841_42-8-0108001.dwg', '2025-04-04 10:08:41', '820.12', 'AutoCAD File', 'https://achivon.app/dr_files/20250404100841_42-8-0108001.dwg', '', 'sd_ho_lv7', 20, 0),
(1208, 23, '', '20250404100856_42-8-0109001.dwg', '2025-04-04 10:08:56', '818.76', 'AutoCAD File', 'https://achivon.app/dr_files/20250404100856_42-8-0109001.dwg', '', 'sd_ho_lv7', 20, 0),
(1209, 23, '', '20250404100905_42-8-0110001.dwg', '2025-04-04 10:09:05', '644.39', 'AutoCAD File', 'https://achivon.app/dr_files/20250404100905_42-8-0110001.dwg', '', 'sd_ho_lv7', 20, 0),
(1210, 23, '', '20250404100914_42-8-0111001.dwg', '2025-04-04 10:09:14', '786.65', 'AutoCAD File', 'https://achivon.app/dr_files/20250404100914_42-8-0111001.dwg', '', 'sd_ho_lv7', 20, 0),
(1211, 23, '', '20250404100937_42-8-0112001.dwg', '2025-04-04 10:09:37', '664.3', 'AutoCAD File', 'https://achivon.app/dr_files/20250404100937_42-8-0112001.dwg', '', 'sd_ho_lv7', 20, 0),
(1212, 23, '', '20250404100949_42-8-0113001.dwg', '2025-04-04 10:09:49', '615.94', 'AutoCAD File', 'https://achivon.app/dr_files/20250404100949_42-8-0113001.dwg', '', 'sd_ho_lv7', 20, 0),
(1213, 23, '', '20250404101000_42-8-0114001.dwg', '2025-04-04 10:10:00', '617.27', 'AutoCAD File', 'https://achivon.app/dr_files/20250404101000_42-8-0114001.dwg', '', 'sd_ho_lv7', 20, 0),
(1214, 23, '', '20250404101009_42-8-0115001.dwg', '2025-04-04 10:10:09', '617.31', 'AutoCAD File', 'https://achivon.app/dr_files/20250404101009_42-8-0115001.dwg', '', 'sd_ho_lv7', 20, 0),
(1215, 23, '', '20250404101018_42-8-0116001.dwg', '2025-04-04 10:10:18', '646.51', 'AutoCAD File', 'https://achivon.app/dr_files/20250404101018_42-8-0116001.dwg', '', 'sd_ho_lv7', 20, 0),
(1216, 23, '', '20250404101037_42-8-0117001.dwg', '2025-04-04 10:10:37', '641.86', 'AutoCAD File', 'https://achivon.app/dr_files/20250404101037_42-8-0117001.dwg', '', 'sd_ho_lv7', 20, 0),
(1217, 23, '', '20250404101058_42-8-0118001.dwg', '2025-04-04 10:10:58', '647.84', 'AutoCAD File', 'https://achivon.app/dr_files/20250404101058_42-8-0118001.dwg', '', 'sd_ho_lv7', 20, 0),
(1218, 23, '', '20250404101109_42-8-0119001.dwg', '2025-04-04 10:11:09', '640.19', 'AutoCAD File', 'https://achivon.app/dr_files/20250404101109_42-8-0119001.dwg', '', 'sd_ho_lv7', 20, 0),
(1219, 23, '', '20250404101128_42-8-0121001.dwg', '2025-04-04 10:11:28', '645.09', 'AutoCAD File', 'https://achivon.app/dr_files/20250404101128_42-8-0121001.dwg', '', 'sd_ho_lv7', 20, 0),
(1220, 23, '', '20250404101142_42-8-0123001.dwg', '2025-04-04 10:11:42', '677.95', 'AutoCAD File', 'https://achivon.app/dr_files/20250404101142_42-8-0123001.dwg', '', 'sd_ho_lv7', 20, 0),
(1221, 23, '', '20250404101154_42-8-0124001.dwg', '2025-04-04 10:11:54', '698.29', 'AutoCAD File', 'https://achivon.app/dr_files/20250404101154_42-8-0124001.dwg', '', 'sd_ho_lv7', 20, 0),
(1222, 23, '', '20250404101213_42-8-0129001.dwg', '2025-04-04 10:12:13', '605.3', 'AutoCAD File', 'https://achivon.app/dr_files/20250404101213_42-8-0129001.dwg', '', 'sd_ho_lv7', 20, 0),
(1223, 23, '', '20250404101225_42-8-0130001.dwg', '2025-04-04 10:12:25', '605.31', 'AutoCAD File', 'https://achivon.app/dr_files/20250404101225_42-8-0130001.dwg', '', 'sd_ho_lv7', 20, 0),
(1224, 23, '', '20250404101236_42-8-0133001.dwg', '2025-04-04 10:12:36', '687.44', 'AutoCAD File', 'https://achivon.app/dr_files/20250404101236_42-8-0133001.dwg', '', 'sd_ho_lv7', 20, 0),
(1225, 23, '', '20250404101255_42-8-0341001.dwg', '2025-04-04 10:12:55', '611.06', 'AutoCAD File', 'https://achivon.app/dr_files/20250404101255_42-8-0341001.dwg', '', 'sd_ho_lv7', 20, 0),
(1226, 23, '', '20250404101303_42-9-0120001.dwg', '2025-04-04 10:13:03', '650.57', 'AutoCAD File', 'https://achivon.app/dr_files/20250404101303_42-9-0120001.dwg', '', 'sd_ho_lv7', 20, 0),
(1227, 23, '', '20250404101313_42-9-0122001.dwg', '2025-04-04 10:13:13', '681.23', 'AutoCAD File', 'https://achivon.app/dr_files/20250404101313_42-9-0122001.dwg', '', 'sd_ho_lv7', 20, 0),
(1228, 23, '', '20250404101326_42-9-0125001.dwg', '2025-04-04 10:13:26', '656.39', 'AutoCAD File', 'https://achivon.app/dr_files/20250404101326_42-9-0125001.dwg', '', 'sd_ho_lv7', 20, 0),
(1229, 23, '', '20250404101334_42-9-0127001.dwg', '2025-04-04 10:13:34', '664', 'AutoCAD File', 'https://achivon.app/dr_files/20250404101334_42-9-0127001.dwg', '', 'sd_ho_lv7', 20, 0),
(1230, 23, '', '20250404101340_42-9-0128001.dwg', '2025-04-04 10:13:40', '601.66', 'AutoCAD File', 'https://achivon.app/dr_files/20250404101340_42-9-0128001.dwg', '', 'sd_ho_lv7', 20, 0),
(1231, 23, '', '20250404101703_42-2-0212F001.dwg', '2025-04-04 10:17:03', '725.57', 'AutoCAD File', 'https://achivon.app/dr_files/20250404101703_42-2-0212F001.dwg', '', 'sd_ho_lv7', 21, 0),
(1232, 23, '', '20250404101714_42-2-0212F002.dwg', '2025-04-04 10:17:14', '663.13', 'AutoCAD File', 'https://achivon.app/dr_files/20250404101714_42-2-0212F002.dwg', '', 'sd_ho_lv7', 21, 0),
(1233, 23, '', '20250404101721_42-2-0212F003.dwg', '2025-04-04 10:17:21', '712.82', 'AutoCAD File', 'https://achivon.app/dr_files/20250404101721_42-2-0212F003.dwg', '', 'sd_ho_lv7', 21, 0),
(1234, 23, '', '20250404101729_42-2-0212F004.dwg', '2025-04-04 10:17:29', '711.56', 'AutoCAD File', 'https://achivon.app/dr_files/20250404101729_42-2-0212F004.dwg', '', 'sd_ho_lv7', 21, 0),
(1235, 23, '', '20250404101737_42-2-0212F005.dwg', '2025-04-04 10:17:37', '741.41', 'AutoCAD File', 'https://achivon.app/dr_files/20250404101737_42-2-0212F005.dwg', '', 'sd_ho_lv7', 21, 0),
(1236, 23, '', '20250404170140_Z921SE-2D1-1-PID-1400-R1.1_PID_-_Legend.PDF', '2025-04-04 17:01:40', '270.04', 'PDF Document', 'https://achivon.app/dr_files/20250404170140_Z921SE-2D1-1-PID-1400-R1.1_PID_-_Legend.PDF', '', 'sd_ho_lv5', 95, 0),
(1237, 23, '', '20250404170149_Z921SE-2D1-1-PID-1401-R1.1_PID_-_Brine_Preparation.PDF', '2025-04-04 17:01:49', '177.07', 'PDF Document', 'https://achivon.app/dr_files/20250404170149_Z921SE-2D1-1-PID-1401-R1.1_PID_-_Brine_Preparation.PDF', '', 'sd_ho_lv5', 95, 0),
(1238, 23, '', '20250404170156_Z921SE-2D1-1-PID-1402-R1.1_PID_-_Brine_Clarifier.PDF', '2025-04-04 17:01:56', '205.12', 'PDF Document', 'https://achivon.app/dr_files/20250404170156_Z921SE-2D1-1-PID-1402-R1.1_PID_-_Brine_Clarifier.PDF', '', 'sd_ho_lv5', 95, 0),
(1239, 23, '', '20250404170205_Z921SE-2D1-1-PID-1403-R1.1_PID_-_Brine_Filtration.PDF', '2025-04-04 17:02:05', '175.62', 'PDF Document', 'https://achivon.app/dr_files/20250404170205_Z921SE-2D1-1-PID-1403-R1.1_PID_-_Brine_Filtration.PDF', '', 'sd_ho_lv5', 95, 0),
(1240, 23, '', '20250404170218_Z921SE-2D1-1-PID-1404-R1.1_PID_-_Secondary_Brine_Treatment.PDF', '2025-04-04 17:02:18', '133.41', 'PDF Document', 'https://achivon.app/dr_files/20250404170218_Z921SE-2D1-1-PID-1404-R1.1_PID_-_Secondary_Brine_Treatment.PDF', '', 'sd_ho_lv5', 95, 0),
(1241, 23, '', '20250404170309_Z921SE-2D1-1-PID-1405-R1.1_PID_-_Deionized_Brine_Storage.PDF', '2025-04-04 17:03:09', '185.82', 'PDF Document', 'https://achivon.app/dr_files/20250404170309_Z921SE-2D1-1-PID-1405-R1.1_PID_-_Deionized_Brine_Storage.PDF', '', 'sd_ho_lv5', 95, 0),
(1242, 23, '', '20250404170321_Z921SE-2D1-1-PID-1406-R1.1_PID_-_cell_room.PDF', '2025-04-04 17:03:21', '241.85', 'PDF Document', 'https://achivon.app/dr_files/20250404170321_Z921SE-2D1-1-PID-1406-R1.1_PID_-_cell_room.PDF', '', 'sd_ho_lv5', 95, 0),
(1243, 23, '', '20250404170332_Z921SE-2D1-1-PID-1415-R1.1_PID_-_Weak_Brine_and_Chlorine.PDF', '2025-04-04 17:03:32', '197.68', 'PDF Document', 'https://achivon.app/dr_files/20250404170332_Z921SE-2D1-1-PID-1415-R1.1_PID_-_Weak_Brine_and_Chlorine.PDF', '', 'sd_ho_lv5', 95, 0),
(1244, 23, '', '20250404170345_Z921SE-2D1-1-PID-1417-R1.1_PID_-_Catholyte__Hydrogen.PDF', '2025-06-16 10:25:39', '258.15', 'PDF Document', 'https://achivon.app/dr_files/20250404170345_Z921SE-2D1-1-PID-1417-R1.1_PID_-_Catholyte__Hydrogen.PDF', '', 'sd_ho_lv5', 95, 0),
(1245, 23, '', '20250404170357_Z921SE-2D1-1-PID-1419-R1.1_PID_-_Brine_Dechlorination.PDF', '2025-04-04 17:03:57', '171.49', 'PDF Document', 'https://achivon.app/dr_files/20250404170357_Z921SE-2D1-1-PID-1419-R1.1_PID_-_Brine_Dechlorination.PDF', '', 'sd_ho_lv5', 95, 0),
(1246, 23, '', '20250404170408_Z921SE-2D1-1-PID-1421-R1.1_PID_-_Chlorine_cooling.PDF', '2025-04-04 17:04:08', '185.79', 'PDF Document', 'https://achivon.app/dr_files/20250404170408_Z921SE-2D1-1-PID-1421-R1.1_PID_-_Chlorine_cooling.PDF', '', 'sd_ho_lv5', 95, 0),
(1247, 23, '', '20250404170502_Z921SE-2D1-1-PID-1426-R1.1_PID_-_Sodium_Hypochlorite.PDF', '2025-04-04 17:05:02', '285.71', 'PDF Document', 'https://achivon.app/dr_files/20250404170502_Z921SE-2D1-1-PID-1426-R1.1_PID_-_Sodium_Hypochlorite.PDF', '', 'sd_ho_lv5', 95, 0),
(1248, 23, '', '20250404170510_Z921SE-2D1-1-PID-1427-R1.1_PID_-_Caustic_Storage__Dilution.PDF', '2025-06-16 10:25:39', '248.42', 'PDF Document', 'https://achivon.app/dr_files/20250404170510_Z921SE-2D1-1-PID-1427-R1.1_PID_-_Caustic_Storage__Dilution.PDF', '', 'sd_ho_lv5', 95, 0),
(1249, 23, '', '20250404170516_Z921SE-2D1-1-PID-1428-R1.1_PID_-_H2SO4_Storage.PDF', '2025-04-04 17:05:16', '174.61', 'PDF Document', 'https://achivon.app/dr_files/20250404170516_Z921SE-2D1-1-PID-1428-R1.1_PID_-_H2SO4_Storage.PDF', '', 'sd_ho_lv5', 95, 0),
(1250, 23, '', '20250404170522_Z921SE-2D1-1-PID-1429-R1.1_PID_-_Sodium_Carbonate_Tanks.PDF', '2025-04-04 17:05:22', '103.46', 'PDF Document', 'https://achivon.app/dr_files/20250404170522_Z921SE-2D1-1-PID-1429-R1.1_PID_-_Sodium_Carbonate_Tanks.PDF', '', 'sd_ho_lv5', 95, 0),
(1251, 23, '', '20250404170532_Z921SE-2D1-1-PID-1430-R1.1_PID_-_CA_TransformerRectifier.PDF', '2025-04-04 17:05:32', '142.49', 'PDF Document', 'https://achivon.app/dr_files/20250404170532_Z921SE-2D1-1-PID-1430-R1.1_PID_-_CA_TransformerRectifier.PDF', '', 'sd_ho_lv5', 95, 0),
(1252, 23, '', '20250404170539_Z921SE-2D1-1-PID-1431-R1.1_PID_-_Floor_Drain.PDF', '2025-04-04 17:05:39', '135.11', 'PDF Document', 'https://achivon.app/dr_files/20250404170539_Z921SE-2D1-1-PID-1431-R1.1_PID_-_Floor_Drain.PDF', '', 'sd_ho_lv5', 95, 0),
(1253, 23, '', '20250404170547_Z921SE-2D1-1-PID-1433-R1.1_PID_-_Cooling_water.PDF', '2025-04-04 17:05:47', '234.53', 'PDF Document', 'https://achivon.app/dr_files/20250404170547_Z921SE-2D1-1-PID-1433-R1.1_PID_-_Cooling_water.PDF', '', 'sd_ho_lv5', 95, 0),
(1254, 23, '', '20250404170555_Z921SE-2D1-1-PID-1434-R1.1_PID_-_Demineralized_Water.PDF', '2025-04-04 17:05:55', '188.28', 'PDF Document', 'https://achivon.app/dr_files/20250404170555_Z921SE-2D1-1-PID-1434-R1.1_PID_-_Demineralized_Water.PDF', '', 'sd_ho_lv5', 95, 0),
(1255, 23, '', '20250404170601_Z921SE-2D1-1-PID-1435-R1.1_PID_-_Chilled_Water_Distribution.PDF', '2025-04-04 17:06:01', '119.19', 'PDF Document', 'https://achivon.app/dr_files/20250404170601_Z921SE-2D1-1-PID-1435-R1.1_PID_-_Chilled_Water_Distribution.PDF', '', 'sd_ho_lv5', 95, 0),
(1256, 23, '', '20250404170607_Z921SE-2D1-1-PID-1436-R1.1_PID_-_Fire_Water_and_Potable_water.PDF', '2025-04-04 17:06:07', '207.18', 'PDF Document', 'https://achivon.app/dr_files/20250404170607_Z921SE-2D1-1-PID-1436-R1.1_PID_-_Fire_Water_and_Potable_water.PDF', '', 'sd_ho_lv5', 95, 0),
(1257, 23, '', '20250404170638_Z921SE-2D1-1-PID-1437-R1.1_PID_-_Steam__Condensate.PDF', '2025-06-16 10:25:39', '219.53', 'PDF Document', 'https://achivon.app/dr_files/20250404170638_Z921SE-2D1-1-PID-1437-R1.1_PID_-_Steam__Condensate.PDF', '', 'sd_ho_lv5', 95, 0),
(1258, 23, '', '20250404170647_Z921SE-2D1-1-PID-1438-R1.1_PID_-_Nitrogen__Oxygen.PDF', '2025-06-16 10:25:39', '177.83', 'PDF Document', 'https://achivon.app/dr_files/20250404170647_Z921SE-2D1-1-PID-1438-R1.1_PID_-_Nitrogen__Oxygen.PDF', '', 'sd_ho_lv5', 95, 0),
(1259, 23, '', '20250404170653_Z921SE-2D1-1-PID-1439-R1.1_PID_-_Mill_Air.PDF', '2025-04-04 17:06:53', '169.85', 'PDF Document', 'https://achivon.app/dr_files/20250404170653_Z921SE-2D1-1-PID-1439-R1.1_PID_-_Mill_Air.PDF', '', 'sd_ho_lv5', 95, 0),
(1260, 23, '', '20250404170701_Z921SE-2D1-1-PID-1440-R1.1_PID_-_Instrument_Air.PDF', '2025-04-04 17:07:01', '197.42', 'PDF Document', 'https://achivon.app/dr_files/20250404170701_Z921SE-2D1-1-PID-1440-R1.1_PID_-_Instrument_Air.PDF', '', 'sd_ho_lv5', 95, 0),
(1261, 23, '', '20250404170708_Z921SE-2D1-1-PID-1441-R1.1_PID_-_Pump_Seal_Water__Ambient_Air_Monitors.PDF', '2025-06-16 10:25:39', '194.95', 'PDF Document', 'https://achivon.app/dr_files/20250404170708_Z921SE-2D1-1-PID-1441-R1.1_PID_-_Pump_Seal_Water__Ambient_Air_Monitors.PDF', '', 'sd_ho_lv5', 95, 0),
(1262, 23, '', '20250404170717_Z921SE-2D1-1-PID-1442-R1.1_PID_-_Hot_and_cold_mill_water.PDF', '2025-04-04 17:07:17', '263.11', 'PDF Document', 'https://achivon.app/dr_files/20250404170717_Z921SE-2D1-1-PID-1442-R1.1_PID_-_Hot_and_cold_mill_water.PDF', '', 'sd_ho_lv5', 95, 0),
(1263, 23, '', '20250404170729_Z921SE-2D1-1-PID-1450-R1.1_PID_-_Chlorate_Electrolyzer_Reactor.PDF', '2025-04-04 17:07:29', '225.94', 'PDF Document', 'https://achivon.app/dr_files/20250404170729_Z921SE-2D1-1-PID-1450-R1.1_PID_-_Chlorate_Electrolyzer_Reactor.PDF', '', 'sd_ho_lv5', 95, 0),
(1264, 23, '', '20250404170738_Z921SE-2D1-1-PID-1451-R1.1_PID_-_Chlorate_Electrolyzer_Reactor.PDF', '2025-04-04 17:07:38', '143.89', 'PDF Document', 'https://achivon.app/dr_files/20250404170738_Z921SE-2D1-1-PID-1451-R1.1_PID_-_Chlorate_Electrolyzer_Reactor.PDF', '', 'sd_ho_lv5', 95, 0),
(1265, 23, '', '20250404170749_Z921SE-2D1-1-PID-1452-R1.1_PID_-_Strong_Chlorate_Holding.PDF', '2025-04-04 17:07:49', '181.18', 'PDF Document', 'https://achivon.app/dr_files/20250404170749_Z921SE-2D1-1-PID-1452-R1.1_PID_-_Strong_Chlorate_Holding.PDF', '', 'sd_ho_lv5', 95, 0),
(1266, 23, '', '20250404170757_Z921SE-2D1-1-PID-1453-R1.1_PID_-_Strong_Chlorate_filters.PDF', '2025-04-04 17:07:57', '161.05', 'PDF Document', 'https://achivon.app/dr_files/20250404170757_Z921SE-2D1-1-PID-1453-R1.1_PID_-_Strong_Chlorate_filters.PDF', '', 'sd_ho_lv5', 95, 0),
(1267, 23, '', '20250404170806_Z921SE-2D1-1-PID-1454-R1.1_PID_-_Chlorine_Dioxide_Production.PDF', '2025-04-04 17:08:06', '322.23', 'PDF Document', 'https://achivon.app/dr_files/20250404170806_Z921SE-2D1-1-PID-1454-R1.1_PID_-_Chlorine_Dioxide_Production.PDF', '', 'sd_ho_lv5', 95, 0),
(1268, 23, '', '20250404170816_Z921SE-2D1-1-PID-1455-R1.1_PID_-_Chlorine_Dioxide_Production.PDF', '2025-04-04 17:08:16', '244.82', 'PDF Document', 'https://achivon.app/dr_files/20250404170816_Z921SE-2D1-1-PID-1455-R1.1_PID_-_Chlorine_Dioxide_Production.PDF', '', 'sd_ho_lv5', 95, 0),
(1269, 23, '', '20250404170826_Z921SE-2D1-1-PID-1456-R1.1_PID_-_Hydrogen_Demister__Acid_Sump.PDF', '2025-06-16 10:25:39', '345.67', 'PDF Document', 'https://achivon.app/dr_files/20250404170826_Z921SE-2D1-1-PID-1456-R1.1_PID_-_Hydrogen_Demister__Acid_Sump.PDF', '', 'sd_ho_lv5', 95, 0),
(1270, 23, '', '20250404170836_Z921SE-2D1-1-PID-1457-R1.1_PID_-_HCL_Synthesis_Unit.PDF', '2025-04-04 17:08:36', '337.35', 'PDF Document', 'https://achivon.app/dr_files/20250404170836_Z921SE-2D1-1-PID-1457-R1.1_PID_-_HCL_Synthesis_Unit.PDF', '', 'sd_ho_lv5', 95, 0),
(1271, 23, '', '20250404170844_Z921SE-2D1-1-PID-1458-R1.1_PID_-_HCL_Storage.PDF', '2025-04-04 17:08:44', '252.62', 'PDF Document', 'https://achivon.app/dr_files/20250404170844_Z921SE-2D1-1-PID-1458-R1.1_PID_-_HCL_Storage.PDF', '', 'sd_ho_lv5', 95, 0),
(1272, 23, '', '20250404170852_Z921SE-2D1-1-PID-1459-R1.1_PID_-_Hydrogen_Scrubbing_and_Hypo.PDF', '2025-04-04 17:08:52', '193.71', 'PDF Document', 'https://achivon.app/dr_files/20250404170852_Z921SE-2D1-1-PID-1459-R1.1_PID_-_Hydrogen_Scrubbing_and_Hypo.PDF', '', 'sd_ho_lv5', 95, 0),
(1273, 23, '', '20250404170859_Z921SE-2D1-1-PID-1460-R1.1_PID_-_Chlorine_Dioxide_Storage.PDF', '2025-04-04 17:08:59', '194.88', 'PDF Document', 'https://achivon.app/dr_files/20250404170859_Z921SE-2D1-1-PID-1460-R1.1_PID_-_Chlorine_Dioxide_Storage.PDF', '', 'sd_ho_lv5', 95, 0),
(1274, 23, '', '20250404170910_Z921SE-2D1-1-PID-1461-R1.1_PID_-_Chilled_Water_System.PDF', '2025-04-04 17:09:10', '224.41', 'PDF Document', 'https://achivon.app/dr_files/20250404170910_Z921SE-2D1-1-PID-1461-R1.1_PID_-_Chilled_Water_System.PDF', '', 'sd_ho_lv5', 95, 0),
(1275, 23, '', '20250404170922_Z921SE-2D1-1-PID-1462-R1.1_PID_-_CLO2_Transformer__Reactifier.PDF', '2025-04-04 17:09:22', '126.48', 'PDF Document', 'https://achivon.app/dr_files/20250404170922_Z921SE-2D1-1-PID-1462-R1.1_PID_-_CLO2_Transformer__Reactifier.PDF', '', 'sd_ho_lv5', 95, 0);
INSERT INTO `dr_file` (`id`, `id_user`, `subject`, `name_file`, `upload_date`, `size`, `type_file`, `link`, `remark`, `table_name`, `id_table`, `is_aktiv`) VALUES
(1276, 23, '', '20250404170930_Z921SE-2D1-1-PID-1463-R1.1_PID_-_Floor_Drain.PDF', '2025-04-04 17:09:30', '122.71', 'PDF Document', 'https://achivon.app/dr_files/20250404170930_Z921SE-2D1-1-PID-1463-R1.1_PID_-_Floor_Drain.PDF', '', 'sd_ho_lv5', 95, 0),
(1277, 23, '', '20250404171004_Z921SE-2D1-1-PID-1400-R1.1_PID_-_Legend.DWG', '2025-04-04 17:10:04', '157.44', 'AutoCAD File', 'https://achivon.app/dr_files/20250404171004_Z921SE-2D1-1-PID-1400-R1.1_PID_-_Legend.DWG', '', 'sd_ho_lv5', 96, 0),
(1278, 23, '', '20250404171010_Z921SE-2D1-1-PID-1401-R1.1_PID_-_Brine_Preparation.dwg', '2025-04-04 17:10:11', '201.8', 'AutoCAD File', 'https://achivon.app/dr_files/20250404171010_Z921SE-2D1-1-PID-1401-R1.1_PID_-_Brine_Preparation.dwg', '', 'sd_ho_lv5', 96, 0),
(1279, 23, '', '20250404171016_Z921SE-2D1-1-PID-1402-R1.1_PID_-_Brine_Clarifier.dwg', '2025-04-04 17:10:16', '264.66', 'AutoCAD File', 'https://achivon.app/dr_files/20250404171016_Z921SE-2D1-1-PID-1402-R1.1_PID_-_Brine_Clarifier.dwg', '', 'sd_ho_lv5', 96, 0),
(1280, 23, '', '20250404171024_Z921SE-2D1-1-PID-1403-R1.1_PID_-_Brine_Filtration.DWG', '2025-04-04 17:10:24', '153.06', 'AutoCAD File', 'https://achivon.app/dr_files/20250404171024_Z921SE-2D1-1-PID-1403-R1.1_PID_-_Brine_Filtration.DWG', '', 'sd_ho_lv5', 96, 0),
(1281, 23, '', '20250404171032_Z921SE-2D1-1-PID-1404-R1.1_PID_-_Secondary_Brine_Treatment.dwg', '2025-04-04 17:10:32', '354.12', 'AutoCAD File', 'https://achivon.app/dr_files/20250404171032_Z921SE-2D1-1-PID-1404-R1.1_PID_-_Secondary_Brine_Treatment.dwg', '', 'sd_ho_lv5', 96, 0),
(1282, 23, '', '20250404171038_Z921SE-2D1-1-PID-1405-R1.1_PID_-_Deionized_Brine_Storage.dwg', '2025-04-04 17:10:38', '192.89', 'AutoCAD File', 'https://achivon.app/dr_files/20250404171038_Z921SE-2D1-1-PID-1405-R1.1_PID_-_Deionized_Brine_Storage.dwg', '', 'sd_ho_lv5', 96, 0),
(1283, 23, '', '20250404171047_Z921SE-2D1-1-PID-1406-R1.1_PID_-_cell_room.dwg', '2025-04-04 17:10:47', '367.39', 'AutoCAD File', 'https://achivon.app/dr_files/20250404171047_Z921SE-2D1-1-PID-1406-R1.1_PID_-_cell_room.dwg', '', 'sd_ho_lv5', 96, 0),
(1284, 23, '', '20250404171057_Z921SE-2D1-1-PID-1415-R1.1_PID_-_Weak_Brine_and_Chlorine.dwg', '2025-04-04 17:10:57', '171.97', 'AutoCAD File', 'https://achivon.app/dr_files/20250404171057_Z921SE-2D1-1-PID-1415-R1.1_PID_-_Weak_Brine_and_Chlorine.dwg', '', 'sd_ho_lv5', 96, 0),
(1285, 23, '', '20250404171107_Z921SE-2D1-1-PID-1417-R1.1_PID_-_Catholyte__Hydrogen.dwg', '2025-06-16 10:25:39', '205.36', 'AutoCAD File', 'https://achivon.app/dr_files/20250404171107_Z921SE-2D1-1-PID-1417-R1.1_PID_-_Catholyte__Hydrogen.dwg', '', 'sd_ho_lv5', 96, 0),
(1286, 23, '', '20250404171117_Z921SE-2D1-1-PID-1419-R1.1_PID_-_Brine_Dechlorination.dwg', '2025-04-04 17:11:17', '200.14', 'AutoCAD File', 'https://achivon.app/dr_files/20250404171117_Z921SE-2D1-1-PID-1419-R1.1_PID_-_Brine_Dechlorination.dwg', '', 'sd_ho_lv5', 96, 0),
(1287, 23, '', '20250404171125_Z921SE-2D1-1-PID-1421-R1.1_PID_-_Chlorine_cooling.dwg', '2025-04-04 17:11:25', '139.53', 'AutoCAD File', 'https://achivon.app/dr_files/20250404171125_Z921SE-2D1-1-PID-1421-R1.1_PID_-_Chlorine_cooling.dwg', '', 'sd_ho_lv5', 96, 0),
(1288, 23, '', '20250404171132_Z921SE-2D1-1-PID-1426-R1.1_PID_-_Sodium_Hypochlorite.dwg', '2025-04-04 17:11:32', '371.54', 'AutoCAD File', 'https://achivon.app/dr_files/20250404171132_Z921SE-2D1-1-PID-1426-R1.1_PID_-_Sodium_Hypochlorite.dwg', '', 'sd_ho_lv5', 96, 0),
(1289, 23, '', '20250404171138_Z921SE-2D1-1-PID-1427-R1.1_PID_-_Caustic_Storage__Dilution.dwg', '2025-06-16 10:25:39', '292.36', 'AutoCAD File', 'https://achivon.app/dr_files/20250404171138_Z921SE-2D1-1-PID-1427-R1.1_PID_-_Caustic_Storage__Dilution.dwg', '', 'sd_ho_lv5', 96, 0),
(1290, 23, '', '20250404171145_Z921SE-2D1-1-PID-1428-R1.1_PID_-_H2SO4_Storage.dwg', '2025-04-04 17:11:45', '226.55', 'AutoCAD File', 'https://achivon.app/dr_files/20250404171145_Z921SE-2D1-1-PID-1428-R1.1_PID_-_H2SO4_Storage.dwg', '', 'sd_ho_lv5', 96, 0),
(1291, 23, '', '20250404171151_Z921SE-2D1-1-PID-1429-R1.1_PID_-_Sodium_Carbonate_Tanks.dwg', '2025-04-04 17:11:51', '119.01', 'AutoCAD File', 'https://achivon.app/dr_files/20250404171151_Z921SE-2D1-1-PID-1429-R1.1_PID_-_Sodium_Carbonate_Tanks.dwg', '', 'sd_ho_lv5', 96, 0),
(1292, 23, '', '20250404171159_Z921SE-2D1-1-PID-1430-R1.1_PID_-_CA_TransformerRectifier.dwg', '2025-04-04 17:11:59', '236.74', 'AutoCAD File', 'https://achivon.app/dr_files/20250404171159_Z921SE-2D1-1-PID-1430-R1.1_PID_-_CA_TransformerRectifier.dwg', '', 'sd_ho_lv5', 96, 0),
(1293, 23, '', '20250404171205_Z921SE-2D1-1-PID-1431-R1.1_PID_-_Floor_Drain.DWG', '2025-04-04 17:12:05', '197.98', 'AutoCAD File', 'https://achivon.app/dr_files/20250404171205_Z921SE-2D1-1-PID-1431-R1.1_PID_-_Floor_Drain.DWG', '', 'sd_ho_lv5', 96, 0),
(1294, 23, '', '20250404171212_Z921SE-2D1-1-PID-1433-R1.1_PID_-_Cooling_water.DWG', '2025-04-04 17:12:12', '204.25', 'AutoCAD File', 'https://achivon.app/dr_files/20250404171212_Z921SE-2D1-1-PID-1433-R1.1_PID_-_Cooling_water.DWG', '', 'sd_ho_lv5', 96, 0),
(1295, 23, '', '20250404171218_Z921SE-2D1-1-PID-1434-R1.1_PID_-_Demineralized_Water.DWG', '2025-04-04 17:12:18', '157.06', 'AutoCAD File', 'https://achivon.app/dr_files/20250404171218_Z921SE-2D1-1-PID-1434-R1.1_PID_-_Demineralized_Water.DWG', '', 'sd_ho_lv5', 96, 0),
(1296, 23, '', '20250404171224_Z921SE-2D1-1-PID-1435-R1.1_PID_-_Chilled_Water_Distribution.dwg', '2025-04-04 17:12:24', '122.55', 'AutoCAD File', 'https://achivon.app/dr_files/20250404171224_Z921SE-2D1-1-PID-1435-R1.1_PID_-_Chilled_Water_Distribution.dwg', '', 'sd_ho_lv5', 96, 0),
(1297, 23, '', '20250404171230_Z921SE-2D1-1-PID-1436-R1.1_PID_-_Fire_Water_and_Potable_water.dwg', '2025-04-04 17:12:30', '144.15', 'AutoCAD File', 'https://achivon.app/dr_files/20250404171230_Z921SE-2D1-1-PID-1436-R1.1_PID_-_Fire_Water_and_Potable_water.dwg', '', 'sd_ho_lv5', 96, 0),
(1298, 23, '', '20250404171238_Z921SE-2D1-1-PID-1437-R1.1_PID_-_Steam__Condensate.DWG', '2025-06-16 10:25:39', '204.99', 'AutoCAD File', 'https://achivon.app/dr_files/20250404171238_Z921SE-2D1-1-PID-1437-R1.1_PID_-_Steam__Condensate.DWG', '', 'sd_ho_lv5', 96, 0),
(1299, 23, '', '20250404171246_Z921SE-2D1-1-PID-1438-R1.1_PID_-_Nitrogen__Oxygen.DWG', '2025-06-16 10:25:39', '175.51', 'AutoCAD File', 'https://achivon.app/dr_files/20250404171246_Z921SE-2D1-1-PID-1438-R1.1_PID_-_Nitrogen__Oxygen.DWG', '', 'sd_ho_lv5', 96, 0),
(1300, 23, '', '20250404171252_Z921SE-2D1-1-PID-1439-R1.1_PID_-_Mill_Air.DWG', '2025-04-04 17:12:52', '141.56', 'AutoCAD File', 'https://achivon.app/dr_files/20250404171252_Z921SE-2D1-1-PID-1439-R1.1_PID_-_Mill_Air.DWG', '', 'sd_ho_lv5', 96, 0),
(1301, 23, '', '20250404171300_Z921SE-2D1-1-PID-1440-R1.1_PID_-_Instrument_Air.dwg', '2025-04-04 17:13:00', '156.66', 'AutoCAD File', 'https://achivon.app/dr_files/20250404171300_Z921SE-2D1-1-PID-1440-R1.1_PID_-_Instrument_Air.dwg', '', 'sd_ho_lv5', 96, 0),
(1302, 23, '', '20250404171310_Z921SE-2D1-1-PID-1441-R1.1_PID_-_Pump_Seal_Water__Ambient_Air_Monitors.dwg', '2025-06-16 10:25:39', '127.9', 'AutoCAD File', 'https://achivon.app/dr_files/20250404171310_Z921SE-2D1-1-PID-1441-R1.1_PID_-_Pump_Seal_Water__Ambient_Air_Monitors.dwg', '', 'sd_ho_lv5', 96, 0),
(1303, 23, '', '20250404171316_Z921SE-2D1-1-PID-1442-R1.1_PID_-_Hot_and_cold_mill_water.dwg', '2025-04-04 17:13:17', '203.52', 'AutoCAD File', 'https://achivon.app/dr_files/20250404171316_Z921SE-2D1-1-PID-1442-R1.1_PID_-_Hot_and_cold_mill_water.dwg', '', 'sd_ho_lv5', 96, 0),
(1304, 23, '', '20250404171326_Z921SE-2D1-1-PID-1450-R1.1_PID_-_Chlorate_Electrolyzer_Reactor.DWG', '2025-04-04 17:13:26', '288.92', 'AutoCAD File', 'https://achivon.app/dr_files/20250404171326_Z921SE-2D1-1-PID-1450-R1.1_PID_-_Chlorate_Electrolyzer_Reactor.DWG', '', 'sd_ho_lv5', 96, 0),
(1305, 23, '', '20250404171340_Z921SE-2D1-1-PID-1451-R1.1_PID_-_Chlorate_Electrolyzer_Reactor.DWG', '2025-04-04 17:13:40', '138.97', 'AutoCAD File', 'https://achivon.app/dr_files/20250404171340_Z921SE-2D1-1-PID-1451-R1.1_PID_-_Chlorate_Electrolyzer_Reactor.DWG', '', 'sd_ho_lv5', 96, 0),
(1306, 23, '', '20250404171348_Z921SE-2D1-1-PID-1452-R1.1_PID_-_Strong_Chlorate_Holding.DWG', '2025-04-04 17:13:48', '226.86', 'AutoCAD File', 'https://achivon.app/dr_files/20250404171348_Z921SE-2D1-1-PID-1452-R1.1_PID_-_Strong_Chlorate_Holding.DWG', '', 'sd_ho_lv5', 96, 0),
(1307, 23, '', '20250404171356_Z921SE-2D1-1-PID-1453-R1.1_PID_-_Strong_Chlorate_filters.DWG', '2025-04-04 17:13:56', '221.89', 'AutoCAD File', 'https://achivon.app/dr_files/20250404171356_Z921SE-2D1-1-PID-1453-R1.1_PID_-_Strong_Chlorate_filters.DWG', '', 'sd_ho_lv5', 96, 0),
(1308, 23, '', '20250404171404_Z921SE-2D1-1-PID-1454-R1.1_PID_-_Chlorine_Dioxide_Production.DWG', '2025-04-04 17:14:04', '267.91', 'AutoCAD File', 'https://achivon.app/dr_files/20250404171404_Z921SE-2D1-1-PID-1454-R1.1_PID_-_Chlorine_Dioxide_Production.DWG', '', 'sd_ho_lv5', 96, 0),
(1309, 23, '', '20250404171410_Z921SE-2D1-1-PID-1455-R1.1_PID_-_Chlorine_Dioxide_Production.DWG', '2025-04-04 17:14:10', '191.7', 'AutoCAD File', 'https://achivon.app/dr_files/20250404171410_Z921SE-2D1-1-PID-1455-R1.1_PID_-_Chlorine_Dioxide_Production.DWG', '', 'sd_ho_lv5', 96, 0),
(1310, 23, '', '20250404171418_Z921SE-2D1-1-PID-1456-R1.1_PID_-_Hydrogen_Demister__Acid_Sump.DWG', '2025-06-16 10:25:39', '271.29', 'AutoCAD File', 'https://achivon.app/dr_files/20250404171418_Z921SE-2D1-1-PID-1456-R1.1_PID_-_Hydrogen_Demister__Acid_Sump.DWG', '', 'sd_ho_lv5', 96, 0),
(1311, 23, '', '20250404171426_Z921SE-2D1-1-PID-1457-R1.1_PID_-_HCL_Synthesis_Unit.DWG', '2025-04-04 17:14:26', '283.81', 'AutoCAD File', 'https://achivon.app/dr_files/20250404171426_Z921SE-2D1-1-PID-1457-R1.1_PID_-_HCL_Synthesis_Unit.DWG', '', 'sd_ho_lv5', 96, 0),
(1312, 23, '', '20250404171433_Z921SE-2D1-1-PID-1458-R1.1_PID_-_HCL_Storage.DWG', '2025-04-04 17:14:33', '256.73', 'AutoCAD File', 'https://achivon.app/dr_files/20250404171433_Z921SE-2D1-1-PID-1458-R1.1_PID_-_HCL_Storage.DWG', '', 'sd_ho_lv5', 96, 0),
(1313, 23, '', '20250404171440_Z921SE-2D1-1-PID-1459-R1.1_PID_-_Hydrogen_Scrubbing_and_Hypo.DWG', '2025-04-04 17:14:40', '164.75', 'AutoCAD File', 'https://achivon.app/dr_files/20250404171440_Z921SE-2D1-1-PID-1459-R1.1_PID_-_Hydrogen_Scrubbing_and_Hypo.DWG', '', 'sd_ho_lv5', 96, 0),
(1314, 23, '', '20250404171447_Z921SE-2D1-1-PID-1460-R1.1_PID_-_Chlorine_Dioxide_Storage.dwg', '2025-04-04 17:14:47', '207.83', 'AutoCAD File', 'https://achivon.app/dr_files/20250404171447_Z921SE-2D1-1-PID-1460-R1.1_PID_-_Chlorine_Dioxide_Storage.dwg', '', 'sd_ho_lv5', 96, 0),
(1315, 23, '', '20250404171454_Z921SE-2D1-1-PID-1461-R1.1_PID_-_Chilled_Water_System.dwg', '2025-04-04 17:14:54', '173.19', 'AutoCAD File', 'https://achivon.app/dr_files/20250404171454_Z921SE-2D1-1-PID-1461-R1.1_PID_-_Chilled_Water_System.dwg', '', 'sd_ho_lv5', 96, 0),
(1316, 23, '', '20250404171501_Z921SE-2D1-1-PID-1462-R1.1_PID_-_CLO2_Transformer__Reactifier.dwg', '2025-04-04 17:15:01', '114.26', 'AutoCAD File', 'https://achivon.app/dr_files/20250404171501_Z921SE-2D1-1-PID-1462-R1.1_PID_-_CLO2_Transformer__Reactifier.dwg', '', 'sd_ho_lv5', 96, 0),
(1317, 23, '', '20250404171513_Z921SE-2D1-1-PID-1463-R1.1_PID_-_Floor_Drain.DWG', '2025-04-04 17:15:13', '153.62', 'AutoCAD File', 'https://achivon.app/dr_files/20250404171513_Z921SE-2D1-1-PID-1463-R1.1_PID_-_Floor_Drain.DWG', '', 'sd_ho_lv5', 96, 0),
(1318, 23, '', '20250404171758_Z921SE-2D1-1-PFD-1301-R1.0_PFD_-_Brine_Preparation.pdf', '2025-04-04 17:17:58', '189.32', 'PDF Document', 'https://achivon.app/dr_files/20250404171758_Z921SE-2D1-1-PFD-1301-R1.0_PFD_-_Brine_Preparation.pdf', '', 'sd_ho_lv5', 97, 0),
(1319, 23, '', '20250404171807_Z921SE-2D1-1-PFD-1302-R1.0_PFD_-_Brine_Filtration.pdf', '2025-04-04 17:18:07', '177.38', 'PDF Document', 'https://achivon.app/dr_files/20250404171807_Z921SE-2D1-1-PFD-1302-R1.0_PFD_-_Brine_Filtration.pdf', '', 'sd_ho_lv5', 97, 0),
(1320, 23, '', '20250404171813_Z921SE-2D1-1-PFD-1303-R1.0_PFD_-_Brine_Ion_Exchange.pdf', '2025-04-04 17:18:13', '218.04', 'PDF Document', 'https://achivon.app/dr_files/20250404171813_Z921SE-2D1-1-PFD-1303-R1.0_PFD_-_Brine_Ion_Exchange.pdf', '', 'sd_ho_lv5', 97, 0),
(1321, 23, '', '20250404171818_Z921SE-2D1-1-PFD-1304-R1.0_PFD_-_Chlor-Alkali_Cells_-_Anolyte__Chlorine.pdf', '2025-06-16 10:25:39', '191.51', 'PDF Document', 'https://achivon.app/dr_files/20250404171818_Z921SE-2D1-1-PFD-1304-R1.0_PFD_-_Chlor-Alkali_Cells_-_Anolyte__Chlorine.pdf', '', 'sd_ho_lv5', 97, 0),
(1322, 23, '', '20250404171826_Z921SE-2D1-1-PFD-1305-R1.0_PFD_-_Chlor-Alkali_Cells_-_Anolyte__Chlorine.pdf', '2025-06-16 10:25:39', '198.79', 'PDF Document', 'https://achivon.app/dr_files/20250404171826_Z921SE-2D1-1-PFD-1305-R1.0_PFD_-_Chlor-Alkali_Cells_-_Anolyte__Chlorine.pdf', '', 'sd_ho_lv5', 97, 0),
(1323, 23, '', '20250404171831_Z921SE-2D1-1-PFD-1306-R1.0_PFD_-_Chlorine_cooling.pdf', '2025-04-04 17:18:31', '158.37', 'PDF Document', 'https://achivon.app/dr_files/20250404171831_Z921SE-2D1-1-PFD-1306-R1.0_PFD_-_Chlorine_cooling.pdf', '', 'sd_ho_lv5', 97, 0),
(1324, 23, '', '20250404171837_Z921SE-2D1-1-PFD-1308-R1.0_PFD_-_Caustic_storage__Dissolving.pdf', '2025-06-16 10:25:39', '158.95', 'PDF Document', 'https://achivon.app/dr_files/20250404171837_Z921SE-2D1-1-PFD-1308-R1.0_PFD_-_Caustic_storage__Dissolving.pdf', '', 'sd_ho_lv5', 97, 0),
(1325, 23, '', '20250404171845_Z921SE-2D1-1-PFD-1309-R1.0_PFD_-_Hypochlorite_System.pdf', '2025-04-04 17:18:45', '168.29', 'PDF Document', 'https://achivon.app/dr_files/20250404171845_Z921SE-2D1-1-PFD-1309-R1.0_PFD_-_Hypochlorite_System.pdf', '', 'sd_ho_lv5', 97, 0),
(1326, 23, '', '20250404171853_Z921SE-2D1-1-PFD-1351-R1.0_PFD_-_Sodium_Chlorate_Production.pdf', '2025-04-04 17:18:53', '175.04', 'PDF Document', 'https://achivon.app/dr_files/20250404171853_Z921SE-2D1-1-PFD-1351-R1.0_PFD_-_Sodium_Chlorate_Production.pdf', '', 'sd_ho_lv5', 97, 0),
(1327, 23, '', '20250404171901_Z921SE-2D1-1-PFD-1352-R1.0_PFD_-_Chlorine_Dioxide_Generation.pdf', '2025-04-04 17:19:01', '191.71', 'PDF Document', 'https://achivon.app/dr_files/20250404171901_Z921SE-2D1-1-PFD-1352-R1.0_PFD_-_Chlorine_Dioxide_Generation.pdf', '', 'sd_ho_lv5', 97, 0),
(1328, 23, '', '20250404171911_Z921SE-2D1-1-PFD-1354-R1.0_PFD_-_Hydrochiloric_Acid_Production.pdf', '2025-04-04 17:19:11', '175.42', 'PDF Document', 'https://achivon.app/dr_files/20250404171911_Z921SE-2D1-1-PFD-1354-R1.0_PFD_-_Hydrochiloric_Acid_Production.pdf', '', 'sd_ho_lv5', 97, 0),
(1329, 23, '', '20250404171925_Z921SE-2D1-1-PFD-1355-R1.0_PFD_-_Fume_Absorption.pdf', '2025-04-04 17:19:25', '158.48', 'PDF Document', 'https://achivon.app/dr_files/20250404171925_Z921SE-2D1-1-PFD-1355-R1.0_PFD_-_Fume_Absorption.pdf', '', 'sd_ho_lv5', 97, 0),
(1330, 23, '', '20250404171935_Z921SE-2D1-1-PFD-1356-R1.0_PFD_-_Chilled_Water_System.pdf', '2025-04-04 17:19:35', '135.98', 'PDF Document', 'https://achivon.app/dr_files/20250404171935_Z921SE-2D1-1-PFD-1356-R1.0_PFD_-_Chilled_Water_System.pdf', '', 'sd_ho_lv5', 97, 0),
(1331, 23, '', '20250404172040_Z921SE-2D1-1-PFD-1301-R1.0_PFD_-_Brine_Preparation.pdf', '2025-04-04 17:20:40', '189.32', 'PDF Document', 'https://achivon.app/dr_files/20250404172040_Z921SE-2D1-1-PFD-1301-R1.0_PFD_-_Brine_Preparation.pdf', '', 'sd_ho_lv5', 98, 0),
(1332, 23, '', '20250404172045_Z921SE-2D1-1-PFD-1302-R1.0_PFD_-_Brine_Filtration.pdf', '2025-04-04 17:20:45', '177.38', 'PDF Document', 'https://achivon.app/dr_files/20250404172045_Z921SE-2D1-1-PFD-1302-R1.0_PFD_-_Brine_Filtration.pdf', '', 'sd_ho_lv5', 98, 0),
(1333, 23, '', '20250404172049_Z921SE-2D1-1-PFD-1303-R1.0_PFD_-_Brine_Ion_Exchange.pdf', '2025-04-04 17:20:49', '218.04', 'PDF Document', 'https://achivon.app/dr_files/20250404172049_Z921SE-2D1-1-PFD-1303-R1.0_PFD_-_Brine_Ion_Exchange.pdf', '', 'sd_ho_lv5', 98, 0),
(1334, 23, '', '20250404172054_Z921SE-2D1-1-PFD-1304-R1.0_PFD_-_Chlor-Alkali_Cells_-_Anolyte__Chlorine.pdf', '2025-06-16 10:25:39', '191.51', 'PDF Document', 'https://achivon.app/dr_files/20250404172054_Z921SE-2D1-1-PFD-1304-R1.0_PFD_-_Chlor-Alkali_Cells_-_Anolyte__Chlorine.pdf', '', 'sd_ho_lv5', 98, 0),
(1335, 23, '', '20250404172059_Z921SE-2D1-1-PFD-1305-R1.0_PFD_-_Chlor-Alkali_Cells_-_Anolyte__Chlorine.pdf', '2025-06-16 10:25:39', '198.79', 'PDF Document', 'https://achivon.app/dr_files/20250404172059_Z921SE-2D1-1-PFD-1305-R1.0_PFD_-_Chlor-Alkali_Cells_-_Anolyte__Chlorine.pdf', '', 'sd_ho_lv5', 98, 0),
(1336, 23, '', '20250404172104_Z921SE-2D1-1-PFD-1306-R1.0_PFD_-_Chlorine_cooling.pdf', '2025-04-04 17:21:04', '158.37', 'PDF Document', 'https://achivon.app/dr_files/20250404172104_Z921SE-2D1-1-PFD-1306-R1.0_PFD_-_Chlorine_cooling.pdf', '', 'sd_ho_lv5', 98, 0),
(1337, 23, '', '20250404172114_Z921SE-2D1-1-PFD-1308-R1.0_PFD_-_Caustic_storage__Dissolving.pdf', '2025-06-16 10:25:39', '158.95', 'PDF Document', 'https://achivon.app/dr_files/20250404172114_Z921SE-2D1-1-PFD-1308-R1.0_PFD_-_Caustic_storage__Dissolving.pdf', '', 'sd_ho_lv5', 98, 0),
(1338, 23, '', '20250404172129_Z921SE-2D1-1-PFD-1309-R1.0_PFD_-_Hypochlorite_System.pdf', '2025-04-04 17:21:29', '168.29', 'PDF Document', 'https://achivon.app/dr_files/20250404172129_Z921SE-2D1-1-PFD-1309-R1.0_PFD_-_Hypochlorite_System.pdf', '', 'sd_ho_lv5', 98, 0),
(1339, 23, '', '20250404172134_Z921SE-2D1-1-PFD-1351-R1.0_PFD_-_Sodium_Chlorate_Production.pdf', '2025-04-04 17:21:34', '175.04', 'PDF Document', 'https://achivon.app/dr_files/20250404172134_Z921SE-2D1-1-PFD-1351-R1.0_PFD_-_Sodium_Chlorate_Production.pdf', '', 'sd_ho_lv5', 98, 0),
(1340, 23, '', '20250404172145_Z921SE-2D1-1-PFD-1352-R1.0_PFD_-_Chlorine_Dioxide_Generation.pdf', '2025-04-04 17:21:45', '191.71', 'PDF Document', 'https://achivon.app/dr_files/20250404172145_Z921SE-2D1-1-PFD-1352-R1.0_PFD_-_Chlorine_Dioxide_Generation.pdf', '', 'sd_ho_lv5', 98, 0),
(1341, 23, '', '20250404172159_Z921SE-2D1-1-PFD-1354-R1.0_PFD_-_Hydrochiloric_Acid_Production.pdf', '2025-04-04 17:21:59', '175.42', 'PDF Document', 'https://achivon.app/dr_files/20250404172159_Z921SE-2D1-1-PFD-1354-R1.0_PFD_-_Hydrochiloric_Acid_Production.pdf', '', 'sd_ho_lv5', 98, 0),
(1342, 23, '', '20250404172213_Z921SE-2D1-1-PFD-1355-R1.0_PFD_-_Fume_Absorption.pdf', '2025-04-04 17:22:13', '158.48', 'PDF Document', 'https://achivon.app/dr_files/20250404172213_Z921SE-2D1-1-PFD-1355-R1.0_PFD_-_Fume_Absorption.pdf', '', 'sd_ho_lv5', 98, 0),
(1343, 23, '', '20250404172223_Z921SE-2D1-1-PFD-1356-R1.0_PFD_-_Chilled_Water_System.pdf', '2025-04-04 17:22:23', '135.98', 'PDF Document', 'https://achivon.app/dr_files/20250404172223_Z921SE-2D1-1-PFD-1356-R1.0_PFD_-_Chilled_Water_System.pdf', '', 'sd_ho_lv5', 98, 0),
(1344, 21, '', '20250405120750_Area_41_PID.pdf', '2025-06-16 10:25:39', '33358.69', 'PDF Document', 'https://achivon.app/dr_files/20250405120750_Area_41_PID.pdf', '', 'sd_ho_lv4', 97, 1),
(1345, 21, '', '20250405121150_Photo.rar', '2025-04-05 12:11:50', '29004.85', 'Other', 'https://achivon.app/dr_files/20250405121150_Photo.rar', '', 'sd_ho_lv4', 97, 0),
(1346, 21, '', '20250405121315_Area_41_PID.pdf', '2025-06-16 10:25:39', '33358.69', 'PDF Document', 'https://achivon.app/dr_files/20250405121315_Area_41_PID.pdf', '', 'sd_ho_lv4', 97, 0),
(1347, 21, '', '', '2025-04-05 12:59:21', NULL, '', 'https://drive.google.com/file/d/1lJ0v8WarzspG_bcByQLUPUfbDD-om9Kl/view?usp=sharing', '', 'sd_ho_lv4', 98, 0),
(1348, 20, '', '20250407081728_Z921SE-2D0-REP-001.pdf', '2025-04-07 08:17:29', '2917.98', 'PDF Document', 'https://achivon.app/dr_files/20250407081728_Z921SE-2D0-REP-001.pdf', '', 'sd_ho_lv4', 99, 0),
(1349, 23, '', '20250407083826_KN02_Z921SE-2D1-1-PID_20250214_(KN_Feedback_to_CNDC_20250305).pdf', '2025-04-07 08:38:26', '11469.33', 'PDF Document', 'https://achivon.app/dr_files/20250407083826_KN02_Z921SE-2D1-1-PID_20250214_%28KN_Feedback_to_CNDC_20250305%29.pdf', '', 'sd_ho_lv4', 100, 0),
(1350, 21, '', '20250407101102_92C02400-PID_combined_scope_markup.pdf', '2025-04-07 10:11:02', '4758.66', 'PDF Document', 'https://achivon.app/dr_files/20250407101102_92C02400-PID_combined_scope_markup.pdf', '', 'sd_ho_lv6', 23, 0),
(1351, 21, '', '20250407101120_ELP(MA~1.PDF', '2025-04-07 10:11:20', '4090.66', 'PDF Document', 'https://achivon.app/dr_files/20250407101120_ELP%28MA%7E1.PDF', '', 'sd_ho_lv6', 23, 0),
(1352, 21, '', '20250407101133_Split_of_Scope_of_Supply__Work_-_Chemetics.pdf', '2025-06-16 10:25:39', '4733.3', 'PDF Document', 'https://achivon.app/dr_files/20250407101133_Split_of_Scope_of_Supply__Work_-_Chemetics.pdf', '', 'sd_ho_lv6', 23, 0),
(1353, 21, '', '20250407101717_~Z921SE-2D1-1-PID.pdf', '2025-04-07 10:17:17', '11243.14', 'PDF Document', 'https://achivon.app/dr_files/20250407101717_%7EZ921SE-2D1-1-PID.pdf', '', 'sd_ho_lv6', 26, 0),
(1354, 21, '', '20250407101750_Fw__Z921S-CNDC-KN-TR0004_(2025.2.14).zip', '2025-04-07 10:17:50', '22612.46', 'Other', 'https://achivon.app/dr_files/20250407101750_Fw__Z921S-CNDC-KN-TR0004_%282025.2.14%29.zip', '', 'sd_ho_lv6', 26, 0),
(1355, 21, '', '20250407102505_Z921S-~1.PDF', '2025-04-07 10:25:05', '85.45', 'PDF Document', 'https://achivon.app/dr_files/20250407102505_Z921S-%7E1.PDF', '', 'sd_ho_lv6', 26, 0),
(1356, 21, '', '20250407102556_KN01_Z921S-CNDC-KN-TR0004_(KN_Feedback_to_CNDC_20250221).pdf', '2025-04-07 10:25:56', '89.41', 'PDF Document', 'https://achivon.app/dr_files/20250407102556_KN01_Z921S-CNDC-KN-TR0004_%28KN_Feedback_to_CNDC_20250221%29.pdf', '', 'sd_ho_lv6', 29, 0),
(1357, 21, '', '20250407102609_KN02_Z~1.PDF', '2025-04-07 10:26:09', '11406.7', 'PDF Document', 'https://achivon.app/dr_files/20250407102609_KN02_Z%7E1.PDF', '', 'sd_ho_lv6', 29, 0),
(1358, 21, '', '20250407102948_92C02400-PID_combined_scope_markup_20241127.pdf', '2025-04-07 10:29:48', '4963.69', 'PDF Document', 'https://achivon.app/dr_files/20250407102948_92C02400-PID_combined_scope_markup_20241127.pdf', '', 'sd_ho_lv6', 24, 0),
(1359, 21, '', '20250407102957_APPEND~1.XLS', '2025-04-07 10:29:57', '92.93', 'Excel Document', 'https://achivon.app/dr_files/20250407102957_APPEND%7E1.XLS', '', 'sd_ho_lv6', 24, 0),
(1360, 21, '', '20250407103014_ELP(MA~1.PDF', '2025-04-07 10:30:14', '4090.66', 'PDF Document', 'https://achivon.app/dr_files/20250407103014_ELP%28MA%7E1.PDF', '', 'sd_ho_lv6', 24, 0),
(1361, 21, '', '20250407103020_SPLITS~1.XLS', '2025-04-07 10:30:20', '21.56', 'Excel Document', 'https://achivon.app/dr_files/20250407103020_SPLITS%7E1.XLS', '', 'sd_ho_lv6', 24, 0),
(1362, 21, '', '20250407103112_92C02400-PID_combined_scope_markup1_20241128.pdf', '2025-04-07 10:31:12', '5127.46', 'PDF Document', 'https://achivon.app/dr_files/20250407103112_92C02400-PID_combined_scope_markup1_20241128.pdf', '', 'sd_ho_lv6', 25, 0),
(1363, 21, '', '20250407103119_APPEND~1.XLS', '2025-04-07 10:31:19', '94.45', 'Excel Document', 'https://achivon.app/dr_files/20250407103119_APPEND%7E1.XLS', '', 'sd_ho_lv6', 25, 0),
(1364, 21, '', '20250407103133_92C024~2.PDF', '2025-04-07 10:31:33', '5778.85', 'PDF Document', 'https://achivon.app/dr_files/20250407103133_92C024%7E2.PDF', '', 'sd_ho_lv6', 25, 0),
(1365, 21, '', '20250407103526_APPEND~2.XLS', '2025-04-07 10:35:26', '93.68', 'Excel Document', 'https://achivon.app/dr_files/20250407103526_APPEND%7E2.XLS', '', 'sd_ho_lv6', 25, 0),
(1366, 21, '', '20250407103635_Z921SE-2D0-REP-001_-_Reply_by_CNDC.pdf', '2025-04-07 10:36:35', '2917.98', 'PDF Document', 'https://achivon.app/dr_files/20250407103635_Z921SE-2D0-REP-001_-_Reply_by_CNDC.pdf', '', 'sd_ho_lv6', 30, 0),
(1367, 21, '', '20250407103701_Z921SE-2D0-REP-001.xlsm', '2025-04-07 10:37:01', '3448.08', 'Other', 'https://achivon.app/dr_files/20250407103701_Z921SE-2D0-REP-001.xlsm', '', 'sd_ho_lv6', 30, 0),
(1368, 21, '', '20250407103756_KN01_Z~1.XLS', '2025-04-07 10:37:56', '3687.58', 'Excel Document', 'https://achivon.app/dr_files/20250407103756_KN01_Z%7E1.XLS', '', 'sd_ho_lv6', 31, 0),
(1369, 21, '', '20250407103813_KN02_Z~1.PDF', '2025-04-07 10:38:13', '11469.33', 'PDF Document', 'https://achivon.app/dr_files/20250407103813_KN02_Z%7E1.PDF', '', 'sd_ho_lv6', 31, 0),
(1370, 21, '', '20250407103819_TRANSM~1.XLS', '2025-04-07 10:38:19', '930.29', 'Excel Document', 'https://achivon.app/dr_files/20250407103819_TRANSM%7E1.XLS', '', 'sd_ho_lv6', 31, 0),
(1371, 21, '', '20250407103919_KN01_Z921SE-2D0-REP-001_(CNDC_Feedback_to_KN_20250314).xlsm', '2025-04-07 10:39:19', '4924.79', 'Other', 'https://achivon.app/dr_files/20250407103919_KN01_Z921SE-2D0-REP-001_%28CNDC_Feedback_to_KN_20250314%29.xlsm', '', 'sd_ho_lv6', 32, 0),
(1372, 21, '', '20250407103919_KN01_Z921SE-2D0-REP-001_(CNDC_Feedback_to_KN_20250314).xlsm', '2025-04-07 03:39:27', '4924.79', 'Other', 'https://achivon.app/dr_files/20250407103919_KN01_Z921SE-2D0-REP-001_%28CNDC_Feedback_to_KN_20250314%29.xlsm', '', 'sd_ho_lv6', 32, 1),
(1373, 21, '', '20250407104020_~Z921SE-2D1-1-PID-R1.1_PID_Summary.pdf', '2025-06-16 10:25:39', '11558.98', 'PDF Document', 'https://achivon.app/dr_files/20250407104020_%7EZ921SE-2D1-1-PID-R1.1_PID_Summary.pdf', '', 'sd_ho_lv6', 33, 0),
(1374, 21, '', '20250407162752_1215.1-Blasting.pdf', '2025-04-07 16:27:52', '226.89', 'PDF Document', 'https://achivon.app/dr_files/20250407162752_1215.1-Blasting.pdf', '', 'sd_ho_lv5', 100, 0),
(1375, 21, '', '20250407162813_Penawaran_Harga_AIRBLAST_Blasting_Set_Machine_cap.100_L.pdf', '2025-04-07 16:28:13', '462.04', 'PDF Document', 'https://achivon.app/dr_files/20250407162813_Penawaran_Harga_AIRBLAST_Blasting_Set_Machine_cap.100_L.pdf', '', 'sd_ho_lv5', 101, 0),
(1376, 21, '', '20250407162821_Penawaran_Harga_AIRBLAST_Blasting_Set_Machine_cap.200_L.pdf', '2025-04-07 16:28:21', '459.67', 'PDF Document', 'https://achivon.app/dr_files/20250407162821_Penawaran_Harga_AIRBLAST_Blasting_Set_Machine_cap.200_L.pdf', '', 'sd_ho_lv5', 101, 0),
(1377, 21, '', '20250407182608_Penawaran_Harga_Blasting_Mesin_Set_120LPortable_Compressor_20250225.pdf', '2025-06-16 10:25:39', '708.42', 'PDF Document', 'https://achivon.app/dr_files/20250407182608_Penawaran_Harga_Blasting_Mesin_Set_120LPortable_Compressor_20250225.pdf', '', 'sd_ho_lv5', 101, 0),
(1378, 21, '', '20250407184946_List_Tools.xlsx', '2025-04-07 18:49:46', '494.37', 'Excel Document', 'https://achivon.app/dr_files/20250407184946_List_Tools.xlsx', '', 'sd_ho_lv4', 101, 0),
(1379, 21, '', '20250408065821_Meminta_20250324-1.pdf', '2025-04-08 06:58:21', '443.68', 'PDF Document', 'https://achivon.app/dr_files/20250408065821_Meminta_20250324-1.pdf', '', 'sd_ho_lv3', 249, 0),
(1380, 21, '', '20250408065956_Meminta_20250324-2.pdf', '2025-04-08 06:59:56', '434.99', 'PDF Document', 'https://achivon.app/dr_files/20250408065956_Meminta_20250324-2.pdf', '', 'sd_ho_lv3', 249, 0),
(1381, 21, '', '20250408070006_Meminta_20250327-3.pdf', '2025-04-08 07:00:06', '403.9', 'PDF Document', 'https://achivon.app/dr_files/20250408070006_Meminta_20250327-3.pdf', '', 'sd_ho_lv3', 249, 0),
(1382, 21, '', '20250408070014_Meminta_20250404-4.pdf', '2025-04-08 07:00:14', '425.07', 'PDF Document', 'https://achivon.app/dr_files/20250408070014_Meminta_20250404-4.pdf', '', 'sd_ho_lv3', 249, 0),
(1383, 21, '', '20250408070021_Meminta_20250404-5.pdf', '2025-04-08 07:00:21', '443.16', 'PDF Document', 'https://achivon.app/dr_files/20250408070021_Meminta_20250404-5.pdf', '', 'sd_ho_lv3', 249, 0),
(1384, 21, '', '20250408070028_Meminta_20250404-6.pdf', '2025-04-08 07:00:28', '428.52', 'PDF Document', 'https://achivon.app/dr_files/20250408070028_Meminta_20250404-6.pdf', '', 'sd_ho_lv3', 249, 0),
(1385, 21, '', '20250408070039_Meminta_20250405-7.pdf', '2025-04-08 07:00:39', '428.93', 'PDF Document', 'https://achivon.app/dr_files/20250408070039_Meminta_20250405-7.pdf', '', 'sd_ho_lv3', 249, 0),
(1386, 21, '', '20250408070049_Meminta_20250405-8.pdf', '2025-04-08 07:00:49', '417.1', 'PDF Document', 'https://achivon.app/dr_files/20250408070049_Meminta_20250405-8.pdf', '', 'sd_ho_lv3', 249, 0),
(1387, 21, '', '20250408070107_Meminta_20250405-8.pdf', '2025-04-08 00:01:16', '417.1', 'PDF Document', 'https://achivon.app/dr_files/20250408070107_Meminta_20250405-8.pdf', '', 'sd_ho_lv3', 249, 1),
(1388, 21, '', '20250408070125_Meminta_20250405-9.pdf', '2025-04-08 07:01:25', '415.21', 'PDF Document', 'https://achivon.app/dr_files/20250408070125_Meminta_20250405-9.pdf', '', 'sd_ho_lv3', 249, 0),
(1389, 21, '', '20250408070134_Meminta_20250405-10.pdf', '2025-04-08 07:01:34', '401.51', 'PDF Document', 'https://achivon.app/dr_files/20250408070134_Meminta_20250405-10.pdf', '', 'sd_ho_lv3', 249, 0),
(1390, 21, '', '20250408070144_Meminta_20250405-11.pdf', '2025-04-08 07:01:44', '404.36', 'PDF Document', 'https://achivon.app/dr_files/20250408070144_Meminta_20250405-11.pdf', '', 'sd_ho_lv3', 249, 0),
(1391, 21, '', '20250408072218_Meminta_20250324-1.pdf', '2025-04-08 00:23:34', '443.68', 'PDF Document', 'https://achivon.app/dr_files/20250408072218_Meminta_20250324-1.pdf', '', 'sd_ho_lv3', 251, 1),
(1392, 21, '', '20250408072234_Meminta_20250324-2.pdf', '2025-04-08 00:23:39', '434.99', 'PDF Document', 'https://achivon.app/dr_files/20250408072234_Meminta_20250324-2.pdf', '', 'sd_ho_lv3', 251, 1),
(1393, 21, '', '20250408072351_Kembali_20250327-1.pdf', '2025-04-08 07:23:51', '436.09', 'PDF Document', 'https://achivon.app/dr_files/20250408072351_Kembali_20250327-1.pdf', '', 'sd_ho_lv3', 251, 0),
(1394, 21, '', '20250408072358_Kembali_20250328-2.pdf', '2025-04-08 07:23:58', '396.08', 'PDF Document', 'https://achivon.app/dr_files/20250408072358_Kembali_20250328-2.pdf', '', 'sd_ho_lv3', 251, 0),
(1395, 21, '', '20250408072528_Fuel_Consumption_Record_Mar_2025.pdf', '2025-04-08 07:25:28', '1662.39', 'PDF Document', 'https://achivon.app/dr_files/20250408072528_Fuel_Consumption_Record_Mar_2025.pdf', '', 'sd_ho_lv3', 252, 0),
(1396, 21, '', '20250408085947_Delivery_Note_-_Hilux__Fortuner_20250305.pdf', '2025-06-16 10:25:39', '517.14', 'PDF Document', 'https://achivon.app/dr_files/20250408085947_Delivery_Note_-_Hilux__Fortuner_20250305.pdf', '', 'sd_ho_lv3', 255, 0),
(1397, 21, '', '20250408085956_Delivery_Note_(ACV_KN_REV-001)_-_Box_Truck.pdf', '2025-04-08 08:59:56', '351.67', 'PDF Document', 'https://achivon.app/dr_files/20250408085956_Delivery_Note_%28ACV_KN_REV-001%29_-_Box_Truck.pdf', '', 'sd_ho_lv3', 255, 0),
(1398, 21, '', '20250408090004_Delivery_Note_(ACV_KN_REV-002)_-_Trailer_+_2_container_20ft.pdf', '2025-04-08 09:00:04', '2007.21', 'PDF Document', 'https://achivon.app/dr_files/20250408090004_Delivery_Note_%28ACV_KN_REV-002%29_-_Trailer_%2B_2_container_20ft.pdf', '', 'sd_ho_lv3', 255, 0),
(1399, 21, '', '20250408090013_Delivery_Note_(ACV_KN_REV-003)_-_Trailer_+_2_container_20ft.pdf', '2025-04-08 09:00:13', '2026.88', 'PDF Document', 'https://achivon.app/dr_files/20250408090013_Delivery_Note_%28ACV_KN_REV-003%29_-_Trailer_%2B_2_container_20ft.pdf', '', 'sd_ho_lv3', 255, 0),
(1400, 21, '', '20250408090021_Delivery_Note_(ACV_KN_REV-004)_-_Hiace_(kongsi_Innova).pdf', '2025-04-08 09:00:21', '201.04', 'PDF Document', 'https://achivon.app/dr_files/20250408090021_Delivery_Note_%28ACV_KN_REV-004%29_-_Hiace_%28kongsi_Innova%29.pdf', '', 'sd_ho_lv3', 255, 0),
(1401, 21, '', '20250408090033_Delivery_Note_(ACV_KN_REV-005)_-_Tronton_(Genset__Forklift).pdf', '2025-06-16 10:25:39', '2575.51', 'PDF Document', 'https://achivon.app/dr_files/20250408090033_Delivery_Note_%28ACV_KN_REV-005%29_-_Tronton_%28Genset__Forklift%29.pdf', '', 'sd_ho_lv3', 255, 0),
(1402, 21, '', '20250408090046_Delivery_Note_(ACV_KN_REV-007)_-_Tronton_(Scaffolding_Pipe).pdf', '2025-04-08 02:01:14', '2757.89', 'PDF Document', 'https://achivon.app/dr_files/20250408090046_Delivery_Note_%28ACV_KN_REV-007%29_-_Tronton_%28Scaffolding_Pipe%29.pdf', '', 'sd_ho_lv3', 255, 1),
(1403, 21, '', '20250408090109_Delivery_Note_(ACV_KN_REV-008)_-_Tronton_(Scaffolding_Pipe).pdf', '2025-04-08 02:01:17', '2829.17', 'PDF Document', 'https://achivon.app/dr_files/20250408090109_Delivery_Note_%28ACV_KN_REV-008%29_-_Tronton_%28Scaffolding_Pipe%29.pdf', '', 'sd_ho_lv3', 255, 1),
(1404, 21, '', '20250408090128_Delivery_Note_(ACV_KN_REV-006)_-_Tronton_(Genset__Air_Compressor).pdf', '2025-06-16 10:25:39', '3029.63', 'PDF Document', 'https://achivon.app/dr_files/20250408090128_Delivery_Note_%28ACV_KN_REV-006%29_-_Tronton_%28Genset__Air_Compressor%29.pdf', '', 'sd_ho_lv3', 255, 0),
(1405, 21, '', '20250408090140_Delivery_Note_(ACV_KN_REV-007)_-_Tronton_(Scaffolding_Pipe).pdf', '2025-04-08 09:01:40', '2757.89', 'PDF Document', 'https://achivon.app/dr_files/20250408090140_Delivery_Note_%28ACV_KN_REV-007%29_-_Tronton_%28Scaffolding_Pipe%29.pdf', '', 'sd_ho_lv3', 255, 0),
(1406, 21, '', '20250408090152_Delivery_Note_(ACV_KN_REV-008)_-_Tronton_(Scaffolding_Pipe).pdf', '2025-04-08 09:01:52', '2829.17', 'PDF Document', 'https://achivon.app/dr_files/20250408090152_Delivery_Note_%28ACV_KN_REV-008%29_-_Tronton_%28Scaffolding_Pipe%29.pdf', '', 'sd_ho_lv3', 255, 0),
(1407, 21, '', '20250408090201_Delivery_Note_(ACV_KN_REV-009)_-_Tronton_(Scaffolding_Metal_Plank).pdf', '2025-04-08 09:02:01', '2508.95', 'PDF Document', 'https://achivon.app/dr_files/20250408090201_Delivery_Note_%28ACV_KN_REV-009%29_-_Tronton_%28Scaffolding_Metal_Plank%29.pdf', '', 'sd_ho_lv3', 255, 0),
(1408, 21, '', '20250408153655_Welding_Rod_KN.xlsx', '2025-04-08 15:36:55', '786.79', 'Excel Document', 'https://achivon.app/dr_files/20250408153655_Welding_Rod_KN.xlsx', '', 'sd_ho_lv5', 102, 0),
(1409, 21, '', '20250408153919_Jimmy-Alfa_metalindo_-welding_rod-ACHIVON_012_Rv.01.pdf', '2025-04-08 15:39:19', '189.32', 'PDF Document', 'https://achivon.app/dr_files/20250408153919_Jimmy-Alfa_metalindo_-welding_rod-ACHIVON_012_Rv.01.pdf', '', 'sd_ho_lv6', 36, 0),
(1410, 21, '', '20250408153925_Jimmy-Alfa_metalindo_-welding_rod-ACHIVON_012_rev01_20250408.pdf', '2025-04-08 15:39:25', '207.26', 'PDF Document', 'https://achivon.app/dr_files/20250408153925_Jimmy-Alfa_metalindo_-welding_rod-ACHIVON_012_rev01_20250408.pdf', '', 'sd_ho_lv6', 36, 0),
(1411, 21, '', '20250408153944_Penawaran_Pt_Achivon_Q032.pdf', '2025-04-08 15:39:44', '105.31', 'PDF Document', 'https://achivon.app/dr_files/20250408153944_Penawaran_Pt_Achivon_Q032.pdf', '', 'sd_ho_lv6', 37, 0),
(1412, 21, '', '20250408154004_1.Q-TST-03-25-001_PT.Achivon_P.A.pdf', '2025-04-08 15:40:04', '101.83', 'PDF Document', 'https://achivon.app/dr_files/20250408154004_1.Q-TST-03-25-001_PT.Achivon_P.A.pdf', '', 'sd_ho_lv6', 38, 0),
(1413, 21, '', '20250408154019_PH_Achivon_115.pdf', '2025-04-08 15:40:19', '58.95', 'PDF Document', 'https://achivon.app/dr_files/20250408154019_PH_Achivon_115.pdf', '', 'sd_ho_lv6', 39, 0),
(1414, 21, '', '20250408194112_Material_Control_-_CV_Puguh_Riyanto_(Cilacap_with_Dona).pdf', '2025-04-08 19:41:13', '402.42', 'PDF Document', 'https://achivon.app/dr_files/20250408194112_Material_Control_-_CV_Puguh_Riyanto_%28Cilacap_with_Dona%29.pdf', '', 'sd_ho_lv4', 103, 0),
(1415, 21, '', '20250408194129_CV_Spool_COntrol_Buang_(Cilacap_with_Dona).pdf', '2025-04-08 19:41:29', '132.98', 'PDF Document', 'https://achivon.app/dr_files/20250408194129_CV_Spool_COntrol_Buang_%28Cilacap_with_Dona%29.pdf', '', 'sd_ho_lv4', 104, 0),
(1416, 21, '', '20250408194203_CV_Electrician_SUTARYO.pdf', '2025-04-08 19:42:03', '5535.91', 'PDF Document', 'https://achivon.app/dr_files/20250408194203_CV_Electrician_SUTARYO.pdf', '', 'sd_ho_lv4', 105, 0),
(1417, 21, '', '20250408194450_Name_list_Manpower_Mursid__Rifno.xlsx', '2025-06-16 10:25:39', '12.98', 'Excel Document', 'https://achivon.app/dr_files/20250408194450_Name_list_Manpower_Mursid__Rifno.xlsx', '', 'sd_ho_lv4', 106, 0),
(1418, 21, '', '20250408194638_Fitter_1.rar', '2025-04-08 19:46:38', '35048.88', 'Other', 'https://achivon.app/dr_files/20250408194638_Fitter_1.rar', '', 'sd_ho_lv4', 106, 0),
(1419, 21, '', '20250408194706_Name_list_Manpower_Mursid__Rifno.xlsx', '2025-06-16 10:25:39', '12.98', 'Excel Document', 'https://achivon.app/dr_files/20250408194706_Name_list_Manpower_Mursid__Rifno.xlsx', '', 'sd_ho_lv5', 106, 0),
(1420, 21, '', '20250408194806_Fitter_2.rar', '2025-04-08 19:48:06', '23371.44', 'Other', 'https://achivon.app/dr_files/20250408194806_Fitter_2.rar', '', 'sd_ho_lv5', 106, 0),
(1421, 21, '', '20250408194837_Name_list_Manpower_Mursid__Rifno.xlsx', '2025-06-16 10:25:39', '12.98', 'Excel Document', 'https://achivon.app/dr_files/20250408194837_Name_list_Manpower_Mursid__Rifno.xlsx', '', 'sd_ho_lv5', 107, 0),
(1422, 21, '', '20250408195035_Welder_CS.rar', '2025-04-08 19:50:35', '27617.75', 'Other', 'https://achivon.app/dr_files/20250408195035_Welder_CS.rar', '', 'sd_ho_lv5', 107, 0),
(1423, 21, '', '20250408195109_Name_list_Manpower_Mursid__Rifno.xlsx', '2025-06-16 10:25:39', '12.98', 'Excel Document', 'https://achivon.app/dr_files/20250408195109_Name_list_Manpower_Mursid__Rifno.xlsx', '', 'sd_ho_lv5', 108, 0),
(1424, 21, '', '20250408195425_Welder_SS.rar', '2025-04-08 19:54:25', '78017.52', 'Other', 'https://achivon.app/dr_files/20250408195425_Welder_SS.rar', '', 'sd_ho_lv5', 108, 0),
(1425, 21, '', '20250408195454_Name_list_Manpower_Mursid__Rifno.xlsx', '2025-06-16 10:25:39', '12.98', 'Excel Document', 'https://achivon.app/dr_files/20250408195454_Name_list_Manpower_Mursid__Rifno.xlsx', '', 'sd_ho_lv5', 109, 0),
(1426, 21, '', '20250408195529_Rigger.rar', '2025-04-08 19:55:29', '9806.17', 'Other', 'https://achivon.app/dr_files/20250408195529_Rigger.rar', '', 'sd_ho_lv5', 109, 0),
(1427, 21, '', '20250408195550_Name_list_Manpower_Mursid__Rifno.xlsx', '2025-06-16 10:25:39', '12.98', 'Excel Document', 'https://achivon.app/dr_files/20250408195550_Name_list_Manpower_Mursid__Rifno.xlsx', '', 'sd_ho_lv4', 111, 1),
(1428, 21, '', '20250408195614_Name_list_Manpower_Mursid__Rifno.xlsx', '2025-06-16 10:25:39', '12.98', 'Excel Document', 'https://achivon.app/dr_files/20250408195614_Name_list_Manpower_Mursid__Rifno.xlsx', '', 'sd_ho_lv5', 110, 0),
(1429, 21, '', '20250408195719_Scaffolder_1.rar', '2025-04-08 19:57:19', '23983.7', 'Other', 'https://achivon.app/dr_files/20250408195719_Scaffolder_1.rar', '', 'sd_ho_lv5', 110, 0),
(1430, 21, '', '20250408195748_Name_list_Manpower_Mursid__Rifno.xlsx', '2025-06-16 10:25:39', '12.98', 'Excel Document', 'https://achivon.app/dr_files/20250408195748_Name_list_Manpower_Mursid__Rifno.xlsx', '', 'sd_ho_lv5', 111, 0),
(1431, 21, '', '', '2025-04-08 12:58:00', NULL, '', '', '', 'sd_ho_lv5', 111, 1),
(1432, 21, '', '20250408195818_Blaster.rar', '2025-04-08 19:58:18', '4624.55', 'Other', 'https://achivon.app/dr_files/20250408195818_Blaster.rar', '', 'sd_ho_lv5', 111, 0),
(1433, 21, '', '20250408195844_Name_list_Manpower_Mursid__Rifno.xlsx', '2025-06-16 10:25:39', '12.98', 'Excel Document', 'https://achivon.app/dr_files/20250408195844_Name_list_Manpower_Mursid__Rifno.xlsx', '', 'sd_ho_lv5', 112, 0),
(1434, 21, '', '20250408195919_Painter.rar', '2025-04-08 19:59:19', '4492.12', 'Other', 'https://achivon.app/dr_files/20250408195919_Painter.rar', '', 'sd_ho_lv5', 112, 0),
(1435, 21, '', '20250409150104_Rev_WPS_PT_ACHIVON.pdf', '2025-04-09 15:01:04', '411.97', 'PDF Document', 'https://achivon.app/dr_files/20250409150104_Rev_WPS_PT_ACHIVON.pdf', '', 'sd_ho_lv6', 40, 0),
(1436, 21, '', '20250409150419_097-AMI-QUO-III-2025.Rev1_PT_ACHIVON.pdf', '2025-04-09 15:04:19', '245.55', 'PDF Document', 'https://achivon.app/dr_files/20250409150419_097-AMI-QUO-III-2025.Rev1_PT_ACHIVON.pdf', '', 'sd_ho_lv7', 22, 0),
(1437, 21, '', '20250409150433_QUO-ISTEK-2025-039_for_PT._Achivon_Prestasi_Abadi.pdf', '2025-04-09 15:04:33', '630.27', 'PDF Document', 'https://achivon.app/dr_files/20250409150433_QUO-ISTEK-2025-039_for_PT._Achivon_Prestasi_Abadi.pdf', '', 'sd_ho_lv7', 23, 0),
(1438, 21, '', '20250409195607_CV_Operator_komputer_gudang_Dwi_wahyu.pdf', '2025-04-09 19:56:07', '2059.91', 'PDF Document', 'https://achivon.app/dr_files/20250409195607_CV_Operator_komputer_gudang_Dwi_wahyu.pdf', '', 'sd_ho_lv4', 118, 0),
(1439, 21, '', '20250409195619_CV_Helper_gudang_dan_back_up_operator_komputer_Yolanda.pdf', '2025-04-09 19:56:19', '1022.17', 'PDF Document', 'https://achivon.app/dr_files/20250409195619_CV_Helper_gudang_dan_back_up_operator_komputer_Yolanda.pdf', '', 'sd_ho_lv4', 118, 0),
(1440, 21, '', '20250409195844_CV_Accounting_Lia_Asmaul_Khusna.pdf', '2025-04-09 19:58:44', '607.19', 'PDF Document', 'https://achivon.app/dr_files/20250409195844_CV_Accounting_Lia_Asmaul_Khusna.pdf', '', 'sd_ho_lv4', 119, 0),
(1441, 21, '', '20250410072029_Meminta_20250407-12.pdf', '2025-04-10 07:20:29', '440.48', 'PDF Document', 'https://achivon.app/dr_files/20250410072029_Meminta_20250407-12.pdf', '', 'sd_ho_lv3', 249, 0),
(1442, 21, '', '20250410072038_Meminta_20250407-13.pdf', '2025-04-10 07:20:38', '435.32', 'PDF Document', 'https://achivon.app/dr_files/20250410072038_Meminta_20250407-13.pdf', '', 'sd_ho_lv3', 249, 0),
(1443, 21, '', '20250410072047_Meminta_20250407-14.pdf', '2025-04-10 07:20:47', '441.68', 'PDF Document', 'https://achivon.app/dr_files/20250410072047_Meminta_20250407-14.pdf', '', 'sd_ho_lv3', 249, 0),
(1444, 21, '', '20250410072059_Meminta_20250408-16.pdf', '2025-04-10 00:21:07', '441.94', 'PDF Document', 'https://achivon.app/dr_files/20250410072059_Meminta_20250408-16.pdf', '', 'sd_ho_lv3', 249, 1),
(1445, 21, '', '20250410072133_Meminta_20250407-15.pdf', '2025-04-10 07:21:33', '436.71', 'PDF Document', 'https://achivon.app/dr_files/20250410072133_Meminta_20250407-15.pdf', '', 'sd_ho_lv3', 249, 0),
(1446, 21, '', '20250410072140_Meminta_20250408-16.pdf', '2025-04-10 07:21:40', '441.94', 'PDF Document', 'https://achivon.app/dr_files/20250410072140_Meminta_20250408-16.pdf', '', 'sd_ho_lv3', 249, 0),
(1447, 21, '', '20250410072147_Meminta_20250408-17.pdf', '2025-04-10 07:21:47', '423.11', 'PDF Document', 'https://achivon.app/dr_files/20250410072147_Meminta_20250408-17.pdf', '', 'sd_ho_lv3', 249, 0),
(1448, 21, '', '20250410165647_CV_Safety_Rhomy_Muhammad_(UMK_4.08jt).pdf', '2025-04-10 16:56:47', '3734.19', 'PDF Document', 'https://achivon.app/dr_files/20250410165647_CV_Safety_Rhomy_Muhammad_%28UMK_4.08jt%29.pdf', '', 'sd_ho_lv4', 120, 0),
(1449, 21, '', '20250410181641_CV_Operator_Forklift__Kornelis_Bay.pdf', '2025-04-10 18:16:41', '1250.94', 'PDF Document', 'https://achivon.app/dr_files/20250410181641_CV_Operator_Forklift__Kornelis_Bay.pdf', '', 'sd_ho_lv4', 116, 0),
(1450, 21, '', '20250413080518_Meminta_20250408-18.pdf', '2025-04-13 08:05:18', '410.12', 'PDF Document', 'https://achivon.app/dr_files/20250413080518_Meminta_20250408-18.pdf', '', 'sd_ho_lv3', 249, 0),
(1451, 21, '', '20250413080532_Meminta_20250409-19.pdf', '2025-04-13 08:05:32', '421.4', 'PDF Document', 'https://achivon.app/dr_files/20250413080532_Meminta_20250409-19.pdf', '', 'sd_ho_lv3', 249, 0),
(1452, 21, '', '20250413080541_Meminta_20250409-20.pdf', '2025-04-13 08:05:41', '407.08', 'PDF Document', 'https://achivon.app/dr_files/20250413080541_Meminta_20250409-20.pdf', '', 'sd_ho_lv3', 249, 0),
(1453, 21, '', '20250413080551_Meminta_20250409-21.pdf', '2025-04-13 08:05:51', '433.63', 'PDF Document', 'https://achivon.app/dr_files/20250413080551_Meminta_20250409-21.pdf', '', 'sd_ho_lv3', 249, 0),
(1454, 21, '', '20250413080601_Meminta_20250410-22.pdf', '2025-04-13 08:06:01', '417.97', 'PDF Document', 'https://achivon.app/dr_files/20250413080601_Meminta_20250410-22.pdf', '', 'sd_ho_lv3', 249, 0),
(1455, 21, '', '20250413080610_Meminta_20250410-23.pdf', '2025-04-13 08:06:10', '412.1', 'PDF Document', 'https://achivon.app/dr_files/20250413080610_Meminta_20250410-23.pdf', '', 'sd_ho_lv3', 249, 0),
(1456, 21, '', '20250413080623_Meminta_20250411-24.pdf', '2025-04-13 08:06:23', '432.17', 'PDF Document', 'https://achivon.app/dr_files/20250413080623_Meminta_20250411-24.pdf', '', 'sd_ho_lv3', 249, 0),
(1457, 21, '', '20250413080633_Meminta_20250411-25.pdf', '2025-04-13 08:06:33', '423.58', 'PDF Document', 'https://achivon.app/dr_files/20250413080633_Meminta_20250411-25.pdf', '', 'sd_ho_lv3', 249, 0),
(1458, 21, '', '20250413080641_Meminta_20250412-26.pdf', '2025-04-13 08:06:41', '421.08', 'PDF Document', 'https://achivon.app/dr_files/20250413080641_Meminta_20250412-26.pdf', '', 'sd_ho_lv3', 249, 0),
(1459, 21, '', '20250413080649_Meminta_20250412-27.pdf', '2025-04-13 08:06:49', '419.24', 'PDF Document', 'https://achivon.app/dr_files/20250413080649_Meminta_20250412-27.pdf', '', 'sd_ho_lv3', 249, 0),
(1460, 21, '', '20250414101730_Comparison_List_of_Steel_Structure_Material_(20250414).xlsx', '2025-04-14 10:17:30', '2580.39', 'Excel Document', 'https://achivon.app/dr_files/20250414101730_Comparison_List_of_Steel_Structure_Material_%2820250414%29.xlsx', '', 'sd_ho_lv4', 54, 0),
(1461, 23, '', '20250414174733_Structure_Material_List_Summary_Updated_Rev._2_(20250414).xlsx', '2025-04-14 17:47:33', '2580.37', 'Excel Document', 'https://achivon.app/dr_files/20250414174733_Structure_Material_List_Summary_Updated_Rev._2_%2820250414%29.xlsx', '', 'sd_ho_lv3', 247, 0),
(1462, 21, '', '20250415191220_Soot_blower_KN.xlsx', '2025-04-15 19:12:20', '16.65', 'Excel Document', 'https://achivon.app/dr_files/20250415191220_Soot_blower_KN.xlsx', '', 'sd_ho_lv5', 114, 0),
(1463, 21, '', '20250415191244_List_of_Soot_Blower.pdf', '2025-04-15 19:12:44', '1377.73', 'PDF Document', 'https://achivon.app/dr_files/20250415191244_List_of_Soot_Blower.pdf', '', 'sd_ho_lv5', 114, 0),
(1464, 21, '', '', '2025-04-15 19:14:20', NULL, '', 'https://drive.google.com/file/d/1s89ZL5LY-MzF72As-FpACJHaIz7jXT7A/view?usp=sharing', '', 'sd_ho_lv4', 121, 0),
(1465, 21, '', '', '2025-04-15 19:16:28', NULL, '', 'https://drive.google.com/file/d/1s89ZL5LY-MzF72As-FpACJHaIz7jXT7A/view?usp=sharing', '', 'sd_ho_lv5', 115, 0),
(1466, 21, '', '', '2025-04-15 12:16:40', NULL, '', 'https://drive.google.com/file/d/1s89ZL5LY-MzF72As-FpACJHaIz7jXT7A/view?usp=sharing', '', 'sd_ho_lv5', 115, 1),
(1467, 21, '', '20250415191823_Model-L-Sootblower-Brochure.pdf', '2025-04-15 19:18:23', '1171.56', 'PDF Document', 'https://achivon.app/dr_files/20250415191823_Model-L-Sootblower-Brochure.pdf', '', 'sd_ho_lv5', 114, 0),
(1468, 21, '', '20250415195514_Price_Comparison_of_Painting_Material.xlsx', '2025-04-15 19:55:14', '275', 'Excel Document', 'https://achivon.app/dr_files/20250415195514_Price_Comparison_of_Painting_Material.xlsx', '', 'sd_ho_lv5', 116, 0),
(1469, 21, '', '20250415195709_PPG_Steel_Structure___Kertas_Nusantara_Berau_Kaltim.zip', '2025-04-15 12:57:17', '1351.22', 'Other', 'https://achivon.app/dr_files/20250415195709_PPG_Steel_Structure___Kertas_Nusantara_Berau_Kaltim.zip', '', 'sd_ho_lv6', 42, 1),
(1470, 23, '', '20250521080446_Gusset__Stiffener_Master_CAD_Drawing.dwg', '2025-06-16 10:25:39', '5764.96', 'AutoCAD File', 'https://achivon.app/dr_files/20250521080446_Gusset__Stiffener_Master_CAD_Drawing.dwg', '', 'sd_ho_lv6', 48, 1),
(1471, 23, '', '20250521080527_Gusset__Stiffener_Master_CAD_Drawing.dwg', '2025-06-16 10:25:39', '5764.96', 'AutoCAD File', 'https://achivon.app/dr_files/20250521080527_Gusset__Stiffener_Master_CAD_Drawing.dwg', '', 'sd_ho_lv6', 48, 1),
(1472, 23, '', '20250521081126_Base_Plate_Nesting_Plan_Drawing.pdf', '2025-05-21 08:11:26', '317.32', 'PDF Document', 'https://achivon.app/dr_files/20250521081126_Base_Plate_Nesting_Plan_Drawing.pdf', '', 'sd_ho_lv6', 49, 0),
(1473, 23, '', '20250521081214_Gusset_Nesting_Plan_Drawing.pdf', '2025-05-21 08:12:14', '915.78', 'PDF Document', 'https://achivon.app/dr_files/20250521081214_Gusset_Nesting_Plan_Drawing.pdf', '', 'sd_ho_lv6', 49, 0),
(1474, 23, '', '20250521081351_BASE_PLATE_DETAIL_DRAWING.pdf', '2025-05-21 08:13:51', '421.28', 'PDF Document', 'https://achivon.app/dr_files/20250521081351_BASE_PLATE_DETAIL_DRAWING.pdf', '', 'sd_ho_lv6', 49, 0),
(1475, 23, '', '20250521081400_GUSSET__STIFFENER_DETAIL_DRAWING.pdf', '2025-06-16 10:25:39', '380.31', 'PDF Document', 'https://achivon.app/dr_files/20250521081400_GUSSET__STIFFENER_DETAIL_DRAWING.pdf', '', 'sd_ho_lv6', 49, 1),
(1476, 23, '', '20250521085708_Gusset__Stiffener_Master_CAD_Drawing.dwg', '2025-06-16 10:25:39', '5740.45', 'AutoCAD File', 'https://achivon.app/dr_files/20250521085708_Gusset__Stiffener_Master_CAD_Drawing.dwg', '', 'sd_ho_lv6', 48, 0),
(1477, 23, '', '20250521085740_GUSSET__STIFFENER_DETAIL_DRAWING.pdf', '2025-06-16 10:25:39', '407.02', 'PDF Document', 'https://achivon.app/dr_files/20250521085740_GUSSET__STIFFENER_DETAIL_DRAWING.pdf', '', 'sd_ho_lv6', 49, 0),
(1478, 21, '', '20250610175702_JACKET_PIPE__FEEDER.rar', '2025-06-16 10:25:39', '4352.54', 'Other', 'https://achivon.app/dr_files/20250610175702_JACKET_PIPE__FEEDER.rar', '', 'sd_ho_lv4', 127, 0),
(1479, 21, '', '20250610175738_JACKET_PIPE__FEEDER.rar', '2025-06-16 10:25:39', '4352.54', 'Other', 'https://achivon.app/dr_files/20250610175738_JACKET_PIPE__FEEDER.rar', '', 'sd_ho_lv4', 127, 1),
(1480, 21, '', '20250610180101_COOLER__HEAT_EXCHANGER.rar', '2025-06-16 10:25:39', '28462.21', 'Other', 'https://achivon.app/dr_files/20250610180101_COOLER__HEAT_EXCHANGER.rar', '', 'sd_ho_lv4', 127, 0),
(1481, 21, '', '20250610180352_COOLER__HEAT_EXCHANGER.rar', '2025-06-16 10:25:39', '28462.21', 'Other', 'https://achivon.app/dr_files/20250610180352_COOLER__HEAT_EXCHANGER.rar', '', 'sd_ho_lv4', 127, 1),
(1482, 21, '', '20250610181251_PUMP.rar', '2025-06-10 18:12:51', '63307', 'Other', 'https://achivon.app/dr_files/20250610181251_PUMP.rar', '', 'sd_ho_lv4', 127, 0),
(1483, 21, '1. 42-226  Strong Chlorate Cooler', '20250613172430_42-226__Strong_Chlorate_Cooler.pdf', '2025-06-15 02:35:20', '101.56', 'PDF Document', 'https://achivon.app/dr_files/20250613172430_42-226__Strong_Chlorate_Cooler.pdf', '', 'sd_ho_lv4', 136, 1),
(1484, 21, '2. 42-236  Weak Chlorine Pump', '20250613172540_42-236__Weak_Chlorine_Pump.pdf', '2025-06-15 02:35:22', '290.04', 'PDF Document', 'https://achivon.app/dr_files/20250613172540_42-236__Weak_Chlorine_Pump.pdf', '', 'sd_ho_lv4', 136, 1),
(1485, 21, '', '20250615094845_Outstanding_Vendor_Print_(as_of_12-Jun-2025).xlsx', '2025-06-15 09:48:45', '18.22', 'Excel Document', 'https://achivon.app/dr_files/20250615094845_Outstanding_Vendor_Print_%28as_of_12-Jun-2025%29.xlsx', '', 'sd_ho_lv4', 136, 0),
(1486, 21, '', '20250615094845_Outstanding_Vendor_Print_(as_of_12-Jun-2025).xlsx', '2025-06-15 02:50:18', '18.22', 'Excel Document', 'https://achivon.app/dr_files/20250615094845_Outstanding_Vendor_Print_%28as_of_12-Jun-2025%29.xlsx', '', 'sd_ho_lv4', 136, 1);
INSERT INTO `dr_file` (`id`, `id_user`, `subject`, `name_file`, `upload_date`, `size`, `type_file`, `link`, `remark`, `table_name`, `id_table`, `is_aktiv`) VALUES
(1487, 21, '', '20250615094846_Outstanding_Vendor_Print_(as_of_12-Jun-2025).xlsx', '2025-06-15 02:50:21', '18.22', 'Excel Document', 'https://achivon.app/dr_files/20250615094846_Outstanding_Vendor_Print_%28as_of_12-Jun-2025%29.xlsx', '', 'sd_ho_lv4', 136, 1),
(1488, 21, '', '20250615094938_Equipment_PO_Status.xlsx', '2025-06-15 09:49:38', '123.01', 'Excel Document', 'https://achivon.app/dr_files/20250615094938_Equipment_PO_Status.xlsx', '', 'sd_ho_lv4', 127, 0),
(1489, 21, '', '20250615102032_Outstanding_Vendor_Print_as_of_12-Jun-2025_Part_1.rar', '2025-06-15 10:20:32', '32581.84', 'Other', 'https://achivon.app/dr_files/20250615102032_Outstanding_Vendor_Print_as_of_12-Jun-2025_Part_1.rar', '', 'sd_ho_lv4', 136, 0),
(1490, 21, '', '20250615102408_Outstanding_Vendor_Print_as_of_12-Jun-2025_Part_2.rar', '2025-06-15 10:24:08', '23510.79', 'Other', 'https://achivon.app/dr_files/20250615102408_Outstanding_Vendor_Print_as_of_12-Jun-2025_Part_2.rar', '', 'sd_ho_lv4', 136, 0),
(1491, 21, '', '20250615102449_Outstanding_Vendor_Print_as_of_12-Jun-2025_Part_3.rar', '2025-06-15 10:24:49', '4589.66', 'Other', 'https://achivon.app/dr_files/20250615102449_Outstanding_Vendor_Print_as_of_12-Jun-2025_Part_3.rar', '', 'sd_ho_lv4', 136, 0),
(1492, 21, '', '20250616073306_92C02400_-_Kiani_Kertas,_Mechanical_Equipment_Manual_Vol_4__centrifugal_and_other_pumps.pdf', '2025-06-16 07:33:06', '28259.51', 'PDF Document', 'https://achivon.app/dr_files/20250616073306_92C02400_-_Kiani_Kertas%2C_Mechanical_Equipment_Manual_Vol_4__centrifugal_and_other_pumps.pdf', '', 'sd_ho_lv4', 136, 0),
(1493, 21, '', '20250616075536_92C02400_-_Kiani_Kertas,_Mechanical_Equipment_Manual_Vol_5_15-Plate_and_Frame_HEAT_EXCHANGERS.pdf', '2025-06-16 07:55:36', '3166.75', 'PDF Document', 'https://achivon.app/dr_files/20250616075536_92C02400_-_Kiani_Kertas%2C_Mechanical_Equipment_Manual_Vol_5_15-Plate_and_Frame_HEAT_EXCHANGERS.pdf', '', 'sd_ho_lv4', 136, 0),
(1494, 21, '', '20250616122100_PO_25-O87401-PCZ90-03_(Bolt__Nuts)_PT._Cita_Baja_Jayaindo.pdf', '2025-06-16 09:59:25', '380.81', 'PDF Document', 'https://achivon.app/dr_files/20250616122100_PO_25-O87401-PCZ90-03_%28Bolt__Nuts%29_PT._Cita_Baja_Jayaindo.pdf', '', 'sd_ho_lv2', 154, 0),
(1495, 21, '', '20250616122255_PO_25-O87401-PCB10-01_(Structural_Beam)_PT._Berkat_Joan_Anugerah_R2.pdf', '2025-06-16 12:22:55', '267.41', 'PDF Document', 'https://achivon.app/dr_files/20250616122255_PO_25-O87401-PCB10-01_%28Structural_Beam%29_PT._Berkat_Joan_Anugerah_R2.pdf', '', 'sd_ho_lv2', 154, 0),
(1496, 21, '', '20250616122339_PO_25-O87401-PCB10-02_(Steel_Plate)_PT._BINTANG_BAJA_CEMERLANG.pdf', '2025-06-16 12:23:39', '266.74', 'PDF Document', 'https://achivon.app/dr_files/20250616122339_PO_25-O87401-PCB10-02_%28Steel_Plate%29_PT._BINTANG_BAJA_CEMERLANG.pdf', '', 'sd_ho_lv2', 154, 0),
(1497, 21, '', '20250616122359_PO_25-O87401-PCB10-03_(Steel_Plate)_PT._BINTANG_BAJA_CEMERLANG.pdf', '2025-06-16 12:23:59', '266.28', 'PDF Document', 'https://achivon.app/dr_files/20250616122359_PO_25-O87401-PCB10-03_%28Steel_Plate%29_PT._BINTANG_BAJA_CEMERLANG.pdf', '', 'sd_ho_lv2', 154, 0),
(1498, 21, '', '20250616122443_PO_25-O87401-PPT10-01_DO-001_(Sand_Silica_-_CV_Raya_Partlindo_Jaya)_-_R1.pdf', '2025-06-16 12:24:43', '816.39', 'PDF Document', 'https://achivon.app/dr_files/20250616122443_PO_25-O87401-PPT10-01_DO-001_%28Sand_Silica_-_CV_Raya_Partlindo_Jaya%29_-_R1.pdf', '', 'sd_ho_lv2', 154, 0),
(1499, 21, '', '20250616122548_PO_25-O87401-PRI20-01_(Welding_Rod)_PT_Allalloy_Cahaya_Dynaweld.pdf', '2025-06-16 12:25:48', '254.49', 'PDF Document', 'https://achivon.app/dr_files/20250616122548_PO_25-O87401-PRI20-01_%28Welding_Rod%29_PT_Allalloy_Cahaya_Dynaweld.pdf', '', 'sd_ho_lv2', 154, 0),
(1500, 21, '', '20250616122642_PO_25-O87401-PRI20-02_(Welding_Rod)_PT_Allalloy_Cahaya_Dynaweld.pdf', '2025-06-16 12:26:42', '258.26', 'PDF Document', 'https://achivon.app/dr_files/20250616122642_PO_25-O87401-PRI20-02_%28Welding_Rod%29_PT_Allalloy_Cahaya_Dynaweld.pdf', '', 'sd_ho_lv2', 154, 0),
(1501, 21, '', '20250616122716_PO_25-O87401-PKT90-06_(Transportation)_PT_BIG.pdf', '2025-06-16 12:27:16', '251.1', 'PDF Document', 'https://achivon.app/dr_files/20250616122716_PO_25-O87401-PKT90-06_%28Transportation%29_PT_BIG.pdf', '', 'sd_ho_lv2', 154, 0),
(1502, 21, '', '20250616123052_PO_25-O87401-PCZ90-01_(Sika_Products)_CV_Cahaya_Anugerah_Sejahtera.pdf', '2025-06-16 12:30:52', '379.98', 'PDF Document', 'https://achivon.app/dr_files/20250616123052_PO_25-O87401-PCZ90-01_%28Sika_Products%29_CV_Cahaya_Anugerah_Sejahtera.pdf', '', 'sd_ho_lv2', 154, 0),
(1503, 21, '', '20250616123119_PO_25-O87401-PCZ90-04_(Sika_Products)_CV_Cahaya_Anugerah_Sejahtera.pdf', '2025-06-16 12:31:19', '313.01', 'PDF Document', 'https://achivon.app/dr_files/20250616123119_PO_25-O87401-PCZ90-04_%28Sika_Products%29_CV_Cahaya_Anugerah_Sejahtera.pdf', '', 'sd_ho_lv2', 154, 0),
(1504, 21, '', '20250616123208_PO_25-O87401-PCZ40-01_(Reinforcing_Bar)_CV_Prasetya_Utama.pdf', '2025-06-16 12:32:08', '254.75', 'PDF Document', 'https://achivon.app/dr_files/20250616123208_PO_25-O87401-PCZ40-01_%28Reinforcing_Bar%29_CV_Prasetya_Utama.pdf', '', 'sd_ho_lv2', 154, 0),
(1505, 21, '', '20250616123228_PO_25-O87401-PCZ40-04_(Reinforcing_Bar)_CV_Prasetya_Utama.pdf', '2025-06-16 12:32:28', '254.2', 'PDF Document', 'https://achivon.app/dr_files/20250616123228_PO_25-O87401-PCZ40-04_%28Reinforcing_Bar%29_CV_Prasetya_Utama.pdf', '', 'sd_ho_lv2', 154, 0),
(1506, 21, '', '20250616123251_PO_25-O87401-PCZ90-02_(PLYWOOD_-_2_SIDE_FILM_COATED)_CV_Prasetya_Utama.pdf', '2025-06-16 12:32:51', '314.2', 'PDF Document', 'https://achivon.app/dr_files/20250616123251_PO_25-O87401-PCZ90-02_%28PLYWOOD_-_2_SIDE_FILM_COATED%29_CV_Prasetya_Utama.pdf', '', 'sd_ho_lv2', 154, 0),
(1507, 21, '', '20250616123725_PO_25-O87401-PCA30-01_DO-004_(Readymix_Concrete)_PT_Berau_Nuansa_Beton.pdf', '2025-06-16 12:37:25', '815', 'PDF Document', 'https://achivon.app/dr_files/20250616123725_PO_25-O87401-PCA30-01_DO-004_%28Readymix_Concrete%29_PT_Berau_Nuansa_Beton.pdf', '', 'sd_ho_lv2', 154, 0),
(1508, 21, '', '20250616123747_PO_25-O87401-PCA30-01_DO-005_(Readymix_Concrete)_PT_Berau_Nuansa_Beton.pdf', '2025-06-16 12:37:47', '814.97', 'PDF Document', 'https://achivon.app/dr_files/20250616123747_PO_25-O87401-PCA30-01_DO-005_%28Readymix_Concrete%29_PT_Berau_Nuansa_Beton.pdf', '', 'sd_ho_lv2', 154, 0),
(1509, 21, '', '20250616123807_PO_25-O87401-PCA30-01_DO-006_(Readymix_Concrete)_PT_Berau_Nuansa_Beton.pdf', '2025-06-16 12:38:07', '815.26', 'PDF Document', 'https://achivon.app/dr_files/20250616123807_PO_25-O87401-PCA30-01_DO-006_%28Readymix_Concrete%29_PT_Berau_Nuansa_Beton.pdf', '', 'sd_ho_lv2', 154, 0),
(1510, 21, '', '20250616123830_PO_25-O87401-PCA30-01_DO-007_(Readymix_Concrete)_PT_Berau_Nuansa_Beton.pdf', '2025-06-16 12:38:30', '815.12', 'PDF Document', 'https://achivon.app/dr_files/20250616123830_PO_25-O87401-PCA30-01_DO-007_%28Readymix_Concrete%29_PT_Berau_Nuansa_Beton.pdf', '', 'sd_ho_lv2', 154, 0),
(1511, 21, '', '20250616123949_PO_25-O87401-POW61-03_(Scaffolding_Materials__Accessories)_PT_Lineone_Indonesia.pdf', '2025-06-16 10:25:39', '207.13', 'PDF Document', 'https://achivon.app/dr_files/20250616123949_PO_25-O87401-POW61-03_%28Scaffolding_Materials__Accessories%29_PT_Lineone_Indonesia.pdf', '', 'sd_ho_lv2', 154, 0),
(1512, 21, '', '20250616124017_PO_25-O87401-POW61-04_(2nd_PO_Scaffolding_Clamps)_PT_Morlin_Satya_Bhakti.pdf', '2025-06-16 12:40:17', '194.86', 'PDF Document', 'https://achivon.app/dr_files/20250616124017_PO_25-O87401-POW61-04_%282nd_PO_Scaffolding_Clamps%29_PT_Morlin_Satya_Bhakti.pdf', '', 'sd_ho_lv2', 154, 0),
(1513, 21, '', '20250616124040_PO_25-O87401-POW61-05_(3rd_PO_for_Scaffolding_Clamps)_PT_Morlin_Satya_Bhakti-.pdf', '2025-06-16 12:40:40', '545.13', 'PDF Document', 'https://achivon.app/dr_files/20250616124040_PO_25-O87401-POW61-05_%283rd_PO_for_Scaffolding_Clamps%29_PT_Morlin_Satya_Bhakti-.pdf', '', 'sd_ho_lv2', 154, 0),
(1514, 21, '', '20250616150909_PO_25-O87401-PCB10-01_(Structural_Beam)_PT._Berkat_Joan_Anugerah_R2.rar', '2025-06-16 15:09:09', '1074.54', 'Other', 'https://achivon.app/dr_files/20250616150909_PO_25-O87401-PCB10-01_%28Structural_Beam%29_PT._Berkat_Joan_Anugerah_R2.rar', '', 'sd_ho_lv2', 154, 0),
(1515, 21, '', '20250616150937_PO_25-O87401-PCB10-02_(Steel_Plate)_PT._BINTANG_BAJA_CEMERLANG.rar', '2025-06-16 15:09:37', '503.79', 'Other', 'https://achivon.app/dr_files/20250616150937_PO_25-O87401-PCB10-02_%28Steel_Plate%29_PT._BINTANG_BAJA_CEMERLANG.rar', '', 'sd_ho_lv2', 154, 0),
(1516, 21, '', '20250616151006_PO_25-O87401-PCB10-03_(Steel_Plate)_PT._BINTANG_BAJA_CEMERLANG.rar', '2025-06-16 15:10:06', '503', 'Other', 'https://achivon.app/dr_files/20250616151006_PO_25-O87401-PCB10-03_%28Steel_Plate%29_PT._BINTANG_BAJA_CEMERLANG.rar', '', 'sd_ho_lv2', 154, 0),
(1517, 21, '', '20250616151156_PO_25-O87401-PCZ90-03_(Bolt__Nuts)_PT._Cita_Baja_Jayaindo.rar', '2025-06-16 10:25:39', '1079.45', 'Other', 'https://achivon.app/dr_files/20250616151156_PO_25-O87401-PCZ90-03_%28Bolt__Nuts%29_PT._Cita_Baja_Jayaindo.rar', '', 'sd_ho_lv2', 154, 1),
(1518, 20, '', '20250616152352_PO_25-O87401-PPT00-01_(Paint_-RAL_6011-_Steel_Structure)_PT._CKP_Abadi_Indonesia.pdf', '2025-06-16 15:23:52', '298.04', 'PDF Document', 'https://achivon.app/dr_files/20250616152352_PO_25-O87401-PPT00-01_%28Paint_-RAL_6011-_Steel_Structure%29_PT._CKP_Abadi_Indonesia.pdf', '', 'sd_ho_lv2', 154, 0),
(1519, 20, '', '20250616152359_PO_25-O87401-PPT00-01_(Paint_-RAL_6011-_Steel_Structure)_PT._CKP_Abadi_Indonesia.pdf', '2025-06-16 15:23:59', '298.04', 'PDF Document', 'https://achivon.app/dr_files/20250616152359_PO_25-O87401-PPT00-01_%28Paint_-RAL_6011-_Steel_Structure%29_PT._CKP_Abadi_Indonesia.pdf', '', 'sd_ho_lv2', 154, 0),
(1520, 21, 'Original MS word P.O', '20250616152535_MS_word_P.O_(Upload_cloud_20250616).rar', '2025-06-16 15:25:35', '9730.6', 'Other', 'https://achivon.app/dr_files/20250616152535_MS_word_P.O_%28Upload_cloud_20250616%29.rar', '', 'sd_ho_lv2', 154, 0),
(1521, 21, '', '20250616152610_PO_25-O87401-PRI00-01_(Bio_Diesel_Industry)_PT_Persona_Berau_Mandiri.pdf', '2025-06-16 15:26:10', '301.19', 'PDF Document', 'https://achivon.app/dr_files/20250616152610_PO_25-O87401-PRI00-01_%28Bio_Diesel_Industry%29_PT_Persona_Berau_Mandiri.pdf', '', 'sd_ho_lv2', 154, 0),
(1522, 21, '', '20250616152705_PO_25-O87401-PRI00-02_(Bio_Diesel_Industry)_PT_Persona_Berau_Mandiri.docx', '2025-06-16 08:27:23', '423.5', 'Word Document', 'https://achivon.app/dr_files/20250616152705_PO_25-O87401-PRI00-02_%28Bio_Diesel_Industry%29_PT_Persona_Berau_Mandiri.docx', '', 'sd_ho_lv2', 154, 1),
(1523, 21, '', '20250616152732_PO_25-O87401-PRI00-02_(Bio_Diesel_Industry)_PT_Persona_Berau_Mandiri.pdf', '2025-06-16 15:27:32', '302.93', 'PDF Document', 'https://achivon.app/dr_files/20250616152732_PO_25-O87401-PRI00-02_%28Bio_Diesel_Industry%29_PT_Persona_Berau_Mandiri.pdf', '', 'sd_ho_lv2', 154, 0),
(1524, 21, '', '20250616155202_PO_25-O87401-PCZ90-03_(Bolt__Nuts)_PT._Cita_Baja_Jayaindo.rar', '2025-06-16 10:25:39', '1079.45', 'Other', 'https://achivon.app/dr_files/20250616155202_PO_25-O87401-PCZ90-03_%28Bolt__Nuts%29_PT._Cita_Baja_Jayaindo.rar', '', 'sd_ho_lv2', 154, 1),
(1525, 21, '', '20250616155331_PO_25-O87401-PCZ90-03_(Bolt__Nuts)_PT._Cita_Baja_Jayaindo.rar', '2025-06-16 10:25:39', '764.65', 'Other', 'https://achivon.app/dr_files/20250616155331_PO_25-O87401-PCZ90-03_%28Bolt__Nuts%29_PT._Cita_Baja_Jayaindo.rar', '', 'sd_ho_lv2', 154, 1),
(1526, 21, '', '20250616155531_PO_25-O87401-PCZ90-03_Bolt_and_Nuts_PT._Cita_Baja_Jayaindo.rar', '2025-06-16 09:17:56', '1079.44', 'Other', 'https://achivon.app/dr_files/20250616155531_PO_25-O87401-PCZ90-03_Bolt_%26_Nuts_PT._Cita_Baja_Jayaindo.rar', '', 'sd_ho_lv2', 154, 1),
(1527, 14, '', '20250616161839_PO_25-O87401-PCZ90-03_Bolt_and_Nuts_PT._Cita_Baja_Jayaindo.rar', '2025-06-16 09:23:23', '1079.44', 'Other', 'https://achivon.app/dr_files/20250616161839_PO_25-O87401-PCZ90-03_Bolt_and_Nuts_PT._Cita_Baja_Jayaindo.rar', '', 'sd_ho_lv2', 154, 1),
(1528, 14, '', '20250616161855_PO_25-O87401-PCZ90-03_Bolt_and_Nuts_PT._Cita_Baja_Jayaindo.rar', '2025-06-16 09:19:09', '1079.44', 'Other', 'https://achivon.app/dr_files/20250616161855_PO_25-O87401-PCZ90-03_Bolt_and_Nuts_PT._Cita_Baja_Jayaindo.rar', '', 'sd_ho_lv2', 154, 1),
(1529, 14, '', '20250616162337_PO_25-O87401-PCZ90-03_Bolt_and_Nuts_PT._Cita_Baja_Jayaindo.rar', '2025-06-16 16:23:37', '1079.44', 'Other', 'https://achivon.app/dr_files/20250616162337_PO_25-O87401-PCZ90-03_Bolt_and_Nuts_PT._Cita_Baja_Jayaindo.rar', '', 'sd_ho_lv2', 154, 0),
(1530, 14, '', '20250616181546_Finger_&_Manpower_Status_12Juni2025.xlsx', '2025-06-16 11:15:59', '1384.21', '', 'https://achivon.app/dr_files/20250616181546_Finger_%26_Manpower_Status_12Juni2025.xlsx', '', 'sd_ho_lv1', 1, 1),
(1531, 14, '', '20250616182508_template.php', '2025-06-16 11:25:12', '6.42', 'Other', 'https://achivon.app/dr_files/20250616182508_template.php', '', 'sd_ho_lv1', 1, 1),
(1532, 14, '', '202506171540398045_INV-IDN-588916-47364-80.pdf', '2025-06-17 08:40:47', '29.65', 'PDF', 'https://achivon.app/dr_files/202506171540398045_INV-IDN-588916-47364-80.pdf', '', 'sd_ho_lv1', 5, 1),
(1533, 14, '', '202506171540392611_INV-PREVIEW-ACC-6458697-89576-45_(1).pdf', '2025-06-17 08:40:47', '28.95', 'PDF', 'https://achivon.app/dr_files/202506171540392611_INV-PREVIEW-ACC-6458697-89576-45_%281%29.pdf', '', 'sd_ho_lv1', 5, 1),
(1534, 20, '', '202506171754225705_1._PO_-_Pipes_I_(UNGGUL_PRAKARSA_PRISMA).xlsx', '2025-06-17 10:55:25', '14.79', 'Excel', 'https://achivon.app/dr_files/202506171754225705_1._PO_-_Pipes_I_%28UNGGUL_PRAKARSA_PRISMA%29.xlsx', '', 'sd_ho_lv2', 154, 1),
(1535, 20, '', '202506171754225852_1._Unpriced_PO_-_Pipes_I_(UNGGUL_PRAKARSA_PRISMA).xlsx', '2025-06-17 10:55:25', '14.47', 'Excel', 'https://achivon.app/dr_files/202506171754225852_1._Unpriced_PO_-_Pipes_I_%28UNGGUL_PRAKARSA_PRISMA%29.xlsx', '', 'sd_ho_lv2', 154, 1),
(1536, 20, '', '202506171754228839_PO_25-O87401-PPA00-01_(Pipes-I)_PT_UNGGUL_PRAKARSA_PRISMA.docx', '2025-06-17 10:55:25', '101.63', 'Word', 'https://achivon.app/dr_files/202506171754228839_PO_25-O87401-PPA00-01_%28Pipes-I%29_PT_UNGGUL_PRAKARSA_PRISMA.docx', '', 'sd_ho_lv2', 154, 1),
(1537, 20, '', '202506171754226470_PO_25-O87401-PPA00-01_(Pipes-I)_PT_UNGGUL_PRAKARSA_PRISMA.pdf', '2025-06-17 10:55:25', '225.51', 'PDF', 'https://achivon.app/dr_files/202506171754226470_PO_25-O87401-PPA00-01_%28Pipes-I%29_PT_UNGGUL_PRAKARSA_PRISMA.pdf', '', 'sd_ho_lv2', 154, 1),
(1538, 20, '', '202506171754225928_Unpriced_PO_25-O87401-PPA00-01_(Pipes-I)_PT_UNGGUL_PRAKARSA_PRISMA.docx', '2025-06-17 10:55:25', '100.39', 'Word', 'https://achivon.app/dr_files/202506171754225928_Unpriced_PO_25-O87401-PPA00-01_%28Pipes-I%29_PT_UNGGUL_PRAKARSA_PRISMA.docx', '', 'sd_ho_lv2', 154, 1),
(1539, 20, '', '202506171754226469_Unpriced_PO_25-O87401-PPA00-01_(Pipes-I)_PT_UNGGUL_PRAKARSA_PRISMA.pdf', '2025-06-17 10:55:25', '226.84', 'PDF', 'https://achivon.app/dr_files/202506171754226469_Unpriced_PO_25-O87401-PPA00-01_%28Pipes-I%29_PT_UNGGUL_PRAKARSA_PRISMA.pdf', '', 'sd_ho_lv2', 154, 1),
(1540, 20, '', '202506171758057988_Unpriced_PO_25-O87401-PPA00-01_(Pipes-I)_PT_UNGGUL_PRAKARSA_PRISMA.zip', '2025-06-17 17:58:05', '579.36', 'Other', 'https://achivon.app/dr_files/202506171758057988_Unpriced_PO_25-O87401-PPA00-01_%28Pipes-I%29_PT_UNGGUL_PRAKARSA_PRISMA.zip', '', 'sd_ho_lv2', 154, 0),
(1541, 20, '', '202506171758426870_Unpriced_PO_25-O87401-PPA00-02_(Pipes-II)_PT_ELNO_TECH_MUBARAC.zip', '2025-06-17 17:58:42', '628.81', 'Other', 'https://achivon.app/dr_files/202506171758426870_Unpriced_PO_25-O87401-PPA00-02_%28Pipes-II%29_PT_ELNO_TECH_MUBARAC.zip', '', 'sd_ho_lv2', 154, 0),
(1542, 20, '', '202506171759062689_Unpriced_PO_25-O87401-PPA00-03_(Pipes-III)_PT_BANGKIT_JAYA_SUPLINDO.zip', '2025-06-17 17:59:06', '625.63', 'Other', 'https://achivon.app/dr_files/202506171759062689_Unpriced_PO_25-O87401-PPA00-03_%28Pipes-III%29_PT_BANGKIT_JAYA_SUPLINDO.zip', '', 'sd_ho_lv2', 154, 0),
(1543, 20, '', '202506171759452423_Unpriced_PO_25-O87401-PPA00-04_(Pipes-IV)_PT._BINTANG_BAJA_CEMERLANG_-_Copy.zip', '2025-06-17 17:59:45', '592.88', 'Other', 'https://achivon.app/dr_files/202506171759452423_Unpriced_PO_25-O87401-PPA00-04_%28Pipes-IV%29_PT._BINTANG_BAJA_CEMERLANG_-_Copy.zip', '', 'sd_ho_lv2', 154, 0),
(1544, 20, '', '202506171800012140_Unpriced_PO_25-O87401-PPB00-01_(Fittings-I)_PT_BANGKIT_JAYA_SUPLINDO.zip', '2025-06-17 18:00:01', '652.88', 'Other', 'https://achivon.app/dr_files/202506171800012140_Unpriced_PO_25-O87401-PPB00-01_%28Fittings-I%29_PT_BANGKIT_JAYA_SUPLINDO.zip', '', 'sd_ho_lv2', 154, 0),
(1545, 20, '', '202506171800192349_Unpriced_PO_25-O87401-PPB00-02_(Fittings-II)_PT_ELNO_TECH_MUBARAC.zip', '2025-06-17 18:00:19', '1232.92', 'Other', 'https://achivon.app/dr_files/202506171800192349_Unpriced_PO_25-O87401-PPB00-02_%28Fittings-II%29_PT_ELNO_TECH_MUBARAC.zip', '', 'sd_ho_lv2', 154, 0),
(1546, 20, '', '202506171800363036_Unpriced_PO_25-O87401-PPC00-01_(Flanges-I)_PT._UNGGUL_PRAKARSA_PRISMA.zip', '2025-06-17 18:00:36', '969.19', 'Other', 'https://achivon.app/dr_files/202506171800363036_Unpriced_PO_25-O87401-PPC00-01_%28Flanges-I%29_PT._UNGGUL_PRAKARSA_PRISMA.zip', '', 'sd_ho_lv2', 154, 0),
(1547, 20, '', '202506171800494179_Unpriced_PO_25-O87401-PPC00-02_(Flanges-II)_PT_ELNO_TECH_MUBARAC.zip', '2025-06-17 18:00:49', '597.63', 'Other', 'https://achivon.app/dr_files/202506171800494179_Unpriced_PO_25-O87401-PPC00-02_%28Flanges-II%29_PT_ELNO_TECH_MUBARAC.zip', '', 'sd_ho_lv2', 154, 0),
(1548, 21, '', '20250617181418_PO_25-O87401-PCZ40-01_(Reinforcing_Bar)_CV_Prasetya_Utama-.rar', '2025-06-17 18:14:18', '3108.03', 'Other', 'https://achivon.app/dr_files/20250617181418_PO_25-O87401-PCZ40-01_%28Reinforcing_Bar%29_CV_Prasetya_Utama-.rar', '', 'sd_ho_lv2', 154, 0),
(1549, 21, '', '20250617181451_PO_25-O87401-PCZ40-04_(Reinforcing_Bar)_CV_Prasetya_Utama-.rar', '2025-06-17 18:14:51', '3106.47', 'Other', 'https://achivon.app/dr_files/20250617181451_PO_25-O87401-PCZ40-04_%28Reinforcing_Bar%29_CV_Prasetya_Utama-.rar', '', 'sd_ho_lv2', 154, 0),
(1550, 20, '', '20250618094130_ACV-KN-S-L-0005_Submission_of_1st_Progress_Invoice_(Chemical_Plant)-Signed_Stamped.pdf', '2025-06-18 09:41:30', '1012.74', 'PDF Document', 'https://achivon.app/dr_files/20250618094130_ACV-KN-S-L-0005_Submission_of_1st_Progress_Invoice_%28Chemical_Plant%29-Signed_Stamped.pdf', '', 'sd_ho_lv2', 48, 0),
(1551, 20, '', '20250618094337_ACV-KN-S-L-0006_Submission_of_2nd_Progress_Invoice_(Chemical_Plant)-Signed_Stamped.pdf', '2025-06-18 09:43:37', '89031.62', 'PDF Document', 'https://achivon.app/dr_files/20250618094337_ACV-KN-S-L-0006_Submission_of_2nd_Progress_Invoice_%28Chemical_Plant%29-Signed_Stamped.pdf', '', 'sd_ho_lv2', 48, 0),
(1552, 20, '', '202506231749022621_ACV-PTN-V-L-0001_Request_for_Proposal_(Plate_Type_Heat_Exchanger)_PT._Air_Surya_Radiator.docx', '2025-06-23 17:49:02', '509.08', 'Word', 'https://achivon.app/dr_files/202506231749022621_ACV-PTN-V-L-0001_Request_for_Proposal_%28Plate_Type_Heat_Exchanger%29_PT._Air_Surya_Radiator.docx', '', 'sd_ho_lv5', 120, 0),
(1553, 20, '', '202506231749021520_ACV-PTN-V-L-0001_Request_for_Proposal_(Plate_Type_Heat_Exchanger)_PT._Air_Surya_Radiator.pdf', '2025-06-23 17:49:02', '3605.24', 'PDF', 'https://achivon.app/dr_files/202506231749021520_ACV-PTN-V-L-0001_Request_for_Proposal_%28Plate_Type_Heat_Exchanger%29_PT._Air_Surya_Radiator.pdf', '', 'sd_ho_lv5', 120, 0),
(1554, 20, '', '202506231749029781_ACV-PTN-V-L-0001_Request_for_Proposal_(Plate_Type_Heat_Exchanger)_PT._Alfa_Laval_Indonesia.docx', '2025-06-23 17:49:02', '508.88', 'Word', 'https://achivon.app/dr_files/202506231749029781_ACV-PTN-V-L-0001_Request_for_Proposal_%28Plate_Type_Heat_Exchanger%29_PT._Alfa_Laval_Indonesia.docx', '', 'sd_ho_lv5', 120, 0),
(1555, 20, '', '202506231749022390_ACV-PTN-V-L-0001_Request_for_Proposal_(Plate_Type_Heat_Exchanger)_PT._Alfa_Laval_Indonesia.pdf', '2025-06-23 17:49:02', '3605.04', 'PDF', 'https://achivon.app/dr_files/202506231749022390_ACV-PTN-V-L-0001_Request_for_Proposal_%28Plate_Type_Heat_Exchanger%29_PT._Alfa_Laval_Indonesia.pdf', '', 'sd_ho_lv5', 120, 0),
(1556, 20, '', '202506231749024954_ACV-PTN-V-L-0001_Request_for_Proposal_(Plate_Type_Heat_Exchanger)_PT._Inti_Semesta_Sejahtera.docx', '2025-06-23 17:49:02', '508.91', 'Word', 'https://achivon.app/dr_files/202506231749024954_ACV-PTN-V-L-0001_Request_for_Proposal_%28Plate_Type_Heat_Exchanger%29_PT._Inti_Semesta_Sejahtera.docx', '', 'sd_ho_lv5', 120, 0),
(1557, 20, '', '202506231749028656_ACV-PTN-V-L-0001_Request_for_Proposal_(Plate_Type_Heat_Exchanger)_PT._Inti_Semesta_Sejahtera.pdf', '2025-06-23 17:49:02', '3605.63', 'PDF', 'https://achivon.app/dr_files/202506231749028656_ACV-PTN-V-L-0001_Request_for_Proposal_%28Plate_Type_Heat_Exchanger%29_PT._Inti_Semesta_Sejahtera.pdf', '', 'sd_ho_lv5', 120, 0),
(1558, 20, '', '202506231749025118_ACV-PTN-V-L-0001_Request_for_Proposal_(Plate_Type_Heat_Exchanger)_PT._Multi_Makmur_Teknikatama.docx', '2025-06-23 17:49:02', '509.05', 'Word', 'https://achivon.app/dr_files/202506231749025118_ACV-PTN-V-L-0001_Request_for_Proposal_%28Plate_Type_Heat_Exchanger%29_PT._Multi_Makmur_Teknikatama.docx', '', 'sd_ho_lv5', 120, 0),
(1559, 20, '', '202506231749027734_ACV-PTN-V-L-0001_Request_for_Proposal_(Plate_Type_Heat_Exchanger)_PT._Multi_Makmur_Teknikatama.pdf', '2025-06-23 17:49:02', '3605.69', 'PDF', 'https://achivon.app/dr_files/202506231749027734_ACV-PTN-V-L-0001_Request_for_Proposal_%28Plate_Type_Heat_Exchanger%29_PT._Multi_Makmur_Teknikatama.pdf', '', 'sd_ho_lv5', 120, 0),
(1560, 20, '', '202506231751365846_Form_-_CBS_Spare_Parts_(Plate_Type_Heat_Exchanger).xlsx', '2025-06-23 17:51:36', '16.95', 'Excel', 'https://achivon.app/dr_files/202506231751365846_Form_-_CBS_Spare_Parts_%28Plate_Type_Heat_Exchanger%29.xlsx', '', 'sd_ho_lv5', 120, 0),
(1561, 21, '', '202506241019177208_PT_Line_One_Ringlock_Quotation_for_PT_Achivon_(20250421).pdf', '2025-06-24 10:19:17', '432.68', 'PDF', 'https://achivon.app/dr_files/202506241019177208_PT_Line_One_Ringlock_Quotation_for_PT_Achivon_%2820250421%29.pdf', '', 'sd_ho_lv5', 121, 0),
(1562, 21, '', '202506241019173660_PT_Line_One_Ringlock_Quotation_for_PT_Achivon_(20250609).pdf', '2025-06-24 10:19:17', '169.01', 'PDF', 'https://achivon.app/dr_files/202506241019173660_PT_Line_One_Ringlock_Quotation_for_PT_Achivon_%2820250609%29.pdf', '', 'sd_ho_lv5', 121, 0),
(1563, 21, '', '20250624101938_PT.Morlin_Ringlock_QUOT,MSB-ACHIVON3.pdf', '2025-06-24 10:19:38', '199.62', 'PDF Document', 'https://achivon.app/dr_files/20250624101938_PT.Morlin_Ringlock_QUOT%2CMSB-ACHIVON3.pdf', '', 'sd_ho_lv5', 122, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `file_shared`
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
-- Dumping data untuk tabel `file_shared`
--

INSERT INTO `file_shared` (`id`, `level1`, `Description`, `name_file`, `upload_date`, `size`, `type_file`, `link`, `remark`) VALUES
(50, 'Steel Structure', 'Scanned PDF file - KN Office', '1. Drawing roofing KN (scanned).zip', '2024-12-21 11:06:22', '59.07 MB', 'Other', 'https://achivon.app/fileshared/1._Drawing_roofing_KN_(scanned).zip', ''),
(51, 'Steel Structure', 'Photo', '2. Photo roofing KN.zip', '2024-12-21 11:10:01', '35.70 MB', 'Other', 'https://achivon.app/fileshared/2._Photo_roofing_KN.zip', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `params`
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
-- Dumping data untuk tabel `params`
--

INSERT INTO `params` (`id`, `param_name`, `param_group`, `status`, `remark`, `created_at`, `updated_at`, `is_deleted`, `delete_at`) VALUES
(16, 'TCS', 'category', '', 'Tools Control System', '2024-09-10 04:19:29', '2024-09-19 02:36:25', NULL, NULL),
(17, 'CCS', 'category', '', 'Consumable Control System', '2024-09-10 04:19:42', '2024-09-19 02:36:38', NULL, NULL),
(18, 'EA', 'inisial_kuantitas', '', '', '2024-09-10 06:49:06', '2024-09-10 06:49:06', NULL, NULL),
(19, 'Meter', 'inisial_kuantitas', '', '', '2024-09-10 06:49:23', '2024-09-10 06:49:23', NULL, NULL),
(31, 'Warehouse', 'distribution_value', '', 'wh_warehouse', '2024-09-18 01:39:06', '2024-09-18 01:39:06', NULL, NULL),
(32, 'Employee', 'distribution_value', '', 'tbl_user', '2024-09-18 01:39:33', '2024-09-18 01:39:33', NULL, NULL),
(33, 'Supplier', 'distribution_value', '', 'tbl_suplayer', '2024-09-18 01:40:05', '2024-09-23 09:14:24', NULL, NULL),
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
-- Struktur dari tabel `procurement_po`
--

CREATE TABLE `procurement_po` (
  `id` int(30) NOT NULL,
  `po_number` int(255) NOT NULL,
  `Supplier_id` int(30) NOT NULL,
  `po_date` date NOT NULL,
  `expeted_date` date NOT NULL,
  `total_amount` int(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sd_ho_lv1`
--

CREATE TABLE `sd_ho_lv1` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `depart` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sd_ho_lv1`
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
-- Struktur dari tabel `sd_ho_lv2`
--

CREATE TABLE `sd_ho_lv2` (
  `id` int(255) NOT NULL,
  `lv1_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sd_ho_lv2`
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
(71, 11, 'G01-RFQ or RFP', ''),
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
(148, 29, 'H1301-Tools & Devices', ''),
(151, 10, 'F14-Engineering Document', NULL),
(152, 10, 'F15-Others', NULL),
(153, 7, 'C04-RESUME & CV', NULL),
(154, 11, 'G02-PO', NULL),
(156, 12, 'H18-Warehouse Request & Return Status', NULL),
(157, 12, 'H19- Equipment Fuel Record', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sd_ho_lv3`
--

CREATE TABLE `sd_ho_lv3` (
  `id` int(255) NOT NULL,
  `lv2_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sd_ho_lv3`
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
(243, 128, 'H0502C-Monthly', ''),
(245, 60, 'Summary', NULL),
(246, 58, 'Summary', NULL),
(247, 63, 'Summary', NULL),
(248, 54, 'E0908-with MS CNP', NULL),
(249, 156, '1. Request / Meminta', NULL),
(251, 156, '2. Return / Kembali', NULL),
(252, 157, '1. March 2025', NULL),
(253, 157, '2. April 2025', NULL),
(254, 157, '3. May 2025', NULL),
(255, 73, '1. Delivery from Jakarta', NULL),
(256, 153, '1. Indirect Staff', NULL),
(257, 153, '2. Indirect Labor', NULL),
(258, 153, '3. Direct Manpower', NULL),
(259, 9, 'B0102-Daily', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sd_ho_lv4`
--

CREATE TABLE `sd_ho_lv4` (
  `id` int(255) NOT NULL,
  `lv3_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sd_ho_lv4`
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
(84, 200, 'H0502C-Monthly', ''),
(86, 114, 'CAD File', NULL),
(87, 114, 'PDF File', NULL),
(88, 124, '1. CAD', NULL),
(89, 112, '1. Dassan Foundation Calculation', NULL),
(90, 122, '1. Dassan Beam Conversion', NULL),
(91, 124, '2. PDF', NULL),
(92, 141, '1. P&ID', NULL),
(93, 141, '2.ISOMETRIC', NULL),
(94, 108, 'Z921S-CNDC-KN-TR0006 2025.3.17', NULL),
(95, 107, 'Z921S-CNDC-KN-TR0005 2025.2.21', NULL),
(96, 109, 'Z921S-CNDC-KN-TR0005 2025.2.21', NULL),
(97, 141, '3. P&ID_Area 41', NULL),
(98, 141, '4. ISOMETRIC_Area 41', NULL),
(99, 108, '20250221', NULL),
(100, 108, '20250305', NULL),
(101, 172, '1. Blasting Equipment', NULL),
(102, 173, '1. Welding Rod', NULL),
(103, 256, '1. Material Control', NULL),
(104, 256, '2. Spool Control', NULL),
(105, 256, '3. Electrician', NULL),
(106, 258, '1. Fitter 1', NULL),
(107, 258, '2. Fitter 2', NULL),
(108, 258, '3. Welder Piping CS', NULL),
(109, 258, '4. Welder Piping Stainless Steel', NULL),
(110, 258, '5. Rigger', NULL),
(111, 258, '6. Scaffolder 1', NULL),
(112, 258, '7. Scaffolder 2', NULL),
(113, 258, '8. Blaster', NULL),
(114, 258, '9. Painter', NULL),
(115, 176, '1. WPS / PQR', NULL),
(116, 257, '1. Forklift Operator', NULL),
(118, 257, '2. Operator Computer Gudang', NULL),
(119, 256, '4. Accounting', NULL),
(120, 256, '5. Safety', NULL),
(121, 134, '1. Soot Blower', NULL),
(122, 124, '3. NESTING & CUTTING PLAN', NULL),
(127, 135, '1. Datasheet of pump, heat exchanger, cooler, loader', NULL),
(136, 135, '2. Outstanding Vendor Print _as of 12-Jun-2025', NULL),
(138, 174, '1. Modular Scaffolding_Ringlock', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sd_ho_lv5`
--

CREATE TABLE `sd_ho_lv5` (
  `id` int(255) NOT NULL,
  `lv4_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sd_ho_lv5`
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
(62, 51, 'E1008B3-SNS & Others', ''),
(64, 86, '1. General Area', NULL),
(66, 86, '2. CLO2 Plant', NULL),
(67, 86, '3. Chiller & CLO2 Storage', NULL),
(68, 86, '4. ASP Area', NULL),
(69, 88, '1. General Area', NULL),
(70, 88, '2. CLO2 Plant', NULL),
(71, 88, '3. Chiller & CLO2 Storage', NULL),
(72, 88, '4. ASP Area', NULL),
(73, 86, '5. Caustic Area', NULL),
(74, 86, '6. Control Building', NULL),
(75, 86, '7. Brine Treatment & Salt Storage', NULL),
(76, 86, '8. Chloralkali', NULL),
(77, 88, '5. Caustic Area', NULL),
(78, 88, '6. Control Building', NULL),
(79, 88, '7. Brine Treatment & Salt Storage', NULL),
(80, 86, '9. Liquid Chlorine Area', NULL),
(81, 88, '8. Chloralkali', NULL),
(82, 92, '1. CNDC', NULL),
(83, 92, '2. ACV', NULL),
(84, 88, '9. Liquid Chlorine ', NULL),
(85, 93, '1. KERTAS NUSANTARA', NULL),
(86, 93, '2. From CNDC', NULL),
(87, 93, '3. Achivon', NULL),
(91, 54, 'Roof & Cladding', NULL),
(92, 54, 'Grating', NULL),
(93, 54, 'H-Beam & Plate', NULL),
(94, 54, 'Anchor Bolt, Bolt & Nuts', NULL),
(95, 94, '1. PDF', NULL),
(96, 94, '2. CAD', NULL),
(97, 95, '1. PDF', NULL),
(98, 96, '1. PDF', NULL),
(99, 92, '3. Correspondence of P&ID CNDC / KN', NULL),
(100, 101, '1. PT Kharisma Uli Mandiri', NULL),
(101, 101, '2. PT Adika Karya Makmur', NULL),
(102, 102, '1. RFQ / Comparison', NULL),
(103, 102, '2. Quotation', NULL),
(105, 106, '1. 20250408', NULL),
(106, 107, '1. 20250408', NULL),
(107, 108, '1. 20250408', NULL),
(108, 109, '1. 20250408', NULL),
(109, 110, '1. 20250408', NULL),
(110, 111, '1. 20250408', NULL),
(111, 113, '1. 20250408', NULL),
(112, 114, '1. 20250408', NULL),
(113, 115, '1. RFQ', NULL),
(114, 121, '1. List', NULL),
(115, 121, '2. Photo & Drawing', NULL),
(116, 62, '1. Price Comparison', NULL),
(117, 62, '2. Quotation', NULL),
(119, 122, 'Gusset & Stiffener', NULL),
(120, 56, 'Plate Type Cooler & H-Ex', NULL),
(121, 138, '1. PT. Line One', NULL),
(122, 138, '2. PT. Morlin Satya Bhakti', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sd_ho_lv6`
--

CREATE TABLE `sd_ho_lv6` (
  `id` int(255) NOT NULL,
  `lv5_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sd_ho_lv6`
--

INSERT INTO `sd_ho_lv6` (`id`, `lv5_id`, `name`, `link`) VALUES
(2, 83, '1. CAD File', NULL),
(3, 82, '1. CAD Drawing', NULL),
(4, 83, '2. PDF DILE', NULL),
(5, 83, '2. PDF FILE', NULL),
(6, 82, '2. PDF', NULL),
(7, 85, '1. Scan pdf', NULL),
(8, 86, '1. CAD File', NULL),
(10, 87, 'File Folder A', NULL),
(11, 91, ' CV_ SAMUDERA JAYA ABADI', NULL),
(12, 91, 'Pt Artokaya Indonesia', NULL),
(13, 91, 'PT Yane', NULL),
(14, 92, 'Karlita Emas', NULL),
(15, 92, 'Pt Asgaraya Perkasa Utama', NULL),
(17, 94, 'PT Kairos Multi Sejahtera', NULL),
(18, 94, 'PT Cita Baja Jayaindo', NULL),
(19, 93, 'PT Smartindo Garuda Karya', NULL),
(20, 93, 'PT Bintang Baja Cemerlang', NULL),
(21, 93, 'Mr Park JS', NULL),
(23, 99, '1. 20241125_P&ID Color Marking CNDC/Chemetics', NULL),
(24, 99, '2. 20241128_P&ID Color Marking CNDC/Chemetics -Updated', NULL),
(25, 99, '3. 20241130_P&ID Color Marking CNDC/Chemetics -Updated', NULL),
(26, 99, '4. 20250214_P&ID Color Marking CNDC', NULL),
(29, 99, '5. 20250221_KN feedback to CNDC P&ID dated 14 Feb 25', NULL),
(30, 99, '6. 20250228_CNDC Reply Comment KN dated 21 Feb 25', NULL),
(31, 99, '7. 20250306_KN feedback to CNDC comment dated 28 Feb 25', NULL),
(32, 99, '8. 20250314_CNDC Reply Comment KN dated 06 Mar 25', NULL),
(33, 99, '9. 20250317_CNDC update P&ID', NULL),
(35, 99, '10. 20250405_KN feedback to CNDC P&ID dated 17 Mar 25', NULL),
(36, 103, '1. PT. Alfa Metalindo Indonesia / Jimmy', NULL),
(37, 103, 'PT. Allaloy Cahaya Dynaweld / Budi', NULL),
(38, 103, '3. PT. Tun Sejahtera Teknik / Ibu Nur', NULL),
(39, 103, '4. PT. Panca Karya Utama Indonesia / Ibu Djuti', NULL),
(40, 113, '1. List of WPS_Draft', NULL),
(41, 113, '2. Quotation', NULL),
(42, 117, '1. PPG', NULL),
(43, 117, '2. International / AkzoNobel', NULL),
(44, 117, '3. Jotun', NULL),
(45, 117, '4. KCC', NULL),
(46, 117, '5. Hempel', NULL),
(47, 117, '6. Chugoku', NULL),
(48, 119, 'CAD File', NULL),
(49, 119, 'PDF File', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sd_ho_lv7`
--

CREATE TABLE `sd_ho_lv7` (
  `id` int(255) NOT NULL,
  `lv6_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sd_ho_lv7`
--

INSERT INTO `sd_ho_lv7` (`id`, `lv6_id`, `name`, `link`) VALUES
(2, 8, '1. Line AA', NULL),
(3, 8, '2. Line AC', NULL),
(4, 8, '3. Line AI', NULL),
(5, 8, '4. Line BR', NULL),
(6, 8, '5. Line CA', NULL),
(7, 8, '6. Line CAS', NULL),
(8, 8, '7. Line CCC', NULL),
(9, 8, '8. Line CGD', NULL),
(10, 11, 'Quotation 27 Mar 2025', NULL),
(11, 12, 'Quotation 27 Mar 2025', NULL),
(12, 13, 'Quotation 27 Mar 2025', NULL),
(13, 14, 'Quotation 17 Mar 2025', NULL),
(14, 15, 'Quotation 17 Mar 2025', NULL),
(15, 17, 'Quotation 28 Feb 2025', NULL),
(16, 18, 'Quotation 25 Feb 2025', NULL),
(17, 19, 'Quotation 24 Feb 2025', NULL),
(18, 20, 'Quotation 24 Mar 2025', NULL),
(19, 21, 'Quotation 25 Feb 2025', NULL),
(20, 8, '9. CGW', NULL),
(21, 8, '10. Line CJ', NULL),
(22, 41, '1. PT. Allpro', NULL),
(23, 41, '2. PT. ISTEK', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sd_ho_lv8`
--

CREATE TABLE `sd_ho_lv8` (
  `id` int(255) NOT NULL,
  `lv7_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sd_ho_lv9`
--

CREATE TABLE `sd_ho_lv9` (
  `id` int(255) NOT NULL,
  `lv8_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sd_ho_lv10`
--

CREATE TABLE `sd_ho_lv10` (
  `id` int(255) NOT NULL,
  `lv9_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_barang`
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
-- Dumping data untuk tabel `tbl_barang`
--

INSERT INTO `tbl_barang` (`_id`, `kode_barang`, `nama_barang`, `harga_barang`, `stok`, `created_at`) VALUES
(1, 'P-001', 'Panci Ajaib', 700000, 80, '2021-02-14 04:18:50'),
(2, 'P-002', 'Panci Kurang Ajaib Tapi Boong', 1000000, 128, '2021-01-28 15:41:06'),
(3, 'P-003', 'Panci Anti Perang', 1500000, 149, '2021-02-13 14:41:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_barang_masuk`
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
-- Dumping data untuk tabel `tbl_barang_masuk`
--

INSERT INTO `tbl_barang_masuk` (`_id`, `kode_faktur`, `id_barang`, `jumlah`, `tgl_masuk`, `created_at`) VALUES
(24, 'm-001', 1, 50, '2021-01-20', '2021-01-20 15:53:53'),
(25, 'M-002', 3, 50, '2021-02-13', '2021-02-13 14:41:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_catatan`
--

CREATE TABLE `tbl_catatan` (
  `_id` int(11) NOT NULL,
  `id_penjualan` int(11) NOT NULL,
  `catatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tbl_catatan`
--

INSERT INTO `tbl_catatan` (`_id`, `id_penjualan`, `catatan`) VALUES
(1, 1, 'test'),
(2, 1, 'dfgdkfghdlfgh');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_levels`
--

CREATE TABLE `tbl_levels` (
  `_id` int(11) NOT NULL,
  `id_posisi` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
(192, 15, 77),
(193, 5, 77),
(194, 5, 78),
(195, 5, 79),
(196, 5, 80),
(197, 1, 81),
(198, 15, 81),
(199, 5, 81);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_menus`
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
(77, 'Directory', '#', 'fas fa-server', 0, 0, 1),
(78, 'HO-25-H00101', 'admin/holv1/ho', 'fas fa-building', 77, 1, 1),
(79, 'Warehouse-25-G11202', 'admin/holv1/warehouse', 'fa fa-warehouse', 77, 1, 2),
(80, 'Project Brau-25-O87401', 'admin/holv1/project_berau', 'fas fa-drafting-compass', 77, 1, 3),
(81, 'Directory', 'admin/directory', 'fas fa-server', 0, 1, 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_penagihan`
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
-- Dumping data untuk tabel `tbl_penagihan`
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
-- Struktur dari tabel `tbl_penjualan`
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
-- Dumping data untuk tabel `tbl_penjualan`
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
-- Struktur dari tabel `tbl_perusahaan`
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
-- Struktur dari tabel `tbl_po`
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
-- Dumping data untuk tabel `tbl_po`
--

INSERT INTO `tbl_po` (`id`, `po_number`, `Supplier_id`, `expeted_date`, `total_amount`, `status`, `po_date`, `file`, `po_description`, `item_description`) VALUES
(1, '123', 1, '0000-00-00', 123, '3231', '0000-00-00', 'http://localhost/cka-pot-master/uploads/po-files/1232.jpg', '123', NULL),
(2, 'Test 2', 1, '2024-10-01', 12000, '123', '2024-10-01', 'http://localhost/cka-pot-master/uploads/po-files/Test_2.jpg', 'Test 2', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_posisi`
--

CREATE TABLE `tbl_posisi` (
  `_id` int(11) NOT NULL,
  `posisi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tbl_posisi`
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
-- Struktur dari tabel `tbl_supplier`
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
-- Dumping data untuk tabel `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`id`, `nama`, `PIC_name`, `email`, `phone`, `address`, `bank_account`, `rek_bank`, `tax`, `status`, `created_at`, `update_at`) VALUES
(1, 'PT. Bina Mas Teknik', 'AAL', 'Testemail@gmail.com', '085280446016', 'Jl. Raya Merak No. 10 Cilegon - Banten', 'Mandir', '123123123123', '123123123123', '1', '2024-09-30 13:54:06', '2024-09-30 10:51:51'),
(3, 'PT. Anugerah Kota Baja', 'Budi Supriyanto', 'Budi@anugerahkotabaja.co.id', '081316313661', 'Metro Cilegon Blok N14 No.8 Kota Cilegon - Banten', 'Mandiri', '08123212312', '123123123', '1', '2024-10-01 10:26:15', '2024-10-01 15:26:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
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
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`_id`, `nik`, `nama`, `jk`, `tempat_lahir`, `tgl_lahir`, `tgl_masuk`, `posisi`, `alamat`, `password`, `is_aktif`, `created_at`, `no_hp`, `email`, `marital`, `npwp`, `bpjs_ks`, `bpjs_kt`, `path_foto`, `employee-id`, `superior_id`) VALUES
(14, '1', 'LUTFI WIJAYA', 'L', 'Serang', '2024-09-07', '2024-09-07', '1', 'Kp. Babakan Sompok RT 11 RW 05', '$2y$04$R8vOyZhkTaKbcv9WKUwlnOPCo.9ubE1HPwbbX8fsq2DWJol7V3BZC', '1', '2024-09-07 03:01:57', '082248951236', 'lutfiwijhaya@gmail.com', 'K', '', '', '', 'https://achivon.app/uploads/Lutfi.png ', 'h-000023', '0'),
(17, 'admin', 'admin', 'L', 'admin', '2024-11-22', '2024-11-22', '12', 'admin', '$2y$04$kOOsE6sK6H22GEhhJuR.TOidO6sUZEJe16N0iq77BzOl/B7BWvljq', '1', '2024-11-22 04:08:48', '0822', '', 'Tidak Kawin', '', '', '', 'https://achivon.app/uploads/icon-admin-128.png', 'admin', '0'),
(18, 'guest', 'Guest', 'L', 'Guset', '2024-11-22', '2024-11-22', '13', 'Guest', '$2y$04$gOXEWERXen2HgbsFiU6TtukDVwRHYfCnlZ0AwYDVcPrSYTFJ/6G5S', '1', '2024-11-22 04:13:21', '08', '', 'Tidak Kawin', '', '', '', 'https://achivon.app/uploads/guest-128.png', 'guest', '0'),
(19, 'guest01', 'Guest', 'L', 'guest', '2024-12-21', '2024-12-21', '14', 'guest', '$2y$04$Yrp3P.KITHoLlNq8cuOEKeTqsizkAMwBRrMQZ2wv4VOne1hjmDNHa', '1', '2024-12-21 04:19:47', '123123123', '', 'Kawin', '', '', '', 'https://achivon.app/uploads/guest-128.png', 'guest01', '0'),
(20, 'H-000001', 'Jong Ky Ahn', 'L', 'Seoul', '1966-10-08', '2019-05-19', '15', 'Jakarta', '$2y$10$7X/Hb1SNuNgLhsRMpyufMOhQr1wKA6uXMbO8dLTP8kRNILw39lnNS', '1', '2025-03-11 10:03:31', '-', 'justinahn@achivon.co.id', 'Kawin', '', '', '', 'https://achivon.app/uploads/Screenshot_2025-03-11_170314.png', 'H-000001', '0'),
(21, 'H-000002', 'Oh Chin Phang', 'L', 'Perak', '1986-08-18', '2024-04-01', '15', 'Malaysia', '$2y$04$Pc5irCPg0g372ktppGbEi.nWqoh2gEYmJDOGSl9UuT3hW4Wv9H6sa', '1', '2025-03-11 10:09:39', '-', 'cpoh@achivon.co.id', 'Kawin', '', '', '', 'https://achivon.app/uploads/Screenshot_2025-03-11_170504.png', 'H-000002', '0'),
(22, 'H-000003', 'Lee Byung Sam', 'L', 'Korea', '2025-03-11', '2025-03-11', '15', 'Jakarta', '$2y$04$NhQ6FozbR5GdFyb1PRjoaOpiDVa2amukYINlfUbidll6Q5klqqj4G', '1', '2025-03-11 10:12:07', '-', 'bslee@achivon.co.id ', 'Kawin', '', '', '', 'https://achivon.app/uploads/Screenshot_2025-03-11_170525.png', 'H-000003', '0'),
(23, 'H-0-230011', 'Ilham Kelana', 'L', 'PLAJU', '1982-01-09', '2023-01-20', '5', 'PERUM BUKIT CILEGON ASRI BLOK NH NO.21', '$2y$04$Pc5irCPg0g372ktppGbEi.nWqoh2gEYmJDOGSl9UuT3hW4Wv9H6sa', '1', '2025-03-11 10:23:27', '082210470237', 'ilham.kelana@achivon.co.id', 'Kawin', '680516267417000', '', '', 'https://achivon.app/uploads/Screenshot_2025-03-11_172311.png', 'H-0-230011', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wh_distribution`
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
-- Dumping data untuk tabel `wh_distribution`
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
-- Struktur dari tabel `wh_items`
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
-- Dumping data untuk tabel `wh_items`
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
(9, '2-10-100-12', 'CCS', 'EA', 'Equipment', 'ID Bedge', 'Doosan', '-', '-', 1, 'http://localhost/cka-pot-master/uploads/foto-items/2-10-100-121.png'),
(10, '2-10-100-12', 'TCS', 'EA', 'Non Power Tools', 'Non Power Tools', 'Kunci Inggris', '18\"', 'Adjustble wrech', 0, 'http://localhost/cka-pot-master/uploads/foto-items/2-10-100-12.png'),
(11, '2-10-100-10', 'TCS', 'EA', 'Non Power Tools', 'Non Power Tools', 'Kunci Inggris', '6\"', 're', 0, NULL),
(12, '2-10-100-14', 'TCS', 'EA', 'Non Power Tools', 'Non Power Tools', 'Kunci Inggris', '15\"', '', 0, NULL),
(13, '2-10-100-13', 'TCS', 'EA', 'Non Power Tools', 'Non Power Tools', 'Kunci Inggris', '12\"', '231', 0, 'http://localhost/cka-pot-master/uploads/foto-items/2-10-100-13.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wh_items_stock`
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
-- Dumping data untuk tabel `wh_items_stock`
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
-- Struktur dari tabel `wh_item_set`
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
-- Dumping data untuk tabel `wh_item_set`
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
-- Struktur dari tabel `wh_request`
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
  `create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `reason` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `wh_warehouse`
--

CREATE TABLE `wh_warehouse` (
  `id` int(30) NOT NULL,
  `wh_name` varchar(100) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `wh_warehouse`
--

INSERT INTO `wh_warehouse` (`id`, `wh_name`, `location`) VALUES
(1, 'Warehouse Office (Damkar Cilegon)', 'Office Damkar (Cilegon)'),
(2, 'Container 20Ft 1', 'Office Damkar (Cilegon)');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `accounting_bank`
--
ALTER TABLE `accounting_bank`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `accounting_daily_report`
--
ALTER TABLE `accounting_daily_report`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `accounting_daily_report_balance`
--
ALTER TABLE `accounting_daily_report_balance`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `accounting_daily_report_transaction`
--
ALTER TABLE `accounting_daily_report_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `accounting_voucher`
--
ALTER TABLE `accounting_voucher`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_doc` (`no_doc`);

--
-- Indeks untuk tabel `accounting_voucher_spec`
--
ALTER TABLE `accounting_voucher_spec`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `dr_akses`
--
ALTER TABLE `dr_akses`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `dr_file`
--
ALTER TABLE `dr_file`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `file_shared`
--
ALTER TABLE `file_shared`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `params`
--
ALTER TABLE `params`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sd_ho_lv1`
--
ALTER TABLE `sd_ho_lv1`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sd_ho_lv2`
--
ALTER TABLE `sd_ho_lv2`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sd_ho_lv3`
--
ALTER TABLE `sd_ho_lv3`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sd_ho_lv4`
--
ALTER TABLE `sd_ho_lv4`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sd_ho_lv5`
--
ALTER TABLE `sd_ho_lv5`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sd_ho_lv6`
--
ALTER TABLE `sd_ho_lv6`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sd_ho_lv7`
--
ALTER TABLE `sd_ho_lv7`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sd_ho_lv8`
--
ALTER TABLE `sd_ho_lv8`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sd_ho_lv9`
--
ALTER TABLE `sd_ho_lv9`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sd_ho_lv10`
--
ALTER TABLE `sd_ho_lv10`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`_id`);

--
-- Indeks untuk tabel `tbl_barang_masuk`
--
ALTER TABLE `tbl_barang_masuk`
  ADD PRIMARY KEY (`_id`);

--
-- Indeks untuk tabel `tbl_catatan`
--
ALTER TABLE `tbl_catatan`
  ADD PRIMARY KEY (`_id`);

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
-- Indeks untuk tabel `tbl_penagihan`
--
ALTER TABLE `tbl_penagihan`
  ADD PRIMARY KEY (`_id`),
  ADD UNIQUE KEY `kode_bayar` (`kode_bayar`);

--
-- Indeks untuk tabel `tbl_penjualan`
--
ALTER TABLE `tbl_penjualan`
  ADD PRIMARY KEY (`_id`),
  ADD UNIQUE KEY `no_faktur` (`no_faktur`);

--
-- Indeks untuk tabel `tbl_perusahaan`
--
ALTER TABLE `tbl_perusahaan`
  ADD PRIMARY KEY (`_id`);

--
-- Indeks untuk tabel `tbl_po`
--
ALTER TABLE `tbl_po`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_posisi`
--
ALTER TABLE `tbl_posisi`
  ADD PRIMARY KEY (`_id`);

--
-- Indeks untuk tabel `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`_id`),
  ADD UNIQUE KEY `nik` (`nik`);

--
-- Indeks untuk tabel `wh_distribution`
--
ALTER TABLE `wh_distribution`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `wh_items`
--
ALTER TABLE `wh_items`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `wh_items_stock`
--
ALTER TABLE `wh_items_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `wh_item_set`
--
ALTER TABLE `wh_item_set`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `wh_warehouse`
--
ALTER TABLE `wh_warehouse`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `accounting_bank`
--
ALTER TABLE `accounting_bank`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `accounting_daily_report`
--
ALTER TABLE `accounting_daily_report`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `accounting_daily_report_balance`
--
ALTER TABLE `accounting_daily_report_balance`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `accounting_daily_report_transaction`
--
ALTER TABLE `accounting_daily_report_transaction`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `accounting_voucher`
--
ALTER TABLE `accounting_voucher`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `accounting_voucher_spec`
--
ALTER TABLE `accounting_voucher_spec`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `dr_akses`
--
ALTER TABLE `dr_akses`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT untuk tabel `dr_file`
--
ALTER TABLE `dr_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1564;

--
-- AUTO_INCREMENT untuk tabel `file_shared`
--
ALTER TABLE `file_shared`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT untuk tabel `params`
--
ALTER TABLE `params`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT untuk tabel `sd_ho_lv1`
--
ALTER TABLE `sd_ho_lv1`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `sd_ho_lv2`
--
ALTER TABLE `sd_ho_lv2`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT untuk tabel `sd_ho_lv3`
--
ALTER TABLE `sd_ho_lv3`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=260;

--
-- AUTO_INCREMENT untuk tabel `sd_ho_lv4`
--
ALTER TABLE `sd_ho_lv4`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT untuk tabel `sd_ho_lv5`
--
ALTER TABLE `sd_ho_lv5`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT untuk tabel `sd_ho_lv6`
--
ALTER TABLE `sd_ho_lv6`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT untuk tabel `sd_ho_lv7`
--
ALTER TABLE `sd_ho_lv7`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `sd_ho_lv8`
--
ALTER TABLE `sd_ho_lv8`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `sd_ho_lv9`
--
ALTER TABLE `sd_ho_lv9`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `sd_ho_lv10`
--
ALTER TABLE `sd_ho_lv10`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_barang`
--
ALTER TABLE `tbl_barang`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_barang_masuk`
--
ALTER TABLE `tbl_barang_masuk`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `tbl_catatan`
--
ALTER TABLE `tbl_catatan`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_levels`
--
ALTER TABLE `tbl_levels`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- AUTO_INCREMENT untuk tabel `tbl_menus`
--
ALTER TABLE `tbl_menus`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT untuk tabel `tbl_penagihan`
--
ALTER TABLE `tbl_penagihan`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tbl_penjualan`
--
ALTER TABLE `tbl_penjualan`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tbl_perusahaan`
--
ALTER TABLE `tbl_perusahaan`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_po`
--
ALTER TABLE `tbl_po`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_posisi`
--
ALTER TABLE `tbl_posisi`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `wh_distribution`
--
ALTER TABLE `wh_distribution`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `wh_items`
--
ALTER TABLE `wh_items`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `wh_items_stock`
--
ALTER TABLE `wh_items_stock`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `wh_item_set`
--
ALTER TABLE `wh_item_set`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `wh_warehouse`
--
ALTER TABLE `wh_warehouse`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
