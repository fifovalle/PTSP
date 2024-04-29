<?php
include 'databases.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pengajuanID = $_POST['ID_Pengajuan'] ?? '';
    $statusPengajuan = $_POST['Status_Pengajuan'] ?? '';
    $apakahGratis = $_POST['Apakah_Gratis'] ?? '';
    $keteranganSuratDitolak = $_POST['Keterangan_Surat_Ditolak'] ?? '';

    $databasesModel = new Pengajuan($koneksi);
    $pengajuanModel = $databasesModel->getDataPengajuanById($pengajuanID);

    if (!$pengajuanModel) {
        echo json_encode(array("success" => false, "message" => "Pengajuan tidak ditemukan."));
        exit;
    }

    $statusPengajuan = $_POST['Status_Pengajuan'] ?? '';
    if (!in_array($statusPengajuan, ['Sedang Ditinjau', 'Ditolak', 'Diterima'])) {
        echo json_encode(array("success" => false, "message" => "Status pengajuan tidak valid."));
        exit;
    }

    $apakahGratis = $_POST['Apakah_Gratis'] ?? '';
    if (!in_array($apakahGratis, ['0', '1'])) {
        echo json_encode(array("success" => false, "message" => "Pilihan apakah gratis tidak valid."));
        exit;
    }

    $keteranganSuratDitolak = $_POST['Keterangan_Surat_Ditolak'] ?? '';
    if (strlen($keteranganSuratDitolak) > 100) {
        echo json_encode(array("success" => false, "message" => "Keterangan surat ditolak tidak boleh lebih dari 100 karakter."));
        exit;
    }

    if ($statusPengajuan === 'Ditolak') {
        if (empty($keteranganSuratDitolak)) {
            echo json_encode(array("success" => false, "message" => "Keterangan surat ditolak harus diisi jika pengajuan ditolak."));
            exit;
        }
    } else {
        if (!empty($keteranganSuratDitolak)) {
            echo json_encode(array("success" => false, "message" => "Keterangan surat ditolak tidak boleh diisi jika pengajuan diterima."));
            exit;
        }
    }

    if ($statusPengajuan === 'Diterima') {
        $keteranganSuratDitolak = null;
    }

    $updatePengajuan = $databasesModel->perbaruiPengajuan(
        $pengajuanID,
        $statusPengajuan,
        $apakahGratis,
        $keteranganSuratDitolak
    );

    if ($updatePengajuan) {
        echo json_encode(array("success" => true, "message" => "Data pengajuan berhasil diperbarui."));
        exit;
    } else {
        echo json_encode(array("success" => false, "message" => "Gagal memperbarui data pengajuan."));
        exit;
    }
} else {
    echo json_encode(array("success" => false, "message" => "Metode request tidak valid."));
    exit;
}
