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
$totalBroughtScrap = 0;
$totalScrap = 0;
$totalRawMaterials = 0;
foreach($materialCategory as $r):
    foreach($mixingMaterialLists as $m):
        if($m['mixing_materials']['category_id']==$r['category_materials']['id'])
        {
            foreach($consumptionMaterials as $c):
                $materialJSON = $c['tbl_consumption_stock']['materials'];
                $materialOBJ = json_decode($materialJSON);
                if(property_exists($materialOBJ, $m['mixing_materials']['id'])) {
                    $valMaterial = $materialOBJ->$m['mixing_materials']['id'];
                }else{
                    $valMaterial = 0;
                }
                if($r['category_materials']['id']==13){
                    $totalBroughtScrap += $valMaterial;
                }elseif($r['category_materials']['id']==14){
                    $totalScrap += $valMaterial;
                }else{
                    $totalRawMaterials += $valMaterial;
                }
            endforeach;
        }
    endforeach;
endforeach;
//Resuable
$resuable = 0;
$lamps_plates=0;
$total_scrap_generated=0;
foreach($calenderScraps as $c):
    $resuable += $c['calender_scrap']['resuable'];
    $lamps_plates += $c['calender_scrap']['lamps_plates'];
    $total_scrap_generated += ($resuable+$lamps_plates);
endforeach;
$html ='';
$html .="<h2>Scrap Details</h2>";
$html .="<table border=\"0.5px;\">
<tr>
    <td>Brought Scrap</td>
    <td>".h(number_format($totalBroughtScrap,2))."</td>
</tr>
<tr>
    <td>Scrap</td>
    <td>".h(number_format($totalScrap,2))."</td>
</tr>
<tr>
    <td>Raw Materials</td>
    <td>".h(number_format($totalRawMaterials,2))."</td>
</tr>
</table>";
//Resuable Table
$html .="<h2>Resuable</h2>";
$html .="
<table border=\"0.5px\">
<tr>
    <td>Reusable</td>
    <td>".h(number_format($resuable, 2))."</td>
</tr>
<tr>
<td>Lamps and Plates</td>
<td>".h(number_format($lamps_plates,2))."</td>
</tr>
<tr>
<td>Total Scrap Used</td>
<td>".h(number_format($total_scrap_generated, 2))."</td>
</tr>
</table>";
$html .= "<h2>NTWT Table</h2><br>";
//lengthNtwt Table
$html .="
<table border=\"0.5px;\">
    <tr>
        <th>Nepalidate</th>
        <th>Shift</th>
        <th>Brand</th>
        <th>Quality</th>
        <th>Color</th>
        <th>Dimension</th>
        <th>Length</th>
        <th>NTWT</th>
        <th>TotalOfMaterials</th>
</tr>";
$totalOfCurrentData = 0;//for currentTotal
foreach ($consumptionItems as $c):
    $html .= "<tr>
        <td>".$c['tbl_consumption_stock']['nepalidate']."</td>
        <td>".$c['tbl_consumption_stock']['shift']."</td>
        <td>".$c['tbl_consumption_stock']['brand']."</td>
        <td>".$c['tbl_consumption_stock']['quality']."</td>
        <td>".$c['tbl_consumption_stock']['color']."</td>
        <td>".$c['tbl_consumption_stock']['dimension']."</td>
        <td>".h(number_format($c['tbl_consumption_stock']['length']))."</td>
        <td>".h(number_format($c['tbl_consumption_stock']['ntwt']))."</td>
        <td>";
            $total = 0;
            //total of current items calculation
            $materials = json_decode($c['tbl_consumption_stock']['materials']);
            foreach ($material_lists as $m):
                if(property_exists($materials, $m['mixing_materials']['id']))
                {
                    $totalWeight=$materials->$m['mixing_materials']['id'];
                }else{
                    $totalWeight =0;
                }
                $total = $total + $totalWeight;
            endforeach;
            $html .= $total;
            $totalOfCurrentData += $total;
        $html .= "</td></tr>";
    endforeach;
$length_current = 0;
$ntwt_current = 0;
$mixing_wt_current = 0;
$total = 0;
foreach ($consumptionItems as $c):
    $length_current = $c['tbl_consumption_stock']['length'] + $length_current;
    $ntwt_current = $c['tbl_consumption_stock']['ntwt'] + $ntwt_current;
    $mixing_wt_current = $totalOfCurrentData;
endforeach;
foreach ($totalMaterials as $t):
    $material = json_decode($t['tbl_consumption_stock']['materials']);
    foreach ($material_lists as $m):
        if (property_exists($material, $m['mixing_materials']['id'])) {
            $materialWeight = $material->$m['mixing_materials']['id'];
        } else {
            $materialWeight=0;
        }
        $total = $total + $materialWeight;
    endforeach;
endforeach;
$html .= "
<tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td><strong>Total of current data</strong></td>
    <td><strong>".h(number_format($length_current, 2))."</strong></td>
    <td><strong>".h(number_format($ntwt_current, 2))."</strong></td>
    <td><strong>".h(number_format($mixing_wt_current, 2))."</strong></td>
</tr>";
$html .="
<tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td><strong>Total</strong></td>
    <td>
        <strong>".h(number_format($lengthTotal, 2))."</strong>
    </td>
    <td>
        <strong>".h(number_format($ntwtTotal, 2))."</strong>
    </td>
    <td>
        <strong>".h(number_format($total))."</strong>
    </td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>
</table>";
// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
// ---------------------------------------------------------
// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('test.pdf', 'D');
//============================================================+
// END OF FILE
//============================================================+