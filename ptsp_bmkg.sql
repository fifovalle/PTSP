-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2024 at 09:01 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ptsp_bmkg`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID_Admin` int(11) NOT NULL,
  `Foto` blob NOT NULL,
  `Nama_Depan_Admin` varchar(30) NOT NULL,
  `Nama_Belakang_Admin` varchar(30) NOT NULL,
  `Nama_Pengguna_Admin` varchar(30) NOT NULL,
  `Email_Admin` varchar(50) NOT NULL,
  `Kata_Sandi` varchar(100) NOT NULL,
  `Konfirmasi_Kata_Sandi` varchar(100) NOT NULL,
  `No_Telepon_Admin` varchar(50) NOT NULL,
  `Jenis_Kelamin_Admin` enum('Pria','Wanita') NOT NULL,
  `Peran_Admin` tinyint(4) NOT NULL,
  `Alamat_Admin` text NOT NULL,
  `Status_Verifikasi_Admin` enum('Terverivikasi','Belum Terverifikasi') NOT NULL,
  `token` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID_Admin`, `Foto`, `Nama_Depan_Admin`, `Nama_Belakang_Admin`, `Nama_Pengguna_Admin`, `Email_Admin`, `Kata_Sandi`, `Konfirmasi_Kata_Sandi`, `No_Telepon_Admin`, `Jenis_Kelamin_Admin`, `Peran_Admin`, `Alamat_Admin`, `Status_Verifikasi_Admin`, `token`) VALUES
(55, 0x363564633763386235303835662e6a7067, 'Naufal', 'FIFA', 'zonaDeveloper', 'Naufal@gmail.com', '$2y$10$q84vk0AmmniECaXZsZNQu.Kw6AILFmypXZ6YR0gWnpiHuwAtJZJI6', '$2y$10$q84vk0AmmniECaXZsZNQu.Kw6AILFmypXZ6YR0gWnpiHuwAtJZJI6', '+62 812-3652-2490', 'Pria', 1, 'Batujajar', 'Belum Terverifikasi', 65),
(68, 0x363565353938306262663736392e6a7067, 'Sandro', 'Anugrah', 'Sandro', 'sandro@gmail.com', '$2y$10$9EsGBDrTJk5o0OZ8wEjtpOOebV8Q4SDn9/izeZ854dm7dFK53/cJm', '$2y$10$9EsGBDrTJk5o0OZ8wEjtpOOebV8Q4SDn9/izeZ854dm7dFK53/cJm', '+62 227-8696-666', 'Pria', 1, 'Batujajar\r\n\r\n', 'Belum Terverifikasi', 2147483647),
(71, 0x363565396562356161643363392e6a7067, 'Ahsan', 'Ghifari', 'AhsanGhiff', 'ahsan@gmail.com', '$2y$10$dXEYnN7x56HHNq5IzgfEt.q1VPgi2hjzuscOHRU.WqTLVCVWRt7gu', '$2y$10$dXEYnN7x56HHNq5IzgfEt.q1VPgi2hjzuscOHRU.WqTLVCVWRt7gu', '+62 812-4118-8340', 'Pria', 1, 'sdfg', 'Belum Terverifikasi', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `informasi`
--

CREATE TABLE `informasi` (
  `ID_Informasi` int(11) NOT NULL,
  `Foto_Informasi` blob NOT NULL,
  `Nama_Informasi` varchar(30) NOT NULL,
  `Deskripsi_Informasi` text NOT NULL,
  `Harga_Informasi` int(11) NOT NULL,
  `Pemilik_Informasi` enum('Instansi A','Instansi B','Instansi C') NOT NULL,
  `No_Rekening_Informasi` int(15) NOT NULL,
  `Kategori_Informasi` enum('Meteorologi','Klimatologi','Geofisika') NOT NULL,
  `Status_Informasi` enum('Tersedia','Tidak Tersedia') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `informasi`
--

INSERT INTO `informasi` (`ID_Informasi`, `Foto_Informasi`, `Nama_Informasi`, `Deskripsi_Informasi`, `Harga_Informasi`, `Pemilik_Informasi`, `No_Rekening_Informasi`, `Kategori_Informasi`, `Status_Informasi`) VALUES
(10, 0x363565396338343362633536372e6a7067, 'HVEU', 'HBQWF', 15000, 'Instansi A', 1111, 'Meteorologi', 'Tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `jasa`
--

CREATE TABLE `jasa` (
  `ID_Jasa` int(11) NOT NULL,
  `Foto_Jasa` blob NOT NULL,
  `Nama_Jasa` varchar(30) NOT NULL,
  `Deskripsi_Jasa` text NOT NULL,
  `Harga_Jasa` int(11) NOT NULL,
  `Pemilik_Jasa` enum('Instansi A','Instansi B','Instansi C') NOT NULL,
  `No_Rekening_Jasa` int(15) NOT NULL,
  `Kategori_Jasa` enum('Meteorologi','Klimatologi','Geofisika') NOT NULL,
  `Status_Jasa` enum('Tersedia','Tidak Tersedia') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jasa`
