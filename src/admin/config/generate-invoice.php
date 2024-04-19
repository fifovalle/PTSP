<?php
require_once('../../../vendor2/vendor/tecnickcom/tcpdf/tcpdf.php');

if (isset($_POST['generate_pdf'])) {
    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
    $pdf->SetTitle('Invoice Pesanan');
    $pdf->AddPage();
    $html = '<h1>Invoice Pesanan</h1>';
    $html .= '<table border="1">';
    $html .= '</table>';
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output('invoice_pesanan.pdf', 'D');
}
