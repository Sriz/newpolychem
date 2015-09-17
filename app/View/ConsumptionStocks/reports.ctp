<div class="panel panel-primary">
  <div class="panel-heading"><center><h2>Yeti Polychem Pvt Ltd</h2><br><h4>Calendar Raw Material Consumption and Stock Postion <?php echo date('d-m-Y');?></center></h4></div>
  <div class="panel-body">
    
    <div class="row">
			<div class="col-lg-3">
                <table class="table">
    <tr>
    <td colspan="2">Consumption</td>
    </tr>
    <tr>
    <td>Today</td>
    <td><?php
	 //print_r($totaltoday);
	 
	 foreach($totaltoday as $t):
	 echo $t['consumption_stock']['total'];
	 
	 endforeach;
 ?>
 </td>
  
   </tr>
    <tr>
          <td>To Month</td>
          <td></td>
        </tr>
    <tr>
        <td>To Year </td>
        </td></td>
    </tr>
</table>
                
            </div>
            <div class="col-lg-3">
				<table>
				
				
<tr>



				</table>
				
			</div>
    </div>
</div>
  
 <!-- row -->
     <div class="row">
        <!-- column -->
			<div class="col-lg-12">
<table class="table table-condensed">
    <th>Material</th>
	<th>Consumption</th>
  <?php
                    foreach($mixingraws as $mixing):
                   
                        echo "<tr>";
                            echo "<td>";
                            
                            echo $mixing['consumption_stock']['material_id'];
                            echo"</td>";
							echo "<td>";
							echo $mixing['0']['sum'];
							echo "</td>";
                            echo "</tr>";
                            //echo $mixing['consumption_stock']['sum'];
                            //echo "</td>";
                        
                            endforeach;
                            ?>
    <tr><td>Total</td><td><?php  foreach($rawmaterial as $raws): echo $raws['0']['totalmaterial']; endforeach ?></td></tr>
	<?php
                    foreach($mixingscrap as $mix):
                   
                        echo "<tr>";
                            echo "<td>";
                            
                            echo $mix['consumption_stock']['material_id'];
                            echo"</td>";
							echo "<td>";
                          echo $mix['0']['srapsum'];
						  echo "</td>";
                            //echo $mixing['consumption_stock']['sum'];
                            //echo "</td>";
                          echo "</tr>";
                            endforeach;
                            ?>
	 <tr><td>Scrap Total</td><td><?php  foreach($scraptotal as $scraps): echo $scraps['0']['scrap_total']; endforeach ?></td></tr
	  <tr><td>Grand  Total</td><td><?php  foreach($totaltoday as $tot): echo $tot['consumption_stock']['total']; endforeach ?></td></tr>
 
</table>
    
   </div>
            
            
             <!-- column -->
                    
                     <!-- column -->
                           
             <!-- column -->        
                    
            
            
       
             <!-- 2nd row-->
             
                
                
      </div>  
             
             
             
            
            
            
            
</div>
                   
 
    
  

</div>

