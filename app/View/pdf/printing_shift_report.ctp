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
 
$pdf->AddPage("L");
 //$name="yubraj";
 $html= <<<EOD
 
 	
 <table align="center">
 <tr>
 
 <td><img src="http://localhost:8013/polychem/app/webroot/img/Yeti.jpg"/><h1>YETI POLYCHEM PVT LTD</h1></td>
 </tr>
 <tr>
 <td><h5>Daily Printing Shift Report-$today1</h5></td>
 </tr>
 </table>
 <br/>
  <h4>Shift Incharge  ----------------- </h4>
  <br/>

 
 <table border="1" align="right" cellpadding="2px">
  <tr bgcolor="grey" color="white">
  <td>Shift</td>
  <td>Dimension</td>
  <td>PF Color</td>
  <td>Color Code</td>
  <td>Input</td>
  <td>OutPut</td>
  <td>Unprinted Scrap</td>
  
  <td>Printed Scrap</td>
  
 </tr>
 </table>

EOD;

foreach ($print  as $prints)
{
    
    $html.='<table  cellpadding="4px" align="right" border="1"><tr><td>'.$prints['printing_shiftreport']['shift'].'</td><td>'.$prints['printing_shiftreport']['dimension'].'</td><td>'.$prints['printing_shiftreport']['PF_Color'].'</td><td>'.$prints['printing_shiftreport']['color_code'].'</td><td>'.$prints['printing_shiftreport']['input'].'</td><td>'.$prints['printing_shiftreport']['output'].'</td><td>'.$prints['printing_shiftreport']['unprinted_scrap'].'</td><td>'.$prints['printing_shiftreport']['printed_scrap'].'</td></tr>';
   $html.='</table>';
    
};
foreach ($today  as $tot)
{
    
    $html.='<table cellpadding="4px" align="right" border="1"><tr bgcolor="grey" text="white"><td>TOTAL '.$tot['printing_shiftreport']['shift'].'</td><td></td><td></td><td></td><td>'.$tot['0']['totalinput'].'</td><td>'.$tot['0']['totaloutput'].'</td><td>'.$tot['0']['uscrap'].'</td><td>'.$tot['0']['pscrap'].'</td></tr>';
   $html.='</table>';
    
};
foreach ($grandtoday  as $gtot)
{
    
    $html.='<table cellpadding="4px" align="right" border="1"><tr bgcolor="white" text="black"><td>GRAND TOTAL</td><td></td><td></td><td></td><td>'.$gtot['0']['gtotalinput'].'</td><td>'.$gtot['0']['gtotaloutput'].'</td><td>'.$gtot['0']['guscrap'].'</td><td>'.$gtot['0']['gpscrap'].'</td></tr>';
   $html.='</table>';
    
};


$pdf->writeHTML($html, true, false, true, false, '');
$pdf->lastPage();
$html= <<<EOD

 <table cellpadding="4px" align="right" border="1" width="50%" style="position:relative;float:right;">
 <tr bgcolor="grey" color="white" >
     <td></td>
   <td>INPUT(mtr)</td>
   <td>OUTPUT(mtr)</td>
   </tr>
    


EOD;
foreach ($grandtoday  as $td)
{
    
    $html.='<tr><td>To Day</td><td>'.$td['0']['gtotalinput'].'</td><td>'.$td['0']['gtotaloutput'].'</td></tr>';
   
    
};
foreach ($toMbs as $mth)
{
    
    $html.='<tr><td>To Month</td><td>'.$mth['0']['monthinput'].'</td><td>'.$mth['0']['monthoutput'].'</td></tr>';
   
    
};
foreach ($year as $yrs)
{
    
    $html.='<tr><td>To Year</td><td>'.$yrs['0']['yearinput'].'</td><td>'.$yrs['0']['yearoutput'].'</td></tr></table>';
   
    
};
 
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->lastPage();
$html= <<<EOD

 <table border="1" width="850px" >
 <tr bgcolor="grey" color="white" >
   <td colspan="5">Time losses</td>
   </tr>
    
 <tr>
    <td width="150px" align="center">Type</td>
    <td width="100px" align="center">Start Time</td>
    <td width="100px" align="center">End Time</td>
    <td width="100px" align="center">Loss Time</td>
	<td width="400px" align="center">Reason</td>
</tr>


EOD;
$tdtotal=0;
foreach ($tl  as $tls)
{
    
    $html.='<tr><td width="150px" align="center">'.$tls['time_loss']['type'].'</td><td width="100px" align="right">'.$tls['time_loss']['time'].'</td><td width="100px" align="right">'.$tls['time_loss']['wk_hrs'].'</td><td width="100px" align="rigth">'.$tls['time_loss']['totalloss'].'</td><td width="400px" align="center">'.$tls['time_loss']['reasons'].'</td></tr>';
     $tdtotal = $tdtotal + $tls['time_loss']['totalloss'];
};

;
	$tdl = number_format($tdtotal,2);
	$time = explode('.',$tdl);
    $h =24-$time[0];
	$m = number_format($time[1]);
	if($m>=60)
	{
		$q = $m/60;
		$h = $h - intval($q);
		$rem = $m % 60;
		if($rem >= 1)
		    $h = $h - 1;
			$rem = 60 - $rem;
		$tdworkinghour = $h.'.'.$rem;
	}
    else
    {
     if($m >= 1)
        {
			if($h >= 1)
            $h = $h - 1;
            $m = 60 - $m;
            $tdworkinghour = $h.'.'.$m;
        }
        else 
        $tdworkinghour = $h.'.'.$m;
    }
$html.='<tr bgcolor="grey" color="white"><td align="center">Total Working Hour</td><td colspan="5" align="center">'.$tdworkinghour.'</td></tr>';
$html.='</table>';
$html.='<table width="50%" align="center"><tr><td></td></tr><br><br><table><tr><td>--------------</td><td>--------------</td><td>--------------</td></tr><tr><td>Incharge</td><td>Printing Manager</td><td>Production Manager</td></tr></table>';
 $pdf->writeHTML($html, true, false, true, false, '');
$pdf->lastPage();

 
echo $pdf->Output(APP . 'files/pdf' . DS . 'test.pdf', 'F');


?>
