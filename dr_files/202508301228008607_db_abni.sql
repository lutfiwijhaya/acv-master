-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 28 Agu 2025 pada 01.49
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
-- Struktur dari tabel `hr_absen`
--

CREATE TABLE `hr_absen` (
  `id` int NOT NULL,
  `nik` bigint NOT NULL,
  `tgl_masuk` date NOT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `kehadiran` enum('Hadir','Sakit','Izin','Tidak Hadir') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Hadir' COMMENT 'Status kehadiran',
  `deleted` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `hr_absen`
--

INSERT INTO `hr_absen` (`id`, `nik`, `tgl_masuk`, `keterangan`, `kehadiran`, `deleted`) VALUES
(412, 6, '2025-07-29', 'tepat waktu', 'Tidak Hadir', 0),
(413, 7, '2025-07-30', 'kurang waktu', 'Hadir', 0),
(414, 343331232123, '2025-07-21', 'pas waktu', 'Tidak Hadir', 0),
(415, 192300931051003, '2025-07-30', 'tepat waktu', 'Hadir', 0),
(416, 8, '2025-08-04', 'tepat waktu', 'Hadir', 0),
(417, 6, '2025-08-04', 'pas', 'Hadir', 0),
(418, 1, '2025-08-07', 'tepat waktu', 'Hadir', 0),
(419, 5, '2025-08-07', 'tepat waktu', 'Hadir', 0),
(420, 6, '2025-08-07', 'tepat waktu', 'Hadir', 0),
(421, 7, '2025-08-07', 'tepat waktu', 'Hadir', 0),
(422, 343331232123, '2025-08-07', 'tepat waktu', 'Hadir', 0),
(423, 192300931051003, '2025-08-07', 'tepat waktu', 'Hadir', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `hr_academic`
--

CREATE TABLE `hr_academic` (
  `id` int NOT NULL,
  `graduation` date NOT NULL,
  `registered_school_name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `jurusan` varchar(255) DEFAULT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `hr_academic`
--

INSERT INTO `hr_academic` (`id`, `graduation`, `registered_school_name`, `location`, `jurusan`, `user_id`) VALUES
(457, '2015-02-23', 'sd', 'jakaarta', 'it', 175),
(458, '2016-06-15', 'smp', 'timur', 'tu', 175),
(459, '2018-06-29', 'sma', 'kota', 'ti', 175),
(460, '2020-12-22', 'kuliah', 'monasssssssss', 'ts', 175),
(461, '2015-02-23', 'sd', 'jakaarta', 'it', 176),
(462, '2016-06-15', 'smp', 'timur', 'tu', 176),
(463, '2018-06-29', 'sma', 'kota', 'ti', 176),
(464, '2020-12-22', 'kuliah', 'jakarta', 'ts', 176),
(465, '0000-00-00', 'sd', '', '', 177),
(466, '0000-00-00', 'sd', '', '', 177),
(467, '0000-00-00', 'sd', '', '', 177),
(468, '0000-00-00', 'sd', '', '', 177),
(473, '2015-07-08', 'sd', 'jakaarta', '-', 185),
(474, '2021-12-01', 'SMK PGRI 1 ', 'jakarta timur', '-', 185),
(475, '2018-06-05', 'sma', 'bandung', 'title', 185),
(476, '2002-12-31', 'kuliah', 'balii', 'kantor', 185),
(477, '2015-07-08', 'sd', 'jakaarta', '-', 186),
(478, '2021-12-01', 'smp', 'bogor', '-', 186),
(479, '2018-06-05', 'sma', 'bandung', 'title', 186),
(480, '2002-12-31', 'kuliah', 'balii', 'kantor', 186),
(515, '2010-01-05', 'sd duaa', 'jakaarta', '-', 227),
(516, '2016-06-13', 'smp', 'jaktim', '-', 227),
(517, '2020-07-08', 'sma', 'jakaarta', 'otkp', 227),
(518, '2024-06-12', 'kuliahh', 'jakpus', 'SI', 227),
(519, '2010-01-05', 'sd', 'jakaarta', '', 229),
(520, '2010-01-05', 'sd', 'jakaarta', '', 232),
(546, '2010-01-05', 'sd', 'jakaarta', '-', 233),
(547, '2016-07-06', 'smp  jakarta', 'jakaarta', '', 233),
(747, '2015-07-08', 'sd', 'jakaarta', '-', 179),
(748, '2021-12-01', 'sd', 'bogor', '-', 179),
(749, '0000-00-00', 'sd', 'bandung', 'title', 179),
(750, '2002-12-31', 'sd', 'balii', 'kantor', 179),
(759, '2015-02-03', 'sd', 'jakaarta', '-', 234),
(760, '2017-06-06', 'smp', 'jakaarta', 'mts', 234),
(761, '2020-07-14', 'sma', 'jaktim', 'otkp', 234),
(762, '2025-08-13', 'kuliah', 'jakpus', 'SI', 234),
(763, '2010-06-08', 'sds angkasa', 'jakaarta timur', '-', 244),
(764, '2016-07-07', 'smpn 14 ', 'jakaarta timur', '-', 244),
(765, '2020-06-10', 'sman 27 ', 'jakaarta timur', 'ipa', 244),
(766, '2024-05-16', 'kuliah', 'jakaarta pusat', 'sistem informasi', 244),
(767, '2010-06-08', 'sds angkasa', 'jakaarta timur', '-', 245),
(768, '2016-07-07', 'smpn 14 ', 'jakaarta timur', '-', 245),
(769, '2020-06-10', 'sman 27 ', 'jakaarta timur', 'ipa', 245),
(770, '2024-05-16', 'kuliah', 'jakaarta pusat', 'sistem informasi', 245),
(771, '2010-06-08', 'sds angkasa', 'jakaarta timur', '-', 246),
(772, '2016-07-07', 'smpn 14 ', 'jakaarta timur', '-', 246),
(773, '2020-06-10', 'sman 27 ', 'jakaarta timur', 'ipa', 246),
(774, '2024-05-16', 'kuliah', 'jakaarta pusat', 'sistem informasi', 246),
(775, '2010-06-08', 'sds angkasa', 'jakaarta timur', '-', 247),
(776, '2016-07-07', 'smpn 14 ', 'jakaarta timur', '-', 247),
(777, '2020-06-10', 'sman 27 ', 'jakaarta timur', 'ipa', 247),
(778, '2024-05-16', 'kuliah', 'jakaarta pusat', 'sistem informasi', 247),
(779, '2010-06-08', 'sds angkasa', 'jakaarta timur', '-', 248),
(780, '2016-07-07', 'smpn 14 ', 'jakaarta timur', '-', 248),
(781, '2020-06-10', 'sman 27 ', 'jakaarta timur', 'ipa', 248),
(782, '2024-05-16', 'kuliah', 'jakaarta pusat', 'sistem informasi', 248),
(791, '2010-06-08', 'sds angkasa', 'jakaarta timur', '-', 249),
(792, '2016-07-07', 'smpn 14 ', 'jakaarta timur', '-', 249),
(793, '2020-06-10', 'sman 27 ', 'jakaarta timur', 'ipa', 249),
(794, '2024-05-16', 'kuliah', 'jakaarta pusat', 'sistem informasi', 249);

-- --------------------------------------------------------

--
-- Struktur dari tabel `hr_career`
--

CREATE TABLE `hr_career` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `company_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `position` varchar(255) NOT NULL,
  `period_star` date NOT NULL,
  `period_end` date NOT NULL,
  `career` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `hr_career`
--

INSERT INTO `hr_career` (`id`, `user_id`, `company_name`, `position`, `period_star`, `period_end`, `career`) VALUES
(242, 175, 'pt joya', 'it', '2013-02-01', '2016-06-01', '2022'),
(243, 175, 'cvb dada', 'ti', '2010-03-01', '2016-03-01', '2023'),
(244, 175, 'pt naga', 'di', '2012-04-01', '2019-05-01', '2024'),
(245, 175, 'pt bisa', 'si', '0000-00-00', '2023-07-01', '2025'),
(246, 176, 'pt joya', 'it', '2013-02-01', '2016-06-01', '2022'),
(247, 176, 'cvb dada', 'ti', '2010-03-01', '2016-03-01', '2023'),
(248, 176, 'pt naga', 'di', '2012-04-01', '2019-05-01', '2024'),
(249, 176, 'pt bisa', 'si', '2020-01-01', '2023-07-01', '2025'),
(254, 185, 'pt joya', 'it', '2019-05-01', '2021-01-01', '2022'),
(255, 185, 'pt ac', 'ser', '2020-03-01', '2022-01-01', '2023'),
(256, 185, 'pt tect', 'vgs', '2022-03-01', '2023-04-01', '2024'),
(257, 185, 'pt yaya', 'vga', '2024-01-01', '2025-04-01', '2024'),
(258, 186, 'pt joya', 'it', '2019-05-01', '2021-01-01', '2022'),
(259, 186, 'pt ac', 'ser', '2020-03-01', '2022-01-01', '2023'),
(260, 186, 'pt tect', 'vgs', '2022-03-01', '2023-04-01', '2024'),
(261, 186, 'pt yaya', 'vga', '2024-01-01', '2025-04-01', '2024'),
(262, 202, 'pt joya', 'it', '2014-06-01', '2020-01-01', '5 years, 8 months'),
(263, 203, 'pt joya', 'it', '2017-01-01', '2025-01-01', '8 years, 1 months'),
(264, 204, 'pt joya', 'it', '2017-01-01', '2025-01-01', '8 years, 1 months'),
(265, 204, 'pt joya', '', '0000-00-00', '0000-00-00', ''),
(266, 204, 'pt joya', '', '0000-00-00', '0000-00-00', ''),
(267, 204, 'pt joya', '', '0000-00-00', '0000-00-00', ''),
(268, 227, 'pt joya', '', '0000-00-00', '0000-00-00', ''),
(269, 227, 'pt joya', '', '0000-00-00', '0000-00-00', ''),
(270, 227, 'pt joya', '', '0000-00-00', '0000-00-00', ''),
(271, 227, 'pt joya', '', '0000-00-00', '0000-00-00', ''),
(272, 229, 'pt joya', '', '0000-00-00', '0000-00-00', ''),
(273, 229, 'pt joya', '', '0000-00-00', '0000-00-00', ''),
(274, 229, 'pt joya', '', '0000-00-00', '0000-00-00', ''),
(275, 229, 'pt joya', '', '0000-00-00', '0000-00-00', ''),
(276, 232, 'pt joya', '', '0000-00-00', '0000-00-00', ''),
(277, 232, 'pt joya', '', '0000-00-00', '0000-00-00', ''),
(278, 232, 'pt joya', '', '0000-00-00', '0000-00-00', ''),
(279, 232, 'pt joya', '', '0000-00-00', '0000-00-00', ''),
(325, 236, 'pt joya', '', '0000-00-00', '0000-00-00', ''),
(326, 236, 'pt joya', '', '0000-00-00', '0000-00-00', ''),
(327, 236, 'pt joya', '', '0000-00-00', '0000-00-00', ''),
(328, 236, 'pt joya', '', '0000-00-00', '0000-00-00', ''),
(333, 238, 'pt joya', '', '0000-00-00', '0000-00-00', ''),
(334, 238, 'pt joya', '', '0000-00-00', '0000-00-00', ''),
(335, 238, 'pt joya', '', '0000-00-00', '0000-00-00', ''),
(336, 238, 'pt joya', '', '0000-00-00', '0000-00-00', ''),
(337, 239, 'pt joya', '', '0000-00-00', '0000-00-00', ''),
(338, 239, 'pt joya', '', '0000-00-00', '0000-00-00', ''),
(339, 239, 'pt joya', '', '0000-00-00', '0000-00-00', ''),
(340, 239, 'pt joya', '', '0000-00-00', '0000-00-00', ''),
(341, 241, 'pt joya', '', '0000-00-00', '0000-00-00', ''),
(342, 241, 'pt joya', '', '0000-00-00', '0000-00-00', ''),
(343, 241, 'pt joya', '', '0000-00-00', '0000-00-00', ''),
(344, 241, 'pt joya', '', '0000-00-00', '0000-00-00', ''),
(349, 243, 'pt joya', '', '0000-00-00', '0000-00-00', ''),
(350, 243, 'pt joya', '', '0000-00-00', '0000-00-00', ''),
(351, 243, 'pt joya', '', '0000-00-00', '0000-00-00', ''),
(352, 243, 'pt joya', '', '0000-00-00', '0000-00-00', ''),
(496, 179, 'pt joya', 'it', '2019-05-01', '2021-01-01', '1 years, 9 months'),
(497, 179, 'pt ac', 'ser', '2020-03-01', '2022-01-01', '1 years, 11 months'),
(498, 179, 'pt tect', 'vgs', '2022-03-01', '2023-04-01', '1 years, 2 months'),
(499, 179, 'pt yaya', 'vga', '2024-01-01', '2025-04-01', '1 years, 4 months'),
(510, 234, 'pt joya', 'it', '2016-02-01', '2024-01-01', '8 years, 0 months'),
(511, 234, 'pt sap', 'gudang', '2023-06-01', '2025-08-01', '2 years, 3 months'),
(512, 234, 'pt achivon', 'kuli', '2024-06-01', '2024-08-01', '0 years, 3 months'),
(513, 234, 'pt achivon', 'it', '2023-01-01', '2025-06-01', '2 years, 6 months'),
(514, 234, 'pt joya', 'si', '2023-07-01', '2024-12-01', '1 years, 6 months'),
(515, 244, 'PT Telekomunikasi Indonesia (Telkom)', 'Customer Service Officer', '2015-01-01', '2017-12-01', '3 years, 0 months'),
(516, 244, 'PT Bank Central Asia (BCA)', 'Relationship Officer', '2018-02-01', '2020-06-01', '2 years, 5 months'),
(517, 244, 'PT Pertamina Persero', 'Project Coordinator', '2020-07-01', '2022-12-01', '2 years, 6 months'),
(518, 244, 'PT Astra International Tbk', 'Marketing Manager', '2023-08-01', '2025-08-01', '2 years, 1 months'),
(519, 245, 'PT Telekomunikasi Indonesia (Telkom)', 'Customer Service Officer', '2015-01-01', '2017-12-01', '3 years, 0 months'),
(520, 245, 'PT Bank Central Asia (BCA)', 'Relationship Officer', '2018-02-01', '2020-06-01', '2 years, 5 months'),
(521, 245, 'PT Pertamina Persero', 'Project Coordinator', '2020-07-01', '2022-12-01', '2 years, 6 months'),
(522, 245, 'PT Astra International Tbk', 'Marketing Manager', '2023-08-01', '2025-08-01', '2 years, 1 months'),
(523, 246, 'PT Telekomunikasi Indonesia (Telkom)', 'Customer Service Officer', '2015-01-01', '2017-12-01', '3 years, 0 months'),
(524, 246, 'PT Bank Central Asia (BCA)', 'Relationship Officer', '2018-02-01', '2020-06-01', '2 years, 5 months'),
(525, 246, 'PT Pertamina Persero', 'Project Coordinator', '2020-07-01', '2022-12-01', '2 years, 6 months'),
(526, 246, 'PT Astra International Tbk', 'Marketing Manager', '2023-08-01', '2025-08-01', '2 years, 1 months'),
(527, 247, 'PT Telekomunikasi Indonesia (Telkom)', 'Customer Service Officer', '2015-01-01', '2017-12-01', '3 years, 0 months'),
(528, 247, 'PT Bank Central Asia (BCA)', 'Relationship Officer', '2018-02-01', '2020-06-01', '2 years, 5 months'),
(529, 247, 'PT Pertamina Persero', 'Project Coordinator', '2020-07-01', '2022-12-01', '2 years, 6 months'),
(530, 247, 'PT Astra International Tbk', 'Marketing Manager', '2023-08-01', '2025-08-01', '2 years, 1 months'),
(531, 248, 'PT Telekomunikasi Indonesia (Telkom)', 'Customer Service Officer', '2015-01-01', '2017-12-01', '3 years, 0 months'),
(532, 248, 'PT Bank Central Asia (BCA)', 'Relationship Officer', '2018-02-01', '2020-06-01', '2 years, 5 months'),
(533, 248, 'PT Pertamina Persero', 'Project Coordinator', '2020-07-01', '2022-12-01', '2 years, 6 months'),
(534, 248, 'PT Astra International Tbk', 'Marketing Manager', '2023-08-01', '2025-08-01', '2 years, 1 months'),
(543, 249, 'PT Telekomunikasi Indonesia (Telkom)', 'Customer Service Officer', '2015-01-01', '2017-12-01', '3 years, 0 months'),
(544, 249, 'PT Bank Central Asia (BCA)', 'Relationship Officer', '2018-02-01', '2020-06-01', '2 years, 5 months'),
(545, 249, 'PT Pertamina Persero', 'Project Coordinator', '2020-07-01', '2022-12-01', '2 years, 6 months'),
(546, 249, 'PT Astra International Tbk', 'Marketing Manager', '2023-08-01', '2025-08-01', '2 years, 1 months');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hr_certificates`
--

CREATE TABLE `hr_certificates` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `acquisition` date NOT NULL,
  `certificate` varchar(255) NOT NULL,
  `authority` varchar(255) NOT NULL,
  `issue_location` varchar(255) NOT NULL,
  `certificate_no` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `hr_certificates`
--

INSERT INTO `hr_certificates` (`id`, `user_id`, `acquisition`, `certificate`, `authority`, `issue_location`, `certificate_no`) VALUES
(491, 233, '2017-02-01', 'juaraaa', 'kerja', 'jakarta', '0'),
(492, 233, '2022-06-13', 'jura 1 bootcamp', 'bootacmp', 'jaktim', '1'),
(493, 233, '2020-01-28', 'juara 2 bootacano', 'bootacmp', 'jakarta', '3'),
(494, 233, '2020-10-12', 'juara 3 bootacmp', 'bootcamp', 'jakarta', '2'),
(727, 234, '2015-01-14', 'skil n1', 'kerja', 'jakarta', '0'),
(728, 234, '2016-02-16', 'bootcamp 1', 'bootacmp', 'bogor', '1'),
(729, 234, '2020-10-06', 'bootcamp 2', 'bootacmp', 'jakarta', '2'),
(730, 234, '2023-07-06', 'bootcamp 3', 'bootacmp', 'jakarta', '3'),
(731, 234, '2023-10-11', 'bootcamp 4', 'bootacmp', 'jakarta', '4'),
(732, 185, '2019-12-30', 'AI', 'Samsul', '', '19'),
(733, 185, '2023-08-23', 'Data Science Certification', 'Coursera', '', 'ABC12345'),
(734, 244, '2017-06-13', 'TOEFL iBT (English Proficiency)', 'ETS', 'Jakarta', '1234-5678-2017'),
(735, 244, '2019-07-09', 'Microsoft Office Specialist (Excel)', 'Microsoft', 'Surabaya', 'MOS-EXC-98765'),
(736, 245, '2017-06-13', 'TOEFL iBT (English Proficiency)', 'ETS', 'Jakarta', '1234-5678-2017'),
(737, 245, '2019-07-09', 'Microsoft Office Specialist (Excel)', 'Microsoft', 'Surabaya', 'MOS-EXC-98765'),
(738, 246, '2017-06-13', 'TOEFL iBT (English Proficiency)', 'ETS', 'Jakarta', '1234-5678-2017'),
(739, 246, '2019-07-09', 'Microsoft Office Specialist (Excel)', 'Microsoft', 'Surabaya', 'MOS-EXC-98765'),
(740, 247, '2017-06-13', 'TOEFL iBT (English Proficiency)', 'ETS', 'Jakarta', '1234-5678-2017'),
(741, 247, '2019-07-09', 'Microsoft Office Specialist (Excel)', 'Microsoft', 'Surabaya', 'MOS-EXC-98765'),
(742, 248, '2017-06-13', 'TOEFL iBT (English Proficiency)', 'ETS', 'Jakarta', '1234-5678-2017'),
(743, 248, '2019-07-09', 'Microsoft Office Specialist (Excel)', 'Microsoft', 'Surabaya', 'MOS-EXC-98765'),
(748, 249, '2017-06-13', 'TOEFL iBT (English Proficiency)', 'ETS', 'Jakarta', '1234-5678-2017'),
(749, 249, '2019-07-09', 'Microsoft Office Specialist (Excel)', 'Microsoft', 'Surabaya', 'MOS-EXC-98765');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hr_disciplinary`
--

CREATE TABLE `hr_disciplinary` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `description` varchar(255) NOT NULL,
  `disciplinary_date` date NOT NULL,
  `disciplinary_period_star` date NOT NULL,
  `disciplinary_period_end` date NOT NULL,
  `disciplinary_result` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `hr_disciplinary`
--

INSERT INTO `hr_disciplinary` (`id`, `user_id`, `description`, `disciplinary_date`, `disciplinary_period_star`, `disciplinary_period_end`, `disciplinary_result`) VALUES
(1, 176, 'vestival', '2025-07-17', '2020-02-06', '2024-01-02', 'piala'),
(2, 185, 'Coaching Etika komunikasi', '2025-08-05', '2025-08-05', '2025-08-30', 'Selesai, tidak ada pengulangan  Clear');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hr_document`
--

CREATE TABLE `hr_document` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `document_type` enum('Resume','KTP','Photo 3.5x4.5','SKCK','Academic Certificate','Career Certificate','Self Introduction','Medical Check Up','Bank Account','Family Relation Certificate','Tax ID Card (NPWP)','BPJS Ketenagakerjaan','BPJS Kesehatan','Family Contact') NOT NULL,
  `file_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `hr_document`
--

INSERT INTO `hr_document` (`id`, `user_id`, `document_type`, `file_name`) VALUES
(3, 146, 'SKCK', 'f64fb7d8b7811afbfbd0a26494927c24.pdf'),
(4, 157, 'SKCK', '1db385b1e11a26741a94fa62006887ee.png'),
(5, 159, 'SKCK', '8c302adc818e9da63cdb112bc0a6c5f5.pdf'),
(6, 170, '', '5c54024fdec6b93ce86d14fa4959404c.pdf'),
(7, 170, 'KTP', '633ed87bafc87a219ed2a7fc915bcab3.jpg'),
(8, 170, '', '9b5dcea1f0544e897b4b4f1759f72a4b.png'),
(9, 170, 'SKCK', 'a6049e8617327d363ec59c49335b3d72.pdf'),
(10, 170, 'Resume', '6c5ad35eea60f7f8a8cb267c7f10ddd1.pdf'),
(11, 170, 'Resume', '11f11f8424b6e06aa364ab8347686923.jpg'),
(12, 170, 'Resume', '254544de500ea97703a7f251d239bc02.pdf'),
(13, 170, 'Photo 3.5x4.5', '570c8bd519de6b7baf3494f832e0bd82.jpg'),
(14, 170, 'BPJS Ketenagakerjaan', '4de27ae49cad788c327d0b02a711ea60.pdf'),
(15, 170, 'Tax ID Card (NPWP)', 'd8f1f76e5e9209ccde3d6a1b55d0a09f.jpg'),
(16, 172, 'SKCK', 'faddc6474a6900e7f84c05e36d6ea0d5.pdf'),
(17, 174, 'Resume', '614c0b6bba2b194d62173c81ada1a3d0.pdf'),
(18, 174, 'Resume', '8d1d057176d01a057a0f5e6efa7646ba.pdf'),
(19, 176, 'Resume', '9b4b6c9f8662f6b8ea88c579a67cefc0.pdf'),
(20, 179, 'SKCK', '0b558dd6ba924e1dc15e3c3416157b2a.pdf'),
(21, 176, 'KTP', 'c00e133b563bbdba2a5583217180d4e6.jpg'),
(22, 185, 'Resume', 'a59e6603dae2d613aca43953b8896762.pdf'),
(23, 185, 'KTP', 'f97a50756d25423ea272e6c117f3ba51.png'),
(24, 185, 'Photo 3.5x4.5', '8ccf89c6b2895f027bf79d3c3bbb3f9a.png'),
(25, 185, 'SKCK', 'c285956fd5b2c11b9f054ca9e8504b3f.pdf'),
(26, 185, 'Academic Certificate', 'eed3312e4163ab40c86613f5ba8c0fe8.png'),
(27, 185, 'Medical Check Up', '91891a22122942e6b9e4233eabf6e230.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hr_employee`
--

CREATE TABLE `hr_employee` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `subject` varchar(255) NOT NULL,
  `employee_date_start` date DEFAULT NULL,
  `employee_date_end` date DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `work_location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `hr_employee`
--

INSERT INTO `hr_employee` (`id`, `user_id`, `subject`, `employee_date_start`, `employee_date_end`, `position`, `work_location`) VALUES
(1, 176, 'di pindahkan posisi', '2022-02-17', '2025-02-03', 'Welder', 'cilegon'),
(2, 185, 'Change of Position', '2025-08-22', '2025-10-31', 'Welder', 'kalimantan berau');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hr_family`
--

CREATE TABLE `hr_family` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `relation` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `cohabit` enum('yes','no') NOT NULL,
  `mobile_no` varchar(15) NOT NULL,
  `number` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `hr_family`
--

INSERT INTO `hr_family` (`id`, `user_id`, `name`, `relation`, `birthday`, `cohabit`, `mobile_no`, `number`) VALUES
(394, 167, 'istri', 'Wife', '2018-11-22', 'yes', '22222222222', 0),
(395, 167, 'anak', 'Son', '2024-07-23', 'yes', '33333333333', 0),
(396, 168, 'kakekkkk', 'Grand Parent', '2013-02-22', 'yes', '99999999999', 0),
(397, 168, 'ayah', 'Parent', '2017-10-22', '', '111111111111', 0),
(398, 168, 'istri', 'Wife', '2018-11-22', '', '22222222222', 0),
(399, 168, 'anak', 'Son', '2024-07-23', '', '33333333333', 0),
(406, 170, 'kakekkkk', 'grandparent', '2013-02-22', 'no', '99999999999', 1),
(407, 170, 'ayah', 'Parent', '2017-10-22', 'no', '111111111111', 2),
(408, 170, 'istri', 'Wife', '2018-11-22', 'yes', '22222222222', 1),
(409, 170, 'anak', 'son', '2024-07-23', 'yes', '33333333333', 2),
(410, 170, '', 'Daughter', '0000-00-00', 'no', '', 0),
(411, 172, 'kakekkkk', 'GrandParent', '2013-02-22', 'yes', '99999999999', 0),
(412, 172, 'ayah', 'Parent', '2017-10-22', 'yes', '111111111111', 0),
(413, 172, 'istri', 'Wife', '2018-11-22', 'yes', '22222222222', 0),
(414, 172, 'anak', 'Son', '2024-07-23', 'yes', '33333333333', 0),
(415, 173, 'kakekkkk', 'GrandParent', '2013-02-22', '', '99999999999', 0),
(416, 173, 'ayah', 'Parent', '2017-10-22', '', '111111111111', 0),
(417, 173, 'istri', 'Wife', '2018-11-22', '', '22222222222', 0),
(418, 173, 'anak', 'Son', '2024-07-23', 'yes', '33333333333', 0),
(419, 174, 'kakekkkk', 'GrandParent', '2013-02-22', 'yes', '99999999999', 0),
(420, 174, 'ayah', 'Parent', '2017-10-22', 'no', '111111111111', 0),
(421, 174, 'istri', 'Wife', '2018-11-22', 'yes', '22222222222', 0),
(422, 174, 'anak', 'Son', '2024-07-23', 'yes', '33333333333', 0),
(423, 174, '', 'Daughter', '0000-00-00', 'no', '', 0),
(424, 175, 'kakekkkk', 'GrandParent', '2013-02-22', 'yes', '99999999999', 0),
(425, 175, 'ayah', 'Parent', '2017-10-22', 'no', '111111111111', 0),
(426, 175, 'istri', 'Wife', '2018-11-22', 'yes', '22222222222', 0),
(427, 175, 'anak', 'Son', '2024-07-23', 'yes', '33333333333', 0),
(428, 176, 'kakekkkk', 'GrandParent', '2013-02-22', 'yes', '99999999999', 1),
(429, 176, 'ayah', 'Parent', '2017-10-22', 'yes', '111111111111', 2),
(430, 176, 'istri', 'Wife', '2018-11-22', 'yes', '22222222222', 1),
(431, 176, 'anak', 'Son', '2024-07-23', 'yes', '33333333333', 2),
(432, 176, '', 'Daughter', '0000-00-00', 'no', '', 1),
(433, 177, '', '', '0000-00-00', '', '', 0),
(434, 177, '', '', '0000-00-00', '', '', 0),
(435, 177, '', '', '0000-00-00', '', '', 0),
(436, 177, '', '', '0000-00-00', '', '', 0),
(437, 178, '', '', '0000-00-00', '', '', 0),
(438, 178, '', '', '0000-00-00', '', '', 0),
(439, 178, '', '', '0000-00-00', '', '', 0),
(440, 178, '', '', '0000-00-00', '', '', 0),
(441, 21, '', 'Grandparent', '0000-00-00', 'no', '', 0),
(442, 21, '', 'Parent', '0000-00-00', 'no', '', 0),
(443, 21, '', 'Wife', '0000-00-00', 'no', '', 0),
(444, 21, '', 'Son', '0000-00-00', 'no', '', 0),
(445, 21, '', 'Daughter', '0000-00-00', 'no', '', 0),
(446, 179, 'aIIM', 'GrandParent', '2222-12-13', 'yes', '8439932492', 0),
(447, 179, 'Asa', 'Parent', '2000-04-14', 'yes', '8439932492', 0),
(448, 179, 'sw', 'Wife', '2004-12-23', 'yes', '8439932492', 0),
(449, 179, 'qsA', 'Son', '0000-00-00', 'yes', '8439932492', 0),
(450, 185, 'aIIM', 'GrandParent', '2222-12-13', 'no', '8439932492', 2),
(451, 185, 'Asa', 'Parent', '2000-04-14', 'yes', '8439932492', 2),
(452, 185, 'sw', 'Wife', '2004-12-23', 'yes', '8439932492', 1),
(453, 185, 'qsA', 'Son', '2016-02-02', 'no', '8439932492', 0),
(454, 185, '', 'Daughter', '0000-00-00', 'yes', '', 2),
(455, 23, '', 'Grandparent', '0000-00-00', 'no', '', 0),
(456, 23, '', 'Parent', '0000-00-00', 'no', '', 0),
(457, 23, '', 'Wife', '0000-00-00', 'no', '', 0),
(458, 23, '', 'Son', '0000-00-00', 'no', '', 0),
(459, 23, '', 'Daughter', '0000-00-00', 'no', '', 0),
(460, 22, '', 'Grandparent', '0000-00-00', 'no', '', 0),
(461, 22, '', 'Parent', '0000-00-00', 'no', '', 0),
(462, 22, '', 'Wife', '0000-00-00', 'no', '', 0),
(463, 22, '', 'Son', '0000-00-00', 'no', '', 0),
(464, 22, '', 'Daughter', '0000-00-00', 'no', '', 0),
(465, 20, '', 'Grandparent', '0000-00-00', 'no', '', 0),
(466, 20, '', 'Parent', '0000-00-00', 'no', '', 0),
(467, 20, '', 'Wife', '0000-00-00', 'no', '', 0),
(468, 20, '', 'Son', '0000-00-00', 'no', '', 0),
(469, 20, '', 'Daughter', '0000-00-00', 'no', '', 0),
(470, 186, 'aIIM', 'GrandParent', '2222-12-13', '', '8439932492', 0),
(471, 186, 'Asa', 'Parent', '2000-04-14', '', '8439932492', 0),
(472, 186, 'sw', 'Wife', '2004-12-23', '', '8439932492', 0),
(473, 186, 'qsA', 'Son', '2016-02-02', '', '8439932492', 0),
(474, 193, '', '', '0000-00-00', '', '', 0),
(475, 193, '', '', '0000-00-00', '', '', 0),
(476, 193, '', '', '0000-00-00', '', '', 0),
(477, 193, '', '', '0000-00-00', '', '', 0),
(478, 194, '', '', '0000-00-00', '', '8439932492', 0),
(479, 194, '', '', '0000-00-00', '', '8439932492', 0),
(480, 194, '', '', '0000-00-00', '', '8439932492', 0),
(481, 194, '', '', '0000-00-00', '', '8439932492', 0),
(482, 195, '', '', '0000-00-00', '', '8439932492', 0),
(483, 195, '', '', '0000-00-00', '', '8439932492', 0),
(484, 195, '', '', '0000-00-00', '', '8439932492', 0),
(485, 195, '', '', '0000-00-00', '', '8439932492', 0),
(486, 196, '', '', '0000-00-00', '', '', 0),
(487, 196, '', '', '0000-00-00', '', '8439932492', 0),
(488, 196, '', '', '0000-00-00', '', '8439932492', 0),
(489, 196, '', '', '0000-00-00', '', '8439932492', 0),
(490, 197, '', '', '0000-00-00', '', '', 0),
(491, 197, '', '', '0000-00-00', '', '', 0),
(492, 197, '', '', '0000-00-00', '', '', 0),
(493, 197, '', '', '0000-00-00', '', '', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `hr_hired`
--

CREATE TABLE `hr_hired` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `intial` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `hr_hired`
--

INSERT INTO `hr_hired` (`id`, `user_id`, `intial`, `value`) VALUES
(587, 170, 'Type of Hired', 'Permanent'),
(588, 170, 'Salary Type', 'All Day, Hourly'),
(607, 176, 'Type of Hired', 'Permanent'),
(608, 176, 'Salary Type', 'All Day, Hourly'),
(609, 176, 'Hired Contract No.', '12343'),
(610, 176, 'Position ID No.', '12314324'),
(611, 176, 'Company Join Date', '2023-01-03'),
(612, 176, 'Contract Finish Date', '2025-07-01'),
(613, 176, 'Probation Period', '3 bulan'),
(614, 176, 'Work Location', 'Direct'),
(615, 176, 'Team', 'welder'),
(835, 185, 'Type of Hired', 'Permanent'),
(836, 185, 'Salary Type', 'All Day, Hourly'),
(837, 185, 'Hired Contract No.', '12313431'),
(838, 185, 'Position ID No.', '12331214'),
(839, 185, 'Company Join Date', '2025-08-01'),
(840, 185, 'Contract Finish Date', '2025-10-09'),
(841, 185, 'Probation Period', '2 bulan'),
(842, 185, 'Work Location', 'Indirect'),
(843, 185, 'Team', 'helpen');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hr_motivation`
--

CREATE TABLE `hr_motivation` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `motivation_reason` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `hr_motivation`
--

INSERT INTO `hr_motivation` (`id`, `user_id`, `motivation_reason`) VALUES
(3, 146, 'gasss'),
(4, 157, 'cb'),
(5, 159, 'yesss'),
(7, 185, 'kerja kerja'),
(36, 234, 'kerja terus menerus dan tepat waktu di setiap saat'),
(38, 249, 'Saya memiliki motivasi yang kuat untuk bergabung karena ingin mengembangkan potensi diri sekaligus memberikan kontribusi nyata bagi perusahaan. Dengan pengalaman dan keterampilan yang saya miliki di bidang [bidang keahlian kamu], saya yakin dapat mendukung pencapaian visi dan misi perusahaan.\r\n\r\nSelain itu, saya melihat perusahaan ini memiliki lingkungan kerja yang profesional, kesempatan pengembangan karier yang jelas, serta budaya kerja yang selaras dengan nilai-nilai yang saya pegang, seperti integritas, inovasi, dan kerja sama tim.\r\n\r\nSaya percaya bahwa bergabung dengan perusahaan ini akan menjadi kesempatan terbaik untuk terus belajar, meningkatkan kompetensi, serta memberikan dampak positif baik bagi perusahaan maupun masyarakat luas.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hr_reward`
--

CREATE TABLE `hr_reward` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `reward_name` varchar(255) NOT NULL,
  `reward_date` date NOT NULL,
  `reward_result` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `hr_reward`
--

INSERT INTO `hr_reward` (`id`, `user_id`, `reward_name`, `reward_date`, `reward_result`) VALUES
(1, 176, 'juara 1 bootcamp', '2025-07-02', 'piala'),
(2, 176, 'juara 1 lari', '2022-06-07', 'emas'),
(3, 176, 'juara 2 balapan', '2022-06-09', 'perak'),
(4, 176, 'juara 3 futsal', '2025-07-11', 'perunggu'),
(5, 185, 'juara 1 bootcamp', '2025-07-27', 'piala1 emas'),
(6, 185, 'Best Sales Performance', '2024-06-04', 'Voucher Belanja');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hr_salary`
--

CREATE TABLE `hr_salary` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `allowances` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `salary` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `hr_salary`
--

INSERT INTO `hr_salary` (`id`, `user_id`, `allowances`, `salary`) VALUES
(591, 176, 'Basic', 555555),
(592, 176, 'OT Allowance', 324324),
(593, 176, 'Site Allowance', 43243),
(594, 176, 'Meal', 4532543),
(595, 176, 'Transportation', 23432),
(596, 176, 'Role Allowance', 33343),
(597, 176, 'Accommodation', 2147483),
(598, 176, 'Sunday/Holiday', 12312321),
(599, 176, 'Hourly Rate', 32432432),
(726, 185, 'Basic', 323232),
(727, 185, 'OT Allowance', 3243200),
(728, 185, 'Site Allowance', 454300),
(729, 185, 'Meal', 23432),
(730, 185, 'Transportation', 345000),
(731, 185, 'Role Allowance', 23400),
(732, 185, 'Accommodation', 34534),
(733, 185, 'Sunday/Holiday', 23424),
(734, 185, 'Hourly Rate', 435000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `hr_timesheet`
--

CREATE TABLE `hr_timesheet` (
  `id` int NOT NULL,
  `nik` bigint NOT NULL,
  `tgl_masuk` date NOT NULL,
  `time_in` time DEFAULT NULL,
  `break_out` time DEFAULT NULL,
  `break_in` time DEFAULT NULL,
  `time_out` time DEFAULT NULL,
  `break_overtime_out` time DEFAULT NULL,
  `break_overtime_in` time DEFAULT NULL,
  `overtime_out` time DEFAULT NULL,
  `deleted` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `hr_timesheet`
--

INSERT INTO `hr_timesheet` (`id`, `nik`, `tgl_masuk`, `time_in`, `break_out`, `break_in`, `time_out`, `break_overtime_out`, `break_overtime_in`, `overtime_out`, `deleted`) VALUES
(15, 7, '2025-07-30', '07:00:00', '12:00:00', '13:00:00', '18:00:00', NULL, NULL, NULL, 0),
(16, 192300931051003, '2025-07-30', '07:00:00', '12:00:00', '13:00:00', '18:00:00', '18:00:00', '19:00:00', '22:00:00', 0),
(17, 8, '2025-08-04', '07:00:00', '12:00:00', '13:00:00', '18:00:00', '18:00:00', '19:00:00', '22:00:00', 0),
(18, 6, '2025-08-04', '07:00:00', '12:00:00', '13:00:00', '18:00:00', '18:00:00', '19:00:00', '22:00:00', 0),
(19, 1, '2025-08-07', '07:00:00', '12:00:00', '13:00:00', '18:00:00', '18:00:00', '19:00:00', '22:00:00', 0),
(20, 5, '2025-08-07', '07:00:00', '12:00:00', '13:00:00', '18:00:00', '18:00:00', '19:00:00', '22:00:00', 0),
(21, 6, '2025-08-07', '07:00:00', '12:00:00', '13:00:00', '18:00:00', '18:00:00', '19:00:00', '22:00:00', 0),
(22, 7, '2025-08-07', '07:00:00', '12:00:00', '13:00:00', '18:00:00', '18:00:00', '19:00:00', '22:00:00', 0),
(23, 343331232123, '2025-08-07', '07:00:00', '12:00:00', '13:00:00', '18:00:00', NULL, NULL, NULL, 0),
(24, 192300931051003, '2025-08-07', '07:00:00', '12:00:00', '13:00:00', '18:00:00', NULL, NULL, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `hr_absen`
--
ALTER TABLE `hr_absen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nik` (`nik`);

--
-- Indeks untuk tabel `hr_academic`
--
ALTER TABLE `hr_academic`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `hr_career`
--
ALTER TABLE `hr_career`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `hr_certificates`
--
ALTER TABLE `hr_certificates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `hr_disciplinary`
--
ALTER TABLE `hr_disciplinary`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `hr_document`
--
ALTER TABLE `hr_document`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `hr_employee`
--
ALTER TABLE `hr_employee`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `hr_family`
--
ALTER TABLE `hr_family`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `hr_hired`
--
ALTER TABLE `hr_hired`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `hr_motivation`
--
ALTER TABLE `hr_motivation`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `hr_reward`
--
ALTER TABLE `hr_reward`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `hr_salary`
--
ALTER TABLE `hr_salary`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `hr_timesheet`
--
ALTER TABLE `hr_timesheet`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `hr_absen`
--
ALTER TABLE `hr_absen`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=424;

--
-- AUTO_INCREMENT untuk tabel `hr_academic`
--
ALTER TABLE `hr_academic`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=795;

--
-- AUTO_INCREMENT untuk tabel `hr_career`
--
ALTER TABLE `hr_career`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=547;

--
-- AUTO_INCREMENT untuk tabel `hr_certificates`
--
ALTER TABLE `hr_certificates`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=750;

--
-- AUTO_INCREMENT untuk tabel `hr_disciplinary`
--
ALTER TABLE `hr_disciplinary`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `hr_document`
--
ALTER TABLE `hr_document`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `hr_employee`
--
ALTER TABLE `hr_employee`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `hr_family`
--
ALTER TABLE `hr_family`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=494;

--
-- AUTO_INCREMENT untuk tabel `hr_hired`
--
ALTER TABLE `hr_hired`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=844;

--
-- AUTO_INCREMENT untuk tabel `hr_motivation`
--
ALTER TABLE `hr_motivation`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `hr_reward`
--
ALTER TABLE `hr_reward`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `hr_salary`
--
ALTER TABLE `hr_salary`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=735;

--
-- AUTO_INCREMENT untuk tabel `hr_timesheet`
--
ALTER TABLE `hr_timesheet`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `hr_absen`
--
ALTER TABLE `hr_absen`
  ADD CONSTRAINT `hr_absen_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `tbl_user` (`nik`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
