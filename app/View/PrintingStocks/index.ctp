<div class="printingStocks index">
	<h2><?php echo __('Printing Stocks'); ?></h2>
	<table cellpadding="0" cellspacing="0" class="table">
	<tr>
			<th><?php echo $this->Paginator->sort('date'); ?></th>
			<th><?php echo $this->Paginator->sort('patttern'); ?></th>
			<th style="width: 100px;text-align: right;"><?php echo $this->Paginator->sort('consumption'); ?></th>
			<th style="text-align: right;"><?php echo $this->Paginator->sort('balance'); ?></th>
			<th style="text-align: right;"><?php echo $this->Paginator->sort('issue'); ?></th>
			
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($printingStocks as $printingStock): ?>
	<tr class="success">
		<td><?php echo h($printingStock['PrintingStock']['date']); ?>&nbsp;</td>
		<td><?php echo h($printingStock['PrintingStock']['patttern']); ?>&nbsp;</td>
		<td style="width: 100px;text-align: right;"><?php echo h(number_format($printingStock['PrintingStock']['consumption'],2)); ?>&nbsp;</td>
		<td style="text-align: right;"><?php echo h(number_format($printingStock['PrintingStock']['balance'],2)); ?>&nbsp;</td>
		<td style="text-align: right;"><?php echo h(number_format($printingStock['PrintingStock']['issue'],2)); ?>&nbsp;</td>
		<td class="actions">
			
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $printingStock['PrintingStock']['id']), null, __('Are you sure you want to delete # %s?', $printingStock['PrintingStock']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Printing Stock'), array('action' => 'add')); ?></li>
	</ul>
</div>
