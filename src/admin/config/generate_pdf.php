<?php
include 'connection.php';
require '../../../vendor/autoload.php';

use Dompdf\Dompdf;

$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : '';

$sql = "SELECT * FROM pengajuan WHERE DATE_FORMAT(Tanggal_Pengajuan, '%m') = '$bulan'";
$result = $koneksi->query($sql);

$namaBulan = date('F', mktime(0, 0, 0, $bulan, 10));
$tahunSekarang = date('Y');

$kolomID = [
    'ID_Bencana',
    'ID_Keagamaan',
    'ID_Pertahanan',
    'ID_Sosial',
    'ID_Pusat_Daerah',
    'ID_Penelitian',
    'ID_Tarif'
];

$kolomTambahan = [
    'Status_Pengajuan',
    'Keterangan_Surat_Ditolak',
    'Apakah_Gratis',
    'Jenis_Perbaikan'
];

$kolomAktif = array_fill_keys(array_merge($kolomID, $kolomTambahan), false);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        foreach (array_merge($kolomID, $kolomTambahan) as $kolom) {
            if (!is_null($row[$kolom])) {
                $kolomAktif[$kolom] = true;
            }
        }
    }
    // Menghasilkan HTML tabel
    $html = "
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
            color: #333;
            background-color: #f4f4f4;
        }
        h1 {
            text-align: center;
            color: #2c3e50;
            font-size: 26px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
            font-size: 12px;
        }
        th {
            background-color: #3498db;
            color: white;
            font-size: 14px;
        }
        td {
            font-size: 12px;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .badge {
            display: inline-block;
            padding: 5px 10px;
            font-size: 12px;
            font-weight: bold;
            text-align: center;
            border-radius: 5px;
            color: #fff;
            background-color: #007bff;
        }
        .badge.sedang-ditinjau {
            background-color: #ffc107; 
        }
        .badge.lainnya {
            background-color: #28a745; 
        }
        .no-data {
            background-color: #fff3f3;
            border: 1px solid #f5c6cb;
            color: #721c24;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            margin: 20px 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .no-data i {
            font-size: 24px;
            color: #721c24;
            margin-right: 10px;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #888;
            margin-top: 20px;
        }
        @media (max-width: 768px) {
            table, th, td {
                font-size: 10px;
            }
        }
        @page {
            margin: 20mm;
        }
    </style>
</head>
<body>
    <h1>Laporan Bulanan - $namaBulan</h1>";

    if ($result->num_rows > 0) {
        $html .= "
    <table>
        <thead>
            <tr>";

        // Header kolom
        foreach ($kolomAktif as $kolom => $aktif) {
            if ($aktif) {
                $label = str_replace('_', ' ', $kolom);
                $label = ucwords(strtolower($label));
                $html .= "<th>$label</th>";
            }
        }

        $html .= "</tr></thead><tbody>";

        // Baris data
        $result->data_seek(0); // Reset result pointer
        while ($row = $result->fetch_assoc()) {
            $html .= "<tr>";

            foreach ($kolomAktif as $kolom => $aktif) {
                if ($aktif) {
                    $value = htmlspecialchars($row[$kolom]);
                    if ($kolom == 'Apakah_Gratis') {
                        $value = $value ? 'Ya' : 'Tidak';
                    } elseif ($kolom == 'Status_Pengajuan') {
                        // Tambahkan badge untuk Status Pengajuan
                        if ($value == 'Sedang Ditinjau') {
                            $value = "<span class='badge sedang-ditinjau'>$value</span>";
                        } else {
                            $value = "<span class='badge lainnya'>$value</span>";
                        }
                    }
                    $html .= "<td>$value</td>";
                }
            }

            $html .= "</tr>";
        }

        $html .= "
        </tbody>
    </table>";
    } else {
        $html .= "
    <div class='no-data'>
        <i class='fas fa-exclamation-triangle'></i>
        <p>Tidak ada data untuk bulan $namaBulan</p>
    </div>";
    }

    $html .= "
<div class='footer'>
    <p>Copyright &copy; $tahunSekarang BMKG</p>
</div>
</body>
</html>";

    $koneksi->close();

    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    $dompdf->stream("Laporan_Bulanan_$namaBulan.pdf", ["Attachment" => false]);
?>

<?php
}
