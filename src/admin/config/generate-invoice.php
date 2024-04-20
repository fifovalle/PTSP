<?php
require_once '../../../vendor2/vendor/autoload.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();

$html = '
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
  
  .status-stasiunA, .status-stasiunB, .status-stasiunC {
    color: red;
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
      Invoice Pemesanan
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
      <td colspan="3" class="left"><h3>STASIUN METEOROLOGI</h3></td>
      <td colspan="2" class="status-stasiunA right"><h3>BELUM LUNAS</h3></td>
    </tr>
    <tr>
      <th class="heading-description">Produk</th>
      <th class="heading-rekening">No. Rekening</th>
      <th class="heading-subtotal">Harga</th>
      <th class="heading-quantity">Jumlah</th>
      <th class="heading-total">Total</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="left">Jasa 1</td>
      <td class="center">1111111111</td>
      <td class="center">Rp 100.000</td>
      <td class="center">2</td>
      <td class="center">Rp 200.000</td>
    </tr>
    <tr>
      <td class="left">Informasi 1</td>
      <td class="center">1111111111</td>
      <td class="center">Rp 100.000</td>
      <td class="center">2</td>
      <td class="center">Rp 200.000</td>
    </tr>
  </tbody>
</table>

<table class="line-items-container">
  <thead>
    <tr>
      <td colspan="3" class="left"><h3>STASIUN KLIMATOLOGI</h3></td>
      <td colspan="2" class="status-stasiunB right"><h3>BELUM LUNAS</h3></td>
    </tr>
    <tr>
      <th class="heading-description">Produk</th>
      <th class="heading-rekening">No. Rekening</th>
      <th class="heading-subtotal">Harga</th>
      <th class="heading-quantity">Jumlah</th>
      <th class="heading-total">Total</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="left">Jasa 2</td>
      <td class="center">1111111111</td>
      <td class="center">Rp 100.000</td>
      <td class="center">2</td>
      <td class="center">Rp 200.000</td>
    </tr>
    <tr>
      <td class="left">Informasi 2</td>
      <td class="center">1111111111</td>
      <td class="center">Rp 100.000</td>
      <td class="center">2</td>
      <td class="center">Rp 200.000</td>
    </tr>
  </tbody>
</table>

<table class="line-items-container">
  <thead>
  <tr>
      <td colspan="3" class="left"><h3>STASIUN GEOFISIKA</h3></td>
      <td colspan="2" class="status-stasiunC right"><h3>BELUM LUNAS</h3></td>
    </tr>
    <tr>
      <th class="heading-description">Produk</th>
      <th class="heading-rekening">No. Rekening</th>
      <th class="heading-subtotal">Harga</th>
      <th class="heading-quantity">Jumlah</th>
      <th class="heading-total">Total</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="left">Informasi 3</td>
      <td class="center">1111111111</td>
      <td class="center">Rp 100.000</td>
      <td class="center">2</td>
      <td class="center">Rp 200.000</td>
    </tr>
    <tr>
      <td class="left">Jasa 3</td>
      <td class="center">1111111111</td>
      <td class="center">Rp 100.000</td>
      <td class="center">2</td>
      <td class="center">Rp 200.000</td>
    </tr>
  </tbody>
</table>

<div class="footer">
  <div class="footer-info">
    <span>PTSP BMKG Provinsi Bengkulu </span> |
    <span>0823 7560 9090</span> |
    <span>https://bengkulu.bmkg.go.id/</span>
  </div>
</div>
';
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream('faktur.pdf');
