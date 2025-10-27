-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 27, 2025 at 02:24 PM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wdp_core`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_produk`
--

CREATE TABLE `data_produk` (
  `prd_id` bigint(20) NOT NULL,
  `prd_kode` varchar(50) DEFAULT NULL,
  `prd_nama` varchar(255) DEFAULT NULL,
  `prd_stok` bigint(20) DEFAULT NULL,
  `prd_stok_minimal` int(11) DEFAULT NULL,
  `prd_satuan` int(11) DEFAULT NULL,
  `prd_kategori` int(11) DEFAULT NULL,
  `prd_foto` blob,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_produk`
--

INSERT INTO `data_produk` (`prd_id`, `prd_kode`, `prd_nama`, `prd_stok`, `prd_stok_minimal`, `prd_satuan`, `prd_kategori`, `prd_foto`, `created_at`, `updated_at`) VALUES
(1, 'PRD001', 'Tepung Segitiga Biru', 22, 5, 2, 2, 0x7072645f746570756e675f73656769746967615f626972752e6a7067, '2025-09-20 21:54:14', '2025-09-23 12:59:11'),
(2, 'PRD002', 'Coklat Batang Chefmate', 39, 5, 1, 3, 0x7072645f636f6b6c61745f626174616e675f636865666d6174652e6a7067, '2025-09-21 23:14:40', '2025-09-23 12:58:01'),
(3, 'PRD003', 'Keju Kraft', 5, 5, 1, 1, 0x7072645f6b656a755f6b726166742e6a7067, '2025-09-22 21:41:21', '2025-09-23 13:04:01');

-- --------------------------------------------------------

--
-- Table structure for table `data_user`
--

CREATE TABLE `data_user` (
  `log_id` bigint(20) NOT NULL,
  `log_nama` varchar(100) DEFAULT NULL,
  `log_email` varchar(100) DEFAULT NULL,
  `log_user` varchar(20) DEFAULT NULL,
  `log_pass` varchar(255) DEFAULT NULL,
  `log_level` smallint(1) DEFAULT NULL COMMENT '1=administrator, 2=admin, 3=investor',
  `log_aktif` smallint(1) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_user`
--

INSERT INTO `data_user` (`log_id`, `log_nama`, `log_email`, `log_user`, `log_pass`, `log_level`, `log_aktif`, `created_at`) VALUES
(4, 'Administrator', 'administrator@gmail.com', 'administrator', 'ea60fc010787079d8aa3163ad9ef55e8', 1, 1, '2025-09-19 23:56:02'),
(5, 'Wegi Zulianda', 'wegizul@gmail.com', 'wegizul', '827ccb0eea8a706c4c34a16891f84e7b', 3, 1, '2025-09-20 15:30:16');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_produk`
--

CREATE TABLE `kategori_produk` (
  `kp_id` int(11) NOT NULL,
  `kp_nama` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_produk`
--

INSERT INTO `kategori_produk` (`kp_id`, `kp_nama`, `created_at`) VALUES
(1, 'Keju', '2025-09-20 16:04:44'),
(2, 'Tepung', '2025-09-20 16:05:43'),
(3, 'Coklat', '2025-09-21 23:13:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_produk`
--
ALTER TABLE `data_produk`
  ADD PRIMARY KEY (`prd_id`),
  ADD KEY `prd_satuan` (`prd_satuan`),
  ADD KEY `prd_kategori` (`prd_kategori`);

--
-- Indexes for table `data_user`
--
ALTER TABLE `data_user`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
  ADD PRIMARY KEY (`kp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_produk`
--
ALTER TABLE `data_produk`
  MODIFY `prd_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `data_user`
--
ALTER TABLE `data_user`
  MODIFY `log_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
  MODIFY `kp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_produk`
--
ALTER TABLE `data_produk`
  ADD CONSTRAINT `data_produk_ibfk_1` FOREIGN KEY (`prd_satuan`) REFERENCES `satuan_barang` (`sb_id`),
  ADD CONSTRAINT `data_produk_ibfk_3` FOREIGN KEY (`prd_kategori`) REFERENCES `kategori_produk` (`kp_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
