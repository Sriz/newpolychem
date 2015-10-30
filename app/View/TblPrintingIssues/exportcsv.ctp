<?php 

	//$line= $posts[0]['m'];
//ECHO'<PRE>';print_r($posts);die;
	
	$i=0;
	foreach($posts as $p):
		//ECHO'<PRE>';print_r($p);die;
		$line[$i]['nepalidate']=$p['tbl_printing_issue']['nepalidate'];
		$line[$i]['shift']=$p['tbl_printing_issue']['shift'];
		
		$line[$i]['material']=$p['tbl_printing_issue']['material'];
		
		$line[$i]['patterns']=$p['tbl_printing_issue']['patterns'];
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
	 $filename='PrintingIssuesCSV';
	 echo  $this->CSV->render($filename);
?>