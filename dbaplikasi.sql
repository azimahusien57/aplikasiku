-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2020 at 03:19 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbaplikasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id_guru` int(3) NOT NULL,
  `nip` int(50) NOT NULL,
  `nama_guru` varchar(225) NOT NULL,
  `jk_guru` enum('L','P') NOT NULL,
  `alamat_guru` text NOT NULL,
  `tlp_guru` char(20) NOT NULL,
  `foto_guru` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id_guru`, `nip`, `nama_guru`, `jk_guru`, `alamat_guru`, `tlp_guru`, `foto_guru`) VALUES
(1, 176890, 'hafid masruri', 'L', 'Lumajang', '09875433', ''),
(2, 170100, 'lucas ford', 'L', 'bandung', '0823445', 'lk.PNG'),
(20, 77888, 'azima husien', 'P', 'sumenep', '7889900-', '8a3ede52572474c103cdd3232522b1d4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(3) NOT NULL,
  `kode_kelas` varchar(40) NOT NULL,
  `nama_kelas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `kode_kelas`, `nama_kelas`) VALUES
(1, '001', 'xx1 rpl'),
(7, '3444', 'mandari'),
(11, 'SS', 'tkj'),
(12, '002', 'BAHASA'),
(13, 'SS', 'BAHASA'),
(14, 'SS', 'BAHASA'),
(15, '002', 'tkj');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(3) NOT NULL,
  `id_tahun_pelajaran_siswa` int(10) NOT NULL,
  `nisn` int(20) NOT NULL,
  `nama_siswa` varchar(225) NOT NULL,
  `jk_siswa` enum('L','P') NOT NULL,
  `alamat_siswa` text NOT NULL,
  `foto` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `id_tahun_pelajaran_siswa`, `nisn`, `nama_siswa`, `jk_siswa`, `alamat_siswa`, `foto`) VALUES
(1, 1, 123949995, 'ujang', 'L', 'sumenep', ''),
(6, 2, 566, 'ukikiooo', 'P', 'banyangi', '9194c0f0449406b817d5226ced638ea2.png');

-- --------------------------------------------------------

--
-- Table structure for table `tahun_pelajaran`
--

CREATE TABLE `tahun_pelajaran` (
  `id_tahun_pelajaran` int(3) NOT NULL,
  `tahun_pelajaran` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tahun_pelajaran`
--

INSERT INTO `tahun_pelajaran` (`id_tahun_pelajaran`, `tahun_pelajaran`) VALUES
(1, '2019-20214'),
(2, '2001-2000'),
(22, '2091-2002'),
(23, '2020-2013'),
(24, '2000-1999');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `nama_lengkap` varchar(300) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `level` enum('user','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `nama_lengkap`, `username`, `password`, `email`, `level`) VALUES
(1, 'pranata m', 'nathan m', '093d8a0793df4654fee95cc1215555b3', 'nata@gmail.com', 'admin'),
(3, 'lala k', 'la888', '0aa3061dbc1f4813d7536a7c96c1fd4f', 'jjkkjkj@gmail.com', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `tahun_pelajaran`
--
ALTER TABLE `tahun_pelajaran`
  ADD PRIMARY KEY (`id_tahun_pelajaran`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id_guru` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tahun_pelajaran`
--
ALTER TABLE `tahun_pelajaran`
  MODIFY `id_tahun_pelajaran` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
