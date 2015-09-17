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
  $date=$this->Session->read('date');
$pdf->AddPage("L");
 //$name="yubraj";
 $html= <<<EOD
 
 
 <table align="center">
 <tr>
 
 <td><img src="http://localhost:8013/polychem/app/webroot/img/Yeti.jpg"/><h1>YETI POLYCHEM PVT LTD</h1></td>
 </tr>
 <tr>
 <td><h4>Daily Raw Material Printing Report-$today</h4></td>
 </tr>
 </table>
 <br/>
 <h4>Shift Encharge  ----------------- </h4>
 
 <table border="1"  align="center">
 
  
  <tr><td></td>


   
   
    
 
 
EOD;

foreach($rawmaterials as $mixing){
    $html.='<td>'.$mixing['printing_stock']['patttern'].'</td>';
    
    
}
$html.='<td>Total</td></tr>';
$html.='<tr><td>Consumption</td>';
foreach($rawmaterials as $mixing){
    $html.='<td>'.$mixing['printing_stock']['consumption'].'</td>';
    
    
}

$html.='<td>00</td></tr><tr><td>Balance</td>';
foreach($rawmaterials as $mixing){
    $html.='<td>'.$mixing['printing_stock']['balance'].'</td>';
    
    
}
$html.='<td>00</td></tr><tr><td>Issue</td>';

foreach($rawmaterials as $mixing){
    $html.='<td>'.$mixing['printing_stock']['issue'].'</td>';
    
    
}
$html.='<td>00</td></tr>';
$html.='</table><br><br>';




$html.='<table border="1"  align="center"><tr><td colspan="17" bgcolor="grey" color="white">Consumption</td></tr>';
 

 
$i=1;
$flag=0;
$count=1;
foreach($rawmaterials1 as $printingIssue){
	if($i<=1)
{
   
       $html.='<tr><td>'.$printingIssue['printing_issue']['material'].'</td>';
	   // $html.= '<td>'.$printingIssue['printing_issue']['quantity'].'</td>';
	   $i=2;
	  $flag++;    
   
    
}
    
       
    if($flag<15)
    {
      $html.='<td>'.$printingIssue['printing_issue']['quantity'].'</td>';
	 
               
    $flag=$flag+1;
		

    }
        else
       {
     
        
		   $html.= '<td>'.$printingIssue['printing_issue']['quantity'].'</td>';
		   $html.= '<td>'.$printingIssue['printing_issue']['total'].'</td>';
		   
		    $html.= '</tr>';
			
			
        $i=1;
        $flag=0;
		$count=1;
           
    }
  


}

$total=0;
$html.='<tr bgcolor="grey" color="white"><td>TOTAL</td>';
foreach($totalp as $tp)

{
   

$html.='<td>'.$tp['0']['quantity'].'</td>';
$total=$total+$tp['0']['quantity'];
}
$html.='<td>'.$total.'</td></tr></table>';
   





									
		
			
				 



   



$pdf->writeHTML($html, true, false, true, false, '');

$pdf->lastPage();

 
$html.= $pdf->Output(APP . 'files/pdf' . DS . 'test.pdf', 'F');


?>
