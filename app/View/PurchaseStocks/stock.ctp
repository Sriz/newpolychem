<div class="purchases index">
	<h2><?php echo __('Stock View'); ?></h2>
				<?php
						echo '<table class="table" border="0px"><tr><td width="200px;">'.$this->Search->create('',array('class'=>'form-inline'));
						echo $this->Search->input('filter1',array('type'=>'text','placeholder'=>'Search By Material','class'=>'input-ms search-query form-control'));
						echo  '</td><td>'.$this->Search->end(__('Search',array('class'=>'btn btn-danger'), true)).'</td></tr></table>';
				?>
	
	<table class="table">
	<tr>
			<th><?php echo $this->Paginator->sort('stock_id'); ?></th>
			<th><?php echo $this->Paginator->sort('purchase_date'); ?></th>
			<th><?php echo $this->Paginator->sort('material_id'); ?></th>
			<th><?php echo $this->Paginator->sort('quantity'); ?></th>
			<th><?php echo $this->Paginator->sort('Reorder_level'); ?></th>
	</tr>
	<?php foreach ($purchaseStocks as $purchase): ?>
	<tr class="success">
		<th><?php echo h($purchase['PurchaseStock']['stock_id']); ?></th>
		<td><?php echo h($purchase['PurchaseStock']['purchase_date']); ?>&nbsp;</td>
		<td><?php echo h($purchase['PurchaseStock']['material_id']); ?>&nbsp;</td>
		<td><?php echo h(number_format($purchase['PurchaseStock']['quantity'])); ?>&nbsp;</td>
		<td><?php echo h($purchase['PurchaseStock']['Reorder_level']); ?>&nbsp;</td>
		
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo '<ul>'. $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo '&nbsp;'.$this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled')).'</ul>';
	?>
	</div>
	
</div>

