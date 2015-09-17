<?php 

	//$line= $posts[0]['m'];
//ECHO'<PRE>';print_r($posts);die;
	
	$i=0;
	foreach($posts as $p):
		//ECHO'<PRE>';print_r($p);die;
		$line[$i]['nepalidate']=$p['tbl_consumption_stock']['nepalidate'];
		$line[$i]['shift']=$p['tbl_consumption_stock']['shift'];
		$line[$i]['brand']=$p['tbl_consumption_stock']['brand'];
		$line[$i]['quality']=$p['tbl_consumption_stock']['quality'];
		$line[$i]['dimension']=$p['tbl_consumption_stock']['dimension'];
		$line[$i]['color']=$p['tbl_consumption_stock']['color'];
		$line[$i]['materials']=$p['tbl_consumption_stock']['materials'];
		$line[$i]['length']=$p['tbl_consumption_stock']['length'];
		$line[$i]['ntwt']=$p['tbl_consumption_stock']['ntwt'];
		$i++;
	endforeach;
	//print'<pre>';print_r($line);print'</pre>';die;
	$this->CSV->addRow(array_keys($line));
	$j=0;
	//echo $this->CSV->addRow('Material','Total','Percentage');
	//print'<pre>';print_r($posts);print'</pre>';die;
	foreach ($posts as $post)
	{
		
	    echo $this->CSV->addRow($line[$j]);
	    $j++;
	 }
	 $filename='CalendarCSV';
	 echo  $this->CSV->render($filename);
?>