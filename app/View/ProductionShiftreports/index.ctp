
<script>
	

 $(document).ready(function(){
                			var value = ''
            			$('.nepalidatepicker').nepaliDatePicker();
            			// Trigger On change/Selected event
            			$.onChangeDatepicker_Ravindra = function(selectedDate){
            				value = $("#nepalidatepicker").val();
            				$.ajax({
                                          url     : "/polychem/ProductionShiftreports/create_productionpdf",
                                          type    : "POST",
                                          cache   : false,
                                          data    : {city_id: value}

                                      });
            			}

            		});




</script>

<div class="productionShiftreports index">
	
	<div class="panel panel-primary">
      <div class="panel-heading"><?php echo  __('Production  Shift Report');?> </div>
      <div class="panel-body"><table>
				  <?php
				  echo $this->Search->create();
echo '<tr><td>'.$this->Search->input('filter1',array('id'=>'nepalidatepicker','class'=>'nepalidatepicker')).'</td>';
echo '<td>'.$this->Search->end(__('Search', true)).'</td>';
?>
	   <td>   <button class="btn btn-primary" onclick="window.location.href='<?php echo Router::url(array('controller'=>'ProductionShiftreports', 'action'=>'add'))?>'">Add</button>
</td>
	   <td>   <button class="btn btn-primary" onclick="window.open('<?php echo Router::url(array('controller'=>'ProductionShiftreports', 'action'=>'download_pdf'))?>')">Print</button>
</td>
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
	
	
	
	
	<h2><?php echo __('Production Shift Reports'); ?></h2>
	<table class="col-md-12 table-bordered table-striped table-condensed cf">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('shift'); ?></th>
			<th><?php echo $this->Paginator->sort('date'); ?></th>
			<th><?php echo $this->Paginator->sort('brand'); ?></th>
			<th><?php echo $this->Paginator->sort('color'); ?></th>
			<th style="text-align:right"><?php echo $this->Paginator->sort('base UT'); ?></th>
			<th style="text-align:right"><?php echo $this->Paginator->sort('base MT'); ?></th>
			<th style="text-align:right"><?php echo $this->Paginator->sort('base_OT'); ?></th>
			<th style="text-align:right"><?php echo $this->Paginator->sort('print_film'); ?></th>
			<th style="text-align:right"><?php echo $this->Paginator->sort('CT'); ?></th>
			<th style="text-align:right"><?php echo $this->Paginator->sort('output'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($productionShiftreports as $productionShiftreport): ?>
	<tr class="success">
		<td><?php echo h($productionShiftreport['ProductionShiftreport']['id']); ?>&nbsp;</td>
		<td><?php echo h($productionShiftreport['ProductionShiftreport']['shift']); ?>&nbsp;</td>
		<td><?php echo h($productionShiftreport['ProductionShiftreport']['date']); ?>&nbsp;</td>
		<td><?php echo h($productionShiftreport['ProductionShiftreport']['brand']); ?>&nbsp;</td>
		<td><?php echo h($productionShiftreport['ProductionShiftreport']['color']); ?>&nbsp;</td>
		<td align="right"><?php echo h(number_format($productionShiftreport['ProductionShiftreport']['base_ut'],2)); ?>&nbsp;</td>
		<td align="right"><?php echo h(number_format($productionShiftreport['ProductionShiftreport']['base_mt'],2)); ?>&nbsp;</td>
		<td align="right"><?php echo h(number_format($productionShiftreport['ProductionShiftreport']['base_ot'],2)); ?>&nbsp;</td>
		<td align="right"><?php echo h(number_format($productionShiftreport['ProductionShiftreport']['print_film'],2)); ?>&nbsp;</td>
		<td align="right"><?php echo h(number_format($productionShiftreport['ProductionShiftreport']['CT'],2)); ?>&nbsp;</td>
		<td align="right"><?php echo h(number_format($productionShiftreport['ProductionShiftreport']['output'],2)); ?>&nbsp;</td>
		<td class="actions">
			
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $productionShiftreport['ProductionShiftreport']['id']), null, __('Are you sure you want to delete # %s?', $productionShiftreport['ProductionShiftreport']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $productionShiftreport['ProductionShiftreport']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
<?php foreach($total as $t):?>

<tr><td align="right"><b>Total</b></td><td></td><td></td><td></td><td></td><td align="right"><b><?php echo number_format($t['0']['base'],2);?></b></td><td align="right"><b><?php echo number_format($t['0']['mt'],2);?></b></td><td align="right"><b><?php echo number_format($t['0']['ot'],2);?></b></td><td align="right"><b><?php echo number_format($t['0']['pf'],2);?></b></td><td align="right"><b><?php echo number_format($t['0']['ct'],2);?></b></td><td align="right"><b><?php echo number_format($t['0']['output'],2);?></b></td></tr>
	<?php endforeach;?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	
	
	
	
	
	
	
	
	
	
</div>

