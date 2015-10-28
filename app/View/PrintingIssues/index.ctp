 <script>
        $(document).ready(function(){
                        			var value = ''
                    			$('.nepalidatepicker').nepaliDatePicker();
                    			// Trigger On change/Selected event
                    			$.onChangeDatepicker_Ravindra = function(selectedDate){
                    				value = $("#nepalidatepicker").val();
                    			$.ajax({
                                              url     : "/polychem/PrintingIssues/create_pissuepdf",
                                              type    : "POST",
                                              cache   : false,
                                              data    : {city_id: value}

                                          });


                    			}

                    		});
</script>


<style>
	 
	 .col-lg-3 {
    width: 15%;
}
	 
</style>
 <div class="panel panel-primary">
      <div class="panel-heading"><?php echo __('Printing Mixing Reports');?> </div>
      <div class="panel-body"><table>
				  <?php
				  echo $this->Search->create();
echo '<tr><td>'.$this->Search->input('filter1',array('id'=>'nepalidatepicker','class'=>'nepalidatepicker')).'</td>';
echo '<td>'.$this->Search->end(__('Search', true)).'</td>';
?>
	   <td>   <button class="btn btn-primary" onclick="window.location.href='<?php echo Router::url(array('controller'=>'PrintingIssues', 'action'=>'add'))?>'">Add</button>
</td>
	    <td>   <button class="btn btn-primary" onclick="window.open('<?php echo Router::url(array('controller'=>'PrintingIssues', 'action'=>'download_pdf'))?>')">Print</button></td>
	   </tr>
				</table></div>
    </div>
 <ul class="pagination pagination-sm">
	<?php
		echo '<li>'. $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled')).'</li>';
		echo '<li>'.$this->Paginator->numbers(array('separator' => '')).'</li>';
		echo '<li>'.$this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled')).'</li>';
	?>
	</ul>

<div class="row">
	<div class="col-lg-3">
		
			
				<div class="row">
					<div class="col-xs-13">
						<table class="table  table-condensed">
						<tr><td class="success">Action</td></tr>
						 <tr><td class="success">Date</td></tr>
                        <tr><td class="success">Quality</td></tr>
                       <!-- <tr><td class="success">Color</td></tr>
                         <tr><td class="success">Dimension</td></tr>-->
                            <?php
                    foreach($rawmaterials as $mixing):
                            echo "<tr>";
                            echo "<td>";
                            echo $mixing;
                            echo "</td>";
                            echo "</tr>";
                            endforeach;
                            ?>
                        <tr><td>Total</td></tr>
                        
                        </table>
					</div>
									</div>
		
			
				</div> 


<?php
$i=1;
$flag=0;
$count=1;

foreach ($printingIssues as $printingIssue): 
if($i<=1)
{
        echo  '<div class="col-lg-2">';
	    echo '<table class="table table-condensed" style="text-align:right;">';
		 echo '<tr><td class="success">'.$this->Html->link(__('Edit'), array('action' => 'edit', $printingIssue['PrintingIssue']['id'])).'</td></tr>';
       echo '<tr><td class="success">'.$printingIssue['PrintingIssue']['date'].'</td></tr>';
	   echo '<tr><td class="success">'.$printingIssue['PrintingIssue']['material'].'</td></tr>';
	     //echo '<tr><td class="success">'."0".'</td></tr>';
       // echo '<tr><td class="success">'.$consumptionStock['ConsumptionStock']['color'].'</td></tr>';
        //echo '<tr><td class="success">'.$consumptionStock['ConsumptionStock']['dimension'].'</td></tr>';

     
    $i=2;
   $flag++;    
   
    
}
    
       
    if($flag<15)
    {
     
            
        echo '<tr>';
      
    //echo '<td>'.$consumptionStock['ConsumptionStock']['material_id'].'</td>';
    echo '<td class="xedit" id="'.$printingIssue['PrintingIssue']['quantity'].'" key="quantity">'.number_format($printingIssue['PrintingIssue']['quantity'],2).'</td>';
        
      
        echo '</tr>';
        
    $flag=$flag+1;
		

    }
        else
       {
       //from this line  i need to break the table  
           echo '<tr>';
		   echo '<td class="xedit" id="'.$printingIssue['PrintingIssue']['quantity'].'" key="quantity">'.number_format($printingIssue['PrintingIssue']['quantity'],2).'</td>';
		   
		    echo '</tr>';
			echo '<tr>';
		   echo '<td id="'.$printingIssue['PrintingIssue']['total'].'" key="quantity"><strong>'.number_format($printingIssue['PrintingIssue']['total'],2).'</strong></td>';
		    echo '</tr>';
			
        $i=1;
        $flag=0;
		$count=1;
            echo '</table>';
            echo '</div>';
    }
  




endforeach;

?>
<div class="col-lg-3">
		
			
				<div class="row">
					<div class="col-xs-13">
					</div>
					<table class="table table-condensed" style="text-align: right;">
						 <tr><td>Grand</td></tr>
						 <tr><td>Total</td></tr>
						  <tr><td></br></td></tr>
						 <?php
						 $tot=0;
						
						 foreach($total as $t):
						 echo '<tr>';
						 echo '<td>';
						 echo number_format($t['0']['total'],2);
						 $tot=$tot+$t['0']['total'];
						 endforeach;
						 echo '</td>';
						 echo'</tr>';
						 echo '<tr>';
						 echo '<td><strong>'.number_format($tot,2).'</strong></td>';
						 echo '</tr>';
						 
						 ?>
						 
					</table>
				</div>
</div>
</div>

