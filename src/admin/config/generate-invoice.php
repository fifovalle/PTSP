<?php
require_once '../../../vendor2/vendor/autoload.php';
include 'databases.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->set_option('isRemoteEnabled', true);
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
  
  .header-invoice, 
  .footer-invoice {
    width: 100%;
    padding: 0;
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

  .line-items-container th.heading-result {
    width: 50px;
    text-align: center;
  }
  
  .info-result td{
    width: 30px;
  }
  </style>
  
<img class="header-invoice" src="http://localhost/PTSP/src/admin/assets/image/pages/faktur-head.jpg" alt="">
<hr style="color: #999">
<table class="invoice-info-container">
  <tr>
    <td rowspan="2" class="client-name">
      Faktur Pemesanan
    </td>
  </tr>
  <tr></tr>
  <tr>
    <td>
      Invoice Date: <strong>May 24th, 2024</strong>
    </td>
  </tr>
  <tr>
    <td>
      Invoice No: <strong>12345</strong>
    </td>
  </tr>
</table>
<table class="line-items-container">
  <thead>
    <tr>
      <td colspan="4" class="left"><h3>STASIUN METEOROLOGI</h3></td>
    </tr>
    <tr>
      <th class="heading-description">Produk</th>
      <th class="heading-rekening">No. Rekening</th>
      <th class="heading-subtotal">Harga</th>
      <th class="heading-quantity">Jumlah</th>
      <th class="heading-total">Total</th>
      <th class="heading-result">Status Pesanan</th>
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
      HTML;

    $html .= <<<HTML
        <td class="center">
    HTML;
    switch ($transaksiA['Status_Pesanan']) {
      case 'Belum Lunas':
        $html .= '<img  src="http://localhost/PTSP/src/admin/assets/image/pages/faktur-cross.svg" alt="Belum Lunas">';
        break;
      case 'Sedang Ditinjau':
        $html .= '<img src="http://localhost/PTSP/src/admin/assets/image/pages/faktur-pending.svg" alt="Sedang Ditinjau">';
        break;
      case 'Lunas':
        $html .= '<img src="http://localhost/PTSP/src/admin/assets/image/pages/faktur-check.svg" alt="Lunas">';
        break;
      default:
        $html .= '';
        break;
    }
    $html .= <<<HTML
    </td>
HTML;
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
      <td colspan="5" class="left"><h3>STASIUN KLIMATOLOGI</h3></td>
    </tr>
    <tr>
      <th class="heading-description">Produk</th>
      <th class="heading-rekening">No. Rekening</th>
      <th class="heading-subtotal">Harga</th>
      <th class="heading-quantity">Jumlah</th>
      <th class="heading-total">Total</th>
      <th class="heading-result">Status Pesanan</th>
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
    HTML;
    $html .= <<<HTML
        <td class="center">
    HTML;
    switch ($transaksiA['Status_Pesanan']) {
      case 'Belum Lunas':
        $html .= '<img  src="http://localhost/PTSP/src/admin/assets/image/pages/faktur-cross.svg" alt="Belum Lunas">';
        break;
      case 'Sedang Ditinjau':
        $html .= '<img src="http://localhost/PTSP/src/admin/assets/image/pages/faktur-pending.svg" alt="Sedang Ditinjau">';
        break;
      case 'Lunas':
        $html .= '<img src="http://localhost/PTSP/src/admin/assets/image/pages/faktur-check.svg" alt="Lunas">';
        break;
      default:
        $html .= '';
        break;
    }
    $html .= <<<HTML
    </td>
HTML;
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
      <td colspan="5" class="left"><h3>STASIUN GEOFISIKA</h3></td>
    </tr>
    <tr>
      <th class="heading-description">Produk</th>
      <th class="heading-rekening">No. Rekening</th>
      <th class="heading-subtotal">Harga</th>
      <th class="heading-quantity">Jumlah</th>
      <th class="heading-total">Total</th>
      <th class="heading-result">Status Pesanan</th>
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
      HTML;
    $html .= <<<HTML
        <td class="center">
    HTML;
    switch ($transaksiA['Status_Pesanan']) {
      case 'Belum Lunas':
        $html .= '<img  src="http://localhost/PTSP/src/admin/assets/image/pages/faktur-cross.svg" alt="Belum Lunas">';
        break;
      case 'Sedang Ditinjau':
        $html .= '<img src="http://localhost/PTSP/src/admin/assets/image/pages/faktur-pending.svg" alt="Sedang Ditinjau">';
        break;
      case 'Lunas':
        $html .= '<img src="http://localhost/PTSP/src/admin/assets/image/pages/faktur-check.svg" alt="Lunas">';
        break;
      default:
        $html .= '';
        break;
    }
    $html .= <<<HTML
    </td>
HTML;
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
<table class="info-result">
  <tr>
    <th class="left" colspan="6">Keterangan</th>
  </tr>
  <tr>
    <td class="right image">
      <img src="http://localhost/PTSP/src/admin/assets/image/pages/faktur-check.svg" alt="Lunas">
    </td>
    <td>: Lunas</td>
    <td class="right image">
      <img src="http://localhost/PTSP/src/admin/assets/image/pages/faktur-pending.svg" alt="Lunas">
    </td>
    <td>: Sedang Ditinjau</td>
    <td class="right image">
      <img src="http://localhost/PTSP/src/admin/assets/image/pages/faktur-cross.svg" alt="Lunas">
    </td>
    <td>: Belum Lunas</td>
  </tr>
</table>
HTML;
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream('faktur.pdf');
