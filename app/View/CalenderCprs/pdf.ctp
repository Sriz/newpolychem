<?php
$date = isset($_GET['search'])?$_GET['search']:$lastDate;
$date = $date?$date:$lastDate;
function time_elapsed($secs)
{
    if (isset($secs)):
        $bit = [
            'Years' => $secs / 31556926 % 12,
            'Weeks' => $secs / 604800 % 52,
            'Days' => $secs / 86400 % 7,
            'Hours' => $secs / 3600 % 24,
            'Minutes' => $secs / 60 % 60,
            'Seconds' => $secs % 60
        ];
        $ret=array();
        foreach ($bit as $k => $v)
            if ($v > 0) {
                $ret[] = $v . ' ' . $k;
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
// set text shadow effect
//$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
//// Set some content to print
//echo '<pre>';
//print_r($consumptions);exit;
$totalBroughtScrap = 0;
$totalScrap = 0;
$totalRawMaterials = 0;
$allTotal =0;
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
                $allTotal += $valMaterial;
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
$html .= '<h1><center>Calendar Production Report :<strong>'.$date.'</strong></center></h1>';
$html .="<div style=\"width:500px;\">";
$html .="<table border=\"0.5px;\" style=\"padding-left:5px;\">

<tr>
    <td>Raw Materials</td>
    <td>".h(number_format($totalRawMaterials,2))."</td>
</tr>
<tr>
    <td>Bought Scrap</td>
    <td>".h(number_format($totalBroughtScrap,2))."</td>
</tr>
<tr>
    <td>Factory Scrap</td>
    <td>".h(number_format($totalScrap,2))."</td>
</tr>

<tr style=\"font-weight: bold\">
    <td>Total</td>
    <td>".h(number_format($allTotal,2))."</td>
</tr>
</table>";


$html .= "<h2>Consumptions</h2><br>";
//lengthNtwt Table
$html .="
<table border=\"0.5px;\" style=\"padding-left:5px;\">
    <tr style=\"font-weight: bold\">
        
        <th>Shift</th>
        <th>Brand</th>
        <th>Quality</th>
        <th>Color</th>
        <th>Dimension</th>
        <th>Length</th>
        <th>NTWT</th>
        <th>Total of Materials</th>
</tr>";
$totalOfCurrentData = 0;//for currentTotal
foreach ($consumptionItems as $c):
    $html .= "<tr>
        
        <th>".$c['tbl_consumption_stock']['shift']."</th>
        <th>".$c['tbl_consumption_stock']['brand']."</th>
        <th>".$c['tbl_consumption_stock']['quality']."</th>
        <th>".$c['tbl_consumption_stock']['color']."</th>
        <th>".$c['tbl_consumption_stock']['dimension']."</th>
        <th>".h(number_format($c['tbl_consumption_stock']['length'],2))."</th>
        <th>".h(number_format($c['tbl_consumption_stock']['ntwt'],2))."</th>
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
            $html .= number_format($total,2);
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
// $html .= "
// <tr>
//     <td></td>
//     <td></td>
//     <td></td>
//     <td></td>
//     <td></td>
//     <td><strong>Total of current data</strong></td>
//     <td><strong>".h(number_format($length_current, 2))."</strong></td>
//     <td><strong>".h(number_format($ntwt_current, 2))."</strong></td>
//     <td><strong>".h(number_format($mixing_wt_current, 2))."</strong></td>
// </tr>";

$html .="
<tr>
    <td colspan='8'></td>
</tr>";



$html .="
<tr>
    <td></td>
    <td></td>
    <td></td>
    <td><strong>Total</strong></td>
    
    <td><strong>Today</strong></td>
    <td>
        <strong>".h(number_format($lengthTotal, 2))."</strong>
    </td>
    <td>
        <strong>".h(number_format($ntwtTotal, 2))."</strong>
    </td>
    <td>
        <strong>".h(number_format($total, 2))."</strong>
    </td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>";
$html .="
<tr>
    <td></td>
    <td></td>
    <td></td>
    <td><strong>Total</strong></td>
    
    <td><strong>To Month</strong></td>
    <td>
        <strong>".h(number_format($consumptionItemsThisMonth['length'], 2))."</strong>
    </td>
    <td>
        <strong>".h(number_format($consumptionItemsThisMonth['ntwt'], 2))."</strong>
    </td>
    <td>
        <strong>".h(number_format($consumptionItemsThisMonth['total'], 2))."</strong>
    </td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>";

$html .="
<tr>
    <td></td>
    <td></td>
    <td></td>
    
    <td><strong>Total</strong></td>
    <td><strong>To Year</strong></td>
    <td>
        <strong>".h(number_format($consumptionItemsThisYear['length'], 2))."</strong>
    </td>
    <td>
        <strong>".h(number_format($consumptionItemsThisYear['ntwt'], 2))."</strong>
    </td>
    <td>
        <strong>".h(number_format($consumptionItemsThisYear['total'], 2))."</strong>
    </td>
   
</tr>";


$html .="</table>";
//Resuable Table
$html .="<h2>Scrap Details</h2>";
$html .="
<table border=\"0.5px\" style='width:45%;float: left;'>
<tr>
    <td>Reusable</td>
    <td>".h(number_format($resuable, 2))."</td>
</tr>
<tr>
<td>Lamps and Plates</td>
<td>".h(number_format($lamps_plates,2))."</td>
</tr>
<tr>
<td><strong>Total Scrap Used</strong></td>
<td><strong>".h(number_format($total_scrap_generated, 2))."</strong></td>
</tr>
<tr>
<td><strong>Unaccounted Loss</strong></td>
<!-- input - total Ntwt - scrap generated of current date -->
<td><strong>".h(number_format($allTotal-$ntwtTotal-$total_scrap_generated, 2))."</strong></td>
</tr>
</table>";
$html .= "</div>";

$html .="<h2><center>Time Loss Table</center></h2>";
$total_lh=0;
$total_bh=0;
foreach($timeLossLossHourAll as $losshour):
    $total_lh += $losshour['time_loss']['totalloss_sec'];
endforeach;

foreach($timeLossBreakDownAll as $breakhour):
    $total_bh += $breakhour['time_loss']['totalloss_sec'];
endforeach;
$total_wh = 24*60*60 - ($total_lh+$total_bh);

$html .="<table border=\"0.5px;\" style=\"padding-left:5px;\">
            <tr style=\"font-weight: bold\">
                <td>Loss Hour</td>";
$html .="<td>".time_elapsed($total_lh)."</td>
            </tr>
            <tr style=\"font-weight: bold\">
                <td>Breakdown Hour</td>";
                $html .="<td>".time_elapsed($total_bh)."</td>
            </tr>
            <tr style=\"font-weight: bold\">
                <td>Work Hour</td>";
$html .="<td>".time_elapsed($total_wh)."</td>
            </tr>
        </table><br/>";
$html .="<h4>LossHour</h4>";
$html .="<table border=\"0.5px;\" style=\"padding-left:5px;\">
    <tr style=\"font-weight: bold\">
        <td>Type</td>
        <td>Start Time</td>
        <td>End Time</td>
        <td>Time Loss</td>
        <td>Reason</td>
    </tr>";
$totalSecondsLossHour =0;
foreach($timeLossLossHourAll as $time):
    $html .= "<tr>";
    $html .= "<td>".$time['time_loss']['type']."</td>";
    $html .= "<td>".$time['time_loss']['time']."</td>";
    $html .= "<td>".$time['time_loss']['wk_hrs']."</td>";
    $html .= "<td>".time_elapsed($time['time_loss']['totalloss_sec'])."</td>";
    $totalSecondsLossHour += (int)$time['time_loss']['totalloss_sec'];
    $html .= "<td>".$time['time_loss']['reasons']."</td>";

    $html .= "</tr>";
endforeach;
$html .="<tr style=\"font-weight: bold\">
    <td></td>
    <td></td>
    <td>Loss Hour</td>
    <td>".time_elapsed($totalSecondsLossHour)."</td>
    <td></td>
</tr>";
// $html .="<tr style=\"font-weight: bold\">
//     <td></td>
//     <td></td>
//     <td>Loss Hour (To month)</td>
//     <td>".time_elapsed($timeLossLossHourMonth[0][0]['loss_lh_m'])."</td>
//    <td></td>
// </tr>";
// $html .="<tr style=\"font-weight: bold\">
//     <td></td>
//     <td></td>
//     <td>Loss Hour (To year)</td>
//     <td  >".time_elapsed($timeLossLossHourYear[0][0]['loss_lh_y'])."</td>
//     <td></td>
// </tr>";

$html .="</table>";


$html .="<h4>BreakDown</h4>";
$html .="<table border=\"0.5px;\" style=\"padding-left:5px;\">
    <tr style=\"font-weight: bold\">
        <td>Type</td>
        <td>Start Time</td>
        <td>End Time</td>
        <td>Time Loss</td>
        <td>Reason</td>
    </tr>";
$totalSecondsBreakDown =0;
foreach($timeLossBreakDownAll as $time):
    $html .= "<tr>";
    $html .= "<td>".$time['time_loss']['type']."</td>";
    $html .= "<td>".$time['time_loss']['time']."</td>";
    $html .= "<td>".$time['time_loss']['wk_hrs']."</td>";
    $html .= "<td>".time_elapsed($time['time_loss']['totalloss_sec'])."</td>";
    $totalSecondsBreakDown += (int)$time['time_loss']['totalloss_sec'];
    $html .= "<td>".$time['time_loss']['reasons']."</td>";

    $html .= "</tr>";
endforeach;
$html .="<tr style=\"font-weight: bold\">
    <td></td>
    <td></td>
    <td>Break Hour</td>
    <td>".time_elapsed($totalSecondsBreakDown)."</td>
    <td></td>
</tr>";
// $html .="<tr style=\"font-weight: bold\">
//     <td></td>
//     <td></td>
//     <td>Break Hour (To month)</td>
//     <td  >".time_elapsed($timeLossBreakMonth[0][0]['loss_bd_m'])."</td>
//     <td></td>
    
// </tr>";
// $html .="<tr style=\"font-weight: bold\">
//     <td></td>
//     <td></td>
//     <td>Break Hour (To year)</td>
//     <td  >".time_elapsed($timeLossBreakYear[0][0]['loss_bd_y'])."</td>
//     <td></td>
   
// </tr>";

$html .="<tr style=\"font-weight: bold\">
    <td></td>
</tr>";

$html .="<tr style=\"font-weight: bold\">
    <td></td>
    <td></td>
    <td>Total Time Loss</td>
    <td>".time_elapsed($totalSecondsBreakDown+$totalSecondsLossHour)."</td>
    <td></td>
</tr>";
// $html .="<tr style=\"font-weight: bold\">
//     <td></td>
//     <td></td>
//     <td>Total Time loss (To month)</td>
//     <td>".time_elapsed($timeLossLossHourMonth[0][0]['loss_lh_m']+$timeLossBreakMonth[0][0]['loss_bd_m'])."</td>
//     <td></td>
// </tr>";
// $html .="<tr style=\"font-weight: bold\">
//     <td></td>
//     <td></td>
//     <td>Total Time loss (To year)</td>
//     <td>".time_elapsed($timeLossLossHourYear[0][0]['loss_lh_y']+$timeLossBreakYear[0][0]['loss_bd_y'])."</td>
//     <td></td>
// </tr>";



//timeLossLossHourAll


$html .="</table>";


// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
// ---------------------------------------------------------
// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('CalenderProductionReport-'.$date.'.pdf', 'D');
//============================================================+
// END OF FILE
//============================================================+