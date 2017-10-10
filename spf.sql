-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2017 at 04:56 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `acc_penilaian`
--

CREATE TABLE `acc_penilaian` (
  `id_hasil` int(11) NOT NULL,
  `validasi_hrd` int(1) NOT NULL,
  `validasi_dept_manajer` int(1) NOT NULL,
  `validasi_pimpinan` int(1) NOT NULL,
  `status_acc` varchar(32) NOT NULL,
  `tgl_acc` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acc_penilaian`
--

INSERT INTO `acc_penilaian` (`id_hasil`, `validasi_hrd`, `validasi_dept_manajer`, `validasi_pimpinan`, `status_acc`, `tgl_acc`) VALUES
(1, 0, 1, 1, 'Tidak valid', '2017-09-28'),
(2, 0, 1, 0, 'Tidak valid', '2017-09-28');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(1, 'azhary', '985fabf8f96dc1c4c306341031569937');

-- --------------------------------------------------------

--
-- Table structure for table `bobot_gap`
--

CREATE TABLE `bobot_gap` (
  `id_bobot` int(11) NOT NULL,
  `selisih` int(11) NOT NULL,
  `bobot_nilai` float NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bobot_gap`
--

INSERT INTO `bobot_gap` (`id_bobot`, `selisih`, `bobot_nilai`, `keterangan`) VALUES
(1, 0, 5, 'Tidak ada selisih (kompetensi sesuai dengan yang dibutuhkan)'),
(2, 1, 4.5, 'Kompetensi kelebihan 1 tingkat/level'),
(3, -1, 4, 'Kompetensi kekurangan 1 tingkat/level'),
(4, 2, 3.5, 'Kompetensi kelebihan 2 tingkat/level'),
(5, -2, 3, 'Kompetensi kekurangan 2 tingkat/level'),
(6, 3, 2.5, 'Kompetensi kelebihan 3 tingkat/level'),
(7, -3, 2, 'Kompetensi kekurangan 3 tingkat/level'),
(8, 4, 1.5, 'Kompetensi kelebihan 4 tingkat/level'),
(9, -4, 1, 'Kompetensi individu kekurangan 4 tingkat/level');

-- --------------------------------------------------------

--
-- Table structure for table `departemen`
--

CREATE TABLE `departemen` (
  `id_departemen` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departemen`
--

INSERT INTO `departemen` (`id_departemen`, `nama`) VALUES
(1, 'Finance & Accounting'),
(2, 'Human Resource Development');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_penilaian`
--

CREATE TABLE `hasil_penilaian` (
  `id_hasil` int(11) NOT NULL,
  `id_penilaian` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `kompetensi_inti` float NOT NULL,
  `kompetensi_peran` float NOT NULL,
  `kompetensi_fungsional` float NOT NULL,
  `hasil_akhir` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hasil_penilaian`
--

INSERT INTO `hasil_penilaian` (`id_hasil`, `id_penilaian`, `id_karyawan`, `kompetensi_inti`, `kompetensi_peran`, `kompetensi_fungsional`, `hasil_akhir`) VALUES
(1, 1, 4, 4.8, 4.3, 5, 4.695),
(2, 2, 4, 4.33333, 4.6, 4.6, 4.42667);

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama`) VALUES
(1, 'Supervisor'),
(2, 'Manajer'),
(3, 'Foreman'),
(4, 'Direktur');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_kriteria`
--

CREATE TABLE `jenis_kriteria` (
  `id_jenis_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(50) NOT NULL,
  `bobot_kriteria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_kriteria`
--

INSERT INTO `jenis_kriteria` (`id_jenis_kriteria`, `nama_kriteria`, `bobot_kriteria`) VALUES
(4, 'Kompetensi Inti', 65),
(5, 'Kompetensi Peran', 25),
(6, 'Kompetensi Fungsional', 10);

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `id_departemen` int(11) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `NIK` int(11) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `tempat_lahir` varchar(225) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` enum('p','l','','') NOT NULL,
  `agama` varchar(32) NOT NULL,
  `alamat` text NOT NULL,
  `pendidikan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `id_departemen`, `id_jabatan`, `username`, `password`, `NIK`, `nama`, `tempat_lahir`, `tgl_lahir`, `jenis_kelamin`, `agama`, `alamat`, `pendidikan`) VALUES
(1, 2, 2, 'manajer_hrd', '985fabf8f96dc1c4c306341031569937', 12345, 'Azhary Arliansyah', 'Palembang', '1996-08-05', 'l', 'Islam', '-', '-'),
(2, 1, 2, 'manajer_finance', '985fabf8f96dc1c4c306341031569937', 123, 'Manajer Finance', 'Plg', '2017-09-11', 'p', 'Islam', 'sada', 'asd'),
(3, 1, 3, 'karyawan_finance', '985fabf8f96dc1c4c306341031569937', 12, 'azzz', 'aaaaa', '2017-09-12', 'l', 'aaaa', '-', '-'),
(4, 1, 1, 'supervisor_finance', '985fabf8f96dc1c4c306341031569937', 1234, 'azh', 'Plg', '2017-09-15', 'l', 'islm', 'almt', 'pnddkn'),
(5, 1, 4, 'direktur', '985fabf8f96dc1c4c306341031569937', 123, 'aaa', 'a', '2017-09-12', 'p', 'aaa', 'aaa', 'aa'),
(6, 2, 3, 'karyawan_hrd', '985fabf8f96dc1c4c306341031569937', 123, 'karyawan_hrd', '332', '2017-09-05', 'l', 'aaaAAAA', 'aaa\r\naaa', 'aaaa');

-- --------------------------------------------------------

--
-- Table structure for table `kelompok_nilai`
--

CREATE TABLE `kelompok_nilai` (
  `id_kelompok_nilai` int(11) NOT NULL,
  `nama` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelompok_nilai`
--

INSERT INTO `kelompok_nilai` (`id_kelompok_nilai`, `nama`) VALUES
(1, 'Core Factor'),
(2, 'Secondary Factor');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `id_jenis_kriteria` int(11) NOT NULL,
  `id_departemen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `id_jenis_kriteria`, `id_departemen`) VALUES
(1, 4, 2),
(2, 5, 2),
(3, 6, 2),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(11) NOT NULL,
  `id_penilaian` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `id_jenis_kriteria` int(11) NOT NULL,
  `id_subkriteria` int(11) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `id_penilaian`, `id_karyawan`, `id_jenis_kriteria`, `id_subkriteria`, `nilai`) VALUES
