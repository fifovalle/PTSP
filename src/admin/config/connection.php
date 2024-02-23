<?php
session_start();
$namaserver = "localhost";
$namapengguna = "root";
$katasandi = "";
$database = "ptsp_bmkg";
$koneksi = new mysqli($namaserver, $namapengguna, $katasandi, $database);
