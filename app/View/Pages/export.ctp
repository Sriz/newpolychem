<?php
    for($i=0; $i<count($totalMaterialArray); $i++)
    {
        $line[$i]['materials'] = $mixingMaterials[$i];
        $line[$i]['total'] = $totalMaterialArray[$i];
        $line[$i]['percent'] = $totalMaterialPercentageArray[$i];
    }

    $this->CSV->addRow(array_keys($line));

    $i=0;
    //echo $this->CSV->addRow('Material','Total','Percentage');
    echo $this->CSV->addRow(['materials'=>'Materials', 'total'=>'Total','percent'=>'Percent']);
    for($i=0; $i<count($totalMaterialArray); $i++)
    {
        echo $this->CSV->addRow($line[$i]);
    }
    echo $this->CSV->addRow(['materials'=>'Total', 'total'=>"$allTotalRaw",'percent'=>number_format($allTotalRaw*100/($totalScrap+$totalBroughtScrap+$allTotalRaw), 2)]);
    echo $this->CSV->addRow(['materials'=>'Total Brought Scrap', 'total'=>"$totalBroughtScrap",'percent'=>number_format($totalBroughtScrap*100/($totalScrap+$totalBroughtScrap+$allTotalRaw),2)]);
    echo $this->CSV->addRow(['materials'=>'Total Scrap', 'total'=>$totalScrap,'percent'=>number_format($totalScrap*100/($totalScrap+$totalBroughtScrap+$allTotalRaw),2)]);
    echo $this->CSV->addRow(['materials'=>'Total Materials ', 'total'=>$totalScrap+$totalBroughtScrap+$allTotalRaw,'percent'=>'100']);
     $filename='MonthlyReport';
     echo  $this->CSV->render($filename);
?>