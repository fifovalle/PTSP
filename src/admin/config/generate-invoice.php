<?php
require_once '../../../vendor2/vendor/autoload.php';
include 'databases.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$id = $_SESSION['ID_Pengguna'] ?? $_SESSION['ID_Perusahaan'];
$transaksiModel = new Transaksi($koneksi);
$dataTransaksiA = $transaksiModel->tampilkanPembayaranTransaksiASesuaiSession($id);
$dataTransaksiB = $transaksiModel->tampilkanPembayaranTransaksiBSesuaiSession($id);
$dataTransaksiC = $transaksiModel->tampilkanPembayaranTransaksiCSesuaiSession($id);
$html = <<<HTML
  <style>
  body {
    font-size: 16px;
  }
  
  table {
    width: 100%;
    border-collapse: collapse;
  }
  
  table tr td {
    padding: 0;
  }
  
  .bold {
    font-weight: bold;
  }
  
  .right {
    text-align: right;
  }

  .center {
    text-align: center;
  }

  .left {
    text-align: left;
  }
  
  .total {
    font-weight: bold;
    color: #fb7578;
  }
  
  .invoice-info-container {
    font-size: 0.875em;
  }
  .invoice-info-container td {
    padding: 4px 0;
  }
  
  .client-name {
    font-size: 1.5em;
    vertical-align: top;
    font-weight: bold;
  }
  
  .line-items-container {
    margin: 20px 0;
    font-size: 0.875em;
  }
  
  .line-items-container th {
    text-align: left;
    color: #999;
    border-bottom: 2px solid #ddd;
    padding: 10px 0 15px 0;
    font-size: 13px;
    text-transform: uppercase;
  }
  
  .line-items-container th:last-child {
    text-align: right;
  }
  
  .line-items-container td {
    padding: 15px 0;
  }
  
  .line-items-container tbody tr:first-child td {
    padding-top: 15px;
  }
  
  .line-items-container th.heading-description {
    width: 250px;
    text-align: left;
  }

  .line-items-container th.heading-rekening {
    width: 70px;
    text-align: center;
  }
  
  .line-items-container th.heading-subtotal {
    width: 100px;
    text-align: center;
  }

  .line-items-container th.heading-quantity {
    width: 50px;
    text-align: center;
  }

  .line-items-container th.heading-total {
    width: 100px;
    text-align: center;
  }
  
  .footer {
    margin-top: 100px;
    background-color: black;
  }
  
  .footer-info {
    float: right;
    margin-top: 5px;
    font-size: 0.75em;
    color: #ccc;
  }
  
  .footer-info span {
    padding: 0 5px;
    color: #999;
  }
  
  .footer-info span:last-child {
    padding-right: 0;
  }
  </style>
  
<table class="invoice-info-container">
  <tr>
    <td rowspan="2" class="client-name">
      Faktur Pemesanan
    </td>
    <td class="right">
      PTSP BMKG Provinsi Bengkulu
    </td>
  </tr>
  <tr>
    <td class="right">
    Kota Bengkulu 
    </td>
  </tr>
  <tr>
    <td>
      Invoice Date: <strong>May 24th, 2024</strong>
    </td>
    <td class="right">
      0823 7560 9090
    </td>
  </tr>
  <tr>
    <td>
      Invoice No: <strong>12345</strong>
    </td>
    <td class="right">
    https://bengkulu.bmkg.go.id/
    </td>
  </tr>
</table>
<hr style="color: #999">
<table class="line-items-container">
  <thead>
    <tr>
      <td colspan="6" class="left"><h3>STASIUN METEOROLOGI</h3></td>
    </tr>
    <tr>
      <th class="heading-description">Produk</th>
      <th class="heading-rekening">No. Rekening</th>
      <th class="heading-subtotal">Harga</th>
      <th class="heading-quantity">Jumlah</th>
      <th class="heading-total">Total</th>
      <th class="heading-total">Status Pesanan</th>
    </tr>
  </thead>
  <tbody>
