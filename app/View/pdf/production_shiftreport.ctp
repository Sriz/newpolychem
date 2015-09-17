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
//$pdf->Image('images/Yeti.jpg', 50, 50, 100, '', '', 'http://www.tcpdf.org', '', false, 300);
$pdf->AddPage("L");
 
 $html= <<<EOD
 
  

 <table align="center" align="center">
 <tr>
 
 <td><img src="http://localhost:8013/polychem/app/webroot/img/Yeti.jpg"/><h1>YETI POLYCHEM PVT LTD</h1></td>
 </tr>
 <tr>
 <td><h3>CalendarProduction Shift Report-$today</h3></td>
 </tr>
 </table>
 
  <br/>
 <table align="right" border="1" >
  <tr bgcolor="grey" color="white">
  
  <td align="center">Brand</td>
  <td align="center">Color</td>
  <td align="center">Base UT</td>
  <td align="center">Base MT</td>
  <td align="center">Base OT</td>
  <td align="center">Print Film</td>
  <td align="center">CT</td>
  <td align="center">OutPut</td>
  <td align="center">Print/Output</td>
  <td align="center">CT/Output</td>
 </tr>
 
EOD;

foreach ($pd  as $pds)
{   
    $html.='<tr><td>'.$pds['production_shiftreport']['brand'].'</td><td>'.$pds['production_shiftreport']['color'].'</td><td align="right">'.number_format($pds['production_shiftreport']['base_ut'],2).'</td><td align="right">'.number_format($pds['production_shiftreport']['base_mt'],2).'</td><td align="right">'.number_format($pds['production_shiftreport']['base_ot'],2).'</td><td align="right">'.number_format($pds['production_shiftreport']['print_film'],2).'</td><td align="right">'.number_format($pds['production_shiftreport']['CT'],2).'</td><td align="right">'.number_format($pds['production_shiftreport']['output'],2).'</td><td align="right">'.number_format($pds['0']['po'],3).'</td><td align="right">'.number_format($pds['0']['co'],2).'</td></tr>';
    
}
foreach($totala as $totalA)

{
    $html.='<tr bgcolor="grey" color="white"><td>Total A</td><td></td><td align="right">'.number_format($totalA['0']['ut'],2).'</td><td align="right">'.number_format($totalA['0']['mt'],2).'</td><td align="right">'.number_format($totalA['0']['ot'],2).'</td><td align="right">'.number_format($totalA['0']['pf'],2).'</td><td align="right">'.number_format($totalA['0']['ct'],2).'</td><td align="right">'.number_format($totalA['0']['op'],2).'</td><td align="right">'.number_format($totalA['0']['po'],2).'</td><td align="right">'.number_format($totalA['0']['co'],2).'</td></tr>';
   
}
foreach ($pdb  as $pdbs)
{
    
    $html.='<tr><td>'.$pdbs['production_shiftreport']['brand'].'</td><td>'.$pdbs['production_shiftreport']['color'].'</td><td align="right">'.number_format($pdbs['production_shiftreport']['base_ut'],2).'</td><td align="right">'.number_format($pdbs['production_shiftreport']['base_mt'],2).'</td><td align="right">'.number_format($pdbs['production_shiftreport']['base_ot'],2).'</td><td align="right">'.number_format($pdbs['production_shiftreport']['print_film'],2).'</td><td align="right">'.number_format($pdbs['production_shiftreport']['CT'],2).'</td><td align="right">'.number_format($pdbs['production_shiftreport']['output'],2).'</td><td align="right">'.number_format($pdbs['0']['po'],3).'</td><td align="right">'.number_format($pdbs['0']['co'],2).'</td></tr>';
     
}
foreach($totalb as $totalB)
{
    $html.='<tr bgcolor="grey" color="white"><td>Total B</td><td></td><td align="right">'.number_format($totalB['0']['ut'],2).'</td><td align="right">'.number_format($totalB['0']['mt'],2).'</td><td align="right">'.number_format($totalB['0']['ot'],2).'</td><td align="right">'.number_format($totalB['0']['pf'],2).'</td><td align="right">'.number_format($totalB['0']['ct'],2).'</td><td align="right">'.number_format($totalB['0']['op'],2).'</td><td align="right">'.number_format($totalB['0']['po'],2).'</td><td align="right">'.number_format($totalB['0']['co'],2).'</td></tr>';
   
}
foreach($totalab as $totalAB)
{
    $html.='<tr bgcolor="black" color="white"><td>Ground Total</td><td></td><td align="right">'.number_format($totalAB['0']['ut'],2).'</td><td align="right">'.number_format($totalAB['0']['mt'],2).'</td><td align="right">'.number_format($totalAB['0']['ot'],2).'</td><td align="right">'.number_format($totalAB['0']['pf'],2).'</td><td align="right">'.number_format($totalAB['0']['ct'],2).'</td><td align="right">'.number_format($totalAB['0']['op'],2).'</td><td align="right">'.number_format($totalAB['0']['po'],2).'</td><td align="right">'.number_format($totalAB['0']['co'],2).'</td></tr>';
   
}
$html.='</table>';
$pdf->writeHTML($html, true, false, true, false, '');

