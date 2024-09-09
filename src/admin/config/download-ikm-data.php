<?php
require '../../../vendor/autoload.php';

use Dompdf\Dompdf;

$ikm_id = $_GET['ikm_id'];

$connection = new mysqli("localhost", "root", "", "ptsp_bmkg");

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$query = "SELECT * FROM ikm WHERE ID_Ikm = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $ikm_id);
$stmt->execute();
$result = $stmt->get_result();
$dataIKM = $result->fetch_assoc();

if ($dataIKM) {
    $dompdf = new Dompdf();

    $html = '
    <h1>Data IKM</h1>
    <p>Nama: ' . htmlspecialchars($dataIKM['Nama']) . '</p>
    <p>Pekerjaan: ' . htmlspecialchars($dataIKM['Pekerjaan']) . '</p>
    <p>Umur: ' . htmlspecialchars($dataIKM['Umur']) . '</p>
    <p>Jenis Kelamin: ' . htmlspecialchars($dataIKM['Jenis_Kelamin']) . '</p>
    <p>Pendidikan Terakhir: ' . htmlspecialchars($dataIKM['Pendidikan_Terakhir']) . '</p>
    <p>Asal Daerah: ' . htmlspecialchars($dataIKM['Asal_Daerah']) . '</p>
    <p>Jenis Layanan: ' . htmlspecialchars($dataIKM['Jenis_Layanan']) . '</p>
    <p>Kualitas Pelayanan Terbuka: ' . htmlspecialchars($dataIKM['Kualitas_Pelayanan_Terbuka']) . '</p>
    <p>Harapan Konsumen Terbuka: ' . htmlspecialchars($dataIKM['Harapan_Konsumen_Terbuka']) . '</p>
    <p>Kualitas Pelayanan Kehidupan: ' . htmlspecialchars($dataIKM['Kualitas_Pelayanan_Kehidupan']) . '</p>
    <p>Harapan Konsumen Kehidupan: ' . htmlspecialchars($dataIKM['Harapan_Konsumen_Kehidupan']) . '</p>
    <p>Kualitas Pelayanan Dipahami: ' . htmlspecialchars($dataIKM['Kualitas_Pelayanan_Dipahami']) . '</p>
    <p>Harapan Konsumen Dipahami: ' . htmlspecialchars($dataIKM['Harapan_Konsumen_Dipahami']) . '</p>
    <p>Kualitas Pelayanan Persyaratan: ' . htmlspecialchars($dataIKM['Kualitas_Pelayanan_Persyaratan']) . '</p>
    <p>Harapan Konsumen Persyaratan: ' . htmlspecialchars($dataIKM['Harapan_Konsumen_Persyaratan']) . '</p>
    <p>Kualitas Pelayanan Diakses: ' . htmlspecialchars($dataIKM['Kualitas_Pelayanan_Diakses']) . '</p>
    <p>Harapan Konsumen Diakses: ' . htmlspecialchars($dataIKM['Harapan_Konsumen_Diakses']) . '</p>
    <p>Kualitas Pelayanan Akurat: ' . htmlspecialchars($dataIKM['Kualitas_Pelayanan_Akurat']) . '</p>
    <p>Harapan Konsumen Akurat: ' . htmlspecialchars($dataIKM['Harapan_Konsumen_Akurat']) . '</p>
    <p>Kualitas Pelayanan Data: ' . htmlspecialchars($dataIKM['Kualitas_Pelayanan_Data']) . '</p>
    <p>Harapan Konsumen Data: ' . htmlspecialchars($dataIKM['Harapan_Konsumen_Data']) . '</p>
    <p>Kualitas Pelayanan Sederhana: ' . htmlspecialchars($dataIKM['Kualitas_Pelayanan_Sederhana']) . '</p>
    <p>Kualitas Pelayanan Waktu: ' . htmlspecialchars($dataIKM['Kualitas_Pelayanan_Waktu']) . '</p>
    <p>Harapan Konsumen Waktu: ' . htmlspecialchars($dataIKM['Harapan_Konsumen_Waktu']) . '</p>
    <p>Kualitas Pelayanan Biaya Terbuka: ' . htmlspecialchars($dataIKM['Kualitas_Pelayanan_Biaya_Terbuka']) . '</p>
    <p>Harapan Konsumen Biaya Terbuka: ' . htmlspecialchars($dataIKM['Harapan_Konsumen_Biaya_Terbuka']) . '</p>
    <p>Kualitas Pelayanan KKN: ' . htmlspecialchars($dataIKM['Kualitas_Pelayanan_KKN']) . '</p>
    <p>Kualitas Pelayanan Sesuai: ' . htmlspecialchars($dataIKM['Kualitas_Pelayanan_Sesuai']) . '</p>
    <p>Harapan Konsumen Sesuai: ' . htmlspecialchars($dataIKM['Harapan_Konsumen_Sesuai']) . '</p>
    <p>Kualitas Pelayanan Daftar: ' . htmlspecialchars($dataIKM['Kualitas_Pelayanan_Daftar']) . '</p>
    <p>Harapan Konsumen Daftar: ' . htmlspecialchars($dataIKM['Harapan_Konsumen_Daftar']) . '</p>
    <p>Kualitas Pelayanan Sarana: ' . htmlspecialchars($dataIKM['Kualitas_Pelayanan_Sarana']) . '</p>
    <p>Harapan Konsumen Sarana: ' . htmlspecialchars($dataIKM['Harapan_Konsumen_Sarana']) . '</p>
    <p>Kualitas Pelayanan Prosedur: ' . htmlspecialchars($dataIKM['Kualitas_Pelayanan_Prosedur']) . '</p>
    <p>Harapan Konsumen Prosedur: ' . htmlspecialchars($dataIKM['Harapan_Konsumen_Prosedur']) . '</p>
    <p>Kualitas Pelayanan Petugas: ' . htmlspecialchars($dataIKM['Kualitas_Pelayanan_Petugas']) . '</p>
    <p>Harapan Konsumen Petugas: ' . htmlspecialchars($dataIKM['Harapan_Konsumen_Petugas']) . '</p>
    <p>Kualitas Pelayanan Aman: ' . htmlspecialchars($dataIKM['Kualitas_Pelayanan_Aman']) . '</p>
    <p>Harapan Konsumen Aman: ' . htmlspecialchars($dataIKM['Harapan_Konsumen_Aman']) . '</p>
    <p>Kualitas Pelayanan Keberadaan: ' . htmlspecialchars($dataIKM['Kualitas_Pelayanan_Keberadaan']) . '</p>
    <p>Harapan Konsumen Keberadaan: ' . htmlspecialchars($dataIKM['Harapan_Konsumen_Keberadaan']) . '</p>
    <p>Kualitas Pelayanan Sikap: ' . htmlspecialchars($dataIKM['Kualitas_Pelayanan_Sikap']) . '</p>
    <p>Harapan Konsumen Sikap: ' . htmlspecialchars($dataIKM['Harapan_Konsumen_Sikap']) . '</p>
    <p>Kualitas Pelayanan Publik: ' . htmlspecialchars($dataIKM['Kualitas_Pelayanan_Publik']) . '</p>
    <p>Harapan Konsumen Publik: ' . htmlspecialchars($dataIKM['Harapan_Konsumen_Publik']) . '</p>
    ';

    $dompdf->loadHtml($html);

    $dompdf->setPaper('A4', 'portrait');

    $dompdf->render();

    $dompdf->stream("data_ikm_" . $ikm_id . ".pdf", ["Attachment" => true]);
} else {
    echo "Data tidak ditemukan";
}

$stmt->close();
$connection->close();