HTML;
if (!empty($dataTransaksiA)) {
  foreach ($dataTransaksiA as $transaksiA) {
    $namaProdukA = isset($transaksiA['Nama_Informasi']) ? $transaksiA['Nama_Informasi'] : (isset($transaksiA['Nama_Jasa']) ? $transaksiA['Nama_Jasa'] : '');
    $rekeningProdukA = isset($transaksiA['No_Rekening_Informasi']) ? $transaksiA['No_Rekening_Informasi'] : (isset($transaksiA['No_Rekening_Jasa']) ? $transaksiA['No_Rekening_Jasa'] : '');
    $hargaProdukA = isset($transaksiA['Harga_Informasi']) ? number_format($transaksiA['Harga_Informasi'], 0, ',', '.') : number_format($transaksiA['Harga_Jasa'], 0, ',', '.');
    $totalProdukA = number_format($transaksiA['Total_Transaksi'], 0, ',', '.');
    $html .= <<<HTML
      <tr>
          <td class="left">{$namaProdukA}</td>
          <td class="center">{$rekeningProdukA}</td>
          <td class="center">Rp{$hargaProdukA}</td>
          <td class="center">{$transaksiA['Jumlah_Barang']}</td>
          <td class="center">Rp{$totalProdukA}</td>
          <td style="font-size: 14px; font-weight: bold; border-radius: 5px;
HTML;

    switch ($transaksiA['Status_Pesanan']) {
      case 'Belum Lunas':
        $html .= 'background-color: #dc3545; color: white;">Belum Lunas</td>';
        break;
      case 'Sedang Ditinjau':
        $html .= 'background-color: #ffc107; color: black;">Sedang Ditinjau</td>';
        break;
      case 'Lunas':
        $html .= 'background-color: #28a745; color: white;">Lunas</td>';
        break;
      default:
        $html .= 'background-color: #6c757d; color: white;">Status Tidak Dikenali</td>';
        break;
    }
    $html .= "</td></tr>";
  }
} else {
  $html .= <<<HTML
  <tr>
    <td colspan="6" style="text-align: center; font-weight: bold; color: #dc3545">Tidak ada transaksi untuk ditampilkan!</td>
  </tr>
HTML;
}
$html .= <<<HTML
  </tbody>
</table>
<table class="line-items-container">
  <thead>
    <tr>
      <td colspan="6" class="left"><h3>STASIUN KLIMATOLOGI</h3></td>
    </tr>
    <tr>
      <th class="heading-description">Produk</th>
      <th class="heading-rekening">No. Rekening</th>
      <th class="heading-subtotal">Harga</th>
      <th class="heading-quantity">Jumlah</th>
      <th class="heading-total">Total</th>
      <th class="heading-total">Status Pesanan</th>
    </tr>
  </thead>
  <tbody>
HTML;
if (!empty($dataTransaksiB)) {
  foreach ($dataTransaksiB as $transaksiB) {
    $namaProdukB = isset($transaksiB['Nama_Informasi']) ? $transaksiB['Nama_Informasi'] : (isset($transaksiB['Nama_Jasa']) ? $transaksiB['Nama_Jasa'] : '');
    $rekeningProdukB = isset($transaksiB['No_Rekening_Informasi']) ? $transaksiB['No_Rekening_Informasi'] : (isset($transaksiB['No_Rekening_Jasa']) ? $transaksiB['No_Rekening_Jasa'] : '');
    $hargaProdukB = isset($transaksiB['Harga_Informasi']) ? number_format($transaksiB['Harga_Informasi'], 0, ',', '.') : number_format($transaksiB['Harga_Jasa'], 0, ',', '.');
    $totalProdukB = number_format($transaksiB['Total_Transaksi'], 0, ',', '.');
    $html .= <<<HTML
      <tr>
          <td class="left">{$namaProdukB}</td>
          <td class="center">{$rekeningProdukB}</td>
          <td class="center">Rp{$hargaProdukB}</td>
          <td class="center">{$transaksiB['Jumlah_Barang']}</td>
          <td class="center">Rp{$totalProdukB}</td>
          <td style="font-size: 14px; font-weight: bold; border-radius: 5px;
HTML;

    switch ($transaksiA['Status_Pesanan']) {
      case 'Belum Lunas':
        $html .= 'background-color: #dc3545; color: white;">Belum Lunas</td>';
        break;
      case 'Sedang Ditinjau':
        $html .= 'background-color: #ffc107; color: black;">Sedang Ditinjau</td>';
        break;
      case 'Lunas':
        $html .= 'background-color: #28a745; color: white;">Lunas</td>';
        break;
      default:
        $html .= 'background-color: #6c757d; color: white;">Status Tidak Dikenali</td>';
        break;
    }
    $html .= "</td></tr>";
  }
} else {
  $html .= <<<HTML
  <tr>
    <td colspan="6" style="text-align: center; font-weight: bold; color: #dc3545">Tidak ada transaksi untuk ditampilkan!</td>
  </tr>
HTML;
}
$html .= <<<HTML
  </tbody>
