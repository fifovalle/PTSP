<?php
$akarUrl = "http://localhost/PTSP/";
$halamanSaatIni = basename($_SERVER['PHP_SELF']);
session_start();
session_unset();
session_destroy();
header("Location: $akarUrl" . "src/admin/pages/login.php");
exit;
