<?php
include 'databases.php';

if (isset($_POST['Apply'])) {
    $nama = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Nama']));
    $nim_atau_ktp = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['NIM_atau_KTP']));
    $program_studi_atau_fakultas = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Program_Studi_atau_Fakultas']));
    $universitas_atau_instansi = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Universitas_atau_Instansi']));
    $nomorHP = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['No_HP']));
    $email = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Email']));
    $informasiDibutuhkan = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Informasi_Yang_Dibutuhkan']));

    $objekDataPendidikan = new Pengajuan($koneksi);
    $pesanKesalahan = '';

    $nomorHPFormatted = preg_replace('/^(\d{3})(\d{4})(\d{4})$/', '+62 $1-$2-$3', $nomorHP);

    $suratIdentitasFile = $_FILES['Identitas_Diri'];
    $namaSuratIdentitas = mysqli_real_escape_string($koneksi, htmlspecialchars($suratIdentitasFile['name']));
    $suratIdentitasTemp = $suratIdentitasFile['tmp_name'];
    $ukuranSuratIdentitas = $suratIdentitasFile['size'];
    $errorSuratIdentitas = $suratIdentitasFile['error'];

    $suratPengantarFile = $_FILES['Surat_Pengantar'];
    $namaSuratPengantar = mysqli_real_escape_string($koneksi, htmlspecialchars($suratPengantarFile['name']));
    $suratPengantarTemp = $suratPengantarFile['tmp_name'];
    $ukuranSuratPengantar = $suratPengantarFile['size'];
    $errorSuratPengantar = $suratPengantarFile['error'];

    $suratPernyataanFile = $_FILES['Surat_Pernyataan'];
    $namaSuratPernyataan = mysqli_real_escape_string($koneksi, htmlspecialchars($suratPernyataanFile['name']));
    $suratPernyataanTemp = $suratPernyataanFile['tmp_name'];
    $ukuranSuratPernyataan = $suratPernyataanFile['size'];
    $errorSuratPernyataan = $suratPernyataanFile['error'];

    $proposalPenelitianFile = $_FILES['Proposal_Penelitian'];
    $namaProposalPenelitian = mysqli_real_escape_string($koneksi, htmlspecialchars($proposalPenelitianFile['name']));
    $proposalPenelitianTemp = $proposalPenelitianFile['tmp_name'];
    $ukuranProposalPenelitian = $proposalPenelitianFile['size'];
    $errorProposalPenelitian = $proposalPenelitianFile['error'];

    $ukuranMaksimal = 5 * 1024 * 1024;
    $formatDisetujui = ['jpg', 'jpeg', 'png', 'pdf'];

    $formatIdentitas = strtolower(pathinfo($namaSuratIdentitas, PATHINFO_EXTENSION));
    $formatPengantar = strtolower(pathinfo($namaSuratPengantar, PATHINFO_EXTENSION));
    $formatPernyataan = strtolower(pathinfo($namaSuratPernyataan, PATHINFO_EXTENSION));
    $formatProposal = strtolower(pathinfo($namaProposalPenelitian, PATHINFO_EXTENSION));

    $suratIdentitasBaru = uniqid() . '.' . $formatIdentitas;
    $lokasiPenyimpananIdentitas = '../assets/image/uploads/' . $suratIdentitasBaru;

    $suratPengantarBaru = uniqid() . '.' . $formatPengantar;
    $lokasiPenyimpananPengantar = '../assets/image/uploads/' . $suratPengantarBaru;

    $suratPernyataanBaru = uniqid() . '.' . $formatPernyataan;
    $lokasiPenyimpananPernyataan = '../assets/image/uploads/' . $suratPernyataanBaru;

    $proposalPenelitianBaru = uniqid() . '.' . $formatProposal;
    $lokasiPenyimpananProposal = '../assets/image/uploads/' . $proposalPenelitianBaru;

    if (!empty($pesanKesalahan)) {
        setPesanKesalahan($pesanKesalahan);
        header("Location: $akarUrl" . "src/user/pages/ajukan.php");
        exit;
    }

    if (!preg_match('/^\d+$/', $_POST['NIM_atau_KTP'])) {
        $pesanKesalahan .= "NIM atau KTP hanya boleh berisi angka. ";
    }

    $dataPendidikan = array(
        'Nama_Pendidikan_Dan_Penelitian' => $nama,
        'NIM_KTP' => $nim_atau_ktp,
        'Program_Studi_Fakultas' => $program_studi_atau_fakultas,
        'Universitas_Instansi' => $universitas_atau_instansi,
        'No_Telepon_Pendidikan_Penelitian' => $nomorHPFormatted,
        'Email_Pendidikan_Penelitian' => $email,
        'Informasi_Pendidikan_Penelitian_Yang_Dibutuhkan' => $informasiDibutuhkan,
        'Identitas_Diri' => $suratIdentitasBaru,
        'Surat_Pengantar_Kepsek_Rektor_Dekan' => $suratPengantarBaru,
        'Pernyataan_Tidak_Digunakan_Kepentingan_Lain' => $suratPernyataanBaru,
        'Proposal_Penelitian_Telah_Disetujui' => $proposalPenelitianBaru
    );

    $simpanDataPendidikan = $objekDataPendidikan->tambahDataPendidikanPenelitian($dataPendidikan);

    if ($simpanDataPendidikan) {
        setPesanKeberhasilan("Data kegiatan pendidikan dan penelitian berhasil ditambahkan.");
    } else {
        setPesanKesalahan("Gagal menambahkan data kegiatan pendidikan dan penelitian.");
    }

    header("Location: $akarUrl" . "src/user/pages/ajukan.php");
    exit;
} else {
    header("Location: $akarUrl" . "src/user/pages/ajukan.php");
    exit;
}
