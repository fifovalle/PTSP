-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Mar 2024 pada 14.30
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

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
-- Struktur dari tabel `admin`
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
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`ID_Admin`, `Foto`, `Nama_Depan_Admin`, `Nama_Belakang_Admin`, `Nama_Pengguna_Admin`, `Email_Admin`, `Kata_Sandi`, `Konfirmasi_Kata_Sandi`, `No_Telepon_Admin`, `Jenis_Kelamin_Admin`, `Peran_Admin`, `Alamat_Admin`, `Status_Verifikasi_Admin`, `Token`) VALUES
(81, 0x363565666666313836636437342e6a7067, 'Naufal', 'FIFA', 'zonaDeveloper', 'fifanaufal10@gmail.com', '$2y$10$xROadgNIVxwG7aaqNK77uebaRYGY4FxdqCbphnfCBoy3yeAReRLTO', '$2y$10$xROadgNIVxwG7aaqNK77uebaRYGY4FxdqCbphnfCBoy3yeAReRLTO', '+62   812-3652-2490', 'Pria', 1, 'Batujajar', 'Terverifikasi', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `informasi`
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `informasi_tarif_pnbp`
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
-- Struktur dari tabel `jasa`
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
-- Struktur dari tabel `kegiatan_bencana`
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
-- Struktur dari tabel `kegiatan_keagamaan`
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
-- Struktur dari tabel `kegiatan_pertahanan_keamanan`
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
-- Struktur dari tabel `kegiatan_sosial`
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
-- Struktur dari tabel `pemerintah_pusat_daerah`
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
-- Struktur dari tabel `pendidikan_dan_penelitian`
--

CREATE TABLE `pendidikan_dan_penelitian` (
  `ID_Pendidikan_Penelitian` int(16) NOT NULL,
  `Nama_Pendidikan_Dan_Penelitian` varchar(30) NOT NULL,
  `NIM_KTP` int(20) NOT NULL,
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
-- Struktur dari tabel `pengguna`
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `perusahaan`
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

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID_Admin`);

--
-- Indeks untuk tabel `informasi`
--
ALTER TABLE `informasi`
  ADD PRIMARY KEY (`ID_Informasi`);

--
-- Indeks untuk tabel `informasi_tarif_pnbp`
--
ALTER TABLE `informasi_tarif_pnbp`
  ADD PRIMARY KEY (`ID_PNBP`);

--
-- Indeks untuk tabel `jasa`
--
ALTER TABLE `jasa`
  ADD PRIMARY KEY (`ID_Jasa`);

--
-- Indeks untuk tabel `kegiatan_bencana`
--
ALTER TABLE `kegiatan_bencana`
  ADD PRIMARY KEY (`ID_Bencana`);

--
-- Indeks untuk tabel `kegiatan_keagamaan`
--
ALTER TABLE `kegiatan_keagamaan`
  ADD PRIMARY KEY (`ID_Keagamaan`);

--
-- Indeks untuk tabel `kegiatan_pertahanan_keamanan`
--
ALTER TABLE `kegiatan_pertahanan_keamanan`
  ADD PRIMARY KEY (`ID_Pertahanan`);

--
-- Indeks untuk tabel `kegiatan_sosial`
--
ALTER TABLE `kegiatan_sosial`
  ADD PRIMARY KEY (`ID_Sosial`);

--
-- Indeks untuk tabel `pemerintah_pusat_daerah`
--
ALTER TABLE `pemerintah_pusat_daerah`
  ADD PRIMARY KEY (`ID_Pusat`);

--
-- Indeks untuk tabel `pendidikan_dan_penelitian`
--
ALTER TABLE `pendidikan_dan_penelitian`
  ADD PRIMARY KEY (`ID_Pendidikan_Penelitian`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`ID_Pengguna`);

--
-- Indeks untuk tabel `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`ID_Perusahaan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `ID_Admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT untuk tabel `informasi`
--
ALTER TABLE `informasi`
  MODIFY `ID_Informasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `informasi_tarif_pnbp`
--
ALTER TABLE `informasi_tarif_pnbp`
  MODIFY `ID_PNBP` int(16) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jasa`
--
ALTER TABLE `jasa`
  MODIFY `ID_Jasa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `kegiatan_bencana`
--
ALTER TABLE `kegiatan_bencana`
  MODIFY `ID_Bencana` int(16) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kegiatan_keagamaan`
--
ALTER TABLE `kegiatan_keagamaan`
  MODIFY `ID_Keagamaan` int(16) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kegiatan_pertahanan_keamanan`
--
ALTER TABLE `kegiatan_pertahanan_keamanan`
  MODIFY `ID_Pertahanan` int(16) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kegiatan_sosial`
--
ALTER TABLE `kegiatan_sosial`
  MODIFY `ID_Sosial` int(16) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pemerintah_pusat_daerah`
--
ALTER TABLE `pemerintah_pusat_daerah`
  MODIFY `ID_Pusat` int(16) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pendidikan_dan_penelitian`
--
ALTER TABLE `pendidikan_dan_penelitian`
  MODIFY `ID_Pendidikan_Penelitian` int(16) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `ID_Pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `perusahaan`
--
ALTER TABLE `perusahaan`
  MODIFY `ID_Perusahaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
