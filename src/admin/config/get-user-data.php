<?php
include 'databases.php';

$penggunaModel = new Pengguna($koneksi);

$penggunaID = isset($_GET['pengguna_id']) ? $_GET['pengguna_id'] : null;
$dataPengguna = $penggunaModel->tampilkanDataPengguna($penggunaID);

$penggunaDitemukan = null;

foreach ($dataPengguna as $pengguna) {
    $penggunaDitemukan = $pengguna['ID_Pengguna'] == $penggunaID ? $pengguna : null;
    if ($penggunaDitemukan) {
        break;
    }
}

echo json_encode($penggunaDitemukan);
?>
