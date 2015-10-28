<?php
    for($i=0; $i<count($totalMaterialArray); $i++)
    {
        $line[$i]['materials'] = $mixingMaterials[$i];
        $line[$i]['total'] = $totalMaterialArray[$i];
        $line[$i]['percent'] = $totalMaterialPercentageArray[$i];
    }

    for($i=0; $i<count($materialsScrap); $i++)
    {
        $line1[$i]['materials'] = $materialsScrap[$i];
        $line1[$i]['total'] = ($totalMaterialArrayScrap[$i])?$totalMaterialArrayScrap[$i]:0;
        $line1[$i]['percent'] = ($totalMaterialArrayPercentageScrap[$i])?$totalMaterialArrayPercentageScrap[$i]:0;
    }

    $this->CSV->addRow(array_keys($line));

    //echo $this->CSV->addRow('Material','Total','Percentage');
    echo $this->CSV->addRow(['materials'=>'Materials', 'total'=>'Total','percent'=>'Percent']);
    for($i=0; $i<count($totalMaterialArray); $i++)
    {
        echo $this->CSV->addRow($line[$i]);
    }
    echo $this->CSV->addRow(['materials'=>'Total', 'total'=>"$allTotalRaw",'percent'=>number_format($allTotalRaw*100/(($totalScrap+$totalBroughtScrap+$allTotalRaw)?($totalScrap+$totalBroughtScrap+$allTotalRaw):1), 2)]);
    // echo $this->CSV->addRow(['materials'=>'Total Brought Scrap', 'total'=>"$totalBroughtScrap",'percent'=>number_format($totalBroughtScrap*100/(($totalScrap+$totalBroughtScrap+$allTotalRaw)?($totalScrap+$totalBroughtScrap+$allTotalRaw):1),2)]);
    // echo $this->CSV->addRow(['materials'=>'', 'total'=>'','percent'=>'']);

    for($i=0; $i<count($materialsScrap); $i++)
    {
        echo $this->CSV->addRow($line1[$i]);
    }

    // echo $this->CSV->addRow(['materials'=>'Total Scrap', 'total'=>$totalScrap,'percent'=>number_format($totalScrap*100/(($totalScrap+$totalBroughtScrap+$allTotalRaw)?($totalScrap+$totalBroughtScrap+$allTotalRaw):1),2)]);
    // echo $this->CSV->addRow(['materials'=>'Total Materials ', 'total'=>$totalScrap+$totalBroughtScrap+$allTotalRaw,'percent'=>'100']);
    $filename='PrintMonthlyReport';
    echo  $this->CSV->render($filename);
?>