</table>

<table class="line-items-container">
  <thead>
  <tr>
      <td colspan="6" class="left"><h3>STASIUN GEOFISIKA</h3></td>
    </tr>
    <tr>
      <th class="heading-description">Produk</th>
      <th class="heading-rekening">No. Rekening</th>
      <th class="heading-subtotal">Harga</th>
      <th class="heading-quantity">Jumlah</th>
      <th class="heading-total">Total</th>
      <th class="heading-total">Status Pesanan</th>
    </tr>
  </thead>
  <tbody>
HTML;
if (!empty($dataTransaksiC)) {
  foreach ($dataTransaksiC as $transaksiC) {
    $namaProdukA = isset($transaksiC['Nama_Informasi']) ? $transaksiC['Nama_Informasi'] : (isset($transaksiC['Nama_Jasa']) ? $transaksiC['Nama_Jasa'] : '');
    $rekeningProdukA = isset($transaksiC['No_Rekening_Informasi']) ? $transaksiC['No_Rekening_Informasi'] : (isset($transaksiC['No_Rekening_Jasa']) ? $transaksiC['No_Rekening_Jasa'] : '');
    $hargaProdukA = isset($transaksiC['Harga_Informasi']) ? number_format($transaksiC['Harga_Informasi'], 0, ',', '.') : number_format($transaksiC['Harga_Jasa'], 0, ',', '.');
    $totalProdukA = number_format($transaksiC['Total_Transaksi'], 0, ',', '.');
    $html .= <<<HTML
      <tr>
          <td class="left">{$namaProdukA}</td>
          <td class="center">{$rekeningProdukA}</td>
          <td class="center">Rp{$hargaProdukA}</td>
          <td class="center">{$transaksiC['Jumlah_Barang']}</td>
          <td class="center">Rp{$totalProdukA}</td>
          <td style="font-size: 14px; font-weight: bold; border-radius: 5px;
HTML;

    switch ($transaksiA['Status_Pesanan']) {
      case 'Belum Lunas':
        $html .= 'background-color: #dc3545; color: white;">Belum Lunas</td>';
        break;
      case 'Sedang Ditinjau':
        $html .= 'background-color: #ffc107; color: black;">Sedang Ditinjau</td>';
        break;
      case 'Lunas':
        $html .= 'background-color: #28a745; color: white;">Lunas</td>';
        break;
      default:
        $html .= 'background-color: #6c757d; color: white;">Status Tidak Dikenali</td>';
        break;
    }
    $html .= "</td></tr>";
  }
} else {
  $html .= <<<HTML
  <tr>
    <td colspan="6" style="text-align: center; font-weight: bold; color: #dc3545">Tidak ada transaksi untuk ditampilkan!</td>
  </tr>
HTML;
}
$html .= <<<HTML
</table>

<div class="footer">
  <div class="footer-info">
    <span>PTSP BMKG Provinsi Bengkulu </span> |
    <span>0823 7560 9090</span> |
    <span>https://bengkulu.bmkg.go.id/</span>
  </div>
</div>
HTML;
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream('faktur.pdf');
