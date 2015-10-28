<?php
App::import('Vendor', 'xtcpdf');
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
//$pdf->SetAuthor('YETI POLYCHEM');
//$pdf->SetTitle('Consumption Raw Material');
//$pdf->SetSubject('Date');
//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 048', PDF_HEADER_STRING);
// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->setPrintHeader(false);
// set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}
// ---------------------------------------------------------
// set font
$pdf->SetFont('helvetica', 'B', 10);
$pdf->AddPage();
$name = "yubraj";
$html = <<<EOD
 <table align="center" cellpadding="2" align="center">
 <tr>
 <td><img src="http://localhost:8013/polychem/app/webroot/img/Yeti.jpg"/><h1>YETI POLYCHEM PVT LTD</h1></td>
 </tr>
 <tr>
 <td><h3>Calender Production Report:$today</h3></td>
 </tr>
 </table>
 <br/>
  <br/>
 <table border="1" width="50%" cellpadding="2" align="center">
EOD;
foreach ($mixingraws as $mtotal) {
    $html .= '<tr><td align="left">Raw Materials</td><td align="right">' . number_format($mtotal['0']['sum'], 2) . '</td></tr>';
};
foreach ($scraptotal as $stotal) {
    $html .= '<tr><td align="left">Total Scrap</td><td align="right">' . number_format($stotal['0']['scrap_total'], 2) . '</td></tr>';
};
foreach ($total as $tottoday) {

    $html .= '<tr><td align="left">Total Input</td><td align="right">' . number_format($tottoday['0']['total'], 2) . '</td></tr>';

};
foreach ($danaused as $danas) {
    $html .= '<tr><td align="left">Dana Used</td><td align="right">' . number_format($danas['0']['totdana'], 2) . '</td>';
}
foreach ($broughtscrap as $b) {
    $html .= '<tr><td align="left">Brought Scrap</td><td align="right">' . number_format($b['0']['totbs'], 2) . '</td>';
}
$html .= '</tr></table>';

$pdf->writeHTML($html, true, false, true, false, '');
$pdf->lastPage();

$html = <<<EOD
 <table border="1" cellpadding="2" align="right">
 <tr bgcolor="grey" color="white">
    <td>Date</td>
    <td>Shift</td>
    <td>Type</td>
    <td>Quality</td>
    <td>Color</td>
    <td>Dimension</td>
    <td>Embossing</td>
    <td>Length</td>
    <td>NTWT</td>
</tr>
EOD;
foreach ($cal as $calenderCpr) {
    $html .= '<tr><td>' . $calenderCpr['calender_cpr']['date'] . '</td><td>' . $calenderCpr['calender_cpr']['shift'] . '</td><td>' . $calenderCpr['calender_cpr']['type'] . '</td><td>' . $calenderCpr['calender_cpr']['quality'] . '</td><td>' . $calenderCpr['calender_cpr']['color'] . '</td><td>' . $calenderCpr['calender_cpr']['Dimension'] . '</td><td>' . $calenderCpr['calender_cpr']['embossing'] . '</td><td>' . number_format($calenderCpr['calender_cpr']['length'], 2) . '</td><td>' . number_format($calenderCpr['calender_cpr']['ntwt'], 2) . '</td></tr>';
};
foreach ($totalntlg as $totals) {
    $html .= '<tr><td colspan="7">Total </td><td>' . number_format($totals['0']['total_length'], 2) . '</td><td>' . number_format($totals['0']['total_ntwt'], 2) . '</td></tr>';
};
foreach ($total_to_month as $totals) {
    $html .= '<tr><td colspan="7">Total of this Month<?=subatr($today,0,7);?></td><td>' . number_format($totals['0']['total_length'], 2) . '</td><td>' . number_format($totals['0']['total_ntwt'], 2) . '</td></tr>';
};

foreach ($total_to_year as $totals) {
    $html .= '<tr><td colspan="7">Total of this Year</td><td>' . number_format($totals['0']['total_length'], 2) . '</td><td>' . number_format($totals['0']['total_ntwt'], 2) . '</td></tr></table>';
};
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->lastPage();
$html = <<<EOD
 <table border="1" width="50%" cellpadding="2">
 <tr bgcolor="grey" color="white">
    <td>Scrap Details</td>
    <td align="right">Kgs</td>