(66, 1, 4, 4, 1, 2),
(67, 1, 4, 4, 2, 3),
(68, 1, 4, 4, 3, 3),
(69, 1, 4, 4, 4, 4),
(70, 1, 4, 4, 5, 3),
(71, 1, 4, 4, 6, 2),
(72, 1, 4, 4, 7, 2),
(73, 1, 4, 4, 8, 2),
(74, 1, 4, 4, 9, 3),
(75, 1, 4, 5, 10, 2),
(76, 1, 4, 5, 11, 4),
(77, 1, 4, 6, 12, 3),
(78, 1, 4, 6, 13, 3),
(79, 2, 4, 4, 1, 0),
(80, 2, 4, 4, 2, 2),
(81, 2, 4, 4, 3, 3),
(82, 2, 4, 4, 4, 2),
(83, 2, 4, 4, 5, 3),
(84, 2, 4, 4, 6, 2),
(85, 2, 4, 4, 7, 3),
(86, 2, 4, 4, 8, 2),
(87, 2, 4, 4, 9, 3),
(88, 2, 4, 5, 10, 2),
(89, 2, 4, 5, 11, 3),
(90, 2, 4, 6, 12, 2),
(91, 2, 4, 6, 13, 3);

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id_penilaian` int(11) NOT NULL,
  `tgl_penilaian` date NOT NULL,
  `thn_penilaian` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`id_penilaian`, `tgl_penilaian`, `thn_penilaian`) VALUES
(1, '2017-09-05', '2017'),
(2, '2017-07-07', '2017');

-- --------------------------------------------------------

--
-- Table structure for table `subkriteria`
--

CREATE TABLE `subkriteria` (
  `id_subkriteria` int(11) NOT NULL,
  `id_departemen` int(11) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `id_jenis_kriteria` int(11) NOT NULL,
  `id_kelompok_nilai` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `standar_nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subkriteria`
--

INSERT INTO `subkriteria` (`id_subkriteria`, `id_departemen`, `id_jabatan`, `id_jenis_kriteria`, `id_kelompok_nilai`, `nama`, `standar_nilai`) VALUES
(1, 1, 1, 4, 2, 'Kreatif', 2),
(2, 1, 1, 4, 1, 'Integritas & Kejujuran', 4),
(3, 1, 1, 4, 1, 'Aktif Berkomunikasi', 3),
(4, 1, 1, 4, 1, 'Tanggung Jawab', 4),
(5, 1, 1, 4, 1, 'Disiplin', 3),
(6, 1, 1, 4, 2, 'Respek & Saling Percaya', 2),
(7, 1, 1, 4, 1, 'Inisiatif', 3),
(8, 1, 1, 4, 2, 'Kerja Sama', 2),
(9, 1, 1, 4, 1, 'Fokus ke Pelanggan', 3),
(10, 1, 1, 5, 2, 'Managerial', 3),
(11, 1, 1, 5, 1, 'Leadership', 3),
(12, 1, 1, 6, 2, 'Financial Report', 3),
(13, 1, 1, 6, 1, 'Managerial Report', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acc_penilaian`
--
ALTER TABLE `acc_penilaian`
  ADD PRIMARY KEY (`id_hasil`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `bobot_gap`
--
ALTER TABLE `bobot_gap`
  ADD PRIMARY KEY (`id_bobot`);

--
-- Indexes for table `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`id_departemen`);

--
-- Indexes for table `hasil_penilaian`
--
ALTER TABLE `hasil_penilaian`
  ADD PRIMARY KEY (`id_hasil`),
  ADD KEY `id_penilaian` (`id_penilaian`),
  ADD KEY `id_karyawan` (`id_karyawan`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `jenis_kriteria`
--
ALTER TABLE `jenis_kriteria`
  ADD PRIMARY KEY (`id_jenis_kriteria`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`),
  ADD KEY `id_jabatan` (`id_jabatan`),
  ADD KEY `id_departemen` (`id_departemen`);

