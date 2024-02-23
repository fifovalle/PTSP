<?php
include 'databases.php';

$adminModel = new Admin($koneksi);

$adminID = isset($_GET['admin_id']) ? $_GET['admin_id'] : null;
$dataAdmin = $adminModel->tampilkanDataAdmin($adminID);

$adminDitemukan = null;

foreach ($dataAdmin as $admin) {
    $adminDitemukan = $admin['ID_Admin'] == $adminID ? $admin : null;
    if ($adminDitemukan) {
        break;
    }
}

echo json_encode($adminDitemukan);
