<?php
$akarUrl = "http://localhost/PTSP/";
$halamanSaatIni = basename($_SERVER['PHP_SELF']);
session_start();
session_unset();
session_destroy();
header("Location: $akarUrl" . "src/user/pages/login.php");
exit;
