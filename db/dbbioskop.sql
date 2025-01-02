-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2024 at 09:54 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbbioskop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `Nama` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `Nama`, `Email`, `password`) VALUES
(1, 'Admin', 'admin@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `theatre_id` int(11) NOT NULL,
  `show_time` datetime DEFAULT NULL,
  `show_time2` datetime DEFAULT NULL,
  `show_time3` datetime DEFAULT NULL,
  `show_time4` datetime DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `kapasitas_kursi` int(11) DEFAULT NULL,
  `studio_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id`, `movie_id`, `theatre_id`, `show_time`, `show_time2`, `show_time3`, `show_time4`, `price`, `created_at`, `updated_at`, `kapasitas_kursi`, `studio_id`) VALUES
(1, 1, 1, '2024-11-30 05:11:18', '2024-12-20 15:24:37', '2024-11-30 13:24:37', NULL, 20000.00, '2024-12-07 04:12:03', '2024-12-20 02:31:43', 30, 1),
(2, 3, 3, '2024-12-02 03:39:16', NULL, NULL, NULL, 25000.00, '2024-12-02 02:39:49', '2024-12-24 08:10:24', 25, 4),
(3, 5, 2, '2024-12-02 03:49:13', NULL, NULL, NULL, 23000.00, '2024-12-02 02:49:51', '2024-12-17 06:22:08', 20, 3),
(4, 4, 3, '2024-12-02 03:50:35', NULL, NULL, NULL, 30000.00, '2024-12-02 02:51:10', '2024-12-17 06:22:40', 20, 4),
(5, 2, 1, '2024-12-02 03:52:23', '2024-12-17 15:18:19', '2024-12-17 18:18:19', '2024-12-17 20:18:19', 15000.00, '2024-12-02 02:52:49', '2024-12-17 06:18:59', 40, 2),
(6, 8, 1, '2024-12-12 10:18:57', '2024-12-12 15:18:57', '2024-12-12 19:18:57', '2024-12-12 21:18:57', 30000.00, '2024-12-12 03:20:09', '2024-12-17 06:21:02', 100, 4),
(8, 6, 2, '2024-12-17 03:06:33', '2024-12-10 09:06:33', '2024-12-17 12:06:33', '2024-12-17 16:06:33', 30000.00, '2024-12-17 02:07:48', '2024-12-17 02:07:48', 40, 4),
(13, 17, 1, NULL, '2024-12-24 15:36:00', '2024-12-24 18:36:00', '2024-12-24 20:36:00', 0.00, '2024-12-24 06:37:04', '2024-12-24 06:37:04', NULL, 1),
(14, 11, 2, NULL, '2024-12-24 21:28:00', '2024-12-24 19:28:00', '2024-12-24 23:28:00', 0.00, '2024-12-24 07:29:12', '2024-12-24 07:29:12', NULL, 2),
(15, 9, 1, NULL, '2024-12-24 16:45:00', '2024-12-24 18:45:00', '2024-12-24 19:45:00', 0.00, '2024-12-24 07:45:23', '2024-12-24 07:45:23', NULL, 3),
(16, 6, 4, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, '2024-12-24 08:16:58', '2024-12-24 08:16:58', NULL, 5);

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `synopsis` text DEFAULT NULL,
  `duration` int(11) NOT NULL,
  `genre` varchar(100) DEFAULT NULL,
  `poster_url` varchar(255) DEFAULT NULL,
  `trailer_url` varchar(255) DEFAULT NULL,
  `Tahun_Rilis` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `title`, `synopsis`, `duration`, `genre`, `poster_url`, `trailer_url`, `Tahun_Rilis`) VALUES
