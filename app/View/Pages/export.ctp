<?php 

	//$line= $posts[0]['m'];
	for($i=0;$i<count($posts);$i++){
		$line[$i]['material']=$posts[$i]['m']['name'];
	    $line[$i]['total']=$posts[$i][0]['total'];
	    $line[$i]['percent']=$posts[$i][0]['rawpercentage'];
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