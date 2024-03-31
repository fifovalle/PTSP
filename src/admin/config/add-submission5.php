<?php
include 'databases.php';

if (isset($_POST['Apply'])) {
    $nama = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Nama']));
    $nim_atau_ktp = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['NIM_atau_KTP']));
    $program_studi_atau_fakultas = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Program_Studi_atau_Fakultas']));
    $universitas_atau_instansi = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Universitas_atau_Instansi']));
    $nomorHP = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['No_HP']));
    $email = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Email']));

    $nomorTeleponFormatted = '+62 ' . substr($nomorHP, 0, 3) . '-' . substr($nomorHP, 4, 4) . '-' . substr($nomorHP, 7);

    $objekDataPenelitian = new Pengajuan($koneksi);

    $tujuanFolder = '../assets/image/uploads/';
    $suratIdentitasBaru = uploadFile('Identitas_Diri', $tujuanFolder);
    $suratPengantarBaru = uploadFile('Surat_Pengantar', $tujuanFolder);
    $suratPernyataanBaru = uploadFile('Surat_Pernyataan', $tujuanFolder);
    $proposalPenelitianBaru = uploadFile('Proposal_Penelitian', $tujuanFolder);

    $dataPendidikan = array(
        'Nama_Pendidikan_Dan_Penelitian' => $nama,
        'NIM_KTP' => $nim_atau_ktp,
        'Program_Studi_Fakultas' => $program_studi_atau_fakultas,
        'Universitas_Instansi' => $universitas_atau_instansi,
        'No_Telepon_Pendidikan_Penelitian' => $nomorTeleponFormatted,
        'Email_Pendidikan_Penelitian' => $email,
        'Identitas_Diri' => $suratIdentitasBaru,
        'Surat_Pengantar_Kepsek_Rektor_Dekan' => $suratPengantarBaru,
        'Pernyataan_Tidak_Digunakan_Kepentingan_Lain' => $suratPernyataanBaru,
        'Proposal_Penelitian_Telah_Disetujui' => $proposalPenelitianBaru
    );

    $simpanDataPendidikan = $objekDataPenelitian->tambahDataPendidikanPenelitian($dataPendidikan);

    $dataPengajuanPenelitian = array(
        'ID_Pengguna' => $_SESSION['ID_Pengguna'],
        'ID_Perusahaan' => $_SESSION['ID_Perusahaan'],
        'ID_Penelitian' => $objekDataPenelitian->ambilIDPenelitianTerakhir(),
        'Status_Pengajuan' => 'Sedang Ditinjau',
        'Tanggal_Pengajuan' => date('Y-m-d H:i:s')
    );

    $simpanDataPengajuanPenelitian = $objekDataPenelitian->tambahDataPengajuanPenelitian($dataPengajuanPenelitian);

    if ($simpanDataPendidikan && $simpanDataPengajuanPenelitian) {
        setPesanKeberhasilan("Data kegiatan penanggulangan sosial berhasil dikirim harap menunggu konfirmasi oleh admin.");
        header("Location: $akarUrl" . "src/user/pages/checkout.php");
        exit();
    } else {
        setPesanKesalahan("Gagal menambahkan data kegiatan penanggulangan bencana.");
        header("Location: $akarUrl" . "src/user/pages/ajukan.php");
        exit;
    }
} else {
    header("Location: $akarUrl" . "src/user/pages/ajukan.php");
    exit;
}

function uploadFile($fileInputName, $tujuanFolder)
{
    if ($_FILES[$fileInputName]['error'] !== UPLOAD_ERR_OK) {
    }

    $namaFileBaru = uniqid() . '_' . basename($_FILES[$fileInputName]['name']);
    $tujuanFile = $tujuanFolder . $namaFileBaru;

    if (!move_uploaded_file($_FILES[$fileInputName]['tmp_name'], $tujuanFile)) {
    }

    return $namaFileBaru;
}
