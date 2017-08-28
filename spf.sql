-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2017 at 04:11 PM
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
  `status_acc` varchar(32) NOT NULL,
  `tgl_acc` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bobot_gap`
--

CREATE TABLE `bobot_gap` (
  `id_bobot` int(11) NOT NULL,
  `id_penilaian` int(11) NOT NULL,
  `selisih` int(11) NOT NULL,
  `bobot_nilai` float NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bobot_gap`
--

INSERT INTO `bobot_gap` (`id_bobot`, `id_penilaian`, `selisih`, `bobot_nilai`, `keterangan`) VALUES
(1, 1, 0, 5, 'Tidak ada selisih(kompetensi sesuai dengan yang dibutuhkan)'),
(2, 1, 1, 4.5, 'Kompetensi kelebihan 1 tingkat/level'),
(3, 1, -1, 4, 'Kompetensi kekurangan 1 tingkat/level'),
(4, 1, 2, 3.5, 'Kompetensi kelebihan 2 tingkat/level'),
(5, 1, -2, 3, 'Kompetensi kekurangan 2 tingkat/level'),
(6, 1, 3, 2.5, 'Kompetensi kelebihan 3 tingkat/level'),
(7, 1, -3, 2, 'Kompetensi kekurangan 3 tingkat/level'),
(8, 1, 4, 1.5, 'Kompetensi kelebihan 4 tingkat/level'),
(9, 1, -4, 1, 'Kompetensi individu kekurangan 4 tingkat/level');

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
(1, 'Finance & Accounting');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_penilaian`
--

CREATE TABLE `hasil_penilaian` (
  `id_hasil` int(11) NOT NULL,
  `id_nilai` int(11) NOT NULL,
  `gap` int(11) NOT NULL,
  `bobot_nilai` int(11) NOT NULL,
  `core_factor` int(11) NOT NULL,
  `secondary_factor` int(11) NOT NULL,
  `total_nilai` int(11) NOT NULL,
  `hasil_akhir` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `id_departemen` int(11) NOT NULL,
  `nama` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `id_departemen`, `nama`) VALUES
(1, 1, 'Supervisor');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_kriteria`
--

CREATE TABLE `jenis_kriteria` (
  `id_jenis_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_kriteria`
--

INSERT INTO `jenis_kriteria` (`id_jenis_kriteria`, `nama_kriteria`) VALUES
(4, 'Kompetensi Inti'),
(5, 'Kompetensi Peran'),
(6, 'Kompetensi Fungsional');

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
(1, 1, 1, 'azhary', '985fabf8f96dc1c4c306341031569937', 1, 'Azhary Arliansyah', 'Palembang', '1996-08-05', 'l', 'Islam', 'aaaaa', 'aaaa');

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
  `id_departemen` int(11) NOT NULL,
  `id_jabatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `id_jenis_kriteria`, `id_departemen`, `id_jabatan`) VALUES
(1, 4, 1, 1),
(2, 5, 1, 1),
(3, 6, 1, 1);

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
(1, 1, 1, 4, 1, 2),
(2, 1, 1, 4, 2, 3),
(3, 1, 1, 4, 3, 3),
(4, 1, 1, 4, 4, 4),
(5, 1, 1, 4, 5, 3),
(6, 1, 1, 4, 6, 2),
(7, 1, 1, 4, 7, 2),
(8, 1, 1, 4, 8, 2),
(9, 1, 1, 4, 9, 3),
(10, 1, 1, 5, 10, 2),
(11, 1, 1, 5, 11, 4),
(12, 1, 1, 6, 12, 3),
(13, 1, 1, 6, 13, 3);

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id_penilaian` int(11) NOT NULL,
  `standar_requirement` text NOT NULL,
  `tgl_penilaian` date NOT NULL,
  `thn_penilaian` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`id_penilaian`, `standar_requirement`, `tgl_penilaian`, `thn_penilaian`) VALUES
(1, 'Standar Requirement', '2017-08-24', '2017');

-- --------------------------------------------------------

--
-- Table structure for table `subkriteria`
--

CREATE TABLE `subkriteria` (
  `id_subkriteria` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `id_kelompok_nilai` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `standar_nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subkriteria`
--

INSERT INTO `subkriteria` (`id_subkriteria`, `id_kriteria`, `id_kelompok_nilai`, `nama`, `standar_nilai`) VALUES
(1, 1, 2, 'Kreatif', 2),
(2, 1, 1, 'Integritas & Kejujuran', 4),
(3, 1, 1, 'Aktif Berkomunikasi', 3),
(4, 1, 1, 'Tanggung Jawab', 4),
(5, 1, 1, 'Disiplin', 3),
(6, 1, 2, 'Respek & Saling Percaya', 2),
(7, 1, 1, 'Inisiatif', 3),
(8, 1, 2, 'Kerja Sama', 2),
(9, 1, 1, 'Fokus ke Pelanggan', 3),
(10, 2, 2, 'Managerial', 3),
(11, 2, 1, 'Leadership', 3),
(12, 3, 2, 'Financial Report', 3),
(13, 3, 1, 'Managerial Report', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acc_penilaian`
--
ALTER TABLE `acc_penilaian`
  ADD PRIMARY KEY (`id_hasil`);

--
-- Indexes for table `bobot_gap`
--
ALTER TABLE `bobot_gap`
  ADD PRIMARY KEY (`id_bobot`),
  ADD KEY `id_penilaian` (`id_penilaian`);

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
  ADD KEY `id_penilaian` (`id_nilai`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`),
  ADD KEY `id_departemen` (`id_departemen`);

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
  ADD KEY `id_jenis_kriteria` (`id_jenis_kriteria`);

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
  ADD KEY `id_kriteria` (`id_kriteria`),
  ADD KEY `id_kelompok_nilai` (`id_kelompok_nilai`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bobot_gap`
--
ALTER TABLE `bobot_gap`
  MODIFY `id_bobot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `departemen`
--
ALTER TABLE `departemen`
  MODIFY `id_departemen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `hasil_penilaian`
--
ALTER TABLE `hasil_penilaian`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `jenis_kriteria`
--
ALTER TABLE `jenis_kriteria`
  MODIFY `id_jenis_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `kelompok_nilai`
--
ALTER TABLE `kelompok_nilai`
  MODIFY `id_kelompok_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `subkriteria`
--
ALTER TABLE `subkriteria`
  MODIFY `id_subkriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `bobot_gap`
--
ALTER TABLE `bobot_gap`
  ADD CONSTRAINT `bobot_gap_ibfk_1` FOREIGN KEY (`id_penilaian`) REFERENCES `penilaian` (`id_penilaian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD CONSTRAINT `jabatan_ibfk_1` FOREIGN KEY (`id_departemen`) REFERENCES `departemen` (`id_departemen`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `kriteria_ibfk_1` FOREIGN KEY (`id_jenis_kriteria`) REFERENCES `jenis_kriteria` (`id_jenis_kriteria`);

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
  ADD CONSTRAINT `subkriteria_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`),
  ADD CONSTRAINT `subkriteria_ibfk_2` FOREIGN KEY (`id_kelompok_nilai`) REFERENCES `kelompok_nilai` (`id_kelompok_nilai`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
