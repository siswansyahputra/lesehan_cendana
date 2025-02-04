-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 30, 2025 at 01:31 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_cafe`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id` int NOT NULL,
  `id_penjualan` int NOT NULL,
  `id_menu` int NOT NULL,
  `jumlah` int NOT NULL,
  `harga` int NOT NULL,
  `diskon` int NOT NULL,
  `total` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `identitas`
--

CREATE TABLE `identitas` (
  `id` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `identitas`
--

INSERT INTO `identitas` (`id`, `nama`, `alamat`, `telepon`) VALUES
(1, 'Lesehan Cendana', 'Jl. Binjai-Kuala, Pekan Selesai, Kec. Selesai, Kabupaten Langkat, Sumatera Utara 20761', '0821-6230-2689');

-- --------------------------------------------------------

--
-- Table structure for table `meja`
--

CREATE TABLE `meja` (
  `id` int NOT NULL,
  `nama_meja` char(25) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `meja`
--

INSERT INTO `meja` (`id`, `nama_meja`, `created_at`, `updated_at`) VALUES
(4, 'Meja 1', '2025-01-28 10:17:59', '2025-01-28 10:17:59'),
(5, 'Meja 2', '2025-01-28 10:41:03', '2025-01-28 10:41:03'),
(6, 'Meja 3', '2025-01-28 10:44:22', '2025-01-28 10:44:22');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int NOT NULL,
  `nama_menu` varchar(255) NOT NULL,
  `harga` int NOT NULL,
  `diskon` int NOT NULL,
  `status` enum('1','0') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `kategori` char(25) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `nama_menu`, `harga`, `diskon`, `status`, `kategori`, `created_at`, `updated_at`) VALUES
(1, 'Bebek Bakar Utuh', 85000, 0, '1', 'Makanan', NULL, NULL),
(2, 'Bebek Geprek Utuh', 85000, 0, '1', 'Makanan', NULL, NULL),
(3, 'Bebek Bakar', 37000, 0, '1', 'Makanan', NULL, NULL),
(4, 'Bebek Penyet', 35000, 0, '1', 'Makanan', NULL, NULL),
(5, 'Ayam Bakar Utuh', 65000, 0, '1', 'Makanan', NULL, NULL),
(6, 'Ayam Geprek Utuh', 65000, 0, '1', 'Makanan', NULL, NULL),
(7, 'Ayam Bakar + Nasi', 25000, 0, '1', 'Makanan', NULL, NULL),
(8, 'Ayam Kremes + Nasi', 25000, 0, '1', 'Makanan', NULL, NULL),
(9, 'Ikan Bakar + Nasi', 26000, 0, '1', 'Makanan', NULL, NULL),
(10, 'Bebek Penyet + Nasi', 40000, 0, '1', 'Makanan', NULL, NULL),
(11, 'Nila Asam Manis', 46000, 0, '1', 'Makanan', NULL, NULL),
(12, 'Nila Bakar', 40000, 0, '1', 'Makanan', NULL, NULL),
(13, 'Nasi Putih', 5000, 0, '1', 'Makanan', NULL, NULL),
(14, 'Capcai Seafood', 25000, 0, '1', 'Makanan', NULL, NULL),
(15, 'Cah Kangkung', 15000, 0, '1', 'Makanan', NULL, NULL),
(16, 'Sop Ayam', 20000, 0, '1', 'Makanan', NULL, NULL),
(17, 'Bakso Mercon Indomie/Mie Hun', 28000, 0, '1', 'Makanan', NULL, NULL),
(18, 'Bakso Beranak Indomie/Mie Hun', 28000, 0, '1', 'Makanan', NULL, NULL),
(19, 'Bakso Kosong Mercon', 28000, 0, '1', 'Makanan', NULL, NULL),
(20, 'Bakso Kosong Beranak', 28000, 0, '1', 'Makanan', NULL, NULL),
(21, 'Bakso Kosong Urat', 28000, 0, '1', 'Makanan', NULL, NULL),
(22, 'Mie Ayam Bakso Mercon', 30000, 0, '1', 'Makanan', NULL, NULL),
(23, 'Mie Ayam Bakso Beranak', 33000, 0, '1', 'Makanan', NULL, NULL),
(24, 'Mie Ayam Bakso Urat', 30000, 0, '1', 'Makanan', NULL, NULL),
(25, 'Nasi Goreng Biasa', 16000, 0, '1', 'Makanan', NULL, NULL),
(26, 'Nasi Goreng Spesial', 20000, 0, '1', 'Makanan', NULL, NULL),
(27, 'Nasi Goreng Kampung Biasa', 18000, 0, '1', 'Makanan', NULL, NULL),
(28, 'Nasi Goreng Kampung Spesial', 22000, 0, '1', 'Makanan', NULL, NULL),
(29, 'Mie Goreng', 18000, 0, '1', 'Makanan', NULL, NULL),
(30, 'Mie Kuah', 18000, 0, '1', 'Makanan', NULL, NULL),
(31, 'Indomie Goreng', 15000, 0, '1', 'Makanan', NULL, NULL),
(32, 'Indomie Kuah', 15000, 0, '1', 'Makanan', NULL, NULL),
(33, 'Snack Kentang Goreng', 15000, 0, '1', 'Snack', NULL, NULL),
(34, 'Snack Tempe Goreng', 14000, 0, '1', 'Snack', NULL, NULL),
(35, 'Snack Nugget', 15000, 0, '1', 'Snack', NULL, NULL),
(36, 'Snack Sosis Goreng', 14000, 0, '1', 'Snack', NULL, NULL),
(37, 'Snack Sosis Bakar', 15000, 0, '1', 'Snack', NULL, NULL),
(38, 'Snack Scallop', 14000, 0, '1', 'Snack', NULL, NULL),
(39, 'Snack Pisang Coklat Keju', 15000, 0, '1', 'Snack', NULL, NULL),
(40, 'Jus Alpukat', 16000, 0, '1', 'Minuman', NULL, NULL),
(41, 'Jus Jeruk', 13000, 0, '1', 'Minuman', NULL, NULL),
(42, 'Jus Markisa', 12000, 0, '1', 'Minuman', NULL, NULL),
(43, 'Jus Anggur Belanda', 12000, 0, '1', 'Minuman', NULL, NULL),
(44, 'Jus Martabe', 12000, 0, '1', 'Minuman', NULL, NULL),
(45, 'Jus Sirsak', 12000, 0, '1', 'Minuman', NULL, NULL),
(46, 'Jus Jambu Merah', 12000, 0, '1', 'Minuman', NULL, NULL),
(47, 'Jus Buah Naga', 13000, 0, '1', 'Minuman', NULL, NULL),
(48, 'Jus Timun Serut', 12000, 0, '1', 'Minuman', NULL, NULL),
(49, 'Jus Mangga', 13000, 0, '1', 'Minuman', NULL, NULL),
(50, 'Teh Manis (Hot)', 3000, 0, '1', 'Minuman', NULL, NULL),
(51, 'Teh Manis (Dingin)', 3000, 0, '1', 'Minuman', NULL, NULL),
(52, 'Apple Tea (Hot)', 12000, 0, '1', 'Minuman', NULL, NULL),
(53, 'Apple Tea (Dingin)', 15000, 0, '1', 'Minuman', NULL, NULL),
(54, 'Lemon Tea (Hot)', 12000, 0, '1', 'Minuman', NULL, NULL),
(55, 'Lemon Tea (Dingin)', 15000, 0, '1', 'Minuman', NULL, NULL),
(56, 'Lychee Tea (Hot)', 12000, 0, '1', 'Minuman', NULL, NULL),
(57, 'Lychee Tea (Dingin)', 15000, 0, '1', 'Minuman', NULL, NULL),
(58, 'Teh Tarik (Hot)', 12000, 0, '1', 'Minuman', NULL, NULL),
(59, 'Teh Tarik (Dingin)', 15000, 0, '1', 'Minuman', NULL, NULL),
(60, 'Teh Hijau (Hot)', 12000, 0, '1', 'Minuman', NULL, NULL),
(61, 'Teh Hijau (Dingin)', 15000, 0, '1', 'Minuman', NULL, NULL),
(62, 'Choco Caramel Oreo', 17000, 0, '1', 'Minuman', NULL, NULL),
(63, 'Choco Hazelnut Oreo', 17000, 0, '1', 'Minuman', NULL, NULL),
(64, 'Vanilla Oreo', 17000, 0, '1', 'Minuman', NULL, NULL),
(65, 'Hazelnut Oreo', 17000, 0, '1', 'Minuman', NULL, NULL),
(66, 'Taro Bland', 15000, 0, '1', 'Minuman', NULL, NULL),
(67, 'Red Velvet Bland', 15000, 0, '1', 'Minuman', NULL, NULL),
(68, 'Matcha Bland', 15000, 0, '1', 'Minuman', NULL, NULL),
(69, 'Honey Kasturi Cendana', 15000, 0, '1', 'Minuman', NULL, NULL),
(70, 'Kopi Herbal Cendana', 12000, 0, '1', 'Minuman', NULL, NULL),
(71, 'Teh Wembang Jahe', 12000, 0, '1', 'Minuman', NULL, NULL),
(72, 'Es Teler Cendana', 22000, 0, '1', 'Minuman', NULL, NULL),
(73, 'Manggo-Manggo Cendana', 22000, 0, '1', 'Minuman', NULL, NULL),
(74, 'Kopi Sanger (Panas)', 10000, 0, '1', 'Minuman', NULL, NULL),
(75, 'Kopi Sanger (Dingin)', 10000, 0, '1', 'Minuman', NULL, NULL),
(76, 'Americano (Panas)', 10000, 0, '1', 'Minuman', NULL, NULL),
(77, 'Americano (Dingin)', 10000, 0, '1', 'Minuman', NULL, NULL),
(78, 'Kopi Hitam (Panas)', 8000, 0, '1', 'Minuman', NULL, NULL),
(79, 'Kopi Hitam (Dingin)', 8000, 0, '1', 'Minuman', NULL, NULL),
(80, 'Cappuccino (Panas)', 13000, 0, '1', 'Minuman', NULL, NULL),
(81, 'Cappuccino (Dingin)', 13000, 0, '1', 'Minuman', NULL, NULL),
(82, 'Es Kopi Cendana', 13000, 0, '1', 'Minuman', NULL, NULL),
(83, 'Milk Shake Taro (Panas)', 13000, 0, '1', 'Minuman', NULL, NULL),
(84, 'Milk Shake Taro (Dingin)', 15000, 0, '1', 'Minuman', NULL, NULL),
(85, 'Milk Shake Red Velvet (Panas)', 13000, 0, '1', 'Minuman', NULL, NULL),
(86, 'Milk Shake Red Velvet (Dingin)', 15000, 0, '1', 'Minuman', NULL, NULL),
(87, 'Milk Shake Choco (Panas)', 13000, 0, '1', 'Minuman', NULL, NULL),
(88, 'Milk Shake Choco (Dingin)', 15000, 0, '1', 'Minuman', NULL, NULL),
(89, 'Milk Shake Matcha (Panas)', 13000, 0, '1', 'Minuman', NULL, NULL),
(90, 'Milk Shake Matcha (Dingin)', 15000, 0, '1', 'Minuman', NULL, NULL),
(91, 'Mineral', 6000, 0, '1', 'Minuman', NULL, NULL),
(92, 'Es Botol Sosro', 6000, 0, '1', 'Minuman', NULL, NULL),
(93, 'Fruit Tea', 6000, 0, '1', 'Minuman', NULL, NULL),
(94, 'Air Hangat', 2000, 0, '1', 'Minuman', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int NOT NULL,
  `tanggal` timestamp NOT NULL,
  `total_diskon` int NOT NULL,
  `total_pembayaran` int NOT NULL,
  `id_meja` int NOT NULL,
  `tunai` int DEFAULT NULL,
  `kembalian` int DEFAULT NULL,
  `catatan` text,
  `status` char(25) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indexes for table `identitas`
--
ALTER TABLE `identitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meja`
--
ALTER TABLE `meja`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_meja` (`id_meja`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `identitas`
--
ALTER TABLE `identitas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `meja`
--
ALTER TABLE `meja`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`id_meja`) REFERENCES `meja` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