</tr>
EOD;
foreach ($scrapsused as $sps) {
    $html .= '<tr><td>Resuable</td><td align="right">' . number_format($sps['calender_scrap']['resuable'], 2) . '</td></tr><tr><td>Lumps and Plates</td><td align="rigth">' . number_format($sps['calender_scrap']['lamps_plates'], 2) . '</td></tr><tr><td>Total Scrap Generated</td><td align="right">' . number_format($sps['calender_scrap']['total_scrap_generated'], 2) . '</td></tr>';
};
/*
 * Calculation of Unaccounted Loss
 * formula => Unaccounted loss= input-total ntwt-scrap generated
 */
$input = isset($total[0][0]['total'])?$total[0][0]['total']:'0';
$netwt = isset($total_to_month[0][0]['total_ntwt'])?$total_to_month[0][0]['total_ntwt']:'0';
$scrap_generated = isset($scrapsused[0]['calender_scrap']['total_scrap_generated'])?$scrapsused[0]['calender_scrap']['total_scrap_generated']:'0';
$unaccountloss = $input-$netwt-$scrap_generated;
$html .= '<tr><td align="left">Unaccounted Loss</td><td align="right">'.$unaccountloss .'</td></tr>';

$html .= '</table>';
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->lastPage();
$html = <<<EOD
 <table border="1" width="100%" cellpadding="1" align="center">
 <tr bgcolor="grey" color="white" >
   <td colspan="5">Time losses</td>
</tr>
 <tr>
    <td width="100px">Type</td>
    <td width="100px">Start Time</td>
    <td width="100px">End Time</td>
    <td width="100px">Time Loss</td>
    <td width="274px">Reasons</td>
</tr>
EOD;
$tdtotal = 0;
foreach ($tl as $tls) {
    $html .= '<tr><td width="100px" style="text-transform:capitalize">' . $tls['time_loss']['type'] . '</td><td width="100px">' . $tls['time_loss']['time'] . '</td><td width="100px">' . $tls['time_loss']['wk_hrs'] . '</td><td width="100px">' . $tls['time_loss']['totalloss'] . '</td><td width="274px">' . $tls['time_loss']['reasons'] . '</td></tr>';
    $tdtotal = $tdtotal + $tls['time_loss']['totalloss'];
};
$tdl = number_format($tdtotal, 2);
$time = explode('.', $tdl);
$h = 24 - $time[0];
$m = number_format($time[1]);
if ($m >= 60) {
    $q = $m / 60;
    $h = $h - intval($q);
    $rem = $m % 60;
    if ($rem >= 1)
        $h = $h - 1;
    $rem = 60 - $rem;
    $tdworkinghour = $h.' Hours '.$rem.' Minutes';
} else {
    if ($m >= 1) {
        if ($h >= 1)
            $h = $h - 1;
        $m = 60 - $m;
        $tdworkinghour = $h . ' Hours' . $m.' Minutes';
    } else
        $tdworkinghour = $h . 'Hours '. $m.' Minutes';
}
$html .= '<tr><td width="300px" style="text-transform:capitalize"></td><td width="374px"></td></tr>';
$html .= '<tr><td width="300px" style="text-transform:capitalize">Total Breakdown</td><td width="374px">' . $tl_break . '</td></tr>';
$html .= '<tr><td width="300px" style="text-transform:capitalize">Total LossHour</td><td width="374px">' . $tl_loss . '</td></tr>';
$html .= '<tr><td width="300px" style="text-transform:capitalize">Total Working Hour</td><td width="374px">' . $tdworkinghour . '</td></tr></table>';


/*
$html .= '<tr><td>Total Breakdown = </td></td>' . $tl_break . '</td></tr>';
$html .= '<tr><td>Total LossHour= </td></td>' . $tl_loss . '</td></tr>';
$html .= '<tr><td>Total Working Hour</td><td>' . $tdworkinghour . '</td></tr><br></table>';*/
$html .= '</table><table width="50%" align="center"><tr><td></td></tr><tr><td>Signature  ...................................</td></tr></table>';
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->lastPage();
echo $pdf->Output(APP . 'files/pdf' . DS . 'test.pdf', 'F');
?>
