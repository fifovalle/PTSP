<?php
include 'connection.php';
require '../../../vendor/autoload.php';

use Dompdf\Dompdf;

$idTransaksi = $_GET['id'];

$sql = "SELECT * FROM transaksi WHERE ID_Tranksaksi = ?";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("i", $idTransaksi);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$html = "
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #4CAF50;
        }
        p {
            line-height: 1.6;
            margin: 10px 0;
        }
        .details {
            margin-bottom: 20px;
        }
        .details p {
            margin: 5px 0;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9em;
            color: #777;
        }
    </style>
</head>
<body>
    <div class='container'>
        <h1>Detail Transaksi</h1>
        <div class='details'>
            <p><strong>ID Transaksi:</strong> {$row['ID_Tranksaksi']}</p>
            <p><strong>ID Admin:</strong> {$row['ID_Admin']}</p>
            <p><strong>ID Pengguna:</strong> {$row['ID_Pengguna']}</p>
            <p><strong>ID Perusahaan:</strong> {$row['ID_Perusahaan']}</p>
            <p><strong>ID Informasi:</strong> {$row['ID_Informasi']}</p>
            <p><strong>ID Jasa:</strong> {$row['ID_Jasa']}</p>
            <p><strong>ID Pengajuan:</strong> {$row['ID_Pengajuan']}</p>
            <p><strong>ID IKM:</strong> {$row['ID_IKM']}</p>
            <p><strong>Jumlah Barang:</strong> {$row['Jumlah_Barang']}</p>
            <p><strong>Total Transaksi:</strong> {$row['Total_Transaksi']}</p>
            <p><strong>Tanggal Pembelian:</strong> {$row['Tanggal_Pembelian']}</p>
            <p><strong>Status Transaksi:</strong> {$row['Status_Transaksi']}</p>
            <p><strong>Status Pesanan:</strong> {$row['Status_Pesanan']}</p>
        </div>
        <div class='footer'>
            <p>Dibuat Oleh BMKG</p>
        </div>
    </div>
</body>
</html>
";

$dompdf = new Dompdf();
$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'portrait');

$dompdf->render();

$dompdf->stream("Transaksi_Ke_$idTransaksi.pdf", ["Attachment" => 1]);
