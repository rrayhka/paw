-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2023 at 01:38 PM
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
-- Database: `db_rumahsakit`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_dokter`
--

CREATE TABLE `tb_dokter` (
  `id_dokter` varchar(50) NOT NULL,
  `nama_dokter` varchar(80) NOT NULL,
  `spesialis` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_telp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_dokter`
--

INSERT INTO `tb_dokter` (`id_dokter`, `nama_dokter`, `spesialis`, `alamat`, `no_telp`) VALUES
('DOC1', 'Dr. Smith', 'Cardiologist', '123 Main Street', '123-456-7890'),
('DOC10', 'Dr. Anderson', 'ENT Specialist', '123 Oak Street', '999-888-7777'),
('DOC2', 'Dr. Johnson', 'Pediatrician', '456 Elm Street', '987-654-3210'),
('DOC3', 'Dr. Williams', 'Dermatologist', '789 Oak Street', '111-222-3333'),
('DOC4', 'Dr. Brown', 'Orthopedic Surgeon', '234 Pine Street', '555-666-7777'),
('DOC5', 'Dr. Davis', 'Ophthalmologist', '567 Birch Street', '999-888-7777'),
('DOC6', 'Dr. Wilson', 'Neurologist', '890 Pine Street', '777-888-9999'),
('DOC7', 'Dr. Lee', 'Gynecologist', '345 Cedar Street', '333-444-5555'),
('DOC8', 'Dr. Garcia', 'Psychiatrist', '678 Birch Street', '222-111-3333'),
('DOC9', 'Dr. Martinez', 'Urologist', '567 Elm Street', '666-555-4444');

-- --------------------------------------------------------

--
-- Table structure for table `tb_obat`
--

