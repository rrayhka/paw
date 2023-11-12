-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2023 at 11:41 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penjualan`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `nama_barang`, `harga`, `stok`, `supplier_id`) VALUES
(1, 'FD001', 'Barang A', 20000, 50, 1),
(2, 'FD002', 'Barang B', 25000, 40, 2),
(3, 'FD003', 'Barang C', 15000, 60, 3),
(4, 'FD004', 'Barang D', 18000, 55, 4),
(5, 'FD005', 'Barang E', 22000, 48, 5),
(6, 'FD006', 'Barang F', 17000, 58, 6),
(7, 'FD007', 'Barang G', 24000, 42, 7),
(8, 'FD008', 'Barang H', 19000, 53, 8),
(9, 'FD009', 'Barang I', 21000, 46, 9),
(10, 'FD010', 'Barang J', 16000, 62, 10);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `telp` varchar(12) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `jenis_kelamin`, `telp`, `alamat`) VALUES
(1, 'Pak Samsudin', 'L', '082364795671', 'Jl. Kembang sari  no 66, Semarang'),
(2, 'Ibu Maria', 'P', '081234567890', 'Jl. Cendana no 12, Jakarta'),
(3, 'Bapak Ahmad', 'L', '085678901234', 'Jl. Merdeka no 78, Bandung'),
(4, 'Nyonya Rini', 'P', '087654321001', 'Jl. Pahlawan no 45, Surabaya'),
(5, 'Pak Budi', 'L', '082112233445', 'Jl. Gajah Mada no 9, Medan'),
(6, 'Ibu Susi', 'P', '081987654321', 'Jl. Diponegoro no 56, Yogyakarta'),
(7, 'Bapak Joko', 'L', '085678905432', 'Jl. Jawa no 23, Semarang'),
(8, 'Nyonya Lisa', 'P', '082132435466', 'Jl. Sudirman no 34, Bali'),
(9, 'Pak Agus', 'L', '081276543210', 'Jl. A. Yani no 67, Malang'),
(10, 'Ibu Dewi', 'P', '081112223334', 'Jl. Kebon Raya no 78, Solo');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `waktu_bayar` datetime NOT NULL,
  `total` int(11) NOT NULL,
  `metode` enum('TUNAI','TRANSFER','EDC') NOT NULL,
  `transaksi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `waktu_bayar`, `total`, `metode`, `transaksi_id`) VALUES