--
-- Indexes for table `kelompok_nilai`
--
ALTER TABLE `kelompok_nilai`
  ADD PRIMARY KEY (`id_kelompok_nilai`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`),
  ADD KEY `id_jenis_kriteria` (`id_jenis_kriteria`),
  ADD KEY `id_departemen` (`id_departemen`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `id_subkriteria` (`id_subkriteria`),
  ADD KEY `id_karyawan` (`id_karyawan`),
  ADD KEY `id_jenis_kriteria` (`id_jenis_kriteria`),
  ADD KEY `id_penilaian` (`id_penilaian`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id_penilaian`);

--
-- Indexes for table `subkriteria`
--
ALTER TABLE `subkriteria`
  ADD PRIMARY KEY (`id_subkriteria`),
  ADD KEY `id_kelompok_nilai` (`id_kelompok_nilai`),
  ADD KEY `id_jenis_kriteria` (`id_jenis_kriteria`),
  ADD KEY `id_departemen` (`id_departemen`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `bobot_gap`
--
ALTER TABLE `bobot_gap`
  MODIFY `id_bobot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `departemen`
--
ALTER TABLE `departemen`
  MODIFY `id_departemen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `hasil_penilaian`
--
ALTER TABLE `hasil_penilaian`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=346;
--
-- AUTO_INCREMENT for table `jenis_kriteria`
--
ALTER TABLE `jenis_kriteria`
  MODIFY `id_jenis_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `kelompok_nilai`
--
ALTER TABLE `kelompok_nilai`
  MODIFY `id_kelompok_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;
--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `subkriteria`
--
ALTER TABLE `subkriteria`
  MODIFY `id_subkriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `hasil_penilaian`
--
ALTER TABLE `hasil_penilaian`
  ADD CONSTRAINT `hasil_penilaian_ibfk_1` FOREIGN KEY (`id_penilaian`) REFERENCES `penilaian` (`id_penilaian`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hasil_penilaian_ibfk_2` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `karyawan_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`),
  ADD CONSTRAINT `karyawan_ibfk_2` FOREIGN KEY (`id_departemen`) REFERENCES `departemen` (`id_departemen`);

--
-- Constraints for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD CONSTRAINT `kriteria_ibfk_1` FOREIGN KEY (`id_jenis_kriteria`) REFERENCES `jenis_kriteria` (`id_jenis_kriteria`),
  ADD CONSTRAINT `kriteria_ibfk_2` FOREIGN KEY (`id_departemen`) REFERENCES `departemen` (`id_departemen`);

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`id_subkriteria`) REFERENCES `subkriteria` (`id_subkriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_ibfk_2` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_ibfk_3` FOREIGN KEY (`id_jenis_kriteria`) REFERENCES `jenis_kriteria` (`id_jenis_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_ibfk_4` FOREIGN KEY (`id_penilaian`) REFERENCES `penilaian` (`id_penilaian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subkriteria`
--
ALTER TABLE `subkriteria`
  ADD CONSTRAINT `subkriteria_ibfk_2` FOREIGN KEY (`id_kelompok_nilai`) REFERENCES `kelompok_nilai` (`id_kelompok_nilai`),
  ADD CONSTRAINT `subkriteria_ibfk_3` FOREIGN KEY (`id_jenis_kriteria`) REFERENCES `jenis_kriteria` (`id_jenis_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subkriteria_ibfk_4` FOREIGN KEY (`id_departemen`) REFERENCES `departemen` (`id_departemen`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subkriteria_ibfk_5` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
