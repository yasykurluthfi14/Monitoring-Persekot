-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2023 at 11:34 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pln`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_persekot`
--

CREATE TABLE `data_persekot` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `dinas` varchar(50) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `tgl_dokumen` varchar(50) NOT NULL,
  `tgl_pelaporan` varchar(50) NOT NULL,
  `persekot` varchar(75) NOT NULL,
  `uraian` varchar(75) NOT NULL,
  `umur_persekot` varchar(50) NOT NULL,
  `dokumen` varchar(75) NOT NULL,
  `dokumen2` varchar(75) NOT NULL,
  `status_dokumen` int(11) NOT NULL,
  `status_dokumen2` int(11) NOT NULL,
  `keterangan` varchar(75) NOT NULL,
  `status_persekot` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `nama` varchar(75) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(75) NOT NULL,
  `password` varchar(75) NOT NULL,
  `role` varchar(20) NOT NULL,
  `unit` varchar(20) NOT NULL,
  `dinas` varchar(20) NOT NULL,
  `alamat` varchar(75) NOT NULL,
  `foto` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `nama`, `username`, `email`, `password`, `role`, `unit`, `dinas`, `alamat`, `foto`) VALUES
(2, 'admin', 'admin', 'admin@gmail.com', '202cb962ac59075b964b07152d234b70', 'admin', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_persekot`
--
ALTER TABLE `data_persekot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_persekot`
--
ALTER TABLE `data_persekot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
