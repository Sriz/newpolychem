<?php 


	// $result = urldecode($_REQUEST['result']);
	// $Mixed = json_decode($result);
	// print_r($Mixed);die;

	 echo'<pre>';print_r($result);die;
	//$line= $posts[0]['m'];
	for($i=0;$i<count($result);$i++){
		$line[$i]['material']=$result[$i]['m']['name'];
	    $line[$i]['total']=$result[$i][0]['total'];
	    $line[$i]['percent']=$result[$i][0]['rawpercentage'];
	}
	//print'<pre>';print_r($line);print'</pre>';die;
	$this->CSV->addRow(array_keys($line));
	$i=0;
	//echo $this->CSV->addRow('Material','Total','Percentage');
	foreach ($posts as $post)
	{
		
	    echo $this->CSV->addRow($line[$i]);
	    $i++;
	 }
	 $filename='MonthlyReport';
	 echo  $this->CSV->render($filename);
?>