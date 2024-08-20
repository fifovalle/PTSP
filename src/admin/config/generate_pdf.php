<?php
include 'connection.php';
require '../../../vendor/autoload.php';

use Dompdf\Dompdf;

$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : '';

$sql = "SELECT transaksi.*, pengguna.*, informasi.*, perusahaan.*, jasa.*, pengajuan.*, ikm.* FROM transaksi 
        LEFT JOIN pengguna ON transaksi.ID_Pengguna = pengguna.ID_Pengguna
        LEFT JOIN informasi ON transaksi.ID_Informasi = informasi.ID_Informasi
        LEFT JOIN perusahaan ON transaksi.ID_Perusahaan = perusahaan.ID_Perusahaan
        LEFT JOIN pengajuan ON transaksi.ID_Pengajuan = pengajuan.ID_Pengajuan
        LEFT JOIN ikm ON transaksi.ID_IKM = ikm.ID_IKM
        LEFT JOIN jasa ON transaksi.ID_Jasa = jasa.ID_Jasa WHERE MONTH(transaksi.Tanggal_Upload_Bukti) = $bulan";
$result = $koneksi->query($sql);

$namaBulan = date('F', mktime(0, 0, 0, $bulan, 10));

$html = '
<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            margin: 40px;
            background-color: #f8f9fa;
            color: #2c3e50;
        }
        h1 {
            text-align: center;
            color: #2c3e50;
            font-size: 26px;
            margin-bottom: 10px;
        }
        .header {
            text-align: center;
            margin-bottom: 50px;
        }
        .header img {
            width: 100px;
            height: auto;
            margin-bottom: 10px;
        }
        .header h2 {
            margin: 0;
            color: #34495e;
            font-size: 20px;
            font-weight: normal;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table, th, td {
            border: 1px solid #dee2e6;
        }
        th, td {
            padding: 14px;
            text-align: center;
            font-size: 14px;
        }
        th {
            background-color: #2980b9;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
        }
        tr:nth-child(even) {
            background-color: #ecf0f1;
        }
        tr:nth-child(odd) {
            background-color: #ffffff;
        }
        .no-data {
            text-align: center;
            font-size: 18px;
            color: #7f8c8d;
            margin-top: 20px;
        }
        .footer {
            text-align: center;
            margin-top: 60px;
            font-size: 12px;
            color: #95a5a6;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Laporan Bulanan</h2>
        <h1>' . $namaBulan . '</h1>
    </div>';

if ($result->num_rows > 0) {
    $html .= '
    <table>
        <tr>
            <th>Informasi</th>
            <th>Jasa</th>
            <th>Jumlah Barang</th>
            <th>Jenis Transaksi</th>
            <th>Total Transaksi</th>
        </tr>';
    while ($row = $result->fetch_assoc()) {
        $totalTransaksi = 'Rp ' . number_format($row['Total_Transaksi'], 0, ',', '.');
        if ($row['Apakah_Gratis'] == 1) {
            $totalTransaksi = '<span style="text-decoration: line-through; color: #e74c3c;">' . $totalTransaksi . '</span>';
        }
        $html .= '
            <tr>
                <td>' . (!empty($row['Nama_Informasi']) ? $row['Nama_Informasi'] : '-') . '</td>
                <td>' . (!empty($row['Nama_Jasa']) ? $row['Nama_Jasa'] : '-') . '</td>
                <td>' . $row['Jumlah_Barang'] . '</td>
                <td>' . ($row['Apakah_Gratis'] == 0 ? 'GRATIS' : 'BAYAR') . '</td>
                <td>' . $totalTransaksi . '</td>
            </tr>';
    }

    $html .= '</table>';
} else {
    $html .= '<p class="no-data">Tidak ada data transaksi untuk bulan ini.</p>';
}

$html .= '
    <div class="footer">
        <p>&copy; ' . date('Y') . ' BMKG. Semua hak dilindungi.</p>
    </div>
</body>
</html>';

$koneksi->close();

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

$dompdf->stream("Laporan_Bulanan_$namaBulan.pdf", ["Attachment" => false]);
