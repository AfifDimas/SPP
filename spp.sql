-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2023 at 11:04 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spp`
--

-- --------------------------------------------------------

--
-- Table structure for table `angkatan`
--

CREATE TABLE `angkatan` (
  `id` int(225) NOT NULL,
  `angkatan_tahun` int(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `angkatan`
--

INSERT INTO `angkatan` (`id`, `angkatan_tahun`) VALUES
(1, 12),
(2, 11),
(3, 10);

-- --------------------------------------------------------

--
-- Table structure for table `iuran`
--

CREATE TABLE `iuran` (
  `id_iuran` int(225) NOT NULL,
  `nama_iuran` varchar(225) NOT NULL,
  `id_angkatan` int(225) NOT NULL,
  `jumlah` int(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `iuran`
--

INSERT INTO `iuran` (`id_iuran`, `nama_iuran`, `id_angkatan`, `jumlah`) VALUES
(1, 'SPP', 2, 800000),
(2, 'DPP', 3, 1500000),
(3, 'sumbangan', 1, 1200000),
(4, 'seragam', 3, 1000000),
(5, 'KI', 2, 1700000);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int(225) NOT NULL,
  `jurusan` varchar(225) NOT NULL,
  `id_angkatan` int(225) NOT NULL,
  `kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `jurusan`, `id_angkatan`, `kelas`) VALUES
(1, 'RPL-A', 1, 12),
(2, 'RPL-B', 1, 12),
(3, 'RPL-A', 2, 11),
(4, 'RPL-B', 2, 11),
(5, 'RPL-A', 3, 10),
(6, 'RPL-B', 3, 10),
(7, 'AK-A', 1, 12),
(9, 'AK-B', 1, 12),
(11, 'AK-C', 1, 12),
(12, 'AK-B', 3, 10),
(13, 'DKV-A', 1, 12);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(225) NOT NULL,
  `nama_iuran` varchar(225) NOT NULL,
  `nisn` varchar(225) NOT NULL,
  `tanggal_pembayaran` datetime NOT NULL,
  `total_pembayaran` int(225) NOT NULL,
  `total_dibayar` int(225) NOT NULL,
  `status` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `nama_iuran`, `nisn`, `tanggal_pembayaran`, `total_pembayaran`, `total_dibayar`, `status`) VALUES
(1, 'seragam', '1', '2023-08-11 15:19:12', 1000000, 1000000, 'lunas'),
(2, 'seragam', '2', '2023-08-10 16:34:56', 1000000, 1000000, 'Lunas'),
(3, 'seragam', '3', '2023-08-07 13:24:23', 1000000, 1000000, 'Angsur'),
(4, 'seragam', '4', '2023-08-30 08:01:38', 1000000, 1000000, 'lunas'),
(5, 'spp', '1', '2023-08-11 15:19:34', 800000, 800000, 'lunas'),
(6, 'spp', '2', '2023-08-10 16:43:34', 800000, 800000, 'Lunas'),
(7, 'spp', '3', '2023-08-07 14:49:10', 800000, 800000, 'Angsur'),
(8, 'spp', '4', '2023-08-15 09:17:58', 800000, 800000, 'lunas'),
(21, 'KI', '1', '2023-08-21 17:24:41', 1500000, 1500000, 'lunas'),
(22, 'KI', '2', '2023-08-23 08:24:54', 1500000, 1500000, 'lunas'),
(23, 'KI', '3', '2023-08-30 07:55:12', 1500000, 900000, 'angsur'),
(24, 'KI', '4', '2023-08-23 08:36:05', 1500000, 200000, 'angsur'),
(25, 'KI', '5', '2023-09-02 11:29:49', 1500000, 0, 'angsur'),
(26, 'spp', '5', '2023-09-02 11:31:53', 800000, 0, 'angsur'),
(27, 'seragam', '5', '2023-09-02 11:32:20', 1000000, 0, 'angsur'),
(28, 'seragam', '8', '2023-09-02 17:36:25', 1000000, 0, 'angsur'),
(29, 'spp', '8', '2023-09-02 17:37:36', 800000, 800000, 'lunas');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaranrecord`
--

CREATE TABLE `pembayaranrecord` (
  `id` int(225) NOT NULL,
  `nisn` int(225) NOT NULL,
  `id_angkatan` int(225) NOT NULL,
  `nama_iuran` varchar(225) NOT NULL,
  `jumlah_dibayar` int(225) NOT NULL,
  `tanggal_bayar` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembayaranrecord`
--