$pdf->lastPage();

 //$name="yubraj";
 $html= <<<EOD

 
 <table align="right" border="1" width="60%">
  <tr bgcolor="grey" color="white">
    <td></td>
  <td align="center">BaseMT+UT Meter</td>

  <td align="center">PrintMeter</td>
  <td align="center">CT Meter</td>
  <td align="center">Output Meter</td>
 
 </tr>



   
   
    
 
 
EOD;
foreach($todays as $tod)
{
    $html.='<tr><td>Today</td><td align="right">'.number_format($tod['0']['todayutmt'],2).'</td><td align="right">'.number_format($tod['0']['todayprint'],2).'</td><td align="right">'.number_format($tod['0']['totalct'],2).'</td><td align="right">'.number_format($tod['0']['todayoutput'],2).'</td></tr>';
    
       
  
}
foreach($tomonth as $toyrs)
{
    $html.='<tr><td>Tomonth</td><td align="right">'.number_format($toyrs['0']['mnthutmt'],2).'</td><td align="right">'.number_format($toyrs['0']['mnthprint'],2).'</td><td align="right">'.number_format($toyrs['0']['mnthct'],2).'</td><td align="right">'.number_format($toyrs['0']['mnthoutput'],2).'</td></tr>';
    
       
  
}

foreach($toyears as $toyrs)
{
    $html.='<tr><td>Toyear</td><td align="right">'.number_format($toyrs['0']['mnthutmt'],2).'</td><td align="right">'.number_format($toyrs['0']['mnthprint'],2).'</td><td align="right">'.number_format($toyrs['0']['mnthct'],2).'</td><td align="right">'.number_format($toyrs['0']['mnthoutput'],2).'</td></tr>';
    
       
  
}


$html.='</table>';
  
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->lastPage();
$html= <<<EOD

 <table align="center" border="1" width="60%">
 
    
 <tr>
    <td>Type</td>
    <td>Total Time</td>
  
   
</tr>


EOD;
//$tdtotal=0;
foreach ($tl  as $tls)
{
    
    //$html.='<tr><td>'.$tls['time_loss']['type'].'</td><td>'.$tls['time_loss']['time'].'</td><td>'.$tls['time_loss']['wk_hrs'].'</td><td>'.$tls['time_loss']['totalloss'].'</td><td width="300px">'.$tls['time_loss']['reasons'].'</td></tr>';
  
      //$tdtotal = $tdtotal + $tls['time_loss']['totalloss'];
};
$bdex=explode('.',$bdlosstoday['0']['0']['lossm']);
$min=number_format($bdex[1]);
if($min<10)

$tdtotal=$totalworking['0']['0']['workinghour'];

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
  
  
    
    

    $html.='<tr><td> BreakDown</td><td colspan="4">'.$breakdown_today.'</td></tr>';
   
    $html.='<tr><td> LossHour</td><td colspan="4">'.$losshour_today.'</td></tr>';
$html.='<tr><td>Total Working Hour</td><td colspan="4">'.$workhour_d.'</td></tr>';
  $html.='</table>';

$pdf->writeHTML($html, true, false, true, false, '');

$pdf->lastPage();

 
echo $pdf->Output(APP . 'files/pdf' . DS . 'test.pdf', 'F');


?>
