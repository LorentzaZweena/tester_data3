-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2024 at 05:38 AM
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
-- Database: `db_produk`
--

-- --------------------------------------------------------

--
-- Table structure for table `finishing`
--

CREATE TABLE `finishing` (
  `id_finishing` int(11) NOT NULL,
  `finishing` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `finishing`
--

INSERT INTO `finishing` (`id_finishing`, `finishing`) VALUES
(1, 'PBS'),
(2, 'HBS'),
(3, 'HBHP'),
(4, 'PBHP'),
(5, 'PBH'),
(6, 'ABS');

-- --------------------------------------------------------

--
-- Table structure for table `kasir`
--

CREATE TABLE `kasir` (
  `id_kasir` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kasir`
--

INSERT INTO `kasir` (`id_kasir`, `nama`, `password`) VALUES
(1, 'Sawal', '123'),
(2, 'Dila', '123'),
(3, 'caca', '123'),
(4, 'divan', '123'),
(5, 'yudhi', '123'),
(6, 'andri', '123');

-- --------------------------------------------------------

--
-- Table structure for table `kota`
--

CREATE TABLE `kota` (
  `id_kota` int(11) NOT NULL,
  `kota` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kota`
--

INSERT INTO `kota` (`id_kota`, `kota`) VALUES
(1, 'Bogor'),
(2, 'Jakarta pusat'),
(3, 'Jakarta barat'),
(4, 'Jakarta selatan'),
(5, 'Jakarta timur'),
(6, 'Jakarta utara'),
(7, 'BSD / Serpong'),
(8, 'Cibubur'),
(9, 'Bekasi'),
(10, 'Depok'),
(11, 'Lintas kota'),
(12, 'Tangerang');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id_payment` int(11) NOT NULL,
  `payment` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id_payment`, `payment`) VALUES
(1, 'Tunai'),
(2, 'TF');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `material` varchar(50) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `ukuran` varchar(50) NOT NULL,
  `finishing` varchar(20) NOT NULL,
  `harga_modal` varchar(20) NOT NULL,
  `harga_jual` varchar(20) NOT NULL,
  `jumlah_stok` int(30) NOT NULL,
  `id_kota` int(11) DEFAULT NULL,
  `id_sumber` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `material`, `nama_produk`, `ukuran`, `finishing`, `harga_modal`, `harga_jual`, `jumlah_stok`, `id_kota`, `id_sumber`) VALUES