--

INSERT INTO `jasa` (`ID_Jasa`, `Foto_Jasa`, `Nama_Jasa`, `Deskripsi_Jasa`, `Harga_Jasa`, `Pemilik_Jasa`, `No_Rekening_Jasa`, `Kategori_Jasa`, `Status_Jasa`) VALUES
(9, 0x363565333630353737646666642e706e67, 'ASDVFB', 'SSCDVC ', 2000, 'Instansi A', 0, 'Meteorologi', 'Tersedia'),
(10, 0x363565633633623263396665372e6a7067, 'Data Tsunami', 'Detektor Tsunami', 25000, 'Instansi A', 0, 'Meteorologi', 'Tersedia'),
(11, 0x363565396362323036663666392e6a7067, 'JFNGURE', 'JSDB', 9000, 'Instansi A', 1111, 'Meteorologi', 'Tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `ID_Pengguna` int(11) NOT NULL,
  `Foto` blob NOT NULL,
  `NPWP_Pengguna` varchar(25) NOT NULL,
  `No_Identitas_Pengguna` int(16) NOT NULL,
  `Pekerjaan_Pengguna` varchar(50) NOT NULL,
  `Nama_Depan_Pengguna` varchar(30) NOT NULL,
  `Nama_Belakang_Pengguna` varchar(30) NOT NULL,
  `Pendidikan_Terakhir_Pengguna` varchar(30) NOT NULL,
  `Nama_Pengguna` varchar(30) NOT NULL,
  `Email_Pengguna` varchar(50) NOT NULL,
  `Kata_Sandi` varchar(100) NOT NULL,
  `Konfirmasi_Kata_Sandi` varchar(100) NOT NULL,
  `No_Telepon_Pengguna` varchar(50) NOT NULL,
  `Jenis_Kelamin_Pengguna` enum('Pria','Wanita') NOT NULL,
  `Alamat_Pengguna` text NOT NULL,
  `Provinsi` varchar(30) NOT NULL,
  `Kabupaten_Kota` varchar(30) NOT NULL,
  `Jenis_Pengguna` enum('Perorangan','Perusahaan') NOT NULL,
  `Kode_Captcha` varchar(10) NOT NULL,
  `Status_Verifikasi_Pengguna` enum('Terverivikasi','Belum Terverifikasi') NOT NULL,
  `token` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID_Admin`);

--
-- Indexes for table `informasi`
--
ALTER TABLE `informasi`
  ADD PRIMARY KEY (`ID_Informasi`);

--
-- Indexes for table `jasa`
--
ALTER TABLE `jasa`
  ADD PRIMARY KEY (`ID_Jasa`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`ID_Pengguna`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID_Admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `informasi`
--
ALTER TABLE `informasi`
  MODIFY `ID_Informasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jasa`
--
ALTER TABLE `jasa`
  MODIFY `ID_Jasa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `ID_Pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