(1, 'Flow', 'Bahasa Indonesia – Kucing adalah hewan yang suka menyendiri, tetapi karena rumahnya hancur akibat', 85, 'action', '676a5760dfdbb_flow.jpg', 'https://youtu.be/W9MZk7LWokI', 2024),
(2, 'Gladiator II', 'nyoba aja si', 85, 'comedy', '676a576d9b9aa_gladiator2.jpg', 'www.youtube.com', 2024),
(3, 'Death Whisperer 2', 'Tiga tahun setelah kematian Yam, Yak masih terus memburu Roh Hitam yang telah merenggut nyawa saudara perempuannya. Terlepas dari upaya keluarganya untuk meyakinkannya agar berhenti membalas dendam kepada Roh Hitam, Yak tetap keras kepala, bertekad untuk melacaknya, karena takut hantu itu akan kembali mencelakai anggota keluarganya yang masih hidup.', 112, 'horror', '676a577d31957_deathwhisperer2.jpg', 'https://youtu.be/nR_Xntr_XKo?si=KFnw7o0Mb2qq1OTs', 2024),
(4, 'konco konco edan ', 'Mamet (Dimas Kusnandi), Kubil (Sepriadi), dan Bolay (Alfin Dwi Krisnandi), yang menamai diri mereka Makuboyz, bekerja di toko emas milik Kartolo (Pritt Timothy), kakek Mamet yang eksentrik. Pada suatu hari Kartolo meminta Makuboyz untuk melakukan sebuah misi dengan hadiah besar—warisan toko emas!\r\n\r\nNamun, perjalanan untuk menyelesaikan misi itu tidaklah mudah. Makuboyz harus menghadapi berbagai rintangan, mulai dari hantu perempuan penasaran yang tak henti mengganggu hingga seorang penjahat berbahaya yang ternyata memiliki hubungan dengan pemandu mereka. Apakah Makuboyz akan berhasil atau malah terjebak dalam kekacauan yang semakin edan?', 85, 'comedy', '676a578ce50c9_konco2edan.jpg', 'https://youtu.be/CHiP1B7CBIo?si=XSB9tnEqvYjjhZWp', 2024),
(5, 'Gladiator II', 'Setelah rumah dan keluarganya dihancurkan, Lucius (Paul Mescal), cucu dari mantan Kaisar Romawi Marcus Aurelius dan juga putra dari Lucilla (Connie Nielsen) memasuki Colosseum dan melihat ke masa lalunya untuk menemukan kekuatan dan mengembalikan kejayaan Roma kepada rakyatnya.', 114, 'action', '676a579d27ee7_gladiator2.jpg', 'https://youtu.be/4rgYUipGJNo?si=m2xrwSBG_-JKvZ1o', 2024),
(6, 'a boy called christmas', 'Film ini menceritakan petualangan seorang anak bernama Nikolas yang melakukan perjalanan luar biasa di tengah turunnya salju untuk mencari ayahnya. Nikolas berhadapan dengan banyak hal ajaib dan menawan tak terduga saat singgah di desa peri bernama Elfhelm1. Dalam perjalanannya, Nikolas berkenalan dengan seekor rusa keras bernama Blitzen dan seekor tikus yang setia. Film ini penuh dengan magis dan humor, serta mengajarkan pesan bahwa tidak ada yang mustahil jika kita memiliki imajinasi dan keberanian', 106, 'action', '676a585a7d359_a boy called crishmast.jpg', 'https://youtu.be/aFI_aiidke0?si=CWxMXx7KwknP68LA', 2021),
(7, 'moana4', 'adandkanasicnaicnaefce', 85, 'comedy', '676a5803af632_moana2.jpg', 'https://youtu.be/hDZ7y8RP5HE?si=Tkh_dH0_ADhzqJhD', 2024),
(8, 'Wicked', 'Dua penyihir dengan ciri yang berbeda, Glinda (Ariana Grande) dan Elphaba Cynthia Erivo). Glinda adalah sosok populer, istimewa, dengan ambisi tinggi. Sementara Elphaba sering di pandang sebelah mata, karena kulitnya yang hijau. Takdir mempertemukan keduanya sebagai mahasiswa di Universitas Shiz. Keduanya bersahabat hingga akhirnya harus memilih jalan berbeda.', 160, 'fantasy', '676a57f361d5a_6757beb0896fa-wicked.jpg', 'https://youtu.be/6COmYeLsz4c?si=T_R9LRvk9fgCDoPv', 2024),
(9, 'Sonic the Hedgehog 3', 'Sonic, Knuckles, dan Tails bersatu melawan musuh baru yang kuat, Shadow, penjahat misterius dengan kekuatan yang belum pernah mereka hadapi sebelumnya. Karena kemampuan musuh tidak tertandingi, Tim Sonic harus mencari teman lain yang tidak terduga.', 109, 'action', '676a57c536629_6757c0ef299d7-sonic3.jpg', 'https://youtu.be/1-1AqB9hOCw?si=pVZsjm3UP7eazgXU', 2024),
(10, 'eva pendakian terakhir', 'PASHA (Kiesha Alvaro) mengajak EVA (Bulan Sutena) pacarnya untuk naik gunung bersama NISA (Ashira Zamita), VICKY (Ilham Aji Santoso), dan JONI (Axel Matthew Thomas) yang menjadi leadernya. Sayangnya, diantara mereka ada yang melanggar beberapa pantangan saat naik gunung, sehingga Eva dan teman-temannya pun mengalami masalah dan gangguan luar biasa dari penghuni ghaib gunung yang mereka daki. Vicky yang kesurupan, Eva yang menghilang secara ghaib, dll. Keadaan kian mencekam saat mereka bertemu TENRI (Hanna Kinasih) seorang perempuan yang dipasung akibat dianggap mengikuti aliran sesat bapaknya yang menjadi sekutu iblis gunung. Maka petaka besar pun terjadi pada Eva dan teman-temannya serta warga dusun di kaki gunung.', 85, 'horror', '676a5715bc5f2_evapendakianterakhir.jpg', 'https://youtu.be/M7nOUS8k9gU?si=a624M5X9MNMhrPfc', 2025),
(11, 'mufasa - The Lion King', 'Mufasa, seekor anak singa yang tersesat dan sendirian, bertemu dengan seekor singa bernama Taka, pewaris garis keturunan bangsawan. Pertemuan tak disengaja ini memulai perjalanan kelompok yang unik namun luar biasa dalam mencari takdir mereka.', 118, 'adventure', '676a5731a3a8b_mufasa.jpg', 'https://youtu.be/o17MF9vnabg?si=ZNrNWuRvczKHjP8o', 2024),
(17, 'musafa', 'musafa wok', 113, 'adventure', 'mufasa.jpg', 'www', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `movies_id` int(11) NOT NULL,
  `theatres_id` int(11) NOT NULL,
  `studio_id` int(11) NOT NULL,
  `jadwal_id` int(11) NOT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `order_at` timestamp NULL DEFAULT current_timestamp(),
  `tickets_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `movies_id`, `theatres_id`, `studio_id`, `jadwal_id`, `total`, `order_at`, `tickets_id`) VALUES
(7, 1, 1, 1, 1, 20000.00, '2024-12-23 03:44:17', 0),
(8, 1, 1, 1, 1, 20000.00, NULL, 0),
(9, 1, 1, 1, 1, 20000.00, NULL, 0),
(10, 1, 1, 1, 1, 20000.00, NULL, 0),
(11, 1, 1, 1, 1, 20000.00, NULL, 0),
(12, 1, 1, 1, 1, 20000.00, NULL, 0),
(13, 1, 1, 1, 1, 20000.00, NULL, 0),
(14, 1, 1, 1, 1, 20000.00, NULL, 0),
(15, 1, 1, 1, 1, 20000.00, NULL, 0),
(16, 1, 1, 1, 1, 20000.00, NULL, 0),
(17, 1, 1, 1, 1, 80000.00, NULL, 0),
(19, 1, 1, 1, 1, 20000.00, NULL, 0),
(20, 1, 1, 1, 1, 20000.00, '2024-12-23 06:53:13', 0),
(21, 1, 1, 1, 1, 20000.00, '2024-12-24 06:52:01', 0),
(22, 1, 1, 1, 1, 40000.00, '2024-12-26 03:37:11', 0),
(23, 1, 1, 1, 1, 20000.00, '2024-12-26 03:50:59', 0),
(24, 1, 1, 1, 1, 20000.00, '2024-12-26 03:58:54', 0),
(25, 1, 1, 1, 1, 20000.00, '2024-12-26 04:14:34', 0),
(26, 1, 1, 1, 1, 20000.00, '2024-12-26 06:16:39', 0),
(27, 1, 1, 1, 1, 20000.00, '2024-12-26 07:06:02', 0),
(28, 1, 1, 1, 1, 20000.00, '2024-12-26 07:07:56', 0),
(29, 1, 1, 1, 1, 20000.00, '2024-12-26 07:11:58', 0),
(30, 1, 1, 1, 1, 20000.00, '2024-12-26 07:14:38', 0),
(31, 1, 1, 1, 1, 20000.00, '2024-12-26 07:19:49', 0),
(32, 1, 1, 1, 1, 20000.00, '2024-12-26 07:20:51', 0),
(33, 3, 3, 4, 2, 25000.00, '2024-12-26 07:25:30', 0),
(34, 1, 1, 1, 1, 20000.00, '2024-12-26 08:03:25', 0);

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `id` int(11) NOT NULL,
  `theatres_id` int(11) NOT NULL,
  `studio_id` int(11) NOT NULL,
  `jadwal_id` int(11) NOT NULL,
  `seat_number` varchar(255) NOT NULL,
  `status` enum('available','booked') DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`id`, `theatres_id`, `studio_id`, `jadwal_id`, `seat_number`, `status`) VALUES
(0, 2, 1, 1, 'A29', 'available'),
(1, 1, 1, 1, 'A1', 'booked'),
(2, 3, 4, 4, 'A2', 'available'),
(3, 1, 1, 1, 'A2', 'booked'),
(4, 1, 1, 1, 'A3', 'booked'),
(5, 1, 1, 1, 'A4', 'booked'),
(6, 1, 1, 1, 'A5', 'booked'),
(7, 1, 1, 1, 'A6', 'booked'),
(8, 1, 1, 1, 'A7', 'booked'),
(9, 1, 1, 1, 'A8', 'booked'),
(10, 1, 1, 1, 'A9', 'booked'),
(11, 1, 1, 1, 'A10', 'booked'),
(12, 1, 1, 1, 'A11', 'booked'),
(13, 1, 1, 1, 'A12', 'booked'),
(14, 1, 1, 1, 'A13', 'booked'),
(15, 1, 1, 1, 'A14', 'booked'),
(16, 1, 1, 1, 'A15', 'booked'),
(17, 1, 1, 1, 'A16', 'booked'),
(18, 1, 1, 1, 'A17', 'booked'),
(19, 1, 1, 1, 'A18', 'booked'),
(20, 1, 1, 1, 'A19', 'booked'),
(21, 1, 1, 1, 'A20', 'booked'),
(22, 1, 1, 1, 'A21', 'booked'),
(23, 1, 1, 1, 'A22', 'booked'),
(24, 1, 1, 1, 'A23', 'booked'),
(25, 1, 1, 1, 'A24', 'available'),
(26, 1, 1, 1, 'A25', 'available'),
(27, 1, 1, 1, 'A26', 'available'),
(28, 1, 1, 1, 'A27', 'booked'),
(29, 1, 1, 1, 'A28', 'available'),
(31, 2, 1, 1, 'A30', 'available'),
(32, 2, 1, 1, 'A31', 'available'),
(33, 2, 1, 1, 'A32', 'available'),
(34, 2, 1, 1, 'A33', 'available'),
(35, 2, 1, 1, 'A34', 'available'),
(36, 2, 1, 1, 'A35', 'booked'),
(37, 2, 1, 1, 'A36', 'available'),
(38, 2, 1, 1, 'A37', 'available'),
(39, 2, 1, 1, 'A38', 'available'),
(40, 2, 1, 1, 'A39', 'available'),
(41, 2, 1, 1, 'A40', 'available'),
(42, 2, 1, 1, 'A41', 'available'),
(43, 2, 1, 1, 'A42', 'available'),
(44, 2, 1, 1, 'A43', 'available'),
(45, 2, 1, 1, 'A44', 'available'),
(46, 2, 1, 1, 'A45', 'available'),
(47, 2, 1, 1, 'A46', 'available'),
(48, 2, 1, 1, 'A47', 'available'),
(49, 2, 1, 1, 'A48', 'booked'),
(50, 2, 1, 1, 'A49', 'booked'),
(51, 2, 1, 1, 'A50', 'available'),
(52, 2, 1, 1, 'A51', 'available'),
(53, 2, 1, 1, 'A52', 'available'),
(54, 2, 1, 1, 'A53', 'available'),
(55, 2, 1, 1, 'A54', 'available'),
(56, 2, 1, 1, 'A55', 'available'),
(57, 2, 1, 1, 'A56', 'available'),
(58, 2, 1, 1, 'A57', 'available'),
(59, 2, 1, 1, 'A58', 'available'),
(60, 2, 1, 1, 'A59', 'available'),
(61, 2, 1, 1, 'A60', 'available'),
(62, 2, 1, 1, 'A61', 'available'),
(63, 2, 1, 1, 'A62', 'available'),
(64, 2, 1, 1, 'A63', 'available'),
(65, 2, 1, 1, 'A64', 'available'),
(66, 2, 1, 1, 'A65', 'booked'),
(67, 2, 1, 1, 'A66', 'booked'),
(68, 2, 1, 1, 'A67', 'booked'),
(69, 2, 1, 1, 'A68', 'available'),
(70, 2, 1, 1, 'A69', 'available'),
(71, 2, 1, 1, 'A70', 'available'),
(72, 2, 1, 1, 'A71', 'available'),
(73, 2, 1, 1, 'A72', 'available'),
(74, 2, 1, 1, 'A73', 'available'),
(75, 2, 1, 1, 'A74', 'available'),
(76, 2, 1, 1, 'A75', 'available'),
(77, 2, 1, 1, 'A76', 'available'),
(78, 2, 1, 1, 'A77', 'available'),
(79, 2, 1, 1, 'A78', 'available'),
(80, 2, 1, 1, 'A79', 'available'),
(81, 2, 1, 1, 'A80', 'available'),
(82, 2, 1, 1, 'A81', 'available'),
(83, 2, 1, 1, 'A82', 'available'),
(84, 2, 1, 1, 'A83', 'available'),
(85, 2, 1, 1, 'A84', 'available'),
(86, 2, 1, 1, 'A85', 'available'),
(87, 2, 1, 1, 'A86', 'available'),
(88, 2, 1, 1, 'A87', 'available'),
(89, 2, 1, 1, 'A88', 'available'),
(90, 2, 1, 1, 'A89', 'available'),
(91, 2, 1, 1, 'A90', 'available'),
(92, 2, 1, 1, 'A91', 'booked'),
(93, 2, 1, 1, 'A92', 'available'),
(94, 2, 1, 1, 'A93', 'available'),
(95, 2, 1, 1, 'A94', 'available'),
(96, 2, 1, 1, 'A95', 'available'),
(97, 2, 1, 1, 'A96', 'available'),
(98, 2, 1, 1, 'A97', 'available'),
(99, 2, 1, 1, 'A98', 'available'),
(100, 2, 1, 1, 'A99', 'available'),
(101, 2, 1, 1, 'A100', 'available'),
(102, 3, 4, 2, 'B1', 'booked'),
(103, 3, 4, 2, 'B2', 'available'),
(105, 1, 3, 15, 'C1', 'available'),
(106, 1, 3, 15, 'C2', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `studio`
--

CREATE TABLE `studio` (
  `id_studio` int(11) NOT NULL,
  `id_theatres` int(11) NOT NULL,
  `nama_studio` varchar(255) NOT NULL,
  `kapasitas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studio`
--

INSERT INTO `studio` (`id_studio`, `id_theatres`, `nama_studio`, `kapasitas`) VALUES
(1, 1, 'sekys1', 140),
(2, 2, 'ncs1', 130),
(3, 1, 'ccx1', 100),
(4, 3, 'amba1', 120),
(5, 4, 'sekys2', 130);

-- --------------------------------------------------------

--
-- Table structure for table `theatres`
--

CREATE TABLE `theatres` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `contact` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `kapasitas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `theatres`
--

INSERT INTO `theatres` (`id`, `name`, `location`, `contact`, `created_at`, `updated_at`, `kapasitas`) VALUES
(1, 'CENTRAL CITY XXI', 'UNGARAN', '08123456', '2024-11-29 02:24:06', '2024-12-26 07:29:28', 50),
(2, 'nsc salatiga', 'SALATIGA', '098123456', '2024-11-30 02:48:27', '2024-12-14 02:39:27', 30),
(3, 'AmbarawaXXI', 'AMBARAWA', '08123456', '2024-11-30 07:11:55', '2024-11-30 07:11:55', 20),
(4, 'theater sekys', 'AMBARAWA', '123456', '2024-12-14 04:58:39', '2024-12-14 04:58:39', 200);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `idtiket` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `jadwal_id` int(11) NOT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `seat_number` varchar(10) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL,
  `ticket_code` varchar(255) DEFAULT NULL,
  `refund_status` enum('Ya','Tidak') DEFAULT 'Tidak'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`idtiket`, `movie_id`, `jadwal_id`, `customer_name`, `customer_email`, `seat_number`, `price`, `created_at`, `user_id`, `ticket_code`, `refund_status`) VALUES
