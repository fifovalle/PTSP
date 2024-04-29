<?php
include 'databases.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $transaksiID = $_POST['ID_Tranksaksi'] ?? '';
    $statusTransaksi = $_POST['Status_Transaksi'] ?? '';
    $keteranganPembayaranDitolak = $_POST['Keterangan_Pembayaran_Ditolak'] ?? '';

    $databasesModel = new Transaksi($koneksi);
    $transaksiModel = $databasesModel->getDataTransaksiById($transaksiID);

    if (!$transaksiModel) {
        echo json_encode(array("success" => false, "message" => "Transaksi tidak ditemukan."));
        exit;
    }

    $statusTransaksiOptions = ['Disetujui', 'Belum Disetujui', 'Ditolak', 'Sedang Ditinjau'];
    if (!in_array($statusTransaksi, $statusTransaksiOptions)) {
        echo json_encode(array("success" => false, "message" => "Status transaksi tidak valid."));
        exit;
    }

    if ($statusTransaksi === 'Ditolak') {
        if (empty($keteranganPembayaranDitolak)) {
            echo json_encode(array("success" => false, "message" => "Keterangan pembayaran ditolak harus diisi jika transaksi ditolak."));
            exit;
        }
    } else {
        if (!empty($keteranganPembayaranDitolak)) {
            echo json_encode(array("success" => false, "message" => "Keterangan pembayaran ditolak tidak boleh diisi jika transaksi disetujui."));
            exit;
        }
    }

    if ($statusTransaksi === 'Diterima') {
        $keteranganPembayaranDitolak = null;
    }

    $updateTransaksi = $databasesModel->perbaruiTransaksi(
        $transaksiID,
        $statusTransaksi,
        $keteranganPembayaranDitolak
    );

    if ($updateTransaksi) {
        echo json_encode(array("success" => true, "message" => "Data transaksi berhasil diperbarui."));
        exit;
    } else {
        echo json_encode(array("success" => false, "message" => "Gagal memperbarui data transaksi."));
        exit;
    }
} else {
    echo json_encode(array("success" => false, "message" => "Metode request tidak valid."));
    exit;
}
