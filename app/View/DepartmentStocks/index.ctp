<div class="departmentStocks index">
	<h2><?php echo __('Department Stocks'); ?></h2>
	<table cellpadding="0" cellspacing="0" class="table table-hover">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
						<th><?php echo $this->Paginator->sort('date'); ?></th>
			<th><?php echo $this->Paginator->sort('department_id'); ?></th>
			<th><?php echo $this->Paginator->sort('material_id'); ?></th>

			<th style="text-align:right;width: auto;"><?php echo $this->Paginator->sort('quantity'); ?></th>
			
	</tr>
	<?php foreach ($departmentStocks as $departmentStock): ?>
	<tr>
		<td><?php echo h($departmentStock['DepartmentStock']['id']); ?>&nbsp;</td>
		<td><?php echo h($departmentStock['DepartmentStock']['date']); ?>&nbsp;</td>
		<td><?php echo h($departmentStock['DepartmentStock']['department_id']); ?>&nbsp;</td>
		<td><?php echo h($departmentStock['DepartmentStock']['material_id']); ?>&nbsp;</td>
		
		<td style="text-align:right;width: auto;"><?php echo h(number_format($departmentStock['DepartmentStock']['quantity'])); ?>&nbsp;</td>
		
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
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>

