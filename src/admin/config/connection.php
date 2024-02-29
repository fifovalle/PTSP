<?php
session_start();
$namaserver = "localhost";
$namapengguna = "root";
$katasandi = "";
$database = "ptsp_bmkg";
$koneksi = new mysqli($namaserver, $namapengguna, $katasandi, $database);
$akarUrl = "http://localhost/PTSP/";
$halamanSaatIni = basename($_SERVER['PHP_SELF']);
$_SESSION['gagal'] = $_SESSION['gagal'] ?? '';
function setPesanKesalahan($pesan_kesalahan)
{
    $_SESSION['gagal'] = $pesan_kesalahan;
}
function setPesanKeberhasilan($pesan_keberhasilan)
{
    $_SESSION['berhasil'] = $pesan_keberhasilan;
}
