<?php
$date = isset($_GET['date']) ? $_GET['date']:'';


function time_elapsed($secs){
    if(isset($secs)):
        $bit = [
            'Years' => $secs / 31556926 % 12,
            'Weeks' => $secs / 604800 % 52,
            'Days' => $secs / 86400 % 7,
            'Hours' => $secs / 3600 % 24,
            'Minutes' => $secs / 60 % 60,
            'seconds' => $secs % 60
        ];
        $ret = [];
        foreach($bit as $k => $v)
            if($v > 0) {
                $ret[] = $v .' '. $k;
            }
        return join(' ', $ret);
    endif;
}
?>
<?php

App::import('Vendor','tcpdf/tcpdf');
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Axonsystem');
$pdf->SetTitle('Title');
$pdf->SetSubject('PDF Created by Axonsystem');
$pdf->SetKeywords('Polychem, PDF');
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Yeti Polychem Pvt. Ltd.', '', array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));
// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// set image scale factor
//$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
// ---------------------------------------------------------
// set default font subsetting mode
$pdf->setFontSubsetting(true);
// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont(null, '', 9, '', true);
// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set cell padding
$pdf->setCellPaddings(1, 1, 1, 1);

// set cell margins
$pdf->setCellMargins(1, 1, 1, 1);

// set color for background
$pdf->SetFillColor(255, 255, 127);

$html = "";
$html .="<h2>Printing Shfit Report - ".$date."</h2>";
$html .= "<table border=\"1\" style=\"padding-left:5px;\">";
$html .= "<tr>
    <td><strong>Shift</strong></td>
    <td><strong>Dimension</strong></td>
    <td><strong>PF Color</strong></td>
    <td><strong>Input</strong></td>
    <td><strong>Output</strong></td>
    <td><strong>Unprinted Scrap</strong></td>
    <td><strong>Printed Scrap</strong></td>
    </tr>
";
$input = 0;
$output = 0;
foreach($printingShiftReport as $p):
    $html .="<tr>";
    $html .="<td>".$p['printing_shiftreport']['shift']."</td>";
    $html .="<td>".$p['printing_shiftreport']['dimension']."</td>";
    $html .="<td>".$p['printing_shiftreport']['PF_Color']."</td>";
    $html .="<td>".number_format($p['printing_shiftreport']['input'])."</td>";
    $html .="<td>".number_format($p['printing_shiftreport']['output'])."</td>";
    $html .="<td>".number_format($p['printing_shiftreport']['unprinted_scrap'])."</td>";
    $html .="<td>".number_format($p['printing_shiftreport']['printed_scrap'])."</td>";
    $html .="</tr>";
    $input += intval($p['printing_shiftreport']['input']);
    $output += intval($p['printing_shiftreport']['output']);
endforeach;

$html .="<tr>";
$html .="<td></td>";
$html .="<td></td>";
$html .="<td></td>";
$html .="<td></td>";
$html .="<td></td>";
$html .="<td></td>";
$html .="<td></td>";
$html .="</tr>";

$html .="<tr>";
$html .="<td></td>";
$html .="<td></td>";
$html .="<td><strong>Total</strong></td>";
$html .="<td><strong>".number_format($inputToday[0][0]['input_today'])."</strong></td>";
$html .="<td><strong>".number_format($outputToday[0][0]['output_today'])."</strong></td>";
$html .="<td><strong>".number_format($unprintToday[0][0]['unprint_today'])."</strong></td>";
$html .="<td><strong>".number_format($printToday[0][0]['print_today'])."</strong></td>";
$html .="</tr>";

$html .="<tr>";
$html .="<td></td>";
$html .="<td></td>";
$html .="<td><strong>Total To Month</strong></td>";
$html .="<td><strong>".number_format($shiftReport['inputToMonth'])."</strong></td>";
$html .="<td><strong>".number_format($shiftReport['outputToMonth'])."</strong></td>";
$html .="<td><strong>".number_format($shiftReport['print_month'])."</strong></td>";
$html .="<td><strong>".number_format($shiftReport['unprint_month'])."</strong></td>";
$html .="</tr>";