INSERT INTO `pembayaranrecord` (`id`, `nisn`, `id_angkatan`, `nama_iuran`, `jumlah_dibayar`, `tanggal_bayar`) VALUES
(1, 3, 1, 'seragam', -200000, '2023-08-07 22:23:18'),
(2, 3, 1, 'seragam', 200000, '2023-08-07 22:23:48'),
(3, 2, 1, 'seragam', 1000000, '2023-08-08 17:45:06'),
(4, 1, 1, 'seragam', 1000, '2023-08-09 08:07:36'),
(5, 1, 1, 'seragam', -1000, '2023-08-09 08:08:08'),
(7, 4, 1, 'seragam', 500000, '2023-08-09 08:17:46'),
(8, 4, 1, 'seragam', 500000, '2023-08-09 08:19:56'),
(9, 5, 1, 'spp', 800000, '2023-08-09 08:20:47'),
(10, 2, 1, 'seragam', 0, '2023-08-10 16:34:56'),
(11, 6, 1, 'spp', -200000, '2023-08-10 16:35:24'),
(12, 6, 1, 'spp', 0, '2023-08-10 16:39:23'),
(13, 14, 1, 'KI', 1000000, '2023-08-10 16:39:46'),
(14, 14, 1, 'KI', 0, '2023-08-10 16:43:27'),
(15, 6, 1, 'spp', 0, '2023-08-10 16:43:34'),
(16, 18, 1, 'qwe', 100000, '2023-08-11 11:20:50'),
(17, 1, 1, 'seragam', 0, '2023-08-11 15:15:20'),
(18, 1, 1, 'seragam', 0, '2023-08-11 15:18:41'),
(19, 1, 1, 'seragam', 0, '2023-08-11 15:19:12'),
(20, 5, 1, 'spp', 0, '2023-08-11 15:19:34'),
(21, 17, 1, 'qwe', 100000, '2023-08-11 15:22:20'),
(22, 17, 1, 'qwe', 400000, '2023-08-11 15:22:36'),
(23, 17, 1, 'qwe', 0, '2023-08-11 15:27:17'),
(24, 8, 1, 'spp', 700000, '2023-08-15 09:17:39'),
(25, 8, 1, 'spp', 100000, '2023-08-15 09:17:58'),
(26, 18, 1, 'qwe', 100000, '2023-08-15 13:47:46'),
(27, 21, 1, 'KI', 1500000, '2023-08-21 17:24:41'),
(28, 22, 1, 'KI', 1000000, '2023-08-21 17:25:15'),
(29, 22, 1, 'KI', 500000, '2023-08-23 08:24:54'),
(30, 4, 1, 'KI', 200000, '2023-08-23 08:36:05'),
(31, 3, 1, 'KI', 200000, '2023-08-25 23:07:24'),
(32, 3, 1, 'KI', 100000, '2023-08-25 23:21:38'),
(33, 3, 1, 'KI', 100000, '2023-08-25 23:21:40'),
(34, 3, 1, 'KI', 100000, '2023-08-25 23:21:53'),
(35, 3, 1, 'KI', 200000, '2023-08-30 07:53:41'),
(36, 3, 1, 'KI', 100000, '2023-08-30 07:54:28'),
(37, 3, 1, 'KI', 100000, '2023-08-30 07:55:12'),
(38, 4, 1, 'seragam', 0, '2023-08-30 08:01:38'),
(39, 8, 1, 'spp', 800000, '2023-09-02 17:37:36');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nisn` int(225) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `id_kelas` int(225) NOT NULL,
  `jenis_kelamin` varchar(225) NOT NULL,
  `alamat` varchar(225) NOT NULL,
  `telepon` int(225) NOT NULL,
  `id_angkatan` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nisn`, `nama`, `id_kelas`, `jenis_kelamin`, `alamat`, `telepon`, `id_angkatan`) VALUES
(1, 'ABI PUTRA RAMADHANI', 1, 'LAKI-LAKI', 'PADANGAN', 87654321, 1),
(2, 'AFIF DIMAS YUSNANDA', 1, 'LAKI-LAKI', 'MULYOREJO', 123452321, 1),
(3, 'PUSPA SARI', 2, 'PEREMPUAN', 'PURWOSARI\r\n', 21987432, 1),
(4, 'DITA LENI RAVIA', 2, 'PEREMPUAN', 'PURWOSARI', 654535353, 1),
(5, 'AHMAD WAHYU SAPUTRA', 1, 'LAKI-LAKI', 'DS. TURI, KEC. TAMBAKREJO  ', 9283232, 1),
(6, 'AFIN RIYANDIKA', 1, 'LAKI-LAKI', 'PURWOSARI', 9872324, 1),
(7, 'FAHRUL SYAHRONI', 1, 'LAKI-LAKI', 'PURWOSARI', 98323213, 1),
(8, 'IQBAL RESA PAMUNGKAS', 1, 'LAKI-LAKI', 'PURWOSARI', 978222, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(20) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `username` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `jabatan` varchar(20) NOT NULL,
  `foto` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `username`, `password`, `email`, `jabatan`, `foto`) VALUES
(1, 'admin', 'admin', '$2y$10$Ljp9ZkQJ.FipGj.NglWq5eoZJbteAoblqZQ6T8y4uV5lBHrJOY62C', 'admin1@gmail.com', 'admin', ''),
(2, 'user', 'user', '$2y$10$y/e/GMKMjPDpZK3tGzS7TOtQMDP2zbeq8bpVmLsAjWpWHvQs7IYVW', 'user@gmail.com', 'user', ''),
(7, 'AFIF DIMAS', 'afif', '$2y$10$/yW5fp.b.NNNqvxQhn/XLubE5O0tLCmSfzZ2sWs7imneiHr1AmiI6', 'afifdimas@outlook.com', 'admin', '120823085355.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `angkatan`
--
ALTER TABLE `angkatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iuran`
--
ALTER TABLE `iuran`
  ADD PRIMARY KEY (`id_iuran`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `pembayaranrecord`
--
ALTER TABLE `pembayaranrecord`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nisn`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `angkatan`
--
ALTER TABLE `angkatan`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `iuran`
--
ALTER TABLE `iuran`
  MODIFY `id_iuran` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `pembayaranrecord`
--
ALTER TABLE `pembayaranrecord`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `nisn` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
