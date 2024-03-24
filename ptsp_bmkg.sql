-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2024 at 06:08 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
  `Status_Verifikasi_Admin` enum('Terverifikasi','Belum Terverifikasi') NOT NULL,
  `Token` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID_Admin`, `Foto`, `Nama_Depan_Admin`, `Nama_Belakang_Admin`, `Nama_Pengguna_Admin`, `Email_Admin`, `Kata_Sandi`, `Konfirmasi_Kata_Sandi`, `No_Telepon_Admin`, `Jenis_Kelamin_Admin`, `Peran_Admin`, `Alamat_Admin`, `Status_Verifikasi_Admin`, `Token`) VALUES
(81, 0x363565666666313836636437342e6a7067, 'Naufal', 'FIFA', 'zonaDeveloper', 'fifanaufal10@gmail.com', '$2y$10$xROadgNIVxwG7aaqNK77uebaRYGY4FxdqCbphnfCBoy3yeAReRLTO', '$2y$10$xROadgNIVxwG7aaqNK77uebaRYGY4FxdqCbphnfCBoy3yeAReRLTO', '+62   812-3652-2490', 'Pria', 1, 'Batujajar', 'Terverifikasi', 0);

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
(15, 0x363566656633303038346564332e6a7067, 'a', 'a', 100000000, 'Instansi A', 1111, 'Geofisika', 'Tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `informasi_tarif_pnbp`
--

CREATE TABLE `informasi_tarif_pnbp` (
  `ID_PNBP` int(16) NOT NULL,
  `Nama_PNBP` varchar(30) NOT NULL,
  `No_Telepon_PNBP` varchar(20) NOT NULL,
  `Email_PNBP` varchar(30) NOT NULL,
  `Informasi_PNBP_Yang_Dibutuhkan` varchar(100) NOT NULL,
  `Identitas_KTP_PNBP` longblob NOT NULL,
  `Surat_Pengantar_PNBP` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan_bencana`
--

