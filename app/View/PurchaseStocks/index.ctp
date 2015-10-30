<div class="purchaseStocks index">
	<h2><?php echo __('Purchase Stocks'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('purchase_id'); ?></th>
			<th><?php echo $this->Paginator->sort('material_id'); ?></th>
			<th><?php echo $this->Paginator->sort('vender_id'); ?></th>
			<th><?php echo $this->Paginator->sort('category_id'); ?></th>
			<th><?php echo $this->Paginator->sort('quantity'); ?></th>
			<th><?php echo $this->Paginator->sort('purchase_date'); ?></th>
			<th><?php echo $this->Paginator->sort('purchase_user'); ?></th>
			<th><?php echo $this->Paginator->sort('Reorder_level'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($purchaseStocks as $purchaseStock): ?>
	<tr>
		<td><?php echo h($purchaseStock['PurchaseStock']['purchase_id']); ?>&nbsp;</td>
		<td><?php echo h($purchaseStock['PurchaseStock']['material_id']); ?>&nbsp;</td>
		<td><?php echo h($purchaseStock['PurchaseStock']['vender_id']); ?>&nbsp;</td>
		<td><?php echo h($purchaseStock['PurchaseStock']['category_id']); ?>&nbsp;</td>
		<td><?php echo h($purchaseStock['PurchaseStock']['quantity']); ?>&nbsp;</td>
		<td><?php echo h($purchaseStock['PurchaseStock']['purchase_date']); ?>&nbsp;</td>
		<td><?php echo h($purchaseStock['PurchaseStock']['purchase_user']); ?>&nbsp;</td>
		<td><?php echo h($purchaseStock['PurchaseStock']['Reorder_level']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $purchaseStock['PurchaseStock']['stock_id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $purchaseStock['PurchaseStock']['stock_id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $purchaseStock['PurchaseStock']['stock_id']), null, __('Are you sure you want to delete # %s?', $purchaseStock['PurchaseStock']['y'])); ?>
		</td>
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
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Purchase Stock'), array('action' => 'add')); ?></li>
	</ul>
</div>
