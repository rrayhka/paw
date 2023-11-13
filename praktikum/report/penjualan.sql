-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2023 at 02:02 PM
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
(1, '2023-11-09', 'Lunas', 208000, 3),
(2, '2023-11-09', 'Lunas', 257000, 3),
(3, '2023-11-09', 'Lunas', 343000, 4),
(4, '2023-11-09', 'Lunas', 233000, 4),
(5, '2023-11-10', 'Lunas', 418000, 7),
(6, '2023-11-10', 'Lunas', 295000, 4),
(7, '2023-11-11', 'Lunas', 329000, 5),
(8, '2023-11-11', 'Lunas', 373000, 6),
(9, '2023-11-11', 'Lunas', 259000, 4),
(10, '2023-11-11', 'Lunas', 264000, 9);

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
(1, 1, 40000, 2),
(1, 2, 50000, 2),
(1, 4, 18000, 1),
(1, 5, 66000, 3),
(1, 6, 34000, 2),
(2, 2, 50000, 2),
(2, 3, 45000, 3),
(2, 4, 54000, 3),
(2, 6, 51000, 3),
(2, 8, 57000, 3),
(3, 2, 75000, 3),
(3, 5, 88000, 4),
(3, 6, 51000, 3),
(3, 7, 72000, 3),
(3, 8, 57000, 3),
(4, 2, 50000, 2),
(4, 4, 18000, 1),
(4, 5, 66000, 3),
(4, 6, 51000, 3),
(4, 7, 48000, 2),
(5, 2, 50000, 2),
(5, 4, 54000, 3),
(5, 5, 66000, 3),
(5, 7, 168000, 7),
(5, 10, 80000, 5),
(6, 4, 54000, 3),
(6, 5, 88000, 4),
(6, 7, 96000, 4),
(6, 8, 57000, 3),
(7, 4, 54000, 3),
(7, 5, 44000, 2),
(7, 7, 48000, 2),
(7, 8, 57000, 3),
(7, 9, 126000, 6),
(8, 4, 54000, 3),
(8, 5, 66000, 3),
(8, 6, 68000, 4),
(8, 8, 57000, 3),
(8, 10, 128000, 8),
(9, 3, 45000, 3),
(9, 6, 51000, 3),
(9, 8, 57000, 3),
(9, 9, 42000, 2),
(9, 10, 64000, 4),
(10, 2, 75000, 3),
(10, 5, 44000, 2),
(10, 7, 48000, 2),
(10, 8, 76000, 4),
(10, 9, 21000, 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