CREATE TABLE `kegiatan_bencana` (
  `ID_Bencana` int(16) NOT NULL,
  `Nama` varchar(30) NOT NULL,
  `No_Telepon` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Informasi_Bencana_Yang_Dibutuhkan` varchar(100) NOT NULL,
  `Surat_Pengantar_Permintaan_Data` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan_keagamaan`
--

CREATE TABLE `kegiatan_keagamaan` (
  `ID_Keagamaan` int(16) NOT NULL,
  `Nama` varchar(30) NOT NULL,
  `No_Telepon` varchar(20) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Informasi_Keagamaan_Yang_Dibutuhkan` varchar(100) NOT NULL,
  `Surat_Yang_Ditandatangani_Keagamaan` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan_pertahanan_keamanan`
--

CREATE TABLE `kegiatan_pertahanan_keamanan` (
  `ID_Pertahanan` int(16) NOT NULL,
  `Nama_Pertahanan` varchar(30) NOT NULL,
  `No_Telepon_Pertahanan` varchar(20) NOT NULL,
  `Email_Pertahanan` varchar(30) NOT NULL,
  `Informasi_Pertahanan_Yang_Dibutuhkan` varchar(100) NOT NULL,
  `Surat_Yang_Ditandatangani_Pertahanan` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan_sosial`
--

CREATE TABLE `kegiatan_sosial` (
  `ID_Sosial` int(16) NOT NULL,
  `Nama` varchar(30) NOT NULL,
  `No_Telepon` varchar(20) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Informasi_Sosial_Yang_Dibutuhkan` varchar(100) NOT NULL,
  `Surat_Yang_Ditandatangani_Sosial` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemerintah_pusat_daerah`
--

CREATE TABLE `pemerintah_pusat_daerah` (
  `ID_Pusat` int(16) NOT NULL,
  `Nama_Pusat_Daerah` varchar(30) NOT NULL,
  `No_Telepon_Pusat_Daerah` varchar(20) NOT NULL,
  `Email_Pusat_Daerah` varchar(30) NOT NULL,
  `Informasi_Pusat_Daerah_Yang_Dibutuhkan` varchar(100) NOT NULL,
  `Memiliki_Kerja_Sama_Dengan_BMKG` longblob NOT NULL,
  `Surat_Pengantar_Pusat_Daerah` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pendidikan_dan_penelitian`
--

CREATE TABLE `pendidikan_dan_penelitian` (
  `ID_Pendidikan_Penelitian` int(16) NOT NULL,
  `Nama_Pendidikan_Dan_Penelitian` varchar(30) NOT NULL,
  `NIM_KTP` varchar(50) NOT NULL,
  `Program_Studi_Fakultas` varchar(30) NOT NULL,
  `Universitas_Instansi` varchar(30) NOT NULL,
  `No_Telepon_Pendidikan_Penelitian` varchar(20) NOT NULL,
  `Email_Pendidikan_Penelitian` varchar(30) NOT NULL,
  `Informasi_Pendidikan_Penelitian_Yang_Dibutuhkan` varchar(100) NOT NULL,
  `Identitas_Diri` longblob NOT NULL,
  `Surat_Pengantar_Kepsek_Rektor_Dekan` longblob NOT NULL,
  `Pernyataan_Tidak_Digunakan_Kepentingan_Lain` longblob NOT NULL,
  `Proposal_Penelitian_Telah_Disetujui` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `Status_Verifikasi_Pengguna` enum('Terverivikasi','Belum Terverifikasi') NOT NULL,
  `Token` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`ID_Pengguna`, `Foto`, `NPWP_Pengguna`, `No_Identitas_Pengguna`, `Pekerjaan_Pengguna`, `Nama_Depan_Pengguna`, `Nama_Belakang_Pengguna`, `Pendidikan_Terakhir_Pengguna`, `Nama_Pengguna`, `Email_Pengguna`, `Kata_Sandi`, `Konfirmasi_Kata_Sandi`, `No_Telepon_Pengguna`, `Jenis_Kelamin_Pengguna`, `Alamat_Pengguna`, `Provinsi`, `Kabupaten_Kota`, `Status_Verifikasi_Pengguna`, `Token`) VALUES
(13, '', '888888', 2147483647, 'sdcdvf', 'scdv', 'asdcv', 'cgvbhjnk', 'AhsanGhifari', 'ahsanghifari04@gmail.com', '$2y$10$t/xJLBQrYYGChFUMEfXhXO7Hvok9H3APbxGqVn8vIeVYEzD7q/yie', '$2y$10$t/xJLBQrYYGChFUMEfXhXO7Hvok9H3APbxGqVn8vIeVYEzD7q/yie', '+62 812-8411-8340', 'Pria', 'fgvhjk', 'cgvhbjnkm', 'Bekasi', 'Belum Terverifikasi', 36744280);

-- --------------------------------------------------------

--
-- Table structure for table `perusahaan`
--

CREATE TABLE `perusahaan` (
  `ID_Perusahaan` int(11) NOT NULL,
  `No_Identitas_Anggota_Perusahaan` int(16) NOT NULL,
  `Nama_Depan_Anggota_Perusahaan` varchar(30) NOT NULL,
  `Nama_Belakang_Anggota_Perusahaan` varchar(30) NOT NULL,
  `Pekerjaan_Anggota_Perusahaan` varchar(50) NOT NULL,
  `Pendidikan_Terakhir_Anggota_Perusahaan` varchar(30) NOT NULL,
  `Jenis_Kelamin_Anggota_Perusahaan` enum('Pria','Wanita') NOT NULL,
  `Alamat_Anggota_Perusahaan` text NOT NULL,
  `No_Telepon_Anggota_Perusahaan` varchar(50) NOT NULL,
  `Provinsi_Anggota_Perusahaan` varchar(30) NOT NULL,
  `Kabupaten_Kota_Anggota_Perusahaan` varchar(30) NOT NULL,
  `No_NPWP` varchar(25) NOT NULL,
  `Nama_Perusahaan` varchar(30) NOT NULL,
  `Alamat_Perusahaan` text NOT NULL,
  `Provinsi_Perusahaan` varchar(30) NOT NULL,
  `Kabupaten_Kota_Perusahaan` varchar(30) NOT NULL,
  `Email_Perusahaan` varchar(50) NOT NULL,
  `No_Telepon_Perusahaan` varchar(50) NOT NULL,
  `Email_Anggota_Perusahaan` varchar(50) NOT NULL,
  `Nama_Pengguna_Anggota_Perusahaan` varchar(30) NOT NULL,
  `Kata_Sandi_Anggota_Perusahaan` varchar(100) NOT NULL,
  `Konfirmasi_Kata_Sandi_Anggota_Perusahaan` varchar(100) NOT NULL,
  `Status_Verifikasi_Perusahaan` enum('Terverivikasi','Belum Terverifikasi') NOT NULL,
  `Token` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `ID_Tranksaksi` int(11) NOT NULL,
  `ID_Admin` int(11) DEFAULT NULL,
  `ID_Pengguna` int(11) DEFAULT NULL,
  `ID_Perusahaan` int(11) DEFAULT NULL,
  `ID_Informasi` int(11) DEFAULT NULL,
  `ID_Jasa` int(11) DEFAULT NULL,
  `Status_Keranjang` tinyint(4) NOT NULL,
  `Jumlah_Barang` int(11) NOT NULL
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
-- Indexes for table `informasi_tarif_pnbp`
--
ALTER TABLE `informasi_tarif_pnbp`
  ADD PRIMARY KEY (`ID_PNBP`);

--
-- Indexes for table `jasa`
--
ALTER TABLE `jasa`
  ADD PRIMARY KEY (`ID_Jasa`);

--
-- Indexes for table `kegiatan_bencana`
--
ALTER TABLE `kegiatan_bencana`
  ADD PRIMARY KEY (`ID_Bencana`);

--
-- Indexes for table `kegiatan_keagamaan`
--
ALTER TABLE `kegiatan_keagamaan`
  ADD PRIMARY KEY (`ID_Keagamaan`);

--
-- Indexes for table `kegiatan_pertahanan_keamanan`
--
ALTER TABLE `kegiatan_pertahanan_keamanan`
  ADD PRIMARY KEY (`ID_Pertahanan`);

--
-- Indexes for table `kegiatan_sosial`
--
ALTER TABLE `kegiatan_sosial`
  ADD PRIMARY KEY (`ID_Sosial`);

--
-- Indexes for table `pemerintah_pusat_daerah`
--
ALTER TABLE `pemerintah_pusat_daerah`
  ADD PRIMARY KEY (`ID_Pusat`);

--
-- Indexes for table `pendidikan_dan_penelitian`
--
ALTER TABLE `pendidikan_dan_penelitian`
  ADD PRIMARY KEY (`ID_Pendidikan_Penelitian`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`ID_Pengguna`);

--
-- Indexes for table `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`ID_Perusahaan`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`ID_Tranksaksi`),
  ADD KEY `ID_Admin` (`ID_Admin`),
  ADD KEY `ID_Pengguna` (`ID_Pengguna`),
  ADD KEY `ID_Perusahaan` (`ID_Perusahaan`),
  ADD KEY `ID_Informasi` (`ID_Informasi`),
  ADD KEY `ID_Jasa` (`ID_Jasa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID_Admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `informasi`
--
ALTER TABLE `informasi`
  MODIFY `ID_Informasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `informasi_tarif_pnbp`
--
ALTER TABLE `informasi_tarif_pnbp`
  MODIFY `ID_PNBP` int(16) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jasa`
--
ALTER TABLE `jasa`
  MODIFY `ID_Jasa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `kegiatan_bencana`
--
ALTER TABLE `kegiatan_bencana`
  MODIFY `ID_Bencana` int(16) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kegiatan_keagamaan`
--
ALTER TABLE `kegiatan_keagamaan`
  MODIFY `ID_Keagamaan` int(16) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kegiatan_pertahanan_keamanan`
--
ALTER TABLE `kegiatan_pertahanan_keamanan`
  MODIFY `ID_Pertahanan` int(16) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kegiatan_sosial`
--
ALTER TABLE `kegiatan_sosial`
  MODIFY `ID_Sosial` int(16) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pemerintah_pusat_daerah`
--
ALTER TABLE `pemerintah_pusat_daerah`
  MODIFY `ID_Pusat` int(16) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pendidikan_dan_penelitian`
--
ALTER TABLE `pendidikan_dan_penelitian`
  MODIFY `ID_Pendidikan_Penelitian` int(16) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `ID_Pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `perusahaan`
--
ALTER TABLE `perusahaan`
  MODIFY `ID_Perusahaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `ID_Tranksaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`ID_Pengguna`) REFERENCES `pengguna` (`ID_Pengguna`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`ID_Jasa`) REFERENCES `jasa` (`ID_Jasa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`ID_Informasi`) REFERENCES `informasi` (`ID_Informasi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_4` FOREIGN KEY (`ID_Admin`) REFERENCES `admin` (`ID_Admin`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_5` FOREIGN KEY (`ID_Perusahaan`) REFERENCES `perusahaan` (`ID_Perusahaan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