CREATE TABLE `tb_obat` (
  `id_obat` varchar(50) NOT NULL,
  `nama_obat` varchar(200) NOT NULL,
  `keterangan_obat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_obat`
--

INSERT INTO `tb_obat` (`id_obat`, `nama_obat`, `keterangan_obat`) VALUES
('OB1', 'Aspirin', 'Pain and Fever Relief'),
('OB10', 'Naproxen', 'Pain and Inflammation Relief'),
('OB2', 'Amoxicillin', 'Antibiotic'),
('OB3', 'Hydrocortisone Cream', 'Topical Anti-Inflammatory'),
('OB4', 'Ibuprofen', 'Nonsteroidal Anti-Inflammatory Drug (NSAID)'),
('OB5', 'Eye Drops', 'Ophthalmic Solution for Eye Irritation'),
('OB6', 'Lisinopril', 'Blood Pressure Medication'),
('OB7', 'Simvastatin', 'Cholesterol-Lowering Medication'),
('OB8', 'Prozac', 'Antidepressant Medication'),
('OB9', 'Ciprofloxacin', 'Antibiotic for Infections');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pasien`
--

CREATE TABLE `tb_pasien` (
  `id_pasien` varchar(50) NOT NULL,
  `nomor_pasien` varchar(30) NOT NULL,
  `nama_pasien` varchar(80) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_telp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pasien`
--

INSERT INTO `tb_pasien` (`id_pasien`, `nomor_pasien`, `nama_pasien`, `jenis_kelamin`, `alamat`, `no_telp`) VALUES
('PAT1', 'P001', 'John Smith', 'L', '123 Oak Avenue', '555-123-4567'),
('PAT10', 'P010', 'Ava Foster', 'P', '345 Elm Avenue', '777-777-7777'),
('PAT2', 'P002', 'Emma Johnson', 'P', '456 Elm Street', '111-222-3333'),
('PAT3', 'P003', 'Michael Williams', 'L', '789 Maple Street', '999-888-7777'),
('PAT4', 'P004', 'Olivia Brown', 'P', '234 Pine Street', '777-666-5555'),
('PAT5', 'P005', 'Liam Davis', 'L', '567 Cedar Street', '888-777-9999'),
('PAT6', 'P006', 'Sophia Adams', 'P', '234 Maple Avenue', '555-555-5555'),
('PAT7', 'P007', 'Mia Baker', 'P', '678 Oak Avenue', '444-444-4444'),
('PAT8', 'P008', 'Lucas Clark', 'L', '789 Cedar Avenue', '333-333-3333'),
('PAT9', 'P009', 'James Evans', 'L', '890 Pine Avenue', '666-666-6666');

-- --------------------------------------------------------

--
-- Table structure for table `tb_poliklinik`
--

CREATE TABLE `tb_poliklinik` (
  `id_poli` varchar(50) NOT NULL,
  `nama_poli` varchar(50) NOT NULL,
  `gedung` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_poliklinik`
--

INSERT INTO `tb_poliklinik` (`id_poli`, `nama_poli`, `gedung`) VALUES
('POLI1', 'Cardiology', 'Main Building'),
('POLI10', 'Otolaryngology', 'North Wing'),
('POLI2', 'Pediatrics', 'East Wing'),
('POLI3', 'Dermatology', 'South Wing'),
('POLI4', 'Orthopedics', 'West Wing'),
('POLI5', 'Ophthalmology', 'North Wing'),
('POLI6', 'Neurology', 'East Wing'),
('POLI7', 'Obstetrics & Gynecology', 'Main Building'),
('POLI8', 'Psychiatry', 'South Wing'),
('POLI9', 'Urology', 'West Wing');

-- --------------------------------------------------------

--
-- Table structure for table `tb_rekammedis`
--

CREATE TABLE `tb_rekammedis` (
  `id_rm` varchar(50) NOT NULL,
  `id_pasien` varchar(50) NOT NULL,
  `keluhan` text NOT NULL,
  `id_dokter` varchar(50) NOT NULL,
  `diagnosa` text NOT NULL,
  `id_poli` varchar(50) NOT NULL,
  `tgl_periksa` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rekammedis`
--

INSERT INTO `tb_rekammedis` (`id_rm`, `id_pasien`, `keluhan`, `id_dokter`, `diagnosa`, `id_poli`, `tgl_periksa`) VALUES
('RM1', 'PAT1', 'Fever and Headache', 'DOC1', 'Flu', 'POLI1', '2023-01-15'),
('RM10', 'PAT10', 'sakit hati', 'DOC7', 'dongo', 'POLI6', '2023-11-04'),
('RM2', 'PAT2', 'Chest Pain', 'DOC2', 'Pneumonia', 'POLI2', '2023-02-10'),
('RM3', 'PAT3', 'Skin Rash', 'DOC3', 'Eczema', 'POLI3', '2023-03-20'),
('RM4', 'PAT4', 'Knee Pain', 'DOC4', 'Arthritis', 'POLI4', '2023-04-05'),
('RM5', 'PAT5', 'Eye Irritation', 'DOC5', 'Conjunctivitis', 'POLI5', '2023-05-12'),
('RM6', 'PAT6', 'Back Pain', 'DOC6', 'Sciatica', 'POLI1', '2023-06-10'),
('RM7', 'PAT7', 'Pregnancy Checkup', 'DOC7', 'Healthy Pregnancy', 'POLI2', '2023-07-20'),
('RM8', 'PAT10', 'adfasdfsaf', 'DOC7', 'sdfgsdfgsg', 'POLI6', '2023-11-16');

-- --------------------------------------------------------

--
-- Table structure for table `tb_rm_obat`
--

CREATE TABLE `tb_rm_obat` (
  `id_rm_obat` varchar(50) NOT NULL,
  `id_rm` varchar(50) NOT NULL,
  `id_obat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rm_obat`
--

INSERT INTO `tb_rm_obat` (`id_rm_obat`, `id_rm`, `id_obat`) VALUES
('RM1', 'RM1', 'OB1'),
('RM2', 'RM2', 'OB2'),
('RM3', 'RM3', 'OB3'),
('RM4', 'RM4', 'OB4'),
('RM5', 'RM5', 'OB5'),
('RM6', 'RM6', 'OB6'),
('RM7', 'RM7', 'OB7');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` varchar(50) NOT NULL,
  `nama_user` varchar(80) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` enum('1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama_user`, `username`, `password`, `level`) VALUES
('USR1', 'Admin User', 'admin', 'adminpass', '1'),
('USR10', 'Security', 'security', 'securitypass', '2'),
('USR2', 'Receptionist 1', 'receptionist1', 'recep1pass', '2'),
('USR3', 'Receptionist 2', 'receptionist2', 'recep2pass', '2'),
('USR4', 'Doctor 1', 'doctor1', 'doc1pass', '2'),
('USR5', 'Doctor 2', 'doctor2', 'doc2pass', '2'),
('USR6', 'Nurse 1', 'nurse1', 'nurse1pass', '2'),
('USR7', 'Nurse 2', 'nurse2', 'nurse2pass', '2'),
('USR8', 'Pharmacist', 'pharmacist', 'pharmacistpass', '2'),
('USR9', 'Accountant', 'accountant', 'accountantpass', '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_dokter`
--
ALTER TABLE `tb_dokter`
  ADD PRIMARY KEY (`id_dokter`);

--
-- Indexes for table `tb_obat`
--
ALTER TABLE `tb_obat`
  ADD PRIMARY KEY (`id_obat`);

--
-- Indexes for table `tb_pasien`
--
ALTER TABLE `tb_pasien`
  ADD PRIMARY KEY (`id_pasien`);

--
-- Indexes for table `tb_poliklinik`
--
ALTER TABLE `tb_poliklinik`
  ADD PRIMARY KEY (`id_poli`);

--
-- Indexes for table `tb_rekammedis`
--
ALTER TABLE `tb_rekammedis`
  ADD PRIMARY KEY (`id_rm`),
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `id_dokter` (`id_dokter`),
  ADD KEY `id_poli` (`id_poli`);

--
-- Indexes for table `tb_rm_obat`
--
ALTER TABLE `tb_rm_obat`
  ADD PRIMARY KEY (`id_rm_obat`),
  ADD KEY `id_rm` (`id_rm`),
  ADD KEY `id_obat` (`id_obat`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_rekammedis`
--
ALTER TABLE `tb_rekammedis`
  ADD CONSTRAINT `tb_rekammedis_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `tb_pasien` (`id_pasien`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_rekammedis_ibfk_2` FOREIGN KEY (`id_dokter`) REFERENCES `tb_dokter` (`id_dokter`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_rekammedis_ibfk_3` FOREIGN KEY (`id_poli`) REFERENCES `tb_poliklinik` (`id_poli`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_rm_obat`
--
ALTER TABLE `tb_rm_obat`
  ADD CONSTRAINT `tb_rm_obat_ibfk_1` FOREIGN KEY (`id_rm`) REFERENCES `tb_rekammedis` (`id_rm`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_rm_obat_ibfk_2` FOREIGN KEY (`id_obat`) REFERENCES `tb_obat` (`id_obat`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
