-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2023 at 01:42 AM
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
-- Database: `meet10`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL,
  `nama_menu` varchar(50) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `nama_menu`, `harga`, `kategori`) VALUES
(1, 'Es Jeruk', 12000.00, 'Minuman'),
(2, 'Chicken Alfredo', 14000.00, 'Makanan'),
(3, 'Margherita Pizza', 10000.00, 'Makanan'),
(4, 'Cheeseburger', 9000.00, 'Makanan'),
(5, 'Coca Cola', 15000.00, 'Minuman'),
(6, 'Es Teh', 8000.00, 'Minuman'),
(9, 'Iga Bakar', 25000.00, 'Makanan');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `nama_pembeli` varchar(255) NOT NULL,
  `makanan` varchar(255) NOT NULL,
  `harga` int(10) NOT NULL,
  `tanggal_order` date NOT NULL,
  `jam_order` time NOT NULL,
  `nama_pelayan` varchar(50) NOT NULL,
  `nomor_meja` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `menu_id`, `nama_pembeli`, `makanan`, `harga`, `tanggal_order`, `jam_order`, `nama_pelayan`, `nomor_meja`) VALUES
(14, 2, 'Putin', 'Chicken Alfredo', 14000, '2023-10-27', '10:10:00', 'Galih', 9),
(15, 5, 'Selly', 'Coca Cola', 15000, '2023-10-28', '10:10:00', 'Galih', 7),
(16, 4, 'Sabil', 'Cheeseburger', 9000, '2023-10-23', '12:34:00', 'Dika', 5),
(17, 5, 'Putri', 'Coca Cola', 15000, '2023-10-23', '12:43:00', 'Galih', 8),
(18, 2, 'Akhyar', 'Chicken Alfredo', 14000, '2023-10-28', '12:32:00', 'Galih', 3),
(19, 9, 'Islam Makhachev', 'Iga Bakar', 25000, '2023-10-26', '06:29:09', 'Abdul', 3),
(20, 6, 'Kabib Nurmagomedov', 'Es Teh', 8000, '2023-10-26', '06:29:56', 'Galih', 4),
(21, 1, 'Ilham', 'Es Jeruk', 12000, '2023-10-25', '10:23:00', 'Galih', 4),
(22, 9, 'Joe Biden', 'Iga Bakar', 25000, '2023-10-25', '21:34:00', 'Komeng', 4),
(23, 4, 'Jokowi', 'Cheeseburger', 9000, '2023-10-24', '06:05:00', 'Komeng', 7);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `order_detail_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`order_detail_id`, `order_id`, `menu_id`) VALUES
(12, 14, 3),
(13, 15, 5),
(14, 16, 4),
(15, 17, 5),
(16, 18, 2),
(17, 19, 9),
(18, 20, 6),
(19, 21, 9),
(20, 22, 4),
(21, 23, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`order_detail_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`menu_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
