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
    echo $this->CSV->addRow(['materials'=>'Total', 'total'=>'total','percent'=>'Percent']);
	 $filename='MonthlyReport';
	 echo  $this->CSV->render($filename);
?>