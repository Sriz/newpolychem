<?php
 
App::import('Vendor','xtcpdf');
 
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
//$pdf->SetAuthor('YETI POLYCHEM');
//$pdf->SetTitle('Consumption Raw Material');
//$pdf->SetSubject('Date');
//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 048', PDF_HEADER_STRING);

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
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', 'B', 10);
 
$pdf->AddPage();
 $name="sailendra";
  $date=$this->Session->read('date');
 $html= <<<EOD

 
 <table align="center">
 <tr>
 
 <td><img src="http://localhost:8013/polychem/app/webroot/img/Yeti.jpg"/><h1>YETI POLYCHEM PVT LTD</h1></td>
 </tr>
 <tr>
 <td><h5>Calender Raw Material Monthly Consumption-$date1</h5></td>
 
 </tr>
 </table>
 <br/>
 <br/>
 
    
 
 
EOD;

 $html.= '<table  border="1" cellpadding="1"><tbody>';
		$html.= $str1;
        $html.='</tbody></table>';
	
 
$pdf->writeHTML($html, true, false, true, false, '');
 
$pdf->lastPage();


 
echo $pdf->Output(APP . 'files/pdf' . DS . 'consumption.pdf', 'F');


?>