$html .="<tr>";
$html .="<td></td>";
$html .="<td></td>";
$html .="<td><strong>Total To Year</strong></td>";
$html .="<td><strong>".number_format($shiftReport['inputToYear'])."</strong></td>";
$html .="<td><strong>".number_format($shiftReport['outputToYear'])."</strong></td>";
$html .="<td><strong>".number_format($shiftReport['unprint_year'])."</strong></td>";
$html .="<td><strong>".number_format($shiftReport['print_year'])."</strong></td>";
$html .="</tr>";

$html .= "</table><br><br>";




/* Input Output Summary Table */

$html .="<h3>Input Output Summary</h3>";
$html .= "<table border=\"1\" style=\"padding-left:5px;\">";
$html .= "<tr>
    <td></td>
    <td><strong>Input</strong></td>
    <td><strong>Output</strong></td>
    </tr>";
    
$html .= "<tr>
    <td>Today</td>
    <td>".number_format($inputToday[0][0]['input_today'])."</td>
    <td>".number_format($outputToday[0][0]['output_today'])."</td>
    </tr>";
$html .= "<tr>
    <td>To Month</td>
    <td>".number_format($shiftReport['inputToMonth'])."</td>
    <td>".number_format($shiftReport['outputToMonth'])."</td>
    </tr>";
$html .= "<tr>
    <td>To Year</td>
    <td>".number_format($shiftReport['inputToYear'])."</td>
    <td>".number_format($shiftReport['outputToYear'])."</td>
    </tr>";
$html .= "</table><br><br>";



/* timeloss table */
$html .="<h3>Time Loss</h3>";
$html .= "<table border=\"1\" style=\"padding-left:5px;\">";
$html .= "<tr>
    <td><strong>Type</strong></td>
    <td><strong>Start Time</strong></td>
    <td><strong>End Time</strong></td>
    <td><strong>Loss Time</strong></td>
    <td><strong>Reasons</strong></td>
    </tr>";
$totalLossSecLoss=0;
$totalLossSecBreak=0;

foreach($timeLossLossHour as $lossHour){
    // echo'<pre>';print_r($lossHour);die;
    $html .="<tr>";
    $html .="<td>".$lossHour['time_loss']['type']."</td>";
    $html .="<td>".$lossHour['time_loss']['time']."</td>";
    $html .="<td>".$lossHour['time_loss']['wk_hrs']."</td>";
    $html .="<td>".time_elapsed($lossHour['time_loss']['totalloss_sec'])."</td>";
    $html .="<td>".$lossHour['time_loss']['reasons']."</td>";
    $html .="</tr>";
    $totalLossSecLoss += intval($lossHour['time_loss']['totalloss_sec']);
}
$html .="<tr><td></td><td></td><td><strong>Total Loss LossHour</strong></td><td><strong>".time_elapsed($totalLossSecLoss)."</strong></td><td></td></tr>";
$html .="<tr><td></td><td></td><td></td><td></td><td></td></tr>";
foreach($timeLossBreakDown as $lossHour){
    $html .="<tr>";
    $html .="<td>".$lossHour['time_loss']['type']."</td>";
    $html .="<td>".$lossHour['time_loss']['time']."</td>";
    $html .="<td>".$lossHour['time_loss']['wk_hrs']."</td>";
    $html .="<td>".time_elapsed($lossHour['time_loss']['totalloss_sec'])."</td>";
    $html .="<td>".$lossHour['time_loss']['reasons']."</td>";
    $html .="</tr>";
    $totalLossSecBreak += intval($lossHour['time_loss']['totalloss_sec']);
}
$html .="<tr><td></td><td></td><td></td><td></td><td></td></tr>";
$html .="<tr><td></td><td></td><td><strong>Total Loss BreakDown</strong></td><td><strong>".time_elapsed($totalLossSecBreak)."</strong></td><td></td></tr>";
$html .="<tr><td></td><td></td><td></td><td></td><td></td></tr>";
$html .="<tr><td></td><td></td><td><strong>Total Loss</strong></td><td><strong>".time_elapsed($totalLossSecBreak+$totalLossSecLoss)."</strong></td><td></td></tr>";
$html .="</table>";

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
// ---------------------------------------------------------
// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('PrintingShiftReport-'.$date.'.pdf', 'D');
//============================================================+
// END OF FILE
//============================================================+