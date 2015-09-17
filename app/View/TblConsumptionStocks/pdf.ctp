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
// set text shadow effect
//$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
//// Set some content to print
//echo '<pre>';
//print_r($consumptions);exit;
$html = <<<EOD
<table border="0.5px">
EOD;
if (!count($consumptions)):
    $html .="<h2>NO Data</h2>";
else:
$html .="<tr class='success'>
    <td><strong>Nepalidate</strong></td>";
for ($i = 0; $i < count($consumptions); $i++):
    $html .= "<td>".$consumptions[$i]['TblConsumptionStock']['nepalidate']."</td>";
endfor;
$html .="</tr><tr>
<td><strong>Shift</strong></td>";
    for ($i = 0; $i < count($consumptions); $i++):
        $html.="<td>".$consumptions[$i]['TblConsumptionStock']['shift']."</td>";
    endfor;
$html .="</tr>
<tr>
    <td><strong>Brand</strong></td>";
    for ($i = 0; $i < count($consumptions); $i++):
        $html .="<td>".$consumptions[$i]['TblConsumptionStock']['brand']."</td>";
    endfor;
$html .="</tr>
<tr>
    <td><strong>Quality</strong></td>";
    for ($i = 0; $i < count($consumptions); $i++):
        $html .= "<td>".$consumptions[$i]['TblConsumptionStock']['quality']."</td>";
    endfor;
$html .= "</tr>
<tr>
    <td><strong>Color</strong></td>";
    for ($i = 0; $i < count($consumptions); $i++):
        $html .="<td>".$consumptions[$i]['TblConsumptionStock']['color']."</td>";
    endfor;
$html .="</tr>
<tr>
    <td><strong>Dimension</strong></td>";
    for ($i = 0; $i < count($consumptions); $i++):
        $html .= "<td>".$consumptions[$i]['TblConsumptionStock']['dimension']."</td>";
    endfor;
$html .="</tr>";
foreach ($material_lists as $m):
    $html .="<tr>
        <td><strong>".$m['MixingMaterial']['name']."</strong></td>";
        for ($i = 0; $i < count($consumptions); $i++):
            $materials = json_decode($consumptions[$i]['TblConsumptionStock']['materials']);
            $material = isset($materials->$m['MixingMaterial']['id']) ? ($materials->$m['MixingMaterial']['id'] ? $materials->$m['MixingMaterial']['id']:0):0;
            $html .="<td>".$material ."</td>";
        endfor;
    $html .= "</tr>";
endforeach;
$html .= "<tr>
    <td><strong>Total :</strong></td>";
    for ($i = 0; $i < count($consumptions); $i++):
        $total = 0;
        $material = json_decode($consumptions[$i]['TblConsumptionStock']['materials']);
        foreach($material_lists as $m):
            if(property_exists($material, $m['MixingMaterial']['id']))
            {
                $materialWeight = $material->$m['MixingMaterial']['id'];
            }else{
                $materialWeight=0;
            }
            $total += $materialWeight;
        endforeach;
    $html .= "<td><strong>".$total."</strong></td>";
endfor;
$html .= "</tr>";
endif;
$html .='</table>';
// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
// ---------------------------------------------------------
// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('', 'D');
//============================================================+
// END OF FILE
//============================================================+