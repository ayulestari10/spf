-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2017 at 06:53 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spf`
--

-- --------------------------------------------------------

--
-- Table structure for table `hrd`
--

CREATE TABLE `hrd` (
  `id_hrd` int(11) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `jk` varchar(32) NOT NULL,
  `tempat_lahir` varchar(32) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `agama` varchar(32) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(64) NOT NULL,
  `no_telp` int(20) NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kepala_perusahaan`
--

CREATE TABLE `kepala_perusahaan` (
  `NIP` int(11) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `jk` varchar(32) NOT NULL,
  `tempat_lahir` varchar(32) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `agama` varchar(32) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(64) NOT NULL,
  `no_telp` int(20) NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kriteria_penilaian`
--

CREATE TABLE `kriteria_penilaian` (
  `id_kriteria` int(11) NOT NULL,
  `nama` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `NIP` int(11) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `jk` varchar(32) NOT NULL,
  `tempat_lahir` varchar(32) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `agama` varchar(32) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(64) NOT NULL,
  `no_telp` int(20) NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `NIP` int(11) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `jk` varchar(32) NOT NULL,
  `tempat_lahir` varchar(32) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `agama` varchar(32) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(64) NOT NULL,
  `no_telp` int(20) NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penilaian_kinerja`
--

CREATE TABLE `penilaian_kinerja` (
  `id_penilaian` int(11) NOT NULL,
  `NIP` int(11) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `nama` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hrd`
--
ALTER TABLE `hrd`
  ADD PRIMARY KEY (`id_hrd`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `kepala_perusahaan`
--
ALTER TABLE `kepala_perusahaan`
  ADD PRIMARY KEY (`NIP`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- Indexes for table `kriteria_penilaian`
--
ALTER TABLE `kriteria_penilaian`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`NIP`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`NIP`);

--
-- Indexes for table `penilaian_kinerja`
--
ALTER TABLE `penilaian_kinerja`
  ADD PRIMARY KEY (`id_penilaian`),
  ADD KEY `id_karyawan` (`NIP`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kriteria_penilaian`
--
ALTER TABLE `kriteria_penilaian`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `penilaian_kinerja`
--
ALTER TABLE `penilaian_kinerja`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
