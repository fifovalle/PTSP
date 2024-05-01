<?php
include 'databases.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pembayaranID = $_POST['ID_Pembayaran'] ?? '';
    $keterangan = $_POST['Keterangan_Pembayaran_Ditolak'] ?? '';
    $status = $_POST['Status_Transaksi'] ?? '';

    $databasesModel = new Transaksi($koneksi);

    if ($status === 'Disetujui') {
        $keterangan = NULL;
        $statusPesanan = 'Lunas';
    } else {
        $statusPesanan = 'Belum Lunas';
    }

    $updatePayment = $databasesModel->perbaruiPembayaran(
        $pembayaranID,
        $keterangan,
        $status,
        $statusPesanan
    );

    if ($updatePayment) {
        echo json_encode(array("success" => true, "message" => "Payment data updated successfully."));
        exit;
    } else {
        echo json_encode(array("success" => false, "message" => "Failed to update payment data."));
        exit;
    }
} else {
    echo json_encode(array("success" => false, "message" => "Invalid request method."));
    exit;
}