(1, 3, 4, 'Joe', 'Jo3@gmail.com', 'A12', 20000.00, '2024-12-04 04:25:57', 7, 'Tc1', 'Ya'),
(3, 1, 1, 'rea', 'rea3@gmail.com', 'A1', 20000.00, '2024-12-04 06:58:20', NULL, 'TICKET-674ffd8ca49f13.38531406', ''),
(5, 1, 1, 'rea', 'rea3@gmail.com', 'A2', 20000.00, '2024-12-04 06:58:42', NULL, 'TICKET-674ffda27bb307.62386505', 'Tidak'),
(23, 1, 1, 'wahyu', 'wahyu1@gmail.com', 'A3', 20000.00, '2024-12-23 03:44:17', NULL, NULL, 'Tidak'),
(24, 1, 1, 'wasa', 'wasawh0@gmail.com', 'A2', 20000.00, '2024-12-23 03:47:01', NULL, NULL, 'Tidak'),
(25, 1, 1, 'azz', 'azaza12@gmail.com', 'A14', 20000.00, '2024-12-23 03:59:53', NULL, NULL, 'Tidak'),
(26, 1, 1, 'zerald', 'zerald23@gmail.com', 'A17', 80000.00, '2024-12-23 04:04:35', NULL, NULL, 'Tidak'),
(27, 1, 1, 'zerald', 'zerald23@gmail.com', 'A18', 80000.00, '2024-12-23 04:04:36', NULL, NULL, 'Tidak'),
(28, 1, 1, 'zerald', 'zerald23@gmail.com', 'A19', 80000.00, '2024-12-23 04:04:36', NULL, NULL, 'Tidak'),
(29, 1, 1, 'zerald', 'zerald23@gmail.com', 'A20', 80000.00, '2024-12-23 04:04:36', NULL, NULL, 'Tidak'),
(32, 1, 1, 'who', 'who@gmail.com', 'A35', 20000.00, '2024-12-23 06:50:33', NULL, NULL, 'Tidak'),
(33, 1, 1, 'bb', 'bb@gmail.com', 'A27', 20000.00, '2024-12-23 06:53:14', NULL, NULL, 'Tidak'),
(34, 1, 1, 'rea', 'rea3@gmail.com', 'A91', 20000.00, '2024-12-24 06:52:01', NULL, NULL, 'Tidak'),
(35, 1, 1, 'leah', 'leah@gmail.com', 'A48', 20000.00, '2024-12-26 03:37:12', NULL, NULL, 'Tidak'),
(36, 1, 1, 'leah', 'leah@gmail.com', 'A49', 20000.00, '2024-12-26 03:37:12', NULL, NULL, 'Tidak'),
(37, 1, 1, 'rel', 'rel@gmail.com', 'A5', 20000.00, '2024-12-26 03:50:59', NULL, NULL, 'Tidak'),
(38, 1, 1, 'rel', 'rel@gmail.com', 'A6', 20000.00, '2024-12-26 03:50:59', NULL, NULL, 'Tidak'),
(39, 1, 1, 'dyren', 'dyren@gmail.com', 'A7', 20000.00, '2024-12-26 03:58:54', NULL, NULL, 'Tidak'),
(40, 1, 1, 'dyren', 'dyren@gmail.com', 'A8', 20000.00, '2024-12-26 03:58:54', NULL, NULL, 'Tidak'),
(41, 1, 1, 'Super Car Porsche v3', 'len@gmail.com', 'A65', 20000.00, '2024-12-26 04:14:34', NULL, NULL, 'Tidak'),
(42, 1, 1, 'Super Car Porsche v3', 'len@gmail.com', 'A66', 20000.00, '2024-12-26 04:14:34', NULL, NULL, 'Tidak'),
(43, 1, 1, 'Super Car Porsche v3', 'len@gmail.com', 'A67', 20000.00, '2024-12-26 04:14:35', NULL, NULL, 'Tidak'),
(44, 1, 1, 'Bagas', 'Bagas12@gmail.com', 'A23', 20000.00, '2024-12-26 06:16:39', NULL, NULL, 'Tidak'),
(45, 1, 1, 'yor', 'yor@gmail.com', 'A11', 20000.00, '2024-12-26 07:06:02', NULL, NULL, 'Tidak'),
(46, 1, 1, 'kaguya', 'kaguya@gmail.com', 'A4', 20000.00, '2024-12-26 07:07:56', NULL, NULL, 'Tidak'),
(47, 1, 1, 'yanto', 'yanto@gmail.com', 'A9', 20000.00, '2024-12-26 07:11:58', NULL, NULL, 'Tidak'),
(48, 1, 1, 'vey', 'vey@gmail.com', 'A10', 20000.00, '2024-12-26 07:14:38', NULL, NULL, 'Tidak'),
(49, 1, 1, 'ntahlah', 'ntahlah@gmail.com', 'A19', 20000.00, '2024-12-26 07:19:49', NULL, NULL, 'Tidak'),
(50, 1, 1, 'adad', 'adad@gmail.com', 'A18', 20000.00, '2024-12-26 07:20:52', NULL, NULL, 'Tidak'),
(51, 3, 2, 'ambarawa', 'ambarawa@gmail.com', 'B1', 25000.00, '2024-12-26 07:25:31', NULL, NULL, 'Tidak'),
(52, 1, 1, 'Super Car Porsche v3', 'len@gmail.com', 'A12', 20000.00, '2024-12-26 08:03:25', NULL, NULL, 'Tidak'),
(53, 1, 1, 'Super Car Porsche v3', 'len@gmail.com', 'A13', 20000.00, '2024-12-26 08:03:25', NULL, NULL, 'Tidak'),
(54, 1, 1, 'Super Car Porsche v3', 'len@gmail.com', 'A21', 20000.00, '2024-12-26 08:03:25', NULL, NULL, 'Tidak'),
(55, 1, 1, 'Super Car Porsche v3', 'len@gmail.com', 'A22', 20000.00, '2024-12-26 08:03:25', NULL, NULL, 'Tidak');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `NoHp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`, `NoHp`) VALUES
(4, 'OcynX', 'FrxxUIO23@Gmail.com', '$2y$10$NaKINVkUDPtoQqp/2GQWleFJMCbUBRHne2RiKVZaCmmpwP5hlmsYW', 'user', '2024-11-22 04:48:59', '2024-11-22 04:48:59', NULL),
(5, 'zega', 'zaki123@gmail.com', '$2y$10$WgbPLXH.taHRXqmmbphS2ON.pHAQaevLkqXm/iMp3o3U3d.KdBo2a', 'user', '2024-11-22 04:50:18', '2024-11-22 04:50:18', NULL),
(6, 'amerta', 'zerald123@gmail.com', '$2y$10$K5U9uIAtN63.7zMdCYxk.emhaAYDKLdNmVamBIwrF2rUj10dimdZG', 'user', '2024-11-22 08:33:52', '2024-11-22 08:33:52', NULL),
(7, 'longhaochen', 'caier45@gmail.com', '$2y$10$zkXEMOw.vvRHmK38NxUh1.yyK8sKnZBWLv9AapBMvPkKTWu5P3cYa', 'user', '2024-11-23 01:57:37', '2024-11-23 01:57:37', NULL),
(8, 'caier', 'longhaochen@gmail.com', '$2y$10$KlGNTtGGi/oc5eLASm09behPFtShrqYrKU/98an0UZheoJxUWpK06', 'user', '2024-11-23 02:23:34', '2024-11-23 02:23:34', NULL),
(9, 'Zerald', 'Zerald@gmail.com', '$2y$10$HHB/wwgitO9gmAhwTOmP4OZT6WpU9h1M3S42TNKaUVZ99Zn7L5S3W', 'user', '2024-11-23 04:25:14', '2024-11-23 04:25:14', NULL),
(10, 'all', 'all@gmail.com', '$2y$10$G38VR6c8djO3M8RvX6w8Qu0xbXGM3xQR2acYer71Usn6CJR1gyIvq', 'user', '2024-11-23 04:59:45', '2024-11-23 04:59:45', NULL),
(11, 'coba', 'coba@gmail.com', '$2y$10$rHR9SqGZ96W1rRo1ku93E.f3bg.BE0zz24uC8ESbTpt0WDEiuWFx2', 'user', '2024-11-25 08:18:37', '2024-11-25 08:18:37', NULL),
(12, 'user', 'coba1@gmail.com', '$2y$10$gu12woznaXH0gKpO55IXfuHCafrAcd8VyjWTwXuxwYPAJorhTUbbi', 'user', '2024-11-26 06:22:48', '2024-11-26 06:22:48', NULL),
(13, 'razza', 'razza@gmail.com', '$2y$10$Hj9yisRJ7zovIXaKgRZF1.ztwnHKg9CwxkwtZOLTe0dHE2pPpRDBy', 'user', '2024-12-03 08:40:59', '2024-12-03 08:40:59', NULL),
(14, 'len', 'len@gmail.com', '$2y$10$SkHCjaFH4VqSMbED1jDpoO8iKpG0yCLWwQiNmPPdL3JncXFY3ojPa', 'admin', '2024-12-14 04:12:55', '2024-12-14 04:12:55', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movie_id` (`movie_id`),
  ADD KEY `theatre_id` (`theatre_id`),
  ADD KEY `fk_studio_id` (`studio_id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `movies_id` (`movies_id`),
  ADD KEY `theatres_id` (`theatres_id`),
  ADD KEY `studio_id` (`studio_id`),
  ADD KEY `jadwal_id` (`jadwal_id`),
  ADD KEY `id_penjualan` (`id_penjualan`);

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `theatres_id` (`theatres_id`),
  ADD KEY `studio_id` (`studio_id`),
  ADD KEY `jadwal_id` (`jadwal_id`);

--
-- Indexes for table `studio`
--
ALTER TABLE `studio`
  ADD PRIMARY KEY (`id_studio`),
  ADD KEY `id_theatres` (`id_theatres`);

--
-- Indexes for table `theatres`
--
ALTER TABLE `theatres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`idtiket`),
  ADD UNIQUE KEY `ticket_code` (`ticket_code`),
  ADD UNIQUE KEY `unique_ticket_code` (`ticket_code`),
  ADD KEY `movie_id` (`movie_id`),
  ADD KEY `jadwal_id` (`jadwal_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `idtiket` (`idtiket`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `seats`
--
ALTER TABLE `seats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `studio`
--
ALTER TABLE `studio`
  MODIFY `id_studio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `theatres`
--
ALTER TABLE `theatres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `idtiket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `fk_studio_id` FOREIGN KEY (`studio_id`) REFERENCES `studio` (`id_studio`),
  ADD CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jadwal_ibfk_2` FOREIGN KEY (`theatre_id`) REFERENCES `theatres` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`movies_id`) REFERENCES `movies` (`id`),
  ADD CONSTRAINT `penjualan_ibfk_2` FOREIGN KEY (`theatres_id`) REFERENCES `theatres` (`id`),
  ADD CONSTRAINT `penjualan_ibfk_3` FOREIGN KEY (`studio_id`) REFERENCES `studio` (`id_studio`),
  ADD CONSTRAINT `penjualan_ibfk_4` FOREIGN KEY (`jadwal_id`) REFERENCES `jadwal` (`id`);

--
-- Constraints for table `seats`
--
ALTER TABLE `seats`
  ADD CONSTRAINT `seats_ibfk_1` FOREIGN KEY (`theatres_id`) REFERENCES `theatres` (`id`),
  ADD CONSTRAINT `seats_ibfk_2` FOREIGN KEY (`studio_id`) REFERENCES `studio` (`id_studio`),
  ADD CONSTRAINT `seats_ibfk_3` FOREIGN KEY (`jadwal_id`) REFERENCES `jadwal` (`id`);

--
-- Constraints for table `studio`
--
ALTER TABLE `studio`
  ADD CONSTRAINT `studio_ibfk_1` FOREIGN KEY (`id_theatres`) REFERENCES `theatres` (`id`);

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`),
  ADD CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`jadwal_id`) REFERENCES `jadwal` (`id`),
  ADD CONSTRAINT `tickets_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
