-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 04 Jan 2023 pada 15.30
-- Versi server: 10.3.37-MariaDB-0ubuntu0.20.04.1
-- Versi PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tokojam`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barangs`
--

CREATE TABLE `barangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `stok` bigint(20) NOT NULL DEFAULT 0,
  `gambar` text NOT NULL DEFAULT '/img/produk/sample.jpeg',
  `qrcode` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `barangs`
--

INSERT INTO `barangs` (`id`, `kode`, `nama`, `kategori_id`, `stok`, `gambar`, `qrcode`, `created_at`, `updated_at`) VALUES
(3, 'JD-01', 'OGANA 8888', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-01 14:46:29', '2023-01-04 03:14:11'),
(4, 'JD-02', 'OGANA 8899', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-01 14:49:03', '2023-01-04 03:14:31'),
(5, 'JD-03', 'OGANA 8866', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-01 14:49:49', '2023-01-04 02:36:52'),
(6, 'JD-04', 'OGANA 8989', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-01 14:50:07', '2023-01-01 14:50:07'),
(7, 'JD-05', 'ROBIN 400', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-01 14:50:44', '2023-01-01 14:50:44'),
(8, 'JD-06', 'ROBIN 500', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-01 14:51:03', '2023-01-01 14:51:03'),
(9, 'JD-07', 'STANDARD 100', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-01 15:10:18', '2023-01-01 15:10:18'),
(10, 'JD-08', 'OGANA 901', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-01 15:10:58', '2023-01-04 03:14:52'),
(11, 'JD-09', 'OGANA 8877', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-01 15:11:23', '2023-01-03 09:09:27'),
(12, 'JD-10', 'VIVALDI WHITE', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-01 15:30:01', '2023-01-01 15:30:01'),
(13, 'JD-11', 'VIVALDI mickey', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-01 15:30:17', '2023-01-01 15:30:17'),
(14, 'JD-12', 'VIVALDI HELLO KITTY', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-01 15:30:35', '2023-01-01 15:30:35'),
(15, 'JD-13', 'VIVALDI DORAEMON', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-01 15:30:54', '2023-01-01 15:30:54'),
(16, 'JD-14', 'ROBIN 917', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-01 15:34:46', '2023-01-01 15:34:46'),
(17, 'JD-15', 'ROBIN 941', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-01 15:37:05', '2023-01-01 15:37:05'),
(18, 'JD-16', 'ROBIN 960', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 02:26:21', '2023-01-02 02:26:21'),
(19, 'JD-17', 'ROBIN 1005', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 02:26:39', '2023-01-02 02:26:39'),
(20, 'JD-18', 'ROBIN 935', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 02:27:46', '2023-01-02 02:27:46'),
(21, 'JD-19', 'ROBIN 936', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 02:28:12', '2023-01-02 02:28:12'),
(22, 'JD-20', 'ASAHI 203 AS', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 02:29:04', '2023-01-03 05:03:37'),
(23, 'JD-21', 'ROBIN 1008', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 02:29:39', '2023-01-02 02:29:39'),
(24, 'JD-22', 'ROBIN 1006', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 02:30:06', '2023-01-02 02:30:06'),
(25, 'JD-23', 'ROBIN 978', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 02:31:00', '2023-01-02 02:31:00'),
(26, 'JD-24', 'ROBIN 1036', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 02:32:56', '2023-01-02 02:34:25'),
(27, 'JD-25', 'ROBIN 1019', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 02:34:47', '2023-01-02 02:34:47'),
(28, 'JD-26', 'ROBIN 977', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 02:36:31', '2023-01-02 02:36:31'),
(29, 'JD-27', 'ROBIN 938', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 02:37:36', '2023-01-02 02:37:36'),
(30, 'JD-28', 'ROBIN 921', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 02:46:15', '2023-01-02 02:46:15'),
(31, 'JD-29', 'ROBIN 979', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 02:46:33', '2023-01-02 03:19:50'),
(32, 'JD-30', 'ROBIN 869', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 07:14:14', '2023-01-02 07:14:14'),
(33, 'JD-31', 'ROBIN 1015', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 07:15:20', '2023-01-02 07:15:20'),
(34, 'JD-32', 'ROBIN 1009', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 07:16:32', '2023-01-02 07:16:32'),
(35, 'JD-33', 'ROBIN 971', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 07:17:17', '2023-01-02 07:17:17'),
(36, 'JD-34', 'ROBIN 876', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 07:18:04', '2023-01-02 07:18:49'),
(37, 'JD-35', 'ROBIN 884', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 07:19:20', '2023-01-02 07:19:20'),
(38, 'JD-36', 'ROBIN 1025', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 07:20:21', '2023-01-02 07:20:21'),
(39, 'JD-37', 'ROBIN 460', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 07:21:04', '2023-01-02 07:21:04'),
(40, 'JD-38', 'ROBIN 420', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 07:21:30', '2023-01-02 07:23:01'),
(41, 'JD-39', 'ASAHI 388', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 07:23:53', '2023-01-02 07:23:53'),
(42, 'JD-40', 'ASAHI 788', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 07:24:10', '2023-01-02 07:24:10'),
(43, 'JD-41', 'ASAHI 588', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 07:25:02', '2023-01-02 07:25:02'),
(44, 'JD-42', 'ASAHI 090', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 07:25:22', '2023-01-02 07:25:22'),
(45, 'JD-43', 'ROBIN 961', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 07:25:51', '2023-01-02 07:25:51'),
(46, 'JD-44', 'ROBIN 868', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 07:26:39', '2023-01-02 07:26:39'),
(47, 'JD-45', 'ROBIN 852', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 07:27:45', '2023-01-02 07:27:45'),
(48, 'JD-46', 'ROBIN 1031', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 07:28:03', '2023-01-02 07:28:03'),
(49, 'JD-47', 'ROBIN 1032', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 07:31:18', '2023-01-02 07:31:18'),
(50, 'JD-48', 'ROBIN 962', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 07:31:35', '2023-01-02 07:31:35'),
(51, 'JD-49', 'ROBIN 9310', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 07:32:03', '2023-01-02 07:32:03'),
(52, 'JD-50', 'ROBIN 937', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 07:32:28', '2023-01-02 07:32:28'),
(53, 'JD-51', 'STANDARD 134', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 07:33:02', '2023-01-02 07:33:02'),
(54, 'JD-52', 'STANDARD 101', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 07:34:35', '2023-01-02 07:34:35'),
(55, 'JD-53', 'STANDARD 110', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 07:34:55', '2023-01-02 07:34:55'),
(56, 'JD-54', 'STANDARD 111', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 07:35:10', '2023-01-02 07:35:10'),
(57, 'JD-55', 'STANDARD 114', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 07:35:26', '2023-01-02 07:35:26'),
(58, 'JD-56', 'STANDARD 115', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 07:35:42', '2023-01-02 07:35:42'),
(59, 'JD-57', 'STANDARD 117', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 07:36:04', '2023-01-02 07:36:04'),
(60, 'JD-58', 'STANDARD 118', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 07:37:01', '2023-01-02 07:37:01'),
(61, 'JD-59', 'STANDARD 122', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 07:37:17', '2023-01-02 07:37:17'),
(62, 'JD-60', 'STANDARD 129', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 07:37:42', '2023-01-02 07:37:42'),
(63, 'JD-61', 'STANDARD 130', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 07:38:00', '2023-01-02 07:38:00'),
(64, 'JD-62', 'STANDARD 131', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 07:39:13', '2023-01-02 07:39:13'),
(65, 'JD-63', 'Jam Asahi 132', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 07:39:27', '2023-01-02 07:39:27'),
(66, 'JD-64', 'STANDARD 204', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 07:41:26', '2023-01-02 07:41:26'),
(67, 'JD-65', 'STANDARD 450', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 07:41:42', '2023-01-02 07:41:42'),
(68, 'JD-66', 'STANDARD 453', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 07:42:10', '2023-01-02 07:42:10'),
(69, 'JD-67', 'STANDARD 461', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 07:42:37', '2023-01-02 07:42:37'),
(70, 'JD-69', 'STANDARD 133', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 07:43:41', '2023-01-02 07:43:41'),
(71, 'JD-70', 'STANDARD 102', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 07:43:56', '2023-01-02 07:43:56'),
(72, 'JD-71', 'STANDARD 121', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 07:44:25', '2023-01-02 07:44:25'),
(73, 'JD-72', 'STANDARD 104', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 07:45:29', '2023-01-02 07:45:29'),
(74, 'JD-73', 'STANDARD 103', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 07:46:01', '2023-01-02 07:46:01'),
(75, 'JD-74', 'STANDARD 123', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 07:46:18', '2023-01-02 07:46:18'),
(76, 'JD-75', 'STANDARD 119', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-02 07:46:41', '2023-01-02 07:46:41'),
(77, 'JD-76', 'ROBIN 866', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-03 08:55:26', '2023-01-03 08:55:26'),
(78, 'JD-77', 'ROBIN 430', 1, 0, 'img/produk/sample.jpeg', NULL, '2023-01-03 08:55:51', '2023-01-03 08:55:51'),
(79, 'JT-01', 'JOSE ALEXANDER Tgl', 2, 0, 'img/produk/sample.jpeg', NULL, '2023-01-03 08:57:29', '2023-01-03 08:57:29'),
(80, 'JT-02', 'POSITIF', 2, 0, 'img/produk/sample.jpeg', NULL, '2023-01-03 08:58:03', '2023-01-03 08:58:03'),
(81, 'JT-03', 'RABBANI', 2, 0, 'img/produk/sample.jpeg', NULL, '2023-01-03 08:58:15', '2023-01-03 08:58:15'),
(82, 'JT-04', 'JOSE ALEXANDER Rt', 2, 0, 'img/produk/sample.jpeg', NULL, '2023-01-03 08:59:35', '2023-01-03 08:59:35');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barangs`
--
ALTER TABLE `barangs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barangs`
--
ALTER TABLE `barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
