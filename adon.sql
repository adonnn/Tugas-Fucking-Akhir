-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2023 at 08:16 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agus`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternatif`
--

CREATE TABLE `alternatif` (
  `id_alternatif` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `hasil` double DEFAULT NULL,
  `peringkat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alternatif`
--

INSERT INTO `alternatif` (`id_alternatif`, `id_pengguna`, `id_karyawan`, `hasil`, `peringkat`) VALUES
(1, 3, 1, 0.3375, 4),
(2, 3, 2, 0.36, 2),
(3, 3, 3, 0.34, 3),
(4, 3, 4, 0.295, 7),
(5, 3, 5, 0.3615, 1),
(6, 3, 6, 0.315, 5),
(7, 3, 7, 0.2705, 8),
(8, 3, 8, 0.2995, 6),
(9, 3, 9, 0.2525, 10),
(10, 3, 10, 0.2705, 9);

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `nama_calon` varchar(35) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nama_calon`, `jenis_kelamin`, `no_hp`, `alamat`) VALUES
(1, 'Lukman Arifin', 'Laki-laki', '081288882212', 'Jalan Kh. Burlian Demang '),
(2, 'Nurul Huda', 'Perempuan', '082198342342', 'Jalan semeru no.13'),
(3, 'Yudi Priyanto', 'Laki-laki', '082189382932', 'Jalan Mayangsari No 100'),
(4, 'Rendi Djoko Susanto', 'Laki-laki', '089627716812', 'Jl.Sudarman Ganda No 1'),
(5, 'Pungki Ardianzah', 'Laki-laki', '085709300948', 'Jalan sukasepi no.273'),
(6, 'Angsa Parbianto Putra', 'Laki-laki', '082197389244', 'Jalan syakiakirti no. 45'),
(7, 'Firman Mustaqim', 'Laki-laki', '089627719489', 'Jalan sukarame no.33'),
(8, 'Nofa Andraini Saputra', 'Laki-laki', '081288895849', 'Jalan Demang Lebar no.2'),
(9, 'Dwi Adi Nugroho', 'Laki-laki', '081288889494', 'Komp. Citra Dago III '),
(10, 'MGS A Faisal', 'Perempuan', '089627719843', 'Jalan kebaikan no.19');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `kode_kriteria` varchar(5) NOT NULL,
  `nama_kriteria` varchar(35) NOT NULL,
  `bobot_kriteria` double NOT NULL,
  `jenis` enum('Cost','Benefit') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `kode_kriteria`, `nama_kriteria`, `bobot_kriteria`, `jenis`) VALUES
(2, 'C1', 'Pendidikan', 0.2, 'Benefit'),
(3, 'C2', 'Lama Bekerja', 0.25, 'Benefit'),
(4, 'C3', 'Kinerja', 0.3, 'Benefit'),
(5, 'C4', 'Kerja TIm', 0.25, 'Benefit');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `jabatan` enum('Admin','Kepala Bagian Teknik') NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `nama`, `jabatan`, `username`, `password`) VALUES
(1, 'Agus Jatmiko', 'Admin', 'admin', '123'),
(3, 'Siti Yunita', 'Kepala Bagian Teknik', 'kepala', '123');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id_penilaian` int(11) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `id_sub_kriteria` int(11) NOT NULL,
  `nilai_bobot` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`id_penilaian`, `id_alternatif`, `id_sub_kriteria`, `nilai_bobot`) VALUES
(1, 1, 3, 4),
(2, 1, 7, 5),
(3, 1, 14, 3),
(4, 1, 18, 4),
(5, 2, 3, 4),
(6, 2, 8, 4),
(7, 2, 12, 5),
(8, 2, 18, 4),
(9, 3, 3, 4),
(10, 3, 8, 4),
(11, 3, 13, 4),
(12, 3, 18, 4),
(13, 4, 4, 3),
(14, 4, 9, 3),
(15, 4, 12, 5),
(16, 4, 19, 3),
(17, 5, 3, 4),
(18, 5, 7, 5),
(19, 5, 14, 3),
(20, 5, 17, 5),
(21, 6, 4, 3),
(22, 6, 7, 5),
(23, 6, 13, 4),
(24, 6, 19, 3),
(25, 7, 3, 4),
(26, 7, 10, 2),
(27, 7, 13, 4),
(28, 7, 19, 3),
(29, 8, 4, 3),
(30, 8, 8, 4),
(31, 8, 14, 3),
(32, 8, 18, 4),
(33, 9, 4, 3),
(34, 9, 10, 2),
(35, 9, 13, 4),
(36, 9, 19, 3),
(37, 10, 3, 4),
(38, 10, 9, 3),
(39, 10, 14, 3),
(40, 10, 19, 3);

-- --------------------------------------------------------

--
-- Table structure for table `sub_kriteria`
--

CREATE TABLE `sub_kriteria` (
  `id_sub_kriteria` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `kategori` varchar(35) NOT NULL,
  `nilai` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_kriteria`
--

INSERT INTO `sub_kriteria` (`id_sub_kriteria`, `id_kriteria`, `kategori`, `nilai`) VALUES
(2, 2, '100%', 5),
(3, 2, '96%', 4),
(4, 2, '92%', 3),
(5, 2, '88%', 2),
(6, 2, '84%', 1),
(7, 3, '>5 tahun', 5),
(8, 3, '4 tahun', 4),
(9, 3, '3 tahun', 3),
(10, 3, '2 tahun', 2),
(11, 3, '1 tahun', 1),
(12, 4, '100%', 5),
(13, 4, '96%', 4),
(14, 4, '92%', 3),
(15, 4, '88%', 2),
(16, 4, '84%', 1),
(17, 5, '100%', 5),
(18, 5, '96%%', 4),
(19, 5, '92%', 3),
(20, 5, '88%', 2),
(21, 5, '84%', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id_alternatif`),
  ADD KEY `id_pengguna` (`id_pengguna`),
  ADD KEY `id_calon` (`id_karyawan`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`),
  ADD KEY `kode_kriteria` (`kode_kriteria`),
  ADD KEY `nama_kriteria` (`nama_kriteria`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id_penilaian`),
  ADD KEY `id_alternatif` (`id_alternatif`),
  ADD KEY `id_sub_kriteria` (`id_sub_kriteria`);

--
-- Indexes for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD PRIMARY KEY (`id_sub_kriteria`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  MODIFY `id_sub_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD CONSTRAINT `alternatif_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `alternatif_ibfk_2` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `penilaian_ibfk_1` FOREIGN KEY (`id_alternatif`) REFERENCES `alternatif` (`id_alternatif`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penilaian_ibfk_2` FOREIGN KEY (`id_sub_kriteria`) REFERENCES `sub_kriteria` (`id_sub_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD CONSTRAINT `sub_kriteria_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