(1, 'teraso', 'silinder', '30x30', 'HBS', '100000', '300000', 10, NULL, NULL),
(2, 'teraso', 'silinder', '40x40', 'HBS', '200000', '450000', 10, NULL, NULL),
(3, 'teraso', 'silinder', '50x50', 'PBH', '300000', '600000', 10, NULL, NULL),
(4, 'teraso', 'META Pak Tani Besar', '45 x 45', 'PBS', '100000', '300000', 12, NULL, NULL),
(5, 'teraso', 'TNM Palm kuning ', '20 x 20', 'PBS', '200000', '500000', 20, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sistem_kasir`
--

CREATE TABLE `sistem_kasir` (
  `id_sistem` int(11) NOT NULL,
  `Tanggal` date NOT NULL DEFAULT current_timestamp(),
  `Kasir` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `Pembayaran` varchar(10) NOT NULL,
  `Customer` varchar(50) NOT NULL,
  `no_hp` varchar(30) NOT NULL,
  `Alamat` varchar(50) NOT NULL,
  `Kota` varchar(50) NOT NULL,
  `Sumber` varchar(30) NOT NULL,
  `produk_item` varchar(50) NOT NULL,
  `QTY` int(40) NOT NULL,
  `harga_per_item` varchar(30) NOT NULL,
  `spending_total` varchar(40) NOT NULL,
  `Discount` varchar(50) NOT NULL,
  `each_total` varchar(20) NOT NULL,
  `grand_total` varchar(20) NOT NULL,
  `delivery` varchar(20) NOT NULL,
  `packing` int(20) NOT NULL,
  `id_kasir` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_sumber` int(11) NOT NULL,
  `id_kota` int(11) NOT NULL,
  `id_payment` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `id_finishing` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sistem_kasir`
--

INSERT INTO `sistem_kasir` (`id_sistem`, `Tanggal`, `Kasir`, `status`, `Pembayaran`, `Customer`, `no_hp`, `Alamat`, `Kota`, `Sumber`, `produk_item`, `QTY`, `harga_per_item`, `spending_total`, `Discount`, `each_total`, `grand_total`, `delivery`, `packing`, `id_kasir`, `id_produk`, `id_sumber`, `id_kota`, `id_payment`, `id_status`, `id_finishing`) VALUES
(3, '2024-07-29', 'Caca', 'Online', 'TF', 'tes lagi', '12345678912', 'Papua', 'Bogor', 'IG', 'silinder', 5, '22000', '400000', '15%', '6000', '70000', '80000', 5000, 3, 1, 2, 5, 1, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `statusnya`
--

CREATE TABLE `statusnya` (
  `id_status` int(11) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `statusnya`
--

INSERT INTO `statusnya` (`id_status`, `status`) VALUES
(1, 'Online'),
(2, 'Offline');

-- --------------------------------------------------------

--
-- Table structure for table `sumber`
--

CREATE TABLE `sumber` (
  `id_sumber` int(11) NOT NULL,
  `sumber` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sumber`
--

INSERT INTO `sumber` (`id_sumber`, `sumber`) VALUES
(1, 'Toko'),
(2, 'IG'),
(3, 'Google'),
(4, 'Referensi'),
(5, 'Tiktok'),
(6, 'Facebook'),
(7, 'Youtube');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `finishing`
--
ALTER TABLE `finishing`
  ADD PRIMARY KEY (`id_finishing`);

--
-- Indexes for table `kasir`
--
ALTER TABLE `kasir`
  ADD PRIMARY KEY (`id_kasir`);

--
-- Indexes for table `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`id_kota`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id_payment`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `sistem_kasir`
--
ALTER TABLE `sistem_kasir`
  ADD PRIMARY KEY (`id_sistem`),
  ADD KEY `id_kasir` (`id_kasir`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_sumber` (`id_sumber`),
  ADD KEY `id_kota` (`id_kota`),
  ADD KEY `id_payment` (`id_payment`),
  ADD KEY `id_status` (`id_status`),
  ADD KEY `id_finishing` (`id_finishing`);

--
-- Indexes for table `statusnya`
--
ALTER TABLE `statusnya`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `sumber`
--
ALTER TABLE `sumber`
  ADD PRIMARY KEY (`id_sumber`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `finishing`
--
ALTER TABLE `finishing`
  MODIFY `id_finishing` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kasir`
--
ALTER TABLE `kasir`
  MODIFY `id_kasir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kota`
--
ALTER TABLE `kota`
  MODIFY `id_kota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id_payment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sistem_kasir`
--
ALTER TABLE `sistem_kasir`
  MODIFY `id_sistem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `statusnya`
--
ALTER TABLE `statusnya`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sumber`
--
ALTER TABLE `sumber`
  MODIFY `id_sumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sistem_kasir`
--
ALTER TABLE `sistem_kasir`
  ADD CONSTRAINT `sistem_kasir_ibfk_1` FOREIGN KEY (`id_kota`) REFERENCES `kota` (`id_kota`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sistem_kasir_ibfk_2` FOREIGN KEY (`id_finishing`) REFERENCES `finishing` (`id_finishing`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sistem_kasir_ibfk_3` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sistem_kasir_ibfk_4` FOREIGN KEY (`id_sumber`) REFERENCES `sumber` (`id_sumber`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sistem_kasir_ibfk_5` FOREIGN KEY (`id_payment`) REFERENCES `payment` (`id_payment`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sistem_kasir_ibfk_6` FOREIGN KEY (`id_kasir`) REFERENCES `kasir` (`id_kasir`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sistem_kasir_ibfk_7` FOREIGN KEY (`id_status`) REFERENCES `statusnya` (`id_status`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