(1, '2023-10-19 13:09:29', 140000, 'TUNAI', 1),
(2, '2023-10-19 14:30:45', 175000, 'TRANSFER', 2),
(3, '2023-10-20 10:15:22', 125000, 'TUNAI', 3),
(4, '2023-10-20 16:42:57', 160000, 'TRANSFER', 4),
(5, '2023-10-21 12:05:36', 185000, 'TUNAI', 5),
(6, '2023-10-21 15:20:59', 135000, 'EDC', 6),
(7, '2023-10-22 11:40:18', 170000, 'TUNAI', 7),
(8, '2023-10-22 14:57:47', 120000, 'TRANSFER', 8),
(9, '2023-10-23 10:30:15', 155000, 'EDC', 9),
(10, '2023-10-23 17:15:40', 190000, 'TRANSFER', 10);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `telp` varchar(12) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `telp`, `alamat`) VALUES
(1, 'supplier 1', '082364795675', 'jl. kasman no 34, Surabaya'),
(2, 'Supplier 2', '081234567890', 'Jl. Mawar no 12, Jakarta'),
(3, 'Supplier 3', '085678901234', 'Jl. Merdeka no 78, Bandung'),
(4, 'Supplier 4', '087654321001', 'Jl. Pahlawan no 45, Surabaya'),
(5, 'Supplier 5', '082112233445', 'Jl. Gajah Mada no 9, Medan'),
(6, 'Supplier 6', '081987654321', 'Jl. Diponegoro no 56, Yogyakarta'),
(7, 'Supplier 7', '085678905432', 'Jl. Jawa no 23, Semarang'),
(8, 'Supplier 8', '082132435466', 'Jl. Sudirman no 34, Bali'),
(9, 'Supplier 9', '081276543210', 'Jl. A. Yani no 67, Malang'),
(10, 'Supplier 10', '081112223334', 'Jl. Kebon Raya no 78, Solo');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `waktu_transaksi` date NOT NULL,
  `keterangan` text NOT NULL,
  `total` int(11) NOT NULL,
  `pelanggan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `waktu_transaksi`, `keterangan`, `total`, `pelanggan_id`) VALUES
(24, '2023-11-09', 'Test 2', 290000, 3),
(27, '2023-11-09', 'Test 2', 165000, 5),
(28, '2023-11-09', 'Test 2', 325000, 4),
(29, '2023-11-09', 'Tes', 30000, 3),
(30, '2023-11-09', 'Tes', 30000, 3),
(31, '2023-11-09', 'Tes', 70000, 5),
(32, '2023-11-09', 'Tes', 126000, 2),
(33, '2023-11-09', 'Tes', 123000, 4),
(34, '2023-11-09', 'Tes', 187000, 8),
(35, '2023-11-09', 'Tes', 166000, 6),
(37, '2023-11-10', 'Test', 210000, 4),
(38, '2023-11-10', 'Test', 174000, 7),
(39, '2023-11-10', 'Test', 152000, 9),
(40, '2023-11-10', 'Test', 117000, 6),
(41, '2023-11-10', 'Test', 233000, 9),
(42, '2023-11-10', 'Test', 45000, 8),
(43, '2023-11-11', 'Test', 447000, 3),
(44, '2023-11-11', 'Test', 63000, 4),
(45, '2023-11-11', 'Test', 233000, 7),
(46, '2023-11-11', 'Test', 315000, 6),
(47, '2023-11-11', 'Test', 200000, 4),
(48, '2023-11-11', 'Test', 483000, 6),
(49, '2023-11-11', 'Test', 148000, 8),
(50, '2023-11-11', 'Test', 96000, 8);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `transaksi_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`transaksi_id`, `barang_id`, `harga`, `qty`) VALUES
(24, 2, 50000, 2),
(24, 3, 30000, 2),
(24, 5, 66000, 3),
(24, 7, 72000, 3),
(24, 10, 48000, 3),
(24, 11, 24000, 2),
(27, 3, 45000, 3),
(27, 7, 120000, 5),
(28, 3, 75000, 5),
(28, 4, 54000, 3),
(28, 6, 34000, 2),
(28, 7, 120000, 5),
(28, 9, 42000, 2),
(29, 3, 30000, 2),
(30, 3, 30000, 2),
(31, 4, 36000, 2),
(31, 6, 34000, 2),
(32, 1, 40000, 2),
(32, 7, 48000, 2),
(32, 8, 38000, 2),
(33, 3, 30000, 2),
(33, 4, 36000, 2),
(33, 8, 57000, 3),
(34, 6, 34000, 2),
(34, 7, 48000, 2),
(34, 9, 105000, 5),
(35, 7, 96000, 4),
(35, 8, 38000, 2),
(35, 10, 32000, 2),
(37, 4, 72000, 4),
(37, 6, 119000, 7),
(37, 8, 19000, 1),
(38, 3, 75000, 5),
(38, 6, 51000, 3),
(38, 7, 48000, 2),
(39, 5, 66000, 3),
(39, 8, 38000, 2),
(39, 10, 48000, 3),
(40, 5, 66000, 3),
(40, 6, 51000, 3),
(41, 4, 54000, 3),
(41, 5, 88000, 4),
(41, 6, 34000, 2),
(41, 8, 57000, 3),
(42, 3, 45000, 3),
(43, 4, 54000, 3),
(43, 5, 198000, 9),
(43, 6, 51000, 3),
(43, 7, 144000, 6),
(44, 9, 63000, 3),
(45, 5, 176000, 8),
(45, 8, 57000, 3),
(46, 2, 150000, 6),
(46, 6, 51000, 3),
(46, 8, 114000, 6),
(47, 4, 36000, 2),
(47, 5, 44000, 2),
(47, 7, 120000, 5),
(48, 4, 144000, 8),
(48, 5, 44000, 2),
(48, 6, 119000, 7),
(48, 7, 48000, 2),
(48, 10, 128000, 8),
(49, 6, 34000, 2),
(49, 7, 72000, 3),
(49, 9, 42000, 2),
(50, 7, 96000, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` tinyint(2) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(35) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `hp` varchar(20) NOT NULL,
  `level` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `alamat`, `hp`, `level`) VALUES
(1, 'samsudin', '1234556', 'pak samsudin', 'jl.kusuma bangsa no 23, Bangkalan', '082153746281', 1),
(2, 'Maria', '7890123', 'Ibu Maria', 'Jl. Cendana no 12, Jakarta', '081234567890', 1),
(3, 'Ahmad', '4567890', 'Bapak Ahmad', 'Jl. Merdeka no 78, Bandung', '085678901234', 4),
(4, 'Rini', '4321001', 'Nyonya Rini', 'Jl. Pahlawan no 45, Surabaya', '087654321001', 1),
(5, 'Budi', '12233445', 'Pak Budi', 'Jl. Gajah Mada no 9, Medan', '082112233445', 2),
(6, 'Susi', '987654321', 'Ibu Susi', 'Jl. Diponegoro no 56, Yogyakarta', '081987654321', 3),
(7, 'Joko', '5678905432', 'Bapak Joko', 'Jl. Jawa no 23, Semarang', '085678905432', 4),
(8, 'Lisa', '2132435466', 'Nyonya Lisa', 'Jl. Sudirman no 34, Bali', '082132435466', 3),
(9, 'Agus', '76543210', 'Pak Agus', 'Jl. A. Yani no 67, Malang', '081276543210', 2),
(10, 'Dewi', '112223334', 'Ibu Dewi', 'Jl. Kebon Raya no 78, Solo', '081112223334', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_id` (`transaksi_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelanggan_id` (`pelanggan_id`);

--
-- Indexes for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`transaksi_id`,`barang_id`),
  ADD KEY `transaksi_id` (`transaksi_id`,`barang_id`),
  ADD KEY `barang_id` (`barang_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`);

--
-- Constraints for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `transaksi_detail_ibfk_1` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_detail_ibfk_2` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
