<?php
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
$html .="<h2>Production Shift Report - ".$date."</h2>";
$html .= "<table border=\"1\" style=\"padding-left:5px;\">";
$html .= "<tr>
    <td><strong>Shift</strong></td>
    <td><strong>Date</strong></td>
    <td><strong>Brand</strong></td>
    <td><strong>Color</strong></td>
    <td><strong>Base UT</strong></td>
    <td><strong>Base MT</strong></td>
    <td><strong>Base OT</strong></td>
    <td><strong>Print Film</strong></td>
    <td><strong>CT</strong></td>
    <td><strong>Output</strong></td>
    </tr>
";
$base_ut = 0;
$base_mt = 0;
$base_ot = 0;
$print_film = 0;
$ct = 0;
$output = 0;


foreach($productionShiftReportA as $p):
    $html .="<tr>";
    $html .="<td>".$p['production_shiftreport']['shift']."</td>";
    $html .="<td>".$p['production_shiftreport']['date']."</td>";
    $html .="<td>".$p['production_shiftreport']['brand']."</td>";
    $html .="<td>".$p['production_shiftreport']['color']."</td>";
    $html .="<td>".number_format($p['production_shiftreport']['base_ut'])."</td>";
    $html .="<td>".number_format($p['production_shiftreport']['base_mt'])."</td>";
    $html .="<td>".number_format($p['production_shiftreport']['base_ot'])."</td>";
    $html .="<td>".number_format($p['production_shiftreport']['print_film'])."</td>";
    $html .="<td>".number_format($p['production_shiftreport']['CT'])."</td>";
    $html .="<td>".number_format($p['production_shiftreport']['output'])."</td>";
    $html .="</tr>";

    $base_ut += intval($p['production_shiftreport']['base_ut']);
    $base_mt += intval($p['production_shiftreport']['base_mt']);
    $base_ot += intval($p['production_shiftreport']['base_ot']);
    $print_film += intval($p['production_shiftreport']['print_film']);
    $ct += intval($p['production_shiftreport']['CT']);
    $output += intval($p['production_shiftreport']['output']);

endforeach;

$html .="<tr>";
$html .="<td>Total-A :</td>";
$html .="<td></td>";
$html .="<td></td>";
$html .="<td></td>";
$html .="<td>".$base_ut."</td>";
$html .="<td>".$base_mt."</td>";
$html .="<td>".$base_ot."</td>";
$html .="<td>".$print_film."</td>";
$html .="<td>".$ct."</td>";
$html .="<td>".$output."</td>";
$html .="</tr>";
$html .="<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
$base_ut=0;
$base_mt=0;
$base_ot=0;
$ct=0;
$output=0;
foreach($productionShiftReportB as $p):
    $html .="<tr>";
    $html .="<td>".$p['production_shiftreport']['shift']."</td>";
    $html .="<td>".$p['production_shiftreport']['date']."</td>";
    $html .="<td>".$p['production_shiftreport']['brand']."</td>";
    $html .="<td>".$p['production_shiftreport']['color']."</td>";
    $html .="<td>".number_format($p['production_shiftreport']['base_ut'])."</td>";
    $html .="<td>".number_format($p['production_shiftreport']['base_mt'])."</td>";
    $html .="<td>".number_format($p['production_shiftreport']['base_ot'])."</td>";
    $html .="<td>".number_format($p['production_shiftreport']['print_film'])."</td>";
    $html .="<td>".number_format($p['production_shiftreport']['CT'])."</td>";
    $html .="<td>".number_format($p['production_shiftreport']['output'])."</td>";
    $html .="</tr>";

    $base_ut += intval($p['production_shiftreport']['base_ut']);
    $base_mt += intval($p['production_shiftreport']['base_mt']);
    $base_ot += intval($p['production_shiftreport']['base_ot']);
    $print_film += intval($p['production_shiftreport']['print_film']);
    $ct += intval($p['production_shiftreport']['CT']);
    $output += intval($p['production_shiftreport']['output']);

endforeach;

$html .="<tr>";
$html .="<td>Total-B :</td>";
$html .="<td></td>";
$html .="<td></td>";
$html .="<td></td>";
$html .="<td>".$base_ut."</td>";
$html .="<td>".$base_mt."</td>";
$html .="<td>".$base_ot."</td>";
$html .="<td>".$print_film."</td>";
$html .="<td>".$ct."</td>";
$html .="<td>".$output."</td>";
$html .="</tr>";

//ToMonth
$html .="<tr>";
$html .="<td>Total ToMonth</td>";
$html .="<td></td>";
$html .="<td></td>";
$html .="<td></td>";
$html .="<td>".$shiftReportToMonth['base_ut']."</td>";
$html .="<td>".$shiftReportToMonth['base_mt']."</td>";
$html .="<td>".$shiftReportToMonth['base_ot']."</td>";
$html .="<td>".$shiftReportToMonth['print_film']."</td>";
$html .="<td>".$shiftReportToMonth['CT']."</td>";
$html .="<td>".$shiftReportToMonth['output']."</td>";
$html .="</tr>";

//ToYear
$html .="<tr>";
$html .="<td>Total ToYear</td>";
$html .="<td></td>";
$html .="<td></td>";
$html .="<td></td>";
$html .="<td>".$shiftReportToYear['base_ut']."</td>";
$html .="<td>".$shiftReportToYear['base_mt']."</td>";
$html .="<td>".$shiftReportToYear['base_ot']."</td>";
$html .="<td>".$shiftReportToYear['print_film']."</td>";
$html .="<td>".$shiftReportToYear['CT']."</td>";
$html .="<td>".$shiftReportToYear['output']."</td>";
$html .="</tr>";


$html .= "</table><br><br>";

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
// ---------------------------------------------------------
// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('productionShiftReport-'.$date.'.pdf', 'D');
//============================================================+
// END OF FILE
//============================================================+