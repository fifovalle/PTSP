-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2024 at 08:01 AM
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
(15, 0x363566656633303038346564332e6a7067, 'a', 'a', 100000000, 'Instansi A', 1111, 'Geofisika', 'Tersedia'),
(16, 0x363630303566363366316632632e706e67, 'Data1', 'shdshf', 500000, 'Instansi A', 1111, 'Meteorologi', 'Tersedia'),
(17, 0x363630303566396664653137372e6a7067, 'Data2', 'ndajd', 90000, 'Instansi A', 1111, 'Klimatologi', 'Tersedia');

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

--
-- Dumping data for table `jasa`
--

INSERT INTO `jasa` (`ID_Jasa`, `Foto_Jasa`, `Nama_Jasa`, `Deskripsi_Jasa`, `Harga_Jasa`, `Pemilik_Jasa`, `No_Rekening_Jasa`, `Kategori_Jasa`, `Status_Jasa`) VALUES
(14, 0x363630303661613539303864372e706e67, 'Jasa Pijat', 'jahdjhshdh', 80000000, 'Instansi A', 1111, 'Meteorologi', 'Tersedia'),
(15, 0x363630303661643765626339662e706e67, 'Tukang Sunat', 'hjSHDKJSF', 8900000, 'Instansi A', 1111, 'Klimatologi', 'Tersedia'),
(16, 0x363630303662303162326534362e706e67, 'Parut Gibran', 'hsjhsjfh', 600000, 'Instansi A', 1111, 'Geofisika', 'Tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan_bencana`
--

CREATE TABLE `kegiatan_bencana` (
  `ID_Bencana` int(16) NOT NULL,
  `Nama_Bencana` varchar(30) NOT NULL,
  `No_Telepon_Bencana` varchar(20) NOT NULL,
  `Email_Bencana` varchar(50) NOT NULL,
  `Informasi_Bencana_Yang_Dibutuhkan` varchar(100) NOT NULL,
  `Surat_Pengantar_Permintaan_Data_Bencana` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kegiatan_bencana`
--

INSERT INTO `kegiatan_bencana` (`ID_Bencana`, `Nama_Bencana`, `No_Telepon_Bencana`, `Email_Bencana`, `Informasi_Bencana_Yang_Dibutuhkan`, `Surat_Pengantar_Permintaan_Data_Bencana`) VALUES
(3, 'Naufal', '81223652490', 'fifanaufal10@gmail.com', 'Butuh', 0x363630323965396535633939365f6c6f6769632e706e67),
(4, 'Naufal', '81223652490', 'fifanaufal10@gmail.com', 'Butuh', 0x363630323966323464653531345f6c6f6769632e706e67),
(5, 'Naufal', '81223652490', 'asep@gmail.com', 'Butuh', 0x363630323966633637396436375f6c6f6769632e706e67),
(6, 'Ahsan', '1', 'asep@gmail.com', 'Butuh', 0x363630326130383433323730625f6c6f6769632e706e67),
(7, 'Naufal', '81223652490', 'asep@gmail.com', 'Butuh', 0x363630326131366136613264395f6c6f6769632e706e67),
(8, 'a', '81223652490', 'a@gmail.com', 'a', 0x363630326265643433313762375f57494e5f32303232303831315f31315f33315f31375f50726f2e6a7067),
(9, 'a', '81223652490', 'a@gmail.com', 'a', 0x363630326334393236663331345f57494e5f32303232313031325f32305f35345f33325f50726f2e6a7067),
(10, 'Naufal', '81223652490', 'naufal@gmai.com', 'Butuh', 0x363630336238343963353331385f6c6f6769632e706e67),
(11, 'Naufal', '81223652490', 'asep@gmail.com', 'Butuh', 0x363630336332633339333766345f6c6f6769632e706e67);

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan_keagamaan`
--

CREATE TABLE `kegiatan_keagamaan` (
  `ID_Keagamaan` int(16) NOT NULL,
  `Nama_Keagamaan` varchar(30) NOT NULL,
  `No_Telepon_Keagamaan` varchar(20) NOT NULL,
  `Email_Keagamaan` varchar(30) NOT NULL,
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
  `Nama_Sosial` varchar(30) NOT NULL,
  `No_Telepon_Sosial` varchar(20) NOT NULL,
  `Email_Sosial` varchar(30) NOT NULL,
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
-- Table structure for table `pengajuan`
--

CREATE TABLE `pengajuan` (
  `ID_Pengajuan` int(11) NOT NULL,
  `ID_Pengguna` int(11) DEFAULT NULL,
  `ID_Perusahaan` int(11) DEFAULT NULL,
  `ID_Admin` int(11) DEFAULT NULL,
  `ID_Bencana` int(11) DEFAULT NULL,
  `ID_Keagamaan` int(11) DEFAULT NULL,
  `ID_Pertahanan` int(11) DEFAULT NULL,
  `ID_Sosial` int(11) DEFAULT NULL,
  `ID_Pusat_Daerah` int(11) DEFAULT NULL,
  `ID_Penelitian` int(11) DEFAULT NULL,
  `Status_Pengajuan` enum('Sedang Ditinjau','Ditolak','Diterima') NOT NULL,
  `Keterangan_Surat_Ditolak` varchar(100) DEFAULT NULL,
  `Tanggal_Pengajuan` datetime NOT NULL
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
(16, '', '1', 1, 'Mahasiswa', 'Naufal', 'FIFA', 'SMK', 'fifovalle', 'fifanaufal10@gmail.com', '$2y$10$hFkeyUBRO03VAqiq/98hheIjBnJM6006XxZz1SmFAm6FmG9BP0K8O', '$2y$10$hFkeyUBRO03VAqiq/98hheIjBnJM6006XxZz1SmFAm6FmG9BP0K8O', '+62 812-2365-2490', 'Pria', 'Batujajar', 'Bandung', 'Bandung', 'Belum Terverifikasi', 83981283);

-- --------------------------------------------------------

--
-- Table structure for table `perusahaan`
--

CREATE TABLE `perusahaan` (
  `ID_Perusahaan` int(11) NOT NULL,
  `Foto_Perusahaan` longblob NOT NULL,
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

--
-- Dumping data for table `perusahaan`
--

INSERT INTO `perusahaan` (`ID_Perusahaan`, `Foto_Perusahaan`, `No_Identitas_Anggota_Perusahaan`, `Nama_Depan_Anggota_Perusahaan`, `Nama_Belakang_Anggota_Perusahaan`, `Pekerjaan_Anggota_Perusahaan`, `Pendidikan_Terakhir_Anggota_Perusahaan`, `Jenis_Kelamin_Anggota_Perusahaan`, `Alamat_Anggota_Perusahaan`, `No_Telepon_Anggota_Perusahaan`, `Provinsi_Anggota_Perusahaan`, `Kabupaten_Kota_Anggota_Perusahaan`, `No_NPWP`, `Nama_Perusahaan`, `Alamat_Perusahaan`, `Provinsi_Perusahaan`, `Kabupaten_Kota_Perusahaan`, `Email_Perusahaan`, `No_Telepon_Perusahaan`, `Email_Anggota_Perusahaan`, `Nama_Pengguna_Anggota_Perusahaan`, `Kata_Sandi_Anggota_Perusahaan`, `Konfirmasi_Kata_Sandi_Anggota_Perusahaan`, `Status_Verifikasi_Perusahaan`, `Token`) VALUES
(5, '', 2, 'zonaNyaman', 'zona', 'Nganggur', 'SMP', 'Pria', 'Batujajar', '+62 812-2365-2490', 'Jawa Barat', 'Bandung Barat', '1', 'Iku', 'Bandung', 'Jawa Barat', 'Bandung', 'iku@gmail.com', '+62 812-2365-2490', 'iku@gmail.com', 'iku', '$2y$10$NEdvO4G1xq9mR7L6HC4HduaiDQA0UjZ.DYurM6C.E8Ya0yx3fsdOK', '$2y$10$NEdvO4G1xq9mR7L6HC4HduaiDQA0UjZ.DYurM6C.E8Ya0yx3fsdOK', 'Belum Terverifikasi', 72540572);

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
  `Rekening_Pengguna` int(20) DEFAULT NULL,
  `Jumlah_Barang` int(11) NOT NULL,
  `Tanggal_Pembelian` datetime NOT NULL,
  `Status_Transaksi` enum('Disetujui','Belum Disetujui') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`ID_Tranksaksi`, `ID_Admin`, `ID_Pengguna`, `ID_Perusahaan`, `ID_Informasi`, `ID_Jasa`, `Rekening_Pengguna`, `Jumlah_Barang`, `Tanggal_Pembelian`, `Status_Transaksi`) VALUES
(32, NULL, NULL, 5, 17, NULL, NULL, 0, '2024-03-26 10:34:44', 'Belum Disetujui'),
(33, NULL, NULL, 5, NULL, 14, NULL, 0, '2024-03-26 16:08:18', 'Belum Disetujui'),
(35, NULL, 16, NULL, 16, NULL, NULL, 0, '2024-03-27 13:09:46', 'Belum Disetujui');

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
-- Indexes for table `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD PRIMARY KEY (`ID_Pengajuan`),
  ADD KEY `ID_Pengguna` (`ID_Pengguna`),
  ADD KEY `ID_Perusahaan` (`ID_Perusahaan`),
  ADD KEY `ID_Bencana` (`ID_Bencana`),
  ADD KEY `ID_Keagamaan` (`ID_Keagamaan`),
  ADD KEY `ID_Pertahanan` (`ID_Pertahanan`),
  ADD KEY `ID_Sosial` (`ID_Sosial`),
  ADD KEY `ID_Pusat_Daerah` (`ID_Pusat_Daerah`),
  ADD KEY `ID_Penelitian` (`ID_Penelitian`),
  ADD KEY `ID_Admin` (`ID_Admin`);

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
  MODIFY `ID_Informasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `informasi_tarif_pnbp`
--
ALTER TABLE `informasi_tarif_pnbp`
  MODIFY `ID_PNBP` int(16) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jasa`
--
ALTER TABLE `jasa`
  MODIFY `ID_Jasa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `kegiatan_bencana`
--
ALTER TABLE `kegiatan_bencana`
  MODIFY `ID_Bencana` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
-- AUTO_INCREMENT for table `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `ID_Pengajuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `ID_Pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `perusahaan`
--
ALTER TABLE `perusahaan`
  MODIFY `ID_Perusahaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `ID_Tranksaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD CONSTRAINT `pengajuan_ibfk_1` FOREIGN KEY (`ID_Bencana`) REFERENCES `kegiatan_bencana` (`ID_Bencana`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengajuan_ibfk_2` FOREIGN KEY (`ID_Pusat_Daerah`) REFERENCES `pemerintah_pusat_daerah` (`ID_Pusat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengajuan_ibfk_3` FOREIGN KEY (`ID_Penelitian`) REFERENCES `pendidikan_dan_penelitian` (`ID_Pendidikan_Penelitian`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengajuan_ibfk_4` FOREIGN KEY (`ID_Perusahaan`) REFERENCES `perusahaan` (`ID_Perusahaan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengajuan_ibfk_5` FOREIGN KEY (`ID_Pengguna`) REFERENCES `pengguna` (`ID_Pengguna`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengajuan_ibfk_6` FOREIGN KEY (`ID_Sosial`) REFERENCES `kegiatan_sosial` (`ID_Sosial`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengajuan_ibfk_7` FOREIGN KEY (`ID_Pertahanan`) REFERENCES `kegiatan_pertahanan_keamanan` (`ID_Pertahanan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengajuan_ibfk_8` FOREIGN KEY (`ID_Keagamaan`) REFERENCES `kegiatan_keagamaan` (`ID_Keagamaan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengajuan_ibfk_9` FOREIGN KEY (`ID_Admin`) REFERENCES `admin` (`ID_Admin`) ON DELETE CASCADE ON UPDATE CASCADE;

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
